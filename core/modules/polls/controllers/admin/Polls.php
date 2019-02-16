<?php

class Polls extends My_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('poll_model');
        ini_set('display_errors',1);
    }

    function index($offset=0){
        $data = array('polls'=>$this->poll_model->get_polls($this->limit, $offset));
        $this->template->title('Polls')
            ->build('admin/index',$data);
    }

    function add(){
        if($this->input->post()){
            $this->form_validation->set_rules('title','Title of Poll','required');
            $this->form_validation->set_rules('options[]','Options','required');
            if($this->form_validation->run() == true){
                $postdata = $this->input->post();
                $data=array('title'=>$postdata['title'],'created'=>date('Y-m-d H:i:s'));
                $id = $this->poll_model->insert(config('tbl_polls'),$data);
                if($id){
                    foreach($postdata['options'] as $option){
                        $data = array('poll_id' => $id, 'title' => $option);
                        $this->poll_model->insert(config('tbl_option'),$data);
                    }
                    
                }
                message('success','Record added successfully');
                redirect('admin/polls');
            }else{
                message('error',validation_errors());
            }
        }
        $this->template->title('Add Polls')
        ->build('admin/create');
    }


    function edit($id)
    {
        if(!$id){
            show_404();
        }

        $usr_data = $this->poll_model->get_poll($id);
        $usr_data['options'] = $this->poll_model->get_poll_options($id);

        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title of Poll', 'required');
            $this->form_validation->set_rules('options[]', 'Options', 'required');
            if ($this->form_validation->run() == true) {
                $postdata = $this->input->post();
                $data = array('title' => $postdata['title']);
                $this->poll_model->update(config('tbl_polls'), $data,array('poll_id'=>$id));
                if ($id) {
                    $this->poll_model->delete(config('tbl_option'),array('poll_id'=>$id));
                    foreach ($postdata['options'] as $option) {
                        $data = array('poll_id' => $id, 'title' => $option);
                        $this->poll_model->insert(config('tbl_option'), $data);
                    }

                }
                message('success', 'Record updated successfully');
                redirect('admin/polls');
            } else {
                message('error', validation_errors());
            }
        }
        $this->template->title('Edit Polls')
            ->build('admin/edit',$usr_data);
    }


    public function delete($id){
        $this->poll_model->delete(config('tbl_option'),array('poll_id'=>$id));
        $this->poll_model->delete(config('tbl_polls'),array('poll_id'=>$id));
        message('success','Record deleted successfully');
        redirect('admin/polls');
    }

    public function close($id){
        if($this->poll_model->update(config('tbl_polls'),array('closed'=>1),array('poll_id'=>$id))){
            message('success','Poll is closed');
            
        }else{
            message('error','Error performing action');
        }
        redirect('admin/polls');
    }

    public function open($id)
    {
        if ($this->poll_model->update(config('tbl_polls'), array('closed' => 0), array('poll_id' => $id))) {
            message('success', 'Poll is closed');       
        }
        else{
            message('error', 'Error performing action');
        }
        redirect('admin/polls');
    }
}

 ?>