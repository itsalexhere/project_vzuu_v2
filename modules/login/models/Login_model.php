<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends MY_Model
{
    use MY_Tables;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('users/Users_model', 'users');
    }

    public function _validate()
    {
        $response = array('success' => false, 'validate' => true, 'messages' => array());

        $this->form_validation->set_rules('username_email', 'Username Or Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[25]|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="' . VALIDATION_MESSAGE_FORM . '">', '</div>');

        if ($this->form_validation->run() === false) {
            $response['validate'] = false;
            foreach (array_keys($this->input->post()) as $key) {
                $response['messages'][$key] = form_error($key);
            }
        }

        return $response;
    }

    public function _check_valid_username_password($username_email, $password)
    {
        $checkUsernameEmail = $this->users->findUsernameOrEmail($username_email);

        try {
            if (!$checkUsernameEmail) {
                throw new Exception("Error Processing Request", 1);
            }

            if (!password_verify($password, $checkUsernameEmail->password)) {
                throw new Exception("Error Processing Request", 1);
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function _check()
    {
        try {
            $response = $this->_validate();

            if ($response['validate'] === false) {
                throw new Exception();
            }

            $username_email = clearInput($this->input->post('username_email'));
            $password = clearInput($this->input->post('password'));

            $message = 'Login gagal. Pastikan email/username dan password Anda sudah benar.';

            $check = $this->_check_valid_username_password($username_email, $password);

            if (!$check) {
                $response['username_email'] = $username_email;
                $response['messages'] = $message;
                throw new Exception("Error Processing Request", 1);
            }

            $response = $this->users->createSession($username_email);
            return $response;
        } catch (Exception $e) {
            return $response;
        }
    }
}
