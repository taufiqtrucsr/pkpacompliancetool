<?php
/**
 * Global model Develop By vishal parmar
 * 7/12/2019
 * import point is this model version compatiple i.e only for Codeigniter 3
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Global_model extends CI_Model {

    function _construct() {
        parent::_construct();
    }

    // Insert Query
    function insert($table_name, $data = array()) {
        // $data['created_at'] = $this->date_time;
        // $data['created_by'] = $this->user_id;
        // $data['updated_at'] = $this->date_time;
        // $data['updated_by'] = $this->user_id;
        $this->db->insert($table_name, $data);        
        $id = $this->db->insert_id();  
        return $id;
    }

    function insert_batch($table_name,$data) {
        // Insert
        // echo "<br>";
        //          print_r($this->db->last_query());
        $insert = $this->db->insert_batch($table_name, $data);
        // Return the status
        return $insert ? true : false;
    }


    // Select Query
    function total_number_row($query_builder){ 
        $query = $this->query_builder($query_builder);
        return $query->num_rows();
    }

    function get_data_list($query_builder){
        $query = $this->query_builder($query_builder);
        return $query->result_array();
    }

    function get_data_row($query_builder){
       $query = $this->query_builder($query_builder);
        return $query->row_array();
    }

    function count_row($query_builder){
        $query = $this->query_builder($query_builder);
        $array = $query->result_array();
        return sizeOf($array); 
    }

    function query_builder($query_builder){
        
        $table_name = $query_builder['table_name'];
        $select = (!empty($query_builder['select']))  ? $query_builder['select'] : array(); // array
        $where = (!empty($query_builder['where']))  ? $query_builder['where'] : array() ; // array
        $where_in = (!empty($query_builder['where_in']))  ? $query_builder['where_in'] : array() ; // array
        $order_by = (!empty($query_builder['order_by'])) ? $query_builder['order_by'] : array() ; // array
        $group_by = (!empty($query_builder['group_by'])) ? $query_builder['group_by'] : array() ; // array 
        $distinct =  (isset($query_builder['distinct'])) ? $query_builder['distinct'] : 0;
        $like = (!empty($query_builder['like'])) ? $query_builder['like'] : array() ;  // array
        $limit = (isset($query_builder['limit'])) ? $query_builder['limit'] : 0;
        $offset = (isset($query_builder['offset'])) ? $query_builder['offset'] : 0;
        $joinQuery = (!empty($query_builder['joinQuery'])) ? $query_builder['joinQuery'] : array() ; // array
        $or_like = (!empty($query_builder['or_like'])) ? $query_builder['or_like'] : array() ; // array
        $sum_column = (!empty($query_builder['sum_column']))  ? $query_builder['sum_column'] : ''; // array    
       
            // echo "<pre>";
            // print_r($or_like);
            
            if($sum_column!="") {
                $this->db->select_sum($sum_column);
            }
            $this->db->select($select);

            foreach ($like as $key => $value) {
                $this->db->like($key, $value);
            }

            // foreach ($or_like as $key => $value) {
            //     $this->db->or_like($key, $value);
            // }
    
            if (isset($or_like) && is_array($or_like)) {
                $counter = 0;
                if(sizeof($or_like) > 1) {
                    $this->db->group_start();
                    foreach ($or_like as $key => $value) {
                        if($counter==0){
                            // $this->db->or_like($key, $value, "start"); // 25 06 2020
                            $this->db->or_like($key, $value);
                        }elseif($counter==sizeof($or_like)-1){
                            // $this->db->or_like($key, $value, "end"); // 25 06 2020
                            $this->db->or_like($key, $value);
                        }else{
                            $this->db->or_like($key, $value);
                        }
                        $counter++;
                    }
                    $this->db->group_end();
                }
                else {
                    foreach ($or_like as $key => $value) {
                        $this->db->or_like($key, $value);
                    }
                }
            }

           
            if (isset($where) && !empty($where) && is_array($where)) {
                foreach ($where as $key => $value) {
                    if(is_array($value)) {
                        foreach($value as $date_value){
                            if (strpos($date_value, '>=') !== false) {
                                $this->db->where($key." >=", str_replace(">= ", "", $date_value));
                            } else if (strpos($date_value, '<=') !== false) {
                                $this->db->where($key." <=", str_replace("<= ", "", $date_value));
                            } else if (strpos($date_value, '>') !== false) {
                                $this->db->where($key." >", str_replace("> ", "", $date_value));
                            } else if (strpos($date_value, '<') !== false) {
                                $this->db->where($key." <", str_replace("< ", "", $date_value));
                            } else {
                                $this->db->where($key, $date_value);
                            }
                        }
                    } else {
                        $this->db->where($key, $value);
                    }
                }
            }

            if (!empty($where_in)) {
                foreach ($where_in as $key => $value) {
                    $this->db->where_in($key, $value);
                }
            }

            // if (!empty($where_not)) {
             
            //     foreach ($where_not as $key => $value) {
            //         $this->db->where_not_in($key, $value);
            //     }
            // }

            if (isset($group_by) && !empty($group_by) && is_array($group_by)) {
                $this->db->group_by($group_by);
            }

            if (isset($order_by) && !empty($order_by) && is_array($order_by)) {
                foreach ($order_by as $key => $value) {
                    $this->db->order_by($key, $value);
                }
            }
            
            if(sizeof($joinQuery)>0 && is_array($joinQuery)){
                foreach ($joinQuery as $table => $condition) {
                    $this->db->join($table,$condition);
                }
            }

            if (isset($distinct)) {
                $this->db->distinct();
            }

            if ($limit != 0) {
                $this->db->limit($limit, $offset);
            }
            
            $query = $this->db->get($table_name);

            // echo "<br>";
            // print_r($this->db->last_query());
            //  die;
            return  $query;

    }

    // Custom Query ( it should be written in controller )
    function get_data_custom($query)
    {
        $result = $this->db->query($query);
        if(count($result->result_array()) > 0){
        return $result->result_array();
        }else{
        return false;
        }
    }

    // Update Query
    function update($query_builder) {
        // $data['updated_at'] = $this->date_time;
        // $data['updated_by'] = $this->user_id;    
        $table_name = $query_builder['table_name'];
        $data = (!empty($query_builder['data']))  ? $query_builder['data'] : array(); // array
        $where = (!empty($query_builder['where']))  ? $query_builder['where'] : array() ; // array
        $order_by = (!empty($query_builder['order_by'])) ? $query_builder['order_by'] : array() ; // array
        $limit = (isset($query_builder['limit'])) ? $query_builder['limit'] : 0;
    
        if (count($where) > 0) {
            $this->db->where($where);
        }

        if (isset($order_by) && is_array($order_by)) {
            foreach ($order_by as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }

        if ($limit != 0) {
                $this->db->limit($limit);
        }

        if($this->db->update($table_name, $data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function update_batch($query_builder,$data) {
        // $data['updated_at'] = $this->date_time;
        // $data['updated_by'] = $this->user_id;    
        $table_name = $query_builder['table_name'];
        $data = (!empty($data))  ? $data : array(); // array
        $where = (!empty($query_builder['where']))  ? $query_builder['where'] : array() ; // array
        $order_by = (!empty($query_builder['order_by'])) ? $query_builder['order_by'] : array() ; // array
        $limit = (isset($query_builder['limit'])) ? $query_builder['limit'] : 0;
        $column_name = (isset($query_builder['column_name'])) ? $query_builder['column_name'] : '';

        if (count($where) > 0) {
            $this->db->where($where);
        }

        if (isset($order_by) && is_array($order_by)) {
            foreach ($order_by as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }

        if ($limit != 0) {
            $this->db->limit($limit);
        }
        // echo "<pre>";
        // print_r($where);
        // print_r($table_name);
        // print_r($data);
        // print_r($column_name);
        // die;

        if($this->db->update_batch($table_name, $data, $column_name)){
            return true;
        } else {
            return false;
        }
    }


    // Delete Query    
    function delete_data($table_name, $where = array()){
       
        if (count($where) > 0) {
            $this->db->where($where);
        }

        $this->db->delete($table_name); 

    }

    function get_data_row_custom($query){
        $result = $this->db->query($query);
        
        if(count($result) > 0)
        {
        return $result->row_array();

        }
        else
        {
        return false;
        }
    }


    function get_data_row_custom_obj($query){
        $result = $this->db->query($query);
        if(count($result) > 0)
        {
        return $result->row_object();

        }
        else
        {
        return false;
        }
    }

    function count_row_custom($query){
        return $this->db->query($query)->num_rows();
    }

    


}