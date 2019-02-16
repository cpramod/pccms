<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 9/20/18
 * Time: 12:06 PM
 */

class Blog extends My_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('blog_m');
        $this->load->model('category_m');
        $this->load->model('tag_m');
        $this->load->helper('pages/pages');
        $this->load->helper('blog/blog');
        //$this->load->library('comments/comments');
        //ini_set('display_errors',1);
        $this->lang->load('blog');
        $this->config->load('table');
        $this->load->library('uploads/mupload');

    }

    function index($offset=0){
        $posts = $this->blog_m->get_posts($this->limit, $offset)->result();
        foreach($posts as $r=> $post){
            $posts[$r]->category=$this->category_m->getCategoryByBlog($post->id);
        }
        $data['posts'] = $posts;
        $total = count($this->blog_m->get_posts()->result());
        $data['pagination'] = pagination(site_url('admin/blog/index'), $total);
        $this->template->title('Blog Posts')
                ->build('admin/posts/index',$data);
    }

    public function addPost(){
        // get categories
        $data['cats'] = $this->category_m->get_cats_form();

        if ($this->input->post())
        {

            $this->form_validation->set_rules('title', lang('post_form_title_text'), 'required');
            $this->form_validation->set_rules('status', lang('post_form_status_text'), 'required|in_list[draft,published]');
            $this->form_validation->set_rules('content', lang('post_form_content_text'), 'required');
            $this->form_validation->set_rules('excerpt', lang('post_form_excerpt_text'), 'required');
            $this->form_validation->set_rules('cats[]', lang('cats_hdr'), 'required');
            $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim');

            if ($this->input->post('feature_image')) {
                $this->form_validation->set_rules('feature_image', 'Featured Image', 'valid_url');
            }

            $build_slug = true;
            // Did an advanced user enter the url_title/slug?
            if ($this->input->post('url_title'))
            {
                // yup, so lets validate that...
                $this->form_validation->set_rules('url_title', 'Slug', 'required|alpha_dash|is_unique[blog_posts.url_title]|is_unique[pages.slug]');
                $build_slug = false;
            }

            // did they pass validations?
            if ($this->form_validation->run() == true) {

            // yes, so we'll start.
                $post_data = $this->input->post();

            // did they upload a feature image?
                if (!empty($_FILES['file']['name'])) {
                    $response = $this->mupload->do_upload();
                    if ($response['status'] == 0) {
                        message('error', $response['message']);
                        redirect(current_url());
                    } else {
                        $post_data['feature_image'] = $response['gallery_id'];
                    }
                }

                $featured_image = $this->input->post('feature_image');

                if (!empty($featured_image)) {
                    $post_data['feature_image'] = $this->input->post('feature_image');
                }

            // do we need to build the slug/url_title?
                if ($build_slug) {
                    $config = [
                        'field' => 'url_title',
                        'title' => $post_data['title'],
                        'table' => 'blog_posts'
                    ];
                    $this->load->library('slug', $config);

                    $post_data['url_title'] = $this->slug->create_uri($post_data['title']);

                }

            // get author info
                $post_data['author'] = $this->session->userdata('user_id');
                //$post_data['created_datetime'] = "";

            // the date
                $post_data['created_datetime'] = date('Y-m-d H:i:s');
               
                unset($post_data['_wysihtml5_mode']);
                unset($post_data['file']);
                unset($post_data['files']);

                

            // do the insert
                if ($this->blog_m->add_post($post_data)) {
                // add the categories

                    point_add(6);
                // succeeded
                    $this->session->set_flashdata('success', 'Post  added successfully');
                    redirect('admin/blog');
                }
            // failed
                message('error','Error adding post');
                redirect(current_url());
            }else{
                message('error',validation_errors());
                // redirect(current_url());
                // exit;
            }
        }

        
        $this->template
            ->title('Add Post')    
        ->build('admin/posts/add_post', $data);
    }


    /**
     * edit_post
     *
     * @access  public
     * @author  Enliven Applications
     * @version 3.0
     *
     * @param  string $id the post ID
     *
     * @return  null
     */
    public function edit($id)
    {
        $data['post'] = $this->blog_m->get_post($id);

        if ($this->input->post())
        {

            // set default for changing url_title
            $new_slug = false;

            $this->form_validation->set_rules('title', lang('post_form_title_text'), 'required');
            $this->form_validation->set_rules('status', lang('post_form_status_text'), 'required|in_list[draft,published]');
            $this->form_validation->set_rules('content', lang('post_form_content_text'), 'required');
            $this->form_validation->set_rules('excerpt', lang('post_form_excerpt_text'), 'required');
            $this->form_validation->set_rules('cats[]', lang('cats_hdr'), 'required');
            $this->form_validation->set_rules('meta_description','Meta Description','trim');

            if($this->input->post('feature_image')){
                $this->form_validation->set_rules('feature_image','Featured Image', 'valid_url');
            }

            // does the old url_title match the one from the form?
            if ($this->input->post('url_title') != $data['post']['url_title'])
            {
                // they do not, set $new_slug true
                // and validation rules.
                $new_slug = true;
                $this->form_validation->set_rules('url_title', lang('post_form_title_text'), 'required|alpha_dash|is_unique[blog_posts.url_title]|is_unique[pages.slug]');

            }
        

        // did they pass validations?
        if ($this->form_validation->run() == TRUE)
        {
            // yes, so we'll start updating.
            $post_data = $this->input->post();

            unset($post_data['feature_image']);
            // did they upload a feature image?
            if (!empty($_FILES['file']['name']))
            {
                $response = $this->mupload->do_upload();
                if($response['status'] == 0){
                    message('error', $response['message']);
                    redirect(current_url());
                }else{
                    $post_data['feature_image'] = $response['gallery_id'];
                }
            }

            $featured_image = $this->input->post('feature_image');
            if(!empty($featured_image)){
                $post_data['feature_image'] = $this->input->post('feature_image');
            }

            unset($post_data['_wysihtml5_mode']);
            $post_data['modified_datetime'] = date('Y-m-d H:i:s');


            // do the update
            $return = $this->blog_m->update_post($id, $post_data);
            if($return){
                // succeeded
                message('success', lang('post_update_success_resp'));
                redirect(current_url());
                exit;
            }else{
                message('error',lang('post_update_fail_resp'));
                redirect(current_url());
                exit;
            }


        }else{
            message('error',validation_errors());
            redirect(current_url());
        }
    }
        $this->template
        ->title('Edit Blog')
        ->build('admin/posts/edit_post', $data);

    }


    public function delete($id){
        if($this->blog_m->delete('blog_posts',array('id'=>$id))){
            message('success','Record deleted successfully');
            redirect('admin/blog');
        }else{
            message('error','Error deleting Record');
            redirect('admin/blog');
        }
    }


    public function categories(){
        $categories=$this->category_m->getCategories();
        foreach($categories as $r=> $category){
//            $posts=$this->blog_m->getPosts();
//            foreach($posts as $post){
//                $post_cat=$post['category'];
//                $post_cat=unserialize($post_cat);
//            }
        }
        $data=array('categories'=>$categories);

        $this->template->title('Blog Categories')
            ->build('admin/categories',$data);
    }

    public function add_categories(){
        if($_POST){
            $post_data = $this->input->post();
            $this->form_validation->set_rules('name', 'Category Title', 'trim|required');
            $build_slug = true;
            if ($post_data['slug'] != '') {
                $this->form_validation->set_rules('slug', 'Category Url', 'required|alpha_dash|is_unique['.config('tbl_categories').'.slug]');
                $build_slug = false;
            }

            if ($this->form_validation->run() == false) {
                message('error', validation_errors());
                redirect(current_url());
            } else {

                if ($build_slug == true) {
                    $config = array(
                        'field' => 'slug',
                        'title' => $post_data['name'],
                        'table' => config('tbl_categories')
                    );

                    $this->load->library('slug', $config);
                    $slug = $this->slug->create_slug($post_data['name']);
                } else {
                    $slug = $post_data['slug'];
                }

            

            $title=$this->input->post('name');
            $description=$this->input->post('description');
            $parent=$this->input->post('parent');
            $data=array(
                'name'=>$title,
                'description'=>$description,
                'parent'=>$parent,
                'slug'=>$slug,
                'created'=>date('Y-m-d H:i:s')
            );
            if($this->category_m->addCategory($data)){
                $this->session->set_flashdata('success','Category added successfully');
            }else{
                $this->session->set_flashdata('error','Error adding category');
            }

            redirect(current_url());
            exit;

        }
    }
        $categories=$this->category_m->getCategories();
        $data=array('categories'=>$categories);
        $this->template->title('Blog Categories')
            ->build('admin/add_categories',$data);
    }


    public function category_edit($id){
        $data = $this->category_m->getCategory($id);
        
        if($_POST){
            $post_data = $this->input->post();
            $this->form_validation->set_rules('name', 'Category Title', 'trim|required');
            $build_slug = true;
            if (($post_data['slug'] != '') && ($post_data['slug'] != $data['slug'])) {
                $this->form_validation->set_rules('slug', 'Category Url', 'required|alpha_dash|is_unique['.config('tbl_categories').'.slug]');
                $build_slug = false;
            }

            if ($this->form_validation->run() == false) {
                message('error', validation_errors());
                redirect(current_url());
            } else {

                 

                $data = array(
                    'name' => $post_data['name'],
                    'description' => $post_data['description'],
                    'parent' => $post_data['parent']
                );

                if ($build_slug == false) {
                    $data['slug'] = $post_data['slug'];
                }


                if ($this->category_m->updateRecord( $data, array('id'=> $id))) {
                    message('success', 'Record updated successfully');
                    redirect(current_url());
                } else {
                    message('error', 'Error updating record');
                    redirect(current_url());
                }

            }
            
        }
        
        $this->template->title('Edit Categories')
            ->build('admin/edit_categories',$data);
    }


    public function category_delete($id){
        if($this->category_m->delete(config('tbl_categories'),array('id'=>$id))){
            $this->session->set_flashdata('success','Category deleted successfully');
        }else{
            $this->session->set_flashdata('error','Error deleting category');
        }
        redirect('admin/blog/categories');
        exit;
    }



    /*
     * tags
     */
    public function tags(){
        $tags=$this->tag_m->getTags();
        foreach($tags as $r=> $category){
//            $posts=$this->blog_m->getPosts();
//            foreach($posts as $post){
//                $post_cat=$post['category'];
//                $post_cat=unserialize($post_cat);
//            }
        }
        $data=array('tags'=>$tags);

        $this->template->title('Blog Tags')
            ->build('admin/tags',$data);
    }


    public function add_tags(){
        if($_POST){
            $title=$this->input->post('title');
            $description=$this->input->post('description');
            $slug=slugify($title);
            $data=array(
                'name'=>$title,
                'description'=>$description,
                'slug'=>$slug
            );
            if($this->tag_m->insert('blog_tags',$data)){
                $this->session->set_flashdata('success','Tag added successfully');
            }else{
                $this->session->set_flashdata('error','Error adding tag');
            }

            redirect('admin/blog/tags');
            exit;

        }
        $tags=$this->tag_m->getTags();
        $data=array('tags'=>$tags);
        $this->template->title('Blog Tags')
            ->build('admin/add_tags',$data);
    }


    public function tag_edit($id){
        if($_POST){
            $data=array(
                'name'=>$this->input->post('title'),
                'description'=>$this->input->post('description')
            );

            if($this->tag_m->update('blog_tags',$data,array('id'=>$id))){
                $this->session->set_flashdata('success','Tag updated successfully');
            }else{
                $this->session->set_flashdata('error','Error updating tag');
            }

            redirect(uri_string());
            exit;
        }
        $data=$this->tag_m->getTag($id);
        $this->template->title('Edit Tag')
            ->build('admin/edit_tags',$data);
    }


    public function tag_delete($id){
        if($this->tag_m->delete('blog_tags',array('id'=>$id))){
            $this->session->set_flashdata('success','Tag deleted successfully');
        }else{
            $this->session->set_flashdata('error','Error deleting tag');
        }
        redirect('admin/blog/tags');
        exit;
    }
}