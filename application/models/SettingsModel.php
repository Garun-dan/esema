<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SettingsModel extends CI_Model
{
    /*================================================== MENU SETTINGS ==================================================*/

    /*-------------------------------------------------- MENU --------------------------------------------------*/
    public function getMenu()
    {
        return $this->db->get('esema_menu')->result();
    }

    public function getOneMenu($where = null)
    {
        return $this->db->get_where('esema_menu', $where)->row();
    }

    public function getAllMenu($where = null)
    {
        return $this->db->get_where('esema_menu', $where)->result();
    }

    public function insertMenu($data = null)
    {
        $this->db->insert('esema_menu', $data);
    }

    public function updateMenu($id, $data)
    {
        $this->db->where('id_menu', $id);
        $this->db->update('esema_menu', $data);
    }

    public function totRowMenu()
    {
        return $this->db->get('esema_menu')->num_rows();
    }

    /*-------------------------------------------------- SUBMENU --------------------------------------------------*/
    public function getSubmenu()
    {
        return $this->db->get('esema_submenu')->result();
    }

    public function getOneSubmenu($where = null)
    {
        return $this->db->get_where('esema_submenu', $where)->row();
    }

    public function getAllSubmenu($where = null)
    {
        return $this->db->get_where('esema_submenu', $where)->result();
    }

    public function insertSubmenu($data = null)
    {
        $this->db->insert('esema_submenu', $data);
    }

    public function updateSubmenu($id, $data)
    {
        $this->db->where('id_submenu', $id);
        $this->db->update('esema_submenu', $data);
    }

    public function totRowSubmenu()
    {
        return $this->db->get('esema_submenu')->num_rows();
    }

    public function joinSubtoMenu($id)
    {
        $this->db->select('*');
        $this->db->from('esema_submenu');
        $this->db->join('esema_menu', 'esema_submenu.id_menu = esema_menu.id_menu', 'left');
        $this->db->like('esema_menu.id_menu', $id);

        return $this->db->get()->row();
    }

    /*-------------------------------------------------- MAINTENANCE --------------------------------------------------*/
    public function getOneMaintenance()
    {
        return $this->db->get_where('esema_maintenance', ['id_maintenance' => 'mainten-1'])->row();
    }

    public function insertMaintenance($data = null)
    {
        $this->db->insert('esema_maintenance', $data);
    }

    public function updateMaintenance($data)
    {
        $this->db->where('id_maintenance', 'mainten-1');
        $this->db->update('esema_maintenance', $data);
    }

    public function resetMaintenance($data)
    {
        $this->db->where('id_maintenance', 'mainten-1');
        $this->db->update('esema_maintenance', $data);
    }

    /*-------------------------------------------------- ROLE AKSES --------------------------------------------------*/
    public function getRole()
    {
        return $this->db->get('esema_role_akses')->result();
    }

    public function getOneRole($where = null)
    {
        return $this->db->get_where('esema_role_akses', $where)->row();
    }

    public function insertRole($data = null)
    {
        $this->db->insert('esema_role_akses', $data);
    }

    public function updateRole($id, $data)
    {
        $this->db->where('id_role', $id);
        $this->db->update('esema_role_akses', $data);
    }

    public function totRowRole()
    {
        return $this->db->get('esema_role_akses')->num_rows();
    }

    /*-------------------------------------------------- HAK AKSES --------------------------------------------------*/
    public function cekAkses($role, $menu, $submenu)
    {
        $this->db->select('*');
        $this->db->from('esema_hak_akses');
        $this->db->where('esema_hak_akses.id_role', $role, 'left');
        $this->db->where('esema_hak_akses.id_menu', $menu, 'left');
        $this->db->where('esema_hak_akses.id_submenu', $submenu, 'left');

        return $this->db->get()->row();
    }

    public function insertAkses($data = null)
    {
        $this->db->insert('esema_hak_akses', $data);
    }

    public function deleteAkses($data)
    {
        $this->db->delete('esema_hak_akses', $data);
    }

    public function getAllAkses($where = null)
    {
        return $this->db->get_where('esema_hak_akses', $where)->result();
    }

    public function getAkses()
    {
        return $this->db->get_where('esema_hak_akses')->result();
    }

    public function get_menus_with_submenus($id)
    {
        $this->db->select('esema_hak_akses.id_menu, esema_menu.nama_menu, esema_menu.slug_menu');
        $this->db->from('esema_hak_akses');
        $this->db->join('esema_menu', 'esema_hak_akses.id_menu = esema_menu.id_menu');
        $this->db->where('esema_hak_akses.id_role', $id);
        $this->db->where('esema_menu.is_active', 'Aktif');
        $this->db->group_by('esema_hak_akses.id_menu');
        $this->db->order_by('esema_menu.id_menu', 'ASC');
        $query = $this->db->get();
        $menus = $query->result_array();

        foreach ($menus as &$menu) {
            $this->db->select('esema_hak_akses.id_submenu, esema_submenu.nama_submenu, esema_submenu.slug_submenu');
            $this->db->from('esema_hak_akses');
            $this->db->join('esema_submenu', 'esema_hak_akses.id_submenu = esema_submenu.id_submenu');
            $this->db->where('esema_hak_akses.id_menu', $menu['id_menu']);
            $this->db->where('esema_submenu.is_active', 'Aktif');
            $query = $this->db->get();
            $menu['submenus'] = $query->result_array();
        }

        return $menus;
    }

    public function getAksesPengguna($id_role)
    {
        $this->db->select('esema_menu.id_menu, esema_menu.nama_menu, esema_menu.slug_menu, esema_menu.icon_menu');
        $this->db->from('esema_hak_akses');
        $this->db->join('esema_menu', 'esema_hak_akses.id_menu = esema_menu.id_menu');
        $this->db->where('esema_hak_akses.id_role', $id_role);
        $this->db->where('esema_menu.is_active', 'Aktif');
        $this->db->group_by('esema_menu.id_menu');
        $this->db->order_by('esema_menu.id_menu', 'ASC');
        $query = $this->db->get();
        $menus = $query->result_array();

        foreach ($menus as &$menu) {
            $this->db->select('esema_submenu.id_submenu, esema_submenu.nama_submenu, esema_submenu.slug_submenu');
            $this->db->from('esema_hak_akses');
            $this->db->join('esema_submenu', 'esema_hak_akses.id_submenu = esema_submenu.id_submenu');
            $this->db->where('esema_hak_akses.id_menu', $menu['id_menu']);
            $this->db->where('esema_submenu.is_active', 'Aktif');
            $this->db->where('esema_hak_akses.id_role', $id_role);
            $query = $this->db->get();
            $menu['submenus'] = $query->result_array();
        }

        return $menus;
    }

    /*-------------------------------------------------- SET HOME --------------------------------------------------*/
    public function getSet()
    {
        return $this->db->get('set_home')->result();
    }

    public function getOneSet($where = null)
    {
        return $this->db->get_where('set_home', $where)->row();
    }

    public function getAllSet($where = null)
    {
        return $this->db->get_where('set_home', $where)->row();
    }

    public function insertSet($data = null)
    {
        if ($data !== null) {
            if (isset($data['media']) && is_array($data['media'])) {
                $data['media'] = json_encode($data['media']);
            }

            $this->db->insert('set_home', $data);
            return $this->db->insert_id();
        }
        return false;
    }

    public function updateSet($id, $data = null)
    {
        if ($data !== null) {
            $oldData = $this->db->get_where('set_home', ['id_sethome' => $id])->row();

            if (isset($data['media']) && is_array($data['media'])) {
                $oldMedia = json_decode($oldData->media, true);

                $mergedMedia = array_merge($oldMedia, $data['media']);

                $mergedMedia = array_values(array_unique($mergedMedia));

                $data['media'] = json_encode($mergedMedia);
            }

            $this->db->where('id_sethome', $id);
            $this->db->update('set_home', $data);
            return $this->db->affected_rows();
        }
        return false;
    }
}
