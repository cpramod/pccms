<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 02/07/17
 * Time: 14:59
 */

class My_Model extends CI_Model{
    var $query;
    public $_select = array();

    function __construct()
    {
        parent::__construct();
        
    }

    /**
     * function to select
     */
    function select($select){
        $this->_select[]=$select;
        return $this;
    }

    /*
     * function to insert records
     */

    function insert($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    /*
     * function to get all records
     */

    function getAllRecords($table){
        return $this->db->select('*')
            ->from($table)
            ->where('status',1)
            ->get()
            ->result();
    }

    function getAll($table, $limit = null, $offset = 0)
    {

        if(isset($this->_select) && !empty($this->_select)){
            foreach($this->_select as $select){
                $this->db->select($select);
            }
            $this->_select=array();
        }else{
            $this->db->select('*');
        }
        
        $this->db->from($table);
        if($limit != null){
            $this->db->limit($limit, $offset);
        }

        $this->ion_auth_model->trigger_events('where');

        return $this->db->get()
            ->result_array();
    }

    /*
     * get by
     */

    function get_by($table,$args=null, $order='', $limit = null, $offset = 0){

        if (isset($this->_select) && !empty($this->_select)) {
            foreach ($this->_select as $select) {
                $this->db->select($select);
            }
            $this->_select = array();
        } else {
            $this->db->select('*');
        }

        $this->db
            ->from($table);
            if($args != null){
                $this->db->where($args);
            }
            
            if($order){
                foreach($order as $o=>$v){
                    $this->db->order_by($o,$v);
                }
                
            }

            if($limit != null){
                $this->db->limit($limit, $offset);
            }

            $this->ion_auth_model->trigger_events('where');

            return $this->db->get()
            ->result_array();
    }

    function getOne($table,$args){
        return $this->db->select('*')
            ->from($table)
            ->where($args)
            ->get()
            ->row_array();
    }

    function get($table, $args=null)
    {
        
        if(isset($this->_select) && !empty($this->_select)){
            foreach($this->_select as $select){
                $this->db->select($select);
            }
            
            $this->_select=array();
        }else{
            $this->db->select('*');
        }
        
        $this->db->from($table);
        if($args != null){
            $this->db->where($args);
        }

        $this->ion_auth_model->trigger_events('extra_where');
        
        return $this->db->get()
                ->row_array();
    }


    /*
     * function to count rows
     */

    function count_by($table,$args){
        return $this->db->select('*')
            ->from($table)
            ->where($args)
            ->count_all_results();

    }

    /*
     * function to delete
     */

    function delete($table,$where){
        //$id is an array like array('id'=>$id)
        return $this->db->where($where)->delete($table);
    }

    /**
     * function to update record
     */

    function update($table, $data ,$where){
        return $this->db->where($where)
            ->update($table, $data);
    }

    public function result(){
        return $this->query->result();
    }

    public function row(){
        return $this->query->row();
    }


}