<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 8/30/18
 * Time: 10:56 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');
class Forum extends Main_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('forum_m');
        $this->load->model('questions_m');
        $this->load->model('category_m');
        $this->load->helper('token');
        $this->load->config('table');

        $this->template->set_layout('layout-sidebar')
            ->set('class','forum')
            ->set_partial('sidebar','sidebar');

        $this->data=array();

    }

    function index(){

        // get forum list
        $categories=$this->forum_m->getIssues();
        $Answers=0;
        $Views=0;



        // foreach($forums as $r=> $forum){
        //     // fetch discussions on each forum
        //     $topics=$this->forum_m->getTopics($forum['id']);
        //     $forums[$r]['topics']=count($topics);

        //     // get number of answers on each topics

        //     $count=0;

        //     foreach($topics as $i=> $topic){
        //         $Answers=$this->forum_m->getAnswersByTopic($topic['id']);
        //         $count+=count($Answers);

        //     }

        //     $forums[$r]['posts']=$count;
        //     $forums[$r]['lastPost']=$this->forum_m->getLastPost($forum['id']);



        // }

//        print_r($forums);
//        exit;


        $this->data['categories']=$categories;
        $this->data['sidebar']=1;


        $this->template->title('Forum')
            ->set_partial('sidebar','sidebar')
            ->build('forums',$this->data);
    }

    /** function to get forums by category id */
    public function getForums($category_slug){
        $forums = $this->forum_m->get_by($this->config->item('tbl_forums'),array('category_id'=>$category_slug),array('sort_order'=>'ASC'));
        foreach($forums as $r=> $forum){
            $topics = $this->forum_m->getTopics($forum->id);
            $forums[$r]->topics = count($topics);
            $count = 0;

            foreach ($topics as $i => $topic) {
                $Answers=$this->forum_m->getAnswersByTopic($topic['id']);
                $count+=count($Answers);

            }
            $forums[$r]->posts  =   $count;
            $forums[$r]->lastPost = $this->forum_m->getLastPost($forum->id);
        }

        return $forums;
        exit;
    }

    /**
     * function to get announcements
     */

     public function getAnnouncements($ForumId){
        $Topics = $this->forum_m->getAnnouncementsByCategory($ForumId);

        if (!empty($Topics)) {
            $TopicId = array_column($Topics, 'id');
            $Answer = $this->forum_m->getAnswers($Topics);

            $View = $this->forum_m->getViewsByTopics($TopicId);

        } else {
            $Answer = 0;
            $View = 0;
        }

        $AllArray = array();
        if (!empty($Topics)) {
            foreach ($Topics as $Topic) {
                $AllArray[$Topic['id']] = array();
                $AllArray[$Topic['id']]['issueId'] = $Topic['id'];
                $AllArray[$Topic['id']]['Title'] = $Topic['title'];
                $AllArray[$Topic['id']]['description'] = $Topic['description'];
                $AllArray[$Topic['id']]['Author'] = $Topic['username'];
                $AllArray[$Topic['id']]['user_id'] = $Topic['user_id'];
                $AllArray[$Topic['id']]['avatar'] = $Topic['avatar'];
                $AllArray[$Topic['id']]['Replies'] = 0;
                $AllArray[$Topic['id']]['Views'] = 0;
                $AllArray[$Topic['id']]['lastPost'] = $Topic['posted_on'];
                if (!empty($Answer)) {

                    foreach ($Answer as $Answers) {

                        if ($Answers['issue_id'] == $Topic['id']) {
                            $AllArray[$Topic['id']]['Replies'] = $Answers['AnswerCount'];
                        }
                    }
                }
                if (!empty($View)) {
                    foreach ($View as $Views) {
                        if ($Views['issue_id'] == $Topic['id']) {
                            $AllArray[$Topic['id']]['Views'] = $Views['ViewCount'];
                        }
                    }
                }
            }
        }

        return $AllArray;
     }


    /**
     * function to get forum details
     */
    public function forumDetail($ForumId = NULL,$offset=0) {
        $Category=$this->category_m->getForumName($ForumId);

        $this->data['announcements'] = $this->getAnnouncements($ForumId);

        $Topics=$this->forum_m->getTopicsByCategory($ForumId);
        //$total = count($this->forum_m->getTopicsByCategory($ForumId));

        if (!empty($Topics)) {
            $TopicId = array_column($Topics, 'id');
            $Answer=$this->forum_m->getAnswers($Topics);

            $View=$this->forum_m->getViewsByTopics($TopicId);

        }else{
            $Answer=0;
            $View=0;
        }

        $AllArray = array();
        if (!empty($Topics)) {
            foreach ($Topics as $Topic) {
                $AllArray[$Topic['id']]=array();
                $AllArray[$Topic['id']]['issueId'] = $Topic['id'];
                $AllArray[$Topic['id']]['Title'] = $Topic['title'];
                $AllArray[$Topic['id']]['description'] = $Topic['description'];
                $AllArray[$Topic['id']]['Author'] = $Topic['username'];
                $AllArray[$Topic['id']]['user_id'] = $Topic['user_id'];
                $AllArray[$Topic['id']]['avatar'] = $Topic['avatar'];
                $AllArray[$Topic['id']]['Replies'] = 0;
                $AllArray[$Topic['id']]['Views'] = 0;
                $AllArray[$Topic['id']]['lastPost'] = $Topic['posted_on'];
                if (!empty($Answer)) {

                    foreach ($Answer as $Answers) {

                        if ($Answers['issue_id'] == $Topic['id']) {
                            $AllArray[$Topic['id']]['Replies'] = $Answers['AnswerCount'];
                        }
                    }
                }
                if (!empty($View)) {
                    foreach ($View as $Views) {
                        if ($Views['issue_id'] == $Topic['id']) {
                            $AllArray[$Topic['id']]['Views'] = $Views['ViewCount'];
                        }
                    }
                }
            }
        }

        $this->data['csrf']=_get_csrf_nonce();
        

        $this->data['Topics'] = $AllArray;
        $this->data['forumId'] = $ForumId;
        $this->data['forumName'] = $Category['title'];

        $this->data['sidebar']=1;
        $this->data['ask_question']=1;

        $this->template->title($Category['title'])
            ->set_partial('sidebar', 'sidebar')
            //->set('pagination',pagination(site_url('forum/topics/'. $ForumId),$total))
            ->build('forum_details',$this->data);

    }

    /**
     * function to list categories
     */

    public function getCategories(){

    }

    /*
     * valid csrf
     */

    public function _valid_csrf_nonce()
    {
        $csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
        if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue'))
        {
            return TRUE;
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * function to ask questions
     */
    public function questions(){
        if($this->input->post()){
            $question_title=$this->input->post('your_question');
            $question_category=$this->input->post('category');
            $question_details=$this->input->post('description');
            $user_id=$this->session->userdata('user_id');

            if ($this->_valid_csrf_nonce() === FALSE)
            {
                show_error($this->lang->line('error_csrf'));
            }

            $issue_token = getIssueToken($user_id);
            $data = array(
                "issue_token" => $issue_token,
                "title" => $question_title,
                "description" => $question_details,
                "forum_id" => $question_category,
                "posted_by" => $user_id,
                "url_friendly_name" => replaceString($question_title),
                "posted_on" => get_datetime_from_timezone(),
            );

            if($_FILES['attachments']){
                $uploads=multipleUpload();
                if($uploads){
                    $output=array();
                    foreach($uploads as $upload){
                        if($upload['is_image']==1){
                            $output['img'][]=$upload['file_name'];
                        }
                    }
                }

                $data['attachments']=json_encode($output);

            }

            $issue_id=$this->questions_m->addIssue($data);
            if($issue_id){
                point_add(2);

                $to='admin@dailylifeinusa.com';
                sendEmail($to, 'New Question ','New question is posted by '.$this->session->userdata('email'), array('email'=>'admin@dailylifeinusa.com','name'=>'Dailylifeinusa'));

                //$response=$this->attachmentHandle($issue_id, $issue_token);
                $this->session->set_flashdata('success', 'Issue added successfully!');
            }
            else{
                $this->session->set_flashdata('error', 'Error adding issue!');
            }

            redirect('forum/topics/'.$question_category);
            exit;

        }
            $questions=$this->questions_m->getList();
            $this->data['questions']=$questions;
            $this->data['total_records']=$questions['record_total'];
            $this->data['categories']=$this->category_m->getCategoryList();
            $this->template
                ->title('All Questions')
                ->build('questions', $this->data);

    }

    /**
     * function to upload attachment
     */
    function attachmentHandle($issue_id, $issue_token){
        if (isset($_FILES['attachments']['name']) && count($_FILES['attachments']['name']) > 0) {
            if (is_array($_FILES['attachments']['name']) && count($_FILES['attachments']['name']) > 0 && isset($_FILES['attachments']['name'])) {
                for ($f = 0; $f < count($_FILES['attachments']['name']); $f++) {
                    $fileArr[] = array(
                        "name" => $_FILES['attachments']['name'][$f],
                        "type" => $_FILES['attachments']['type'][$f],
                        "tmp_name" => $_FILES['attachments']['tmp_name'][$f],
                        "error" => $_FILES['attachments']['error'][$f],
                        "size" => $_FILES['attachments']['size'][$f]);
                }
                for ($i = 0; $i < count($fileArr); $i++) {
                    $fileName = '';

                    if (trim($fileArr[$i]['name']) <> "" && $fileArr[$i]['size'] > 0 && $fileArr[$i]['error'] == 0) {
                        $fileValArr = explode('.', $fileArr[$i]['name']);
                        $filePathInfo = pathinfo($fileArr[$i]['name'], PATHINFO_EXTENSION);
                        $mediaArr = array('mp4');
                        $imgArr = array('png', 'jpg', 'jpeg', 'gif');
                        $docArr = array('txt', 'doc', 'docx', 'pdf');

                        if (in_array(strtolower($filePathInfo), $imgArr)) {
                            $fileName = replaceString($fileValArr[0]) . '_' . $issue_token . $issue_id . '.' . $filePathInfo;
                            move_uploaded_file($fileArr[$i]['tmp_name'], ISSUES_PHY_PATH . $fileName);
                            $dataArr['img'][] = $fileName;
                            resize_image($fileName, ISSUES_PHY_PATH, 70);
                        } else if (in_array(strtolower($filePathInfo), $mediaArr)) {
                            $mediaFileName = replaceString($fileValArr[0]) . '_' . $issue_token . $issue_id . '.' . $filePathInfo;
                            move_uploaded_file($fileArr[$i]['tmp_name'], ISSUES_PHY_PATH . $mediaFileName);
                            $dataArr['media'][] = $mediaFileName;
                        } else if (in_array(strtolower($filePathInfo), $docArr)) {
                            $docFileName = replaceString($fileValArr[0]) . '_' . $issue_token . $issue_id . '.' . $filePathInfo;
                            move_uploaded_file($fileArr[$i]['tmp_name'], ISSUES_PHY_PATH . $docFileName);
                            $dataArr['doc'][] = $docFileName;
                        }
                    }
                }
            }
        }

        if (count($dataArr) > 0) {
            $data_json = json_encode($dataArr);
        } else {
            $data_json = '';
        }
        $data = array("attachments" => $data_json);
        return $this->questions_m->updateIssue($issue_id, $data);
    }


    /**
     * function to display topics
     */
    public function topics(){

    }

    /*
     * function to display topics details
     */
    public function topicDetail($topic_id){
        //ini_set('display_errors',1);
        /**
         * add view on load
         */
        $this->forum_m->insertView(array(
            'issue_id'=>$topic_id,
            'user_id'=>''
            )
        );

        $TopicDetail=$this->forum_m->getTopicDetail($topic_id);

        $user_id=$TopicDetail['user_id'];

        $TopicDetail['posts']=$this->forum_m->countPostsByUser($user_id);

        $this->data['TopicDetail'] = $TopicDetail;

        $upvotes=$this->forum_m->getVotesByTopic($topic_id);

        $this->data['Votes'] = $upvotes;

        //answers by topic
        $Topics=$this->forum_m->getAnswersByTopic($topic_id);

        if (!empty($Topics)) {
            $UserIdArray = array_column($Topics, 'user_id');
            $AnswerId = array_column($Topics, 'id');
            $User=$this->forum_m->getUsersInTopic($UserIdArray);

            //function to fetch comments
            $Comment=$this->forum_m->getComments($topic_id);

            if (!empty($Comment)) {
                // function to get commented user
                $CommentUser=$this->forum_m->getCommentedUser($Comment);
            }
        }
        $Detail = [];
        $CommentAll = [];
        $CommentCount = 0;
        if (!empty($Topics)) {
            foreach ($Topics as $Topic) {
                $Detail[$Topic['id']]['Id'] = $Topic['id'];
                $Detail[$Topic['id']]['Text'] = $Topic['answer_text'];
                $Detail[$Topic['id']]['UserName'] = "";
                $Detail[$Topic['id']]['UserImage    '] = "";
                $Detail[$Topic['id']]['Title'] = "";
                $Detail[$Topic['id']]['TimeStamp'] = $Topic['answer_time'];
                $Detail[$Topic['id']]['CommentCount'] = 0;
                $ansvotes=$this->forum_m->getVotesByAnswer($Topic['id']);
                $Detail[$Topic['id']]['votes'] = $ansvotes;
                $Detail[$Topic['id']]['accepted'] = $Topic['is_best_answer'];


                foreach ($User as $Users) {
                    if ($Users['id'] == $Topic['user_id']) {
                        $Detail[$Topic['id']]['UserName'] = $Users['username'];
                        $Detail[$Topic['id']]['avatar'] = $Users['avatar'];
                        $Detail[$Topic['id']]['user_id'] = $Users['id'];
                        $Detail[$Topic['id']]['posts'] = $this->forum_m->countPostsByUser($Users['id']);
                    }
                }
                if (!empty($Comment)) {
                    foreach ($Comment as $com) {
                        if ($com['answer_id'] == $Topic['id']) {
                            $CommentCount +=1;
                            $Detail[$Topic['id']]['CommentCount'] = $CommentCount;
                        }
                    }
                    $CommentCount = 0;
                }
            }
        }
        if (!empty($Comment)) {
            foreach ($Comment as $Comments) {
                $CommentAll[$Comments['id']]['id'] = $Comments['id'];
                $CommentAll[$Comments['id']]['AnswerId'] = $Comments['answer_id'];
                $CommentAll[$Comments['id']]['Comment'] = $Comments['comment_text'];
                $CommentAll[$Comments['id']]['TimeStamp'] = $Comments['comment_time'];
                $CommentAll[$Comments['id']]['UserName'] = "";

                if (!empty($CommentUser)) {
                    foreach ($CommentUser as $CommentUsers) {
                        if ($CommentUsers['id'] == $Comments['user_id']) {
                            $CommentAll[$Comments['id']]['UserName'] = $CommentUsers['username'];
                            $CommentAll[$Comments['id']]['user_id'] = $CommentUsers['id'];

                        }
                    }
                }
            }
        }

        $this->data['user_id'] = $this->session->userdata('user_id');
        $this->data['Answer'] = $Detail;
        $this->data['Comment'] = $CommentAll;
        $this->data['sidebar']=1;
        $this->data['ask_question']=1;
        $this->data['csrf']=_get_csrf_nonce();


        $this->template->title('')
            ->set_partial('sidebar','sidebar')
            ->build('topic_detail', $this->data);
    }

    /**
     * function to answer post
     */
    public function postAnswer($issue_id) {
        if ($this->_valid_csrf_nonce() === FALSE)
        {
            show_error($this->lang->line('error_csrf'));
        }

        $user_id = $this->session->userdata('user_id');
        $answer_text = $this->input->post('answer_text');
        $issue_token = $this->input->post('issue_token');
        $url_friendly_name = $this->input->post('url_friendly_name');
        $issue_title=$this->forum_m->getOne('forum_issue',array('issue_token'=>$issue_token))->title;
        $author=$this->input->post('author');
        $data=array(
            'user_id'=>$user_id,
            'answer_text'=>$answer_text,
            //'issue_token'=>$issue_token,
            //'url_friendly_name'=>$url_friendly_name,
            'issue_id'=>$issue_id
        );

        $return_data = $this->questions_m->processInsertAnswer($data);
        if($return_data){
            point_add( 3);

            // sending email notification to the author of this issue
            $to=$this->ion_auth_model->user($author)->row()->email;
            sendEmail($to, 'New answer ','New answer on topic "'.$issue_title.'"', array('email'=>'admin@dailylifeinusa.com','name'=>'Dailylifeinusa'));

            $this->session->set_flashdata('success','Your Answer is posted successfully .');
        }else{
            $this->session->set_flashdata('error','Error posting your answer. Please try again later');
        }

        redirect('forum/topic/detail/' . $issue_id);
        exit;
    }


    public function postComment(){

        if ($this->_valid_csrf_nonce() === FALSE)
        {
            show_error($this->lang->line('error_csrf'));
        }

        $user_id = $this->session->userdata('user_id');
        $answer_id = $this->input->post('answer_id');
        $comment_text = $this->input->post('comment_text');
        $issue_id=$this->input->post('issue_id');
        $author=$this->input->post('author');
        $answered_user=$this->forum_m->getOne('forum_issue_answers',array('id'=>$answer_id))->user_id;
        $answered_user_email=$this->ion_auth_model->user($answered_user)->row()->email;

        $issue_title=$this->forum_m->getOne('forum_issue',array('id'=>$issue_id))->title;
        $data=array(
            'user_id'=>$user_id,
            'answer_id'=>$answer_id,
            'comment_text'=>$comment_text,
            'issue_id'=>$issue_id,
            "comment_time" => get_datetime_from_timezone(),
        );

        $return_data = $this->questions_m->processInsertComment($data);
        if($return_data){
            point_add(4);
            //sending notification email to the author and replied user about the comment

            $to=$answered_user_email;
            sendEmail($to, 'New comment ','New comment is added on an answer of topic "'.$issue_title.'"', array('email'=>'admin@dailylifeinusa.com','name'=>'Dailylifeinusa'));

            $to=$to=$this->ion_auth_model->user($author)->row()->email;
            sendEmail($to, 'New comment ','New comment is added on an answer of topic "'.$issue_title.'"', array('email'=>'admin@dailylifeinusa.com','name'=>'Dailylifeinusa'));


            $this->session->set_flashdata('success','Comment Posted Successfully');
        }else{
            $this->session->set_flashdata('error','Error posting comment');
        }

        redirect('forum/topic/detail/'.$issue_id);
        exit;

    }

    /**
     * function to add vote
     */
    public function upvote($id){
        if(!$this->session->userdata('user_id')){
            echo json_encode(array('error'=>1,'msg'=>'Only Logged in user can vote!'));
            exit;
        }

        $types=$this->input->post('types');
        $record=$this->forum_m->countVoteByUser($id, $types);
        if(count($record)>0){
            echo json_encode(array('error'=>1,'msg'=>'You have already voted this '.$types));
        }else{

            if($types=='answer'){
                $data=array(
                    'user_id'=>$this->session->userdata('user_id'),
                    'answer_id'=>$id,
                    'is_like'=>1
                );
            }else{
                $data=array(
                    'user_id'=>$this->session->userdata('user_id'),
                    'issue_id'=>$id,
                    'is_like'=>1
                );
            }


            $result=$this->forum_m->insert('forum_issue_upvotes',$data);
            if($result){
                point_add(5);
                if($types=='answer'){
                    $count=$this->forum_m->getVotesByAnswer($id);
                }else{
                    $count=$this->forum_m->getVotesByTopic($id);
                }

                echo json_encode(array('error'=>0,'msg'=>'You have voted successfully','upvotes'=>$count));
            }

        }
        exit;
    }

    /**
     * down vote
     */

    public function downvote($id){
        if(!$this->session->userdata('user_id')){
            echo json_encode(array('error'=>1,'msg'=>'Only Logged in user can vote!'));
            exit;
        }

        $types=$this->input->post('types');
        $record=$this->forum_m->countVoteByUser($id, $types);
        if(count($record)>0){
            echo json_encode(array('error'=>1,'msg'=>'You have already voted this '.$types));
        }else{

            if($types=='answer'){
                $data=array(
                    'user_id'=>$this->session->userdata('user_id'),
                    'answer_id'=>$id,
                    'is_like'=>-1
                );
            }else{
                $data=array(
                    'user_id'=>$this->session->userdata('user_id'),
                    'issue_id'=>$id,
                    'is_like'=>-1
                );
            }


            $result=$this->forum_m->insert('forum_issue_upvotes',$data);
            if($result){
                //point_add('Voted Down', 'vote_down');
                if($types=='answer'){
                    $count=$this->forum_m->getVotesByAnswer($id);
                }else{
                    $count=$this->forum_m->getVotesByTopic($id);
                }

                echo json_encode(array('error'=>0,'msg'=>'You have voted successfully','upvotes'=>$count));
            }

        }
        exit;
    }

    /**
     * function to accept answer
     */

    function acceptAnswer(){
        $answer_id=$this->input->post('answer_id');
        $issue_id=$this->input->post('issue_id');

        // find if this issue is already answered
        $checked=$this->forum_m->checkAnswered($issue_id);

        if($checked>0){
            echo 'no';
        }else{
            $result=$this->forum_m->markAnswered($answer_id);
            if($result){
                //point_add('Accepted Answer', 'accept_answer');
                echo 'ok';
            }
        }


        exit;
    }

    public function search(){
        $q=$this->input->get('q');
        $result=$this->forum_m->getSearchResult($q);

        if($result){
            $Topics=$result;
            if (!empty($Topics)) {
                $TopicId = array_column($Topics, 'id');
                $Answer=$this->forum_m->getAnswers($Topics);

                $View=$this->forum_m->getViewsByTopics($TopicId);

            }else{
                $Answer=0;
                $View=0;
            }

            $AllArray = array();
            if (!empty($Topics)) {
                foreach ($Topics as $Topic) {
                    $AllArray[$Topic['id']]=array();
                    $AllArray[$Topic['id']]['issueId'] = $Topic['id'];
                    $AllArray[$Topic['id']]['Title'] = $Topic['title'];
                    $AllArray[$Topic['id']]['description'] = $Topic['description'];
                    $AllArray[$Topic['id']]['Author'] = $Topic['username'];
                    $AllArray[$Topic['id']]['user_id'] = $Topic['user_id'];
                    $AllArray[$Topic['id']]['avatar'] = $Topic['avatar'];
                    $AllArray[$Topic['id']]['Replies'] = 0;
                    $AllArray[$Topic['id']]['Views'] = 0;
                    $AllArray[$Topic['id']]['lastPost'] = $Topic['posted_on'];
                    if (!empty($Answer)) {

                        foreach ($Answer as $Answers) {

                            if ($Answers['issue_id'] == $Topic['id']) {
                                $AllArray[$Topic['id']]['Replies'] = $Answers['AnswerCount'];
                            }
                        }
                    }
                    if (!empty($View)) {
                        foreach ($View as $Views) {
                            if ($Views['issue_id'] == $Topic['id']) {
                                $AllArray[$Topic['id']]['Views'] = $Views['ViewCount'];
                            }
                        }
                    }
                }
            }

            $this->data['Topics'] = $AllArray;


        }

        $this->data['sidebar']=1;
        $this->data['ask_question']=1;

        $this->template->title('Search Results')
            ->set_partial('sidebar', 'sidebar')
            ->build('search',$this->data);
    }



}