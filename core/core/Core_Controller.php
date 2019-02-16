<?php

class Core_Controller extends MX_Controller{
    function __construct()
    {
        parent::__construct();
        
        /** 
         * 
         * script to load database table config for all modules 
         * 
         */
        
        $this->load->library('config_loader');
        $this->config_loader->load();
        
        // end of config loader
        

    }
}

?>