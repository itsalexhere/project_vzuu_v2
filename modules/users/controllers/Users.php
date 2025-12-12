<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Owner
{
	public function __construct()
	{
		$this->_function_except = [
			'account',
			'settings',
			'show',
			'process',
			'status',
			'paging',
			'update_permission',
			'data_menu',
			'access_menu',
			'process_access_menu',
			'detail'
		];

		parent::__construct();

		$this->load->model([
			'roles/Roles_model'            => 'roles',
			'menu/Menu_model'            => 'menu',
			'user_access/User_access_model' => 'access_control'
		]);
	}

	public function index()
	{
		$this->template->title('Manage User');
		$this->setTitlePage('Manage User');
		$this->setParent('Master');
		$this->assetsBuild(['datatables']);
		$this->setJs('users');

		$header_table = array('User ID','name', 'email','status', 'joined date', "last active");

		$data['tables'] = generateTableHtml($header_table);

		$this->template->build('v_show', $data);
	}

	public function show()
	{
		isAjaxRequestWithPost();
		$this->function_access('view');

		echo $this->users_model->show();
	}

	public function insert()
	{
		isAjaxRequestWithPost();

		$data = array(
			'title_modal' => 'Add User',
			'url_form' => base_url() . "users/process",
			'form' => $this->load->view('v_form', '', true),
			'buttonName' => 'Confirm',
		);
		$html = $this->load->view($this->_v_form_modal, $data, true);

		echo json_encode(array('html' => $html));
		exit();
	}

	public function detail($id)
	{
		$this->template->title('Manage User');
		$this->setTitlePage('Manage User');
		$this->setParent('Master');
		$this->setJs('user_details');

		$data = [
			'user_detail' => $this->users_model->findById($id),
			'list_access' => $this->menu->getUserMenuById($id)
		];

		$this->template->build('v_form_detail', $data);
	}

	public function process()
	{
		isAjaxRequestWithPost();
		$this->function_access('insert');

		$response = $this->users_model->save();
		echo json_encode($response);
		exit();
	}

	public function update_permission()
	{
		isAjaxRequestWithPost();

		$response = $this->access_control->update_permission();
		echo json_encode($response);
		exit();
	}

	public function process_access_menu()
	{
		isAjaxRequestWithPost();
		$this->function_access('insert');

		$response = $this->users_model->update_permission();
		echo json_encode($response);
		exit();
	}

	public function update($id)
	{
		isAjaxRequestWithPost();
		try {
			if ($id == null) {
				throw new Exception("Failed to request Edit", 1);
			}

			$dataItems = $this->users_model->getItems($id, $this->_session_email);

			if (!is_array($dataItems)) {
				throw new Exception($dataItems, 1);
			}

			$data = array(
				'title_modal' => 'Edit User Admin',
				'url_form' => base_url() . "users/process",
				'form' => $this->load->view('v_form', $dataItems, true),
			);

			$html = $this->load->view($this->_v_form_modal, $data, true);
			$response['html'] = $html;
			echo json_encode($response);
			exit();
		} catch (Exception $e) {
			$response['failed'] = true;
			$response['message'] = $e->getMessage();
			echo json_encode($response);
			exit();
		}
	}

	public function data_menu()
	{
		$id = $this->input->post('id');
		$keyword = $this->input->post('keyword');

		if (empty($id)) {
			return [];
		}

		$menus = $this->menu->_getRawMenuDataByUserId($id, $keyword);

		$menu_map = [];
		$children_map = [];

		foreach ($menus as $menu) {
			$menu_map[$menu['id']] = $menu;
			if ($menu['parent'] != 0) {
				$children_map[$menu['parent']][] = $menu;
			}
		}

		$detailForm = [
			'user_id' => $this->session->user_id,
			'menu_map' => $menu_map,
			'children_map' => $children_map
		];

		echo json_encode(['data' => $detailForm]);
	}

	public function access_menu()
	{
		$this->template->title('Users Access Menu');
		$this->setTitlePage('Users Access Menu');
		$this->setParent('Master');
		$this->assetsBuild(['datatables']);
		$this->setJs('users_access_menu');

		$header_table = array('no', 'menu', 'status', 'parent', "view", "insert", "update", "delete", "import", "export");
		$data['tables'] = generateTableHtml($header_table);

		$this->template->build('v_access_menu', $data);
	}
}
