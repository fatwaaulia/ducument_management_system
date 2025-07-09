<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->set404Override(
    function() {
        $data['title'] = '404';
        $data['content'] = view('errors/error_404');

        if (userSession()) {
            $data['sidebar'] = view('dashboard/sidebar');
            return view('dashboard/header', $data);
        } else {
            $data['navbar'] = view('frontend/components/navbar');
            $data['footer'] = view('frontend/components/footer');
            return view('frontend/header', $data);
        }
    }
);

/*--------------------------------------------------------------
  # Front-End
--------------------------------------------------------------*/
$routes->get('/', 'Auth::login');

/*--------------------------------------------------------------
  # Autentikasi
--------------------------------------------------------------*/
// login
$routes->get('login', 'Auth::login');
$routes->post('api/login', 'Auth::loginProcess');
$routes->get('logout', 'Auth::logout');
// lupa password
$routes->get('password/forgot', 'Auth::forgotPassword');
$routes->get('password/forgot', 'Auth::forgotPassword');
$routes->post('api/password/forgot', 'Auth::forgotPasswordSave', ['filter' => 'csrf']);
$routes->get('password/reset/(:segment)', 'Auth::resetPassword/$1');
$routes->post('api/password/reset/(:segment)', 'Auth::resetPasswordSave/$1', ['filter' => 'csrf']);
// email layout
$routes->get('email-layout', 'AppSettings::emailLayout');

/*--------------------------------------------------------------
  # Menu Dashboard dan Profil
--------------------------------------------------------------*/
$id_role   = userSession('id_role');
$slug_role = userSession('slug_role');

if (in_array($id_role, [1, 2])) {
    $routes->get("$slug_role/dashboard", "Dashboard::$slug_role", ['filter' => 'EnsureLogin']);
    $routes->get("$slug_role/profile", "Administrator::profile", ['filter' => 'EnsureLogin']);
    $routes->group("api/profile", ['filter' => 'EnsureLogin'], static function ($routes) {
        $routes->post('update', 'Administrator::updateProfile');
        $routes->post('update/password', 'Administrator::updatePassword');
        $routes->post('delete/photo', 'Administrator::deletePhoto');
    });
}

/*--------------------------------------------------------------
  # Menu Sidebar
--------------------------------------------------------------*/
if (in_array($id_role, roleAccessByTitle('App Settings'))) {
    $routes->group("$slug_role/app-settings", ['filter' => 'EnsureLogin'], static function ($routes) {
        $routes->get('/', 'AppSettings::edit');
    });
    $routes->group("api/app-settings", ['filter' => 'EnsureLogin'], static function ($routes) {
        $routes->post('update/(:segment)', 'AppSettings::update/$1');
    });
}

if (in_array($id_role, roleAccessByTitle('Maintenance'))) {
    $routes->group("$slug_role/maintenance", ['filter' => 'EnsureLogin'], static function ($routes) {
        $routes->get('email', 'Maintenance::email');
    });
    $routes->group("api/maintenance", ['filter' => 'EnsureLogin'], static function ($routes) {
        $routes->post('email', 'Maintenance::sendEmail');
    });
}

if (in_array($id_role, roleAccessByTitle('Log Login'))) {
    $routes->get("$slug_role/log-login", 'LogLogin::main', ['filter' => 'EnsureLogin']);
    $routes->group('api/log-login', ['filter' => 'EnsureLogin'], static function ($routes) {
        $routes->get('/', 'LogLogin::index');
        $routes->post('delete/(:segment)', 'LogLogin::delete/$1');
    });
}

if (in_array($id_role, roleAccessByTitle('Dokumen'))) {
    $routes->group("$slug_role/dokumen", ['filter' => 'EnsureLogin'], static function ($routes) {
        $routes->get('/', 'Dokumen::main');
        $routes->get('detail/(:segment)', 'Dokumen::detail/$1');
        $routes->get('new', 'Dokumen::new');
        $routes->get('edit/(:segment)', 'Dokumen::edit/$1');
    });
    $routes->group('api/dokumen', ['filter' => 'EnsureLogin'], static function ($routes) {
        $routes->get('/', 'Dokumen::index');
        $routes->post('create', 'Dokumen::create');
        $routes->post('update/(:segment)', 'Dokumen::update/$1');
        $routes->post('delete/(:segment)', 'Dokumen::delete/$1');
    });
}

if (in_array($id_role, roleAccessByTitle('Permintaan Persetujuan'))) {
    $routes->group("$slug_role/permintaan-persetujuan", ['filter' => 'EnsureLogin'], static function ($routes) {
        $routes->get('/', 'Dokumen::permintaanPersetujuan');
        $routes->get('edit/(:segment)', 'Dokumen::edit/$1');
    });
    $routes->group('api/permintaan-persetujuan', ['filter' => 'EnsureLogin'], static function ($routes) {
        $routes->get('/', 'Dokumen::indexPermintaanPersetujuan');
        $routes->post('update/(:segment)', 'Dokumen::update/$1');
    });
}

/*--------------------------------------------------------------
  # Master Data
--------------------------------------------------------------*/
if (in_array($id_role, roleAccessByTitle('Role'))) {
    $routes->get("$slug_role/role", 'Role::main', ['filter' => 'EnsureLogin']);
    $routes->group('api/role', ['filter' => 'EnsureLogin'], static function ($routes) {
        $routes->get('/', 'Role::index');
        $routes->post('create', 'Role::create');
        $routes->post('update/(:segment)', 'Role::update/$1');
        $routes->post('delete/(:segment)', 'Role::delete/$1');
    });
}

if (in_array($id_role, roleAccessByTitle('User Management'))) {
    $routes->group("$slug_role/users", ['filter' => 'EnsureLogin'], static function ($routes) {
        $routes->get('/', 'Users::main');
        $routes->get('new', 'Users::new');
        $routes->get('edit/(:segment)', 'Users::edit/$1');
    });
    $routes->group('api/users', ['filter' => 'EnsureLogin'], static function ($routes) {
        $routes->get('/', 'Users::index');
        $routes->post('create', 'Users::create');
        $routes->post('update/(:segment)', 'Users::update/$1');
        $routes->post('delete/(:segment)', 'Users::delete/$1');
        $routes->post('foto/delete/(:segment)', 'Users::hapusFoto/$1');
        $routes->get('export-excel', 'Users::exportExcel');
    });
}

if (in_array($id_role, roleAccessByTitle('Form Input'))) {
    $routes->group("$slug_role/form-input", ['filter' => 'EnsureLogin'], static function ($routes) {
        $routes->get('/', 'FormInput::main');
        $routes->get('new', 'FormInput::new');
        $routes->get('edit/(:segment)', 'FormInput::edit/$1');
    });
    $routes->group('api/form-input', ['filter' => 'EnsureLogin'], static function ($routes) {
        $routes->get('/', 'FormInput::index');
        $routes->get('detail/(:segment)', 'FormInput::detail/$1');
        $routes->post('create', 'FormInput::create');
        $routes->post('update/(:segment)', 'FormInput::update/$1');
        $routes->post('delete/(:segment)', 'FormInput::delete/$1');
    });
}

if (in_array($id_role, roleAccessByTitle('Kategori'))) {
    $routes->get("$slug_role/kategori", 'Kategori::main', ['filter' => 'EnsureLogin']);
    $routes->group('api/kategori', ['filter' => 'EnsureLogin'], static function ($routes) {
        $routes->get('/', 'Kategori::index');
        $routes->post('create', 'Kategori::create');
        $routes->post('update/(:segment)', 'Kategori::update/$1');
        $routes->post('delete/(:segment)', 'Kategori::delete/$1');
    });
}
