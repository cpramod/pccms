<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 10/4/18
 * Time: 6:55 AM
 */

class Catalog_m extends My_Model{
    function __construct()
    {
        parent::__construct();
        $this->_table="catalog";
        $this->_cattable = 'catalog_categories';
    }

    public function getParentCat($id = ''){
        $this->db->select('*')
            ->from($this->_cattable);
        if($id !=''){
            $this->db->where('id!=',$id);
        }

       return $this->db->get()
            ->result();

    }

    public function getAllCategories($flag=false, $limit = null, $offset=0){
        $this->db->select('*')
            ->from($this->_cattable);
            if($limit!=null){
                $this->db->limit($limit, $offset);
            }

        $output = $this->db->get();
        if($flag == true){
            return $output->result_array();
        }else{
            return $output->result();
        }

    }

    public function getCatalogCat(){
        return $this->db->select('slug, title')
            ->from($this->_cattable)
            ->get()
            ->result_array();
    }

    public function getCatalogCatById($id){
        return $this->db->select($this->_cattable.'.*,meta.id as meta_id')
            ->from($this->_cattable)
            ->join('meta',$this->_cattable.'.slug=meta.mvalue')
            ->where('meta.post',$id)
            ->get()
            ->result_array();
    }

    public function getKeys(){
        return $this->db->distinct('meta_key')
            ->select('meta_key')
            ->from('catalog_meta')
            ->get()
            ->result_array();
    }

    public function getAllCatalogs($limit = null, $offset=0){
        $this->db->select('*')
            ->from($this->_table)
            ->order_by('publish_date','DESC');
            if($limit != null){
                $this->db->limit($limit, $offset);
            }

        return $this->db->get()
            ->result();
    }


    public function getCatalog($id){
        return $this->db->select('*')
            ->from($this->_table)
            ->where('id', $id)
            ->get()
            ->row();
    }

    public function getCatalogBySlug($slug){
        return $this->db->select('*')
            ->from($this->_table)
            ->where('slug', $slug)
            ->get()
            ->row();
    }

    public function getMetas($id){
        return $this->db->select('*')
            ->from('catalog_meta')
            ->where('catalog_id', $id)
            ->get()
            ->result();
    }

    public function getReviews($slug){
        return $this->db->select('*')
            ->from('catalog_review')
            ->where('catalog',$slug)
            ->where('status',1)
            ->get()
            ->result();
    }

    public function getRelatedProducts($slug){
        return $this->db->select('*')
            ->from($this->_table)
            ->where('slug!=',$slug)
            ->limit(4)
            ->order_by('publish_date','desc')
            ->get()
            ->result();
    }

    public function getAllReviews(){
        return $this->db->select('*')
            ->from('catalog_review')
            ->order_by('date','desc')
            ->get()
            ->result();
    }
}