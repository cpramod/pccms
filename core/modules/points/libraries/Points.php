<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 9/24/18
 * Time: 7:23 PM
 */

class Points{
    var $ci;
    function __construct()
    {
        $this->ci=&get_instance();
        $this->ci->load->model('points/point_m');
        $this->_table="points";
        $this->ci->config->load('point');
        $this->ci->load->library('user_agent');
        //ini_set('display_errors',1);
       
    }

    function add($activity_id){
        $add_point = true;
        $data = $this->ci->point_m->get(config('tbl_point_activities'),array('id'=>$activity_id));
        $base_point = $data->base_point;
        $point_multiplier = $data->multiplier;

        /**
         * enable or disable point system
         */
        if($this->ci->config->item('point_enable') == 0){
            return true;
        }

        if(($activity_id != 1) || ($activity_id !=6)){
            $url = $this->ci->agent->referrer();
        }else{
            $url = current_url();
        }

        // add point on login once a day

        if($activity_id == 1){
            $last_login = $this->ci->ion_auth_model->user()->row()->last_login;
            $now = strtotime(date('Y-m-d H:i:s'));
            if($now < $last_login){
                $add_point = false;
            }

        }

        if($add_point == true){
            return $this->ci->point_m->insert(
                $this->_table,
                array(
                    'activity_id' => $activity_id,
                    'user_id' => $this->ci->session->userdata('user_id'),
                    'base_point' => $base_point,
                    'multiplier' => $point_multiplier,
                    'created_datetime' => Date('Y-m-d H:i:s'),
                    'ip' => $this->ci->input->ip_address(),
                    'activity_uri' => $url
                )
            );
        }
        
        
    }


    function getPoints(){
        return $this->ci->point_m->getPoint();
    }




}