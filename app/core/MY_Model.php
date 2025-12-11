<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MY_Model extends CI_Model
{
	protected $_tabel = '';
	protected $_ci;
	protected $_user_id;
	protected $_session_email;
	protected $_session_id;
	protected $_username;
	protected $token;

	public function __construct()
	{
		$this->_ci = &get_instance();
		$user_id = $this->session->userdata('user_id') ?? null;
		$this->_username = $this->session->userdata('username');
		$this->token    = $this->session->userdata('token');

		$this->_user_id = $user_id;
		$this->_session_email = $this->session->userdata('email_admin');
		$this->_session_id    = $this->session->userdata('session_id_admin');
		parent::__construct();
	}

	private function _get_menu_by_user()
	{
		$this->load->model('app/App_model', 'app_model');
		$menu = $this->app_model->get_menu($this->_username, $this->token);

		$currentClass = strtolower($this->router->class);

		$activeMenuIds = [];
		foreach ($menu as $item) {
			if (strtolower($item->controller) === $currentClass) {
				$activeMenuIds[] = $item->menu_id;
				if (!empty($item->parent) && $item->parent != 0) {
					$activeMenuIds[] = $item->parent;
				}
			}
		}

		$menuIndex = [];
		foreach ($menu as $item) {
			$arr = (array) $item;
			$menuIndex[$arr['menu_id']] = [
				'menu_id'     => $arr['menu_id'],
				'controller'  => $arr['controller'] ?? '',
				'name'        => $arr['name'] ?? '',
				'parent'      => $arr['parent'] ?? 0,
				'parent_name' => $arr['parent_name'] ?? '',
				'order'       => isset($arr['order']) ? (int)$arr['order'] : 0,
				'view'        => isset($arr['view']) ? (int)$arr['view'] : 0,
				'insert'      => isset($arr['insert']) ? (int)$arr['insert'] : 0,
				'update'      => isset($arr['update']) ? (int)$arr['update'] : 0,
				'delete'      => isset($arr['delete']) ? (int)$arr['delete'] : 0,
				'import'      => isset($arr['import']) ? (int)$arr['import'] : 0,
				'export'      => isset($arr['export']) ? (int)$arr['export'] : 0,
				'child'       => [],
				'active'      => in_array($arr['menu_id'], $activeMenuIds) ? 'active' : '',
				'url'         => !empty($arr['controller']) ? base_url($arr['controller']) : '#',
			];
		}

		foreach ($menu as $item) {
			if (!empty($item->parent) && $item->parent != 0 && !isset($menuIndex[$item->parent])) {
				$menuIndex[$item->parent] = [
					'menu_id'     => $item->parent,
					'controller'  => '',
					'name'        => $item->parent_name ?? '',
					'parent'      => 0,
					'parent_name' => '',
					'order'       => 0,
					'view'        => 1,
					'insert'      => 0,
					'update'      => 0,
					'delete'      => 0,
					'import'      => 0,
					'export'      => 0,
					'child'       => [],
					'active'      => in_array($item->parent, $activeMenuIds) ? 'active' : '',
					'url'         => '#',
				];
			}
		}

		uasort($menuIndex, function ($a, $b) {
			return ($a['order'] ?? 0) <=> ($b['order'] ?? 0);
		});

		foreach ($menuIndex as $id => $item) {
			if (!empty($item['parent']) && $item['parent'] != 0) {
				$parentId = $item['parent'];
				if (isset($menuIndex[$parentId]) && $item['view'] == 1) {
					$menuIndex[$parentId]['child'][] = $item;
				}
			}
		}

		$group_menu = [];
		foreach ($menuIndex as $id => $item) {
			if (($item['parent'] == 0) && $item['view'] == 1) {
				if (!empty($item['child'])) {
					usort($item['child'], function ($a, $b) {
						return ($a['order'] ?? 0) <=> ($b['order'] ?? 0);
					});
				}
				$group_menu[] = $item;
			}
		}

		return $group_menu;
	}

	public function getCurrentMenuPermissions()
	{
		$currentController = strtolower($this->router->class);
		$menus = $this->_get_menu_by_user();

		foreach ($menus as $parent) {

			if (strtolower($parent['controller']) === $currentController) {
				return [
					'view'   => $parent['view'],
					'insert' => $parent['insert'],
					'update' => $parent['update'],
					'delete' => $parent['delete'],
					'import' => $parent['import'],
					'export' => $parent['export'],
					'url'    => $parent['url'],
				];
			}

			if (!empty($parent['child'])) {
				foreach ($parent['child'] as $child) {
					if (strtolower($child['controller']) === $currentController) {
						return [
							'view'   => $child['view'],
							'insert' => $child['insert'],
							'update' => $child['update'],
							'delete' => $child['delete'],
							'import' => $child['import'],
							'export' => $child['export'],
							'url'    => $child['url'],
						];
					}
				}
			}
		}

		return null;
	}

	public function _searchDefaultDatatables($field = [])
	{
		$search = !empty($this->input->post('search')) ? $this->input->post('search') : [];
		if (isset($search['value']) && strlen(trim($search['value'])) > 0  && is_array($field) && count($field) > 0) {
			$this->datatables->like($field[0], $search['value']);
			for ($i = 1; $i < count($field); $i++) {
				$this->datatables->or_like($field[$i], $search['value']);
			}
		}
	}

	public function get()
	{
		$args = func_get_args();

		if (count($args) > 1) {
			$this->db->where($args[0], $args[1]);
		}

		// $this->db->where(3);
		elseif (count($args) == 1 && is_numeric($args[0])) {
			$this->db->where('id', $args[0]);
		} else {
			$this->db->where($args[0]);
		}

		// Memastikan hanya mengembalikan 1 record.
		$this->db->limit(1);

		// $this->db->where('deleted_at IS NULL', null, false);

		// Mengembalikan hasil query.
		return $this->db->get($this->_tabel)->row();
	}

	// Insert.
	public function insert($data)
	{
		if (!is_object($data)) {
			$data = (object)$data;
		}
		$data->created_by = $data->updated_by = $this->_created_by;
		$this->db->set($data);
		$this->db->insert($this->_tabel);
		return $this->db->insert_id();
	}

	// Hapus data berdasarkan id yang diberikan.
	public function delete($id)
	{
		if (is_numeric($id)) {
			$this->db->where('id', $id);
		} else {
			if (is_array($id)) {
				$this->db->where($id);
			} else {
				return false;
			}
		}
		if (!is_array($id)) {
			$this->db->limit(1);
		}
		$this->db->delete($this->_tabel);

		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	protected function generate_csrf()
	{
		return $this->security->get_csrf_hash();
	}

	public function checkForeignKey($id, $tableName = "")
	{
		$db_name = $this->db->database;
		if ($tableName == "") {
			$tableName = $this->_tabel;
		}

		$query = "SELECT 
				TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME
			FROM
				INFORMATION_SCHEMA.KEY_COLUMN_USAGE
			WHERE
				REFERENCED_TABLE_SCHEMA = '{$db_name}' AND
				REFERENCED_TABLE_NAME = '{$tableName}'";

		$data = $this->db->query($query)->result_array();
		foreach ($data as $ky => $val) {
			$table_name = $val['TABLE_NAME'];
			$column = $val['COLUMN_NAME'];

			//search 
			$this->db->where(array($column => $id));
			$this->db->where('deleted_at IS NULL', null, false);
			$get = $this->db->get("{$table_name}")->num_rows();
			if ($get && $get > 0) {
				return false;
			}
		}
		return true;
	}

	public function getWithoutDeleteNull()
	{
		// Mendapatkan argumen yang dilewatkan ke fungsi ini.
		$args = func_get_args();

		// $this->db->where('name', $name);
		// $this->db->where('name !=', $name);
		if (count($args) > 1) {
			$this->db->where($args[0], $args[1]);
		}

		// $this->db->where(3);
		elseif (count($args) == 1 && is_numeric($args[0])) {
			$this->db->where('id', $args[0]);
		}

		// $this->db->where(array('id' => $id, 'nama' => $nama))
		// $this->db->where("name='Joe' AND status='boss' OR status='active'")
		else {
			$this->db->where($args[0]);
		}

		// Memastikan hanya mengembalikan 1 record.
		$this->db->limit(1);

		// Mengembalikan hasil query.
		return $this->db->get($this->_tabel)->row();
	}

	public function get_all_without_delete()
	{
		// Mendapatkan argumen yang dilewatkan ke fungsi ini.
		$args = func_get_args();

		// Dipanggil tanpa prameter.
		if (!count($args) > 0) {
			return $this->db->get($this->_tabel)->result();
		}

		// $this->db->where('name', $name);
		// $this->db->where('name !=', $name);
		elseif (count($args) > 1) {
			$this->db->where($args[0], $args[1]);
		}

		// $this->db->where(3);
		elseif (count($args) == 1 && is_numeric($args[0])) {
			$this->db->where('id', $args[0]);
		}

		// $this->db->where(array('id' => $id, 'nama' => $nama))
		// $this->db->where("name='Joe' AND status='boss' OR status='active'")
		elseif ((count($args) == 1) && (is_array($args[0]) || is_string($args[0]))) {
			$this->db->where($args[0]);
		}

		// Mengembalikan semua record hasil query.
		return $this->db->get($this->_tabel)->result();
	}
}
