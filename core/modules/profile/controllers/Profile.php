<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 8/17/18
 * Time: 4:57 PM
 */

class Profile extends Front_Controller{
    function __construct()
    {
        parent::__construct();
        $this->data=array();
        $this->template->set_layout('layout-sidebar');
        $this->load->model('jobs/jobs_m','jobs_m',true);
        $this->load->model('profile_m');
    }

    function index(){
        if(!$this->ion_auth->logged_in()){
            redirect('/');
        }

        if($this->groups['id']==3){
            $this->employer_profile();
        }elseif($this->groups['id'] == 1){
            $this->employer_profile();
        }
        elseif($this->groups['id'] == 2){

            //select title and slug
            $this->ion_auth_model->set_hook('where', 'experience_where', $this->jobs_m, 'activeList', array());
            $experiences = $this->jobs_m->select('slug, title')->getAll(config('job_experience'));
            $qualifications = $this->jobs_m->select('slug, title')->getAll(config('job_qualification'));
            $salaries = $this->jobs_m->select('slug, title')->getAll(config('job_salary'));
            $ages = $this->jobs_m->select('slug, title')->getAll(config('job_age'));
            $language = $this->jobs_m->select('slug, title')->getAll(config('job_language'));
            $this->ion_auth_model->remove_hook('where', 'experience_where');
            $specialisms = $this->jobs_m->select('slug, title')->getAll(config('tbl_category'));


            $this->data = (array)$this->ion_auth_model->user()->row();
            $user_id = $this->data['id'];
        
        //user meta data
            $meta = $this->profile_m
                ->select('job_category,website,address,job_title,city,experience,age,current_salary,expected_salary,language,qualification,latitude,longitude')
                ->get(config('auth_user_meta'), array('user_id' => $user_id));

            if (is_array($meta)) {
                $this->data = array_merge($this->data, $meta);
            }


            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->template->title($this->data['first_name'] . ' ' . $this->data['last_name'])
                ->set('experiences', $experiences)
                ->set('qualifications', $qualifications)
                ->set('salaries', $salaries)
                //->set('skills', $skills)
                ->set('specialisms', $specialisms)
                ->set('ages', $ages)
                ->set('languages', $language)
                ->set('class', 'page profile')
                ->set('menu', 'profile')
                ->append_metadata(js('jquery.cropit.js'))
                ->append_metadata(js('cropitProcess.js'))
                ->append_metadata('<link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.0/mapsjs-ui.css?dp-version=1533195059" />')
                ->append_metadata('<script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-core.js"></script>')
                ->append_metadata('<script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-service.js"></script>')
                ->append_metadata('<script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-ui.js"></script>')
                ->append_metadata('<script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-mapevents.js"></script>')
                ->set('app_id', $this->config->item('app_id'))
                ->set('app_code', $this->config->item('app_key'))
                ->set_breadcrumb('Profile', '')
                ->build('profile', $this->data);

        }
        
    }


    public function searchLocation()
    {
        $phrase = $this->input->get('term');
        $phrase = rawurlencode($phrase);
        $app_id = $this->config->item('app_id');
        $app_key = $this->config->item('app_key');
        $url = "https://places.cit.api.here.com/places/v1/autosuggest?";
        $url.= "size=10";
        $url.= "&tf=plain";
        $url.= "&q=".$phrase;
        //$url.= "&in=80.0884245137,26.3978980576,88.1748043151,30.4227169866";
        $url.= "&at=27.6790051,83.4549952";
        $url.= "&app_id=".$app_id;
        $url.= "&app_code=".$app_key;
        $url.= "&addressFilter=countryCode=NP";
        //$url.= "&cs=places";
        $url.= "&result_types=address";
        $url.= "&pretty";
        
        //$url = "https://places.cit.api.here.com/places/v1/autosuggest?at=83.3484,27.6407&q=".$phrase."&X-Political-View=NPL&app_id=".$app_id."&app_code=".$app_key. "&country=NPL&result_types=place";
        //$url = "https://places.api.here.com/places/v1/autosuggest?X-Map-Viewport=83.3484,27.6407,83.9980,27.7495&X-Political-View=NPL&app_code='.$app_key.'&app_id='.$app_id.'&q=bardghat&result_types=address,place,category,chain&size=5&withExperiments=PBAPI_3292_autosuggest_cuisines%3Dtrue";
        //$url = 'http://autocomplete.geocoder.api.here.com/6.2/suggest.json?app_id=' . $app_id . '&app_code=' . $app_key . '&country=NPL&query=' . $phrase;
        
        
        $json = file_get_contents($url);
        $json = json_decode($json);

        $output = array();
        foreach($json->results as $jsn){
            $vicinity = str_replace('<br/>',', ',$jsn->vicinity);
            
            $output[] = array(
                'label' =>$jsn->title.', '.$vicinity,
                'value'=> $jsn->title . ', ' . $vicinity,
                'position'=>$jsn->position
            );
        }

        
        echo json_encode($output);
        exit;
    }

    public function getLocationData($address)
    {
        $phrase = rawurlencode($address);
        $app_id = $this->config->item('app_id');
        $app_key = $this->config->item('app_key');
        $url = 'https://geocoder.api.here.com/6.2/geocode.json?app_id=' . $app_id . '&app_code=' . $app_key . '&searchtext=' . $phrase;
        $json = file_get_contents($url);
        $json = json_decode($json);
        return $json->Response->View[0]->Result;
        //echo $json = json_encode($json->suggestions);
        exit;
    }

    

    /** employer profile */
    function employer_profile(){
        $designation = $this->jobs_m->select('slug, title')->getAll(config('user_designation'));
        $business_type = $this->jobs_m->select('slug, title')->getAll(config('user_business_type'));
        $this->ion_auth_model->remove_hook('where', 'experience_where');
        $specialisms = $this->jobs_m->select('slug, title')->getAll(config('tbl_category'));
        $this->data = (array)$this->ion_auth_model->user()->row();
        $user_id = $this->data['id'];

        //user meta data
        $meta = $this->profile_m
            ->select('job_category,website,address,city,ownership,team_size,contact_designation,contact_phone,job_category,est,latitude,longitude')
            ->get(config('auth_user_meta'), array('user_id' => $user_id));

        if (is_array($meta)) {
            $this->data = array_merge($this->data, $meta);
        }

        $this->data['csrf'] = $this->_get_csrf_nonce();
        $this->template->title('Welcome '.$this->data['company'] )
            ->set('specialisms', $specialisms)
            ->set('designations', $designation)
            ->set('business_types', $business_type)
            ->set('class', 'page company-profile')
            ->set('menu', 'profile')
            ->append_metadata(js('jquery.cropit.js'))
            ->append_metadata(js('cropitProcess.js'))
            ->set_breadcrumb('Profile', '')
            ->build('employer/profile', $this->data);   
    }

    /**
     * resume page
     */

    function education($action, $id){
        if ($action == 'edit') {

            if ($this->input->post()) {
                $this->form_validation->set_rules('title', 'Title', 'required');
                $this->form_validation->set_rules('from_date', 'From Date', 'required');
                $this->form_validation->set_rules('institute', 'Institute', 'required');
                $this->form_validation->set_rules('description', 'Description', 'trim');

                if ($this->form_validation->run() == false) {
                    message('error', validation_errors());
                    redirect('profile/resume');
                } else {
                    $posted_data = array(
                        'title' => $this->input->post('title'),
                        'from_date' => $this->input->post('from_date'),
                        'to_date' => $this->input->post('to_date'),
                        'institute' => $this->input->post('institute'),
                        'description' => $this->input->post('description')
                    );

                    if ($this->profile_m->update(config('user_resume'), $posted_data, array('id' => $id))) {
                        message('success', 'Record added successfully');
                        redirect('profile/resume');
                    }
                }

            }


        } elseif ($action == 'delete') {
            if ($this->profile_m->delete(config('user_resume'), array('id' => $id))) {
                message('success', 'Record deleted successfully');
                redirect('profile/resume');
            }
        } elseif ($action == 'add') {

            if ($this->input->post()) {
                $this->form_validation->set_rules('title', 'Title', 'required');
                $this->form_validation->set_rules('from_date', 'From Date', 'required');
                $this->form_validation->set_rules('institute', 'Institute', 'required');
                $this->form_validation->set_rules('description', 'Description', 'trim');

                if ($this->form_validation->run() == false) {
                    message('error', validation_errors());
                    redirect('profile/resume');
                } else {
                    $posted_data = array(
                        'title' => $this->input->post('title'),
                        'from_date' => $this->input->post('from_date'),
                        'to_date' => $this->input->post('to_date'),
                        'institute' => $this->input->post('institute'),
                        'description' => $this->input->post('description'),
                        'user_id' => $this->session->userdata('user_id')
                    );

                    if ($this->profile_m->insert(config('user_resume'), $posted_data)) {
                        message('success', 'Record added successfully');
                        redirect('profile/resume');
                    }
                }

            }

        } else {
            if ($this->input->is_ajax_request()) {
                $response = $this->profile_m->get(config('user_resume'), array('id' => $id));
                echo json_encode($response);
                exit;
            }
        }
    }

    /**
     * qualification section
     */

    function experience($action, $id)
    {

        if ($action == 'edit') {

            if ($this->input->post()) {
                $this->form_validation->set_rules('title', 'Title', 'required');
                $this->form_validation->set_rules('from_date', 'From Date', 'required');
                $this->form_validation->set_rules('company', 'Company', 'required');
                $this->form_validation->set_rules('description', 'Description', 'trim');

                if ($this->form_validation->run() == false) {
                    message('error', validation_errors());
                    redirect('profile/resume');
                } else {

                    
                    $posted_data = array(
                        'title' => $this->input->post('title'),
                        'from_date' => $this->input->post('from_date'),
                        'to_date' => $this->input->post('to_date'),
                        'company' => $this->input->post('company'),
                        'present' => $this->input->post('present')?$this->input->post():0,
                        'description' => $this->input->post('description')

                    );

                    if ($this->profile_m->update(config('user_experience'), $posted_data, array('id' => $id))) {
                        message('success', 'Record added successfully');
                        redirect('profile/resume');
                    }
                }

            }


        } elseif ($action == 'delete') {
            if ($this->profile_m->delete(config('user_experience'), array('id' => $id))) {
                message('success', 'Record deleted successfully');
                redirect('profile/resume');
            }
        } elseif ($action == 'add') {

            if ($this->input->post()) {
                $this->form_validation->set_rules('title', 'Title', 'required');
                $this->form_validation->set_rules('from_date', 'From Date', 'required');
                $this->form_validation->set_rules('company', 'Company', 'required');
                $this->form_validation->set_rules('description', 'Description', 'trim');

                if ($this->form_validation->run() == false) {
                    message('error', validation_errors());
                    redirect('profile/resume');
                } else {
                    $posted_data = array(
                        'title' => $this->input->post('title'),
                        'from_date' => $this->input->post('from_date'),
                        'to_date' => $this->input->post('to_date'),
                        'company' => $this->input->post('company'),
                        'present' => $this->input->post('present') ? $this->input->post() : 0,
                        'description' => $this->input->post('description'),
                        'user_id' => $this->session->userdata('user_id')
                    );

                    if ($this->profile_m->insert(config('user_experience'), $posted_data)) {
                        message('success', 'Record added successfully');
                        redirect('profile/resume');
                    }
                }

            }

        } else {
            if ($this->input->is_ajax_request()) {
                $response = $this->profile_m->get(config('user_experience'), array('id' => $id));
                echo json_encode($response);
                exit;
            }
        }
    }


    /**
     * awards
     */
    function awards($action, $id)
    {

        if ($action == 'edit') {

            if ($this->input->post()) {
                $this->form_validation->set_rules('title', 'Title', 'required');
                $this->form_validation->set_rules('date', 'Date', 'required');
                $this->form_validation->set_rules('description', 'Description', 'trim');

                if ($this->form_validation->run() == false) {
                    message('error', validation_errors());
                    redirect('profile/resume');
                } else {


                    $posted_data = array(
                        'title' => $this->input->post('title'),
                        'date' => $this->input->post('date'),
                        'description' => $this->input->post('description')

                    );

                    if ($this->profile_m->update(config('user_awards'), $posted_data, array('id' => $id))) {
                        message('success', 'Record added successfully');
                        redirect('profile/resume');
                    }
                }

            }


        } elseif ($action == 'delete') {
            if ($this->profile_m->delete(config('user_awards'), array('id' => $id))) {
                message('success', 'Record deleted successfully');
                redirect('profile/resume');
            }
        } elseif ($action == 'add') {

            if ($this->input->post()) {
                $this->form_validation->set_rules('title', 'Title', 'required');
                $this->form_validation->set_rules('date', 'From Date', 'required');
                $this->form_validation->set_rules('description', 'Description', 'trim');

                if ($this->form_validation->run() == false) {
                    message('error', validation_errors());
                    redirect('profile/resume');
                } else {
                    $posted_data = array(
                        'title' => $this->input->post('title'),
                        'date' => $this->input->post('date'),
                        'description' => $this->input->post('description'),
                        'user_id' => $this->session->userdata('user_id')
                    );

                    if ($this->profile_m->insert(config('user_awards'), $posted_data)) {
                        message('success', 'Record added successfully');
                        redirect('profile/resume');
                    }
                }

            }

        } else {
            if ($this->input->is_ajax_request()) {
                $response = $this->profile_m->get(config('user_awards'), array('id' => $id));
                echo json_encode($response);
                exit;
            }
        }
    }

    /**
     * skills
     */
    function skills($action, $id)
    {

        if ($action == 'edit') {

            if ($this->input->post()) {
                $this->form_validation->set_rules('title', 'Skill Title', 'required');
                $this->form_validation->set_rules('rate', 'Rate', 'required');
                
                if ($this->form_validation->run() == false) {
                    message('error', validation_errors());
                    redirect('profile/resume');
                } else {


                    $posted_data = array(
                        'title' => $this->input->post('title'),
                        'rate' => $this->input->post('rate')
                    );

                    if ($this->profile_m->update(config('user_skills'), $posted_data, array('id' => $id))) {
                        message('success', 'Record updated successfully');
                        redirect('profile/resume');
                    }
                }

            }


        } elseif ($action == 'delete') {
            if ($this->profile_m->delete(config('user_skills'), array('id' => $id))) {
                message('success', 'Record deleted successfully');
                redirect('profile/resume');
            }
        } elseif ($action == 'add') {

            if ($this->input->post()) {
                $this->form_validation->set_rules('title', 'Skill Title', 'required');
                $this->form_validation->set_rules('rate', 'Rate', 'required|integer');
                
                if ($this->form_validation->run() == false) {
                    message('error', validation_errors());
                    redirect('profile/resume');
                } else {
                    $posted_data = array(
                        'title' => $this->input->post('title'),
                        'rate' => $this->input->post('rate'),
                        'user_id' => $this->session->userdata('user_id')
                    );

                    if ($this->profile_m->insert(config('user_skills'), $posted_data)) {
                        message('success', 'Record added successfully');
                        redirect('profile/resume');
                    }
                }

            }

        } else {
            if ($this->input->is_ajax_request()) {
                $response = $this->profile_m->get(config('user_skills'), array('id' => $id));
                echo json_encode($response);
                exit;
            }
        }
    }


    public function resume($section='', $action='', $id=''){
            
        /**
         * education
         */
        if($section == 'education'){
            $this->education($action, $id);
            $menu = "resume";
        }elseif($section == 'experience'){
            $this->experience($action, $id);
            $menu = 'experience';
        }elseif($section == 'awards'){
            $this->awards($action, $id);
            $menu = "awards";
        }elseif($section == 'skills'){
            $this->skills($action, $id);
            $menu = "skills";
        }
        
        
        $data=array();
        $education = $this->profile_m->get_by(config('user_resume'),array('user_id'=>$this->session->userdata('user_id')));
        $experience = $this->profile_m->get_by(config('user_experience'), array('user_id' => $this->session->userdata('user_id')));
        $awards = $this->profile_m->get_by(config('user_awards'), array('user_id' => $this->session->userdata('user_id')));
        $skills = $this->profile_m->get_by(config('user_skills'), array('user_id' => $this->session->userdata('user_id')));
        $this->template->title('My Resume')
        ->set('class','page resume')
        ->set_breadcrumb('My Resume','')
        ->set('educations', $education)
        ->set ('experiences', $experience)
        ->set('awards', $awards)
        ->set('skills', $skills)
        ->set('menu', $menu?$menu: 'resume')
        ->build('resume', $data);
    }

    public function coverletter(){
        if($this->input->post()){
            $posted=$this->input->post();
            if(isset($posted['id'])){
                if($_FILES['file']['name']){
                    $response = $this->mupload->do_upload();
                    if ($response['status'] == 1) {
                        $cv = $response['gallery_id'];
                        $posted_data['cv'] = $cv;
                    } else {
                        message('error', $response['message']);
                        redirect('profile/coverletter');
                    }
                }

                $cover_letter = $this->input->post('cover_letter');
                $posted_data['cover_letter'] = $cover_letter;
                if($this->profile_m->update(config('user_cv'),$posted_data,array('id'=>$posted['id']))){
                    message('success','Record updated successfully');
                }else{
                    message('error','Error updating record');
                }
                redirect('profile/coverletter');
            }else{
                if (empty($_FILES['file']['name'])) {
                    $this->form_validation->set_rules('file', 'CV', 'required');
                }

                $this->form_validation->set_rules('cover_letter', 'Cover Letter', 'trim');

                if ($this->form_validation->run() == false) {
                    message('error', validation_errors());
                    redirect('profile/coverletter');
                } else {
                    $response = $this->mupload->do_upload();
                    if ($response['status'] == 1) {
                        $cv = $response['gallery_id'];
                    } else {
                        message('error', $response['message']);
                        redirect('profile/coverletter');
                    }

                    $cover_letter = $this->input->post('cover_letter');

                    $posted_data = array(
                        'cv' => $cv,
                        'cover_letter' => $cover_letter,
                        'user_id' => $this->session->userdata('user_id')
                    );

                    if ($this->profile_m->insert(config('user_cv'), $posted_data)) {
                        message('success', 'Record Added successfully');
                    } else {
                        message('error', 'Error adding data');
                    }

                    redirect('profile/coverletter');

                }
            }
            
        }

        $data = $this->profile_m->get(config('user_cv'),array('user_id'=>$this->session->userdata('user_id')));

        $this->template->title('Cover Letter')
            ->set('class', 'page cv')
            ->set_breadcrumb('Profile', site_url('profile'))
            ->set_breadcrumb('CV & Cover Letter', '')
            ->set('menu','coverletter')
            ->build('cv', $data);
    }

    public function change_password(){
        $data['csrf'] = $this->_get_csrf_nonce();
        $this->template->title('Change Password')
            ->set('class','page')
            ->set('menu','change_password')
            ->set_breadcrumb('Profile',site_url('profile'))
            ->set_breadcrumb('Change Password','')
            ->build('change_password', $data);
    }

    public function getLocationCo($address){
        $address=$this->getLocationData($address);
        $latitude = $address[0]->Location->DisplayPosition->Latitude;
        $longitude = $address[0]->Location->DisplayPosition->Longitude;
        return array('lat'=>$latitude,'lng'=>$longitude);
    }

    function employer($id){
        if(!$id){
            show_404();
            exit;
        }
        // if($this->ion_auth->logged_in()){
        //     show_404();
        //     exit;
        // }
        
        $data = (array)$this->ion_auth_model->user($id)->row();
        $meta = $this->profile_m->get(config('user_meta'), array('user_id' => $data['id']));
        
        $coordinate = $this->getLocationCo($meta['address']);
        $this->template->title($data['user']['company'])
            ->set_layout('home')
            ->append_metadata('<link rel="canonical" href="'.site_url('profile/employer/'.$id).'" />')
            ->set('class','page employer')
            ->set('meta', $meta)
            ->set('coordinate', $coordinate)
            ->append_metadata('<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>')
            ->append_metadata('<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
   integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>')
   ->append_metadata(js('leaflet-providers.js'))
            ->build('profileDetail',$data);
    }

    public function candidate($id){
        if(!$id){
            show_404();
            exit;
        }

        if(!$this->ion_auth->logged_in()){
            show_404();
            exit;
        }

        $data = (array)$this->ion_auth_model->user($id)->row();
        $meta = $this->profile_m->get(config('user_meta'),array('user_id'=>$data['id']));
        $education = $this->profile_m->get_by(config('user_resume'),array('user_id'=>$data['id']));
        $experience = $this->profile_m->get_by(config('user_experience'), array('user_id' => $data['id']));
        $award = $this->profile_m->get_by(config('user_awards'), array('user_id' => $data['id']));
        $skills = $this->profile_m->get_by(config('user_skills'), array('user_id' =>$data['id']));
        $cv = $this->profile_m->get_by(config('user_cv'),array('user_id'=>$data['id']));

        $this->template->title($data['first_name'].' '.$data['last_name'])
        ->set_layout('home')
        ->append_metadata('<link rel="canonical" href="'.site_url('profile/candidate/'.$id).'" />')
        ->set('class','page candidate-view')
        ->set_breadcrumb('Candidate','')
        ->set('meta',$meta)
        ->set('educations', $education)
        ->set('experiences', $experience)
        ->set('awards', $award)
        ->set('skills',$skills)
        ->set('cv', $cv)
        ->build('candidate', $data);
    }

    

    public function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key   = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

}