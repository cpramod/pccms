<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 8/17/18
 * Time: 4:57 PM
 */

class Profile extends Admin_Controller{
    function __construct()
    {
        parent::__construct();

        $this->load->model('jobs/jobs_m','jobs_m',true);
        $this->config->load('jobs/table');
        $this->load->model('profile_m');
    }

    function index($id=''){
        if($id){
            $data = $this->ion_auth_model->user($id)->row();
        }
         $data=(array)$this->user_details;
        if($id){
            $data['id']=$id;
        }
        $user_meta = $this->profile_m->get('user_meta',array('user_id'=>$data['id']));
        unset( $user_meta->id );
        $data = (array) array_merge((array)$data, (array)$user_meta);
        $data['csrf'] = $this->_get_csrf_nonce();
        $categories = $this->jobs_m->getAll(config('tbl_category'));


        $this->template->title('Profile')
            ->set('class','level2')
            ->set('categories',$categories)
            ->build('admin/profile',$data);
    }

    function account_setting($id=''){
        if($id){
            $this->user_details = $this->ion_auth_model->user($id)->row();
        }
        $this->data=array('user'=>(array)$this->user_details);
        if($id){
            $data['id']=$id;
        }
        $this->data['csrf'] = $this->_get_csrf_nonce();
        $this->template->title('')
            ->build('admin/account_setting',$this->data);
    }

    public function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key   = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }
}