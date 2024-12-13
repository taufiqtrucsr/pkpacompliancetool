<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect extends CI_Controller
{
    public function index()
    {
        $alias = $this->uri->segment(1);
        $this->db->select('url');
        $query = $this->db->get_where('links', array('alias' => $alias), 1, 0);
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row)
            {
                $this->load->helper('url');
                redirect($row->url, 'refresh');
            }
        } else {
            echo "Alias '$alias'not found";
        }
    }
}

?>