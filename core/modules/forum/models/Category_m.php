<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 8/30/18
 * Time: 1:02 PM
 */
class Category_m extends My_Model{
    function __construct()
    {
        parent::__construct();
        $this->config->load('table');
        $this->_table=$this->config->item('tbl_forums');
        $this->_categories='categories';
    }

    public function getCategories(){
        $sql="SELECT id, name FROM ".$this->_categories." ORDER BY created DESC";
        $res=$this->db->query($sql)->result_array();
        return($res);
    }


    public function getCategoryList()
    {
        $sql="SELECT id, title FROM ".$this->_table." WHERE status ='1'";
        $res=$this->db->query($sql)->result_array();
        return($res);
    }

    public function getForumName($ForumId){
        /* GEtting forum name */
        return $this->db->select('title')
            ->from($this->_table)
            ->where('id', $ForumId)
            ->get()
            ->row_array();

    }
}