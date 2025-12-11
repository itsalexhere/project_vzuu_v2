<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_access_model extends MY_Model
{
    use MY_Tables;

    public function __construct()
    {
        $this->_tabel = $this->_table_ms_user_accesscontrols;
        parent::__construct();
    }

    public function delete_by_user($user_id)
    {
        return $this->db->where('ms_user_id', $user_id)->delete($this->_tabel);
    }

    public function insert($fields)
    {
        return $this->db->insert_batch($this->_tabel, $fields);
    }

    public function update_permission()
    {
        $this->db->trans_begin();

        $user_id     = $this->input->post('user_id');
        $permissions = $this->input->post('permissions');
        $created_by  = $this->session->userdata('user_id');
        $now         = date('Y-m-d H:i:s');

        try {
            // Validasi awal
            if (empty($permissions) || !is_array($permissions)) {
                throw new Exception('Tidak ada permission yang dipilih.');
            }

            // Siapkan data baru untuk disimpan
            $data_to_insert = [];
            foreach ($permissions as $menu_id => $perms) {
                $data_to_insert[] = [
                    'id'          => uuid(),
                    'ms_user_id'  => $user_id,
                    'ms_menus_id' => $menu_id,
                    'view'        => !empty($perms['view']) ? 1 : 0,
                    'insert'      => !empty($perms['insert']) ? 1 : 0,
                    'update'      => !empty($perms['update']) ? 1 : 0,
                    'delete'      => !empty($perms['delete']) ? 1 : 0,
                    'import'      => !empty($perms['import']) ? 1 : 0,
                    'export'      => !empty($perms['export']) ? 1 : 0,
                    'created_by'  => $created_by,
                    'created_at'  => $now,
                ];
            }

            // Hapus data lama user ini
            $this->delete_by_user($user_id);

            // Simpan data baru
            if (!$this->insert($data_to_insert)) {
                throw new Exception('Gagal menyimpan data baru.');
            }

            $this->db->trans_commit();

            return [
                'success'  => true,
                'validate' => true,
                'type' => 'update',
                'messages' => 'Data berhasil diperbaharui.'
            ];
        } catch (Exception $e) {
            $this->db->trans_rollback();

            return [
                'success'  => false,
                'validate' => false,
                'messages' => $e->getMessage() ?: 'Terjadi kesalahan saat menyimpan data.'
            ];
        }
    }
}
