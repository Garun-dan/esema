<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterDataModel extends CI_Model
{
    /*================================================== MENU MASTER DATA ==================================================*/

    /*-------------------------------------------------- SKALA --------------------------------------------------*/
    public function getSkala()
    {
        return $this->db->get('esema_skala')->result();
    }

    public function getOneSkala($where = null)
    {
        return $this->db->get_where('esema_skala', $where)->row();
    }

    public function insertSkala($data = null)
    {
        $this->db->insert('esema_skala', $data);
    }

    public function updateSkala($id, $data)
    {
        $this->db->where('id_skala', $id);
        $this->db->update('esema_skala', $data);
    }

    public function totRowSkala()
    {
        return $this->db->get('esema_skala')->num_rows();
    }

    /*-------------------------------------------------- JABFUNG --------------------------------------------------*/
    public function getJabfung()
    {
        return $this->db->get('esema_jabfung')->result();
    }

    public function getOneJabfung($where = null)
    {
        return $this->db->get_where('esema_jabfung', $where)->row();
    }

    public function insertJabfung($data = null)
    {
        $this->db->insert('esema_jabfung', $data);
    }

    public function updateJabfung($id, $data)
    {
        $this->db->where('id_jabfung', $id);
        $this->db->update(
            'esema_jabfung',
            $data
        );
    }

    public function totRowJabfung()
    {
        return $this->db->get('esema_jabfung')->num_rows();
    }

    /*-------------------------------------------------- JENJANG JABATAN --------------------------------------------------*/
    public function getJenjang()
    {
        return $this->db->get('esema_jenjang')->result();
    }

    public function getOneJenjang($where = null)
    {
        return $this->db->get_where('esema_jenjang', $where)->row();
    }

    public function getAllJenjang($where = null)
    {
        $this->db->order_by('id_jenjang', 'ASC');
        return $this->db->get_where('esema_jenjang', $where)->result();
    }

    public function insertJenjang($singleData = null)
    {
        if (!is_array($singleData) || empty($singleData)) {
            return false;
        }

        $this->db->insert('esema_jenjang', $singleData);
        return $this->db->insert_id();
    }

    public function updateJenjang($id, $data)
    {
        $this->db->where('id_jenjang', $id);
        $this->db->update(
            'esema_jenjang',
            $data
        );
    }

    public function totRowJenjang()
    {
        return $this->db->get('esema_jenjang')->num_rows();
    }

    public function joinJenjangtoJabfung($id)
    {
        $this->db->select('*');
        $this->db->from('esema_jenjang');
        $this->db->join('esema_jabfung', 'esema_jenjang.id_jabfung = esema_jabfung.id_jabfung', 'left');
        $this->db->like('esema_jabfung.id_jabfung', $id);

        return $this->db->get()->row();
    }

    /*-------------------------------------------------- INSTRUMEN --------------------------------------------------*/
    public function getInstrumen()
    {
        return $this->db->get('esema_instrumen')->result();
    }

    public function getOneInstrumen($where = null)
    {
        return $this->db->get_where('esema_instrumen', $where)->row();
    }

    public function getAllInstrumen($where = null)
    {
        return $this->db->get_where('esema_instrumen', $where)->result();
    }

    public function insertInstrumen($singleData = null)
    {
        if (!is_array($singleData) || empty($singleData)) {
            return false;
        }

        $this->db->insert('esema_instrumen', $singleData);
        return $this->db->insert_id();
    }


    public function updateInstrumen($id, $data)
    {
        $this->db->where('id_instrumen', $id);
        $this->db->update(
            'esema_instrumen',
            $data
        );
    }

    public function totRowInstrumen()
    {
        return $this->db->get('esema_instrumen')->num_rows();
    }

    public function joinInstrumentoJabfung($id)
    {
        $this->db->select('*');
        $this->db->from('esema_instrumen');
        $this->db->join('esema_jenjang', 'esema_instrumen.id_jenjang = esema_jenjang.id_jenjang', 'left');
        $this->db->like('esema_jenjang.id_jenjang', $id);

        return $this->db->get()->row();
    }

    public function deleteInstrumen($id)
    {
        $this->db->where('id_instrumen', $id);
        $this->db->delete('esema_instrumen');
    }

    public function getHighestInstrumen()
    {
        $this->db->select_max('id_instrumen');
        $query = $this->db->get('esema_instrumen');
        $result = $query->row();
        return $result->id_instrumen;
    }

    public function isInstrumenExists($id_instrumen)
    {
        $this->db->where('id_instrumen', $id_instrumen);
        $query = $this->db->get('esema_instrumen');
        return $query->num_rows() > 0;
    }

    /*-------------------------------------------------- RUMAH JABATAN --------------------------------------------------*/
    public function getRumah()
    {
        return $this->db->get('esema_rumah_jabatan')->result();
    }

    public function getOneRumah($where = null)
    {
        return $this->db->get_where('esema_rumah_jabatan', $where)->row();
    }

    public function getAllRumah($where = null)
    {
        return $this->db->get_where('esema_rumah_jabatan', $where)->result();
    }

    public function insertRumah($singleData = null)
    {
        if (!is_array($singleData) || empty($singleData)) {
            return false;
        }

        $this->db->insert('esema_rumah_jabatan', $singleData);
        return $this->db->insert_id();
    }

    public function isRumahExists($id_rumah)
    {
        $this->db->where('id_rumah', $id_rumah);
        $query = $this->db->get('esema_rumah_jabatan');
        return $query->num_rows() > 0;
    }

    public function getHighestRumah()
    {
        $this->db->select_max('id_rumah');
        $query = $this->db->get('esema_rumah_jabatan');
        $result = $query->row();
        return $result->id_rumah;
    }


    public function updateRumah($id, $data)
    {
        $this->db->where('id_rumah', $id);
        $this->db->update(
            'esema_rumah_jabatan',
            $data
        );
    }

    public function totRowRumah()
    {
        return $this->db->get('esema_rumah_jabatan')->num_rows();
    }

    /*-------------------------------------------------- API --------------------------------------------------*/
    public function getApi()
    {
        return $this->db->get('esema_api_responden')->result();
    }

    public function getOneApi($where = null)
    {
        return $this->db->get_where('esema_api_responden', $where)->row();
    }

    public function getAllApi($where = null)
    {
        return $this->db->get_where('esema_api_responden', $where)->result();
    }

    public function insertApi($singleData = null)
    {
        if (!is_array($singleData) || empty($singleData)) {
            return false;
        }

        $this->db->insert('esema_api_responden', $singleData);
        return $this->db->insert_id();
    }


    public function updateApi($id, $data)
    {
        $this->db->where('id_api', $id);
        $this->db->update(
            'esema_api_responden',
            $data
        );
    }

    public function totRowApi()
    {
        return $this->db->get('esema_api_responden')->num_rows();
    }

    /*-------------------------------------------------- USER --------------------------------------------------*/
    public function getUser()
    {
        return $this->db->get('esema_users')->result();
    }

    public function getOneUser($where = null)
    {
        return $this->db->get_where('esema_users', $where)->row();
    }

    public function getAllUser($where = null)
    {
        return $this->db->get_where('esema_users', $where)->result();
    }

    public function insertUser($singleData = null)
    {
        if (!is_array($singleData) || empty($singleData)) {
            return false;
        }

        $this->db->insert('esema_users', $singleData);
        return $this->db->insert_id();
    }

    public function updateUser($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update(
            'esema_users',
            $data
        );
    }

    public function totRowUser()
    {
        return $this->db->get('esema_users')->num_rows();
    }

    public function getHighestUser()
    {
        $this->db->select_max('id_user');
        $query = $this->db->get('esema_users');
        $result = $query->row();
        return $result->id_user;
    }

    public function isUserExists($id_user)
    {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('esema_users');
        return $query->num_rows() > 0;
    }

    public function joinUsertoRole($id)
    {
        $this->db->select('*');
        $this->db->from('esema_users');
        $this->db->join('esema_role_akses', 'esema_users.id_role = esema_role_akses.id_role', 'left');
        $this->db->like('esema_role_akses.id_role', $id);

        return $this->db->get()->row();
    }

    public function getCountPria()
    {
        $this->db->select('COUNT(*) as total');
        $this->db->from('esema_users');
        $this->db->where('gender', 'Pria');
        $query = $this->db->get();
        $row = $query->row();

        if ($row) {
            $total = $row->total;
            if ($total >= 1000) {
                $total = round($total / 1000, 1) . 'K';
            }
            return $total;
        } else {
            return 0;
        }
    }

    public function getCountWanita()
    {
        $this->db->select('COUNT(*) as total');
        $this->db->from('esema_users');
        $this->db->where('gender', 'Wanita');
        $query = $this->db->get();
        $row = $query->row();

        if ($row) {
            $total = $row->total;
            if ($total >= 1000) {
                $total = round($total / 1000, 1) . 'K';
            }
            return $total;
        } else {
            return 0;
        }
    }

    /*-------------------------------------------------- PANGKAT --------------------------------------------------*/
    public function getPangkat()
    {
        return $this->db->get('esema_pangkat')->result();
    }

    public function getOnePangkat($where = null)
    {
        return $this->db->get_where('esema_pangkat', $where)->row();
    }

    public function getAllPangkat($where = null)
    {
        return $this->db->get_where('esema_pangkat', $where)->result();
    }

    public function insertPangkat($singleData = null)
    {
        $this->db->insert('esema_pangkat', $singleData);
    }


    public function updatePangkat($id, $data)
    {
        $this->db->where('id_pangkat', $id);
        $this->db->update(
            'esema_pangkat',
            $data
        );
    }
}
