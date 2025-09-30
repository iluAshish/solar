<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Remove_records extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function remove_data($id, $field, $table) {
        $this->db->where($field, $id);
        return $this->db->delete($table);
    }

}
