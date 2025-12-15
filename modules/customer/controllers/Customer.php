<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends MY_Owner
{
    protected $title;

    public function __construct()
    {
        $this->_function_except = ['show','process', 'side'];
        parent::__construct();
        $this->title = "Customer";
    }

    public function index()
    {
        $this->template->title(ucfirst($this->title));
        $this->setTitlePage(ucfirst($this->title));
        $this->setParent('Master');
        $this->assetsBuild(['datatables']);
        $this->setJs("customer");

        $header_table = ['no', 'Name', 'Phone', 'Gender', 'Category', 'Date Of Birth', 'Email', 'Address', 'Allergies', 'Blood_type', 'Emergency Contact', 'Skin Type', 'Favorite Treatments', 'Note', 'Action'];
        $data['tables'] = generateTableHtml($header_table);
        $data['accessButton'] = $this->getCurrentMenuPermissions();

        $this->template->build('v_show', $data);
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