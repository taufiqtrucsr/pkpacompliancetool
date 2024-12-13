<?php
if (!defined('BASEPATH')) {echo "No direct script access allowed";}

class ShorternModel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function save_new_alias($url, $alias,$inviter_id){
        $data = array('alias'=>$alias,'url'=>$url,'inviter_id'=>$inviter_id,'created'=>date('Y-m-d H:i:s'));
        $this->db->insert('links',$data);
    }

    public function getLinksTable($shortUrl){
        // $this->db->select('links.*, links.first_name, links.last_name, links.email, users.phone_no');
		$this->db->from('links');
		$this->db->where(array('links.alias'=>$shortUrl));
        $query = $this->db->get();
        $run = $query->row();
        if ($run != '') {
            # code...
            return $run->url;
        }else{
            return FALSE;
        }
    }

    public function alias_from_url($url){
        $alias = "";
        $this->db->select('alias');
        $query = $this->db->get_where('links', array('url'=>$url),1,0);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){
                $alias = $row->alias;
            }
        }
        return $alias;
    }

    public function does_alias_exist($alias){
        $this->db->select('id');
        $query = $this->db->get_where('links', array('alias'=>$alias), 1,0);

        if ($query->num_rows()>0){
            return TRUE;
        }

        else {
            return FALSE;
        }
    }

    // public function get_long_url($alias){
    //     $alias="";
    //     $this->db->select('url');
    //     $query = $this->db->get_where('links', array('alias'=>$alias),1,0);

    //     if ($query->num_rows()>0) {
    //         foreach ($query->result() as $row) {
    //             return $row->url;
    //         }
    //     }
    //     return '/error_404';
    // }

    public function get_long_url($alias){

        $this->db->select('url');
        $query = $this->db->get_where('links', array('alias'=>$alias),1,0);
    
        if ($query->num_rows()>0) {
            foreach ($query->result() as $row) {
                return $row->url;
            }
        }
     return 'error_404';
    }
}
?>