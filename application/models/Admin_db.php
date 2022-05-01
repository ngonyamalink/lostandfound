<?php

class Admin_db extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->load->library(array(
            "session",
            "email"
        ));
    }

    public function get_subscriptions($colunm = NULL)
    {
        $sql = "select * from subscription";

        if ($colunm == 'email') {
            $sql = "select email from subscription where email not in ('.')";
        } else if ($colunm == 'phone') {
            $sql = "select phone from subscription where phone not in ('.')";
        }

        $query = $this->db->query($sql);
        return ! empty($query) ? $query->result_array() : FALSE;
    }
}

?>