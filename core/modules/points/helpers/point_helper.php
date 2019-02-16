<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 9/24/18
 * Time: 7:21 PM
 */

if(!function_exists('point_add')){
    function point_add($activity, $point){
        $ci=&get_instance();
        $ci->load->library('points/points');
        return $ci->points->add($activity, $point);
    }
}

if(!function_exists('get_points')){
    function get_points(){
        $ci=&get_instance();
        $ci->load->library('points/points');
        return $ci->points->getPoints();
    }
}