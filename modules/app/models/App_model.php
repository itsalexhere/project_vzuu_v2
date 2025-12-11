<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App_model extends MY_Model
{
    use MY_Tables;

    public function __construct()
    {
        $this->_tabel = $this->_table_ms_users;
        parent::__construct();
    }

    public function _check_data_user($username_email, $remember_token = null)
    {
        try {
            $this->db->select("
                                a.email,
                                (
                                    SELECT COUNT(bb.name)
                                    FROM {$this->_table_ms_user_accesscontrols} aa
                                    INNER JOIN {$this->_table_ms_menus} bb ON bb.id = aa.ms_menus_id
                                    WHERE
                                        bb.status = 1
                                        AND aa.ms_user_id = a.id
                                        AND aa.`view` = 1
                                        AND bb.deleted_at IS NULL
                                ) AS total_menu_active,
                                GROUP_CONCAT(DISTINCT c.name SEPARATOR ', ') AS menu_names
                            ", false);
            $this->db->join("{$this->_table_ms_user_accesscontrols} b", "b.ms_user_id = a.id", "inner");
            $this->db->join("{$this->_table_ms_menus} c", "c.id = b.ms_menus_id", "inner");

            $this->db->group_start();
            $this->db->where('a.email', $username_email);
            $this->db->or_where('a.username', $username_email);
            $this->db->group_end();

            $this->db->where('a.status', 1);
            $this->db->where('c.deleted_at IS NULL');
            $this->db->where('c.status', 1);

            if ($remember_token !== null) {
                $this->db->where('a.remember_token', $remember_token);
            }

            $this->db->group_by("a.email");

            $check = $this->db->get("{$this->_table_ms_users} a")->row();


            if (!$check) {
                throw new Exception("Error Processing Request", 1);
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function get_menu($email, $remember_token, $method = 'all')
    {
        $this->db->select(" m.id AS menu_id,
                        m.controller,
                        m.name,
                        m.icon,
                        m.parent,
                        p.name AS parent_name,
                        p.icon AS parent_icon,
                        m.order,
                        a.view,
                        a.insert,
                        a.update,
                        a.delete,
                        a.import,
                        a.export
                    ", FALSE);

        $this->db->from($this->_table_ms_users . " u");
        $this->db->join($this->_table_ms_user_accesscontrols . " a", "a.ms_user_id = u.id", "inner");
        $this->db->join($this->_table_ms_menus . " m", "m.id = a.ms_menus_id", "inner");
        $this->db->join($this->_table_ms_menus . " p", "p.id = m.parent", "left");

        $this->db->group_start();
        $this->db->where('u.email', $email);
        $this->db->or_where('u.username', $email);
        $this->db->group_end();

        $this->db->where('u.remember_token', $remember_token);
        $this->db->where('u.status !=', 0);
        $this->db->where('m.status !=', 0);
        // $this->db->where('m.deleted_at IS NULL');
        $this->db->where(['a.view' => 1]);
        $this->db->order_by('m.`order`', 'ASC');
        $this->db->order_by('m.parent', 'DESC');

        if ($method == 'all') {
            $this->db->order_by("m.parent ASC, m.order ASC, m.id ASC");
            $result = $this->db->get()->result();

            $filtered_result = array_filter($result, function ($item) {
                return $item->controller !== 'dashboard';
            });

            $this->db->select(" m.id AS menu_id,
                            m.controller,
                            m.name,
                            m.icon,
                            m.parent,
                            p.name AS parent_name,
                            p.icon AS parent_icon,
                            m.order
                        ", FALSE);

            $this->db->from($this->_table_ms_menus . " m");
            $this->db->join($this->_table_ms_menus . " p", "p.id = m.parent", "left");
            $this->db->where('m.controller', 'dashboard');
            $this->db->where('m.status !=', 0);
            // $this->db->where('m.deleted_at IS NULL');

            $dashboard = $this->db->get()->row();

            if ($dashboard) {
                $dashboard->order  = -1;
                $dashboard->view   = 1;
                $dashboard->insert = 0;
                $dashboard->update = 0;
                $dashboard->delete = 0;
                $dashboard->import = 0;
                $dashboard->export = 0;

                array_unshift($filtered_result, $dashboard);
            }

            return $filtered_result;
        } else {
            $this->db->limit(1);
            return $this->db->get()->row();
        }
    }

    public function validation_menu($email, $remember_token, $method)
    {
        $get = $this->get_menu($email, $remember_token, $method);

        if (is_object($get)) {
            $menu_id = $get->menu_id;

            // Cek apakah ada menu anak dari menu_id tersebut
            $this->db->where('parent', $menu_id);
            $this->db->limit(1);
            $check = $this->db->get($this->_table_ms_menus)->row();

            if (is_object($check)) {
                // Ambil controller dari menu anak yang user punya akses view = 1
                $this->db->select("m.controller, a.ms_menus_id, a.view", false);
                $this->db->from($this->_table_ms_users . " u");
                $this->db->join($this->_table_ms_user_accesscontrols . " a", "a.ms_user_id = u.id", "inner");
                $this->db->join($this->_table_ms_menus . " m", "m.id = a.ms_menus_id", "inner");
                $this->db->where([
                    'u.email' => $email,
                    'u.remember_token' => $remember_token,
                    'a.view' => 1,
                    'm.parent' => $menu_id
                ]);
                $this->db->limit(1);

                $result = $this->db->get()->row();

                if (is_object($result)) {
                    return $result->controller;
                }
            }

            return $get->controller;
        }

        return '';
    }
}
