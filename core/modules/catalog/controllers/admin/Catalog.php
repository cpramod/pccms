<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 10/2/18
 * Time: 7:02 PM
 */

class Catalog extends My_Controller{
    function __construct()
    {
        parent::__construct();
        //ini_set('display_errors',1);
        $this->load->model('catalog_m');
        $this->load->library('uploads/mupload');
    }

    function index($offset = 0){
        $catalogs = $this->catalog_m->getAllCatalogs($this->limit, $offset);
        $total = count($this->catalog_m->getAllCatalogs());
        $pagination = pagination(site_url('admin/catalog/index'),$total);
        foreach($catalogs as $r=> $catalog){
            $catalogs[$r]->categories = $this->catalog_m->getCatalogCatById($catalog->id);

        }


        $data=array('catalogs' => $catalogs);

        $this->template->title('Catalog')
            ->set('pagination', $pagination)
            ->build('admin/index',$data);
    }


    public function add(){
        if($this->input->post()){
            $this->form_validation->set_rules('title','Title','required');
            $this->form_validation->set_rules('status','Status','required|in_list[draft,published]');
            $this->form_validation->set_rules('description','Description','required');
            $build_slug = true;
            if($this->input->post('slug')){
                $this->form_validation->set_rules('slug','Slug','required | alpha_dash | is_unique[catalog.slug]');
                $build_slug = false;
            }

            if($this->form_validation->run() == false){
                $this->session->set_flashdata('error',validation_errors());
                redirect(current_url());
            }else{
                $post_data = $this->input->post();

                /**
                 * slug code
                 */
                if($build_slug == true){
                    $config=array(
                        'field'=>'slug',
                        'title'=>$this->input->post('title'),
                        'table' => 'catalog'
                    );

                    $this->load->library('slug',$config);
                    $post_data['slug']=$this->slug->create_slug($post_data['title']);

                }

                /*
                 * end of slug code
                 */

                /**
                 * featured image upload code
                 */

                if($_FILES['file']){
                    $response = $this->mupload->do_upload();
                    if($response['status'] == 0){
                        message('error',$response['message']);
                    }else{
                        $post_data['featured_image'] = $response['gallery_id'];
                    }
                }

                /**
                 * end of featured image code
                 */

                unset($post_data['_wysihtml5_mode']);
                unset($post_data['metas']);
                unset($post_data['key']);
                unset($post_data['value']);

                unset($post_data['cats']);

                $post_data['publish_date'] = Date('Y-m-d H:i:s');

                if($catalog_id = $this->catalog_m->insert('catalog',$post_data)){
                    /*
                 * meta manipulation
                 */

                    if($keys = $this->input->post('key')){
                        $meta_value = $this->input->post('value');
                        $i=0;
                        foreach($keys as $key){
                            $meta = array(
                                'meta_key'=>$key,
                                'meta_value'=>$meta_value[$i],
                                'catalog_id'=> $catalog_id
                            );

                            $this->catalog_m->insert('catalog_meta',$meta);

                            $i++;
                        }
                    }

                    $cats = $this->input->post('cats');
                    foreach($cats as $cat){
                        $this->catalog_m->insert('meta',array('mkey'=>'category', 'mvalue'=>$cat, 'post'=>$catalog_id, 'type'=>'catalog'));
                    }

                    /*
                     * end of meta manipulation
                     */

                    message('successs', 'Record added successfully');
                }else{
                    message('error', 'Error adding Record');
                }
                redirect('admin/catalog');
            }
        }
        $data=array(
            'cats' => (array) $this->catalog_m->getCatalogCat(),
            'keys' => $this->catalog_m->getKeys()
        );


        $this->template->title('Catalog')
            ->build('admin/add',$data);
    }

    public function edit($id){
        $data = $this->catalog_m->getCatalog($id);
        $data->metas = $this->catalog_m->getMetas($id);
        $data->categories = $this->catalog_m->getCatalogCatById($data->id);

        if($this->input->post()){
            $this->form_validation->set_rules('title','Title','required');
            $this->form_validation->set_rules('status','Status','required|in_list[draft,published]');
            $this->form_validation->set_rules('description','Description','required');
            $build_slug = false;
            if($this->input->post('slug') && $data->slug != $this->input->post('slug')){
                $this->form_validation->set_rules('slug','Slug','required|alpha_dash|is_unique[catalog.slug]');
                $build_slug = true;
            }

            if($this->form_validation->run() == false){
                $this->session->set_flashdata('error',validation_errors());
                redirect(current_url());
            }else{
                $post_data = $this->input->post();

                /**
                 * slug code
                 */
                if($build_slug == true){
                    $config=array(
                        'field'=>'slug',
                        'title'=>$this->input->post('title'),
                        'table' => 'catalog'
                    );

                    $this->load->library('slug',$config);
                    $post_data['slug']=$this->slug->create_slug($post_data['title']);

                }else{
                    unset($post_data['slug']);
                }

                /*
                 * end of slug code
                 */

                /**
                 * featured image upload code
                 */

                if($_FILES['file']['name']){
                    $response = $this->mupload->do_upload();
                    if($response['status'] == 0){
                        message('error',$response['message']);
                    }else{
                        $post_data['featured_image'] = $response['gallery_id'];
                    }
                }

                /**
                 * end of featured image code
                 */

                unset($post_data['_wysihtml5_mode']);
                unset($post_data['metas']);
                unset($post_data['key']);
                unset($post_data['value']);

                unset($post_data['cats']);
                unset($post_data['publish_date']);

                if($this->catalog_m->update('catalog',$post_data,array('id'=>$id))){
                    /*
                 * meta manipulation
                 */

                    //delete all keys
                    $this->catalog_m->delete('catalog_meta',array('catalog_id'=>$id));

                    if($keys = $this->input->post('key')){
                        $meta_value = $this->input->post('value');
                        $i=0;
                        foreach($keys as $key){
                            $meta = array(
                                'meta_key'=>$key,
                                'meta_value'=>$meta_value[$i],
                                'catalog_id'=> $id
                            );

                            $this->catalog_m->insert('catalog_meta',$meta);

                            $i++;
                        }
                    }

                    // delete category
                    $this->catalog_m->delete('meta',array('mkey'=>'category','post'=>$id, 'type'=>'catalog'));
                    $cats = $this->input->post('cats');
                    foreach($cats as $cat){
                        $this->catalog_m->insert('meta',array('mkey'=>'category', 'mvalue'=>$cat, 'post'=>$id, 'type'=>'catalog'));
                    }

                    /*
                     * end of meta manipulation
                     */

                    message('successs', 'Record updated successfully');
                }else{
                    message('error', 'Error updating Record');
                }
                redirect('admin/catalog');
            }
        }
        $data->cats = (array) $this->catalog_m->getCatalogCat();
        $data->keys = $this->catalog_m->getKeys();




        $this->template->title('Catalog')
            ->build('admin/edit',$data);
    }

    public function delete($id){
        if($this->catalog_m->delete('catalog',array('id'=>$id))){
            redirect('admin/catalog');
        }
    }

    public function categories($offset=0){
        $data=array('categories' => $this->catalog_m->getAllCategories(false, $this->limit, $offset));
        $total = count($this->catalog_m->getAllCategories());
        $this->template->title('Catalog Categories')
            ->set('pagination',pagination(site_url('admin/catalog/categories'),$total))
            ->build('admin/categories',$data);
    }

    public function add_categories(){
        if($this->input->post()){
            $this->form_validation->set_rules('title','Title','required');
            $this->form_validation->set_rules('parent','Parent Category','');

            $build_slug = true;

            if ($this->input->post('slug'))
            {
                $this->form_validation->set_rules('slug', 'Slug', 'required|alpha_dash|is_unique[catalog_categories.slug]');
                $build_slug = false;
            }

            if($this->form_validation->run() == FALSE){
                $message = validation_errors();
                $this->session->set_flashdata('error',$message);
                redirect(current_url());
            }else{
                $post_data = $this->input->post();

                // create the slug
                if($build_slug) {
                    $config = [
                        'field' => 'slug',
                        'title' => $this->input->post('title'),
                        'table' => 'catalog_categories'
                    ];

                    $this->load->library('slug', $config);
                    $post_data['slug'] = $this->slug->create_uri($post_data['title']);
                }
                if($this->catalog_m->insert('catalog_categories',$post_data)){
                    $this->session->set_flashdata('success','Category added successfully');
                }else{
                    $this->session->set_flashdata('error','Error adding Category');
                }

                redirect(current_url());
                exit;
            }
        }
        $data=array('categories'=>$this->catalog_m->getParentCat());
        $this->template->title('Add Categories')
            ->build('admin/add_categories',$data);
    }


    public function edit_category($id){
        $data = $this->catalog_m->getOne('catalog_categories',array('id'=>$id));

        if($this->input->post()){
            $new_slug = true;
            $this->form_validation->set_rules('title','Title','required');
            $this->form_validation->set_rules('parent','Parent Category','');

            if ($this->input->post('slug') != $data['slug'])
            {
                $new_slug = false;
                $this->form_validation->set_rules('slug', 'Slug', 'required|alpha_dash|is_unique[catalog_categories.slug]');

            }

            if($this->form_validation->run() == FALSE){
                $message = validation_errors();
                $this->session->set_flashdata('error',$message);
                redirect(current_url());
            }else{
                $post_data = $this->input->post();

                if($new_slug) {
                    $config = [
                        'field' => 'slug',
                        'title' => $this->input->post('title'),
                        'table' => 'catalog_categories'
                    ];

                    $this->load->library('slug', $config);

                    // create the slug
                    $post_data['slug'] = $this->slug->create_uri($post_data['title']);
                }
                if($this->catalog_m->update('catalog_categories',$post_data,array('id'=>$id))){
                    $this->session->set_flashdata('success','Category updated successfully');
                }else{
                    $this->session->set_flashdata('error','Error updating Category');
                }

                redirect(current_url());
                exit;
            }
        }


        $data['categories']=$this->catalog_m->getParentCat($id);
        $this->template->title('Edit Categories')
            ->build('admin/edit_category',$data);
    }


    public function delete_category($id){
        $response = $this->catalog_m->delete('catalog_categories',array('id'=>$id));
        if($response){
            $this->session->set_flashdata('success','Record deleted successfully');
        }else{
            $this->session->set_flashdata('error','Error deleting Record');
        }

        redirect('admin/catalog/categories');
    }


    /*
     * function for meta data
     */

    public function meta(){
        $data = array();
        $this->template->title('Meta Data')
            ->build('admin/meta', $data);
    }

    public function add_meta(){
        $data = array();
        $this->template->title('Meta Data')
            ->build('admin/add_meta', $data);
    }

    public function review(){
        $data=array('reviews' => $this->catalog_m->getAllReviews());
        $this->template->title('Catalog Reviews')
            ->build('admin/reviews',$data);
    }

    public function review_approve($id){
        if($this->catalog_m->update('catalog_review',array('status'=>1),array('id'=>$id))){
            redirect('admin/catalog/review');
        }
    }
}