<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 10/2/18
 * Time: 2:55 PM
 */

class Mupload{
    var $ci;

    function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('uploads/uploads_m','uploads_m',true);

    }

    function do_upload(){
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
        $this->ci->load->library('upload', $config);

        if (!$this->ci->upload->do_upload('file')) {
            $msg = $this->ci->upload->display_errors();
            return array('message' => $msg,'status' => 0);
            exit;
        } else {
            $response = $this->ci->upload->data();
            $filename = $response['file_name'];
            $gallery_id = $this->ci->uploads_m->insert('gallery',array('title' => $response['orig_name'], 'link'=> $filename));
            return array('gallery_id'=>$gallery_id,'message' => 'success','status'=> 1);
            exit;
        }
    }
}

