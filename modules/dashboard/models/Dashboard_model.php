<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends MY_Model
{
    use MY_Tables;
    public function __construct()
    {
        $this->_tabel = $this->_table_ms_users;
        parent::__construct();
    }
}
