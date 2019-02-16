<?php

class Profile_m extends My_Model{
    function __construct()
    {
        parent::__construct();
    }

    public function getUserMeta(){
        $this->db->join(config('auth_user_meta'),config('auth_user_meta').'.user_id='.config('users').'.id');
    }


}

?>