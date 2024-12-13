<?php 
###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Deepak Salve (deepak@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - July 2021
###+------------------------------------------------------------------------------------------------

class ResourceModel extends CI_Model {
	
	public function __construct(){	
		$this->load->database();
	}	
    
    public function get_categories(){
		$this->db->select('resources_categories.*');		
		$this->db->where('deleted_flag', 0);
		// $this->db->where(array('id !='=>$category_id));
		return $this->db->get('resources_categories')->result_array();
	}

    public function get_single_category(){
		$this->db->select('resources_categories.*');		
		$this->db->where('deleted_flag', 0);
		return $this->db->get('resources_categories')->row();
	}

    public function get_resources($category_id=0){
    	$this->db->select('resources.*,(select name from `resources_categories` where id=resources.category_id) as category');
    	$this->db->where(array('publish='=>1));
    	if($category_id > 0) $this->db->where(array('category_id='=>$category_id));
    	$this->db->order_by("resources.id","desc");
		return $this->db->get('resources')->result_array();
	}
	
	public function get_upcoming_resources(){
        $sql="select resources.*,(select name from `resources_categories` where id=resources.category_id) as category FROM `resources` where publish=1 AND category_id!=5 order by id desc limit 4";
	    $query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
	}

	public function get_bookmark_resource_num($user_id,$resource_id){
        $sql="select count(id) as count from `resource_bookmark` where user_id=$user_id AND resource_id=$resource_id";
	    $query = $this->db->query($sql);
		$result = $query->row_array();
        //echo "<pre>";print_r($result);echo "</pre>";die;
		return $result['count'];
	}

	public function get_share_resource_num($user_id,$resource_id,$medium){
        $sql="select count(id) as count from `resource_shares` where user_id=$user_id AND resource_id=$resource_id AND medium='$medium'";
	    $query = $this->db->query($sql);
		$result = $query->row_array();
        //echo "<pre>";print_r($result);echo "</pre>";die;
		return $result['count'];
	}

	public function get_resource_newsletter_num($email){
        $sql="select count(id) as count from `resource_newsletter` where email='$email'";
	    $query = $this->db->query($sql);
		$result = $query->row_array();
        //echo "<pre>";print_r($result);echo "</pre>";die;
		return $result['count'];
	}

	public function get_share_resources_count($resource_id){
        $sql="select count(id) as count from `resource_shares` where resource_id=$resource_id";
	    $query = $this->db->query($sql);
		$result = $query->row_array();
        //echo "<pre>";print_r($result);echo "</pre>";die;
		return $result['count'];
	}

	public function get_bookmark_resources_byuser($user_id){
        $sql="select r.*,(select name from `resources_categories` where id=r.category_id) as category from `resource_bookmark` as rb left join resources as r on rb.resource_id=r.id  where user_id=$user_id order by r.id desc";
	    $query = $this->db->query($sql);
		$result = $query->result_array();
        //echo "<pre>";print_r($result);echo "</pre>";die;
		return $result;
	}

	public function get_search_resources($search_term){
		$sql="select r.*,(select name from `resources_categories` where id=r.category_id) as category from resources as r where r.title like '%$search_term%' order by r.id desc";
	    $query = $this->db->query($sql);
		$result = $query->result_array();
        //echo "<pre>";print_r($result);echo "</pre>";die;
		return $result;
	}

	public function count_resources(){
		return $this->db->get('resources')->num_rows();
	}

	public function get_resource_details($id){
		$sql="select resources.*,resources_images.image,(select name from `resources_categories` where id=resources.category_id) as category FROM `resources` left join resources_images on resources.id=resources_images.resource_id where resources.id=$id";
	    $query = $this->db->query($sql);
		$result = $query->row_array();
		return $result;
	}

	public function get_resource_images($id){
		$sql="select * FROM `resources_images` where resource_id=$id";
	    $query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function content_wrap($original_string,$num_words){
		$words = array();
		$original_string=strip_tags($original_string);
		$words = explode(" ", $original_string, $num_words);
		$shown_string = "";

		if(count($words) == $num_words){
		   $count=$num_words-1;	
		   $words[$count] = " ... ";
		}

		return $shown_string = implode(" ", $words);
	}

	public function get_resource_tagline(){
		$sql="select * FROM `resource_tagline`";
	    $query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}
	
	public function get_resource_tagline_images(){
		$sql="SELECT * FROM `resource_tagline_images` WHERE tag_id = 1";
	    $query = $this->db->query($sql);
		$row = $query->result();
		return $row;
	}
}
