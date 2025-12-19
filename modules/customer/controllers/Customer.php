<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends MY_Owner
{
    protected $title;
    protected $path;
    private $access;
    private $url_form;

    public function __construct()
    {
        $this->_function_except = ['show','process', 'side'];
        parent::__construct();
        $this->path = "customer";
        $this->title = ucfirst($this->path);
        $this->access = $this->getCurrentMenuPermissions();
        $this->url_form = base_url() . $this->path . "/process";
    }

    public function index()
    {
        $this->template->title(ucfirst($this->title));
        $this->assetsBuild(['datatables']);
        $this->setJs($this->path);

        $data=[
            'tables' => $this->load->view(
                PATH_COMPONENTS . 'tables/v_table_round',
                [
                    'id'      => 'table-data',
                    'columns' => [
                        'Customer ID',
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
                        'Note'
                    ],
                ],
                true
            ),
            'c_views_header' => $this->load->view(PATH_COMPONENTS . 'views/v_header', [
                'titlePage' => $this->title,
                'parentMenu' => "Master"
            ], true),
            'c_input_search' => $this->load->view(PATH_COMPONENTS . 'input/search', "", true),
            'c_btn_filter' => $this->load->view(PATH_COMPONENTS . 'buttons/filter', [
                "url"=> $this->path."/side"
            ], true),
            'c_btn_add' => $this->access['insert'] ? $this->load->view(PATH_COMPONENTS . 'buttons/add', [
                "url" => $this->path . "/insert",
                "label" => "Add ". $this->title
            ], true):'',
            'c_btn_export' => $this->access['export'] ? $this->load->view(PATH_COMPONENTS . 'buttons/export', ["url" => $this->path . "/side"], true) : '',
            'c_btn_import' => $this->access['import'] ? $this->load->view(PATH_COMPONENTS . 'buttons/import', ["url" => $this->path . "/side"], true) : ''
        ];

        $this->template->build('v_show', ['c_show' => $this->load->view(PATH_COMPONENTS . 'views/v_show', $data, true)]);
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
            'url_form' => $this->url_form,
            'form' => $this->load->view('v_form', $set_data, true),
        ];

        $html = $this->load->view($this->_v_form_modal, $data, true);

        echo json_encode(['html' => $html]);
        exit();
    }

    public function update($id)
    {
        $this->template->title('Manage User');
        $this->setTitlePage('Manage User');
        $this->setParent('Master');
        $this->setJs('customer_detail');

        $data = [
            'table_doc' => $this->load->view(
                PATH_COMPONENTS . 'tables/v_table_round',
                [
                    'id'      => 'table-data',
                    'columns' => [
                        'Document Name',
                        'Upload',
                        ''
                    ],
                ],
                true
            ),
            'details' => $this->customer_model->detail($id),
            'url_form' => $this->url_form
        ];

        $this->template->build('v_form_detail', $data);
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
            'url_form' => $this->url_form,
            'form' => $this->load->view('v_form_side', "", true),
        ];

        $html = $this->load->view($this->_v_form_side, $data, true);

        echo json_encode(['html' => $html]);
        exit();
    }
}