<?php defined('BASEPATH') or exit('No direct script access allowed');

abstract class MY_Owner extends MY_Template
{
	protected $_username;
	protected $token;
	protected $_menu;
	protected $_menu_active;
	protected $_controller_except = '';
	protected $_function_except   = [];

	public function __construct()
	{
		$this->_username = $this->session->userdata('username');
		$this->token    = $this->session->userdata('token');

		$this->_check_session();
		$this->_set_menu();
		$this->_check_access_page();
		$this->_logout_url = base_url() . "logout";
		$this->_account_url = base_url() . "account";

		parent::__construct();

		$this->_get_menu();
		$this->load->model($this->router->class . '_model', strtolower($this->router->class) . '_model');
	}

	private function _check_session()
	{
		$username     = $this->_username;
		$token 		  = $this->token;

		try {
			if ($username == null || $token == null) {
				throw new Exception("Session not found", 1);
			}

			$this->load->model('app/App_model', 'app_model');
			$check = $this->app_model->_check_data_user($username, $token);

			if (!$check) {
				throw new Exception("This Account has been suspended", 1);
			}
		} catch (Exception $e) {

			if ($this->input->is_ajax_request()) {
				header("HTTP/1.1 401 Unauthorized");
				exit;
			}

			redirect(base_url(), 'location');
		}
	}

	private function _set_menu()
	{
		$menu        = $this->app_model->get_menu($this->_username, $this->token);
		$this->_menu = $menu;
	}

	protected function _check_access_page()
	{
		$class  = $this->router->class;
		$method = $this->router->method;
		$menu   = $this->_menu;

		$key = array_search($class, array_column(json_decode(json_encode($menu), true), 'controller'));

		try {
			if ($key === false && $this->_controller_except == '') {
				throw new Exception;
			}

			switch ($method) {
				case 'index':
					if ($key !== false) {
						$view    = 1;
						$view_db = $menu[$key]->view;
						if ($view != $view_db) {
							throw new Exception;
						}
					}
					break;
				case 'insert':
					if ($key !== false) {
						$insert    = 1;
						$insert_db = $menu[$key]->insert;
						if ($insert != $insert_db) {
							throw new Exception;
						}
					}
					break;

				case 'update':
					if ($key !== false) {
						$update    = 1;
						$update_db = $menu[$key]->update;
						if ($update != $update_db) {
							throw new Exception;
						}
					}
					break;
				case 'delete':
					if ($key !== false) {
						$delete    = 1;
						$delete_db = $menu[$key]->delete;
						if ($delete != $delete_db) {
							throw new Exception;
						}
					}
					break;
				case 'import':
					if ($key !== false) {
						$import    = 1;
						$import_db = $menu[$key]->import;
						if ($import != $import_db) {
							throw new Exception;
						}
					}
					break;
				case 'export':
					if ($key !== false) {
						$export    = 1;
						$export_db = $menu[$key]->import;
						if ($export != $export_db) {
							throw new Exception;
						}
					}
					break;
				default:
					if ($this->_controller_except == '') {
						if (count($this->_function_except) == 0) {
							throw new Exception;
						}

						$search_except_method = array_search($method, $this->_function_except);
						if ($search_except_method === false) {
							throw new Exception;
						}
					}
					break;
			}

			$this->_menu_active = isset($menu[$key]) ? $menu[$key] : false;
		} catch (Exception $e) {
			if ($this->input->is_ajax_request()) {
				header("HTTP/1.0 404 Not Found");
				exit;
			}
			pageError();
		}
	}

	private function _get_menu()
	{
		$menu = $this->_menu;

		$class = strtolower($this->router->class);

		$activeMenuIds = [];

		foreach ($menu as $key => $item) {
			if (strtolower($item->controller) === $class) {
				$activeMenuIds[] = $item->menu_id;

				if ($item->parent != 0) {
					$activeMenuIds[] = $item->parent;
				}
			}
		}

		$menuIndex = [];
		foreach ($menu as $item) {
			$arr = (array) $item;
			$arr['child'] = [];
			$arr['active'] = in_array($arr['menu_id'], $activeMenuIds) ? 1 : 0;

			$menuIndex[$arr['menu_id']] = $arr;
		}

		foreach ($menu as $item) {
			if ($item->parent != 0 && !isset($menuIndex[$item->parent])) {
				$menuIndex[$item->parent] = [
					'menu_id' => $item->parent,
					'controller' => '',
					'name' => $item->parent_name,
					'icon' => $item->parent_icon,
					'parent' => 0,
					'parent_name' => '',
					'order' => 0,
					'view' => 1,
					'insert' => 0,
					'update' => 0,
					'delete' => 0,
					'import' => 0,
					'export' => 0,
					'child' => [],
					'active' => 0
				];
			}
		}

		uasort($menuIndex, function ($a, $b) {
			return ($a['order'] ?? 0) <=> ($b['order'] ?? 0);
		});

		$group_menu = [];
		foreach ($menuIndex as $id => &$item) {
			if ($item['parent'] == 0) {
				if ($item['view'] == 1) {
					$group_menu[$id] = &$item;
				}
			} else {
				if (isset($menuIndex[$item['parent']]) && $item['view'] == 1) {
					$menuIndex[$item['parent']]['child'][] = &$item;
				}
			}
		}

		unset($item);

		foreach ($group_menu as &$item) {
			$item['active'] = $item['active'] ? 'active' : '';
			if (!empty($item['child'])) {
				foreach ($item['child'] as &$child) {
					$child['active'] = $child['active'] ? 'active' : '';
				}
				unset($child);
			}
		}
		unset($item);

		$this->setMenu($group_menu);
		$this->setJsType(JS_OWNER);
	}

	private function _get_menu_by_user()
	{
		$menu = $this->_menu;
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

	protected function function_access($function = null)
	{
		try {
			if ($function === null) {
				throw new Exception;
			}

			if ($this->_menu_active !== false && isset($this->_menu_active->{$function})) {
				if ((int)$this->_menu_active->{$function} === 0) {
					throw new Exception;
				}
			}
			return true;
		} catch (Exception $e) {
			pageError();
		}
	}

	protected function checkThereIsButtonDatatables()
	{
		$update = $this->_menu_active->update;
		$delete = $this->_menu_active->delete;
		$import = $this->_menu_active->import;
		$export = $this->_menu_active->export;

		if ($update == 0 && $delete == 0 && $import == 0 && $export == 0) {
			return false;
		}
		return true;
	}
}
