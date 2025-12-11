<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends MY_Owner
{

	protected $title;

	public function __construct()
	{
		$this->_function_except = ['show', 'process', 'status', 'paging', 'insert_group', 'applications'];
		parent::__construct();
		$this->title = 'Pengajuan Pinjaman';
	}

	public function Index()
	{
		$this->template->title(ucfirst($this->title));
		$this->setTitlePage(ucfirst($this->title));
		$this->setParent('Master');
		$this->assetsBuild(['datatables']);
		$this->setJs('orders');

		$header_table = ['nama menu', 'controller', 'parent', 'status', 'action'];

		$data['tables'] = generateTableHtml($header_table);

		$this->template->build('v_show', $data);
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

	public function applications()
	{
		$this->template->title("Form Pengajuan Pinjaman");
		$this->setTitlePage("Form Pengajuan Pinjaman");
		$this->setParent('Master');
		$this->assetsBuild(['datatables']);
		$this->setJs($this->title);

		$header_table = ['nama menu', 'controller', 'parent', 'status', 'action'];

		$data['tables'] = generateTableHtml($header_table);

		$this->template->build('v_form_applications', $data);
	}

	public function insert_group()
	{
		isAjaxRequestWithPost();

		$data = [
			'list_menu' => $this->menu_model->getParentMenuList()
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
			'list_menu' => $this->menu_model->getParentMenuList()
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

	public function delete($id)
	{
		isAjaxRequestWithPost();
		$response = $this->menu_model->delete($id);
		echo json_encode($response);
		exit();
	}
}
