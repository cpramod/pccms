<?php

class Forum extends My_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('forum_m');
        $this->load->config('table');
    }

    public function index($offset = 0)
    {
        $data = array('categories' => $this->forum_m->getIssues($this->limit, $offset));
        $total = count($this->forum_m->getIssues());
        $this->template->title('Forum Categories')
            ->set('pagination',pagination(site_url('admin/forum/index'),$total))
            ->build('admin/categories/index', $data);
    }

    public function topics($offset = 0){
        $data = array('topics'=>$this->forum_m->getAllTopics($this->limit, $offset));
        $total = count($this->forum_m->getAllTopics());
        $this->template->title('Topics')
            ->set('pagination',pagination(site_url('admin/forum/topics'),$total))
        ->build('admin/issues/index',$data);
    }

    public function view($id){
        $data = array('answers'=> $this->forum_m->getAnswersByTopic($id));
        $data['question'] = $this->forum_m->getOne('forum_issue',array('id'=>$id));
        $Comment = $this->forum_m->getComments($topic_id);

        if (!empty($Comment)) {
                // function to get commented user
            $CommentUser = $this->forum_m->getCommentedUser($Comment);
        }
        $data['comments']=$Comment;
        $this->template->title('Topic View')
        ->build('admin/issues/view', $data);
    }

    public function addToAnnouncement($id){
        if($this->forum_m->update($this->config->item('tbl_issue'),array('is_announcement'=>1),array('id'=>$id))){
            message('success','Issue added as announcement');
        }else{
            message('error','Error performing action');
        }
        redirect('admin/forum/topics');
    }

    public function removeFromAnnouncement($id){
        if ($this->forum_m->update($this->config->item('tbl_issue'), array('is_announcement' => 0), array('id' => $id))) {
            message('success', 'Issue removed as announcement');
        } else {
            message('error', 'Error performing action');
        }
        redirect('admin/forum/topics');
    }

    public function delete($id){
        if($this->forum_m->delete('forum_issue',array('id'=>$id))){
            message('success','Record deleted successfully');
            redirect('admin/forum/topics');
        }
    }

    public function deleteComment($id){
        $data = $this->forum_m->getOne('forum_issue_answer_comment', array('id'=>$id));
        
        if($this->forum_m->delete('forum_issue_answer_comment',array('id'=>$id))){
            message('success','Record deleted successfully');
        }else{
            message('error','Error deleting record');
        }

        redirect('admin/forum/view/'.$data['issue_id']);
        exit;
        
    }

    function deleteAnswer($id){
        $data = $this->forum_m->getOne('forum_issue_answers', array('id' => $id));

        if ($this->forum_m->delete('forum_issue_answers', array('id' => $id))) {
            message('success', 'Record deleted successfully');
        } else {
            message('error', 'Error deleting record');
        }

        redirect('admin/forum/view/' . $data['issue_id']);
        exit;
    }

    public function category_add()
    {
        $data = array();
        if ($posted_data = $this->input->post()) {
            $this->form_validation->set_rules('title', 'Category Title', 'required');
            $generate_slug = true;
            if ($posted_data['url_friendly_name']) {
                $this->form_validation->set_rules('url_friendly_name', 'Slug', 'required|alpha_dash|is_unique['. $this->config->item('tbl_category') .'.url_friendly_name]');
                $generate_slug = false;
            }

            if($this->form_validation->run() == true){

            if ($generate_slug == true) {
                $config = array(
                    'field' => 'url_friendly_name',
                    'title' => $posted_data['title'],
                    'table' => $this->config->item('tbl_category')
                );

                $this->load->library('slug', $config);
                $slug = $this->slug->create_uri($posted_data['title']);
            } else {
                $slug = $posted_data['url_friendly_name'];
            }

                $moderate = $posted_data['moderate'] ? $posted_data['moderate'] : 0;

            $data = array(
                'title' => $posted_data['title'],
                'url_friendly_name' => $slug,
                'description' => $posted_data['description'],
                'addedDate' => date('Y-m-d H:i:s'),
                'status' => 1,
                'moderate'  =>  $moderate
            );

            if ($this->forum_m->insert($this->config->item('tbl_category'), $data)) {
                message('success', 'Record added successfully');
            } else {
                message('error', 'Error adding record');
            }
            redirect(current_url());
            exit;
        }else{
            message('error',validation_errors());
            redirect(current_url());
        }
        }

        $this->template->title('Add Forum Category')
            ->build('admin/categories/add', $data);
    }


    public function category_edit($id)
    {
        $data = $this->forum_m->getOne($this->config->item('tbl_category'), array('id' => $id));
        if ($posted_data = $this->input->post()) {
            $this->form_validation->set_rules('title', 'Category Title', 'required');
            $generate_slug = true;
            if ($posted_data['url_friendly_name'] && ($posted_data['url_friendly_name'] != $data['url_friendly_name'])) {
                $this->form_validation->set_rules('url_friendly_name', 'Slug', 'required|alpha_dash|is_unique['. $this->config->item('tbl_category') .'.url_friendly_name]');
                $generate_slug = false;
                $slug = $posted_data['url_friendly_name'];
            } else {
                $slug = $data['url_friendly_name'];
            }

            if ($this->form_validation->run() == false) {
                message('error', validation_errors());
                redirect(current_url());
            } else {

                $moderate = $posted_data['moderate'] ? $posted_data['moderate'] : 0;

                $pdata = array(
                    'title' => $posted_data['title'],
                    'url_friendly_name' => $slug,
                    'description' => $posted_data['description'],
                    'updateDate' => date('Y-m-d H:i:s'),
                    'moderate' => $moderate
                );



                if ($this->forum_m->update($this->config->item('tbl_category'), $pdata, array('id' => $id))) {
                    message('success', 'Record updated successfully');
                } else {
                    message('error', 'Error updating record');
                }
                redirect(current_url());
                exit;
            }
        }


        $this->template->title('Edit Forum Category')
            ->build('admin/categories/edit', $data);
    }


    /**
     * forums
     */

     public function forums($offset=0){
         $data = array('forums'=>$this->forum_m->getAll($this->config->item('tbl_forums'),$this->limit, $offset));
         $total = count($this->forum_m->getAll($this->config->item('tbl_forums')));
         $this->template->title('Forums')
            ->set('pagination',pagination(site_url('admin/forum/forums'),$total))
            ->build('admin/forums/index', $data);
     }

     public function forums_add(){
         if($posted_data = $this->input->post()){
             $this->form_validation->set_rules('title','Title','required');
            $this->form_validation->set_rules('sort_order', 'Sort Order', 'required');
             $build_slug = true;
             if($this->input->post('slug')){
                 $this->form_validation->set_rules('slug','Slug','required|alpha_dash|is_unique['.$this->config->item('tbl_forums').'.slug]');
                $build_slug = false;
            }
             $this->form_validation->set_rules('category','Category','required');

             if($this->form_validation->run() == false){
                 message('error',validation_errors());
                 redirect(current_url());
                 exit;
             }else{
                 if($build_slug == true){
                     $config=array(
                         'title'=> $posted_data['title'],
                         'field'    =>  'slug',
                         'table'    => $this->config->item('tbl_forums')
                     );

                     $this->load->library('slug', $config);
                     $slug = $this->slug->create_uri($posted_data['title']);
                 }else{
                     $slug = $posted_data['slug'];
                 }

                 $data = array(
                     'title' =>  $posted_data['title'],
                     'slug' => $slug,
                     'description'  =>  $posted_data['description'],
                     'date'         =>  date('Y-m-d H:i:s'),
                     'category_id'     =>  $posted_data['category'],
                     'sort_order'   =>      $posted_data['sort_order']
                 );

                 if($this->forum_m->insert($this->config->item('tbl_forums'),$data)){
                     message('success','Record added successfully');
                 }else{
                    message('error', 'Error adding data');
                 }

                 redirect('admin/forum/forums');
             }
         }
         $data = array('categories' => $this->forum_m->getAll($this->config->item('tbl_category')));
         $this->template->title('Add Forums')
         ->build('admin/forums/add',$data);
     }


    public function forums_edit($id)
    {
        $data = $this->forum_m->get($this->config->item('tbl_forums'),array('id'=>$id));
        $data->categories = $this->forum_m->getAll($this->config->item('tbl_category'));

        if ($posted_data = $this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('sort_order','Sort Order','required');
            $build_slug = true;
            if ($this->input->post('slug') && ($posted_data['slug'] != $data->slug)) {
                $this->form_validation->set_rules('slug', 'Slug', 'required|alpha_dash|is_unique[' . $this->config->item('tbl_forums') . '.slug]');
                $build_slug = false;
            }
            $this->form_validation->set_rules('category', 'Category', 'required');

            if ($this->form_validation->run() == false) {
                message('error', validation_errors());
                redirect(current_url());
            } else {
                if ($build_slug == true) {
                    $slug = $data->slug;
                } else {
                    $slug = $posted_data['slug'];
                }

                $data = array(
                    'title' => $posted_data['title'],
                    'slug' => $slug,
                    'description' => $posted_data['description'],
                    //'date' => date('Y-m-d H:i:s'),
                    'category_id' => $posted_data['category'],
                    'sort_order' => $posted_data['sort_order']
                );

                // print_r($data);
                // exit;

                if ($this->forum_m->update($this->config->item('tbl_forums'), $data, array('id'=>$id))) {
                    message('success', 'Record updated successfully');
                } else {
                    message('error', 'Error adding data');
                }

                redirect(current_url());
            }
        }
        
        $this->template->title('Edit Forums')
            ->build('admin/forums/edit', $data);
    }

    /**
     * public function to delete forums
     */

     public function forums_delete($id){
         if($this->forum_m->delete($this->config->item('tbl_forums'),array('id'=>$id))){
             message('success','Record deleted successfully');
         }else{
             message('error','Error deleting record');
         }
         redirect('admin/forum/forums');
     }


}

?>
