<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 30/06/17
 * Time: 09:30
 */


class Admin_Controller extends Core_Controller{
    var $theme;

    function __construct()
    {
        parent::__construct();

        // theme used
        $this->theme = config('admin_theme');
        //timestamp addition

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        $this->config->load('asset');
        
        $this->config->config["assets"]['path']='web/themes/'.$this->theme.'/';
        $this->load->helper('asset');
        $this->load->helper('auth/user');
        
        $this->template
            ->set_theme($this->theme)
            ->set_layout('default')
            ->set_partial('head','partials/head')
            ->set_partial('sidebar', 'partials/sidebar')
            ->set_partial('footer', 'partials/footer')
            ->set_partial('modal', 'partials/modal')
            ->set_partial('header', 'partials/header')
            ->set_partial('message','partials/message')
            ->set_partial('footer-script','partials/footer-script');



        if (!$this->ion_auth->logged_in())
        {
            redirect('admin/auth', 'refresh');
        }elseif(!$this->ion_auth->is_admin()){
            redirect('/','refresh');
        }


        $this->user_details = $this->ion_auth_model->user()->row();
        $this->template->set('user_details',(array)$this->user_details);

        //pagination
        $this->limit = config('per_page');

        date_default_timezone_set('America/Los_Angeles');
    }
}
