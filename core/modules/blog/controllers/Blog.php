<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends Main_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('blog_m');
        $this->load->helper('blog');
        $this->lang->load('blog');
        $this->config->load('table');
        $this->template->set('archives_list',$this->blog_m->get_archive())
            ->set('categories_list',$this->blog_m->get_categories());
    }


    public function index($offset=0)
    {
        // get the posts
        $posts = $this->blog_m->getAllPosts($this->limit, $offset);
        $total = $this->blog_m->getAllPosts()->post_count;
        $data['posts']= ($posts && $posts->posts)? $posts->posts : '';
        $this->template->title('Blog')
        ->set('pagination',pagination(site_url('blog/index'),$total))
        ->build('index', $data);
    }


    /**
     * Category
     *
     * Shows posts in a particular category
     *
     * @access  public
     * @author  Enliven Applications
     * @version 3.0
     *
     * @return  null
     */
    public function category($url_name = null, $offset=0)
    {

        if ($data = $this->blog_m->get_posts_by_category($url_name))
        {
            $total = $data->post_count;
        }
        else
        {
            $data['posts'] = FALSE;
        }
        $this->template->title('Blog Category');
        if($url_name != null){
            $this->template->set('pagination', pagination(site_url('blog/category/'.$url_name), $total));
        }else{
            $this->template->set('pagination', pagination(site_url('blog/category'), $total));
        }
            
        $this->template->build('index', $data);
    }



    /**
     * Archive
     *
     * Shows archives for year/month
     *
     * @access  public
     * @author  Enliven Applications
     * @version 3.0
     *
     * @return  null
     */
    public function archive($year=null, $month=null, $offset=0)
    {
        if ($data = $this->blog_m->get_posts_by_date($year, $month))
        {
            //Create Pagination
            $this->load->library('pagination');

            /*
                the setting for bootstrap 3 or Semantic UI are
                already set in /applications/config/pagination.php
             */

            $config['base_url'] = site_url();
            $config['total_rows'] = $data->post_count;
            $config['per_page'] = $this->config->item('posts_per_page');

            // docs say we don't have to if we have a config file, but we have to
            $this->pagination->initialize($config);

            // tasty Links
            $data->pagination = $this->pagination->create_links();

            $this->template->build('index', $data);
        }
    }

    /**
     * post
     *
     * Show a single post
     *
     * @access  public
     * @author  Enliven Applications
     * @version 1.0
     */
    public function post($url_title = NULL)
    {
        // load up some narrowly needed stuff
        $this->load->model('comments/article_comments_model','comments_m',true);
        $this->load->library('form_validation');

        // We kan haz a post?
        if ($data['post'] = $this->blog_m->get_post_by_url($url_title))
        {
            // exisiting comments?
            $data['comments'] = $this->comments_m->get_comments($data['post']['id']);

            if ( $this->config->item('allow_comments') == 1 && $this->input->post() || $data['post']['allow_comments'] == 1 && $this->input->post() )
            {
                if ($data['post']['allow_comments'] != 0)
                {
                    $this->new_comment($data['post']['id'], site_url($url_title));
                }
            }


        }

        //$this->obcore->set_meta($data['post'], 'post');

        // build the page
        $this->template
        ->build('blog/single_post', $data);

    }

    /**
     * new comment
     *
     * adds new comment to a post
     *
     * @param   $id The post ID
     * @param   $url to redirect back to post
     * @param   $parent The parent comment, if any. depth = 1
     *
     * @access  public
     * @author  Enliven Applications
     * @version 1.0
     */
    public function new_comment($id, $url, $parent='false')
    {
        $this->load->model('article_comments_model','comments_m',true);

        // do we use reCaptcha
        if ($this->config->item('use_recaptcha') == 1)
        {
            $this->form_validation->set_rules('g-recaptcha-response', 'lang:recaptcha', 'callback_verify_recaptcha');
        }

        // are we using the honeypot?
        if ($this->config->item('use_honeypot') == 1)
        {
            if (!empty($this->input->post('date_stamp_gotcha')))
            {
                redirect();
            }
        }

        // looged in user? no need to worry them for
        // info we already have.
        if ($this->ion_auth->logged_in() == FALSE)
        {
            $this->form_validation->set_rules('nickname', 'Name', 'required|max_length[50]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');


        }

        // need a comment though
        $this->form_validation->set_rules('comment', 'Comment', 'required|max_length[400]|htmlentities');

        // pretty for Bootstrap 3
        // TODO: switching for Semantic UI
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        // run it!  did it pass validation?
        if ($this->form_validation->run() == TRUE)
        {

            if ($this->comments_m->create_comment($id))
            {
                // default oops
                $message = 'unknown error';

                // if they're logged in, but are they being
                // moderated?
                if ($this->ion_auth->logged_in())
                {
                    $message = ($this->config->item('mod_user_comments') == 0) ? lang('add_comment_success') : lang('add_comment_success_modded');
                }
                // they're not logged in, but are they being
                // moderated?
                else
                {
                    $message = ($this->config->item('mod_non_user_comments') == 0) ? lang('add_comment_success') : lang('add_comment_success_modded');
                }

                point_add(7);

                // woot!  set the success message
                $this->session->set_flashdata('success', $message);

                redirect($url);
            }


        }else{
            $this->session->set_flashdata('error',validation_errors());
            redirect($url);
        }
    }


    /**
     * verify reCaptcha
     *
     * uses Phil Sturgeon's Rest client
     * to connect to google.com new v2
     * recaptcha system and verify the
     * captcha token provided by the user
     * is valid.
     *
     * @access  public
     * @author  Enliven Applications
     * @version 1.0
     */
    public function verify_recaptcha($str)
    {
        // applications/libraries
        $this->load->library('rest');

        // rest config
        $config = array(
            'server' => 'https://www.google.com/recaptcha/api/',
        );

        // post info to send to google
        $post = array(
            'secret'	=> $this->config->item('recaptcha_private_key'), // see admin settings
            'response'	=> $str, // redicilously long string from form.
            'remoteip'	=> $this->input->ip_address()  // optional, but we're going to do it anyway.
        );

        // Run Rest initialization
        $this->rest->initialize($config);

        // Pull in response
        $recaptcha = $this->rest->post('siteverify', $post);

        // because dashes in objects...
        // bleh.  Thanks google.
        $recaptcha = (array) $recaptcha;

        // errors?
        if ( isset($recaptcha['error-codes']))
        {
            // we'll need humanize() shortly.
            $this->load->helper('inflector');

            // add errors to the form_validation error message
            foreach ($recaptcha['error-codes'] as $error)
            {
                /*
                Set a human readable error message.

                Fun fact: an undocumented second param in humanize() allows
                          one to specify the Input Separator.  the default is
                          the underscore.  Google returns a dash.
                 */
                $this->form_validation->set_message('verify_recaptcha', 'Recaptcha - ' . humanize($error, '-'));
            }
            // there were errors, so the callback fails
            return false;
        }
        // no errors.  Winner, winner, chicken dinner.
        return true;
    }




} // EOC