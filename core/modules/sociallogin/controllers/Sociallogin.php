<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 9/2/18
 * Time: 7:31 PM
 */
class Sociallogin extends Main_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('googleplus');
        $this->load->library('facebook');
        //$this->load->helper('facebook');
        ini_set('display_errors',1);
    }

    function googleLogin(){
        if($this->googleplus->login()){
            if($this->session->userdata('user_id')){
                redirect('/');
            }
        }

    }

    /**
     * Callback to log with facebook account
     */
    public function facebookLogin($action='')
    {
        if($action){
            $code = $this->input->get('code');
            if ($code) {
                $this->facebook->login();
                redirect('/');
            } else {
                redirect('auth/login');
            }
        }else{
            $this->facebook->login();
        }


    }



}