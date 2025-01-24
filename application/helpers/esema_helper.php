<?php

function split_text_every_two_words($text)
{
    $words = explode(' ', $text);
    $lines = array();

    for ($i = 0; $i < count($words); $i += 2) {
        $line = '';
        if (isset($words[$i])) {
            $line .= $words[$i];
        }
        if (isset($words[$i + 1])) {
            $line .= ' ' . $words[$i + 1];
        }
        $lines[] = $line;
    }
    return $lines;
}

if (!function_exists('convertPhoneNumber')) {
    function convertPhoneNumber($phoneNumber)
    {
        if (substr($phoneNumber, 0, 2) == '08') {
            return '+628' . substr($phoneNumber, 2);
        } elseif (substr($phoneNumber, 0, 4) == '+628') {
            return $phoneNumber;
        }
        return $phoneNumber;
    }
}

function cek_login()
{
    $ci = get_instance();

    if (!$ci->session->userdata('nik')) {
        $ci->session->set_flashdata('error', 'Maaf! Akses Anda Diblokir! Silahkan Login Terlebih Dahulu!');
        redirect(base_url());
    } else {
        $id_role = $ci->session->userdata('id_role');

        $userAkses = $ci->db->get_where('esema_hak_akses', [
            'id_role' => $id_role,
        ]);
    }
}
