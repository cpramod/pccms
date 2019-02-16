<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text"><?php echo $TopicDetail['TopicTitle']; ?></h3>
                    </div>
<!--                <div class="m-portlet__head-tools">-->
<!--                    <a href="--><?php //echo site_url('forum/forumDetail/'.$TopicDetail['category_id']); ?><!--" class="btn m-btn--pill    btn-success">--><?php //echo $TopicDetail['title']; ?><!--</a>-->
<!--                </div>-->
</div>
</div>
<div class="answer_list">
    <div class="list">
        <div class="row">
            <div class="col-2 col-md-1">
                <div class="vote">
                    <a href="javascript:" class="voteup" data-type="topic" data-answerid="<?php echo $TopicDetail['id']; ?>" title="Vote Up" >
                        <i class="fa fa-caret-up"></i>
                    </a>
                    <span><?php echo $Votes; ?></span>
                    <a href="javascript:" class="votedown" data-type="topic" data-answerid="<?php echo $TopicDetail['id']; ?>" title="Vote Up" >
                        <i class="fa fa-caret-down"></i>
                    </a>
                </div>
            </div>
            <div class="col-10 col-md-3 profile">
                <div class="avatar">
                <?php if($TopicDetail['avatar']): ?>
                    <img src="<?php echo $TopicDetail['avatar']; ?>" alt="">
                    <?php else: ?>
                    <img src="<?php echo img('avatars/avatar.png'); ?>" alt="">
                <?php endif; ?>
                </div>
                <a href="<?php echo site_url('profile/view/'.$TopicDetail['user_id']); ?>"><?php echo $TopicDetail['username']; ?></a>
                Posts: <?php echo $TopicDetail['posts']; ?>
            </div>
            <div class="col-md-8 col-12">
                <div class="title"><?php echo $TopicDetail['TopicTitle']; ?></div>
                <p class="author">
                    <i class="fa fa-file"></i>
                    <span>by <strong><a href="<?php echo site_url('profile/view/'.$TopicDetail['user_id']); ?>"><?php echo $TopicDetail['username']; ?></a></strong> » </span>
                    <?php echo humanreadableTime($TopicDetail['posted_on']); ?>
                </p>
                <div class="description">
                    <?php echo $TopicDetail['description']; ?>
                </div>
                <div class="attachments">
                    <?php
                    if (!empty($TopicDetail['attachments'])) {
                        ?>
                        <div class="col-sm-12">
                            <?php
                            $attachments=json_decode($TopicDetail['attachments']);
                            $attachments=(array)$attachments;
                            if(array_key_exists('img',$attachments)){
                                foreach($attachments['img'] as $img){
                                    ?>

                                        <img src="<?php echo base_url().'uploads/'.$img; ?>" width="100%" alt="">

                                    <?php
                                }
                            }
                            ?>

                        </div>
                        <?php
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<!-- answer section -->

<div class="row">
    <div class="col-md-12">
        <h4>
            <?php $AnswerCount = (isset($Answer)) ? count($Answer) : ""; ?>
            <?php echo $AnswerCount . ' Answer(s)'; ?>

        </h4>
    </div>
</div>
<div class="answer_list">
<?php
//print_r($Answer);
if (isset($Answer) && !empty($Answer)) {
    foreach ($Answer as $Answers) {
//print_r($Answers);
        ?>


            <div class="list">
                <div class="row">
                    <div class="col-md-1">
                        <div class="vote">
                            <a href="javascript:" class="voteup" data-type="answer" data-answerid="<?php echo $Answers['Id']; ?>" title="Vote Up"><i class="fa 	fa-caret-up"></i></a>
                            <span><?php echo $Answers['votes']; ?></span>
                            <a href="javascript:" class="votedown" data-type="answer" data-answerid="<?php echo $Answers['Id']; ?>" title="Vote Down"><i class="fa 	fa-caret-down"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3 profile">
                        <div class="avatar">
                            <?php if($Answers['avatar']): ?>
                                <img src="<?php echo $Answers['avatar']; ?>"
                                     alt="">
                            <?php else: ?>
                                <img src="<?php echo img('avatars/avatar.png'); ?>" alt="">
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo site_url('profile/view/' . $Answers['user_id']); ?>"><?php echo $Answers['UserName']; ?></a>
                        Posts: <?php echo $Answers['posts']; ?>
                    </div>
                    <div class="col-md-8">
                        <!-- accept answer button -->
                        <?php
                        if($user_details){
                            if($user_details['user_id']==$TopicDetail['user_id']):
                                echo '<a href="javascript:" data-issue="'.$TopicDetail['id'].'" data-answer="'.$Answers['Id'].'" class="accept_answer answer_mark" title="Accept Answer"><i class=" fa fa-check-circle"></i></a>';
                            endif;
                        }

                        if($Answers['accepted']){
                            echo '<a href="javascript:" data-answer="'.$Answers['Id'].'" class="active answer_mark" title="Accept Answer"><i class=" fa fa-check-circle"></i></a>';
                        }
                        ?>
                        <!-- end of accept answer button -->
                        <p class="author">
                            <i class="fa fa-file"></i>
                            <span>by <strong>
                                    <a href="<?php echo site_url('profile/view/'.$Answers['user_id']); ?>"><?php echo $Answers['UserName']; ?></a>
                                </strong> » </span>
                            <?php echo humanreadableTime($Answers['TimeStamp']); ?>
                        </p>
                        <div class="description">
                            <?php echo $Answers['Text']; ?>
                        </div>

                        <!-- comments section -->
                        <div class="comments">
                            <?php

                            foreach($Comment as $comm){
                                if($comm['AnswerId']==$Answers['Id']){
                                    ?>
                                    <div class="comment" style="border-bottom:0.07rem solid #ebedf2; margin-bottom:10px;">
                                        <small><?php echo $comm['Comment']; ?> - <span><a href="<?php echo site_url('profile/view/'.$comm['user_id']); ?>"><?php echo $comm['UserName']; ?></a></span> <em><?php echo humanreadableTime($comm['TimeStamp']); ?></em></small>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                            <?php if($user_details): ?>
                            <a href="javascript:" onClick="updateAnswerId('<?php echo $Answers['Id'] ?>')" data-toggle="modal" data-target="#addcomment" class="addComment">add a comment</a>
                            <?php else: ?>
                                <a href="<?php echo site_url('login'); ?>/?referrer=<?php echo $this->uri->uri_string(); ?>" class="addComment">add a comment</a>
                            <?php endif; ?>
            </div>

                        <!--end of comment section -->

                    </div>
                </div>
            </div>

        <?php
    }
}

?>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <?php if($user_details): ?>
        <a href="#" data-toggle="modal" data-target="#replyAnswer" class="btn btn-primary">Post Reply</a>
        <?php else:?>
        <a href="<?php echo site_url('login'); ?>/?referrer=<?php echo $this->uri->uri_string(); ?>" class="btn btn-primary">Post Reply</a>
        <?php endif; ?>
    </div>

</div>

<!-- popup of add comment -->
<div class="modal fade" id="replyAnswer">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reply Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="<?php echo site_url('forum/postAnswer/' . $TopicDetail['id']); ?>" class="m-form" method="post"
                  enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="m-scrollable m-scroller ps">

                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">
                                <input type="hidden" name="logged_user_id"
                                       value="<?php echo $this->session->userdata('user_id'); ?>">
                                <input type="hidden" name="issue_id" value="<?php echo $TopicDetail['id'] ?>">
                                <input type="hidden" name="issue_token"
                                       value="<?php echo $TopicDetail['issue_token'] ?>">
                                <input type="hidden" name="author" value="<?php echo $TopicDetail['user_id']; ?>">
                                <div class="form-group m-form__group">
                                    <textarea class="form-control m-input wysihtml5" name="answer_text" id="" cols="30"
                                              rows="10"></textarea>
                                </div>
                                <?php echo form_hidden($csrf); ?>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit Comment</button>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- popup of add comment -->
<div class="modal fade" id="addcomment">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?php echo site_url('forum/postComment'); ?>" class="m-form" method="post"
                  enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="m-scrollable m-scroller ps">

                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">
                                <input type="hidden" name="issue_id" value="<?php echo $TopicDetail['id'] ?>">
                                <input type="hidden" name="answer_id" value="" id="answer_id">
                                <input type="hidden" name="author" value="<?php echo $TopicDetail['user_id']; ?>">

                                <div class="form-group m-form__group">
                                    <label for="">Description</label>
                                    <textarea name="comment_text" id="" cols="30" rows="10"
                                              class="form-control m-input wysihtml5"></textarea>
                                </div>
                                <?php echo form_hidden($csrf); ?>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit Comment</button>

                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ask_question">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ask A Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?php echo site_url('forum/questions'); ?>" class="m-form" method="post"
                  enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="m-scrollable m-scroller ps" data-scrollbar-shown="true" data-scrollable="true"
                         data-height="400">

                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">
                                <div class="form-group m-form__group">
                                    <label for="">Your Question</label>
                                    <input type="text" name="your_question" value="" class="form-control m-input"
                                           required>
                                </div>
                                <input type="hidden" name="category" value="<?php echo $TopicDetail['category_id']; ?>">

                                <div class="form-group m-form__group">
                                    <label for="">Attachments</label>
                                    <input type="file" name="attachments[]" value="" multiple="multiple"
                                           class="form-control m-input">
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="">Description</label>
                                    <textarea name="description" id="" cols="30" rows="10"
                                              class="form-control m-input wysihtml5"></textarea>
                                </div>
                                <?php echo form_hidden($csrf); ?>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit Question</button>
                    <button type="button" name="reset" data-dismiss="modal" class="btn btn-default">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>