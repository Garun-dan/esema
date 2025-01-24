<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    /*================================================== PRIVATE FUNCTION ==================================================*/
    /**
     * @param mixed $slug
     * 
     * @return [type]
     */
    private function data($slug)
    {
        $oneMenu = $this->SettingsModel->getOneMenu(['slug_menu' => $slug, 'posisi_menu' => 'home']);

        return [
            'judul' => $oneMenu->nama_menu,
            'tampilan' => $this->SettingsModel->getOneMaintenance(),
            'getMenu' => $this->SettingsModel->getAllMenu(['posisi_menu' => 'home']),
            'getSet' => $this->SettingsModel->getOneSet(['id_menu' => $oneMenu->id_menu]),
        ];
    }

    /**
     * @param mixed $slug
     * @param mixed $data
     * 
     * @return [type]
     */
    private function load_views($slug, $data)
    {
        $this->load->view('home/layout/header', $data);
        $this->load->view('home/layout/modal', $data);
        $this->load->view('home/layout/topbar', $data);
        $this->load->view('home/views/' . $slug, $data);
        $this->load->view('home/layout/footer', $data);
    }

    /**
     * @param mixed $nik
     * 
     * @return [type]
     */
    private function dataUser($nik)
    {
        if ($this->session->userdata('nik')) {
            $this->session->set_flashdata('error', 'Maaf! Halaman Tidak Ditemukan!');
            redirect(base_url());
        }

        $cekUser = $this->MasterDataModel->getOneUser(['nik' => $nik]);
        $api = $this->SettingsModel->getOneMaintenance();

        if ($cekUser) {
            if (!empty($cekUser->no_hp)) {
                $this->load->helper('string');

                $otp = random_string('numeric', 4);
                $message = 'Hallo mitra esema, kode OTP anda adalah *' . $otp . '*. Jangan sebarkan kode ini dan jika anda tidak melakukan aktivitas login, tolong diabaikan. Terimakasih!';

                $data = [
                    'otp' => $otp
                ];

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.fonnte.com/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'target' => $cekUser->no_hp,
                        'message' => $message,
                        'countryCode' => '62',
                    ),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: ' . $api->api_otp
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $this->MasterDataModel->updateUser($cekUser->id_user, $data);
            }

            $data = [
                'judul' => 'Validasi Login',
                'tampilan' => $this->SettingsModel->getOneMaintenance(),
                'getSet' => $this->SettingsModel->getOneSet(['id_sethome' => 1]),
                'user' => $cekUser
            ];
            $this->load->view('home/layout/header', $data);
            $this->load->view('home/layout/modal', $data);
            $this->load->view('home/layout/topbar-valid', $data);
            $this->load->view('home/views/validasi-hp', $data);
            $this->load->view('home/layout/footer-valid', $data);
        } else {
            $this->dataAPI($nik);
        }
    }

    /**
     * @param mixed $nik
     * 
     * @return [type]
     */
    private function dataAPI($nik)
    {
        if (!preg_match('/^\d{2}-\d{3}-\d{4}$/', $nik)) {
            $this->session->set_flashdata('error', 'Format NIK tidak valid!');
            redirect(base_url());
        }

        $encryptedNik = urlencode(base64_encode($nik));

        $cekAPI = $this->MasterDataModel->getOneApi(['id_api' => 'eaus-1']);
        $apiUrl = $cekAPI->api . '?key=' . $encryptedNik;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200 && strpos($result, $nik) !== false) {
            $dataRespon = json_decode($result, true);

            if (is_array($dataRespon)) {
                $foundName = null;
                foreach ($dataRespon as $respons) {
                    if (isset($respons['nama']) && isset($respons['nik'])) {
                        if ($respons['nik'] == $nik) {
                            $foundName = $respons['nama'];
                            break;
                        }
                    }
                }
            }

            $cekRowUser = $this->MasterDataModel->totRowUser();
            $highestUser = $this->MasterDataModel->getHighestUser();
            $highestNumber = intval(substr($highestUser, 4));
            $newNumber = max($highestNumber + 1, $cekRowUser + 1);
            $id_user = 'usr-' . $newNumber;
            $data = [
                'id_user' => $id_user,
                'nama' => $foundName,
                'nik' => $nik,
                'id_role' => 'role-4',
                'is_active' => 'Aktif',
            ];

            $this->MasterDataModel->insertUser($data);
            $this->session->set_flashdata('success', 'NIK Terdaftar! Silahkan Input Nomor WhatsApp Anda pada form berikut!');
            $this->dataUser($nik);
        } else {
            $this->session->set_flashdata('error', 'NIK Belum Terdaftar atau Ada Kesalahan! Silahkan Hubungi Admin!');
            redirect(base_url());
        }
    }

    /*================================================== PUBLIC FUNCTION ==================================================*/
    /**
     * @return [type]
     */
    public function index()
    {
        $slug = 'home';

        $pathView = 'home/views/' . $slug . '.php';

        if (file_exists(APPPATH . 'views/' . $pathView)) {
            $data = $this->data($slug);
            $this->load_views($slug, $data);
        } else {
            $this->session->set_flashdata('error', 'Halaman Tidak Ditemukan');
            redirect(base_url());
        }
    }

    /**
     * @return [type]
     */
    public function cekDataLogin()
    {
        $nik = $this->input->post('nik');

        $this->dataUser($nik);
    }

    /**
     * @param mixed $hp
     * 
     * @return [type]
     */
    public function informasiNIK($hp)
    {
        $message = 'Hallo mitra esema, Jika NIK anda belum terdaftar silahkan melakukan pendaftaran atau update data pada aplikasi SIDMK. Terimakasih!';
        $api = $this->SettingsModel->getOneMaintenance();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $hp,
                'message' => $message,
                'countryCode' => '62',
            ),
            CURLOPT_HTTPHEADER => array(
                // 'Authorization: aknQzS2#y8Yx-#9+U68F'
                'Authorization: ' . $api->api_otp
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $this->session->set_flashdata('success', 'Informasi Berhasil Dikirim!');
        redirect(base_url());
    }

    /**
     * @return [type]
     */
    public function simpanHP()
    {
        if ($this->input->is_ajax_request()) {
            $nik = $this->input->post('nik');
            $hp = $this->input->post('hp');
            $cekUser = $this->MasterDataModel->getOneUser(['nik' => $nik]);

            $this->load->helper('string');

            if ($cekUser) {
                $otp = random_string('numeric', 4);
                $message = 'Hallo mitra esema, kode OTP anda adalah *' . $otp . '*. Jangan sebarkan kode ini dan jika anda tidak melakukan aktivitas login, tolong diabaikan. Terimakasih!';
                $api = $this->SettingsModel->getOneMaintenance();
                $data = [
                    'no_hp' => $hp,
                    'otp' => $otp
                ];

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.fonnte.com/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'target' => $hp,
                        'message' => $message,
                        'countryCode' => '62',
                    ),
                    CURLOPT_HTTPHEADER => array(
                        // 'Authorization: aknQzS2#y8Yx-#9+U68F'
                        'Authorization: ' . $api->api_otp
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $this->MasterDataModel->updateUser($cekUser->id_user, $data);
                echo json_encode(['status' => 'success', 'message' => 'Data HP berhasil disimpan']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'User tidak ditemukan']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Permintaan tidak valid']);
        }
    }

    /**
     * @return [type]
     */
    public function validasi()
    {
        $nik = $this->input->post('nik');
        $otp = $this->input->post('otp');
        $cekUser = $this->MasterDataModel->getOneUser(['nik' => $nik]);
        if ($cekUser) {
            if ($cekUser->otp == $otp) {
                $data = [
                    'nik' => $cekUser->nik,
                    'no_hp' => $cekUser->no_hp,
                    'id_role' => $cekUser->id_role,
                ];

                $this->session->set_userdata($data);
                if (empty($cekUser->tmpt_lahir)) {
                    $this->session->set_flashdata('success', 'Selamat Datang! Lengkapi Dokumen Biodata Anda Terlebih Dahulu!');
                } else {
                    $this->session->set_flashdata('success', 'Selamat Datang! Awali Kegiatan Anda Dengan Berdoa Terlebih Dahulu. Terimakasih');
                }
                redirect('admin/settings/profile');
            } else {
                $this->session->set_flashdata('error', 'Maaf OTP Tidak Sesuai');
                $this->dataUser($nik);
            }
        } else {
            $this->session->set_flashdata('error', 'Maaf NIK Tidak Sesuai');
            $this->dataUser($nik);
        }
    }

    /**
     * @param mixed $slug
     * 
     * @return [type]
     */
    public function halaman($slug)
    {
        if ($slug != 'home') {
            $pathView = 'home/views/' . $slug . '.php';

            if (file_exists(APPPATH . 'views/' . $pathView)) {
                $data = $this->data($slug);
                $this->load_views($slug, $data);
            } else {
                $this->session->set_flashdata('error', 'Halaman Tidak Ditemukan');
                redirect(base_url());
            }
        } else {
            redirect(base_url());
        }
    }

    /**
     * @return [type]
     */
    public function loadMedia()
    {
        if ($this->input->is_ajax_request()) {
            $start = $this->input->get('start');
            $end = $this->input->get('end');
            $mediaData = json_decode($this->input->get('media'), true);
            $mediaSlice = array_slice($mediaData, $start, $end - $start);

            $html = '';
            foreach ($mediaSlice as $media) {
                $file_extension = pathinfo($media, PATHINFO_EXTENSION);
                $fileNameWithoutExtension = pathinfo($media, PATHINFO_FILENAME);

                $html .= '<div class="col-lg-3 col-sm-3 mb-3">';
                $html .= '<div class="card" style="height: 250px;">';
                if (in_array($file_extension, ['jpg', 'png', 'jpeg'])) {
                    $html .= '<img src="' . base_url('assets/upload/media/') . $media . '" alt="background" class="position-relative" style="height:150px; object-fit:cover;">';
                } elseif ($file_extension === 'pdf') {
                    $html .= '<img src="' . base_url('assets/upload/media/') . $fileNameWithoutExtension . '.jpg" alt="background" class="position-relative" style="height:150px; object-fit:cover;">';
                }
                $html .= '<div class="card-body">';
                $html .= '<h5 class="card-title">' . $fileNameWithoutExtension . '</h5>';
                $html .= '<a href="#" class="tbl-primer text-decoration-none" data-bs-toggle="modal" data-bs-target="#pedoman-' . $media . '">Detail</a>';
                $html .= '</div></div></div>';

                $html .= '<div class="modal fade" id="pedoman-' . $media . '" tabindex="-1" aria-labelledby="pedomanLabel-' . $media . '" aria-hidden="true">';
                $html .= '<div class="modal-dialog modal-lg">';
                $html .= '<div class="modal-content">';
                $html .= '<div class="modal-header">';
                $html .= '<h5 class="modal-title" id="pedomanLabel-' . $media . '">Detail</h5>';
                $html .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                $html .= '</div>';
                $html .= '<div class="modal-body">';
                if ($file_extension === 'pdf') {
                    $html .= '<embed src="' . base_url('assets/upload/media/') . $media . '" type="application/pdf" width="100%" height="500">';
                }
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
            }
            echo $html;
        } else {
            redirect(base_url());
        }
    }
}
