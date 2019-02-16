<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 8/30/18
 * Time: 12:05 PM
 */
class Forum_m extends My_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->config('forum/table');
        $this->_table="forum_issue";
        $this->_category=$this->config->item('tbl_category');
        $this->_issue_answers='forum_issue_answers';
        $this->_issue_views='forum_issue_views';
    }

    /**
     * @return mixed
     * function to fetch issues
     */
    function getIssues($limit=null, $offset=0){
        $this->db->select('id,title,description,url_friendly_name')
            ->from($this->_category)
            ->order_by('sort_order', 'ASC');
            if($limit !=null){
                $this->db->limit($limit, $offset);
            }

        return $this->db->get()
            ->result_array();

    }



    /**
     * function to get topics by id
     */
    function getTopicsByCategory($ForumId, $limit = null, $offset=0){
        /* Get Topic of Particular forum */
        $this->db->select($this->_table.'.*,users.username, users.avatar ,users.id as user_id')
            ->from($this->_table)
            ->join('users', 'users.id='.$this->_table.'.posted_by')
            ->where('forum_id', $ForumId)
            ->where('is_announcement', 0)
            ->order_by($this->_table.'.posted_on','DESC');
            if($limit != null){
                $this->db->limit($limit, $offset);
            }
            
            return $this->db->get()
            ->result_array();
    }


    function getAnnouncementsByCategory($ForumId)
    {
        /* Get Topic of Particular forum */
        return $this->db->select($this->_table . '.*,users.username, users.avatar ,users.id as user_id')
            ->from($this->_table)
            ->join('users', 'users.id=' . $this->_table . '.posted_by')
            ->where('forum_id', $ForumId)
            ->where('is_announcement', 1)
            ->order_by($this->_table . '.posted_on', 'DESC')
            ->get()
            ->result_array();
    }

    public function getAllTopics($limit = null, $offset = 0){
        $this->db->select($this->_table . '.*, users.username, users.avatar, users.id as user_id, '.$this->_category.'.title as category_title')
            ->from($this->_table)
            ->join('users', 'users.id=' . $this->_table . '.posted_by')
            ->join($this->_category,$this->_category.'.id='.$this->_table.'.forum_id')
            //->group_by('category_id')
            //->where('users.id', $this->session->userdata('user_id'))
            //->limit($limit)
            ->order_by($this->_table . '.posted_on', 'DESC');
            if($limit != null){
                $this->db->limit($limit, $offset);
            }

            $result = $this->db->get()
            ->result_array();
        return $result;
    }

    /**
     * @return mixed
     * get topics
     */


    function getTopics($category_id){

        $result=$this->db->select($this->_table.'.*, users.username, users.avatar, users.id as user_id')
            ->from($this->_table)
            ->join('users','users.id='.$this->_table.'.posted_by')
            //->group_by('category_id')
            ->where($this->_table.'.forum_id',$category_id)
            //->limit($limit)
            ->order_by($this->_table.'.posted_on','DESC')
            ->get()
            ->result_array();
        return $result;
    }


    /*
     * function to count topics by category
     */
    function countTopics($category_id){
        $result=$this->db->select($this->_table.'.*, users.username, users.avatar, users.id as user_id')
            ->from($this->_table)
            ->join('users','users.id='.$this->_table.'.posted_by')
            //->group_by('category_id')
            ->where($this->_table.'.category_id',$category_id)
            ->order_by($this->_table.'.posted_on','DESC')
            ->get()
            ->num_rows();
    }

    /**
     * function to fetch answers
     *
     */
    function getAnswers($topics){
        $TopicId = array_column($topics, 'id');
        return $this->db->select('count(id) as AnswerCount,issue_id')
            ->from($this->_issue_answers)
            ->group_by('issue_id')
            ->where_in('issue_id', $TopicId)
            ->get()
            ->result_array();
    }

    /**
     * function to get views
     */
    function getViews($topics){
        $TopicId = array_column($topics, 'id');
        return $this->db->select('issue_id,count(id) as ViewCount')
            ->from('forum_issue_views')
            ->group_by('issue_id')
            ->where_in('issue_id', $TopicId)
            ->get()
            ->result_array();
    }

    /**
     * function to get answers of a topic
     */
    function getAnswersByTopic($topic_id){
        return $this->db->select('*')
                ->from($this->_issue_answers)
            ->where('issue_id', $topic_id)
            ->get()
            ->result_array();

    }

    /**
     * function to get views by topic
     */
    function getViewsByTopic($topic_id){
        return $this->db->select('*')
            ->from($this->_issue_views)
            ->where('issue_id', $topic_id)
            ->get()
            ->result_array();
    }

    /**
     * function to get user details by topic
     */
    function getUsersInTopic($UserIdArray){
        return $this->db->select('id,username,avatar')
            ->from('users')
            ->where_in('id', $UserIdArray)
            ->get()
            ->result_array();

    }

    /**
     * function to fetch last post
     */
    function getLastPost($cat){

        return $this->db->select($this->_issue_answers.'.answer_time as PostedOn,issue.forum_id, issue.title, issue.id,user.username, user.id as user_id')
                        ->from($this->_table.' as issue')
                        ->join('users as user', 'user.id = issue.posted_by')
                        ->join($this->_issue_answers, $this->_issue_answers.'.issue_id = issue.id')
                        ->where('issue.forum_id',$cat)
                        ->order_by('PostedOn','Desc')
                        ->limit(1)
                        ->get()
                        ->row_array();
    }

    /**
     * Function to get number of views
     */
    function getViewsByTopics($TopicId){
        /* Getting views count */
        return $this->db->select('issue_id,count(id) as ViewCount')
            ->from('forum_issue_views')
            ->group_by('issue_id')
            ->where_in('issue_id', $TopicId)
            ->get()
            ->result_array();
    }

    /*
     * function to get whole topic detail by id
     */
    function getTopicDetail($topic_id){

        /* Get Topic detail */
        return $this->db->select(
            $this->_table.'.id,'
            .$this->_table.'.issue_token,'
            .$this->_table.'.title as TopicTitle,'
            .$this->_table.'.description,'
            .$this->_table.'.attachments,'
            .$this->_table.'.url_friendly_name,'
            .$this->_table.'.posted_on,'
            .$this->_table.'.forum_id,'
            .$this->_category.'.title,
            users.username,
            users.avatar,
            users.id as user_id')
            ->from($this->_table)
            ->join('users', 'users.id='.$this->_table.'.posted_by')
            ->join($this->_category,$this->_category.'.id='.$this->_table.'.forum_id')
            ->where($this->_table.'.id', $topic_id)
            ->get()
            ->row_array();

    }

    /*
     * add view
     */

    function insertView($data){
        return parent::insert($this->_issue_views,$data);
    }

    /**
     * function to get votes by topic
     */
    function getVotesByTopic($topic_id){
        /* Get upvotes */
        $result=$this->db->select('SUM(is_like) AS votes')
            ->from('forum_issue_upvotes')
            ->where('issue_id', $topic_id)
            ->get()
            ->row_array();

        if($result['votes']==''){
            return 0;
        }else{
            return $result['votes'];
        }

    }

    /**
     * function to get votes by answer
     */

    function getVotesByAnswer($answer_id){
        $result= $this->db->select('SUM(is_like) AS votes')
            ->from('forum_issue_upvotes')
            ->where('answer_id', $answer_id)
            ->get()
            ->row_array();

        if($result['votes']==''){
            return 0;
        }else{
            return $result['votes'];
        }
    }

    /*
     * function to count vote by user
     */
    function countVoteByUser($id, $types){
        if($types=='answer'){
            return $this->db->select('*')
                ->from('forum_issue_upvotes')
                ->where('answer_id', $id)
                ->where('user_id',$this->session->userdata('user_id'))
                ->get()
                ->result_array();
        }else{
            return $this->db->select('*')
                ->from('forum_issue_upvotes')
                ->where('issue_id', $id)
                ->where('user_id',$this->session->userdata('user_id'))
                ->get()
                ->result_array();
        }

    }


    /**
     * function to get comments
     */
    function getComments($topic_id){
        /* Comment */
        return $this->db->select('*')
            ->from('forum_issue_answer_comment')
            ->where_in('issue_id', $topic_id)
            ->get()
            ->result_array();
    }

    /**
     * function to get commented user
     */
    function getCommentedUser($Comment){
        $AnswerId = array_column($Comment, 'user_id');
        return $this->db->select('id,username')
            ->from('users')
            ->where_in('id', $AnswerId)
            ->get()
            ->result_array();
    }

    /*
     * function to count number of answers posted by a user
     */
    function countPostsByUser($user_id){
        return $result= $this->db->select('issue_id')
            ->from($this->_issue_answers)
            ->where('user_id',$user_id)
            ->get()
            ->num_rows();

    }

    /*
     * function to mark answer
     */
    function markAnswered($answer_id){
        return parent::update($this->_issue_answers,array('is_best_answer'=>1),array('id'=>$answer_id));
    }

    /**
     * check if issue is already answered
     */
    function checkAnswered($issue_id){
        return parent::count_by($this->_issue_answers,array('issue_id'=>$issue_id,'is_best_answer'=>1));
    }

    /*
     * search function
     */
    function getSearchResult($q){
        return $this->db->select($this->_table.'.*, users.id as user_id, users.username, users.email, users.avatar')
            ->from($this->_table)
            ->join($this->_issue_answers,$this->_table.'.id='.$this->_issue_answers.'.issue_id')
            ->join('users',$this->_table.'.posted_by=users.id')
            ->like($this->_table.'.title',$q)
            ->or_like($this->_issue_answers.'.answer_text',$q)
            ->order_by($this->_table.'.posted_on','desc')
            ->get()
            ->result_array();
    }

}