<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 9/19/18
 * Time: 11:06 PM
 */

class Article_comments_model extends My_Model{
    function __construct()
    {
        parent::__construct();
        $this->_table="blog_comments";
    }

    public function addComment($data){
        return parent::insert($this->_table,$data);
    }

    public function getCommentsBySlug($slug){
        return $this->db->select('*')
            ->from($this->_table)
            ->join('users','users.id='.$this->_table.'.author')
            ->where($this->_table.'.slug',$slug)
            ->where($this->_table.'.status',1)
            ->get()
            ->result_array();
    }

    public function getComments($limit=null, $offset = 0){
        $this->db->select('*')
            ->from($this->_table);
            if($limit != null){
                $this->db->limit($limit, $offset);
            }
            //->join('users','users.id='.$this->_table.'.author')
            return $this->db->get()
            ->result_array();
    }


    public function approve($id){
        return parent::update($this->_table, array('status'=>1,'modded'=>0), array('comment_id'=> $id));
    }


    public function get_comments($post_id)
    {
        $this->db
            ->where('post_id', $post_id)
            ->where('modded', 0)
            ->where('status', 1)
            ->where('type','post')
            ->order_by('comment_id', 'ASC');

        $query = $this->db->get($this->_table);

        // do we have results?
        if ($query->num_rows() > 0)
        {
            // tasty results
            $result = $query->result();

            // foreach and parse markdown in content
            $output=array();

            foreach ($result as &$item)
            {
                $item->comment = nl2br($item->comment);
                //$item->date = DateTime::createFromFormat('Y-m-d H:i:s', $item->date)->format('M d Y');

                if ($item->author!='')
                {
                    if(is_numeric($item->author) || $item->author != 0){
                        $author = $this->ion_auth_model->user($item->author)->row();
                        $item->author = $author->first_name.' '.$author->last_name;
                        $item->avatar = $author->avatar;
                    }else{
                        $item->avatar = 'http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=70';
                    }


                }

                $output[] = $item;
                //$output[]=array('comment'=>$item->comment,'date'=>$item->date,'author'=>$item->author,'avatar'=>$author->avatar);

            }

            // return tastiness
            return $output;
        }
        // sad panda has no tasty results
        return [];
    }



    public function create_comment($id)
    {
        // is the commenter logged in?
        if ( $this->ion_auth->logged_in() )
        {
            // yes
            $data = [
                'post_id' 		=> $id,
                'author' 		=> $this->ion_auth->get_user_id(),
                'author_ip' 	=> $_SERVER['REMOTE_ADDR'],
                'comment' 		=> $this->input->post('comment'),
                'date' 			=> date('Y-m-d H:i:s'),
                'modded'		=> $this->config->item('mod_user_comments'),
                'type'          =>  'post'
            ];

            $from=array('name'=>$this->session->userdata('first_name').' '.$this->session->userdata('last_name'),'email'=>$this->session->userdata('email'));
        }
        // nope, they should have radically different info to insert.
        else
        {
            $data = [
                'post_id' 		=> $id,
                'author' 		=> $this->input->post('nickname'),
                'author_email' 	=> $this->input->post('email'),
                'author_ip' 	=> $_SERVER['REMOTE_ADDR'],
                'comment' 		=> $this->input->post('comment'),
                'date' 			=> date('Y-m-d H:i:s'),
                'modded'		=> $this->config->item('mod_non_user_comments'),
                'type'          =>  'post'
            ];

            $from=array('name'=>$this->input->post('nickname'),'email'=>$this->input->post('email'));
        }
        // do the insert...
        if ($this->db->insert('blog_comments', $data))
        {
            // send the comment email notice
            sendEmail('admin@dailylifeinusa.com', 'Blog Comment', 'Comment:' . $this->input->post('comment'),$from);
            return true;
        }
        return false;
    }

}