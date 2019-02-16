<?php

class Pages extends Main_Controller //I am creating a custom base controller, instead of the default CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('pages_m');
        $this->load->helper('forum/token');
        //ini_set('display_errors',1);
        $this->template->set_layout('pages');
    }

    public function index()
    {
        //Get Articles
        $data['pages'] = $this->pages_m->get_articles('id','DESC','10');

        //Load View
        $this->load->view('home', $data);
    }


    public function view($slug)
    {

        //Get Menu Items
        $data['menu_items'] = $this->pages_m->get_menu_items();

        //Get Article
        $data['article'] = (array)$this->pages_m->get_articleBySlug($slug);
        //$data['comments']=$this->article_comments_model->getCommentsBySlug($slug);


        //Load View
        $this->template
            ->title($data['article']['title'])
            ->set('heading', $data['article']['heading'])
            ->set('class', $data['article']['body_class'])
            ->set('meta_keywords',$data['article']['meta_keywords'])
            ->set('meta_descriptions',$data['article']['meta_description'])
            ->build('pages/inner', $data);
    }

    // public function postComment($slug){
    //     if($this->input->post()){
    //         $comment=$this->input->post('comment');
    //         $data=array(
    //             'comment'=>$comment,
    //             'author'=>$this->session->userdata('user_id'),
    //             'date'=>Date('Y-m-d H:i:s'),
    //             'status'=>0,
    //             'slug'=>$slug,
    //             'type'=>'page'

    //         );

    //         if($this->article_comments_model->addComment($data)){
    //             $this->session->set_flashdata('success','Comment submitted successfully!');
    //             redirect('pages/'.$slug);
    //         }

    //     }


    // }
}