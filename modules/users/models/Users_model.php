<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends MY_Model
{
    use MY_Tables;

    public function __construct()
    {
        $this->_tabel = $this->_table_ms_users;
        parent::__construct();
    }

    public function findUsernameOrEmail($username_email)
    {
        $users = $this->db->select('id,email,username,password')
            ->from($this->_table_ms_users)
            ->where('username', $username_email)
            ->or_where('email', $username_email)
            ->get()
            ->row();

        return $users;
    }

    public function getProfil()
    {
        $get = $this->get(array('email' => $this->_session_email, 'remember_token' => $this->_session_id));
        return $get;
    }

    public function show()
    {
        $this->db->select("*", false);
        $this->db->from("{$this->_tabel}");

        $result = $this->db->get()->result();

        return json_encode(['data' => $result]);
    }

    private function _validate()
    {
        $response = ['success' => false, 'validate' => true, 'messages' => []];

        $response['type'] = 'insert';

        $role_validate = ['trim', 'required', 'xss_clean'];

        $this->form_validation->set_rules('name', 'Name', $role_validate);
        $this->form_validation->set_rules('email', 'Email', $role_validate);
        $this->form_validation->set_rules('pass', 'Password', $role_validate);

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

            if(!$response['validate']){
                throw new Exception("Error Processing Request", 1);

            }

            $id = clearInput($this->input->post('id'));
            $username = clearInput($this->input->post('username'));
            $role_id = clearInput($this->input->post('role_id'));
            $email = clearInput($this->input->post('email'));
            $password = clearInput($this->input->post('password'));
            $confirm_password = clearInput($this->input->post('confirm_password'));
            $status = empty($this->input->post('status')) ? 0 : clearInput($this->input->post('status'));
        

            // $data_array = array(
            //     'fullname' => $fullname,
            //     'password' => $password,
            //     'email' => $email,
            //     'status' => $status == 'enabled' ? 1 : 0,
            // );

            // $data_access = array(
            //     "{$this->_table_admins_ms_roles}_id" => $role_id,
            // );

            // if(empty($id)){
            //     $data_array['remember_token'] = generateCode();
            //     $data_array['password'] = password_hash($password, PASSWORD_DEFAULT);
            //     $process = $this->insert($data_array);
            //     if(!$process){
            //         $response['messages'] = 'Failed insert data user admin';
            //         throw new Exception;

            //     }

            //     $data_access["{$this->_table_admins}_id"] = $process;
            //     $insert_access = $this->_getAccess()->insert($data_access);
            //     if(!$insert_access){
            //         $response['messages'] = 'Failed insert Role user admin';
            //         throw new Exception;
            //     }

            //     $response['messages'] = "Successfully Insert data user admin";

            // }else{
            //     $data = $this->get(array('id' => $id));
            //     if(!$data){
            //         $response['messages'] = 'Data update invalid';
            //         throw new Exception;

            //     }

            //     if(strlen($password) < 8){
            //         unset($data_array['password']);
            //     }else{
            //         $data_array['password'] = password_hash($password, PASSWORD_DEFAULT);
            //     }

            //     $process = $this->update(array('id' => $id),$data_array);
            //     if(!$process){
            //         $response['messages'] = 'Failed update data user';
            //         throw new Exception;

            //     }

            //     $update_access = $this->_getAccess()->update(array("{$this->_table_admins}_id" => $id),$data_access);
            //     if(!$update_access){
            //         $response['messages'] = 'Failed update Role user admin';
            //         throw new Exception;

            //     }

            //     $response['messages'] = 'Successfully update data User admin';
            // }

            $this->db->trans_commit();
            $response['success'] = true;
            return $response;

        } catch (Exception $e) {
            $this->db->trans_rollback();
            return $response;
        }
    }

    // public function getItems($id, $email)
    // {
    //     try {

    //         $get = $this->get(array('id' => $id));
    //         if (!$get) {
    //             throw new Exception("Data not Register", 1);
    //         }

    //         if ($get->email == $email) {
    //             throw new Exception("Sorry,you don't have permission to access", 1);
    //         }

    //         $role = $this->_getAccess()->get(array("{$this->_table_admins}_id" => $get->id));
    //         if (!$role) {
    //             throw new Exception("Role User not found", 1);
    //         }

    //         $select = $this->_getRole()->get_all(array('status' => 1));

    //         $table = array(
    //             'id' => $get->id,
    //             'role_id' => $role->{$this->_table_admins_ms_roles . "_id"},
    //             'fullname' => $get->fullname,
    //             'email' => $get->email,
    //             'checked' => $get->status == 1 ? 'enabled' : 'disabled',
    //             'role' => $select,
    //         );

    //         return $table;
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    // public function changeStatus($id)
    // {
    //     try {
    //         if ($id == null) {
    //             throw new Exception("Failed change status", 1);
    //         }

    //         $get = $this->get(array('id' => $id));
    //         if (!$get) {
    //             throw new Exception("Failed change status", 1);
    //         }

    //         if ($get->email == $this->_session_email) {
    //             throw new Exception("Sorry,you don't have permission to change status this item", 1);
    //         }

    //         $status = $get->status == 1 ? 0 : 1;
    //         $update = $this->update(array('id' => $id), array('status' => $status));
    //         if (!$update) {
    //             throw new Exception("Failed change status", 1);
    //         }

    //         return true;
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    // public function deleteData($id)
    // {
    //     $this->db->trans_begin();
    //     try {
    //         if ($id == null) {
    //             throw new Exception("Failed delete item", 1);
    //         }

    //         $get = $this->get(array('id' => $id));
    //         if (!$get) {
    //             throw new Exception("Failed delete item", 1);
    //         }

    //         if ($get->email == $this->_session_email) {
    //             throw new Exception("Sorry,you don't have permission to delete this item", 1);
    //         }

    //         $access = $this->_getAccess()->delete(array("{$this->_tabel}_id" => $id));
    //         if (!$access) {
    //             throw new Exception("Failed delete Access Role Users", 1);
    //         }

    //         $softDelete = $this->softDelete($id);
    //         if (!$softDelete) {
    //             throw new Exception("Failed delete item", 1);
    //         }

    //         $this->db->trans_commit();
    //         return true;
    //     } catch (Exception $e) {
    //         $this->db->trans_rollback();
    //         return $e->getMessage();
    //     }
    // }

    public function createSession($username_email)
    {
        $response = [
            'success' => false,
            'validate' => true
        ];

        try {
            $check = $this->findUsernameOrEmail($username_email);

            if (!$check) {
                $response['messages'] = 'Invalid Email or Password';
                throw new Exception("Error Processing Request", 1);
            }

            $remember_token = generateCode();

            // Process update
            $data = array(
                'remember_token' => $remember_token,
            );

            $where = array(
                'username' => $check->username,
            );

            $update = $this->db->update($this->_tabel, $data, $where);

            if (!$update) {
                $response['messages'] = 'Invalid Email or Password';
                throw new Exception("Error Processing Request", 1);
            }

            $session = array(
                'username'      => $check->username,
                'token' => $remember_token,
                'user_id' => $check->id,
            );

            $this->session->set_userdata($session);

            $response['username'] = $check->username;
            $response['success'] = true;
            $response['menu_first'] = 'dashboard';
            $response['messages'] = 'success';
            return $response;
        } catch (Exception $e) {
            return $response;
        }
    }
}
