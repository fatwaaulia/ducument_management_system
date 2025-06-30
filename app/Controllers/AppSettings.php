<?php

namespace App\Controllers;

class AppSettings extends BaseController
{
    protected $base_name;
    protected $model_name;
    protected $upload_path;

    public function __construct()
    {
        $this->base_name   = 'app_settings';
        $this->model_name  = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->base_name)));
        $this->upload_path = dirUpload() . $this->base_name . '/';
    }

    /*--------------------------------------------------------------
    # Front-End
    --------------------------------------------------------------*/
    public function edit()
    {
        $data = [
            'base_api'  => $this->base_api,
            'base_name' => $this->base_name,
            'data'      => model($this->model_name)->find(1),
            'title'     => 'Edit App Settings',
        ];
        
        $view['sidebar'] = view('dashboard/sidebar');
        $view['content'] = view($this->base_name . '/edit', $data);
        return view('dashboard/header', $view);
    }

    public function maintenance()
    {
        $data = [
            'base_api' => $this->base_api,
            'data'     => model($this->model_name)->find(1),
            'title'    => 'Maintenance',
        ];
        
        $view['sidebar'] = view('dashboard/sidebar');
        $view['content'] = view($this->base_name . '/maintenance', $data);
        return view('dashboard/header', $view);
    }

    public function emailLayout()
    {
        $data = [
            'for_name'    => 'Hamba Allah',
            'message'     => 'Ada pesan nih, baca ya: <br>' .
                             'Dan Dia telah memberikan kepadamu segala apa yang kamu mohonkan kepada-Nya. Dan jika kamu menghitung nikmat Allah, niscaya kamu tidak akan mampu menghitungnya. Sungguh, manusia itu sangat zalim dan sangat mengingkari (nikmat Allah). (QS. Ibrahim : 34)',
            'button_link' => base_url(),
            'button_name' => 'Tombol',
        ];

        return view('app_settings/email', $data);
    }

    /*--------------------------------------------------------------
    # API
    --------------------------------------------------------------*/
    public function update($id = null)
    {
        $find_data = model($this->model_name)->find($id);

        $rules = [
            'nama_aplikasi'   => 'required',
            'nama_perusahaan' => 'required',
            'deskripsi'       => 'required',
            'no_hp'           => 'required',
            'maps'            => 'permit_empty|valid_url_strict',
            'logo'            => 'max_size[logo,1024]|ext_in[logo,png,jpg,jpeg]|mime_in[logo,image/png,image/jpeg]|is_image[logo]',
            'favicon'         => 'max_size[favicon,1024]|ext_in[favicon,png,jpg,jpeg]|mime_in[favicon,image/png,image/jpeg]|is_image[favicon]',
        ];
        if (! $this->validate($rules)) {
            $errors = array_map(fn($error) => str_replace('_', ' ', $error), $this->validator->getErrors());

            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'Data yang dimasukkan tidak valid!',
                'errors'  => $errors,
            ]);
        }

        // Lolos Validasi
        $logo = $this->request->getFile('logo');
        if ($logo->isValid()) {
            $logo_name = 'logo.' . $logo->getExtension();
            $this->image->withFile($logo)->save($this->upload_path . $logo_name, 60);
        } else {
            $logo_name = $find_data['logo'];
        }

        $favicon = $this->request->getFile('favicon');
        if ($favicon->isValid()) {
            $favicon_name = 'favicon.' . $favicon->getExtension();
            $this->image->withFile($favicon)->save($this->upload_path . $favicon_name, 60);
        } else {
            $favicon_name = $find_data['favicon'];
        }

        $data = [
            'nama_aplikasi'   => $this->request->getVar('nama_aplikasi'),
            'nama_perusahaan' => $this->request->getVar('nama_perusahaan'),
            'no_hp'           => $this->request->getVar('no_hp'),
            'deskripsi'       => $this->request->getVar('deskripsi'),
            'logo'            => $logo_name,
            'favicon'         => $favicon_name,
            'alamat'          => $this->request->getVar('alamat'),
        ];

        model($this->model_name)->update($id, $data);

        return $this->response->setStatusCode(200)->setJSON([
            'status'  => 'success',
            'message' => 'Perubahan disimpan',
            'route'   => $this->base_route . 'edit',
        ]);
    }

    public function sendEmail()
    {
        $rules = [
            'email' => 'required|valid_email',
        ];
        if (! $this->validate($rules)) {
            $errors = array_map(fn($error) => str_replace('_', ' ', $error), $this->validator->getErrors());

            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'Data yang dimasukkan tidak valid!',
                'errors'  => $errors,
            ]);
        }

        $email  = $this->request->getVar('email');

        $to_email = $email;
        $subject = 'Kirim Email Berhasil';
        $message_field = [
           'for_name'     => 'Hamba Allah',
            'message'     => 'Ada pesan nih, baca ya: <br>' .
                             'Dan Dia telah memberikan kepadamu segala apa yang kamu mohonkan kepada-Nya. Dan jika kamu menghitung nikmat Allah, niscaya kamu tidak akan mampu menghitungnya. Sungguh, manusia itu sangat zalim dan sangat mengingkari (nikmat Allah). (QS. Ibrahim : 34)',
            'button_link' => base_url(),
            'button_name' => 'Tombol',
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
            ]);
        } else {
            $email_error = $email->printDebugger(['headers']);
            return $this->response->setStatusCode(500)->setJSON([
                'status'  => 'error',
                'message' => 'Permintaan gagal diproses',
                'data'    => $email_error,
            ]);
        }
    }
}
