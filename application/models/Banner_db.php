<?php

class Banner_db extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_banner($data)
    {
        $this->db->insert('banners', $data);
    }
    
    public function update_banner($where,$data){
        
        $this->db->where($where)->update("banners",$data);
    }
    
    
    public function get_banners()
    {
       $sql = "select * from banners where status = 'Active'";
       
       $query = $this->db->query($sql);
       
       return !empty($query)?$query->row_array():false;
    }
}
?>