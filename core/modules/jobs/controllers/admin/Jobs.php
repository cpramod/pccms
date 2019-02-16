<?php

class Jobs extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('jobs_m');
    }

    function index(){

    }

    /**
     * function to post job
     */
    function post(){
        $specialism = $this->jobs_m->getAll(config('tbl_category'));
        $salary = $this->jobs_m->getAll(config('job_salary'));
        $career_level = $this->jobs_m->getAll(config('job_level'));
        $experience = $this->jobs_m->getAll(config('job_experience'));
        $gender = $this->jobs_m->getAll(config('job_gender'));
        $qualification = $this->jobs_m->getAll(config('job_qualification'));

        $this->template->title('Post Job')
        ->append_metadata(js('bootstrap-wizard/bootstrap.wizard.min.js'))
        ->append_metadata(js('components/wizard/form-wizard.min.js'))
        ->set('specialisms', $specialism)
        ->set('salaries', $salary)
        ->set('career_levels', $career_level)
        ->set('experiences', $experience)
        ->set('genders', $gender)
        ->set('qualifications', $qualification)
        ->build('admin/post');
    }

    /**
     * qualifications
     */
    public function qualification()
    {
        $data = array('qualifications' => $this->jobs_m->getAll(config('job_qualification')));
        $this->template->title('Qualifications')
            ->build('admin/qualification/index', $data);
    }


    public function qualification_add(){
        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $posted_data = $this->input->post();
            if (!empty($posted_data['slug'])) {
                $this->form_validation->set_rules('slug', 'Slug', 'trim|required|alpha_dash|is_unique[' . config('job_qualification') . '.slug]');
            }

            if ($this->form_validation->run() == true) {
                if (empty($posted_data['slug'])) {
                    $config = array('field' => 'slug', 'title' => $posted_data['title'], 'table' => config('job_qualification'));
                    $this->load->library('slug', $config);
                    $slug = $this->slug->create_slug($posted_data['title']);
                } else {
                    $slug = $posted_data['slug'];
                }

                $data = array('title' => $posted_data['title'], 'slug' => $slug, 'status' => $posted_data['status']);

                if ($this->jobs_m->insert(config('job_qualification'), $data)) {
                    message('success', 'Record added successfully');
                    redirect(current_url());
                } else {
                    message('error', 'Error adding record');
                }


            } else {
                message('error', validation_errors());
            }

        }
        $data = array();
        $this->template->title('Qualification')
            ->build('admin/qualification/add', $data);
    }


    public function qualification_edit($id){
        $data = $this->jobs_m->get(config('job_qualification'), array('id' => $id));
        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $posted_data = $this->input->post();
            if (!empty($posted_data['slug']) && ($data->slug != $posted_data['slug'])) {
                $this->form_validation->set_rules('slug', 'Slug', 'trim|required|alpha_dash|is_unique[' . config('job_qualification') . '.slug]');
            }


            if ($this->form_validation->run() == true) {
                if (empty($posted_data['slug']) && ($posted_data['slug'] != $data->slug)) {
                    $config = array('field' => 'slug', 'title' => $posted_data['title'], 'table' => config('job_qualification'));
                    $this->load->library('slug', $config);
                    $slug = $this->slug->create_slug($posted_data['title']);
                } else {
                    $slug = $posted_data['slug'];
                }

                $record = array('title' => $posted_data['title'], 'slug' => $slug, 'status' => $posted_data['status']);

                if ($this->jobs_m->update(config('job_qualification'), $record, array('id' => $id))) {
                    message('success', 'Record updated successfully');
                    redirect(current_url());
                } else {
                    message('error', 'Error updating record');
                }
            } else {
                message('error', validation_errors());
            }
        }
        $this->template->title('Edit Qualification')
            ->build('admin/qualification/edit', $data);
    }

    /**
     * gender
     */

    public function gender()
    {
        $data = array('genders' => $this->jobs_m->getAll(config('job_gender')));
        $this->template->title('Genders')
            ->build('admin/gender/index', $data);
    }

    public function gender_edit($id)
    {
        $data = $this->jobs_m->get(config('job_gender'), array('id' => $id));
        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $posted_data = $this->input->post();
            if (!empty($posted_data['slug']) && ($data->slug != $posted_data['slug'])) {
                $this->form_validation->set_rules('slug', 'Slug', 'trim|required|alpha_dash|is_unique[' . config('job_gender') . '.slug]');
            }


            if ($this->form_validation->run() == true) {
                if (empty($posted_data['slug']) && ($posted_data['slug'] != $data->slug)) {
                    $config = array('field' => 'slug', 'title' => $posted_data['title'], 'table' => config('job_gender'));
                    $this->load->library('slug', $config);
                    $slug = $this->slug->create_slug($posted_data['title']);
                } else {
                    $slug = $posted_data['slug'];
                }

                $record = array('title' => $posted_data['title'], 'slug' => $slug, 'status' => $posted_data['status']);

                if ($this->jobs_m->update(config('job_gender'), $record, array('id' => $id))) {
                    message('success', 'Record updated successfully');
                    redirect(current_url());
                } else {
                    message('error', 'Error updating record');
                }
            } else {
                message('error', validation_errors());
            }
        }
        $this->template->title('Edit Gender')
            ->build('admin/gender/edit', $data);
    }

    public function gender_add()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $posted_data = $this->input->post();
            if (!empty($posted_data['slug'])) {
                $this->form_validation->set_rules('slug', 'Slug', 'trim|required|alpha_dash|is_unique[' . config('job_gender') . '.slug]');
            }

            if ($this->form_validation->run() == true) {
                if (empty($posted_data['slug'])) {
                    $config = array('field' => 'slug', 'title' => $posted_data['title'], 'table' => config('job_gender'));
                    $this->load->library('slug', $config);
                    $slug = $this->slug->create_slug($posted_data['title']);
                } else {
                    $slug = $posted_data['slug'];
                }

                $data = array('title' => $posted_data['title'], 'slug' => $slug, 'status' => $posted_data['status']);

                if ($this->jobs_m->insert(config('job_gender'), $data)) {
                    message('success', 'Record added successfully');
                    redirect(current_url());
                } else {
                    message('error', 'Error adding record');
                }


            } else {
                message('error', validation_errors());
            }

        }
        $data = array();
        $this->template->title('Gender')
            ->build('admin/gender/add', $data);
    }


    /**
     * function for Experience
     */

    public function experience()
    {
        $data = array('experiences' => $this->jobs_m->getAll(config('job_experience')));
        $this->template->title('Job Experience')
            ->build('admin/experience/index', $data);
    }

    public function experience_edit($id)
    {
        $data = $this->jobs_m->get(config('job_experience'), array('id' => $id));
        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $posted_data = $this->input->post();
            if (!empty($posted_data['slug']) && ($data->slug != $posted_data['slug'])) {
                $this->form_validation->set_rules('slug', 'Slug', 'trim|required|alpha_dash|is_unique[' . config('job_experience') . '.slug]');
            }


            if ($this->form_validation->run() == true) {
                if (empty($posted_data['slug']) && ($posted_data['slug'] != $data->slug)) {
                    $config = array('field' => 'slug', 'title' => $posted_data['title'], 'table' => config('job_experience'));
                    $this->load->library('slug', $config);
                    $slug = $this->slug->create_slug($posted_data['title']);
                } else {
                    $slug = $posted_data['slug'];
                }

                $record = array('title' => $posted_data['title'], 'slug' => $slug, 'status' => $posted_data['status']);

                if ($this->jobs_m->update(config('job_experience'), $record, array('id' => $id))) {
                    message('success', 'Record updated successfully');
                    redirect(current_url());
                } else {
                    message('error', 'Error updating record');
                }
            } else {
                message('error', validation_errors());
            }
        }
        $this->template->title('Edit Experience')
            ->build('admin/experience/edit', $data);
    }

    public function experience_add()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $posted_data = $this->input->post();
            if (!empty($posted_data['slug'])) {
                $this->form_validation->set_rules('slug', 'Slug', 'trim|required|alpha_dash|is_unique[' . config('job_experience') . '.slug]');
            }

            if ($this->form_validation->run() == true) {
                if (empty($posted_data['slug'])) {
                    $config = array('field' => 'slug', 'title' => $posted_data['title'], 'table' => config('job_experience'));
                    $this->load->library('slug', $config);
                    $slug = $this->slug->create_slug($posted_data['title']);
                } else {
                    $slug = $posted_data['slug'];
                }

                $data = array('title' => $posted_data['title'], 'slug' => $slug, 'status' => $posted_data['status']);

                if ($this->jobs_m->insert(config('job_experience'), $data)) {
                    message('success', 'Record added successfully');
                    redirect(current_url());
                } else {
                    message('error', 'Error adding record');
                }


            } else {
                message('error', validation_errors());
            }

        }
        $data = array();
        $this->template->title('Job Experience')
            ->build('admin/experience/add', $data);
    }

    /**
     * function for career level
     */

    public function level()
    {
        $data = array('salaries' => $this->jobs_m->getAll(config('job_level')));
        $this->template->title('Career Level')
            ->build('admin/level/index', $data);
    }

    public function level_edit($id)
    {
        $data = $this->jobs_m->get(config('job_level'), array('id' => $id));
        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $posted_data = $this->input->post();
            if (!empty($posted_data['slug']) && ($data->slug != $posted_data['slug'])) {
                $this->form_validation->set_rules('slug', 'Slug', 'trim|required|alpha_dash|is_unique[' . config('job_level') . '.slug]');
            }


            if ($this->form_validation->run() == true) {
                if (empty($posted_data['slug']) && ($posted_data['slug'] != $data->slug)) {
                    $config = array('field' => 'slug', 'title' => $posted_data['title'], 'table' => config('job_level'));
                    $this->load->library('slug', $config);
                    $slug = $this->slug->create_slug($posted_data['title']);
                } else {
                    $slug = $posted_data['slug'];
                }

                $record = array('title' => $posted_data['title'], 'slug' => $slug, 'status' => $posted_data['status']);

                if ($this->jobs_m->update(config('job_level'), $record, array('id' => $id))) {
                    message('success', 'Record updated successfully');
                    redirect(current_url());
                } else {
                    message('error', 'Error updating record');
                }
            } else {
                message('error', validation_errors());
            }
        }
        $this->template->title('Edit Career Level')
            ->build('admin/level/edit', $data);
    }

    public function level_add()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $posted_data = $this->input->post();
            if (!empty($posted_data['slug'])) {
                $this->form_validation->set_rules('slug', 'Slug', 'trim|required|alpha_dash|is_unique[' . config('job_level') . '.slug]');
            }

            if ($this->form_validation->run() == true) {
                if (empty($posted_data['slug'])) {
                    $config = array('field' => 'slug', 'title' => $posted_data['title'], 'table' => config('job_level'));
                    $this->load->library('slug', $config);
                    $slug = $this->slug->create_slug($posted_data['title']);
                } else {
                    $slug = $posted_data['slug'];
                }

                $data = array('title' => $posted_data['title'], 'slug' => $slug, 'status' => $posted_data['status']);

                if ($this->jobs_m->insert(config('job_level'), $data)) {
                    message('success', 'Record added successfully');
                    redirect(current_url());
                } else {
                    message('error', 'Error adding record');
                }


            } else {
                message('error', validation_errors());
            }

        }
        $data = array();
        $this->template->title('Career Level')
            ->build('admin/level/add', $data);
    }

    public function salary(){
        $data = array('salaries' => $this->jobs_m->getAll(config('job_salary')));
        $this->template->title('Job Salary')
            ->build('admin/salary/index', $data);
    }

    public function salary_edit($id){
        $data = $this->jobs_m->get(config('job_salary'), array('id' => $id));
        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $posted_data = $this->input->post();
            $build_slug = false;
            if (!empty($posted_data['slug']) && ($data->slug != $posted_data['slug']) ) {
                $this->form_validation->set_rules('slug', 'Slug', 'trim|required|alpha_dash|is_unique[' . config('job_salary') . '.slug]');
            }elseif(empty($posted_data['slug'])){
                $build_slug = true;
            }


            if ($this->form_validation->run() == true) {
                if ($build_slug==false) {
                    $slug = $posted_data['slug'];
                } else {
                    $config = array('field' => 'slug', 'title' => $posted_data['title'], 'table' => config('job_salary'));
                    $this->load->library('slug', $config);
                    $slug = $this->slug->create_slug($posted_data['title']);
                }

                $record = array('title' => $posted_data['title'], 'slug' => $slug, 'status' => $posted_data['status']);

                if ($this->jobs_m->update(config('job_salary'), $record, array('id' => $id))) {
                    message('success', 'Record updated successfully');
                    redirect(current_url());
                } else {
                    message('error', 'Error updating record');
                }
            } else {
                message('error', validation_errors());
            }
        }
        $this->template->title('Edit Job Salary')
            ->build('admin/salary/edit', $data);
    }

    public function salary_add(){
        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $posted_data = $this->input->post();
            if (!empty($posted_data['slug'])) {
                $this->form_validation->set_rules('slug', 'Slug', 'trim|required|alpha_dash|is_unique[' . config('job_salary') . '.slug]');
            }

            if ($this->form_validation->run() == true) {
                if (empty($posted_data['slug'])) {
                    $config = array('field' => 'slug', 'title' => $posted_data['title'], 'table' => config('job_salary'));
                    $this->load->library('slug', $config);
                    $slug = $this->slug->create_slug($posted_data['title']);
                } else {
                    $slug = $posted_data['slug'];
                }

                $data = array('title' => $posted_data['title'], 'slug' => $slug, 'status' => $posted_data['status']);

                if ($this->jobs_m->insert(config('job_salary'), $data)) {
                    message('success', 'Record added successfully');
                    redirect(current_url());
                } else {
                    message('error', 'Error adding record');
                }


            } else {
                message('error', validation_errors());
            }

        }
        $data = array();
        $this->template->title('Job Salary')
            ->build('admin/salary/add', $data);
    }



    /*** age development for admin */

    public function age()
    {
        $data = array('ages' => $this->jobs_m->getAll(config('job_age')));
        $this->template->title('Age')
            ->build('admin/age/index', $data);
    }

    public function age_edit($id)
    {
        $data = $this->jobs_m->get(config('job_age'), array('id' => $id));
        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $posted_data = $this->input->post();
            $build_slug = false;
            if (!empty($posted_data['slug']) && ($data->slug != $posted_data['slug'])) {
                $this->form_validation->set_rules('slug', 'Slug', 'trim|required|alpha_dash|is_unique[' . config('job_salary') . '.slug]');
            } elseif (empty($posted_data['slug'])) {
                $build_slug = true;
            }


            if ($this->form_validation->run() == true) {
                if ($build_slug == false) {
                    $slug = $posted_data['slug'];
                } else {
                    $config = array('field' => 'slug', 'title' => $posted_data['title'], 'table' => config('job_salary'));
                    $this->load->library('slug', $config);
                    $slug = $this->slug->create_slug($posted_data['title']);
                }

                $record = array('title' => $posted_data['title'], 'slug' => $slug, 'status' => $posted_data['status']);

                if ($this->jobs_m->update(config('job_age'), $record, array('id' => $id))) {
                    message('success', 'Record updated successfully');
                    redirect(current_url());
                } else {
                    message('error', 'Error updating record');
                }
            } else {
                message('error', validation_errors());
            }
        }
        $this->template->title('Edit Job Salary')
            ->build('admin/age/edit', $data);
    }

    public function age_add()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $posted_data = $this->input->post();
            if (!empty($posted_data['slug'])) {
                $this->form_validation->set_rules('slug', 'Slug', 'trim|required|alpha_dash|is_unique[' . config('job_salary') . '.slug]');
            }

            if ($this->form_validation->run() == true) {
                if (empty($posted_data['slug'])) {
                    $config = array('field' => 'slug', 'title' => $posted_data['title'], 'table' => config('job_salary'));
                    $this->load->library('slug', $config);
                    $slug = $this->slug->create_slug($posted_data['title']);
                } else {
                    $slug = $posted_data['slug'];
                }

                $data = array('title' => $posted_data['title'], 'slug' => $slug, 'status' => $posted_data['status']);

                if ($this->jobs_m->insert(config('job_age'), $data)) {
                    message('success', 'Record added successfully');
                    redirect(current_url());
                } else {
                    message('error', 'Error adding record');
                }


            } else {
                message('error', validation_errors());
            }

        }
        $data = array();
        $this->template->title('Age')
            ->build('admin/age/add', $data);
    }


    public function category(){
        $data = array('categories'=>$this->jobs_m->getAll(config('tbl_category')));
        $this->template->title('Job Category')
        ->build('admin/category',$data);
    }

    public function category_add(){
        if($this->input->post()){
            $this->form_validation->set_rules('title','Title','trim|required');
            $posted_data = $this->input->post();
            if(!empty($posted_data['slug'])){
                $this->form_validation->set_rules('slug', 'Slug', 'trim|required|alpha_dash|is_unique['.config('tbl_category').'.slug]');
            }
            $this->form_validation->set_rules('description','Description','trim');
            if($this->form_validation->run()==true){
                if(empty($posted_data['slug'])){
                    $config=array('field'=>'slug','title'=>$posted_data['title'],'table'=>config('tbl_category'));
                    $this->load->library('slug',$config);
                    $slug = $this->slug->create_slug($posted_data['title']);
                }else{
                    $slug = $posted_data['slug'];
                }

                $data = array('title'=>$posted_data['title'],'slug'=>$slug,'description'=>$posted_data['description'],'icon'=>$posted_data['icon']);

                if($this->jobs_m->insert(config('tbl_category'),$data)){
                    message('success','Record added successfully');
                    redirect(current_url());
                }else{
                    message('error','Error adding record');
                }
                

            }else{
                message('error',validation_errors());
            }
            
        }
        $data = array();
        $this->template->title('Job Category')
            ->build('admin/category/add', $data);
    }

    function category_edit($id){
        $data = $this->jobs_m->get(config('tbl_category'),array('id'=>$id));
        if($this->input->post()){
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $posted_data = $this->input->post();
            if (!empty($posted_data['slug']) && ($data->slug != $posted_data['slug'])) {
                $this->form_validation->set_rules('slug', 'Slug', 'trim|required|alpha_dash|is_unique[' . config('tbl_category') . '.slug]');
            }

            $this->form_validation->set_rules('description', 'Description', 'trim');
            if ($this->form_validation->run() == true) {
                if (empty($posted_data['slug']) && ($posted_data['slug']!= $data->slug)) {
                    $config = array('field' => 'slug', 'title' => $posted_data['title'], 'table' => config('tbl_category'));
                    $this->load->library('slug', $config);
                    $slug = $this->slug->create_slug($posted_data['title']);
                } else {
                    $slug = $posted_data['slug'];
                }

                $record = array('title' => $posted_data['title'], 'slug' => $slug, 'description' => $posted_data['description'],'icon'=>$posted_data['icon']);

                if ($this->jobs_m->update(config('tbl_category'), $record,array('id'=>$id))) {
                    message('success', 'Record updated successfully');
                    redirect(current_url());
                } else {
                    message('error', 'Error updating record');
                }
            } else {
                message('error', validation_errors());
            }
        }
        $this->template->title('Edit Job Category')
        ->build('admin/category/edit',$data);
    }

    /**
     * function to delete category
     */

     public function category_delete($id){
         if($id){
            if($this->jobs_m->delete(config('tbl_category'),array('id'=>$id))){
                message('success','Record deleted successfully');
            }else{
                message('error','Error deleting record');
            }
            redirect('admin/jobs/category');
         }
         else{
             show_404();
         }

         
     }
}

?>