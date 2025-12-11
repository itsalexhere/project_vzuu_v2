<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends MY_Model
{
    use MY_Tables;

    public function __construct()
    {
        $this->_tabel = $this->_table_ms_menus;
        parent::__construct();
    }

    public function _getRawMenuDataByUserId($id, $keyword = null)
    {
        $id = (int) $id;

        $this->db->select(' a.id,
                            a.name,
                            a.parent,
                            a.order AS menu_order,
                            COALESCE(b.view, 0)   AS can_view,
                            COALESCE(b.insert, 0) AS can_insert,
                            COALESCE(b.update, 0) AS can_update,
                            COALESCE(b.delete, 0) AS can_delete,
                            COALESCE(b.import, 0) AS can_import,
                            COALESCE(b.export, 0) AS can_export
                        ', FALSE);

        $this->db->from("{$this->_tabel} a");
        $this->db->join(
            "{$this->_table_ms_user_accesscontrols} b",
            "b.{$this->_tabel}_id = a.id AND b.ms_user_id = {$id}",
            'left'
        );

        $this->db->where("a.status", 1);

        if (!empty($keyword)) {
            $this->db->like('a.name', $keyword);
        }

        $this->db->order_by("a.parent, a.id", "asc");

        $query = $this->db->get();

        return $query->result_array();
    }

    public function _getMenuById(string $id)
    {
        return $this->db->get_where($this->_tabel, ['id' => $id])->row();
    }

    private function _insertMenuData(array $data)
    {
        $data['id'] = uuid();
        $data['created_by'] = $this->_user_id;
        return $this->db->insert($this->_tabel, $data);
    }

    private function _updateMenuData(string $id, array $data)
    {
        $data['updated_by'] = $this->_user_id;
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->where('id', $id)->update($this->_tabel, $data);
    }

    private function _softDeleteMenuData(string $id)
    {
        $fields = [
            'deleted_by' => $this->_user_id,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
        return $this->db->where('id', $id)->update($this->_tabel, $fields);
    }

    public function getParentMenuList()
    {
        $this->db->from($this->_tabel . ' a');
        $this->db->where('a.parent', 0);
        $this->db->where('(a.deleted_by IS NULL OR a.deleted_by = "")', null, false);

        return $this->db->get()->result();
    }

    public function getUserMenuById($user_id)
    {
        $this->db->select(" b.id,
                            a.name,
                            a.status,
                            b.view,
                            b.insert,
                            b.update,
                            b.delete,
                            b.import,
                            b.export,
                            c.name AS parent_name
                        ", false);

        $this->db->from("{$this->_table_ms_menus} a");
        $this->db->join("{$this->_table_ms_user_accesscontrols} b", "b.ms_menus_id = a.id AND b.ms_user_id = {$user_id}", "inner");
        $this->db->join("{$this->_table_ms_menus} c", "c.id = a.parent", "inner");

        $this->db->where("b.id IS NOT NULL", null, false);
        $this->db->where("a.name !=", "Beranda");
        $this->db->where("(a.parent IS NOT NULL AND a.parent != '' AND a.parent != '0')", null, false);

        $result = $this->db->get()->result();

        return json_encode(['data' => $result]);
    }


    public function show()
    {
        $this->db->select('a.id, a.controller, a.name, a.icon, a.parent, a.`order`, a.status, b.name as parent_name', false);
        $this->db->from("{$this->_tabel} a");
        $this->db->join("{$this->_tabel} b", 'b.id = a.parent', 'left');
        $this->db->order_by('a.`order`', 'ASC');
        $this->db->order_by('a.parent', 'DESC');
        $this->db->order_by('a.name', 'ASC');

        $result = $this->db->get()->result();

        foreach ($result as &$row) {
            $row->action = generateActionButtons($row->id, 'menu', [], $this->getCurrentMenuPermissions());
        }

        return json_encode(['data' => $result]);
    }

    private function _validate()
    {
        $response = ['success' => false, 'validate' => true, 'messages' => []];

        $response['type'] = 'insert';

        $role_validate = ['trim', 'required', 'xss_clean'];

        $this->form_validation->set_rules('controller', 'Nama Controller', $role_validate);
        $this->form_validation->set_rules('menu', 'Nama Menu', $role_validate);

        $this->form_validation->set_error_delimiters('<div class="' . VALIDATION_MESSAGE_FORM . '">', '</div>');

        if ($this->form_validation->run() === false) {
            $response['validate'] = false;
            foreach ($this->input->post() as $key => $value) {
                $response['messages'][$key] = form_error($key);
            }
        }

        return $response;
    }

    public function save()
    {
        $this->db->trans_begin();
        try {
            $response = self::_validate();

            if (!$response['validate']) {
                throw new Exception('Error Processing Request', 1);
            }

            $id = clearInput($this->input->post('id'));
            $controller = clearInput($this->input->post('controller'));
            $menu = clearInput($this->input->post('menu'));
            $parent = clearInput($this->input->post('parent'));
            $icon = clearInput($this->input->post('icon'));
            $status = $this->input->post('status');

            $lastOrder = $this->db->select('MAX(`order`) AS last_order')
                ->from($this->_tabel)
                ->get()
                ->row_array();

            $nextOrder = ($lastOrder['last_order'] ?? 0) + 1;

            $fields = [
                'controller' => $controller,
                'name'       => $menu,
                'parent'     => $parent != '' ? $parent : 0,
                'icon'       => $icon != '' ? $icon : 'none',
                'order'       => $nextOrder,
                'status'     => $status == 'enabled' ? 1 : 0,
            ];

            if ($id == '') {
                $execute = $this->_insertMenuData($fields);
            } else {
                $execute = $this->_updateMenuData($id, $fields);
            }

            if (!$execute) {
                $response['messages'] = 'Insert Data Gagal!!';
                throw new Exception();
            }

            $this->db->trans_commit();
            $response['success'] = true;
            $response['messages'] = 'Successfully Insert Data';
            return $response;
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return $response;
        }
    }

    public function delete($id)
    {
        $this->db->trans_begin();
        try {

            $menu = $this->_getMenuById($id);

            if (!$menu) {
                throw new Exception('Data Not Found', 404);
            }

            $execute = $this->db->delete($this->_tabel, ['id' => $id]);

            if (!$execute) {
                throw new Exception('Update Data Gagal!!');
            }

            $this->db->trans_commit();
            $response['success'] = true;
            $response['messages'] = 'Successfully Deleted Data';
            return $response;
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return $response;
        }
    }

    public function orders()
    {
        $this->db->trans_begin();
        try {
            $orderData = json_decode($this->input->post('order'), true);

            if (!is_array($orderData)) {
                throw new Exception("Invalid order data");
            }

            foreach ($orderData as $item) {
                if (!isset($item['id']) || !isset($item['order'])) {
                    continue;
                }

                $this->db->where('id', $item['id'])
                    ->update($this->_tabel, [
                        'order' => $item['order']
                    ]);
            }

            if ($this->db->trans_status() === FALSE) {
                $response['messages'] = 'Failed to update data.';
                throw new Exception();
            }

            $this->db->trans_commit();
            $response['success'] = true;
            $response['messages'] = 'Successfully Updated Data';
            return $response;
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return $response;
        }
    }
}
