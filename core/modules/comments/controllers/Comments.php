<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 9/19/18
 * Time: 11:55 PM
 */

class Comments extends Front_Controller{
    function __construct()
    {
        parent::__construct();
        $this->config->load('comments/table');
        $this->load->model('article_comments_model','comment_m',true);
    }

    /**
     * function to count number of comments by id
     */
    public function countComments($id)
    {
        return $this->comment_m->count_by(config('tbl_comments'), array('post_id' => $id, 'status' => 1, 'modded' => 0));
    }


}