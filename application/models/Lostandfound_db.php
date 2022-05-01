<?php

class Lostandfound_db extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function additem($data)
    {
        $this->db->insert("item", $data);
    }

    public function gettotalitems()
    {
        $sql = "select count(*) as numitems from item";

        $query = $this->db->query($sql);

        return ! empty($query) ? $query->row_array() : FALSE;
    }

    public function getitem($str)
    {
        $sql = "select * from item where (itemuniquenumber like '%" . $str . "%' OR itemdescription like '%" . $str . "%' OR location like '%" . $str . "%') limit 6";
        $query = $this->db->query($sql);
        return ! empty($query) ? $query->result_array() : FALSE;
    }

    public function additemretrievalrequest($data)
    {
        $this->db->insert("item_retrieval_request", $data);
    }

    public function get_item_by_id($id)
    {
        $sql = "select * from item where id = $id ";
        $query = $this->db->query($sql);
        return ! empty($query) ? $query->row_array() : FALSE;
    }
}

?>