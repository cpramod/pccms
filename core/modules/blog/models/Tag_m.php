<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 9/21/18
 * Time: 12:22 PM
 */

class Tag_m extends My_Model{
    function __construct()
    {
        parent::__construct();
        $this->_table="blog_tags";
    }

    public function addTags($data){
        return parent::insert($this->_table,$data);
    }

    public function getTags(){
        return $this->db->select('*')
            ->from($this->_table)
            ->get()
            ->result_array();
    }

    public function getTag($id){
        return parent::getOne($this->_table,array('id'=>$id));
    }

}