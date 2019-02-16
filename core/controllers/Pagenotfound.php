<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class Pagenotfound extends Front_Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        $this->output->set_status_header('404'); 
        $this->template->title('404 Error')
        ->set('class', 'page notfound')
        ->set_layout('fullwidth')
        ->set_breadcrumb('404 Not Found', '')
        ->build('notfound');
    }
}
?>