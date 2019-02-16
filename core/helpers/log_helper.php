<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 10/8/17
 * Time: 1:55 AM
 */


if(!function_exists('write_log')){
    function write_log($msg){
        $ci=&get_instance();
        $ci->load->library('deploylog');

        $ci->deploylog->writeLog($msg);
    }
}