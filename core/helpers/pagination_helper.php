<?php
if(!function_exists('pagination')){
    function pagination($base_url, $total){
        $ci = &get_instance();
        $ci->load->library('pagination');

        $config['base_url'] = $base_url;
        $config['total_rows'] = $total;
        $config['per_page'] = config('per_page');
        $config['full_tag_open'] = config('full_tag_open');
        $config['full_tag_close'] = config('full_tag_close');
        $config['cur_tag_open'] = config('cur_tag_open');
        $config['cur_tag_close'] = config('cur_tag_close');
        $config['num_tag_open'] = config('num_tag_open');
        $config['num_tag_close'] = config('num_tag_close');
        $config['prev_tag_open'] = config('prev_tag_open');
        $config['prev_tag_close'] = config('prev_tag_close');
        $config['next_tag_open'] = config('next_tag_open');
        $config['next_tag_close'] = config('next_tag_close');
        $config['last_tag_open'] = config('last_tag_open');
        $config['last_tag_close'] = config('last_tag_close');




        $ci->pagination->initialize($config);
        return $ci->pagination->create_links();
        
    }
}

?>