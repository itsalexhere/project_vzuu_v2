<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends MY_Owner
{
	protected $title;
	protected $path;
	private $access;

	public function __construct()
	{
		$this->_function_except = ['show', 'process', 'status', 'paging', 'insert_group', 'orders', 'process_ctg'];
		parent::__construct();
		$this->path = "menu";
		$this->title = ucfirst($this->path);
		$this->access = $this->getCurrentMenuPermissions();
	}

	public function Index()
	{
		$this->template->title(ucfirst($this->title));
		$this->assetsBuild(['datatables','sortable']);
		$this->setJs($this->path);

		$data = [
			'tables' => $this->load->view(PATH_COMPONENTS .'tables/v_table_round',
				[
					'id'      => 'table-data',
					'columns' => ['no', 'name', 'controller', 'category','parent', 'order', 'status', 'action'],
				],
				true
			),
			'c_views_header' => $this->load->view(PATH_COMPONENTS . 'views/v_header', [
				'titlePage' => $this->title,
				'parentMenu' => "Master"
			], true),
			'c_input_search' => $this->load->view(PATH_COMPONENTS . 'input/search', "", true),
			'c_btn_add' => $this->access['insert'] ? $this->load->view(
				PATH_COMPONENTS . 'buttons/add',
				[
					"url" => $this->path . "/insert", 
					"label" => "Add " . $this->title
				],
				true
			) : ''
		];

		$this->template->build('v_show', ['c_show' => $this->load->view(PATH_COMPONENTS . 'views/v_show', $data, true)]);
	}

	public function show()
	{
		isAjaxRequestWithPost();
		$this->function_access('view');

		echo $this->menu_model->show();
	}

	public function insert()
	{
		isAjaxRequestWithPost();

		$data = [
			'list_menu' => $this->menu_model->getParentMenuList()
		];

		$data = array(
			'title_modal' => 'Tambah ' . ucfirst($this->title),
			'url_form' => base_url() . "menu/process",
			'form' => $this->load->view('v_form', $data, true),
		);
		$html = $this->load->view($this->_v_form_modal, $data, true);

		echo json_encode(array('html' => $html));
		exit();
	}

	public function insert_group()
	{
		isAjaxRequestWithPost();

		$data = [
			'list_menu' => $this->menu_model->getParentMenuList(),
			'list_menu_ctg' => $this->menu_model->listMenuCategory()
		];

		$data = array(
			'title_modal' => 'Tambah ' . ucfirst($this->title),
			'url_form' => base_url() . "menu/process",
			'form' => $this->load->view('v_form_group', $data, true),
		);

		$html = $this->load->view($this->_v_form_modal, $data, true);

		echo json_encode(array('html' => $html));
		exit();
	}

	public function update($id)
	{
		isAjaxRequestWithPost();

		$data = [
			'detail' => $this->menu_model->_getMenuById($id),
			'list_menu' => $this->menu_model->getParentMenuList(),
			'list_menu_ctg' => $this->menu_model->listMenuCategory()
		];

		$data = array(
			'title_modal' => 'Edit ' . ucfirst($this->title),
			'url_form' => base_url() . "menu/process",
			'form' => $this->load->view('v_form', $data, true),
		);
		$html = $this->load->view($this->_v_form_modal, $data, true);

		echo json_encode(array('html' => $html));
		exit();
	}

	public function process()
	{
		isAjaxRequestWithPost();
		$this->function_access('insert');

		$response = $this->menu_model->save();
		echo json_encode($response);
		exit();
	}

	public function process_ctg()
	{
		isAjaxRequestWithPost();
		$this->function_access('insert');

		$response = $this->menu_model->save_ctg();
		echo json_encode($response);
		exit();
	}

	public function delete($id)
	{
		isAjaxRequestWithPost();
		$response = $this->menu_model->delete($id);
		echo json_encode($response);
		exit();
	}

	public function orders()
	{
		isAjaxRequestWithPost();

		$response = $this->menu_model->orders();
		echo json_encode($response);
		exit();
	}
}
