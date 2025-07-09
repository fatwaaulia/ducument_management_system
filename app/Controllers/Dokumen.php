<?php

namespace App\Controllers;

class Dokumen extends BaseController
{
    protected $base_name;
    protected $model_name;
    protected $upload_path;

    public function __construct()
    {
        $this->base_name   = 'dokumen';
        $this->model_name  = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->base_name)));
        $this->upload_path = dirUpload() . $this->base_name . '/';
    }

    /*--------------------------------------------------------------
    # Front-End
    --------------------------------------------------------------*/
    public function main()
    {
        $query = $_SERVER['QUERY_STRING'] ? ('?' . $_SERVER['QUERY_STRING']) : '';
        $data = [
            'get_data'   => $this->base_api . $query,
            'base_route' => $this->base_route,
            'base_api'   => $this->base_api,
            'title'      => ucwords(str_replace('_', ' ', $this->base_name)),
        ];

        $view['sidebar'] = view('dashboard/sidebar');
        $view['content'] = view($this->base_name . '/main', $data);
        return view('dashboard/header', $view);
    }

    public function new()
    {
        $data = [
            'base_api' => $this->base_api,
            'title'    => 'Add ' . ucwords(str_replace('_', ' ', $this->base_name)),
        ];

        $view['sidebar'] = view('dashboard/sidebar');
        $view['content'] = view($this->base_name . '/new', $data);
        return view('dashboard/header', $view);
    }

    public function detail($id = null)
    {
        $data = [
            'base_api'  => $this->base_api,
            'base_name' => $this->base_name,
            'data'      => model($this->model_name)->find($id),
            'title'     => 'Detail ' . ucwords(str_replace('_', ' ', $this->base_name)),
        ];
        
        $view['sidebar'] = view('dashboard/sidebar');
        $view['content'] = view($this->base_name . '/detail', $data);
        return view('dashboard/header', $view);
    }

    /*--------------------------------------------------------------
    # API
    --------------------------------------------------------------*/
    public function index()
    {
        $select     = ['*'];
        $base_query = model($this->model_name)->select($select);
        $limit      = (int)$this->request->getVar('length');
        $offset     = (int)$this->request->getVar('start');
        $records_total   = $base_query->countAllResults(false);
        $array_query_key = ['kategori'];

        if (array_intersect(array_keys($_GET), $array_query_key)) {
            $get_kategori = $this->request->getVar('kategori');
            if ($get_kategori) {
                $base_query->where('kategori', $get_kategori);
            }
        }

        // Datatables
        $columns = array_column($this->request->getVar('columns') ?? [], 'name');
        $search = $this->request->getVar('search')['value'] ?? null;
        dataTablesSearch($columns, $search, $select, $base_query);

        $order = $this->request->getVar('order')[0] ?? null;
        if (isset($order['column'], $order['dir']) && !empty($columns[$order['column']])) {
            $base_query->orderBy($columns[$order['column']], $order['dir'] === 'desc' ? 'desc' : 'asc');
        }
        // End | Datatables

        $total_rows = $base_query->countAllResults(false);
        $data       = $base_query->findAll($limit, $offset);

        $users = model('Users')->select(['id', 'nama'])->findAll();
        $nama_user_by_id = array_column($users, 'nama', 'id');
        foreach ($data as $key => $v) {
            $data[$key]['no_urut'] = $offset + $key + 1;
            $data[$key]['dokumen'] = $v['dokumen'] ? webFile($this->base_name, $v['dokumen'], $v['updated_at']) : '';
            $data[$key]['created_at'] = date('d-m-Y H:i:s', strtotime($v['created_at']));
            $data[$key]['created_by'] = $nama_user_by_id[$v['created_by']];
        }

        return $this->response->setStatusCode(200)->setJSON([
            'recordsTotal'    => $records_total,
            'recordsFiltered' => $total_rows,
            'data'            => $data,
        ]);
    }

    public function create()
    {
        $rules = [
            'kategori'       => 'required',
            'judul'          => "required|max_length[255]|is_unique[$this->base_name.judul]",
            'ringkasan'      => 'max_length[500]',
            'user_tingkat_1' => 'required',
            'dokumen'        => 'uploaded[dokumen]|max_size[dokumen,2048]|ext_in[dokumen,pdf]|mime_in[dokumen,application/pdf]',
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
        $dokumen = $this->request->getFile('dokumen');
        if ($dokumen->isValid()) {
            $filename_dokumen = $dokumen->getRandomName();
            $dokumen->move($this->upload_path, $filename_dokumen);
        } else {
            $filename_dokumen = '';
        }

        $data = [
            'kategori'          => $this->request->getVar('kategori'),
            'judul'             => $this->request->getVar('judul'),
            'ringkasan'         => $this->request->getVar('ringkasan'),
            'dokumen'           => $filename_dokumen,
            'id_user_tingkat_1' => $this->request->getVar('user_tingkat_1'),
            'status_tingkat_1'  => 'MENUNGGU PERSETUJUAN',
            'updated_at_tingkat_1' => $this->request->getVar('updated_at_tingkat_1') ?: null,
            'created_by'        => userSession('id'),
        ];

        model($this->model_name)->insert($data);

        return $this->response->setStatusCode(200)->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil ditambahkan',
            'route'   => $this->base_route,
        ]);
    }

    public function delete($id = null)
    {
        $find_data = model($this->model_name)->find($id);

        $dokumen = $this->upload_path . $find_data['dokumen'];
        if (is_file($dokumen)) unlink($dokumen);

        model($this->model_name)->delete($id);

        return $this->response->setStatusCode(200)->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }

    /*--------------------------------------------------------------
    # Permintaan Persetujuan
    --------------------------------------------------------------*/
    public function permintaanPersetujuan()
    {
        $query = $_SERVER['QUERY_STRING'] ? ('?' . $_SERVER['QUERY_STRING']) : '';
        $data = [
            'get_data'   => $this->base_api . $query,
            'base_route' => $this->base_route,
            'base_api'   => $this->base_api,
            'title'      => 'Permintaan Persetujuan',
        ];

        $view['sidebar'] = view('dashboard/sidebar');
        $view['content'] = view($this->base_name . '/permintaan_persetujuan', $data);
        return view('dashboard/header', $view);
    }

    public function indexPermintaanPersetujuan()
    {
        $select     = ['*'];
        $base_query = model($this->model_name)->select($select);
        $limit      = (int)$this->request->getVar('length');
        $offset     = (int)$this->request->getVar('start');
        $records_total   = $base_query->countAllResults(false);
        $array_query_key = ['kategori'];

        if (array_intersect(array_keys($_GET), $array_query_key)) {
            $get_kategori = $this->request->getVar('kategori');
            if ($get_kategori) {
                $base_query->where('kategori', $get_kategori);
            }
        }

        // Datatables
        $columns = array_column($this->request->getVar('columns') ?? [], 'name');
        $search = $this->request->getVar('search')['value'] ?? null;
        dataTablesSearch($columns, $search, $select, $base_query);

        $order = $this->request->getVar('order')[0] ?? null;
        if (isset($order['column'], $order['dir']) && !empty($columns[$order['column']])) {
            $base_query->orderBy($columns[$order['column']], $order['dir'] === 'desc' ? 'desc' : 'asc');
        }
        // End | Datatables

        $total_rows = $base_query->countAllResults(false);
        $data       = $base_query->findAll($limit, $offset);

        $users = model('Users')->select(['id', 'nama'])->findAll();
        $nama_user_by_id = array_column($users, 'nama', 'id');
        foreach ($data as $key => $v) {
            $data[$key]['no_urut'] = $offset + $key + 1;
            $data[$key]['dokumen'] = $v['dokumen'] ? webFile($this->base_name, $v['dokumen'], $v['updated_at']) : '';
            $data[$key]['created_at'] = date('d-m-Y H:i:s', strtotime($v['created_at']));
            $data[$key]['created_by'] = $nama_user_by_id[$v['created_by']];
        }

        return $this->response->setStatusCode(200)->setJSON([
            'recordsTotal'    => $records_total,
            'recordsFiltered' => $total_rows,
            'data'            => $data,
        ]);
    }
}
