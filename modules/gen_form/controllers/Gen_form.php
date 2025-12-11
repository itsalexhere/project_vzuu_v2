<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gen_form extends MY_Owner
{
	protected $title;

	public function __construct()
	{
		$this->_function_except = ['show', 'process', 'status', 'update'];
		parent::__construct();
		$this->title = 'Form';
		$this->load->model('menu/menu_model', 'menu_model');
		$this->load->model('users/users_model', 'user_model');
	}

	public function Index()
	{
		$this->template->title(ucfirst($this->title));
		$this->setTitlePage(ucfirst($this->title));
		$this->setParent('Generator');
		$this->assetsBuild(['datatables']);
		$this->setJs('gen_form');

		$header_table = ['no', 'name', 'type', 'table', 'description', 'status', 'action'];

		$data['tables'] = generateTableHtml($header_table);

		$this->template->build('v_show', $data);
	}

	public function show()
	{
		isAjaxRequestWithPost();
		$this->function_access('view');

		echo $this->gen_form_model->show();
	}

	public function insert()
	{
		$this->template->title('Detail Form');
		$this->setTitlePage('Detail Form');
		$this->setParent('Generator');
		$this->assetsBuild(['datatables', 'repeater']);

		$header_table = ['nama menu', 'controller', 'parent', 'status', 'action'];

		$data = [
			'tables' => generateTableHtml($header_table),
			'list_menu' => $this->menu_model->getParentMenuList(),
			'list_table' => $this->db->list_tables()
		];

		$this->setJs('gen_form_detail');
		$this->template->build('v_form', $data);
	}

	public function update()
	{
		$this->template->title('Detail Form');
		$this->setTitlePage('Detail Form');
		$this->setParent('Generator');

		$header_table = ['nama menu', 'controller', 'parent', 'status', 'action'];

		$data['tables'] = generateTableHtml($header_table);

		$this->setJs('gen_form_detail');
		$this->template->build('v_form', $data);
	}

	public function process()
	{
		isAjaxRequestWithPost();
		$this->function_access('insert');

		$response = $this->gen_form_model->save();
		echo json_encode($response);
		exit();
	}
}
