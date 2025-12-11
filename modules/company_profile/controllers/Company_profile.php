<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company_profile extends MY_Owner
{
    protected $title;

    public function __construct()
    {
        $this->_function_except = ['show','process'];
        parent::__construct();
        $this->title = "Company Profile";
    }

    public function index()
    {
        $this->template->title(ucfirst($this->title));
        $this->setTitlePage(ucfirst($this->title));
        $this->setParent('Master');
        $this->setJs("company_profile");

        $data['details'] = json_encode($this->company_profile_model->detail());

        $this->template->build('v_show', $data);
    }

    public function process()
    {
        isAjaxRequestWithPost();
        $this->function_access('insert');

        $response = $this->company_profile_model->save();
        echo json_encode($response);
        exit();
    }
}