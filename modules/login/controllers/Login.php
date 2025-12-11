<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Logintemplate
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model', 'loginmodel');
    }

    public function index()
    {
        $this->template->title($setting_profile['name'] ?? "");
        $this->template->build('v_login');
    }

    public function check()
    {
        isAjaxRequestWithPost();
        $response = $this->loginmodel->_check();

        echo json_encode($response);
        exit();
    }
}
