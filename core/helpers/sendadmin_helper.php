<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 02/07/17
 * Time: 21:02
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('sendAdminEmail')){
    function sendAdminEmail($file){
        $ci=& get_instance();
        $ci->load->library('email');
        $ci->email->from('cpramod2012@gmail.com', 'Codesynco');
        $ci->email->to('info@pcsoftnepal.com');

        $ci->email->subject('Deploy Failure');
        $ci->email->message('Deployment failure.'.$file);

        $ci->email->send();
    }


}

if(!function_exists('sendEmail')){
    function sendEmail($to,$message){
        $ci=& get_instance();

        $ci->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;

        $ci->email->initialize($config);

        $ci->email->from('noreply@pcsoftnepal.com', 'Codesynco');
        $ci->email->to($to);

        $ci->email->subject('Info from Codesynco');
        $ci->email->message($message);

        $ci->email->send();
    }
}

function timezoneList()
{
    $timezoneIdentifiers = DateTimeZone::listIdentifiers();
    $utcTime = new DateTime('now', new DateTimeZone('UTC'));

    $tempTimezones = array();
    foreach ($timezoneIdentifiers as $timezoneIdentifier) {
        $currentTimezone = new DateTimeZone($timezoneIdentifier);

        $tempTimezones[] = array(
            'offset' => (int)$currentTimezone->getOffset($utcTime),
            'identifier' => $timezoneIdentifier
        );
    }

    // Sort the array by offset,identifier ascending
    usort($tempTimezones, function($a, $b) {
        return ($a['offset'] == $b['offset'])
            ? strcmp($a['identifier'], $b['identifier'])
            : $a['offset'] - $b['offset'];
    });

    $timezoneList = array();
    foreach ($tempTimezones as $tz) {
        $sign = ($tz['offset'] > 0) ? '+' : '-';
        $offset = gmdate('H:i', abs($tz['offset']));
        $timezoneList[$tz['identifier']] = '(UTC ' . $sign . $offset . ') ' .
            $tz['identifier'];
    }

    return $timezoneList;
}


function sendForm($to,$message,$from,$fname,$lname){
        $ci=& get_instance();

        $ci->load->library('email');
        $config['protocol'] = 'smtp';
        //$config['mailpath'] = '/usr/sbin/sendmail';
        $config['smtp_host']    =   'smtp.zoho.com';
        $config['smtp_user']    =   'info@pcsoftnepal.com';
        $config['smtp_pass']    =   'R@nj@n@2005';
        $config['smtp_port']    =   '465';
        $config['smtp_crypto']  =   'ssl';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";

        $ci->email->initialize($config);

        $ci->email->from($from, $fname.' '.$lname);
        $ci->email->to($to);

        $ci->email->subject('Form Enquiry codesynco');

        $ci->email->message($message);

        if($status=$ci->email->send()==false){
            return $ci->email->print_debugger(array('headers'));
        }else{
            return $status;
        }


}


function converttime ( $date ){
    $datetime = date('Y-m-d H:i:s', strtotime($date));
    list ( $date, $time ) = explode ( ' ', $datetime );
    $time = substr( $time, 0, 5);
    list ( $hour, $minute ) = explode (':', $time);
    $return = 'at ' . $hour . ':' . $minute;

    list ($year, $month, $day) = explode ( '-', $date );
    list ($year2, $month2, $day2) = explode (' ', date('Y m d'));

    if ($year == $year2 && $month == $month2 && $day == $day2){
        return 'Today ' . $return;
    }
    if ($year == $year2 && $month == $month2 && $day == $day2 - 1){
        return 'Yesterday ' . $return;
    }
    if ($year == $year2 && $month == $month2 && $day == $day2 - 2){
        return 'Two days ago ' . $return;
    }
    if ($year == $year2 && $month == $month2 && $day == $day2 - 3){
        return 'Three days ago ' . $return;
    }

    return $date . ' ' . $return;
}


/*
 * function to check group of current user
 */

function checkGroup($group){
    $ci=&get_instance();
    return $ci->ion_auth->in_group($group);
}