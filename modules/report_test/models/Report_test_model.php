<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_test_model extends MY_Model
{
    use MY_Tables;

    public function __construct()
    {
        parent::__construct();
    }

    public function list_fields()
    {
        return $this->db
            ->select('form_id, sql')
            ->from('ms_form_rawsql')
            ->where('form_id', '75')
            ->get()
            ->row_array();
    }

    public function show()
    {
        $formData = $this->list_fields();

        if (!$formData) {
            return json_encode(['data' => [], 'message' => 'Data not found']);
        }

        $query = $formData['sql'];
        $form_id = $formData['form_id'];

        $result = $this->db->query($query)->result();

        foreach ($result as &$row) {
            $row->action = generateActionButtons($form_id, 'report_test', [], []);
        }

        return json_encode(['data' => $result]);
    }
    
}
