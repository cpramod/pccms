<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 10/11/18
 * Time: 1:39 PM
 */

class Contact extends Front_Controller{
    function __construct()
    {
        //ini_set('display_errors',1);
        parent::__construct();
        $this->load->model('contact_m');
    }

    public function index(){
        if($this->input->post()){
            $this->form_validation->set_rules('name','Name','required|trim');
            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('subject','Subject','required|trim');
            $this->form_validation->set_rules('message','Message','required|trim');

            if($this->form_validation->run()==true){
                $postdata=array(
                    'name'      =>  $this->input->post('name'),
                    'email'     =>  $this->input->post('email'),
                    'subject'   =>  $this->input->post('subject'),
                    'message'   =>  $this->input->post('message'),
                    'type'      =>  'Q',
                    'date'      =>  date('Y-m-d H:i:s'),
                    'ip'        =>  $this->input->ip_address()
                );

                if(!$this->contact_m->insert('contact',$postdata)){
                    message('error','Error sending message');
                    redirect(current_url(),'refresh');
                    exit;
                }


                //send email to admin
                $to=$this->config->item('admin_email');

                $message="<table>".
                "<tr><td>Name:</td><td>".$postdata['name']."</td></tr>".
                "<tr><td>Email:</td><td>" . $postdata['email'] . "</td></tr>" .
                "<tr><td>Message:</td><td>" . $postdata['message'] . "</td></tr>" .
                "</table>";
                
                $msg=sendEmail(
                    $to, 
                    $postdata['subject'], 
                    $message,
                    array(
                        'name'=>$postdata['name'],
                        //'email'=>$postdata['email']
                        'email'=>$to
                    )
                );

                if($msg){
                    redirect('contact/thankyou');
                    exit;
                }


            }else{
                message('error',validation_errors());
                redirect(current_url(),'refresh');
                exit;
            }



        }
        $data=array();
        $this->template->title('Get In Touch')
            ->set_layout('fullwidth')
            ->append_metadata('<link rel="canonical" href="'.site_url('contact').'" />')
            ->set('class','page contact')
            ->set_breadcrumb('Contact',current_url())
            ->build('contact',$data);
    }


    public function thankyou(){
        $this->template->title('Get In Touch')
            ->set_layout('fullwidth')
            ->append_metadata('<link rel="canonical" href="'.site_url('contact/thankyou').'" />')
            ->set('class', 'page contact')
            ->set_breadcrumb('Contact', site_url('contact'))
            ->build('thankyou', $data);
    }
}