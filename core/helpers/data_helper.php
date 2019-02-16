<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 9/4/18
 * Time: 2:54 PM
 */


function _get_csrf_nonce()
{
    $ci=&get_instance();
    $ci->load->helper('string');
    $key   = random_string('alnum', 8);
    $value = random_string('alnum', 20);
    $ci->session->set_flashdata('csrfkey', $key);
    $ci->session->set_flashdata('csrfvalue', $value);

    return array($key => $value);
}

function message($status, $msg){
    $ci=&get_instance();
    $ci->load->helper('string');

    $ci->session->set_flashdata($status, $msg);
}

function base64_to_jpeg($base64_string, $output_file)
{
    // open the output file for writing
    $ifp = fopen($output_file, 'wb'); 

    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    $data = explode(',', $base64_string);

    // we could add validation here with ensuring count( $data ) > 1
    fwrite($ifp, base64_decode($data[1]));

    // clean up the file resource
    fclose($ifp);

    return $output_file;
}

if(!function_exists('toAssociative')){
    function toAssociative($array){
        $output=array(''=>'Please Select');
        foreach($array as $ary){
            $output[$ary['slug']]=$ary['title'];
        }

        return $output;
    }
}

if(!function_exists('package')){
    function package($id){
        if($id == 1){
            return 'Basic';
        }elseif($id == 2){
            return 'Extended';
        }elseif($id == 3){
            return 'Professional';
        }
    }
}


function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}