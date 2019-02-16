<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 9/27/18
 * Time: 12:01 AM
 */

function post_url($url_title)
{

    return site_url('blog/' . $url_title);
}

function archive_url($url)
{
    return site_url('blog/archive/' . $url);
}

function category_url($url_name)
{
    return site_url('blog/category/' . $url_name);
}

function countComments($blog){
    $ci = &get_instance();
    $ci->config->load('comments/table');
    $ci->load->model('comments/article_comments_model','comments_m',true);
    return $ci->comments_m->count_by(config('tbl_comments'), array('post_id' => $id, 'status' => 1, 'modded' => 0));
}