<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 8/30/18
 * Time: 1:02 PM
 */

class Questions_m extends My_Model{
    public $category_url;
    public $keyword;

    function __construct()
    {

        parent::__construct();
        $this->load->config('table');
        $this->_table="forum_issue";
        $this->_category=$this->config->item('tbl_forums');
        $this->_issue_answers='forum_issue_answers';
        $this->_issue_votes="forum_issue_upvotes";
        $this->_issue_views="forum_issue_views";
        $this->_users='users';

    }

    public function getList($sortBy='latest') {
        $return_data = array('page_status' => 0, 'record_total' => 0, 'list' => array());

        $where = " WHERE 1=1";
        //$where.=" AND ISU.is_approved='1'";
        // SORT BY QUERY
        if ($sortBy == 'latest') {
            $orderBy = " ORDER BY ISU.ID DESC";
        } elseif ($sortBy == 'votes') {
            $orderBy = " ORDER BY totalUpvotes DESC";
        } elseif ($sortBy == 'unanswered') {
            $orderBy = " ORDER BY totalAnswers ASC";
        } else {
            $orderBy = " ORDER BY ISU.ID DESC";
        }

        // CATEGORY URL
//        if (trim($this->category_url) <> "") {
//            $where.=" AND ISU.category_id=(SELECT id FROM ".$this->_category." WHERE url_friendly_name LIKE '%" . $this->db->escape_like_str($this->category_url) . "%')";
//        }
        // KEYWORD URL

        /* if(trim($this->keyword)<>"")
          {
          $keyword = $this->security->xss_clean($this->keyword);
          $where.=" AND ("
          . " ISU.issue_token LIKE '%".$this->db->escape_like_str($this->keyword)."%' OR "
          . " ISU.title LIKE '%".$this->db->escape_like_str($this->keyword)."%' OR "
          . " ISU.description LIKE '%".$this->db->escape_like_str($this->keyword)."%' OR "
          . " C.title LIKE '%".$this->db->escape_like_str($this->keyword)."%' "
          . " )";
          } */

//        if (trim($this->keyword) <> "") {
//            $keyword = $this->security->xss_clean($this->keyword);
//            $search_keyword = explode(" ", $keyword);
//            $where.=" AND ( ";
//            $orWhere = '';
//            for ($i = 0; $i < count($search_keyword); $i++) {
//                if (trim($search_keyword[$i]) <> "") {
//                    $orWhere.=" ISU.title LIKE '%" . $this->db->escape_like_str($search_keyword[$i]) . "%' OR";
//                    $orWhere.=" ISU.issue_token LIKE '%" . $this->db->escape_like_str($search_keyword[$i]) . "%' OR";
//                    $orWhere.=" ISU.description LIKE '%" . $this->db->escape_like_str($search_keyword[$i]) . "%' OR";
//                }
//            }
//            $orWhere = rtrim($orWhere, "OR");
//            $where.=$orWhere;
//            $where.=" )";
//        }


//        if ((is_numeric($this->pageNo) && $this->pageNo <> 0) && (is_numeric($this->perPage) && $this->perPage <> 0)) {
//            $limit = " LIMIT " . ($this->pageNo - 1) * $this->perPage . " , " . $this->perPage;
//        } else {
//            $limit = " LIMIT 0,30";
//        }

        $sql = "SELECT ISU.id, ISU.issue_token, ISU.title, ISU.description, ISU.posted_on, ISU.url_friendly_name,"
            . " C.name AS categoryTitle,C.slug AS categoryUrlFriendlyName, U.username, "
            . " (SELECT COUNT(ISA.id) id FROM ".$this->_issue_answers." ISA WHERE ISA.issue_id=ISU.id) AS totalAnswers, "
            . " (SELECT IFNULL(SUM(ISV.is_like),0) id FROM ".$this->_issue_votes." ISV WHERE ISV.issue_id=ISU.id) AS totalUpvotes, "
            . " (SELECT COUNT(ISVIW.id) id FROM ".$this->_issue_views." ISVIW WHERE ISVIW.issue_id=ISU.id) AS totalViews"
            . " FROM ".$this->_table." ISU "
            . " LEFT JOIN ".$this->_users." U ON (ISU.posted_by=U.id) "
            . " LEFT JOIN ".$this->_category." C ON (ISU.category_id=C.id)";

        //echo $sql.$where.$orderBy.$limit;
        $res = $this->db->query($sql . $where . $orderBy)->result_array();
        $query = $this->db->query($sql . $where . $orderBy);
        $record_total = $query->num_rows();

        if (count($res) > 0) {
            for ($i = 0; $i < count($res); $i++) {
                if (strlen($res[$i]["description"]) > 200) {
                    $description = substr($res[$i]["description"], 0, 200) . '...';
                } else {
                    $description = $res[$i]["description"];
                }
                $issue_posted_on = $this->convertTime($res[$i]["posted_on"]) . ' ago';
                $questionList[] = array(
                    "id" => $res[$i]["id"],
                    "issue_token" => $res[$i]["issue_token"],
                    "issue_title" => $res[$i]["title"],
                    "issue_description" => $description,
                    "issue_posted_on" => $issue_posted_on,
                    "categoryTitle" => $res[$i]["categoryTitle"],
                    "categoryUrlFriendlyName" => $res[$i]["categoryUrlFriendlyName"],
                    "url_friendly_name" => $res[$i]["url_friendly_name"],
                    "username" => $res[$i]["username"],
//                    "profile_pic" => $res[$i]["profile_pic"],
                    "totalAnswers" => $res[$i]["totalAnswers"],
                    "totalUpvotes" => $res[$i]["totalUpvotes"],
                    "totalViews" => $res[$i]["totalViews"]
                );
            }
            $return_data['page_status'] = 1;
            $return_data['record_total'] = $record_total;

            $return_data['list'] = $questionList;
        }
        return($return_data);
    }


    /**
     * function to add issues
     */
    function addIssue($data){
        return parent::insert($this->_table,$data);
    }

    /**
     * function to update issue
     */
    function updateIssue($issue_id, $data){
        return parent::update($this->_table, $data, array('id'=> $issue_id));
    }

    private function convertTime($dateTime) {
        $time = strtotime($dateTime);
        $time = time() - $time; // to get the time since that moment
        $time = ($time < 1) ? 1 : $time;
        $tokens = array(
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit)
                continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
        }
    }


    //=========ANSWER ISSUE============
    public function processInsertAnswer($data) {
        ///$return_url = BASE_URL . 'questions/' . $this->issue_token . '/' . $this->url_friendly_name;
        //$return_data = array("page_status" => 0, "err_msg" => "unable to post answer.", 'return_url' => $return_url);

        $data['answer_time']=get_datetime_from_timezone();

        $sql = $this->db->insert_string($this->_issue_answers, $data);
        $this->db->query($sql);
        $id = $this->db->insert_id();
        return $id;
    }

    public function processInsertComment($data) {
        $sql = $this->db->insert_string("forum_issue_answer_comment", $data);
        $this->db->query($sql);
        return $id = $this->db->insert_id();
    }


}