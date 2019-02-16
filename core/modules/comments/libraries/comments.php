<?php

class Comments{
    var $ci;
    function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('comments/article_comments_model','comment_m',true);
    }

    public function countComments($id)
    {
        return $this->ci->comment_m->count_by(config('tbl_comments'), array('post_id' => $id, 'status' => 1, 'modded' => 0));
    }
}

?>