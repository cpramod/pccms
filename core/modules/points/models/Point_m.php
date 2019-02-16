<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 9/24/18
 * Time: 7:14 PM
 */

class Point_m extends My_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->config('points/table');
        $this->_table=config('tbl_points');
    }


    function getPoint(){
        $result = $this->db->select('SUM(base_point * multiplier) as points')
            ->from($this->_table)
            ->where('user_id',$this->session->userdata('user_id'))
            ->get()
            ->row();

            return $result->points;
    }

    function getPoints($user){
        $result = $this->db->select('SUM(base_point * multiplier) as points')
            ->from($this->_table)
            ->where('user_id', $user)
            ->get()
            ->row();

        return $result->points;
    }

    function getPointDetail($user, $limit=null, $offset=0){
        $this->db->select(config('tbl_points').'.*, '.config('tbl_point_activities').'.activity_name')
            ->from($this->_table)
            ->join(config('tbl_point_activities'),config('tbl_point_activities').'.id='.config('tbl_points').'.activity_id')
            ->where(config('tbl_points').'.user_id', $user)
            ->order_by(config('tbl_points') . '.created_datetime','desc');
            if($limit !=null){
                $this->db->limit($limit, $offset);
            }
        
            return $this->db->get()
            ->result();

        return $result;
    }
}