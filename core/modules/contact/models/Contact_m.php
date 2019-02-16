<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 10/11/18
 * Time: 1:41 PM
 */

class Contact_m extends My_Model{
    function __construct()
    {
        parent::__construct();
        $this->_table = "contact";
    }

    public function getEnquiries($limit = null, $offset=0){
        $this->db->select('*')
        ->from($this->_table)
        ->where('type','Q');
        if($limit != null){
            $this->db->limit($limit, $offset);
        }

        $data = $this->db->get()
        ->result();
        foreach($data as $d => $val){
            $out = $this->db->select('*')
            ->from($this->_table)
            ->where('type','R')
            ->get()
            ->result();
            $data[$d]->reply=$out;
        }


        return $data;

        
    }
}