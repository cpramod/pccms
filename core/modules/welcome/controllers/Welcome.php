<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Front_Controller {

	function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$this->ion_auth_model->set_hook('interested_in', 'interested_in',Modules::load('jobs'),'interestedIn',array());
		$this->ion_auth_model->set_hook('featured_job', 'featured_job',Modules::load('jobs'),'featuredJob',array('featured'));
		$this->ion_auth_model->set_hook('hot_job', 'hot_job', Modules::load('jobs'), 'featuredJob', array('hot'));
		$this->ion_auth_model->set_hook('normal_job', 'normal_job', Modules::load('jobs'), 'featuredJob', array('normal'));
                $this->ion_auth_model->set_hook('newspaper', 'newspaper', Modules::load('jobs'), 'featuredJob', array('newspaper'));
		$this->template
		->title('Search for best jobs')
		->append_metadata('<link rel="canonical" href="'.base_url().'" />')
		->set('class','home')
		->set_layout('home')
		->build('welcome_message');
	}

	// function view($slug){
	// 	$slug = urldecode($slug);
	// 	$this->config->load('blog/table');
	// 	$this->load->model('pages/pages_m','pages_m',true);
	// 	$this->load->model('blog/blog_m', 'blog_m', true);
	// 	if($this->pages_m->count_by('pages',array('slug'=>$slug))>0){
	// 		modules::load('pages')->view($slug);
	// 	}elseif($this->blog_m->count_by('blog_posts', array('url_title' => $slug)) > 0){
	// 		modules::load('blog')->post($slug);
	// 	}

	// }
	
	/** 404 page */
	// function notfound(){
	// 	$this->template->title('404 Page')
	// 		->set_layout('fullwidth')
	// 		->set('class','page notfound')
	// 		->set_breadcrumb('404 Not Found','')
	// 		->build('notfound');
	// }

	/**
	 * pricing page
	 */
	function pricing(){
		$this->template->title('Pricing')
			->append_metadata('<link rel="canonical" href="'.site_url('pricing').'" />')
			->set_layout('fullwidth')
			->set('class','page pricing')
			->set_breadcrumb('Pricing','')
			->build('pricing');
	}

	/**
	 * expired page
	 */
	// function expired()
	// {
	// 	$this->template->title('Job Expired')
	// 		->set_layout('fullwidth')
	// 		->set('class', 'page notfound')
	// 		->set_breadcrumb('Job Expired', '')
	// 		->build('expired');
	// }

}
