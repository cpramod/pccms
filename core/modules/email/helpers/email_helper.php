<?php defined('BASEPATH') or exit('No direct script access allowed.');

function sendEmail($to, $subject, $message, $from){
    $ci=&get_instance();
    $ci->load->library('email/my_email');
    return $ci->my_email->send($to, $subject, $message, $from);

}