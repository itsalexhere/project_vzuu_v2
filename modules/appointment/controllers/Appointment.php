<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Appointment extends MY_Owner
{
    protected $title;
    protected $path;
    private $access;

    public function __construct()
    {
        $this->_function_except = ['show','process', 'side'];
        parent::__construct();
        $this->title = "Appointment";
        $this->path = "appointment";
        $this->access = $this->getCurrentMenuPermissions();
    }

    public function index()
    {
        $this->template->title(ucfirst($this->title));
        $this->assetsBuild(['datatables']);
        $this->setJs("appointment");

        $headerTable = [
            'no',
            'Name',
            'Phone',
            'Gender',
            'Category',
            'Date Of Birth',
            'Email',
            'Address',
            'Allergies',
            'Blood Type',
            'Emergency Contact',
            'Skin Type',
            'Favorite Treatments',
            'Note',
            'Action'
        ];

        $data=[
            'tables' => generateTableHtml($headerTable),
            'c_views_header' => $this->load->view($this->_v_components . 'views/v_header', [
                'titlePage' => ucfirst($this->title),
                'parentMenu' => "Master"
            ], true),
            'c_input_search' => $this->load->view($this->_v_components . 'input/search', "", true),
            'c_btn_filter' => $this->load->view($this->_v_components . 'buttons/filter', ["url"=> $this->path."/side"], true),
            'c_btn_add' => $this->access['insert'] ? $this->load->view($this->_v_components . 'buttons/add', ["url" => $this->path . "/insert"], true):''
        ];

        $this->template->build('v_show', ['c_show' => $this->load->view($this->_v_components . 'views/v_show', $data, true)]);
    }

    public function show()
    {
        isAjaxRequestWithPost();
        $this->function_access('view');

        echo $this->customer_model->show();
    }

    public function insert()
    {
        isAjaxRequestWithPost();

        $set_data = [
            'form_fields_html' => $this->customer_model->list_fields(),
        ];

        $data = [
            'title_modal' => 'New ' . ucfirst($this->title),
            'url_form' => base_url() . "customer/process",
            'form' => $this->load->view('v_form', $set_data, true),
        ];

        $html = $this->load->view($this->_v_form_modal, $data, true);

        echo json_encode(['html' => $html]);
        exit();
    }

    public function update($id)
    {
        isAjaxRequestWithPost();

        $set_data = [
            'detail' => $this->customer_model->detail($id),
            'form_fields_html' => $this->customer_model->list_fields(),
        ];

        $data = [
            'title_modal' => 'Edit ' . ucfirst($this->title),
            'url_form' => base_url() . "customer/process",
            'form' => $this->load->view('v_form', $set_data, true),
        ];

        $html = $this->load->view($this->_v_form_modal, $data, true);

        echo json_encode(['html' => $html]);
        exit();
    }

    public function process()
    {
        isAjaxRequestWithPost();
        $this->function_access('insert');

        $response = $this->customer_model->save();
        echo json_encode($response);
        exit();
    }

    public function delete($id)
    {
        isAjaxRequestWithPost();
        $response = $this->customer_model->delete($id);
        echo json_encode($response);
        exit();
    }

    public function side()
    {
        isAjaxRequestWithPost();

        $data = [
            'title_modal' => 'Filter',
            'url_form' => base_url() . "customer/process",
            'form' => $this->load->view('v_form_side', "", true),
        ];

        $html = $this->load->view($this->_v_form_side, $data, true);

        echo json_encode(['html' => $html]);
        exit();
    }
}