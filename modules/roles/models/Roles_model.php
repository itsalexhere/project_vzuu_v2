<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roles_model extends MY_Model
{
    use MY_Tables;

    public function __construct()
    {
        $this->_tabel = "ms_roles";
        parent::__construct();
    }

    public function list_fields()
    {
        $this->db->select('
            b.field_name,
            b.field_type,
            b.placeholder,
            b.column_type,
            b.is_required,
            b.status,
            b.ordering
        ');
        $this->db->from("{$this->_table_ms_form} a");
        $this->db->join("{$this->_table_ms_form_fields} b", 'b.form_id = a.id', 'left');
        $this->db->where('a.id', '81');
        $this->db->order_by('b.ordering', 'ASC');

        return $this->db->get()->result_array();
    }

    public function show()
    {
        $this->db->select('*');
        $this->db->from($this->_tabel);

        $result = $this->db->get()->result();

        foreach ($result as &$row) {
            $row->action = generateActionButtons($row->id, 'roles',[], $this->getCurrentMenuPermissions());
        }

        return json_encode(['data' => $result]);
    }

    public function detail($id)
    {
        $this->db->select('*');
        $this->db->from("{$this->_tabel}");
        $this->db->where('id', $id);

        return $this->db->get()->row();
    }

    public function _validate()
    {
        $response = ['success' => false, 'validate' => true, 'messages' => []];

        $this->load->library('form_validation');

                $this->form_validation->set_rules('name', 'Name', ['trim', 'required', 'xss_clean']);

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
            // Jalankan Validasi
            $response = self::_validate();
            if (!$response['validate']) {
                throw new Exception('Validation Error');
            }

            // Ambil ID (jika ada)
            $id = clearInput($this->input->post('id'));

            // Ambil semua post data
            $postData = $this->input->post();

            $fields = [];
            foreach ($postData as $key => $value) {
                $fields[$key] = is_string($value) ? clearInput($value) : $value;
            }

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

            // Commit
            $this->db->trans_commit();
            $response['success'] = true;
            $response['messages'] = 'Successfully Saved Data';
            return $response;
        }catch (Exception $e) {
            $this->db->trans_rollback();
            return $response;
        }
    }

    public function delete($id){
        $this->db->trans_begin();
        try {
            $check = $this->detail($id);

            if (!$check) {
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
    
}
