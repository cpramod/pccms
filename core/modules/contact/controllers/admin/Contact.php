<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 10/12/18
 * Time: 11:07 AM
 */

class Contact extends My_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('contact_m');

    }

    public function index($offset = 0){
        $data=array('contacts'=>$this->contact_m->getEnquiries($this->limit, $offset));

        $total = count($this->contact_m->getEnquiries());
        $this->template->title('Contact')
            ->set('pagination', pagination(site_url('admin/contact/index'),$total))
            ->build('admin/index',$data);
    }

    public function view($id){
        $data = array();
        $this->template->title('Contact View')
        ->build('admin/view',$data);
    }

    public function reply(){
        if($posted_data = $this->input->post()){
            $contact_id = $posted_data['contact_id'];
            $message = $posted_data['message'];
            $record = $this->contact_m->getOne('contact',array('id'=>$contact_id));
            $to = $record['email'];
            $subject = $record['subject'];
            $from = array('email'=>$this->config->item('admin_email'),'name'=>'Dailylifeinusa');

            $data = array(
                'name' => 'Dailylifeinusa',
                'email' => $this->config->item('admin_email'),
                'subject' => $subject,
                'message' => $message,
                'type' => 'R',
                'parent' => $contact_id,
                'date' => date('Y-m-d H:i:s'),
                'ip' => $this->input->ip_address()
            );

            if($this->contact_m->insert('contact',$data)){
                sendEmail($to, 'Re:'.$subject, $message, $from);
                message('success','Reply sent successfully');
                redirect('admin/contact');

            }
        }
    }
}