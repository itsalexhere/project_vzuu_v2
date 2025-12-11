<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roles extends MY_Owner
{
    protected $title;

    public function __construct()
    {
        $this->_function_except = ['show','process'];
        parent::__construct();
        $this->title = "Roles";
    }

    public function index()
    {
        $this->template->title(ucfirst($this->title));
        $this->setTitlePage(ucfirst($this->title));
        $this->setParent('Master');
        $this->assetsBuild(['datatables']);
        $this->setJs("roles");

        $header_table = ['no', 'Name', 'Action'];
        $data['tables'] = generateTableHtml($header_table);
        $data['accessButton'] = $this->getCurrentMenuPermissions();

        $this->template->build('v_show', $data);
    }

    public function show()
    {
        isAjaxRequestWithPost();
        $this->function_access('view');

        echo $this->roles_model->show();
    }

    public function insert()
    {
        isAjaxRequestWithPost();

        $set_data = [
            'form_fields_html' => $this->roles_model->list_fields(),
        ];

        $data = [
            'title_modal' => 'Tambah ' . ucfirst($this->title),
            'url_form' => base_url() . "roles/process",
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
            'detail' => $this->roles_model->detail($id),
            'form_fields_html' => $this->roles_model->list_fields(),
        ];

        $data = [
            'title_modal' => 'Edit ' . ucfirst($this->title),
            'url_form' => base_url() . "roles/process",
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

        $response = $this->roles_model->save();
        echo json_encode($response);
        exit();
    }

    public function delete($id)
    {
        isAjaxRequestWithPost();
        $response = $this->roles_model->delete($id);
        echo json_encode($response);
        exit();
    }
}