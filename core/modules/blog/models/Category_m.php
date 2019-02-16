<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 9/20/18
 * Time: 2:42 PM
 */

class Category_m extends My_Model{
    function __construct()
    {
        parent::__construct();
        $this->config->load('table');
        $this->_table=config('tbl_categories');
        
    }

    public function addCategory($data){
        return parent::insert($this->_table,$data);
    }

    public function updateRecord($data , $where){
        return parent::update($this->_table, $data, $where);
    }

    public function getCategories(){
        return $this->db->select('*')
            ->from($this->_table)
            //->where('status',1)
            ->order_by('created','desc')
            ->get()
            ->result_array();
    }

    public function getCategory($id){
        return parent::getOne($this->_table,array('id'=>$id));
    }


    /**
     * get_cats_form
     *
     * builds the array to populate
     * the categories multi-select input
     * @access  public
     * @author  Enliven Applications
     * @version 3.0
     *
     * @return  array
     */
    public function get_cats_form()
    {
        // get'm
        $cats = $this->db->select('id, name')->get($this->_table)->result_array();

        // default empty array
        $ret = [];

        // foreach getting id and name
        foreach ($cats as $k => $v)
        {
            $ret[$v['id']] = $v['name'];
        }

        // return array
        return $ret;
    }


    public function get_categories_by_ids($category_ids)
    {
        $this->db->where_in('id', $category_ids);

        $query = $this->db->get($this->_table);

        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
    }


    /**
     * get_categories
     *
     * @access  public
     * @author  Enliven Applications
     * @version 3.0
     *
     * @return  null
     */
    public function get_categories()
    {
        $this->db->select('id, name,slug')
            ->select('(SELECT COUNT(' . config('posts_to_categories') . '.id' . ' ) FROM ' . config('posts_to_categories') . ' WHERE ' . config('posts_to_categories') . '.category_id' . ' = ' . config('tbl_categories') . '.id' . ') AS posts_count', FALSE)
            ->order_by('id', 'ASC')
            ->limit(config('per_page'));

        $query = $this->db->get($this->_table);
        return $output=$query->result_array();
        
    }


    public function getCategoryByBlog($blog){
        return $this->db->select('*')
        ->from(config('tbl_categories'))
        ->join(config('posts_to_categories'),config('posts_to_categories').'.category_id='.config('tbl_categories').'.id')
        ->where(config('posts_to_categories').'.post_id',$blog)
        ->get()
        ->result();
    }



}