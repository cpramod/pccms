<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 8/28/17
 * Time: 10:36 PM
 */
class Front_Controller extends Core_Controller{
    
    public $user_details = array();

    function __construct()
    {
        parent::__construct();
        $this->output->cache(30);
        $this->theme = config('front_theme');
        $this->config->load('asset');
        $this->config->config['assets']['path'] = 'themes/'.$this->theme.'/';
        $this->config->item('path','assets');
        
        $this->load->helper('asset');

        $this->limit=config('posts_per_page');

       
        $this->template
            ->set_theme($this->theme)
            ->set_layout('layout')
            ->set_partial('head', 'partials/head');

            
        if($this->ion_auth->logged_in()){
            $this->user_details = (array)$this->ion_auth_model->user()->row();
            $this->groups = (array)$this->ion_auth_model->get_users_groups()->row();
            $this->template->set('user_details',(array) $this->user_details)
                ->set('groups',$this->groups);         
        }

        $this->template->set_partial('header', 'partials/header')
            ->set_partial('footer-script', 'partials/footer-script');

        

    }
}