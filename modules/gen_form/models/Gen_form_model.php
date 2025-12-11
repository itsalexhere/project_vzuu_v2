<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gen_form_model extends MY_Model
{
    use MY_Tables;

    public function __construct()
    {
        $this->_tabel = $this->_table_ms_form;
        parent::__construct();
    }

    public function show()
    {
        $this->db->select('id,form_name,form_type,table_name,description,status', false);
        $this->db->from("{$this->_tabel}");
        $this->db->order_by('id', 'ASC');

        $result = $this->db->get()->result();

        foreach ($result as &$row) {
            $row->action = generateActionButtons($row->id, 'gen_form', [], $this->getCurrentMenuPermissions());
        }

        return json_encode(['data' => $result]);
    }

    private function _validate()
    {
        $response = [
            'success'  => false,
            'validate' => true,
            'messages' => [],
            'type'     => 'insert',
        ];

        $roleValidate = ['trim', 'required', 'xss_clean'];

        $statusTable = $this->input->post('status-table');

        if ($statusTable) {
            $fieldName = ($statusTable === 'enabled') ? 'table_name' : 'table_list_name';

            $this->form_validation->set_rules($fieldName, 'Table Name', $roleValidate);
        }

        if (strtolower($this->input->post('form_type')) === 'report') {
            $this->form_validation->set_rules('raw_sql', 'Raw Sql', $roleValidate);
        }

        $this->form_validation->set_rules('name', 'Controller Name', $roleValidate);

        $this->form_validation->set_error_delimiters(
            '<div class="' . VALIDATION_MESSAGE_FORM . '">',
            '</div>'
        );

        if ($this->form_validation->run() === false) {
            $response['validate'] = false;

            foreach ($this->input->post() as $key => $value) {
                $response['messages'][$key] = form_error($key);
            }
        }

        return $response;
    }

    public function save()
    {
        $this->db->trans_begin();
        try {
            $response = self::_validate();

            if (!$response['validate']) {
                return $response;
            }

            $tableStatus = $this->input->post('status-table');
            $statusMenu = $this->input->post('status-menu');
            $tableName = $this->input->post('table_name');
            $tableList = $this->input->post('table_list_name');
            $selectedTable = !empty($tableName) ? $tableName : $tableList;
            $formType = strtolower($this->input->post('form_type')) === 'report';
            $formName = $this->input->post('name');

            $formData = [
                'form_name'   => $formName,
                'form_type'   => $this->input->post('form_type'),
                'table_name'  => $selectedTable ?? "",
                'description' => $this->input->post('description'),
                'status'      => $this->input->post('status') == 'enabled' ? 1 : 0,
                'created_by'  => $this->_user_id,
            ];

            $this->db->insert($this->_table_ms_form, $formData);

            if ($this->db->affected_rows() <= 0) {
                throw new Exception('Failed to insert form');
            }

            $formId = $this->db->insert_id();

            if ($statusMenu === 'enabled') {

                // Normalize controller name
                $controller = strtolower(preg_replace('/[^a-zA-Z0-9_]/', '_', $formName));

                // Cek apakah controller sudah ada
                $check = $this->db->get_where($this->_table_ms_menus, ['controller' => $controller])->row_array();
                if (!$check) {

                    // Ambil last order
                    $lastOrder = $this->db->select('MAX(`order`) AS last_order')
                        ->from($this->_table_ms_menus)
                        ->get()
                        ->row_array();

                    $nextOrder = ($lastOrder['last_order'] ?? 0) + 1;

                    // Generate UUID
                    $setUuid = uuid();

                    // Insert menu baru
                    $this->db->insert($this->_table_ms_menus, [
                        'id'         => $setUuid,
                        'controller' => $controller,
                        'name'       => $formName,
                        'parent'     => $this->input->post('parent') !== '' ? $this->input->post('parent') : 0,
                        'icon'       => '',
                        'order'      => $nextOrder,
                        'status'     => 1,
                        'created_by' => $this->_user_id
                    ]);

                    // Insert akses user
                    $this->db->insert($this->_table_ms_user_accesscontrols, [
                        'id'          => uuid(),
                        'ms_menus_id' => $setUuid,
                        'ms_user_id'  => $this->_user_id,
                        'view'        => 1,
                        'insert'      => 1,
                        'update'      => 1,
                        'delete'      => 1,
                        'import'      => 0,
                        'export'      => 0
                    ]);
                }
            }

            if (!$formType) {
                if ($tableStatus === 'enabled') {
                    $fields = json_decode($this->input->post('fields'), true);
                } else {

                    $excluded = [
                        'id',
                        'created_by',
                        'created_at',
                        'updated_by',
                        'updated_at',
                        'deleted_by',
                        'deleted_at'
                    ];

                    $fields = $this->db->query("DESCRIBE `$selectedTable`")->result_array();

                    $fields = array_filter($fields, function ($row) use ($excluded) {
                        return !in_array($row['Field'], $excluded);
                    });

                    $fields = array_map(function ($row) {
                        $type = strtolower(preg_replace('/\(.*\)/', '', $row['Type']));

                        return [
                            'field_label'  => ucwords(str_replace('_', ' ', $row['Field'])),
                            'field_name'   => $row['Field'],
                            'field_type'   => $this->mapTableFieldType($type),
                            'status-field' => 'enabled',
                            'required'     => 'enabled'
                        ];
                    }, $fields);
                }

                $order = 1;
                foreach ($fields as $f) {

                    $dataInsert = [
                        'form_id'      => $formId,
                        'field_label'  => ucwords($f['field_label'] ?? ''),
                        'field_name'   => strtolower(preg_replace('/\s+/', '_', $f['field_label'])),
                        'field_type'   => $f['field_type'] ?? '',
                        'placeholder'  => ucwords($f['field_label'] ?? ''),
                        'column_type'  => $f['column_type'] ?? 'col-md-12',
                        'is_required'  => ($f['required'] ?? '') === 'enabled' ? 1 : 0,
                        'ordering'     => $order++,
                        'status'       => ($f['status-field'] ?? '') === 'enabled' ? 1 : 0,
                        'created_by'   => $this->_user_id,
                    ];

                    $this->db->insert($this->_table_ms_form_fields, $dataInsert);

                    if ($this->db->affected_rows() <= 0) {
                        throw new Exception("Failed inserting field: " . $f['field_label']);
                    }
                }

                if ($tableStatus === 'enabled') {
                    $masterData = [
                        'name'        => $tableName,
                        'description' => '',
                        'created_by'  => $this->_user_id,
                        'created_at'  => date('Y-m-d H:i:s'),
                    ];

                    $this->db->insert($this->_table_ms_create_table, $masterData);
                    $masterId = $this->db->insert_id();

                    foreach ($fields as $f) {
                        $detail = [
                            'ms_create_table_id' => $masterId,
                            'name_table'         => $f['field_label'],
                            'type_table'         => $this->mapFieldType($f['field_type']),
                            'length_table'       => $this->defaultLength($f['field_type']),
                            'default_table'      => $f['field_default'] ?? "null",
                        ];

                        $this->db->insert($this->_table_ms_create_table_detail, $detail);
                    }

                    $sql = $this->generateCreateTableSQL($tableName, $fields);
                    if ($sql) {
                        $this->db->query($sql);
                    }
                }

                $formFieldsData = $this->db->get_where($this->_table_ms_form_fields, ['form_id' => $formId])->result_array();
                $this->_createModuleFilesAndFolders($formName, $formFieldsData);
            } else {
                $rawQuery = $this->input->post('raw_sql') ?? "";

                $dataInsert = [
                    'form_id'      => $formId,
                    'sql'  => $rawQuery
                ];

                $this->db->insert('ms_form_rawsql', $dataInsert);

                $this->_createModuleFilesAndFolderReports($formData, $rawQuery, $formId);
            }

            $this->db->trans_commit();
            return [
                'success'  => true,
                'validate' => true,
                'messages' => 'Successfully Insert Data'
            ];
        } catch (Exception $e) {

            $this->db->trans_rollback();
            return [
                'success'  => false,
                'validate' => false,
                'messages' => $e->getMessage()
            ];
        }
    }

    private function _createModuleFilesAndFolders($formName, array $form_fields_data)
    {
        $controller_name = $formName;

        $safe  = strtolower(preg_replace('/[^a-zA-Z0-9_]/', '_', $controller_name));
        $class = ucfirst($safe);

        // Path direktori
        $module_base      = APPPATH . "../modules/$safe/";
        $controller_path  = $module_base . "controllers/";
        $model_path       = $module_base . "models/";
        $views_path       = $module_base . "views/";
        $assets_js_path   = APPPATH . "../assets/js/$safe/";

        // Buat direktori
        foreach ([$module_base, $controller_path, $model_path, $views_path, $assets_js_path] as $dir) {
            if (!is_dir($dir)) mkdir($dir, 0775, true);
        }

        // Generate isi file
        $model_content      = $this->generateModelContent($safe, $class, $form_fields_data);
        $controller_content = $this->generateControllerContent($safe, $class, $controller_name, $form_fields_data);
        $view_show_content  = $this->generateViewShowContent($safe);
        $view_form_content  = $this->generateViewFormContent($form_fields_data);
        $js_content         = $this->generateJsContent($safe, $form_fields_data);

        // Simpan file
        file_put_contents($controller_path . "$class.php", $controller_content);
        file_put_contents($model_path . "{$class}_model.php", $model_content);
        file_put_contents($views_path . "v_show.php", $view_show_content);
        file_put_contents($views_path . "v_form.php", $view_form_content);
        file_put_contents($assets_js_path . "$safe.js", $js_content);
    }

    private function _createModuleFilesAndFolderReports($formHeader, $rawQuery, $formId)
    {
        $controller_name = $formHeader['form_name'];
        $rawQuery = $this->input->post('raw_sql') ?? "";

        preg_match('/select\s+(.*?)\s+from\s+/is', $rawQuery, $matches);

        $fields = "";
        if (!empty($matches[1])) {
            $fields = $matches[1];
        }

        $fieldArray = array_map('trim', explode(',', $fields));

        $fieldArray = array_map(function ($val) {

            if (stripos($val, ' as ') !== false) {
                $parts = preg_split('/\s+as\s+/i', $val);
                return trim(end($parts)); // ambil setelah AS
            }

            if (strpos($val, '.') !== false) {
                $parts = explode('.', $val);
                return trim(end($parts));
            }

            return trim($val);
        }, $fieldArray);


        $safe  = strtolower(preg_replace('/[^a-zA-Z0-9_]/', '_', $controller_name));
        $class = ucfirst($safe);

        $module_base      = APPPATH . "../modules/$safe/";
        $controller_path  = $module_base . "controllers/";
        $model_path       = $module_base . "models/";
        $views_path       = $module_base . "views/";
        $assets_js_path   = APPPATH . "../assets/js/$safe/";

        foreach ([$module_base, $controller_path, $model_path, $views_path, $assets_js_path] as $dir) {
            if (!is_dir($dir)) mkdir($dir, 0775, true);
        }

        // Generate isi file
        $controller_content      = $this->generateControllerReport($safe, $class, $controller_name, $fieldArray);
        $model_content = $this->generateModelReport($class, $formId);
        $view_show_content  = $this->generateViewShowReport($safe);
        $js_content         = $this->generateJsContentReport($safe, $fieldArray);

        // Simpan file
        file_put_contents($controller_path . "$class.php", $controller_content);
        file_put_contents($model_path . "{$class}_model.php", $model_content);
        file_put_contents($views_path . "v_show.php", $view_show_content);
        file_put_contents($assets_js_path . "$safe.js", $js_content);
    }

    private function generateControllerContent($safe, $class, $menu_name, $fields)
    {
        $headers = [];

        foreach ($fields as $f) {
            $headers[] = "'" . $f['field_label'] . "'";
        }

        $header_str = implode(', ', $headers);

        return <<<PHP
            <?php
            defined('BASEPATH') or exit('No direct script access allowed');

            class {$class} extends MY_Owner
            {
                protected \$title;

                public function __construct()
                {
                    \$this->_function_except = ['show','process'];
                    parent::__construct();
                    \$this->title = "{$menu_name}";
                }

                public function index()
                {
                    \$this->template->title(ucfirst(\$this->title));
                    \$this->setTitlePage(ucfirst(\$this->title));
                    \$this->setParent('Master');
                    \$this->assetsBuild(['datatables']);
                    \$this->setJs("{$safe}");

                    \$header_table = ['no', {$header_str}, 'Action'];
                    \$data['tables'] = generateTableHtml(\$header_table);
                    \$data['accessButton'] = \$this->getCurrentMenuPermissions();

                    \$this->template->build('v_show', \$data);
                }

                public function show()
                {
                    isAjaxRequestWithPost();
                    \$this->function_access('view');

                    echo \$this->{$safe}_model->show();
                }

                public function insert()
                {
                    isAjaxRequestWithPost();

                    \$set_data = [
                        'form_fields_html' => \$this->{$safe}_model->list_fields(),
                    ];

                    \$data = [
                        'title_modal' => 'Tambah ' . ucfirst(\$this->title),
                        'url_form' => base_url() . "{$safe}/process",
                        'form' => \$this->load->view('v_form', \$set_data, true),
                    ];

                    \$html = \$this->load->view(\$this->_v_form_modal, \$data, true);

                    echo json_encode(['html' => \$html]);
                    exit();
                }

                public function update(\$id)
                {
                    isAjaxRequestWithPost();

                    \$set_data = [
                        'detail' => \$this->{$safe}_model->detail(\$id),
                        'form_fields_html' => \$this->{$safe}_model->list_fields(),
                    ];

                    \$data = [
                        'title_modal' => 'Edit ' . ucfirst(\$this->title),
                        'url_form' => base_url() . "{$safe}/process",
                        'form' => \$this->load->view('v_form', \$set_data, true),
                    ];

                    \$html = \$this->load->view(\$this->_v_form_modal, \$data, true);

                    echo json_encode(['html' => \$html]);
                    exit();
                }

                public function process()
                {
                    isAjaxRequestWithPost();
                    \$this->function_access('insert');

                    \$response = \$this->{$safe}_model->save();
                    echo json_encode(\$response);
                    exit();
                }

                public function delete(\$id)
                {
                    isAjaxRequestWithPost();
                    \$response = \$this->{$safe}_model->delete(\$id);
                    echo json_encode(\$response);
                    exit();
                }
            }
            PHP;
    }

    private function generateModelContent($safe, $class, $form_fields_data)
    {
        $validate_rules = "";
        $formId = "";
        foreach ($form_fields_data as $field) {
            if (isset($field['is_required']) && $field['is_required'] == 1) {
                $field_name = $field['field_name'];
                $label      = $field['placeholder'] ?? ucfirst(str_replace('_', ' ', $field_name));
                $validate_rules .= "        \$this->form_validation->set_rules('$field_name', '$label', ['trim', 'required', 'xss_clean']);\n";
            }

            $formId = $field['form_id'];
        }

        return <<<PHP
            <?php
            defined('BASEPATH') or exit('No direct script access allowed');

            class {$class}_model extends MY_Model
            {
                use MY_Tables;

                public function __construct()
                {
                    \$this->_tabel = "ms_{$safe}";
                    parent::__construct();
                }

                public function list_fields()
                {
                    \$this->db->select('
                        b.field_name,
                        b.field_type,
                        b.placeholder,
                        b.column_type,
                        b.is_required,
                        b.status,
                        b.ordering
                    ');
                    \$this->db->from("{\$this->_table_ms_form} a");
                    \$this->db->join("{\$this->_table_ms_form_fields} b", 'b.form_id = a.id', 'left');
                    \$this->db->where('a.id', '{$formId}');
                    \$this->db->order_by('b.ordering', 'ASC');

                    return \$this->db->get()->result_array();
                }

                public function show()
                {
                    \$this->db->select('*');
                    \$this->db->from(\$this->_tabel);

                    \$result = \$this->db->get()->result();

                    foreach (\$result as &\$row) {
                        \$row->action = generateActionButtons(\$row->id, '{$safe}',[], \$this->getCurrentMenuPermissions());
                    }

                    return json_encode(['data' => \$result]);
                }

                public function detail(\$id)
                {
                    \$this->db->select('*');
                    \$this->db->from("{\$this->_tabel}");
                    \$this->db->where('id', \$id);

                    return \$this->db->get()->row();
                }

                public function _validate()
                {
                    \$response = ['success' => false, 'validate' => true, 'messages' => []];

                    \$this->load->library('form_validation');

                    $validate_rules
                    \$this->form_validation->set_error_delimiters('<div class="' . VALIDATION_MESSAGE_FORM . '">', '</div>');

                    if (\$this->form_validation->run() === false) {
                        \$response['validate'] = false;
                        foreach (\$this->input->post() as \$key => \$value) {
                            \$response['messages'][\$key] = form_error(\$key);
                        }
                    }

                    return \$response;
                }

                public function save()
                {
                    \$this->db->trans_begin();
                    try {
                        // Jalankan Validasi
                        \$response = self::_validate();
                        if (!\$response['validate']) {
                            throw new Exception('Validation Error');
                        }

                        // Ambil ID (jika ada)
                        \$id = clearInput(\$this->input->post('id'));

                        // Ambil semua post data
                        \$postData = \$this->input->post();

                        \$fields = [];
                        foreach (\$postData as \$key => \$value) {
                            \$fields[\$key] = is_string(\$value) ? clearInput(\$value) : \$value;
                        }

                        if (\$id == '' || \$id == null) {
                            \$execute = \$this->db->insert(\$this->_tabel, \$fields);
                        } else {
                            \$this->db->where('id', \$id);
                            \$execute = \$this->db->update(\$this->_tabel, \$fields);
                        }

                        if (!\$execute) {
                            \$response['messages'] = 'Insert / Update Data Gagal!';
                            throw new Exception('DB Error');
                        }

                        // Commit
                        \$this->db->trans_commit();
                        \$response['success'] = true;
                        \$response['messages'] = 'Successfully Saved Data';
                        return \$response;
                    }catch (Exception \$e) {
                        \$this->db->trans_rollback();
                        return \$response;
                    }
                }

                public function delete(\$id){
                    \$this->db->trans_begin();
                    try {
                        \$check = \$this->detail(\$id);

                        if (!\$check) {
                            throw new Exception('Data Not Found', 404);
                        }

                        \$execute = \$this->db->delete(\$this->_tabel, ['id' => \$id]);

                        if (!\$execute) {
                            throw new Exception('Update Data Gagal!!');
                        }

                        \$this->db->trans_commit();
                        \$response['success'] = true;
                        \$response['messages'] = 'Successfully Deleted Data';
                        return \$response;
                    } catch (Exception \$e) {
                        \$this->db->trans_rollback();
                        return \$response;
                    }
                }
                
            }

            PHP;
    }

    private function generateViewShowContent($safe)
    {
        return <<<HTML
            <?php
            defined('BASEPATH') or exit('No direct script access allowed');
            ?>

            <div class="d-flex flex-column flex-column-fluid">

                <div id="kt_app_content" class="app-content flex-column-fluid">

                    <div id="kt_app_content_container" class="app-container container-fluid">

                        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">

                            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                    <?= \$titlePage ?>
                                </h1>

                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <li class="breadcrumb-item text-muted">
                                        <?= \$parentMenu ?>
                                    </li>

                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>

                                    <li class="breadcrumb-item text-muted"><?= \$titlePage ?></li>
                                </ul>
                            </div>
                        </div>

                        <div class="card mt-6">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                 <?= searchActionButtons() . addButtonForm('{$safe}/insert', \$titlePage, 0, \$accessButton['insert'] ?? 0) ?>
                                </div>

                                <?= \$tables ?>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            HTML;
    }

    private function sanitizeName($str)
    {
        return strtolower(str_replace(' ', '_', $str));
    }

    private function generateViewFormContent()
    {
        return <<<'PHP'
                <input type="hidden" name="id" value="<?= $detail->id ?? '' ?>">
                <?= generateFormFields($form_fields_html, $detail ?? "") ?>
        PHP;
    }

    private function generateJsContent($safe, $form_fields_data)
    {
        $cols = "";
        foreach ($form_fields_data as $f) {
            $cols .= "        { data: \"{$f['field_name']}\" },\n";
        }

        return <<<JS
            $(document).ready(function () {
                var url = base_url() + "{$safe}/show";

                var columns = 
                [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    $cols        
                    { data: "action", width: "17%" }
                ];

                gridDatatables(url, columns);
            });

            addData();
            editData();
            modalClose();
            modalProcess();
            modalDelete();

            JS;
    }

    private function generateCreateTableSQL($tableName, $fields)
    {
        if ($this->db->table_exists($tableName)) {
            return null;
        }

        $sql = "CREATE TABLE `$tableName` (\n";
        $sql .= "  `id` INT AUTO_INCREMENT PRIMARY KEY,\n";

        foreach ($fields as $f) {

            $name    = strtolower(preg_replace('/\s+/', '_', $f['field_label'] ?? ''));
            if (empty($name)) continue;

            $type    = $this->mapFieldType($f['field_type'] ?? '');
            $length  = $this->defaultLength($f['field_type'] ?? '');
            $default = $f['field_default'] ?? null;

            $lenSQL = ($length > 0) ? "($length)" : "";

            if ($default === "current_timestamp") {
                $defaultSQL = " DEFAULT CURRENT_TIMESTAMP";
            } elseif ($default === "null") {
                $defaultSQL = " DEFAULT NULL";
            } elseif (!empty($default)) {
                $defaultSQL = " DEFAULT '$default'";
            } else {
                $defaultSQL = "";
            }

            $sql .= "  `$name` $type$lenSQL$defaultSQL,\n";
        }

        // Tambahkan default system fields
        $sql .= "  `created_by` VARCHAR(25) DEFAULT NULL,\n";
        $sql .= "  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,\n";
        $sql .= "  `updated_by` VARCHAR(25) DEFAULT NULL,\n";
        $sql .= "  `updated_at` TIMESTAMP NULL DEFAULT NULL,\n";
        $sql .= "  `deleted_by` VARCHAR(25) DEFAULT NULL,\n";
        $sql .= "  `deleted_at` TIMESTAMP NULL DEFAULT NULL,\n";

        $sql = rtrim($sql, ",\n") . "\n";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        return $sql;
    }

    private function mapFieldType($type)
    {
        $map = [
            'text'     => 'VARCHAR',
            'textarea' => 'TEXT',
            'number'   => 'INT',
            'date'     => 'DATE',
            'email'    => 'VARCHAR',
            'password' => 'VARCHAR',
            'file'     => 'VARCHAR',
            'radio'    => 'VARCHAR',
            'checkbox' => 'VARCHAR',
            'select2'  => 'VARCHAR'
        ];

        return $map[$type] ?? 'VARCHAR';
    }

    private function defaultLength($type)
    {
        $type = strtolower($type);

        $defaultLength = [
            'text'     => 255,
            'email'    => 255,
            'password' => 255,
            'file'     => 255,
            'radio'    => 255,
            'checkbox' => 255,
            'select2'  => 255,
            'number'   => 11,
        ];

        return $defaultLength[$type] ?? 0;
    }

    private function mapTableFieldType($dbType)
    {
        $type = strtolower(preg_replace('/\(.*\)/', '', $dbType));

        $map = [
            'varchar' => 'text',
            'text'    => 'textarea',
            'int'     => 'number',
            'date'    => 'date',
            'datetime' => 'date',
            'timestamp' => 'date',
            'decimal' => 'number',
            'bigint'  => 'number',
            'float'   => 'number',
            'double'  => 'number',
            'tinyint' => 'number'
        ];

        return $map[$type] ?? 'text';
    }

    private function generateControllerReport($safe, $class, $menu_name, $fields)
    {
        $headers = [];

        foreach ($fields as $f) {
            $headers[] = "'" . $f . "'";
        }

        $header_str = implode(', ', $headers);

        return <<<PHP
            <?php
            defined('BASEPATH') or exit('No direct script access allowed');

            class {$class} extends MY_Owner
            {
                protected \$title;

                public function __construct()
                {
                    \$this->_function_except = ['show','process'];
                    parent::__construct();
                    \$this->title = "{$menu_name}";
                }

                public function index()
                {
                    \$this->template->title(ucfirst(\$this->title));
                    \$this->setTitlePage(ucfirst(\$this->title));
                    \$this->setParent('Master');
                    \$this->assetsBuild(['datatables']);
                    \$this->setJs("{$safe}");

                    \$header_table = ['no', {$header_str}];
                    \$data['tables'] = generateTableHtml(\$header_table);

                    \$this->template->build('v_show', \$data);
                }

                public function show()
                {
                    isAjaxRequestWithPost();
                    \$this->function_access('view');

                    echo \$this->{$safe}_model->show();
                }
            }
            PHP;
    }

    private function generateModelReport($class, $formId)
    {
        return <<<PHP
            <?php
            defined('BASEPATH') or exit('No direct script access allowed');

            class {$class}_model extends MY_Model
            {
                use MY_Tables;

                public function __construct()
                {
                    parent::__construct();
                }

                public function list_fields()
                {
                    return \$this->db
                        ->select('form_id, sql')
                        ->from('ms_form_rawsql')
                        ->where('form_id', '{$formId}')
                        ->get()
                        ->row_array();
                }

                public function show()
                {
                    \$formData = \$this->list_fields();

                    if (!\$formData) {
                        return json_encode(['data' => [], 'message' => 'Data not found']);
                    }

                    \$query = \$formData['sql'];
                    \$form_id = \$formData['form_id'];

                    \$result = \$this->db->query(\$query)->result();

                    foreach (\$result as &\$row) {
                        \$row->action = generateActionButtons(\$form_id, 'report_test', [], []);
                    }

                    return json_encode(['data' => \$result]);
                }
                
            }

            PHP;
    }

    private function generateViewShowReport()
    {
        return <<<HTML
            <?php
            defined('BASEPATH') or exit('No direct script access allowed');
            ?>

            <div class="d-flex flex-column flex-column-fluid">

                <div id="kt_app_content" class="app-content flex-column-fluid">

                    <div id="kt_app_content_container" class="app-container container-fluid">

                        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">

                            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                    <?= \$titlePage ?>
                                </h1>

                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <li class="breadcrumb-item text-muted">
                                        <?= \$parentMenu ?>
                                    </li>

                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>

                                    <li class="breadcrumb-item text-muted"><?= \$titlePage ?></li>
                                </ul>
                            </div>
                        </div>

                        <div class="card mt-6">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                 <?= searchActionButtons()?>
                                </div>

                                <?= \$tables ?>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            HTML;
    }

    private function generateJsContentReport($safe, $form_fields_data)
    {
        $cols = "";
        foreach ($form_fields_data as $f) {
            $cols .= "        { data: \"{$f}\" },\n";
        }

        return <<<JS
            $(document).ready(function () {
                var url = base_url() + "{$safe}/show";

                var columns = 
                [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    $cols
                ];

                gridDatatables(url, columns);
            });
            JS;
    }
}
