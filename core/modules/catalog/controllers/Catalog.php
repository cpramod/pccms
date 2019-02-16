<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 10/2/18
 * Time: 7:02 PM
 */

class Catalog extends Main_Controller{
    function __construct()
    {
        parent::__construct();
        $this->template->set_layout('fullwidth');
        $this->load->model('catalog_m');
    }

    public function index(){
        $data = array('catalogs'=>$this->catalog_m->getAllCatalogs());
        $this->template->title('Catalog')
            ->build('index', $data);
    }

    public function view($slug){
        if($this->input->post()){
            $this->addRating($slug);
        }
        $data = $this->catalog_m->getCatalogBySlug($slug);
        if(!$data){
            show_404();
        }
        $data->metas = $this->catalog_m->getMetas($data->id);
        $data->categories = $this->catalog_m->getCatalogCatById($data->id);
        $data->reviews = $this->catalog_m->getReviews($slug);
        // related products
        $data->related_products = $this->catalog_m->getRelatedProducts($slug);
        $this->template
            ->set_layout('shop')
            ->title($data->title)
            ->build('single', $data);
    }


    public function addRating($slug){
        $data=array(
            'name' => $this->input->post('name'),
            'email'=> $this->input->post('email'),
            'star' => $this->input->post('rating'),
            'description' => $this->input->post('description'),
            'catalog' => $slug,
            'status' => 0,
            'avatar' => $this->input->post('avatar')?$this->input->post('avatar'):'',
            'date' => date('Y-m-d H:i:s')
        );

        if($this->catalog_m->insert('catalog_review',$data)){
            sendEmail('admin@dailylifeinusa.com','New Review','New Review on catalog. Please verify it.',array('name'=>$data['name'],'email'=>$data['email']));
            message('success','Thank you for your review');
            redirect(current_url());
        }
    }
}