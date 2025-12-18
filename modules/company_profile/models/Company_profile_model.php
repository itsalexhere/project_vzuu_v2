<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company_profile_model extends MY_Model
{
    use MY_Tables;

    public function __construct()
    {
        $this->_tabel = "ms_company_profile";
        parent::__construct();
    }

    public function detail()
    {
        $this->db->select('id,name,image_path');
        $this->db->from("{$this->_tabel}");
        $this->db->limit(1);

        return $this->db->get()->row();
    }

    public function save()
    {
        $this->db->trans_begin();
        try {
            $id = clearInput($this->input->post('id'));

            $set_path_file = upload_file('file_upload', 'assets/uploads/company_profile');

            if ($set_path_file !== null) {
                $file_path = $set_path_file;
            }

            $fields = [
                'name' => $this->input->post('name'),
                'image_path' => $file_path ?? "",
                'created_by' => $this->session->userdata('user_id')
            ];

            if ($id == '' || $id == null) {
                $execute = $this->db->insert($this->_tabel, $fields);
            } else {
                $this->db->where('id', $id);
                $execute = $this->db->update($this->_tabel, $fields);
            }

            if (!$execute) {
                $response['messages'] = 'Insert / Update Data Gagal!';
                throw new Exception('DB Error');
            }

            $this->db->trans_commit();
            $response['success'] = true;
            $response['validate'] = true;
            $response['messages'] = 'Successfully Saved Data';
            return $response;
        }catch (Exception $e) {
            $this->db->trans_rollback();
            return $response;
        }
    }
}
