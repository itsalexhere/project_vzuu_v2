<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_test extends MY_Owner
{
    protected $title;

    public function __construct()
    {
        $this->_function_except = ['show','process'];
        parent::__construct();
        $this->title = "Report Test";
    }

    public function index()
    {
        $this->template->title(ucfirst($this->title));
        $this->setTitlePage(ucfirst($this->title));
        $this->setParent('Master');
        $this->assetsBuild(['datatables']);
        $this->setJs("report_test");

        $header_table = ['no', 'controller', 'menu_name', 'user_name'];
        $data['tables'] = generateTableHtml($header_table);

        $this->template->build('v_show', $data);
    }

    public function show()
    {
        isAjaxRequestWithPost();
        $this->function_access('view');

        echo $this->report_test_model->show();
    }
}