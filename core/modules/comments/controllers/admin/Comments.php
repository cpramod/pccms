<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 9/19/18
 * Time: 11:56 PM
 */

class Comments extends My_Controller{
    function __construct()
    {
        //ini_set('display_errors',1);
        $this->config->load('comments/table');
        parent::__construct();
        $this->load->model('article_comments_model','comment_m',true);
        $this->load->model('pages/pages_m');
        $this->load->model('blog/blog_m');
        
    }

    function index($offset = 0){
        $comments=$this->comment_m->getComments($this->limit, $offset);
        $total = count($this->comment_m->getComments());
        $pagination = pagination(site_url('admin/comments/index',$total));
        $data['comments']=$comments;
        foreach($comments as $r=> $comment){
            if(is_numeric($comment['author'])){
                $author = $this->ion_auth_model->user($comment['author'])->row();
                $data['comments'][$r]['author'] = $author->first_name.' '.$author->last_name;

            }
            if($comment['type']=='page'){
                $post=$this->article_model->get_articleBySlug($comment['slug']);
                $post="<a target='_blank' href='".site_url('pages/'.$post->slug)."'>".$post->title."</a>";

                $data['comments'][$r]['post']=$post;
            }else{
                $post=$this->blog_m->get_post($comment['post_id']);
                $post="<a target='_blank' href='".site_url('blog/'.$post['url_title'])."'>".$post['title']."</a>";
                $data['comments'][$r]['post']=$post;
            }
        }

        $this->template->title('Comments')
            ->set('pagination', $pagination)
            ->build('admin/comments',$data);
    }

    

    function approve($id){
        if($this->comment_m->approve($id)){
            redirect('admin/comments');
        }
    }

    /**
     * function to count number of comments by id
     */
    public function countComments($id)
    {
        echo $this->comment_m->count_by(config('tbl_comments'), array('post_id' => $id, 'status' => 1, 'modded' => 0));
        exit;
    }
}