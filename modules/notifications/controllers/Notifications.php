<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifications extends MY_Owner
{
    protected $title;
    protected $path;

    public function __construct()
    {
        $this->_function_except = ['show'];
        parent::__construct();
        $this->title = "Notifications";
        $this->path = "notifications";
    }

    public function index()
    {
        $this->template->title(ucfirst($this->title));
        $this->setTitlePage(ucfirst($this->title));
        $this->assetsBuild(['datatables']);
        $this->setJs("customer");

        $this->template->build('v_show');
    }

    public function show()
    {
        isAjaxRequestWithPost();
        $this->function_access('view');

        echo $this->customer_model->show();
    }
}