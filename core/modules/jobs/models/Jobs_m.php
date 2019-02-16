<?php

class Jobs_m extends My_Model{
    function __construct()
    {
        parent::__construct();
    }

    public function activeList(){
        $this->db->where('status',1);
    }

    /** job search filter for search page */

    public function jobSearch($posted_data = array()){
        $order = 'desc';
        if(count($posted_data) > 0){
            $title = $posted_data['keyword'];
            $category = $posted_data['category'];
            $type = $posted_data['type'];
   
            if(!empty($posted_data['order'])){
                $order = $posted_data['order'];
            }

            $this->db
                ->join('users', 'users.id=' . config('job') . '.user_id')
                ->where(config('job') . '.status', 2)
                //->where(config('job') . '.deadline >=', strtotime(date('Y-m-d')))
                ->order_by(config('job') . '.package', 'desc')
                ->order_by(config('job') . '.date', $order);
            
            if(!empty($title)){
                $this->db->like(config('job') . '.title', $title);
            }
            if(!empty($category)){
                $this->db->where(config('job') . '.job_category', $category);
            }
            if(!empty($type)){
                $this->db->where(config('job').'.job_type', $type);
            }
                
           
        }else{
            $this->db
                ->join('users', 'users.id=' . config('job') . '.user_id')
                ->where(config('job') . '.status', 2)
                //->where(config('job') . '.deadline >=', strtotime(date('Y-m-d')))
                ->order_by(config('job') . '.package', 'desc')
                ->order_by(config('job') . '.date', $order);
        }
        
    }


    /** job type list for homepage where type is featured, hot or normal jobs */

    public function homeCategory($type){
        if ($type == 'featured') {
               $this->db
                    ->join('users','users.id='.config('job').'.user_id')
                    ->where(config('job').'.package',3)
                    ->where(config('job').'.status',2)
                    ->where(config('job').'.deadline >=', strtotime(date('Y-m-d')))
                    ->where(config('job').'.date >=',strtotime(date('Y-m-d H:i:s',strtotime('-'.config('professional').' days'))));
    
        } elseif ($type == 'hot') {
            $this->db
                ->join('users', 'users.id=' . config('job') . '.user_id')
                ->where(config('job') . '.package', 2)
                ->where(config('job') . '.status', 2)
                ->where(config('job') . '.deadline >=', strtotime(date('Y-m-d')))
                ->where(config('job') . '.date >=', strtotime(date('Y-m-d H:i:s', strtotime('-' . config('extended') . ' days'))));

        } elseif ($type == 'normal') {
            $this->db
                ->join('users', 'users.id=' . config('job') . '.user_id')
                ->where(config('job') . '.package', 1)
                ->where(config('job') . '.status', 2)
                ->where(config('job') . '.deadline >=', strtotime(date('Y-m-d')))
                ->where(config('job') . '.date >=', strtotime(date('Y-m-d H:i:s', strtotime('-' . config('basic') . ' days'))));

        }elseif($type == 'newspaper'){
            $this->db
                ->join('users', 'users.id=' . config('job') . '.user_id')
                ->where(config('job') . '.package', 0)
                ->where(config('job') . '.status', 2)
                ->where(config('job') . '.deadline >=', strtotime(date('Y-m-d')))
                ->where(config('job') . '.date >=', strtotime(date('Y-m-d H:i:s', strtotime('-' . config('newspaper') . ' days'))));
        }

        $this->db->order_by('date','desc')
        ->limit(6);
    }

    public function getCompleteJobDetail($id){
        if(is_numeric($id)):
            $this->db->join('users', 'users.id=' . config('job') . '.user_id')
                ->join(config('auth_user_meta'),config('auth_user_meta').'.user_id=users.id')
                ->where(config('job').'.id',$id)
                ->where(config('job').'.status',2);
                //->where(config('job').'.deadline >=', strtotime(Date('Y-m-d H:i:s')));
        else:

            //slug code
            $this->db->join('users', 'users.id=' . config('job') . '.user_id')
            ->join(config('auth_user_meta'), config('auth_user_meta') . '.user_id=users.id')
            ->where(config('job') . '.slug', $id)
            ->where(config('job') . '.status', 2);
                //->where(config('job').'.deadline >=', strtotime(Date('Y-m-d H:i:s')));
        endif;
    }

    /**
     * preview mode for single job post
     */
    public function getCompleteJobDetailPreview($id){
        if(is_numeric($id)):
            $this->db->join('users', 'users.id=' . config('job') . '.user_id')
                ->join(config('auth_user_meta'), config('auth_user_meta') . '.user_id=users.id')
                ->where(config('job') . '.id', $id);
                //->where(config('job') . '.status', 2)
                //->where(config('job') . '.deadline >=', strtotime(Date('Y-m-d H:i:s')));
        else:
            // slug operation
            $this->db->join('users', 'users.id=' . config('job') . '.user_id')
            ->join(config('auth_user_meta'), config('auth_user_meta') . '.user_id=users.id')
            ->where(config('job') . '.slug', $id);
            //->where(config('job') . '.status', 2)
            //->where(config('job') . '.deadline >=', strtotime(Date('Y-m-d H:i:s')));
        endif;
    }

    public function jobsApplied(){
        $this->db->join(config('job'),config('job').'.id='.config('job_apply').'.job_id')
        ->join('users','users.id='.config('job').'.user_id')
        ->where(config('job_apply').'.user_id',$this->session->userdata('user_id'));
    }

    /**
     * public function to get resumes of candidates applied to the job
     */
    public function getResumes($id){
        $this->db
        ->join(config('auth_user_meta'),config('auth_user_meta').'.user_id=users.id')
        ->join(config('job_apply'), 'users.id='.config('job_apply').'.user_id')
        ->where(config('job_apply').'.job_id',$id);
    }

    /**
     * join user
     */

    public function join_user(){
        $this->db
        ->join('users','users.id='.config('job').'.user_id');
        
    }
}

?>