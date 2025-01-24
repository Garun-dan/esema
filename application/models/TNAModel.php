<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TNAModel extends CI_Model
{
    /*================================================== MENU TNA ==================================================*/

    /*-------------------------------------------------- TNA --------------------------------------------------*/
    public function getTNA()
    {
        $this->db->order_by('tgl_create', 'DESC');
        return $this->db->get('esema-tna')->result();
    }

    public function getAllTNA($where = null)
    {
        return $this->db->get_where('esema-tna', $where)->result();
    }

    public function getOneTNA($where = null)
    {
        return $this->db->get_where('esema-tna', $where)->row();
    }

    public function totRowTNA()
    {
        return $this->db->get('esema-tna')->num_rows();
    }

    public function insertTNA($data = null)
    {
        $this->db->insert('esema-tna', $data);
    }

    public function updateTNA($idTNA, $data)
    {
        $this->db->where('id_tna', $idTNA);
        $this->db->update('esema-tna', $data);
    }

    public function deleteTNA($idTNA)
    {
        $this->db->where('id_tna', $idTNA);
        $this->db->delete('esema-tna');
    }


    /*-------------------------------------------------- SOAL TNA --------------------------------------------------*/
    public function getSoal()
    {
        return $this->db->get('esema_soal')->result();
    }

    public function getAllSoal($where = null)
    {
        return $this->db->get_where('esema_soal', $where)->result();
    }

    public function getDataSoal($where = null)
    {
        $this->db->limit(1);
        return $this->db->get_where('esema_soal', $where)->result();
    }

    public function getOneSoal($where = null)
    {
        return $this->db->get_where('esema_soal', $where)->row();
    }

    public function totRowSoal()
    {
        return $this->db->get('esema_soal')->num_rows();
    }

    public function insertSoal($data = null)
    {
        $this->db->insert('esema_soal', $data);
    }

    public function updateSoal($idSoal, $data)
    {
        $this->db->where('id_soal', $idSoal);
        $this->db->update(
            'esema_soal',
            $data
        );
    }

    /*-------------------------------------------------- Jawaban TNA --------------------------------------------------*/
    public function insertKuesioner($data = null)
    {
        $this->db->insert('esema_kuesioner', $data);
    }

    public function getOneKuesioner($where = null)
    {
        return $this->db->get_where('esema_kuesioner', $where)->row();
    }

    public function getAllKuesioner($where = null)
    {
        return $this->db->get_where('esema_kuesioner', $where)->result();
    }

    public function updateKuesioner($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('esema_kuesioner', $data);
    }

    public function getAllKuesionerExcludeKompeten($condition)
    {
        $this->db->select('*');
        $this->db->from('esema_kuesioner');

        $this->db->where($condition);
        $this->db->where('rekom !=', 'Kompeten');

        $query = $this->db->get();
        return $query->result();
    }

    /*-------------------------------------------------- Saran TNA --------------------------------------------------*/
    public function insertEvaluasi($data = null)
    {
        $this->db->insert('esema_evaluasi', $data);
    }

    public function getOneEvaluasi($where = null)
    {
        return $this->db->get_where('esema_evaluasi', $where)->row();
    }

    public function getAllEvaluasi()
    {
        $this->db->select('*');
        $this->db->from('esema_evaluasi');
        $this->db->order_by('tgl', 'DESC');
        return $this->db->get()->result();
    }


    public function updateEvaluasi($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('esema_evaluasi', $data);
    }

    /*-------------------------------------------------- Rekomendasi TNA --------------------------------------------------*/
    public function insertRekom($data = null)
    {
        $this->db->insert('esema_rekom', $data);
    }

    public function getRekom()
    {
        return $this->db->get('esema_rekom')->result();
    }

    public function getOneRekom($where = null)
    {
        return $this->db->get_where('esema_rekom', $where)->row();
    }

    public function getAllRekom($where = null)
    {
        $this->db->order_by('tgl_validasi', 'DESC');
        return $this->db->get_where('esema_rekom', $where)->result();
    }

    public function getCountRekom($id)
    {
        $this->db->select('COUNT(*) as total');
        $this->db->from('esema_rekom');
        $this->db->where('nik', $id);
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

    public function getCountJenis($id, $data)
    {
        $this->db->select('COUNT(*) as total');
        $this->db->from('esema_rekom');
        $this->db->where('nik', $id);
        $this->db->where('rekom', $data);
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

    public function countPriaRekom()
    {
        $this->db->select('COUNT(DISTINCT r.nik) as total_users');
        $this->db->from('esema_rekom r');
        $this->db->join('esema_users u', 'u.nik = r.nik', 'left');
        $this->db->where('u.gender', 'Pria');
        $query = $this->db->get();
        $row = $query->row();

        if ($row) {
            $total = $row->total_users;
            if ($total >= 1000) {
                $total = round($total / 1000, 1) . 'K';
            }
            return $total;
        } else {
            return 0;
        }
    }

    public function countPriaRekomPelatihan()
    {
        $this->db->select('COUNT(DISTINCT r.nik) as total_users');
        $this->db->from('esema_rekom r');
        $this->db->join('esema_users u', 'u.nik = r.nik', 'left');
        $this->db->where('u.gender', 'Pria');
        $this->db->where('r.rekom', 'Peningkatan Kompetensi');
        $query = $this->db->get();
        $row = $query->row();

        if ($row) {
            $total = $row->total_users;
            if ($total >= 1000) {
                $total = round($total / 1000, 1) . 'K';
            }
            return $total;
        } else {
            return 0;
        }
    }

    public function countPriaRekomSeminar()
    {
        $this->db->select('COUNT(DISTINCT r.nik) as total_users');
        $this->db->from('esema_rekom r');
        $this->db->join('esema_users u', 'u.nik = r.nik', 'left');
        $this->db->where('u.gender', 'Pria');
        $this->db->where('r.rekom', 'Kompeten');
        $query = $this->db->get();
        $row = $query->row();

        if ($row) {
            $total = $row->total_users;
            if ($total >= 1000) {
                $total = round($total / 1000, 1) . 'K';
            }
            return $total;
        } else {
            return 0;
        }
    }

    public function countPriaRekomWorkshop()
    {
        $this->db->select('COUNT(DISTINCT r.nik) as total_users');
        $this->db->from('esema_rekom r');
        $this->db->join('esema_users u', 'u.nik = r.nik', 'left');
        $this->db->where('u.gender', 'Pria');
        $this->db->where('r.rekom', 'Workshop');
        $query = $this->db->get();
        $row = $query->row();

        if ($row) {
            $total = $row->total_users;
            if ($total >= 1000) {
                $total = round($total / 1000, 1) . 'K';
            }
            return $total;
        } else {
            return 0;
        }
    }

    public function countWanitaRekom()
    {
        $this->db->select('COUNT(DISTINCT r.nik) as total_users');
        $this->db->from('esema_rekom r');
        $this->db->join('esema_users u', 'u.nik = r.nik', 'left');
        $this->db->where('u.gender', 'Wanita');
        $query = $this->db->get();
        $row = $query->row();

        if ($row) {
            $total = $row->total_users;
            if ($total >= 1000) {
                $total = round($total / 1000, 1) . 'K';
            }
            return $total;
        } else {
            return 0;
        }
    }


    public function countWanitaRekomPelatihan()
    {
        $this->db->select('COUNT(DISTINCT r.nik) as total_users');
        $this->db->from('esema_rekom r');
        $this->db->join(
            'esema_users u',
            'u.nik = r.nik',
            'left'
        );
        $this->db->where('u.gender', 'Wanita');
        $this->db->where('r.rekom', 'Peningkatan Kompetensi');
        $query = $this->db->get();
        $row = $query->row();

        if ($row) {
            $total = $row->total_users;
            if ($total >= 1000) {
                $total = round($total / 1000, 1) . 'K';
            }
            return $total;
        } else {
            return 0;
        }
    }

    public function countWanitaRekomSeminar()
    {
        $this->db->select('COUNT(DISTINCT r.nik) as total_users');
        $this->db->from('esema_rekom r');
        $this->db->join('esema_users u', 'u.nik = r.nik', 'left');
        $this->db->where('u.gender', 'Wanita');
        $this->db->where('r.rekom', 'Kompeten');
        $query = $this->db->get();
        $row = $query->row();

        if ($row) {
            $total = $row->total_users;
            if ($total >= 1000) {
                $total = round($total / 1000, 1) . 'K';
            }
            return $total;
        } else {
            return 0;
        }
    }

    public function countWanitaRekomWorkshop()
    {
        $this->db->select('COUNT(DISTINCT r.nik) as total_users');
        $this->db->from('esema_rekom r');
        $this->db->join('esema_users u', 'u.nik = r.nik', 'left');
        $this->db->where('u.gender', 'Wanita');
        $this->db->where('r.rekom', 'Workshop');
        $query = $this->db->get();
        $row = $query->row();

        if ($row) {
            $total = $row->total_users;
            if ($total >= 1000) {
                $total = round($total / 1000, 1) . 'K';
            }
            return $total;
        } else {
            return 0;
        }
    }



    public function updateRekom($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('esema_rekom', $data);
    }
}
