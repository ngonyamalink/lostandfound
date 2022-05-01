<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stat_db extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_stat()
    {
        $sql = "select
(select count(id) from item) as numitems,
(select count(id) from item_retrieval_request) as numretrievalrequests";

        $query = $this->db->query($sql);

        return ! empty($query) ? $query->row_array() : FALSE;
    }
}