<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// Homepage
$route['default_controller'] = 'home';
$route['(:any)'] = 'home/halaman/$1';
$route['home/cek-login'] = 'home/cekDataLogin';
$route['cek-login/simpan-hp'] = 'home/simpanHP';
$route['cek-login/validasi'] = 'home/validasi';
$route['home/pedoman/load_media'] = 'home/loadMedia';
$route['home/customer-service/info-nik/(:any)'] = 'home/informasiNIK/$1';

// Admin
$route['admin/(:any)'] = 'admin/index/$1';
$route['admin/(:any)/(:any)'] = 'admin/halaman/$1/$2';
$route['admin/session/logout/halaman'] = 'admin/logout';

// PROFILE
$route['admin/settings/profile/update'] = 'admin/updateProfile';
$route['admin/settings/profile/get-jenjang/(:any)'] = 'admin/itemJenjang/$1';


// Homepage
$route['admin/settings/homepage/simpan-(:any)'] = 'admin/tambahSetHome/$1';
$route['admin/settings/homepage/hapus-media/(:any)/(:any)'] = 'admin/hapusMedia/$1/$2';

// Menu
$route['admin/settings/menu/tambah-menu'] = 'admin/tambahMenu';
$route['admin/settings/menu/edit-menu/(:any)'] = 'admin/editMenu/$1';

// Submenu
$route['admin/settings/menu/tambah-submenu'] = 'admin/tambahSubmenu';
$route['admin/settings/menu/edit-submenu/(:any)'] = 'admin/editSubmenu/$1';

// Tampilan
$route['admin/settings/maintenance/reset'] = 'admin/resetMaintenance';
$route['admin/settings/maintenance/update'] = 'admin/updateMaintenance';

// Role Akses
$route['admin/settings/hak-akses/tambah-role'] = 'admin/tambahRole';
$route['admin/settings/hak-akses/edit-role/(:any)'] = 'admin/editRole/$1';
$route['admin/settings/hak-akses/beri-akses/(:any)/(:any)/(:any)'] = 'admin/beriAkses/$1/$2/$3';

// Data Skala
$route['admin/master-data/data-skala/tambah'] = 'admin/tambahSkala';
$route['admin/master-data/data-skala/edit-skala-(:any)'] = 'admin/updateSkala/$1';

// Data Jabfung
$route['admin/master-data/data-jabfung/tambah-jabfung'] = 'admin/tambahJabfung';
$route['admin/master-data/data-jabfung/edit-data-jabfung-(:any)'] = 'admin/editJabfung/$1';
$route['admin/master-data/data-jabfung/(:any)/instrumen'] = 'admin/dataInstrumen';
$route['admin/master-data/data-jabfung/tambah-instrumen'] = 'admin/tambahInstrumen';
$route['admin/master-data/data-jabfung/instrumen/edit-(:any)'] = 'admin/editInstrumen/$1';
$route['admin/master-data/data-jabfung/(:any)/instrumen/hapus-(:any)'] = 'admin/hapusInstrumen/$1/$2';
$route['admin/master-data/data-jabfung/tambah-jenjang'] = 'admin/tambahJenjang';
$route['admin/master-data/data-jabfung/edit-jenjang/(:any)/(:any)'] = 'admin/editJenjang/$1/$2';
$route['admin/master-data/data-jabfung/tambah-rumah'] = 'admin/simpanRumah';
$route['admin/master-data/data-jabfung/edit-rumah/(:any)'] = 'admin/updateRumah/$1';

// Data User
$route['admin/master-data/data-user/simpan'] = 'admin/tambahUser';
$route['admin/master-data/data-user/update-date/(:any)'] = 'admin/updateDataUser/$1';
$route['admin/master-data/data-user/simpan-pangkat'] = 'admin/tambahPangkat';
$route['admin/master-data/data-user/update-pangkat/(:any)'] = 'admin/updatePangkat/$1';

// Data TNA
$route['admin/tna/data-tna/get-jenjang/(:any)'] = 'admin/getJenjang/$1';
$route['admin/tna/data-tna/form-tna'] = 'admin/formTNA';
$route['admin/tna/data-tna/tambah-tna/(:any)'] = 'admin/tambahTNA/$1';
$route['admin/tna/data-tna/update-tna'] = 'admin/updateTNA';
$route['admin/tna/data-tna/preview-soal'] = 'admin/getRekom';
$route['admin/tna/data-tna/simpan-soal/(:any)'] = 'admin/simpanSoal/$1';
$route['admin/tna/data-tna/edit-tna/(:any)'] = 'admin/editTNA/$1';
$route['admin/tna/data-tna/hapus-data/(:any)'] = 'admin/hapusTNA/$1';
$route['admin/tna/data-tna/reload-data'] = 'admin/reloadTNA';
$route['admin/tna/data-tna/(:any)/(:any)'] = 'admin/detailRespon/$1/$2';
$route['admin/tna/data-tna/view/item/(:any)'] = 'admin/getDataTNA/$1';
$route['admin/tna/data-tna/view/export-(:any)/excel'] = 'admin/exportExcel/$1';
$route['admin/tna/data-tna/get-instrumen/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'admin/getInstrumen/$1/$2/$3/$4/$5';

// Kuesioner
$route['admin/tna/kuesioner/(:any)'] = 'admin/kuesioner/$1';
$route['admin/tna/kuesioner/simpan/data-soal'] = 'admin/simpanJawaban';
$route['admin/tna/kuesioner/next/get-soal'] = 'admin/nextSoal';
$route['admin/tna/kuesioner/evaluasi/responden'] = 'admin/evaluasi';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
