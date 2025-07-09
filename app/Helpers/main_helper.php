<?php

use Config\App;
use CodeIgniter\I18n\Time;

function encode($string)
{
    $key = "bismillah";
    return base64_encode(openssl_encrypt($string, 'aes-256-ecb', $key, 0));
}

function decode($string)
{
    $key = 'bismillah';
    return openssl_decrypt(base64_decode($string), 'aes-256-ecb', $key, 0);
}

function dateFormatter($tanggal, $format)
{   
    $date = Time::parse($tanggal, 'Asia/Jakarta', 'id_ID');
    return $date->toLocalizedString($format); // cccc, d MMMM yyyy HH:mm:ss
}

function userSession($field = null)
{
    if (! session()->isLogin) return '';

    $id_user = session()->get('id_user');
    $user = model('Users')->find($id_user);
    
    if (! $user) return 'Pengguna tidak ditemukan!';

    if ($field) {
        $user_session = $user[$field];
    } else {
        $user_session = $user;
    }

    return $user_session;
}

function dataTablesSearch($columns, $search, $select, $base_query) {
    $searchable = array_filter($columns);
    if ($search && $searchable) {
        $aliases = [];
        $has_alias = false;
        foreach ((array)$select as $s) {
            if (preg_match('/(.+)\s+as\s+(.+)/i', $s, $match)) {
                $aliases[trim($match[2])] = trim($match[1]);
                $has_alias = true;
            }
        }
        $base_query->groupStart();
        foreach ($searchable as $col) {
            $column_name = ($has_alias && !in_array($col, $aliases)) ? "a.{$col}" : $col;
            $base_query->orLike($column_name, $search);
        }
        $base_query->groupEnd();
    }
}

function dotsNumber($angka) {
    return number_format($angka, 0, ',', '.');
}

function formatRupiah($angka) {
    $angka = (int)$angka;
    $abs = number_format(abs($angka), 0, ',', '.');
    return ($angka < 0 ? '-Rp' : 'Rp') . $abs;
}

/*--------------------------------------------------------------
  # File Management
--------------------------------------------------------------*/
function dirUpload()
{
    return config(App::class)->dirUpload;
}

function webFile($folder_name, $filename, $updated_at, $is_image = false, $note = '')
{
    $webfile_url = config(App::class)->webfileURL;
    $path = '';

    if ($is_image) {
        $path = $webfile_url . 'default.png';

        if ($note == 'user') {
            $path = $webfile_url . 'user-default.png';
        }
    }

    if ($filename) {
        $path = $webfile_url . "$folder_name/$filename?v=" . date('His', strtotime($updated_at));
    }

    return $path;
}

function compressConvertImage($get_file, $upload_path, $filename)
{
    $image = service('image');
    $image->withFile($get_file);
    $image->convert(IMAGETYPE_JPEG);
    $image->flatten(255, 255, 255);
    if ($image->getWidth() > 800 || $image->getHeight() > 800) $image->resize(800, 800, true);
    $image->save($upload_path . $filename, 60);
}

/*--------------------------------------------------------------
  # Menu Sidebar
--------------------------------------------------------------*/
function menuSidebar()
{
    $menu_sidebar = [
		[
			'title'	=> 'Dashboard',
			'icon'	=> 'fa-solid fa-chart-line',
			'url'	=> base_url(userSession('slug_role')) . '/dashboard',
			'role'	=> [1, 2, 3],
			'type'	=> 'no-collapse',
		],
        [
			'title'	=> 'DOKUMEN',
			'role'	=> [1],
			'type'	=> 'heading',
		],
        [
			'title'	=> 'Dokumen',
			'icon'	=> 'fa-solid fa-file-pdf',
			'url'	=> base_url(userSession('slug_role')) . '/dokumen',
			'role'	=> [1],
			'type'	=> 'no-collapse',
		],
        [
			'title'	=> 'Permintaan Persetujuan',
			'icon'	=> 'fa-solid fa-hourglass-start',
			'url'	=> base_url(userSession('slug_role')) . '/permintaan-persetujuan',
			'role'	=> [1],
			'type'	=> 'no-collapse',
		],
		[
			'title'	=> 'MASTER DATA',
			'role'	=> [1],
			'type'	=> 'heading',
		],
        [
			'title'	=> 'Role',
			'icon'	=> 'fa-solid fa-user-tag',
			'url'	=> base_url(userSession('slug_role')) . '/role',
			'role'	=> [1],
			'type'	=> 'no-collapse',
		],
		[
			'title'	=> 'User Management',
			'icon'	=> 'fa-solid fa-user-group',
			'url'	=> base_url(userSession('slug_role')) . '/users',
			'role'	=> [1],
			'type'	=> 'no-collapse',
		],
		[
			'title'	=> 'Form Input',
			'icon'	=> 'fa-solid fa-keyboard',
			'url'	=> base_url(userSession('slug_role')) . '/form-input',
			'role'	=> [1],
			'type'	=> 'no-collapse',
		],
		[
			'title'	=> 'Kategori',
			'icon'	=> 'fa-solid fa-table-cells-large',
			'url'	=> base_url(userSession('slug_role')) . '/kategori',
			'role'	=> [1],
			'type'	=> 'no-collapse',
		],
		/*--------------------------------------------------------------
		# Apps
		--------------------------------------------------------------*/
		[
			'title'	=> 'ACCOUNT',
			'role'	=> [1, 2, 3],
			'type'	=> 'heading',
		],
        [
			'title'	=> 'App Settings',
			'icon'	=> 'fa-solid fa-gear',
			'url'	=> base_url(userSession('slug_role')) . '/app-settings',
			'role'	=> [1],
			'type'	=> 'no-collapse',
		],
		[
			'title'	=> 'Maintenance',
			'icon'	=> 'fa-solid fa-screwdriver-wrench',
			'role'	=> [1],
			'type'	=> 'collapse',
			'collapse' => [
				[
					'title'	=> 'Email',
					'url'	=> base_url(userSession('slug_role')) . '/maintenance/email',
				],
				[
					'title'	=> 'Notifikasi',
					'url'	=> base_url(userSession('slug_role')) . '/maintenance/notifikasi',
				],
			],
		],
        [
			'title'	=> 'Log Login',
			'icon'	=> 'fa-solid fa-lock',
			'url'	=> base_url(userSession('slug_role')) . '/log-login',
			'role'	=> [1],
			'type'	=> 'no-collapse',
		],
		[
			'title'	=> 'Profil',
			'icon'	=> 'fa-solid fa-user',
			'url'	=> base_url(userSession('slug_role')) . '/profile',
			'role'	=> [1, 2, 3],
			'type'	=> 'no-collapse',
		],
		[
			'title'	=> 'Keluar',
			'icon'	=> 'fa-solid fa-arrow-right-from-bracket',
			'url'	=> base_url('logout'),
			'role'	=> [1, 2, 3],
			'type'	=> 'no-collapse',
		],
	];

    return $menu_sidebar;
}

function roleAccessByTitle($title) {
    $sidebar = menuSidebar();
    foreach ($sidebar as $item) {
		if (in_array(($item['type'] ?? ''), ['no-collapse', 'collapse'])) {
			if (($item['title'] ?? '') == $title) {
				return $item['role'];
			}
		}
    }
    return [];
}
