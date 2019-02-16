<?php

class Points extends My_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('point_m');
        
    }

    public function index($offset = 0){
        $total = count($this->point_m->get_by(
            config('tbl_user'),
            array(),
            array()
        ));

        $users = $this->point_m->get_by(config('tbl_user'),array(),array(),$this->limit,$offset);
        foreach($users as $r=> $user){
            $users[$r]->points = $this->point_m->getPoints($user->id);
        }
        $data = array('users'=>$users);
        $this->template->title('Points')
        ->set('pagination',pagination(site_url('admin/points/index'),$total))
        ->build('admin/points', $data);                          

    }

    public function view($id, $offset = 0){
        $total = count($this->point_m->getPointDetail($id));
        $data = array('points'=>$this->point_m->getPointDetail($id, $this->limit, $offset));
        $this->template->title('Points View')
        ->set('pagination',pagination(site_url('admin/points/view/'.$id),$total))
        ->set('user',$id)
        ->build('admin/view',$data);
    }

    public function edit($id){
        $data = $this->point_m->get(config('tbl_points'),array('id'=>$id));
        $points = $this->point_m->getAll(config('tbl_point_activities'));
        if($this->input->post()){
            //$this->form_validation->set_rules('activity_id','Activity','required');
            $this->form_validation->set_rules('base_point','Base Point','required');
            $this->form_validation->set_rules('multiplier','Multiplier','required');


            if($this->form_validation->run() == true){
                $posted_data = $this->input->post();
                unset($posted_data['files']);
                if($this->point_m->update(config('tbl_points'),$posted_data,array('id'=>$id))){
                    message('success','Record updated successfully');
                }else{
                    message('error','Error updating data');
                }

                redirect(current_url());
                exit;
            }else{
                message('error',validation_errors());
                redirect(current_url());
            }
        }
        $this->template->title('Edit Point')
        ->set('points',$points)
        ->build('admin/edit',$data);
    }


    function delete($user,$id){
        if($this->point_m->delete(config('tbl_points'),array('id'=>$id))){
            message('success','Record deleted successfully');
            redirect('admin/points/view/'.$user);
        }
    }

    
}

?>