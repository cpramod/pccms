<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 9/20/18
 * Time: 12:07 PM
 */

class Blog_m extends My_Model{
    function __construct()
    {
        parent::__construct();
        $this->_table="blog_posts";
        $this->load->model('blog/category_m');
        $this->config->load('table');
        
    }

    /**
     * get_posts
     *
     * @access  public
     * @author  Enliven Applications
     * @version 3.0
     *
     * @return  null
     */
    public function get_posts($limit = null, $offset =0)
    {
        $this->db->select(config('tbl_posts').'.*')
        ->from($this->_table)
        //->join(config('posts_to_categories'),config('posts_to_categories').'.post_id='.config('tbl_posts').'.id')
        //->join(config('tbl_categories'),config('tbl_categories').'.id='.config('posts_to_categories').'.category_id')
        ->order_by('created_datetime', 'DESC');
        
        if($limit != null){
            $this->db->limit($limit, $offset);
        }
        return $this->db->get();
    }


    /**
     * get_post
     *
     * gets a single post
     *
     * @access  public
     * @author  Enliven Applications
     * @version 3.0
     *
     * @return  array
     */
    public function get_post($id)
    {
        // get the post
        $post = $this->db->where('id', $id)->limit(1)->get($this->_table)->row_array();

        // get post's categories
        $query_cats = $this->db->select('category_id')->where('post_id', $post['id'])->get('posts_to_categories')->result_array();

        // build for multi-select
        foreach ($query_cats as $k => $v)
        {
            $post['selected_cats'][] = $v['category_id'];
        }

        // build the multi-select
        $post['cats'] = $this->get_cats_form();

        // return
        return $post;
    }


    function getPosts(){
        return $this->db->select('*')
            ->from($this->_table)
            ->where('status',1)
            ->get()
            ->result_array();
    }


    /**
     * add_post
     *
     * @access  public
     * @author  Enliven Applications
     * @version 3.0
     *
     * @param  array $data the array data for the new post
     * @return  bool
     */
    public function add_post($data)
    {
        // separate the categories from
        // post data
        $cats = $data['cats'];
        unset($data['cats']);

        // attempt to insert the post
        if ($this->db->insert($this->_table, $data))
        {
            // it works, so get the new id
            $new_post_id = $this->db->insert_id();

            // attempt to add the categories
            if ($this->insert_cats_to_post($new_post_id, $cats))
            {
                // everything went well
                return true;
            }

            // couldn't insert the post
            return false;
        }

        // default failure
        return false;
    }

    /**
     * get_cats_form
     *
     * builds the array to populate
     * the categories multi-select input
     * @access  public
     * @author  Enliven Applications
     * @version 3.0
     *
     * @return  array
     */
    public function get_cats_form()
    {
        // get'm
        $cats = $this->db->select('*')->get(config('tbl_categories'))->result_array();

        // default empty array
        $ret = [];

        // foreach getting id and name
        foreach ($cats as $k => $v)
        {
            $ret[$v['id']] = $v['name'];
        }

        // return array
        return $ret;
    }


    /**
     * insert_cats_into_post
     *
     * @access  public
     * @author  Enliven Applications
     * @version 3.0
     *
     * @param  string $post_id
     * @param  array $cats array of caregories
     *
     * @return  bool
     */
    public function insert_cats_to_post($post_id, $cats)
    {
        // build insert array
        foreach ($cats as $k => $v)
        {
            $insert[] = ['post_id' => $post_id, 'category_id' => $v];
        }

        // attempt to insert categories for the post
        if ($this->db->insert_batch('posts_to_categories', $insert))
        {
            // yay!
            return true;
        }

        // boo!
        return false;
    }



    /**
     * get_posts
     *
     * Gets blog posts with pagination
     *
     * @access  public
     * @author  Enliven Applications
     * @version 3.0
     *
     * @return  array
     */
    public function getAllPosts($limit=null,$offset = 0)
    {
        // today's date
        $current_date = date('Y-m-d');

        // rediculous db call
        $this->db->select( $this->_table.'.*,users.first_name,users.last_name')
            ->join( 'users', $this->_table.'.author = users.id')
            ->where($this->_table.'.status', 'published')
            //->where($this->_table.'.date_posted <= ', $current_date)
            ->order_by($this->_table.'.sticky', 'DESC')
            ->order_by($this->_table.'.id', 'DESC');
        if($limit != null){
            $this->db->limit($limit, $offset);
        }
        
        $query = $this->db->get($this->_table);

        // did we find anything?
        if ($query->num_rows() > 0)
        {
            // yes...
            $result['posts'] = $query->result_array();

            // process for needed fields.
            foreach ($result['posts'] as &$item)
            {
                $item['url'] = post_url($item['url_title'], $item['created_datetime']);
                $item['display_name'] = $this->concat_display_name($item['first_name'], $item['last_name']);
                $item['categories'] = $this->category_m->get_categories_by_ids($this->get_post_categories($item['id']));
                $item['comment_count'] = $this->db->where('post_id', $item['id'])->where('modded', '0')->where('type','post')->from('blog_comments')->count_all_results();
                $item['date_posted'] = $item['created_datetime'];
            }

            $result['post_count'] = $query->num_rows();

            return json_decode(json_encode($result));
        }

        // failed... bounce.
        return array();
    }


    public function concat_display_name($fname = 'empty', $lname='empty')
    {
        return $fname . ' ' . $lname;
    }


    public function get_post_categories($post_id)
    {
        $this->db->select('category_id');
        $this->db->where('post_id', $post_id);

        $query = $this->db->get('posts_to_categories');

        if ($query->num_rows() > 0)
        {
            $result = $query->result_array();

            foreach ($result as $category)
            {
                $categories[] = $category['category_id'];
            }

            return $categories;
        }
    }


    /**
     * Get Archive
     *
     * Retrieves the archives
     *
     * @since  v3.0.0
     *
     *
     * @return array
     */
    public function get_archive()
    {
        // more crazy db build/call
        $this->db->select('COUNT(' . $this->_table.'.id'.') AS posts_count, ' . $this->_table.'.created_datetime' . ' FROM ' . $this->_table . ' WHERE ' . $this->_table .'.status' . ' = \'published\' GROUP BY SUBSTRING(' . $this->_table .'.created_datetime' . ', 1, 7)', FALSE)
            ->order_by($this->_table . '.created_datetime', 'DESC')
            ->limit($this->config->item('months_per_archive'));

        $query = $this->db->get();

        // we can haz results?
        if ($query->num_rows() > 0)
        {
            $result = $query->result_array();

            foreach ($result as &$item)
            {
                $item['url']  = date('Y', strtotime($item['created_datetime'])) . '/' . date('m', strtotime($item['date_posted'])) . '/';
                $item['date_posted']  = strftime('%B %Y', strtotime($item['created_datetime']));
            }
            return $result;
        }
        return false;
    }


    public function get_posts_by_category($url_name)
    {
        $result = new stdClass();
        $current_date = date('Y-m-d');

        $this->db->select('blog_posts.*, users.first_name, users.last_name')
            ->join('posts_to_categories', 'blog_posts.id = posts_to_categories.post_id')
            ->join(config('tbl_categories'), 'posts_to_categories.category_id = '.config('tbl_categories').'.id')
            ->join(' users', 'blog_posts.author = users.id')
            ->where('blog_posts.status', 'published')
            //->where('blog_posts.date_posted <=', $current_date)
            ->where(config('tbl_categories').'.slug', $url_name)
            ->order_by('blog_posts.sticky', 'DESC')
            ->order_by('blog_posts.id', 'DESC');

        $query = $this->db->get($this->_table);

        if ($query->num_rows() > 0)
        {
            $result->posts = $query->result();

            foreach ($result->posts as &$item)
            {
                $item->url = post_url($item->url_title, $item->date_posted);
                $item->display_name = $this->concat_display_name($item->first_name, $item->last_name);
                $item->categories = $this->category_m->get_categories_by_ids($this->get_post_categories($item->id));
                $item->comment_count = $this->db->where('post_id', $item->id)->where('modded', '0')->from('blog_comments')->count_all_results();
            }

            $result->post_count = $query->num_rows();

            return $result;
        }
        return [];
    }


    public function get_categories()
    {
        return $this->category_m->get_categories();
    }


    public function get_post_by_url($url_title)
    {
        $this->db->select('blog_posts.*, users.first_name, users.last_name, users.avatar, users.bio, users.id as user_id')
            ->join('users', 'blog_posts.author = users.id')
            ->where('blog_posts.status', 'published')
            ->where('blog_posts.url_title', $url_title);


        $this->db->limit(1);

        $query = $this->db->get($this->_table);

        if ($query->num_rows() == 1)
        {
            // yep
            $result = $query->row_array();

            // build the needed vaules
            $result['url'] = post_url($result['url_title']);
            $result['display_name'] = $this->concat_display_name($result['first_name'], $result['last_name']);
            $result['categories'] = $this->category_m->get_categories_by_ids($this->get_post_categories($result['id']));
            $result['comment_count'] = $this->db->where('post_id', $result['id'])->where('modded', '0')->where('status',1)->where('type','post')->from('blog_comments')->count_all_results();

            return $result;
        }
        return false;
    }



    public function get_posts_by_date($year, $month)
    {
        $result = new stdClass();
        $date = $year . '-' . $month;
        $current_date = date('Y-m-d');

        $this->db->select('blog_posts.*, users.first_name, users.last_name')
            ->join(' users', 'blog_posts.author = users.id')
            ->where('blog_posts.status', 'published')
            //->where('blog_posts.date_posted <=', $current_date)
            ->like('blog_posts.created_datetime', $date)
            ->order_by('blog_posts.sticky', 'DESC')
            ->order_by('blog_posts.id', 'DESC');

        $query = $this->db->get($this->_table);

        if ($query->num_rows() > 0)
        {
            $result->posts = $query->result();

            foreach ($result->posts as &$item)
            {
                $item->url = post_url($item->url_title, $item->date_posted);
                $item->display_name = $this->concat_display_name($item->first_name, $item->last_name);
                $item->categories = $this->category_m->get_categories_by_ids($this->get_post_categories($item->id));
                $item->comment_count = $this->db->where('post_id', $item->id)->where('modded', '0')->from('blog_comments')->count_all_results();
            }

            $result->post_count = $query->num_rows();

            return $result;
        }
        return [];
    }

    public function update_cats_to_post($post_id, $cats)
    {
        // do we have needed info?
        if ( ! $cats || ! $post_id )
        {
            // fail
            return false;
        }

        // help switch on success...
        $return = true;

                if (!parent::delete('posts_to_categories',array('post_id'=>$post_id)))
                {
                    $return = false;
                }
        
        // insert new categories
        if ( $cats && $return == true)
        {
            return $this->insert_cats_to_post($post_id, $cats);
        }

        return true;
    }


    public function update_post($id, $data)
    {
        //$old = $this->db->where('id', $id)->limit(1)->get($this->_table)->row();

        $cats = $data['cats'];
        unset($data['cats']);

        // update the curent record and categories
        $return = $this->update_cats_to_post($id, $cats);
        $return = $this->db->where('id', $id)->update($this->_table, $data);
        return $return;

    }

}