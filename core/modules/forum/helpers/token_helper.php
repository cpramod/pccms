<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 8/30/18
 * Time: 4:16 PM
 */


function getIssueToken($user_id, $date_time = 'now', $default_time_zone = 'UTC') {
    $date = new DateTime($date_time, new DateTimeZone($default_time_zone));
    return $date->format('dmyHis') . $user_id;
}

function get_datetime_from_timezone($date_time = 'now', $default_time_zone = 'UTC', $set_time_zone = '') {
    $date = new DateTime($date_time, new DateTimeZone($default_time_zone));

    if ($set_time_zone) {
        $date->setTimeZone(new DateTimeZone($set_time_zone));
    }

    return $date->format('Y-m-d H:i:s');
}

function humanreadableTime($ptime){
        $ptime=strtotime($ptime);
        $estimate_time = time() - $ptime;

        if( $estimate_time < 1 )
        {
            return 'less than 1 second ago';
        }

        $condition = array(
            12 * 30 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  'second'
        );

        foreach( $condition as $secs => $str )
        {
            $d = $estimate_time / $secs;

            if( $d >= 1 )
            {
                $r = round( $d );
                return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
            }
        }

}


function replaceString($string) {
    //return preg_replace('/[^A-Za-z0-9\-\']/', '_', strtolower(trim($string)));
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);

    return $string;
}


function resize_image($imgName, $phyPath, $max_width) {
    // process resize image and save to folder
    $config = array();
    $config['source_image'] = $phyPath . $imgName;
    $config['new_image'] = $phyPath . 'thumb/' . $imgName;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = '3000';
    $config['overwrite'] = FALSE;
    $config['create_thumb'] = FALSE;
    $config['maintain_ratio'] = TRUE;
    $config['width'] = $max_width;
    //$config['height']         = $new_height;

    $this->load->library('image_lib', $config);
    $this->image_lib->initialize($config);
    $this->image_lib->resize();
    $this->image_lib->clear();
}


function multipleUpload(){

    set_time_limit(0);
    ignore_user_abort(true);
    header("Connection: close\r\n");
    header("Content-Encoding: none\r\n");

    $ci=& get_instance();

    // Check if any files were selected in the field `photos`.
    if ($_FILES['attachments']['error'][0] !== UPLOAD_ERR_NO_FILE) {
        // Define the settings that will be used against all files.
        $myUploadSettings = array(
            'upload_path'   => './uploads/',
            'allowed_types' => 'jpg|png',
            'max_size'           => 1000,
            'max_width'            => 1024,
            'max_height'           => 768,
            'encrypt_name'          => true
        );

        // Load the library with our settings.
        $ci->load->library('uploads', $myUploadSettings);

        // Attempt to upload all files.
        $uploadedData = array();
        $uploadErrorsList = array();
        if (!$ci->uploads->do_upload('attachments')) {
            // Retrieve all errors in a single string.
            $uploadErrorsString = $ci->uploads->display_errors();

            // Retrieve an associative array containing all errors separated by the files in which their occurred  (as fileName => errMessage).
            $uploadErrorsList = $ci->uploads->getErrorMessages();
        } else {
            // All files were uploaded successfully.
        }

        // Retrieve an associative array containing some data from all files that were uploaded successfully (as fileName => fileData).
        $uploadedData = $ci->uploads->data();

        // Check if any files were uploaded successfully.
        if (count($uploadedData) > 0) {
            return $uploadedData;
        } else {
            // No files were uploaded.
        }

        // Check and handle errors that may occurred.
        if (count($uploadErrorsList) > 0) {
            $ci->session->set_flashdata('error',$uploadErrorsString);
            redirect('forum');
            exit;
            // Damn, let's handle these errors.
        } else {
            // Yay, no errors!
        }
    } else {
        // No files were selected.
    }
}

