<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 8/17/18
 * Time: 5:07 PM
 */
class Dashboard extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        $data=array();
        $this->template
            ->title('Dashboard')
            ->build('admin/dashboard',$data);
    }
}