<?php

class Jobs extends Front_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('jobs_m');
    }


    public function index($category='0', $offset=0){

        if($this->input->get()){
            $posted_data = $this->input->get();
            $this->ion_auth_model->set_hook('where', 'extra_where', $this->jobs_m, 'jobSearch', array($posted_data));
            $jobs = $this->jobs_m
                ->select(config('job') . '.*, users.avatar, users.company as main_company')
                ->getAll(config('job'), $this->limit, $offset);
            $total = $this->jobs_m
                ->select(config('job') . '.*, users.avatar, users.company as main_company')
                ->getAll(config('job'));
            $this->ion_auth_model->remove_hook('where', 'extra_where');

            if($posted_data['category']){
                $title = $this->getTitleBySlug($posted_data['category'], 'job_category');
                $this->template->title($title)
                ->set('category', $posted_data['category']);
            }else{
                $this->template->title('Job Search')
                ->set('category',$posted_data['category']);
            }

            $site_url=site_url('jobs/index/0');
        }
        elseif ($category != '0') {

            $posted_data['category'] = $category;
            $this->ion_auth_model->set_hook('where', 'extra_where', $this->jobs_m, 'jobSearch', array($posted_data));
            $jobs = $this->jobs_m
                ->select(config('job') . '.*, users.avatar, users.company as main_company')
                ->getAll(config('job'), $this->limit, $offset);
            $total = $this->jobs_m
                ->select(config('job') . '.*, users.avatar, users.company as main_company')
                ->getAll(config('job'));
            $this->ion_auth_model->remove_hook('where', 'extra_where');

            $site_url = site_url('jobs/index/'.$category);

            $title = $this->getTitleBySlug($posted_data['category'], 'job_category');
            $this->template->title($title)
                ->set('category', $category);
        }
        
        else{
            $this->ion_auth_model->set_hook('where', 'extra_where', $this->jobs_m, 'jobSearch', array());
            $jobs = $this->jobs_m
                ->select(config('job') . '.*, users.avatar, users.company as main_company')
                ->getAll(config('job'), $this->limit, $offset);

            $total = $this->jobs_m
                ->select(config('job') . '.*, users.avatar, users.company as main_company')
                ->getAll(config('job'));
            $this->ion_auth_model->remove_hook('where', 'extra_where');

            $this->template->title('Job Search');
            $site_url = site_url('jobs/index/0');
        }

        

        $specialisms = $this->jobs_m->select('slug, title')->getAll(config('tbl_category'));
        $jobs_type = $this->jobs_m->get_by(config('job_type'), array('status' => 1));
        $level = $this->jobs_m->get_by(config('job_level'), array('status' => 1));
        $qualification = $this->jobs_m->get_by(config('job_qualification'), array('status' => 1));

        /**
         * featured job for right sidebar
         */
        
        $this->ion_auth_model->set_hook('where', 'extra_where', $this->jobs_m, 'homeCategory', array('featured'));
        $featured = $this->jobs_m
            ->select(config('job') . '.*, users.avatar, users.company as main_company')
            ->getAll(config('job'));
        $this->ion_auth_model->remove_hook('where', 'extra_where');



        /**
         * end of featured job
         */

        $this->template
        ->set_layout('fullwidth')
        ->set('class','search')
        ->set('jobs',$jobs)
        ->set('total', count($total))
        ->set('specialisms', $specialisms)
        ->set('types', $jobs_type)
        ->set('featured', $featured)
        ->set_breadcrumb('Search',current_url())
        ->set('pagination',pagination($site_url,count($total)))
        ->build('search');

    }

    /***
     * single job page
     */
    
    
    public function view($id){
        //preview mode
        if(isset($_GET['preview']) && $_GET['preview'] == 1){
            if($this->ion_auth->logged_in()){
                $this->ion_auth_model->set_hook('extra_where', 'jobdetail', $this->jobs_m, 'getCompleteJobDetailPreview', array($id)); 
            }else{
                show_404();
                exit;
            }
        }else{
            if(is_numeric($id)){
                //insert view count
                $this->jobs_m->insert(config('job_views'), array('job_id' => $id, 'count' => 1, 'ip' => $this->input->ip_address()));
                // end of view count script
            }
                       
            $this->ion_auth_model->set_hook('extra_where', 'jobdetail', $this->jobs_m, 'getCompleteJobDetail', array($id)); 
        }

        $data = $this->jobs_m
            ->select(config('job') . '.*, users.avatar, users.company as main_company, users.id as user_id, ' . config('auth_user_meta') . '.website')
            ->get(config('job'));

        if (!isset($_GET['preview']) && (!$_GET['preview'] == 1)) {
            if(!is_numeric($id)){
                //insert view count
                $this->jobs_m->insert(config('job_views'), array('job_id' => $data['id'], 'count' => 1, 'ip' => $this->input->ip_address()));
                // end of view count script
            }
        }

        $this->ion_auth_model->remove_hook('extra_where', 'jobdetail');

        if(count($data) == 0){
            show_404();
            exit;
        }

        /**
         * featured job for right sidebar
         */

        $this->ion_auth_model->set_hook('where', 'extra_where', $this->jobs_m, 'homeCategory', array('featured'));
        $featured = $this->jobs_m
            ->select(config('job') . '.*, users.avatar, users.company')
            ->getAll(config('job'));
        $this->ion_auth_model->remove_hook('where', 'extra_where');

        /**
         * end of featured job
         */

        $company = $data['company'] ? $data['company'] : $data['main_company'];
        $title= 'Vacancy for the post of ' . $data['title'] . ' at ' . $company;
        $this->template->title($title)
            ->set('class', 'single')
            ->set_layout('home');

        if(!empty($this->user_details)){
            $applied = $this->jobs_m->get_by(config('job_apply'), array('user_id' => $this->user_details['user_id'], 'job_id' => $id));
            $this->template->set('applied', $applied);
        }

        /**
         * count number of views
         */

        $views = $this->jobs_m->get_by(config('job_views'),array('job_id'=>$data['id']));
        // end of count code
        
        /**
         * related jobs
         */
        $this->ion_auth_model->set_hook('where', 'extra_where', $this->jobs_m, 'join_user', array());
        
        $related=$this->jobs_m
        ->select(config('job') . '.*, users.avatar, users.company')
        ->get_by(config('job'),array('job_category'=>$data['job_category']),array('date'=>'desc'),3);
        $this->ion_auth_model->remove_hook('where','extra_where');

       
        
        $this->template
        ->set('featured', $featured)
        ->set('banner',$data['banner'])
        ->set('fb_description', substr(strip_tags($data['description']),0,250))
        ->set('related',$related)
        ->set('views', $views)
        ->build('single',$data);
    }

    /** approve job post */

    public function approve($id){
        if($this->ion_auth->is_admin()){
            if(!$id){
                show_404();
            }else{
                if($this->jobs_m->update(config('job'),array('status'=>2),array('id'=>$id))){
                    message('success','Job is successfully approved');
                    redirect('jobs/list');
                    exit;
                }
            }
        }
    }

    /**
     * disable job pos
     */
    public function deapprove($id)
    {
        if ($this->ion_auth->is_admin()) {
            if (!$id) {
                show_404();
            } else {
                if ($this->jobs_m->update(config('job'), array('status' => 0), array('id' => $id))) {
                    message('success', 'Job is successfully disabled');
                    redirect('jobs/list');
                    exit;
                }
            }
        }
    }


    /**
     * function to apply to job
     */

    public function apply($id){
        if(!$id){
            show_404();
            exit;
        }

        if(empty($this->user_details)){
            redirect('/');
        }

        $response = $this->jobs_m->insert(config('job_apply'),array('user_id'=>$this->user_details['user_id'],'job_id'=>$id));
        if($response){
            message('success','You successfully applied to this Job.');
            redirect('jobs/view/'.$id);
        }
    }

    /**
     * function to get list of applied jobs
     */
    function applied(){
        if (empty($this->user_details)) {
            redirect('/');
        }

        $this->ion_auth_model->set_hook('where','jobapplied',$this->jobs_m,'jobsApplied',array());
        $jobs = $this->jobs_m->select(config('job').'.*, users.company, users.avatar')
        ->getAll(config('job_apply'));

        $this->ion_auth_model->remove_hook('where','jobapplied');

        $this->template->title('Job Applied')
        ->set_layout('layout-sidebar')
        ->set('jobs',$jobs)
        ->set('class','applied page')
        ->set('menu','applied')
        ->set_breadcrumb('Profile',site_url('profile'))
        ->build('applied');
    }

    /**
     * function to get list of jobs by the employer
     */


    function list($offset=0){
        if (empty($this->user_details)) {
            redirect('/');
        }

        if($this->ion_auth->is_admin()){
            $jobs = (array)$this->jobs_m->get_by(config('job'), array(), array('date' => 'desc'),$this->limit,$offset);
            $total = (array)$this->jobs_m->get_by(config('job'), array(), array('date' => 'desc'));
        }else{
            $jobs = (array)$this->jobs_m->get_by(config('job'), array('user_id' => $this->user_details['user_id']), array('date' => 'desc'), $this->limit, $offset);
            $total = (array)$this->jobs_m->get_by(config('job'), array('user_id' => $this->user_details['user_id']), array('date' => 'desc'));
        }

        foreach($jobs as $i=> $job){
            $applied = $this->jobs_m->get_by(config('job_apply'),array('job_id'=>$job['id']));
            
            //count how many people have applied to this job
            $jobs[$i]['applied'] = count($applied);
            $views = $this->jobs_m->get_by(config('job_views'),array('job_id'=>$job['id']));
            $jobs[$i]['views'] = count($views);
        }
        
        $this->template->title('Jobs List')
            ->set_layout('job-list')
            ->set('class','page')
            ->set('menu', 'list')
            ->set('jobs', $jobs)
            ->set_breadcrumb('Jobs',site_url('jobs'))
            ->set('pagination',pagination(site_url('jobs/list'),count($total)))
            ->build('index');
    }



    public function interestedIn(){
        $data=array('categories'=>$this->jobs_m->get_by(config('tbl_category'),array()));
        $this->load->view('job-by-category',$data);
    }

    /**
     * function to upload cover image for job
     */
    function uploadCover(){
        
        $base64 = $this->input->post('banner');
        $filename = 'cover-' . rand(1000,100000) . '.jpg';
        $output = UPLOAD_PATH . $filename;
        base64_to_jpeg($base64, $output);
        return $upload_id = $this->ion_auth_model->insert(config('tbl_upload'), array('title' => $filename, 'link' => $filename));

    }

    /**
     * logo update for newpaper job
     */
    function uploadLogo()
    {

        $base64 = $this->input->post('company_logo');
        $filename = 'logo-' . rand(1000, 100000) . '.jpg';
        $output = UPLOAD_PATH . $filename;
        base64_to_jpeg($base64, $output);
        return $upload_id = $this->ion_auth_model->insert(config('tbl_upload'), array('title' => $filename, 'link' => $filename));

    }

    /**
     * step 1 for posting job
     */

    function step1($id){
        if (empty($this->user_details)) {
            redirect('/');
        }

        if($id){
            $posted_data = $this->jobs_m->get(config('job'),array('id'=>$id));
            
        }
        if ($this->input->post()) {
            $posted_data = $this->input->post();
            $this->form_validation->set_rules('title', 'Job Title', 'required');
            $this->form_validation->set_rules('job_type', 'Job Type', 'required');
            $this->form_validation->set_rules('job_category', 'Specialism', 'required');
            $this->form_validation->set_rules('career_level', 'Career Level', 'required');
            $this->form_validation->set_rules('industry', 'Industry', 'required');
            $this->form_validation->set_rules('deadline', 'Deadline', 'required');
            $this->form_validation->set_rules('specification', 'Job Specification', 'trim');
            $this->form_validation->set_rules('description', 'Job Description', 'trim');
            $this->form_validation->set_rules('no_of_vacancy','No of Vacancy','required');

            if ($this->form_validation->run() == false) {
                message('error', validation_errors());

            } else {

                // create slug while adding new job
                if($id == ''){
                    $config = [
                        'field' => 'slug',
                        'title' => $posted_data['title'],
                        'table' => config('job')
                    ];

                    $this->load->library('slug', $config);

                    $posted_data['slug'] = $this->slug->create_uri($posted_data['title']);          
                }

                unset($posted_data['files']);
                unset($posted_data['submit']);
                $posted_data['status'] = 0;
                $posted_data['date']   = strtotime(date('Y-m-d H:i:s'));
                $posted_data['deadline'] = strtotime($posted_data['deadline']);
                $posted_data['user_id'] = $this->session->userdata('user_id');

                /** upload cover for job post */
                if(isset($posted_data['banner']) && ($posted_data['banner'] != '')){
                    $posted_data['banner'] = $this->uploadCover();
                }else{
                    unset($posted_data['banner']);
                }

                /** logo upload for newspaper job */
                if (isset($posted_data['company_logo']) && ($posted_data['company_logo'] !='')) {
                    $posted_data['company_logo'] = $this->uploadLogo();
                }else{
                    unset($posted_data['company_logo']);
                }

                if($id){
                    if ($this->jobs_m->update(config('job'), $posted_data, array('id'=>$id))) {
                    //message('success','Job posted successfully');
                        redirect('jobs/post/' . $id . '/2');
                        exit;
                    }
                }else{
                    if ($post_id = $this->jobs_m->insert(config('job'), $posted_data)) {
                    //message('success','Job posted successfully');
                        redirect('jobs/post/' . $post_id . '/2');
                        exit;
                    }
                }
                
            }


        }

        $specialisms = $this->jobs_m->select('slug, title')->getAll(config('tbl_category'));
        $jobs_type = $this->jobs_m->get_by(config('job_type'), array('status' => 1));
        $salary = $this->jobs_m->get_by(config('job_salary'), array('status' => 1));
        $level = $this->jobs_m->get_by(config('job_level'), array('status' => 1));
        $experience = $this->jobs_m->get_by(config('job_experience'), array('status' => 1));
        $gender = $this->jobs_m->get_by(config('job_gender'), array('status' => 1));
        $industry = $this->jobs_m->get_by(config('job_industry'), array('status' => 1));
        $qualification = $this->jobs_m->get_by(config('job_qualification'), array('status' => 1));
        $this->template->title('Post New Job')
            ->set_layout('layout-sidebar')
            ->set('class', 'page')
            ->set('menu', 'new-job')
            ->set_breadcrumb('Jobs', site_url('jobs'))
            ->set_breadcrumb('New Job', site_url('jobs/post'))
            ->set('job_types', $jobs_type)
            ->set('specialisms', $specialisms)
            ->set('salaries', $salary)
            ->set('levels', $level)
            ->set('experiences', $experience)
            ->set('genders', $gender)
            ->set('industries', $industry)
            ->set('qualifications', $qualification)
            ->append_metadata(css('selectize.css'))
            ->append_metadata(js('selectize.min.js'))
            ->append_metadata("<script>
                $(document).ready(function(){
                    $('input[name=skills]').selectize({
                        delimiter: ',',
                        persist: false,
                        create: function(input) {
                            return {
                                value: input,
                                text: input
                            }
                        }
                    });
                });
            </script>")
            ->build('post', $posted_data);
    }

    /**
     * step 2 for posting Job
     */

    function step2($id){
        if (empty($this->user_details)) {
            redirect('/');
        }

        $posted_data = $this->jobs_m->get(config('job'),array('id'=>$id));
        if($this->input->post()){
            $posted_data = $this->input->post();
            $this->form_validation->set_rules('package', 'Package', 'required');
            if($this->form_validation->run() == false){
                message('error',validation_errors());
                redirect(current_url());
            }else{
                unset($posted_data['submit']);
                if ($this->jobs_m->update(config('job'), $posted_data, array('id' => $id))) {
                    redirect('jobs/post/' . $id . '/3');
                }
            }
            
        }
        $this->template->title('Post New Job')
            ->set_layout('layout-sidebar')
            ->set('class', 'page')
            ->set('menu', 'new-job')
            ->set('id', $id)
            ->set_breadcrumb('Jobs', site_url('jobs'))
            ->set_breadcrumb('New Job', site_url('jobs/post'))
            ->build('step2', $posted_data);
    }

    /**
     * step 3 for posting Job
     */

    function step3($id)
    {
        if (empty($this->user_details)) {
            redirect('/');
        }
        if ($posted_data = $this->input->post()) {
            $this->form_validation->set_rules('payment', 'Payment', 'required');
            if($this->form_validation->run()==false){
                message('error',validation_errors());
                redirect(current_url());
            }else{
                unset($posted_data['submit']);
                if ($posted_data['payment'] != 'bank') {
                    Modules::load('payments')->makePayment($id, $posted_data);
                } else {
                    if ($this->jobs_m->update(config('job'), array('status' => 1), array('id' => $id))) {
                        redirect('jobs/thankyou/' . $id);
                    }
                }
            }
        }
        $this->template->title('Post New Job')
            ->append_metadata('<script src="https://khalti.com/static/khalti-checkout.js"></script>')
            ->set_layout('layout-sidebar')
            ->set('class', 'page')
            ->set('menu', 'new-job')
            ->set('id', $id)
            ->set_breadcrumb('Jobs', site_url('jobs'))
            ->set_breadcrumb('New Job', site_url('jobs/post'))
            ->build('step3', $posted_data);
    }

    /**
     * function to post job
     */
    function post($id = '',$step=''){
        
        if(empty($this->user_details)){
            redirect('/');
        }

        $posted_data = array();

        if($step == 2){
            $this->step2($id);
            
        }elseif($step == '' || $step == 1){
            $this->step1($id);
        }elseif($step == 3){
            $this->step3($id);
        }

        
    }

    /**
     * thank you page after successful job posting
     */


    public function thankyou($id){
        if (empty($this->user_details)) {
            redirect('/');
        }
        $jobs = $this->jobs_m->get(config('job'),array('id'=>$id));
        $this->template->title('Thank You')
            ->set_layout('layout-sidebar')
        ->set('class','page')
            ->set_breadcrumb('Jobs','')
            ->set('jobs',$jobs)
            ->build('thankyou');
    }

    /** get specialism */
    function getCategory(){
        return $this->jobs_m->getAll(config('tbl_category'));
    }

    /**
     * function to get jobs list for homepage
     */


    public function featuredJob($type){
        $this->ion_auth_model->set_hook('where', 'extra_where', $this->jobs_m, 'homeCategory', array($type));   
        $data['jobs'] = $this->jobs_m
            ->select(config('job').'.*, users.avatar, users.company as main_company')
            ->getAll(config('job'));
        $this->ion_auth_model->remove_hook('where', 'extra_where');
        echo $this->load->view('item',$data,true);
    }

    /**
     * function to get field attributes by slug
     */

    public function getTitleBySlug($slug, $type){
        if($type == 'salary'){
            $table = config('job_salary');
        }elseif($type == 'job_type'){
            $table = config('job_type');
        }elseif($type == 'job_category'){
            $table = config('tbl_category');
        }elseif($type == 'career_level'){
            $table = config('job_level');
        }elseif($type == 'experience'){
            $table = config('job_experience');
        }elseif($type == 'gender'){
            $table = config('job_gender');
        }elseif($type == 'industry'){
            $table = config('job_industry');
        }elseif($type == 'qualification'){
            $table = config('job_qualification');
        }

        $output = $this->jobs_m->get($table, array('slug'=>$slug));
        return $output['title'];
    }


    /**
     * employeee resume page according to job post
     */
    public function resume($id=null){
        if(!$this->user_details){
            redirect('/');
        }
        
        $this->ion_auth_model->set_hook('where','resume',$this->jobs_m,'getResumes',array($id));
        $applied = $this->jobs_m->select('users.*,'.config('auth_user_meta'). '.expected_salary,'.config('auth_user_meta').'.job_title,'.config('auth_user_meta').'.address')->get_by('users');

        $this->template->title('Candidates')
        ->set('class','page resumes')
        ->set_layout('layout-sidebar')
        ->set('menu','resume')
        ->set_breadcrumb('Resumes','')
        ->set('applied',$applied)
        ->build('resume');
    }

    /**
     *  function to get package of a job
     */
    public function getPackageSelected(){
        $id = $this->input->get('id');
        $job = $this->jobs_m->get(config('job'),array('id'=>$id));
        $package = $job['package'];
        $packages = array('0'=> 'newspaper_price','1'=> 'basic_price','2'=> 'extended_price', '3'=>'professional_price');
        $package = $packages[$package];
        echo $price = config($package);
        exit;
    }
}

 ?>