<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Sastrawi\Stemmer\StemmerFactory;

class Admin extends CI_Controller
{
    /*================================================== CONSTRUCT FUNCTION ==================================================*/
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        cek_login();

        $stemmerFactory = new StemmerFactory();
        $this->stemmer = $stemmerFactory->createStemmer();
    }

    /*================================================== PRIVATE FUNCTION ==================================================*/
    private function data($slug)
    {
        $oneMenu = $this->SettingsModel->getOneMenu(['slug_menu' => $slug, 'posisi_menu' => 'admin']);
        $oneSubMenu = $this->SettingsModel->getOneSubmenu(['slug_submenu' => $slug]);
        $judul = '';
        $pengguna = $this->MasterDataModel->getOneUser(['nik' => $this->session->userdata('nik')]);
        $akse_sub = '';

        if ($oneMenu) {
            $judul = $oneMenu->nama_menu;
            $hak_akses = $this->SettingsModel->getAksesPengguna($pengguna->id_role, $oneMenu->id_menu, $akse_sub);
        } elseif ($oneSubMenu) {
            $getJudul = $this->SettingsModel->getOneMenu(['id_menu' => $oneSubMenu->id_menu]);
            if ($getJudul) {
                $judul = $getJudul->nama_menu;
            }
            $hak_akses = $this->SettingsModel->getAksesPengguna($pengguna->id_role, $getJudul->id_menu, $oneSubMenu->id_submenu);
        } else {
            $uri = $this->uri->segment(2);
            $uri3 = $this->uri->segment(3);
            $getsMenu = $this->SettingsModel->getOneMenu(['slug_menu' => $uri, 'posisi_menu' => 'admin']);
            $gtoneSubMenu = $this->SettingsModel->getOneSubmenu(['slug_submenu' => $uri3]);
            $judul = $getsMenu->nama_menu;
            $hak_akses = $this->SettingsModel->getAksesPengguna($pengguna->id_role, $getsMenu->id_menu, $gtoneSubMenu->id_submenu);
        }

        return [
            'judul' => $judul,
            'getMenu' => $this->SettingsModel->getMenu(),
            'hakAkses' => $hak_akses,
            'getSubmenu' => $this->SettingsModel->getSubmenu(),
            'getAkses' => $this->SettingsModel->getAkses(),
            'getMaintenance' => $this->SettingsModel->getOneMaintenance(),
            'getRole' => $this->SettingsModel->getRole(),
            'getSkala' => $this->MasterDataModel->getSkala(),
            'getJabfung' => $this->MasterDataModel->getJabfung(),
            'getJenjang' => $this->MasterDataModel->getJenjang(),
            'getInstrumen' => $this->MasterDataModel->getInstrumen(),
            'getRumah' => $this->MasterDataModel->getRumah(),
            'getUser' => $this->MasterDataModel->getUser(),
            'getPangkat' => $this->MasterDataModel->getPangkat(),
            'getApi' => $this->MasterDataModel->getOneApi(['id_api' => 'eaus-1']),
            'getTNA' => $this->TNAModel->getTNA(),
            'getSoal' => $this->TNAModel->getSoal(),
            'getRekom' => $this->TNAModel->getRekom(),
            'getAllRekom' => $this->TNAModel->getAllRekom(['nik' => $pengguna->nik]),
            'countRekom' => $this->TNAModel->getCountRekom($pengguna->nik),
            'pengguna' => $pengguna,
        ];
    }

    private function load_views($slug, $data)
    {
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/modal', $data);
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/views/' . $slug, $data);
        $this->load->view('admin/layout/footer', $data);
    }

    private function kembali($dataUrl)
    {
        redirect('admin/' . $dataUrl);
    }

    private function generatePertanyaan($kata_kata, $tingkat)
    {
        shuffle($kata_kata);
        $teks = implode(" ", $kata_kata);
        $string_cleaned = preg_replace('/[\/\\\]/', '', $teks);
        $string_cleaned = preg_replace('/\badalah\b/', '', $string_cleaned);
        preg_match('/(.*?)(?=\.)|(.+)/', $string_cleaned, $matches);
        $kalimat_pertama = trim(strtolower($matches[0]));
        $pertanyaan = "Seberapa " . $tingkat . " bagi Anda dalam " . $kalimat_pertama . "?";
        return $pertanyaan;
    }

    private function generatePernyataan($kata_kata, $tingkat)
    {
        shuffle($kata_kata);
        $teks = implode(" ", $kata_kata);
        $string_cleaned = preg_replace('/[\/\\\]/', '', $teks);
        $string_cleaned = preg_replace('/\badalah\b/', '', $string_cleaned);
        preg_match('/(.*?)(?=\.)|(.+)/', $string_cleaned, $matches);
        $pernyataan = "Menurut pengalaman saya, " . strtolower($string_cleaned) . "... (Tingkatan " . $tingkat . ")";
        return $pernyataan;
    }

    /*================================================== PUBLIC FUNCTION ==================================================*/

    /*-------------------------------------------------- INDEX --------------------------------------------------*/
    public function index($slug)
    {
        $menu = $this->SettingsModel->getOneMenu(['slug_menu' => $slug]);
        $oneUser = $this->MasterDataModel->getOneUser(['nik' => $this->session->userdata('nik')]);
        $view = '';
        $cekAkses = $this->SettingsModel->cekAkses($oneUser->id_role, $menu->id_menu, $view);

        if (!$cekAkses) {
            $this->session->set_flashdata('error', 'Maaf halaman tidak bisa diakses! Silahkan kontak administrator!');
            redirect('admin/settings/profile');
        }

        if ($oneUser->id_role == 'role-4' && empty($oneUser->id_jabfung)) {
            $this->session->set_flashdata('warning', 'Maaf! Lengkapi Biodata Anda Terlebih Dahulu');
            redirect('admin/settings/profile');
        } elseif ($oneUser->id_role != 'role-4' && empty($oneUser->tmpt_lahir)) {
            $this->session->set_flashdata('warning', 'Maaf! Lengkapi Biodata Anda Terlebih Dahulu');
            redirect('admin/settings/profile');
        }

        $pathView = 'admin/views/' . $slug . '.php';

        if (file_exists(APPPATH . 'views/' . $pathView)) {
            $data = $this->data($slug);
            $this->load_views($slug, $data);
        } else {
            $this->session->set_flashdata('error', 'Halaman Tidak Ditemukan');
            redirect('admin/settings/profile');
        }
    }

    /*-------------------------------------------------- HALAMAN --------------------------------------------------*/
    public function halaman($slugMenu, $slug)
    {
        $oneUser = $this->MasterDataModel->getOneUser(['nik' => $this->session->userdata('nik')]);
        $cekMenu = $this->SettingsModel->getOneMenu(['slug_menu' => $slugMenu]);
        $cekSub = $this->SettingsModel->getOneSubmenu(['id_menu' => $cekMenu->id_menu, 'slug_submenu' => $slug]);
        $cekAkses = $this->SettingsModel->cekAkses($oneUser->id_role, $cekMenu->id_menu, $cekSub->id_submenu);

        if (!$cekAkses) {
            $this->session->set_flashdata('error', 'Maaf halaman tidak bisa diakses! Silahkan kontak administrator!');
            redirect('admin/settings/profile');
        }

        if ($oneUser->id_role == 'role-4' && empty($oneUser->id_jabfung)) {
            if ($cekSub->slug_submenu != 'profile') {
                $this->session->set_flashdata('warning', 'Maaf! Lengkapi Biodata Anda Terlebih Dahulu');
                redirect('admin/settings/profile');
            }
        } elseif ($oneUser->id_role != 'role-4' && empty($oneUser->tmpt_lahir)) {
            if ($cekSub->slug_submenu != 'profile') {
                $this->session->set_flashdata('warning', 'Maaf! Lengkapi Biodata Anda Terlebih Dahulu');
                redirect('admin/settings/profile');
            }
        }

        if ($cekSub) {
            $pathView = 'admin/views/' . $cekSub->slug_submenu . '.php';

            if (file_exists(APPPATH . 'views/' . $pathView)) {
                $data = $this->data($cekSub->slug_submenu);
                $this->load_views($cekSub->slug_submenu, $data);
            } else {
                $this->session->set_flashdata('error', 'Halaman Tidak Ditemukan');
                redirect('admin/settings/profile');
            }
        } else {
            $this->session->set_flashdata('error', 'Maaf! menu yang anda tuju tidak tersedia!');
            redirect('admin/settings/profile');
        }
    }

    /*-------------------------------------------------- Tambah Menu --------------------------------------------------*/
    public function tambahMenu()
    {
        $cekJumlahRows = $this->SettingsModel->totRowMenu();
        $redir = $this->input->post('redir');

        if (empty($cekJumlahRows)) {
            $id = 1;
        } else {
            $id = $cekJumlahRows + 1;
        }

        $nama_menu = $this->input->post('nama_menu');
        $slug = strtolower(url_title($nama_menu));
        $posisi_menu = $this->input->post('posisi_menu');

        $data = [
            'id_menu' => 'menu-' . $id,
            'nama_menu' => $nama_menu,
            'slug_menu' => $slug,
            'icon_menu' => $this->input->post('icon_menu'),
            'posisi_menu' => $posisi_menu,
            'is_active' => 'Aktif',
        ];

        if ($posisi_menu == 'home') {
            $content = '<div id="kontent">';
            $content .= '</div>';
            $simpanFile = APPPATH . 'views/home/views/' . $slug . '.php';
        } else {
            $content = '<?php
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);
?>
';
            $content .= '<main style="margin-bottom: 100px">';
            $content .= '</main>';
            $simpanFile = APPPATH . 'views/admin/views/' . $slug . '.php';
        }

        $cekMenu = $this->SettingsModel->getOneMenu(['slug_menu' => $slug]);

        if ($cekMenu) {
            $this->session->set_flashdata('error', 'Menu ' . $nama_menu . ' Sudah Ada!');
        } else {
            if (!file_exists($simpanFile)) {
                if ($file = fopen($simpanFile, 'w')) {
                    fwrite($file, $content);
                    fclose($file);
                } else {
                    $this->session->set_flashdata('error', 'Gagal membuat file.');
                }
            }

            $this->SettingsModel->insertMenu($data);
            $this->session->set_flashdata('success', 'Menu ' . $nama_menu . ' Berhasil Ditambahkan!');
        }
        $this->kembali($redir);
    }

    /*-------------------------------------------------- Edit Menu --------------------------------------------------*/
    public function editMenu($idMenu)
    {
        $redir = $this->input->post('redir');

        $nama_menu = $this->input->post('nama_menu');
        $slug = strtolower(url_title($nama_menu));
        $posisi_menu = $this->input->post('posisi_menu');

        $data = [
            'nama_menu' => $nama_menu,
            'slug_menu' => $slug,
            'icon_menu' => $this->input->post('icon_menu'),
            'posisi_menu' => $posisi_menu,
            'is_active' => $this->input->post('is_active'),
        ];

        $cekMenu = $this->SettingsModel->getOneMenu($data);

        if ($cekMenu) {
            $this->session->set_flashdata('error', 'Menu Sudah Ada!');
        } else {
            if ($cekMenu->slug_menu != $slug) {
                if ($posisi_menu == 'home') {
                    $oldFile = APPPATH . 'views/home/views/' . $cekMenu->slug_menu . '.php';
                    $newFile = APPPATH . 'views/home/views/' . $slug . '.php';
                } else {
                    $oldFile = APPPATH . 'views/admin/views/' . $cekMenu->slug_menu . '.php';
                    $newFile = APPPATH . 'views/admin/views/' . $slug . '.php';
                }

                if (file_exists($oldFile)) {
                    if (rename($oldFile, $newFile)) {
                        $this->session->set_flashdata('file_success', 'Nama file berhasil diperbarui dari ' . $cekMenu->slug_menu . '.php menjadi ' . $slug . '.php.');
                    } else {
                        $this->session->set_flashdata('error', 'Gagal memperbarui nama file.');
                    }
                }
            }

            $this->SettingsModel->updateMenu($idMenu, $data);
            $this->session->set_flashdata('success', 'Menu ' . $cekMenu->nama_menu . ' Berhasil Diperbaharui!');
        }

        $this->kembali($redir);
    }

    /*-------------------------------------------------- Tambah Submenu --------------------------------------------------*/
    public function tambahSubmenu()
    {
        $cekJumlahRows = $this->SettingsModel->totRowSubmenu();
        $redir = $this->input->post('redir');

        if (empty($cekJumlahRows)) {
            $id = 1;
        } else {
            $id = $cekJumlahRows + 1;
        }

        $nama_submenu = $this->input->post('nama_submenu');
        $slug = strtolower(url_title($nama_submenu));

        $data = [
            'id_submenu' => 'submenu-' . $id,
            'id_menu' => $this->input->post('id_menu'),
            'nama_submenu' => $nama_submenu,
            'slug_submenu' => $slug,
            'is_active' => 'Aktif',
        ];

        $content = '<?php
                        $segments_after_admin = $this->uri->segment_array(2);
                        array_shift($segments_after_admin);
                        $redirect_url = implode("/", $segments_after_admin);
                    ?>
                    ';
        $content .= '<main style="margin-bottom: 100px">';
        $content .= '</main>';

        $simpanFile = APPPATH . 'views/admin/views/' . $slug . '.php';

        $cekSubmenu = $this->SettingsModel->getOneSubmenu(['slug_submenu' => $slug]);

        if ($cekSubmenu) {
            $this->session->set_flashdata('error', 'Submenu ' . $nama_submenu . ' Sudah Ada!');
        } else {
            if (!file_exists($simpanFile)) {
                if ($file = fopen($simpanFile, 'w')) {
                    fwrite($file, $content);
                    fclose($file);
                } else {
                    $this->session->set_flashdata('error', 'Gagal membuat file.');
                }
            }

            $this->SettingsModel->insertSubmenu($data);
            $this->session->set_flashdata('success', 'Submenu ' . $nama_submenu . ' Berhasil Ditambahkan!');
        }
        $this->kembali($redir);
    }

    /*-------------------------------------------------- Edit Submenu --------------------------------------------------*/
    public function editSubmenu($idSubmenu)
    {
        $redir = $this->input->post('redir');

        $nama_submenu = $this->input->post('nama_submenu');
        $slug = strtolower(url_title($nama_submenu));

        $data = [
            'id_menu' => $this->input->post('id_menu'),
            'nama_submenu' => $nama_submenu,
            'slug_submenu' => $slug,
            'is_active' => $this->input->post('is_active'),
        ];

        $cekSubmenu = $this->SettingsModel->getOneSubmenu($data);

        if ($cekSubmenu) {
            $this->session->set_flashdata('error', 'Submenu Sudah Ada!');
        } else {
            if ($cekSubmenu->slug_submenu != $slug) {
                $oldFile = APPPATH . 'views/admin/views/' . $cekSubmenu->slug_submenu . '.php';
                $newFile = APPPATH . 'views/admin/views/' . $slug . '.php';
                if (file_exists($oldFile)) {
                    if (rename($oldFile, $newFile)) {
                        $this->session->set_flashdata('file_success', 'Nama file berhasil diperbarui dari ' . $cekSubmenu->slug_submenu . '.php menjadi ' . $slug . '.php.');
                    } else {
                        $this->session->set_flashdata('error', 'Gagal memperbarui nama file.');
                    }
                }
            }

            $this->SettingsModel->updateSubmenu($idSubmenu, $data);
            $this->session->set_flashdata('success', 'Submenu ' . $cekSubmenu->nama_submenu . ' Berhasil Diperbaharui!');
        }

        $this->kembali($redir);
    }

    /*-------------------------------------------------- Set Home --------------------------------------------------*/
    public function tambahSetHome($idMenu)
    {
        $redir = $this->input->post('redir');

        if (!empty($_FILES["background_$idMenu"]['name'][0])) {
            $jumlahMedia = count($_FILES["background_$idMenu"]['name']);
            $image = array();

            $config['upload_path']   = './assets/upload/media/';
            $config['allowed_types'] = 'pdf|jpg|png|jpeg';

            for ($i = 0; $i < $jumlahMedia; $i++) {
                $_FILES['file']['name']     = $_FILES["background_$idMenu"]['name'][$i];
                $_FILES['file']['type']     = $_FILES["background_$idMenu"]['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES["background_$idMenu"]['tmp_name'][$i];
                $_FILES['file']['size']     = $_FILES["background_$idMenu"]['size'][$i];

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                    $extension = pathinfo($file_name, PATHINFO_EXTENSION);

                    if ($extension == 'pdf') {
                        $imagick = new Imagick();
                        $imagick->setResolution(300, 300);
                        $imagick->readImage($upload_data['full_path'] . '[0]');
                        $imagick->setImageFormat('jpeg');
                        $new_file_name = FCPATH . 'assets/upload/media/' . pathinfo($file_name, PATHINFO_FILENAME) . '.jpg';
                        $imagick->writeImage($new_file_name);
                        $imagick->clear();
                        $imagick->destroy();
                    }

                    $image[] = $this->upload->data('file_name');
                }
            }

            if ($jumlahMedia > 1) {
                $media = json_encode($image);
            } else {
                $media = $image[0];
            }
        }

        $cekSet = $this->SettingsModel->getOneSet(['id_menu' => $idMenu]);
        $h1Value = $this->input->post("judul_h1_$idMenu");
        if (empty($cekSet)) {
            $data = [
                'id_menu' => $idMenu,
                'h1'      => $h1Value,
                'h3'      => $this->input->post("judul_h3_$idMenu"),
                'p'       => $this->input->post("ket_$idMenu"),
                'media'   => $media,
            ];

            $this->SettingsModel->insertSet($data);
        } else {
            $mediaData = json_decode($cekSet->media, true);
            if (is_array($mediaData)) {

                if (count($image) == 1) {
                    $mediaData[] = $image[0];
                } else {
                    $mediaData = array_merge($mediaData, $image);
                }
                $media = json_encode($mediaData);
            } else {

                if (count($image) == 1) {
                    $media = $image[0];
                } else {
                    $media = json_encode($image);
                }
            }

            $data = [
                'id_menu' => $idMenu,
                'h1'      => $h1Value,
                'h3'      => $this->input->post("judul_h3_$idMenu"),
                'p'       => $this->input->post("ket_$idMenu"),
                'media'   => $media,
            ];

            $this->SettingsModel->updateSet($cekSet->id_sethome, $data);
        }

        $this->session->set_flashdata('success', 'Pengaturan Homepage Berhasil Disimpan!');
        $this->kembali($redir);
    }

    /*-------------------------------------------------- Reset Maintenance --------------------------------------------------*/
    public function hapusMedia($media, $id)
    {
        $setHome = $this->SettingsModel->getOneSet(['id_sethome' => $id]);

        $dataMedia = json_decode($setHome->media, true);

        $newMediaArray = array();

        foreach ($dataMedia as $dm) {
            if ($media === $dm) {
                $file = pathinfo($media, PATHINFO_FILENAME);
                $file_path = FCPATH . 'assets/upload/media/' . $media;
                $file_gambar = FCPATH . 'assets/upload/media/' . $file . '.jpg';
                if (file_exists($file_path)) {
                    unlink($file_path);
                }

                if (file_exists($file_gambar)) {
                    unlink($file_gambar);
                }
            } else {
                $newMediaArray[] = $dm;
            }
        }

        $data = [
            'media' => json_encode($newMediaArray)
        ];
        $this->SettingsModel->updateSet($id, $data);
        $this->session->set_flashdata('success', 'Media Berhasil Dihapus');
        $ct = $this->uri->segment(2);
        $vw = $this->uri->segment(3);
        $redir = $ct . '/' . $vw;
        $this->kembali($redir);
    }

    /*-------------------------------------------------- Reset Maintenance --------------------------------------------------*/
    public function resetMaintenance()
    {
        $cekDataMainten = $this->SettingsModel->getOneMaintenance();

        if (empty($cekDataMainten)) {
            $data = [
                'id_maintenance' => 'mainten-1',
                'nama_website' => 'esema',
                'slogan_website' => 'Elektronik Assessment Management',
                'instansi' => 'Direktorat Peningkatan Mutu Tenaga Kesehatan',
                'logo' => 'esema.svg',
                'favicon' => 'fav-esema.svg',
                'api_otp' => 'aknQzS2#y8Yx-#9+U68F',
            ];

            $this->SettingsModel->insertMaintenance($data);
        } else {
            $data = [
                'nama_website' => 'esema',
                'slogan_website' => 'Elektronik Assessment Management',
                'instansi' => 'Direktorat Peningkatan Mutu Tenaga Kesehatan',
                'logo' => 'esema.svg',
                'favicon' => 'fav-esema.svg',
                'api_otp' => 'aknQzS2#y8Yx-#9+U68F',
            ];

            if ($cekDataMainten->logo !== 'esema.svg') {
                $path = './assets/upload/logo/' . $cekDataMainten->logo;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            if ($cekDataMainten->favicon !== 'fav-esema.svg') {
                $path = './assets/upload/logo/' . $cekDataMainten->favicon;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $this->SettingsModel->updateMaintenance($data);
        }

        $redir = $this->uri->segment(2) . '/' . $this->uri->segment(3);

        $this->session->set_flashdata('success', 'Data Berhasil Diperbaharui!');
        $this->kembali($redir);
    }

    /*-------------------------------------------------- Update Maintenance --------------------------------------------------*/
    public function updateMaintenance()
    {
        $cekDataMainten = $this->SettingsModel->getOneMaintenance();
        $oldLogo = $cekDataMainten->logo;
        $oldFavicon = $cekDataMainten->favicon;
        $redir = $this->input->post('redir');

        $config['upload_path']          = './assets/upload/logo/';
        $config['allowed_types']        = 'jpeg|jpg|png|svg';
        $config['max_size']             = 1024;
        $config['file_name']            = 'logo' . time();

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('logo')) {
            if ($cekDataMainten->logo !== 'esema.svg') {
                $path = './assets/upload/logo/' . $cekDataMainten->logo;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $logo = $this->upload->data('file_name');
        } else {
            $logo = $oldLogo;
        }

        if ($this->upload->do_upload('favication')) {
            if ($cekDataMainten->favicon !== 'fav-esema.svg') {
                $path = './assets/upload/logo/' . $cekDataMainten->favicon;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $favication = $this->upload->data('file_name');
        } else {
            $favication = $oldFavicon;
        }

        $data = [
            'nama_website' => $this->input->post('nama_web'),
            'slogan_website' => $this->input->post('slogan_web'),
            'instansi' => $this->input->post('institusi'),
            'logo' => $logo,
            'favicon' => $favication,
            'api_otp' => $this->input->post('api_otp'),
        ];

        $this->SettingsModel->updateMaintenance($data);


        $this->session->set_flashdata('success', 'Data Berhasil Diperbaharui!');
        $this->kembali($redir);
    }

    /*-------------------------------------------------- Tambah Role Akses --------------------------------------------------*/
    public function tambahRole()
    {
        $cekRowRole = $this->SettingsModel->totRowRole();
        $redir = $this->input->post('redir');

        if (empty($cekRowRole)) {
            $id = 1;
        } else {
            $id = $cekRowRole + 1;
        }

        $nama_role = $this->input->post('role');
        $slug = strtolower(url_title($nama_role));
        $cekSlugRole = $this->SettingsModel->getOneRole(['slug' => $slug]);

        $data = [
            'id_role' => 'role-' . $id,
            'nama_role' => $nama_role,
            'slug' => $slug
        ];

        if (!$cekSlugRole) {
            $this->SettingsModel->insertRole($data);
            $this->session->set_flashdata('success', 'Role ' . $nama_role . ' Berhasil Ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Role Sudah Ada');
        }

        $this->kembali($redir);
    }

    /*-------------------------------------------------- Edit Role Akses --------------------------------------------------*/
    public function editRole($id)
    {
        $cekDataRole = $this->SettingsModel->getOneRole(['id_role' => $id]);
        $redir = $this->input->post('redir');

        $nama_role = $this->input->post('role');
        $slug = strtolower(url_title($nama_role));
        $cekSlugRole = $this->SettingsModel->getOneRole(['slug' => $slug]);

        $data = [
            'nama_role' => $nama_role,
            'slug' => $slug
        ];

        if (!$cekSlugRole) {
            $this->SettingsModel->updateRole($id, $data);
            $this->session->set_flashdata('success', 'Role ' . $cekDataRole->nama_role . ' Berhasil Diperbaharui!');
        } else {
            $this->session->set_flashdata('error', 'Role Sudah Ada');
        }

        $this->kembali($redir);
    }

    /*-------------------------------------------------- Beri Role Akses --------------------------------------------------*/
    public function beriAkses($id_role, $id_menu, $id_submenu)
    {
        if ($id_submenu == '0') {
            $submenu = '';
        } else {
            $submenu = $id_submenu;
        }

        $data = [
            'id_role' => $id_role,
            'id_menu' => $id_menu,
            'id_submenu' => $submenu
        ];

        $cekAkses = $this->SettingsModel->cekAkses($id_role, $id_menu, $submenu);

        if (empty($cekAkses)) {
            $this->SettingsModel->insertAkses($data);
            $response = ['status' => 'success', 'message' => 'Akses berhasil diberikan'];
        } else {
            $this->SettingsModel->deleteAkses($data);
            $response = ['status' => 'success', 'message' => 'Akses berhasil dicabut'];
        }

        echo json_encode($response);
    }

    /*-------------------------------------------------- Tambah Data Skala --------------------------------------------------*/
    public function tambahSkala()
    {
        $cekSkala = $this->MasterDataModel->getOneSkala(['range_skala' => 5]);
        $nama_skala = $this->input->post('nama_skala');
        $range_skala = $this->input->post('range_skala');
        $median_skala = $this->input->post('median_skala');
        $redir = $this->input->post('redir');

        if (empty($cekSkala)) {
            $labels_d = [
                $this->input->post('label_d1'),
                $this->input->post('label_d2'),
                $this->input->post('label_d3'),
                $this->input->post('label_d4'),
                $this->input->post('label_d5')
            ];
            $labels_i = [
                $this->input->post('label_i1'),
                $this->input->post('label_i2'),
                $this->input->post('label_i3'),
                $this->input->post('label_i4'),
                $this->input->post('label_i5')
            ];
            $labels_f = [
                $this->input->post('label_f1'),
                $this->input->post('label_f2'),
                $this->input->post('label_f3'),
                $this->input->post('label_f4'),
                $this->input->post('label_f5')
            ];
            $skala_d = json_encode($labels_d);
            $skala_i = json_encode($labels_i);
            $skala_f = json_encode($labels_f);
        } else {
            $skala_d = json_encode($this->input->post('skala_d'));
            $skala_i = json_encode($this->input->post('skala_i'));
            $skala_f = json_encode($this->input->post('skala_f'));
        }

        $cekData = $this->MasterDataModel->totRowSkala();
        $cekDataSkala = $this->MasterDataModel->getOneSkala(['nama_skala' => $nama_skala]);

        if (empty($cekData)) {
            $id = 1;
        } else {
            $id = $cekData + 1;
        }

        $data = [
            'id_skala' => 'skala-' . $id,
            'nama_skala' => $nama_skala,
            'range_skala' => $range_skala,
            'skala_d' => $skala_d,
            'skala_i' => $skala_i,
            'skala_f' => $skala_f,
        ];

        if (!$cekDataSkala) {
            $this->MasterDataModel->insertSkala($data);
            $this->session->set_flashdata('success', 'Skala Berhasil Ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Skala Sudah Ada!');
        }

        $this->kembali($redir);
    }

    /*-------------------------------------------------- Update Data Skala --------------------------------------------------*/
    public function updateSkala($idSkala)
    {
        $nama_skala_edit = $this->input->post('nama_skala_edit');
        $range_skala_edit = $this->input->post('range_skala_edit');
        $skala_d_edit = json_encode($this->input->post('skala_d_edit'));
        $skala_i_edit = json_encode($this->input->post('skala_i_edit'));
        $skala_f_edit = json_encode($this->input->post('skala_f_edit'));
        $redir = $this->input->post('redir');

        $cekDataSkala = $this->MasterDataModel->getOneSkala(['nama_skala' => $nama_skala_edit]);

        if (empty($range_skala_edit) || $range_skala_edit == 0) {
            $ranges = 5;
        } else {
            $ranges = $range_skala_edit;
        }

        if (!$cekDataSkala) {
            $data = [
                'nama_skala' => $nama_skala_edit,
                'range_skala' => $ranges,
                'skala_d' => $skala_d_edit,
                'skala_i' => $skala_i_edit,
                'skala_f' => $skala_f_edit,
            ];

            $this->MasterDataModel->updateSkala($idSkala, $data);
            $this->session->set_flashdata('success', 'Skala Berhasil Diperbaharui!');
        } else {
            $data = [
                'range_skala' => $ranges,
                'skala_d' => $skala_d_edit,
                'skala_i' => $skala_i_edit,
                'skala_f' => $skala_f_edit,
            ];

            $this->MasterDataModel->updateSkala($idSkala, $data);
            $this->session->set_flashdata('success', 'Skala Berhasil Diperbaharui! Namun Nama Skala Tidak Berubah Karena Sudah Ada!');
        }
        $this->kembali($redir);
    }

    /*-------------------------------------------------- Tambah Data Jabfung --------------------------------------------------*/
    public function tambahJabfung()
    {
        $nama_jabfung = $this->input->post('nama_jabfung');
        $slug_jabfung = strtolower(url_title($nama_jabfung));
        $nama_jenjang = $this->input->post('nama_jenjang');
        $redir = 'master-data/data-jabfung/' . $slug_jabfung . '/instrumen';
        $cekData = $this->MasterDataModel->getOneJabfung(['slug_jabfung' => $slug_jabfung]);

        $cekRowJabfung = $this->MasterDataModel->totRowJabfung();
        $cekRowJenjang = $this->MasterDataModel->totRowJenjang();

        $id_jabfung = 'jf-' . ($cekRowJabfung + 1);

        $data = [
            'id_jabfung' => $id_jabfung,
            'nama_jabfung' => $nama_jabfung,
            'slug_jabfung' => $slug_jabfung,
        ];

        if (!$cekData) {
            $this->MasterDataModel->insertJabfung($data);
            $lastJenjangNumber = $cekRowJenjang + 1;

            foreach ($nama_jenjang as $index => $nama) {
                $slug_jenjang = strtolower(url_title($nama));
                $id_jenjang = 'jj-' . ($lastJenjangNumber + $index);

                if ($nama == 'Tambah Lainnya') {
                    $nama_jenjang_new = $this->input->post('nama_jenjang_new')[$index];
                } else {
                    $nama_jenjang_new = $nama;
                }

                $datar = [
                    'id_jenjang' => $id_jenjang,
                    'id_jabfung' => $id_jabfung,
                    'nama_jenjang' => $nama_jenjang_new,
                    'slug_jenjang' => $slug_jenjang,
                ];

                $cekDataJenjang = $this->MasterDataModel->getOneJenjang(['id_jabfung' => $id_jabfung, 'slug_jenjang' => $slug_jenjang]);
                if (!$cekDataJenjang) {
                    $this->MasterDataModel->insertJenjang($datar);
                }
            }

            $this->session->set_flashdata('success', 'Jabatan Fungsional Berhasil Ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Jabatan Fungsional Sudah Ada!');
        }

        $this->kembali($redir);
    }

    /*-------------------------------------------------- View Data Instrumen Jabfung --------------------------------------------------*/
    public function dataInstrumen()
    {
        $pathView = 'admin/views/instrumen.php';

        if (file_exists(APPPATH . 'views/' . $pathView)) {
            $data = $this->data('instrumen');
            $this->load_views('instrumen', $data);
        } else {
            $this->session->set_flashdata('error', 'Halaman Tidak Ditemukan');
            redirect(base_url());
        }
    }

    /*-------------------------------------------------- Tambah Data Instrumen Jabfung --------------------------------------------------*/
    public function tambahInstrumen()
    {
        $instrumen = json_decode($this->input->post('instrumen'));
        $jenjang = $this->input->post('id_jenjang');
        $id = $this->input->post('id_jabfung');

        $cekRowInstrumen = $this->MasterDataModel->totRowInstrumen();
        $highestInstrumen = $this->MasterDataModel->getHighestInstrumen();
        $highestNumber = intval(substr($highestInstrumen, 4));

        $newNumber = max($highestNumber + 1, $cekRowInstrumen + 1);
        $newId = 'itr-' . $newNumber;

        foreach ($instrumen as $item) {
            if (!empty($item->instrumen)) {
                $newNumber = $highestNumber + 1;
                $newId = 'itr-' . $newNumber;

                while ($this->MasterDataModel->isInstrumenExists($newId)) {
                    $newNumber++;
                    $newId = 'itr-' . $newNumber;
                }

                $data = [
                    'id_instrumen' => $newId,
                    'id_jenjang' => $jenjang,
                    'instrumen' => $item->instrumen
                ];

                $this->MasterDataModel->insertInstrumen($data);

                $highestNumber = $newNumber;
            }
        }

        $this->session->set_flashdata('success', 'Instrumen Berhasil Disimpan!');

        $redir = 'master-data/data-jabfung/' . $id . '/instrumen';

        $this->kembali($redir);
    }

    /*-------------------------------------------------- Update Data Instrumen Jabfung --------------------------------------------------*/
    public function editInstrumen($idInstrumen)
    {
        $instrumen = $this->input->post('instrumen');
        $id = $this->input->post('id_jabfung');

        $data = [
            'instrumen' => $instrumen
        ];

        $this->MasterDataModel->updateInstrumen($idInstrumen, $data);

        $this->session->set_flashdata('success', 'Instrumen Berhasil Dipebaharui!');
        $uri2 = $this->uri->segment(2);
        $uri3 = $this->uri->segment(3);
        $uri4 = $this->uri->segment(4);
        $redir = $uri2 . '/' . $uri3 . '/' . $id . '/' . $uri4;
        $this->kembali($redir);
    }

    /*-------------------------------------------------- Hapus Data Instrumen Jabfung --------------------------------------------------*/
    public function hapusInstrumen($id_jabfung, $idInstrumen)
    {
        $id = $id_jabfung;

        $this->MasterDataModel->deleteInstrumen($idInstrumen);

        $this->session->set_flashdata('success', 'Instrumen Berhasil Dihapus!');

        $uri2 = $this->uri->segment(2);
        $uri3 = $this->uri->segment(3);
        $uri5 = $this->uri->segment(5);
        $redir = $uri2 . '/' . $uri3 . '/' . $id . '/' . $uri5;

        $this->kembali($redir);
    }

    /*-------------------------------------------------- Update Data Jabfung --------------------------------------------------*/
    public function editJabfung($idJabfung)
    {
        $nama_jabfung = $this->input->post('nama_jabfung');
        $slug_jabfung = strtolower(url_title($nama_jabfung));
        $redir = $this->input->post('redir');
        $cekData = $this->MasterDataModel->getOneJabfung(['slug_jabfung' => $slug_jabfung]);

        $data = [
            'nama_jabfung' => $nama_jabfung,
            'slug_jabfung' => $slug_jabfung,
        ];

        if (!$cekData) {
            $this->MasterDataModel->updateJabfung($idJabfung, $data);
            $this->session->set_flashdata('success', 'Jabatan Fungsional Berhasil Ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Jabatan Fungsional Sudah Ada!');
        }

        $this->kembali($redir);
    }

    /*-------------------------------------------------- Tambah Data Jenjang --------------------------------------------------*/
    public function tambahJenjang()
    {
        $nama_jenjang = $this->input->post('nama_jenjang');
        $slug_jenjang = strtolower(url_title($nama_jenjang));
        $id_jabfung = $this->input->post('jabfung');
        $redir = $this->input->post('redir');
        $cekData = $this->MasterDataModel->getOneJenjang(['id_jabfung' => $id_jabfung, 'slug_jenjang' => $slug_jenjang]);
        $cekJabfung = $this->MasterDataModel->getOneJabfung(['id_jabfung' => $id_jabfung]);

        $rowJenjang = $this->MasterDataModel->totRowJenjang();

        $id_jenjang = $rowJenjang + 1;

        $data = [
            'id_jenjang' => $id_jenjang,
            'id_jabfung' => $id_jabfung,
            'nama_jenjang' => $nama_jenjang,
            'slug_jenjang' => $slug_jenjang,
        ];

        if (!$cekData) {
            $this->MasterDataModel->insertJenjang($data);
            $this->session->set_flashdata('success', 'Jenjang Jabatan Berhasil Ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Jenjang ' . $nama_jenjang . ' Pada Jabatan Fungsional ' . $cekJabfung->nama_jabfung . ' Sudah Ada!');
        }

        $this->kembali($redir);
    }

    /*-------------------------------------------------- Edit Data Jenjang --------------------------------------------------*/
    public function editJenjang($idJenjang, $idJabfung)
    {
        $nama_jenjang = $this->input->post('nama_jenjang');
        $slug_jenjang = strtolower(url_title($nama_jenjang));
        $redir = $this->input->post('redir');

        $cekData = $this->MasterDataModel->getOneJenjang(['id_jabfung' => $idJabfung, 'slug_jenjang' => $slug_jenjang]);
        $cekJabfung = $this->MasterDataModel->getOneJabfung(['id_jabfung' => $idJabfung]);

        $data = [
            'nama_jenjang' => $nama_jenjang,
            'slug_jenjang' => $slug_jenjang,
        ];

        if (!$cekData) {
            $this->MasterDataModel->updateJenjang($idJenjang, $data);
            $this->session->set_flashdata('success', 'Jenjang ' . $nama_jenjang . ' Berhasil Disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Maaf Jenjang ' . $nama_jenjang . ' Pada Jabatan Fungsional ' . $cekJabfung->nama_jabfung . ' Sudah Ada!');
        }

        $this->kembali($redir);
    }

    /*-------------------------------------------------- Tambah Data Rumah Jabatan --------------------------------------------------*/
    public function simpanRumah()
    {
        $redir = $this->input->post('redir');
        $nama_rumah_json = $this->input->post('nama_rumah');
        $nama_rumah = json_decode($nama_rumah_json, true);

        if (!empty($nama_rumah)) {
            foreach ($nama_rumah as $rumah) {
                $nama_rumah = trim($rumah);

                if (!empty($nama_rumah)) {
                    $slug = strtolower(url_title($nama_rumah));
                    $highestRumah = $this->MasterDataModel->getHighestRumah();
                    $highestNumber = intval(substr($highestRumah, 3));
                    $newNumber = $highestNumber + 1;
                    $newId = 'rj-' . $newNumber;

                    while ($this->MasterDataModel->isRumahExists($newId)) {
                        $newNumber++;
                        $newId = 'rj-' . $newNumber;
                    }

                    $data = [
                        'id_rumah' => $newId,
                        'nama_rumah' => $nama_rumah,
                        'slug_rumah' => $slug,
                    ];

                    $cekDataRumah = $this->MasterDataModel->getOneRumah(['slug_rumah' => $slug]);

                    if (!$cekDataRumah) {
                        $this->MasterDataModel->insertRumah($data);
                        $highestNumber = $newNumber;
                    }
                }
            }

            $this->session->set_flashdata('success', 'Rumah Jabatan berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Data rumah kosong atau tidak valid!');
        }

        $this->kembali($redir);
    }

    /*-------------------------------------------------- Update Data Rumah --------------------------------------------------*/
    public function updateRumah($id)
    {
        $redir = $this->input->post('redir');

        $nama_rumah = $this->input->post('nama_rumah');

        $slug_rumah = strtolower(url_title($nama_rumah));

        $data = [
            'nama_rumah' => $nama_rumah,
            'slug_rumah' => $slug_rumah,
        ];

        $cekDataRumah = $this->MasterDataModel->getOneRumah(['slug_rumah' => $slug_rumah]);
        if (!$cekDataRumah) {
            $this->MasterDataModel->updateRumah($id, $data);
            $this->session->set_flashdata('success', 'Rumah Jabatan ' . $nama_rumah . ' Berhasil Ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Rumah Jabatan ' . $nama_rumah . ' Sudah Ada!');
        }
        $this->kembali($redir);
    }

    /*-------------------------------------------------- Tambah Data User --------------------------------------------------*/
    public function tambahUser()
    {
        $tipe = $this->input->post('tipe_data');
        $redir = $this->input->post('redir');
        $data_api = $this->input->post('data_api');
        $dataManual = json_decode($this->input->post('data_manual'));

        $cekRowUser = $this->MasterDataModel->totRowUser();
        $highestUser = $this->MasterDataModel->getHighestUser();
        $highestNumber = intval(substr($highestUser, 4));

        if ($tipe == 'manual') {
            foreach ($dataManual as $item) {
                if (!empty($item->nik)) {
                    $newNumber = max($highestNumber + 1, $cekRowUser + 1);
                    $id_user = 'usr-' . $newNumber;

                    while ($this->MasterDataModel->isUserExists($id_user)) {
                        $newNumber++;
                        $id_user = 'usr-' . $newNumber;
                    }

                    $getOneRole = $this->SettingsModel->getOneRole(['slug' => $item->role]);

                    $data = [
                        'id_user' => $id_user,
                        'nama' => $item->nama,
                        'nik' => $item->nik,
                        'no_hp' => $item->whatsapp,
                        'is_active' => 'Aktif',
                    ];

                    $this->MasterDataModel->insertUser($data);
                    $this->session->set_flashdata('success', 'Data User Berhasil Ditambahkan!');

                    $highestNumber = $newNumber;
                }
            }
        } else {
            $cekAPI = $this->MasterDataModel->getOneApi(['id_api' => 'eaus-1']);
            if (empty($cekAPI)) {
                $data = [
                    'id_api' => 'eaus-1',
                    'api' => $data_api
                ];
                $this->MasterDataModel->insertApi($data);
                $this->session->set_flashdata('success', 'URL API Berhasil Ditambahkan!');
            } else {
                $data = [
                    'api' => $data_api
                ];
                $this->MasterDataModel->updateApi('eaus-1', $data);
                $this->session->set_flashdata('success', 'URL API Berhasil Diperbaharui!');
            }
        }

        $this->kembali($redir);
    }

    /*-------------------------------------------------- Update Data User --------------------------------------------------*/
    public function updateDataUser($id)
    {
        $redir = $this->input->post('redir');
        $no_hp = $this->input->post('no_hp');
        $id_role = $this->input->post('id_role');

        $cekData = $this->MasterDataModel->getOneUser(['id_user' => $id]);

        $data = [
            'no_hp' => $no_hp,
            'id_role' => $id_role,
        ];

        $this->MasterDataModel->updateUser($id, $data);
        $this->session->set_flashdata('success', 'Data ' . $cekData->nama . ' Berhasil Diperbaharui!');
        $this->kembali($redir);
    }

    /*-------------------------------------------------- Get Jenjang --------------------------------------------------*/
    public function getJenjang($idJabfung)
    {
        $data_jenjang = $this->MasterDataModel->getAllJenjang(['id_jabfung' => $idJabfung]);
        $json_response = json_encode($data_jenjang);
        header('Content-Type: application/json');
        echo $json_response;
    }

    public function itemJenjang($idJabfung)
    {
        $data_jenjang = $this->MasterDataModel->getAllJenjang(['id_jabfung' => $idJabfung]);
        $json_response = json_encode($data_jenjang);
        header('Content-Type: application/json');
        echo $json_response;
    }

    /*-------------------------------------------------- Tambah Pangkat --------------------------------------------------*/
    public function tambahPangkat()
    {
        $redir = $this->input->post('redir');
        $pangkat = $this->input->post('pangkat');
        $golongan = $this->input->post('golongan');
        $slug_pangkat = strtolower(url_title($pangkat));

        $data = [
            'pangkat' => $pangkat,
            'golongan' => $golongan,
            'slug_pangkat' => $slug_pangkat,
        ];

        $this->MasterDataModel->insertPangkat($data);
        $this->session->set_flashdata('success', 'Pangkat ' . $pangkat . ' Berhasil Ditambahkan!');
        $this->kembali($redir);
    }

    /*-------------------------------------------------- Update Pangkat --------------------------------------------------*/
    public function updatePangkat($id)
    {
        $redir = $this->input->post('redir');
        $pangkat = $this->input->post('pangkat');
        $golongan = $this->input->post('golongan');
        $slug_pangkat = strtolower(url_title($pangkat));

        $data = [
            'pangkat' => $pangkat,
            'golongan' => $golongan,
            'slug_pangkat' => $slug_pangkat,
        ];

        $cekData = $this->MasterDataModel->getOnePangkat($data);

        if (!$cekData) {
            $this->MasterDataModel->updatePangkat($id, $data);
            $this->session->set_flashdata('success', 'Pangkat ' . $pangkat . ' Berhasil Diperbaharui!');
        } else {
            $this->session->set_flashdata('error', 'Pangkat ' . $pangkat . ' Sudah Ada!');
        }

        $this->kembali($redir);
    }

    /*-------------------------------------------------- Form TNA --------------------------------------------------*/
    public function formTNA()
    {
        $pathView = 'admin/views/form-tna.php';

        if (file_exists(APPPATH . 'views/' . $pathView)) {
            $data = $this->data('form-tna');
            $this->load_views('form-tna', $data);
        } else {
            $this->session->set_flashdata('error', 'Halaman Tidak Ditemukan');
            redirect(base_url());
        }
    }

    /*-------------------------------------------------- Tambah TNA --------------------------------------------------*/
    public function tambahTNA($idRumah)
    {
        $id_instrumen = json_encode($this->input->post('pil_instrumen'));
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_selesai = $this->input->post('tgl_selesai');
        $min_respon = $this->input->post('min_respon');
        $id_jabfung = $this->input->post('id_jabfung');
        $id_jenjang = $this->input->post('id_jenjang');
        $id_skala = $this->input->post('jenis_skala');
        $keterangan = $this->input->post('keterangan');

        $cekRow = $this->TNAModel->totRowTNA();

        $id_tna = ($cekRow + 1) . $id_jabfung . '-' . $id_jenjang . '-' . $idRumah;
        $jabfung = $this->MasterDataModel->getOneJabfung(['id_jabfung' => $id_jabfung]);
        $jenjang = $this->MasterDataModel->getOneJenjang(['id_jenjang' => $id_jenjang]);
        $rumah = $this->MasterDataModel->getOneRumah(['id_rumah' => $idRumah]);
        $tahun = date('Y');

        $judul_tna = 'TNA Jabatan Fungsional ' . $jabfung->nama_jabfung . ' ' . $jenjang->nama_jenjang . ' (Rumah Jabatan: ' . $rumah->nama_rumah . ') Tahun ' . $tahun;
        $slug = strtolower(url_title($judul_tna));

        $data = [
            'id_tna' => $id_tna,
            'judul_tna' => $judul_tna,
            'slug' => $slug,
            'id_jabfung' => $id_jabfung,
            'id_jenjang' => $id_jenjang,
            'id_rumah' => $idRumah,
            'id_instrumen' => $id_instrumen,
            'id_skala' => $id_skala,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
            'min_respon' => $min_respon,
            'tgl_create' => date('y-m-d'),
            'keterangan' => $keterangan,
            'status' => 'Belum Tervalidasi',
        ];

        $cekTNA = $this->TNAModel->getOneTNA(['slug' => $slug]);

        if (!$cekTNA) {
            $this->TNAModel->insertTNA($data);
        }
    }

    /*-------------------------------------------------- Update TNA --------------------------------------------------*/
    public function updateTNA()
    {
        $redir = $this->input->post('redir');
        $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
        $this->kembali($redir);
    }

    /*--------------------------------------------------Get Soal --------------------------------------------------*/
    public function getRekom()
    {
        $id_tna = $this->input->post('id_tna');
        $jenis_soal = $this->input->post('jenis_soal');
        $jumlah_soal = 1;

        $cekTNA = $this->TNAModel->getOneTNA(['id_tna' => $id_tna]);
        if (!$cekTNA) {
            http_response_code(404);
            echo json_encode(['message' => 'Data TNA tidak ditemukan']);
            return;
        }
        $id_instrumen_array = json_decode($cekTNA->id_instrumen, true);

        if (!is_array($id_instrumen_array)) {
            http_response_code(500);
            echo json_encode(['message' => 'Gagal mendapatkan instrumen dari TNA']);
            return;
        }

        $rekomendasi = [];

        foreach ($id_instrumen_array as $id_instrumen) {
            $instrumen = $this->MasterDataModel->getOneInstrumen(['id_instrumen' => $id_instrumen]);

            if (!$instrumen) {
                continue;
            }

            $kata_kata = explode(" ", $instrumen->instrumen);

            switch ($jenis_soal) {
                case 'pertanyaan':
                    for ($i = 0; $i < $jumlah_soal; $i++) {
                        $rekomendasi[] = "Instrumen " . $id_instrumen . " | Tingkat Kesulitan: " . $this->generatePertanyaan($kata_kata, "Sulit");
                    }

                    for ($i = 0; $i < $jumlah_soal; $i++) {
                        $rekomendasi[] = "Instrumen " . $id_instrumen . " | Tingkat Kepentingan: " . $this->generatePertanyaan($kata_kata, "Penting");
                    }

                    for ($i = 0; $i < $jumlah_soal; $i++) {
                        $rekomendasi[] = "Instrumen " . $id_instrumen . " | Tingkat Keseringan: " . $this->generatePertanyaan($kata_kata, "Sering");
                    }
                    break;
                case 'pernyataan':
                    for ($i = 0; $i < $jumlah_soal; $i++) {
                        $rekomendasi[] = "Instrumen " . $id_instrumen . " | Tingkat Kesulitan: " . $this->generatePernyataan($kata_kata, "Sulit");
                    }

                    for ($i = 0; $i < $jumlah_soal; $i++) {
                        $rekomendasi[] = "Instrumen " . $id_instrumen . " | Tingkat Kepentingan: " . $this->generatePernyataan($kata_kata, "Penting");
                    }

                    for ($i = 0; $i < $jumlah_soal; $i++) {
                        $rekomendasi[] = "Instrumen " . $id_instrumen . " | Tingkat Keseringan: " . $this->generatePernyataan($kata_kata, "Sering");
                    }
                    break;
                default:
                    http_response_code(400);
                    echo json_encode(['message' => 'Jenis soal tidak valid']);
                    return;
            }
        }

        echo json_encode($rekomendasi);
    }

    /*-------------------------------------------------- Simpan Soal --------------------------------------------------*/
    public function simpanSoal($id_instrumen)
    {
        $id_tna = $this->input->post('id_tna');
        $id_instrumen = $id_instrumen;
        $sulitTexts = $this->input->post('sulitTexts');
        $pentingTexts = $this->input->post('pentingTexts');
        $seringTexts = $this->input->post('seringTexts');

        $sulitTexts = implode("\n", $sulitTexts);
        $pentingTexts = implode("\n", $pentingTexts);
        $seringTexts = implode("\n", $seringTexts);

        $cekRow = $this->TNAModel->totRowSoal();

        $id_soal = 'soal-' . ($cekRow + 1);

        $data = [
            'id_soal' => $id_soal,
            'id_tna' => $id_tna,
            'id_instrumen' => $id_instrumen,
            'soal_d' => $sulitTexts,
            'soal_i' => $pentingTexts,
            'soal_f' => $seringTexts,
        ];

        $result = $this->TNAModel->insertSoal($data);

        if ($result) {
            echo json_encode(array('status' => 'success', 'message' => 'Data berhasil disimpan'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Gagal menyimpan data'));
        }
    }

    /*-------------------------------------------------- Responden TNA --------------------------------------------------*/
    public function detailRespon($tna, $responden)
    {
        $pathView = 'admin/views/detail-responden.php';

        if (file_exists(APPPATH . 'views/' . $pathView)) {
            $nama = ucwords(str_replace("-", " ", $responden));
            $nama = preg_replace_callback('/\b(\w)(\w*)\b/', function ($matches) {
                return strtoupper($matches[1]) . strtolower($matches[2]);
            }, $nama);
            $items = [
                'itemTNA' => $this->TNAModel->getOneTNA(['slug' => $tna]),
                'itemUser' => $this->TNAModel->getOneTNA(['nama' => $nama]),
            ];

            $additionalData = $this->data('detail-responden');
            $data = array_merge($items, $additionalData);

            $this->load_views('detail-responden', $data);
        } else {
            $segment2 = $this->uri->segment(2);
            $segment3 = $this->uri->segment(3);
            $redir = $segment2 . '/' . $segment3;
            $this->session->set_flashdata('error', 'Halaman Tidak Ditemukan');
            $this->kembali($redir);
        }
    }


    /*-------------------------------------------------- Reload TNA --------------------------------------------------*/
    public function reloadTNA()
    {
        $id_tna = $this->input->post('id_tna');
        $status = $this->input->post('status');

        $data = [
            'status' => $status
        ];

        $this->TNAModel->updateTNA($id_tna, $data);
    }

    /*-------------------------------------------------- Hapus TNA --------------------------------------------------*/
    public function hapusTNA($id_tna)
    {
        $uri2 = $this->uri->segment(2);
        $uri3 = $this->uri->segment(3);
        $redir = $uri2 . '/' . $uri3;
        $this->TNAModel->deleteTNA($id_tna);
        $this->session->set_flashdata('success', 'Data Berhasil Di Hapus');
        $this->kembali($redir);
    }

    /*-------------------------------------------------- Edit TNA --------------------------------------------------*/
    public function editTNA($id_tna)
    {
        $redir = $this->input->post('redir');
        $judul_tna = $this->input->post('judul_tna');
        $id_jabfung = $this->input->post('id_jabfung');
        $id_jenjang = $this->input->post('id_jenjang');
        $id_rumah = $this->input->post('id_rumah');
        $id_skala = $this->input->post('id_skala');
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_selesai = $this->input->post('tgl_selesai');
        $min_respon = $this->input->post('min_respon');
        $keterangan = $this->input->post('keterangan');
        $status = $this->input->post('status');

        $data = [
            'judul_tna' => $judul_tna,
            'id_jabfung' => $id_jabfung,
            'id_jenjang' => $id_jenjang,
            'id_rumah' => $id_rumah,
            'id_skala' => $id_skala,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
            'min_respon' => $min_respon,
            'keterangan' => $keterangan,
            'status' => $status,
        ];

        $this->TNAModel->updateTNA($id_tna, $data);
        $this->session->set_flashdata('success', 'Data TNA Berhasil Diperbaharui!');
        $this->kembali($redir);
    }


    /*-------------------------------------------------- Kuesioner --------------------------------------------------*/
    public function kuesioner($slug)
    {
        $pathView = 'admin/views/form-kuesioner.php';

        if (file_exists(APPPATH . 'views/' . $pathView)) {
            $data = $this->data($slug);
            $this->load_views('form-kuesioner', $data);
        } else {
            $segment2 = $this->uri->segment(2);
            $segment3 = $this->uri->segment(3);
            $redir = $segment2 . '/' . $segment3;
            $this->session->set_flashdata('error', 'Halaman Tidak Ditemukan');
            $this->kembali($redir);
        }
    }


    /*-------------------------------------------------- Simpan Jawaban --------------------------------------------------*/
    public function simpanJawaban()
    {
        $cekUser = $this->MasterDataModel->getOneUser(['nik' => $this->session->userdata('nik')]);
        $nik = $cekUser->nik;

        $id_tna = $this->input->post('id_tna');
        $id_soal = $this->input->post('id_soal');
        $jwb_d = $this->input->post('jwb_d') ?? 0;
        $jwb_i = $this->input->post('jwb_i') ?? 0;
        $jwb_f = $this->input->post('jwb_f') ?? 0;
        $total = ($jwb_d + $jwb_i + $jwb_f) / 3;
        $rekom = '';

        $oneTNA = $this->TNAModel->getOneTNA(['id_tna' => $id_tna]);
        $listSkala = $this->MasterDataModel->getOneSkala(['id_skala' => $oneTNA->id_skala]);
        $nilai = ($jwb_d + $jwb_i + $jwb_f) / (4 * $listSkala->range_skala);
        if ($nilai <= 0.2) {
            $rekom = 'Kompeten';
        } elseif ($nilai <= 0.5) {
            $rekom = 'Optional';
        } elseif ($nilai <= 0.6) {
            $rekom = 'Membutuhkan';
        } else {
            $rekom = 'Sangat Membutuhkan';
        }

        // if ($jwb_d >= $listSkala->median_skala && $jwb_i >= $listSkala->median_skala) {
        //     if (($jwb_d > $jwb_i && $jwb_d > $jwb_f) || ($jwb_d == $listSkala->range_skala && $jwb_i == $listSkala->range_skala && $jwb_f > 0)
        //     ) {
        //         $rekom = 'Sangat Membutuhkan';
        //     } elseif (($jwb_i > $jwb_d && $jwb_i > $jwb_f) || ($jwb_d == ($listSkala->range_skala - 1) && $jwb_i == ($listSkala->range_skala - 1) && $jwb_f > 0)) {
        //         $rekom = 'Membutuhkan';
        //     } elseif (($jwb_f > $jwb_d && $jwb_f > $jwb_i) || ($jwb_d == ($listSkala->range_skala - 2) && $jwb_i == ($listSkala->range_skala - 2) && $jwb_f > 0)) {
        //         $rekom = 'Agak Membutuhkan';
        //     } else {
        //         if ($total >= ($listSkala->range_skala - 0.5)) {
        //             $rekom = 'Sangat Membutuhkan';
        //         } elseif ($total >= ($listSkala->range_skala - 1.5)) {
        //             $rekom = 'Membutuhkan';
        //         } else {
        //             $rekom = 'Agak Membutuhkan';
        //         }
        //     }
        // } else {
        //     $rekom = 'Kompeten';
        // }

        $data = [
            'nik' => $nik,
            'id_tna' => $id_tna,
            'id_soal' => $id_soal,
            'jwb_d' => $jwb_d,
            'jwb_i' => $jwb_i,
            'jwb_f' => $jwb_f,
            'total' => $total,
            'rekom' => $rekom,
        ];

        $cekJawaban = $this->TNAModel->getOneKuesioner(['nik' => $nik, 'id_tna' => $id_tna, 'id_soal' => $id_soal]);
        if ($cekJawaban) {
            $this->TNAModel->updateKuesioner($cekJawaban->id, $data);
        } else {
            $this->TNAModel->insertKuesioner($data);
        }
    }


    /*-------------------------------------------------- Evaluasi --------------------------------------------------*/
    public function evaluasi()
    {
        $cekUser = $this->MasterDataModel->getOneUser(['nik' => $this->session->userdata('nik')]);
        $nik = $cekUser->nik;
        $id_tna = $this->input->post('id_tna');
        $kepuasan = $this->input->post('satisfaction');
        $saran = $this->input->post('saran');
        $kritik = $this->input->post('kritik');

        $data = [
            'nik' => $nik,
            'id_tna' => $id_tna,
            'kepuasan' => $kepuasan,
            'saran' => $saran,
            'kritik' => $kritik,
            'tgl' => date('Y-m-d'),
        ];

        $this->TNAModel->insertEvaluasi($data);

        $cekJawaban = $this->TNAModel->getAllKuesioner(['nik' => $nik, 'id_tna' => $id_tna]);

        $counts = [
            'Sangat Membutuhkan' => 0,
            'Membutuhkan' => 0,
            'Optional' => 0,
            'Kompeten' => 0
        ];

        foreach ($cekJawaban as $jawaban) {
            if (isset($counts[$jawaban->rekom])) {
                $counts[$jawaban->rekom]++;
            }
        }

        $maxCount = max($counts);
        $rekom = '';

        foreach ($counts as $rekomendasi => $count) {
            if ($rekomendasi !== 'Kompeten' && $count == $maxCount) {
                $rekom = $rekomendasi;
                break;
            } else {
                $rekom = 'Kompeten';
            }
        }

        if ($rekom !== 'Kompeten') {
            $rekoms = 'Peningkatan Kompetensi';
        } else {
            $rekoms = 'Kompeten';
        }

        $cekTNA = $this->TNAModel->getOneTNA(['id_tna' => $id_tna]);
        $id_jabfung = $cekTNA->id_jabfung;
        $id_jenjang = $cekTNA->id_jenjang;
        $id_rumah = $cekTNA->id_rumah;

        $datae = [
            'nik' => $nik,
            'id_tna' => $id_tna,
            'id_jabfung' => $id_jabfung,
            'id_jenjang' => $id_jenjang,
            'id_rumah' => $id_rumah,
            'rekom' => $rekoms,
            'tgl_validasi' => date('Y-m-d'),
        ];

        $this->TNAModel->insertRekom($datae);
        $this->session->set_flashdata('success', 'Data Anda Telah Tersimpan!');
        $this->kembali('settings/profile');
    }

    /*-------------------------------------------------- Get Data TNA --------------------------------------------------*/
    public function getDataTNA($slug)
    {
        $pathView = 'admin/views/view-data-tna.php';

        if (file_exists(APPPATH . 'views/' . $pathView)) {
            $data = $this->data($slug);
            $this->load_views('view-data-tna', $data);
        } else {
            $segment2 = $this->uri->segment(2);
            $segment3 = $this->uri->segment(3);
            $redir = $segment2 . '/' . $segment3;
            $this->session->set_flashdata('error', 'Halaman Tidak Ditemukan');
            $this->kembali($redir);
        }
    }

    /*-------------------------------------------------- Profile --------------------------------------------------*/
    public function updateProfile()
    {
        $cekUser = $this->MasterDataModel->getOneUser(['nik' => $this->session->userdata('nik')]);
        $redir = $this->input->post('redir');
        $nama = $this->input->post('nama');
        $slug = strtolower(url_title($nama));
        $gender = $this->input->post('gender');

        if ($gender == 'Pria') {
            $profile = 'pria.png';
        } else {
            $profile = 'wanita.png';
        }

        $config['upload_path']          = './assets/upload/profile/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 1024;
        $config['file_name']            = $cekUser->id_user . '_' . $slug;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('avatar')) {
            if (empty($cekUser->avatar)) {
                $avatar = $profile;
            } else {
                $avatar = $cekUser->avatar;
            }
        } else {
            if ($cekUser->avatar !== 'pria.png' && $cekUser->avatar !== 'wanita.png') {
                $path = './assets/upload/profile/' . $cekUser->avatar;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $avatar = $this->upload->data('file_name');
        }

        if ($cekUser->id_role == 'role-4') {
            $data = [
                'nama' => $this->input->post('nama'),
                'nip' => $this->input->post('nip'),
                'gender' => $this->input->post('gender'),
                'tmpt_lahir' => $this->input->post('tmpt_lahir'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp'),
                'avatar' => $avatar,
                'id_pangkat' => $this->input->post('golongan'),
                'id_jabfung' => $this->input->post('itemJabfung'),
                'id_jenjang' => $this->input->post('itemsJenjang'),
                'id_rumah' => $this->input->post('itemRumah'),
                'tmpt_kerja' => $this->input->post('tmpt_kerja'),
                'alamat_kerja' => $this->input->post('alamat_kerja'),
                'pdd_terakhir' => $this->input->post('pdd_terakhir'),
                'jurusan' => $this->input->post('jurusan'),
                'status_asn' => $this->input->post('status_asn'),
            ];
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'nip' => $this->input->post('nip'),
                'gender' => $this->input->post('gender'),
                'tmpt_lahir' => $this->input->post('tmpt_lahir'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'no_hp' => $this->input->post('no_hp'),
                'avatar' => $avatar,
            ];
        }

        $this->MasterDataModel->updateUser($cekUser->id_user, $data);
        $this->session->set_flashdata('success', 'Biodata Berhasil Diperbaharui!');
        $this->kembali($redir);
    }

    /*-------------------------------------------------- Export Excel --------------------------------------------------*/
    public function exportExcel($id)
    {

        $listKuesioner = $this->TNAModel->getAllKuesioner(['id_tna' => $id]);

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        $sheetKuesioner = $spreadsheet->getActiveSheet();
        $sheetKuesioner->setTitle('Data Kuesioner');

        $sheetKuesioner->setCellValue('A1', 'Nama Responden');
        $sheetKuesioner->setCellValue('B1', 'Instrumen');
        $sheetKuesioner->setCellValue('C1', 'Nilai D');
        $sheetKuesioner->setCellValue('D1', 'Nilai I');
        $sheetKuesioner->setCellValue('E1', 'Nilai F');
        $sheetKuesioner->setCellValue('F1', 'Rata-rata');
        $sheetKuesioner->setCellValue('G1', 'Keterangan');

        $row = 2;
        foreach ($listKuesioner as $item) {
            $sheetKuesioner->setCellValue('A' . $row, $item->nama);
            $sheetKuesioner->setCellValue('B' . $row, $item->instrumen);
            $sheetKuesioner->setCellValue('C' . $row, $item->jwb_d);
            $sheetKuesioner->setCellValue('D' . $row, $item->jwb_i);
            $sheetKuesioner->setCellValue('E' . $row, $item->jwb_f);
            $sheetKuesioner->setCellValue('F' . $row, $item->total);
            $sheetKuesioner->setCellValue('G' . $row, $item->rekom);
            $row++;
        }

        $sheetRekomendasi = $spreadsheet->createSheet();
        $sheetRekomendasi->setTitle('Data Rekomendasi');

        $sheetRekomendasi->setCellValue('A1', 'Nama Responden');
        $sheetRekomendasi->setCellValue('B1', 'Instrumen');
        $sheetRekomendasi->setCellValue('C1', 'Nilai D');
        $sheetRekomendasi->setCellValue('D1', 'Nilai I');
        $sheetRekomendasi->setCellValue('E1', 'Nilai F');
        $sheetRekomendasi->setCellValue('F1', 'Rata-rata');
        $sheetRekomendasi->setCellValue('G1', 'Nilai');
        $sheetRekomendasi->setCellValue('H1', 'Rekomendasi');

        $maxTotal = max(array_column($listKuesioner, 'total'));

        $row = 2;
        foreach ($listKuesioner as $item) {
            $nilai = ($item->total / $maxTotal) * 100;

            if ($nilai <= 20) {
                $rekomendasi = 'Seminar';
            } elseif ($nilai > 20 && $nilai <= 50) {
                $rekomendasi = 'Pelatihan';
            } else {
                $rekomendasi = 'Workshop';
            }

            $sheetRekomendasi->setCellValue('A' . $row, $item->nama);
            $sheetRekomendasi->setCellValue('B' . $row, $item->instrumen);
            $sheetRekomendasi->setCellValue('C' . $row, $item->jwb_d);
            $sheetRekomendasi->setCellValue('D' . $row, $item->jwb_i);
            $sheetRekomendasi->setCellValue('E' . $row, $item->jwb_f);
            $sheetRekomendasi->setCellValue('F' . $row, number_format($item->total, 2));
            $sheetRekomendasi->setCellValue('G' . $row, '(' . number_format($item->total, 2) . ' / ' . $maxTotal . ') x 100% = ' . number_format($nilai) . '%');
            $sheetRekomendasi->setCellValue('H' . $row, $rekomendasi);
            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'Data_' . $listKuesioner->judul_tna . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function getInstrumen($tahun, $idjabfung, $idjenjang, $idinstrumen, $idrumah)
    {
        $cekTNA = $this->TNAModel->getAllTNA([
            'id_jabfung' => $idjabfung,
            'id_jenjang' => $idjenjang,
            'id_rumah' => $idrumah,
            'YEAR(tgl_mulai)' => $tahun
        ]);

        $skor_d = [];
        $skor_i = [];
        $skor_f = [];

        foreach ($cekTNA as $tna) {
            $dataSkala = $this->MasterDataModel->getOneSkala(['id_skala' => $tna->id_skala]);
            $rangeSkala = range(1, $dataSkala->range_skala);
            $numSkala = count($rangeSkala);

            $skor_d = array_fill(0, $numSkala, 0);
            $skor_i = array_fill(0, $numSkala, 0);
            $skor_f = array_fill(0, $numSkala, 0);

            $idInstrumen = json_decode($tna->id_instrumen, true);
            if (in_array($idinstrumen, $idInstrumen)) {
                $dataSoal = $this->TNAModel->getAllSoal(['id_instrumen' => $idinstrumen]);

                $idSoalList = array_column($dataSoal, 'id_soal');

                $dataKuesioner = $this->TNAModel->getAllKuesioner(['id_tna' => $tna->id_tna]);

                foreach ($dataKuesioner as $kuesioner) {
                    if (in_array($kuesioner->id_soal, $idSoalList)) {
                        if (in_array($kuesioner->jwb_d, $rangeSkala)) {
                            $index = array_search($kuesioner->jwb_d, $rangeSkala);
                            $skor_d[$index]++;
                        }
                        if (in_array($kuesioner->jwb_i, $rangeSkala)) {
                            $index = array_search($kuesioner->jwb_i, $rangeSkala);
                            $skor_i[$index]++;
                        }
                        if (in_array($kuesioner->jwb_f, $rangeSkala)) {
                            $index = array_search($kuesioner->jwb_f, $rangeSkala);
                            $skor_f[$index]++;
                        }
                    }
                }
            }
        }

        $results = [
            'skor_d' => $skor_d,
            'skor_i' => $skor_i,
            'skor_f' => $skor_f,
        ];
        header('Content-Type: application/json');
        echo json_encode($results);
    }

    /*-------------------------------------------------- Logout --------------------------------------------------*/
    public function logout()
    {
        $this->session->unset_userdata('nik');
        $this->session->unset_userdata('no_hp');
        $this->session->unset_userdata('id_role');
        $this->session->set_flashdata('success', 'Terimakasih! Semoga Hari Anda Menyenangkan');
        redirect(base_url());
    }
}
