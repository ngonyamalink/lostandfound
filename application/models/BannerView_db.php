<?php

class BannerView_db extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_bannerview($data)
    {
        $this->db->insert('banner_views', $data);
    }
    
    public function gettotalviewsperbanner($banner_id) {
       $sql = "select count(*) as numviews from banner_views where banner_id=$banner_id";

       $query = $this->db->query($sql);
       
       return !empty($query)?$query->row_array():FALSE;
       
       
    }
   
}
?>