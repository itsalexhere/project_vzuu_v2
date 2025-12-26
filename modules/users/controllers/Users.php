<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Owner
{

	protected $title;
	protected $path;
	private $access;

	public function __construct()
	{
		$this->_function_except = [
			'account',
			'settings',
			'show',
			'process',
			'status',
			'paging',
			'access_menu',
			'process_access_menu',
			'detail'
		];

		parent::__construct();
		$this->load->model([
			'roles/Roles_model'          => 'roles',
			'menu/Menu_model'            => 'menu',
			'user_access/User_access_model' => 'access_control'
		]);
		$this->path = "users";
		$this->title = "Manage ".ucfirst($this->path);
		$this->access = $this->getCurrentMenuPermissions();
	}

	public function index()
	{
		$this->template->title(ucfirst($this->title));
		$this->assetsBuild(['datatables']);
		$this->setJs("users");

		$data = [
			'tables' => $this->load->view(
				PATH_COMPONENTS . 'tables/v_table_round',
				[
					'id'      => 'table-data',
					'columns' => ['User ID', 'name', 'email', 'status', 'joined date', 'last active'],
				],
				true
			),
			'c_views_header' => $this->load->view(PATH_COMPONENTS . 'views/v_header', [
				'titlePage' => $this->title,
				'parentMenu' => "Master"
			], true),
			'c_input_search' => $this->load->view(PATH_COMPONENTS . 'input/search', "", true),
			'c_btn_filter' => $this->load->view(PATH_COMPONENTS . 'buttons/filter', ["url" => $this->path . "/side"], true),
			'c_btn_add' => $this->access['insert'] ? $this->load->view(PATH_COMPONENTS . 'buttons/add', 
							[
								"url" => $this->path . "/insert",
								"label" => "Add Users"
							], true) : ''
		];

		$this->template->build('v_show', ['c_show' => $this->load->view(PATH_COMPONENTS . 'views/v_show', $data, true)]);
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

		// $viewTable = $this->db
		// 	->select('access_view')
		// 	->from('ms_user_accessviewtable')
		// 	->where('ms_menu_id', 'ee2b0c52-7164-4f56-9b8a-88ad291f59e7')
		// 	->where('ms_user_id', '1')
		// 	->get()
		// 	->row_array();

		// pre($viewTable);

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
}
