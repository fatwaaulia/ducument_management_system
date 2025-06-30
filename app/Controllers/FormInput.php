<?php

namespace App\Controllers;

class FormInput extends BaseController
{
    protected $base_name;
    protected $model_name;
    protected $upload_path;

    public function __construct()
    {
        $this->base_name   = 'form_input';
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

    public function edit($id = null)
    {
        $data = [
            'base_api'  => $this->base_api,
            'base_name' => $this->base_name,
            'data'      => model($this->model_name)->find($id),
            'title'     => 'Edit ' . ucwords(str_replace('_', ' ', $this->base_name)),
        ];
        
        $view['sidebar'] = view('dashboard/sidebar');
        $view['content'] = view($this->base_name . '/edit', $data);
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
        $array_query_key = ['tanggal_awal', 'tanggal_akhir'];

        if (array_intersect(array_keys($_GET), $array_query_key)) {
            $get_tanggal_awal = $this->request->getVar('tanggal_awal');
            if ($get_tanggal_awal) {
                $base_query->where('tanggal_kegiatan >=', $get_tanggal_awal);
            }

            $get_tanggal_akhir = $this->request->getVar('tanggal_akhir');
            if ($get_tanggal_akhir) {
                $base_query->where('tanggal_kegiatan <=', $get_tanggal_akhir);
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

        foreach ($data as $key => $v) {
            $data[$key]['no_urut'] = $offset + $key + 1;
            $data[$key]['gambar'] = webFile($this->base_name, $v['gambar'], $v['updated_at'], true);
            $data[$key]['dokumen_pendukung'] = $v['dokumen_pendukung'] ? webFile($this->base_name, $v['dokumen_pendukung'], $v['updated_at']) : '';
            $data[$key]['harga'] = formatRupiah($v['harga']);
            $data[$key]['tanggal_kegiatan'] = $v['tanggal_kegiatan'] ? dateFormatter($v['tanggal_kegiatan'], 'cccc, d MMMM yyyy HH:mm') : '';
        }

        return $this->response->setStatusCode(200)->setJSON([
            'recordsTotal'    => $records_total,
            'recordsFiltered' => $total_rows,
            'data'            => $data,
        ]);
    }

    public function detail($id = null)
    {
        $data = model($this->model_name)->find($id);

        if ($data) {
            return $this->response->setStatusCode(200)->setJSON([
                'status'  => 'success',
                'message' => 'Data ditemukan',
                'data'    => $data,
            ]);
        } else {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'Data tidak ditemukan',
            ]);
        }
    }

    public function create()
    {
        $rules = [
            'nama'              => "required|is_unique[$this->base_name.nama]",
            'harga'             => 'required',
            'dokumen_pendukung' => 'max_size[dokumen_pendukung,2048]|ext_in[dokumen_pendukung,pdf]|mime_in[dokumen_pendukung,application/pdf]',
            'gambar'            => 'max_size[gambar,2048]|ext_in[gambar,png,jpg,jpeg]|mime_in[gambar,image/png,image/jpeg]|is_image[gambar]',
            'persetujuan'       => 'required',
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
        $dokumen_pendukung = $this->request->getFile('dokumen_pendukung');
        if ($dokumen_pendukung->isValid()) {
            $filename_dokumen_pendukung = $dokumen_pendukung->getRandomName();
            $dokumen_pendukung->move($this->upload_path, $filename_dokumen_pendukung);
        } else {
            $filename_dokumen_pendukung = '';
        }

        $gambar = $this->request->getFile('gambar');
        if ($gambar->isValid()) {
            $filename_gambar = $gambar->getRandomName();
            if ($gambar->getExtension() != 'jpg') {
                $filename_gambar = str_replace($gambar->getExtension(), 'jpg', $filename_gambar);
            }
            compressConvertImage($gambar, $this->upload_path, $filename_gambar);
        } else {
            $filename_gambar = '';
        }

        for (;;) {
            $random_string = strtoupper(random_string('alnum', 5));
            $cek_kode = model($this->model_name)->select('kode')->where('kode', $random_string)->countAllResults();
            if ($cek_kode == 0) {
                $kode = $random_string;
                break;
            }
        }

        $nama = $this->request->getVar('nama');
        $slug = url_title($nama, '-', true);
        $cek_nama = model($this->model_name)->select('nama')->where('nama', $nama)->countAllResults();
        if ($cek_nama != 0) {
            $random_string = random_string('alpha', 5);
            $slug = $slug . '-' . $random_string;
        }

        $select_multiple = $this->request->getVar('select_multiple');
        $checkbox = $this->request->getVar('checkbox');
        $data = [
            'kode'              => $kode,
            'nama'              => $nama,
            'slug'              => $slug,
            'harga'             => $this->request->getVar('harga', FILTER_SANITIZE_NUMBER_INT),
            'deskripsi'         => $this->request->getVar('deskripsi'),
            'dokumen_pendukung' => $filename_dokumen_pendukung,
            'gambar'            => $filename_gambar,
            'tanggal_kegiatan'  => $this->request->getVar('tanggal_kegiatan') ?: null,
            'select_multiple'   => $select_multiple ? json_encode($select_multiple) : null,
            'checkbox'          => $checkbox ? json_encode($checkbox) : null,
            'persetujuan'       => $this->request->getVar('persetujuan'),
        ];

        model($this->model_name)->insert($data);

        // Faker
        // $faker = \Faker\Factory::create('id_ID');
        // $data = [];
        // for ($i = 1; $i <= 3; $i++) :
        //     $kode = strtoupper(random_string('alnum', 5));

        //     if (date('s') >= 50 && date('s') <= 59) {
        //         $filename_gambar = 'dummy_' . rand() . '.jpg';
        //         $image_path = "assets/uploads/form_input/$filename_gambar";
        //         $dummy_image_url = 'https://unsplash.it/400/200?random=' . rand();
        //         file_put_contents($image_path, file_get_contents($dummy_image_url));
        //     } else {
        //         $filename_gambar = '';
        //     }

        //     $data[] = [
        //         'kode'   => $kode,
        //         'gambar' => $filename_gambar,
        //         'nama'   => str_replace('.', '', $faker->sentence(mt_rand(2, 5))),
        //         'harga'  => rand(10000, 500000),
        //         'gambar' => $filename_gambar,
        //         'tanggal_kegiatan' => date('Y-m-d H:i:s', rand(strtotime('2025-01-15'), strtotime('2025-02-15'))),
        //         'persetujuan'      => ['Iya', 'Tidak'][mt_rand(0, 1)],
        //     ];
        // endfor;
        // model($this->model_name)->insertBatch($data);
        // End | Faker

        return $this->response->setStatusCode(200)->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil ditambahkan',
            'route'   => $this->base_route,
        ]);
    }

    public function update($id = null)
    {
        $find_data = model($this->model_name)->find($id);

        $rules = [
            'nama'              => "required|is_unique[$this->base_name.nama,id,$id]",
            'harga'             => 'required',
            'dokumen_pendukung' => 'permit_empty|max_size[dokumen_pendukung,2048]|ext_in[dokumen_pendukung,pdf]|mime_in[dokumen_pendukung,application/pdf]',
            'gambar'            => 'permit_empty|max_size[gambar,2048]|ext_in[gambar,png,jpg,jpeg]|mime_in[gambar,image/png,image/jpeg]|is_image[gambar]',
            'persetujuan'       => 'required',
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
        $dokumen_pendukung = $this->request->getFile('dokumen_pendukung');
        if ($dokumen_pendukung && $dokumen_pendukung->isValid()) {
            $filename_dokumen_pendukung = $find_data['dokumen_pendukung'] ?: $dokumen_pendukung->getRandomName();
            $dokumen_pendukung->move($this->upload_path, $filename_dokumen_pendukung);
        } else {
            $filename_dokumen_pendukung = $find_data['dokumen_pendukung'];
        }

        $gambar = $this->request->getFile('gambar');
        if ($gambar->isValid()) {
            $filename_gambar = $find_data['gambar'] ?: $gambar->getRandomName();
            if ($gambar->getExtension() != 'jpg') {
                $filename_gambar = str_replace($gambar->getExtension(), 'jpg', $filename_gambar);
            }
            compressConvertImage($gambar, $this->upload_path, $filename_gambar);
        } else {
            $filename_gambar = $find_data['gambar'];
        }

        $select_multiple = $this->request->getVar('select_multiple');
        $checkbox = $this->request->getVar('checkbox');
        $data = [
            'nama'              => $this->request->getVar('nama'),
            'harga'             => $this->request->getVar('harga', FILTER_SANITIZE_NUMBER_INT),
            'deskripsi'         => $this->request->getVar('deskripsi'),
            'dokumen_pendukung' => $filename_dokumen_pendukung,
            'gambar'            => $filename_gambar,
            'tanggal_kegiatan'  => $this->request->getVar('tanggal_kegiatan') ?: null,
            'select_multiple'   => $select_multiple ? json_encode($select_multiple) : null,
            'checkbox'          => $checkbox ? json_encode($checkbox) : null,
            'persetujuan'       => $this->request->getVar('persetujuan'),
        ];

        model($this->model_name)->update($id, $data);

        return $this->response->setStatusCode(200)->setJSON([
            'status'  => 'success',
            'message' => 'Perubahan disimpan',
            'route'   => $this->base_route,
        ]);
    }

    public function delete($id = null)
    {
        $find_data = model($this->model_name)->find($id);

        $dokumen_pendukung = $this->upload_path . $find_data['dokumen_pendukung'];
        if (is_file($dokumen_pendukung)) unlink($dokumen_pendukung);

        $gambar = $this->upload_path . $find_data['gambar'];
        if (is_file($gambar)) unlink($gambar);

        model($this->model_name)->delete($id);

        return $this->response->setStatusCode(200)->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
