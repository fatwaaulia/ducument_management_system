<?php

namespace App\Controllers;

class Auth extends BaseController
{
    protected $model_name;
    protected $app_settings;

    public function __construct()
    {
        $this->model_name   = 'Users';
        $this->app_settings = model('AppSettings')->find(1);
    }

    /*--------------------------------------------------------------
    # Front-End
    --------------------------------------------------------------*/
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    public function login()
    {
        if (session()->isLogin) return redirect()->to(base_url(userSession('slug_role')) . '/dashboard');

        $data['title'] = 'Login | ' . $this->app_settings['nama_aplikasi'];

        $view['content'] = view('auth/login', $data);
        return view('dashboard/header', $view);
    }

    public function forgotPassword()
    {
        if (session()->isLogin) return redirect()->to(base_url(userSession('slug_role')) . '/dashboard');

        $data['title'] = 'Lupa Password | ' . $this->app_settings['nama_aplikasi'];

        $view['content'] = view('auth/forgot_password', $data);
        return view('dashboard/header', $view);
    }

    public function resetPassword($token = null)
    {
        if (session()->isLogin) return redirect()->to(base_url(userSession('slug_role')) . '/dashboard');

        $cek_token = model($this->model_name)->where('token_reset_password', $token)->countAllResults();
        if (! $cek_token) return redirect()->to(base_url());

        $data['title'] = 'Reset Password | ' . $this->app_settings['nama_aplikasi'];

        $data['user'] = model($this->model_name)->where('token_reset_password', $token)->first();
        $view['content'] = view('auth/reset_password', $data);
        return view('dashboard/header', $view);
    }

    /*--------------------------------------------------------------
    # API
    --------------------------------------------------------------*/
    public function loginProcess()
    {
        if (session()->isLogin) return redirect()->to(base_url(userSession('slug_role')) . '/dashboard');

        $rules = [
            'username'  => 'required',
            'password'  => 'required',
        ];
        if (!$this->validate($rules)) {
            $errors = array_map(fn($error) => str_replace('_', ' ', $error), $this->validator->getErrors());

            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'Data yang dimasukkan tidak valid!',
                'errors'  => $errors,
            ]);
        }

        // Lolos Validasi
        $username = $this->request->getVar('username');
        $password = trim($this->request->getVar('password'));

        $user = model($this->model_name)
            ->select(['id', 'id_role', 'nama', 'username', 'password'])
            ->where('username', $username)
            ->first();

        // Log Login
        $log = [
            'id_user'    => $user['id'] ?? '',
            'id_role'    => $user['id_role'] ?? '',
            'nama_user'  => $user['nama'] ?? '',
            'username'   => $user['username'] ?? $username,
            'ip_address' => $this->request->getIPAddress(),
        ];

        if ($user && password_verify($password, $user['password'])) {
            $log['status'] = 'Success';
            model('LogLogin')->insert($log);

            $session = [
                'isLogin' => true,
                'id_user' => $user['id'],
            ];
            session()->set($session);
            $role = model('Role')->where('id', $user['id_role'])->first();

            return $this->response->setStatusCode(200)->setJSON([
                'status'  => 'success',
                'message' => 'Login berhasil',
                'route'   => base_url($role['slug']) . '/dashboard',
            ]);
        }

        $log['status'] = 'Failed';
        model('LogLogin')->insert($log);

        return $this->response->setStatusCode(401)->setJSON([
            'status'  => 'error',
            'message' => 'Username atau password salah!',
        ]);
    }

    public function forgotPasswordSave()
    {
        if (session()->isLogin) return redirect()->to(base_url(userSession('slug_role')) . '/dashboard');

        if (! $this->validate(['email' => 'required|valid_email'])) {
            $errors = array_map(fn($error) => str_replace('_', ' ', $error), $this->validator->getErrors());

            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'Data yang dimasukkan tidak valid!',
                'errors'  => $errors,
            ]);
        }

        // Lolos Validasi
        $email = $this->request->getVar('email', FILTER_SANITIZE_EMAIL);
        $user = model($this->model_name)->where('email', $email)->first();
        if (! $user) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Email tidak ditemukan!',
            ]);
        }

        for (;;) {
            $get_token = bin2hex(random_bytes(16));
            $cek_token = model($this->model_name)->select('token_reset_password')->where('token_reset_password', $get_token)->countAllResults();
            if ($cek_token == 0) {
                $data = [
                    'token_reset_password'    => $get_token,
                    'token_reset_password_at' => date('Y-m-d H:i:s'),
                ];
                model($this->model_name)->update($user['id'], $data);
                break;
            }
        }

        $to_email = $user['email'];
        $subject = 'Permintaan Reset Password';
        $message_field = [
            'for_name'      => $user['nama'],
            'message'       => 'Kata sandi Anda dapat diatur ulang dengan klik tombol di bawah. Jika Anda tidak meminta kata sandi baru, abaikan email ini.',
            'button_name'   => 'Reset Password',
            'button_link'   => base_url('password/reset/') . $get_token,
        ];
        $message = view('app_settings/email', $message_field);

        $email = service('email');
        $email->setFrom($email->fromEmail, $email->fromName);
        $email->setTo($to_email);
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            return $this->response->setStatusCode(200)->setJSON([
                'status'  => 'success',
                'message' => 'Permintaan telah dikirim. Silakan periksa email Anda!',
                'route'   => base_url('forgot-password'),
            ]);
        } else {
            return $this->response->setStatusCode(500)->setJSON([
                'status'  => 'error',
                'message' => 'Permintaan gagal diproses',
            ]);
        }
    }

    public function resetPasswordSave($token = null)
    {
        if (session()->isLogin) return redirect()->to(base_url(userSession('slug_role')) . '/dashboard');

        $user = model($this->model_name)->where('token_reset_password', $token)->first();
        if (! $user) return redirect()->to(base_url());

        $rules = [
            'password'  => 'required|min_length[3]',
            'passconf'  => 'required|min_length[3]|matches[password]',
        ];
        if (!$this->validate($rules)) {
            $errors = array_map(fn($error) => str_replace('_', ' ', $error), $this->validator->getErrors());

            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'Data yang dimasukkan tidak valid!',
                'errors'  => $errors,
            ]);
        }

        // Lolos Validasi
        $password = trim($this->request->getVar('password'));
        $data = [
            'password'                => password_hash($password, PASSWORD_DEFAULT),
            'token_reset_password'    => null,
            'token_reset_password_at' => null,
        ];

        model($this->model_name)->update($user['id'], $data);

        $to_email = $user['email'];
        $subject = 'Informasi Reset Password';
        $message_field = [
            'for_name'      => $user['nama'],
            'message'       => 'Kata sandi Anda berhasil diatur ulang. Silakan login menggunakan kata sandi baru.',
            'button_name'   => 'Login',
            'button_link'   => base_url('login'),
        ];
        $message = view('app_settings/email', $message_field);

        $email = service('email');
        $email->setFrom($email->fromEmail, $email->fromName);   
        $email->setTo($to_email);
        $email->setSubject($subject);
        $email->setMessage($message);
        $email->send();

        return $this->response->setStatusCode(200)->setJSON([
            'status'  => 'success',
            'message' => 'Password Anda berhasil diubah',
            'route'   => base_url('login'),
        ]);
    }
}
