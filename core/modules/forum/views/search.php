        <div class="forumbg">
            <div class="inner">
                <div class="forum_header">
                    <div class="row">
                        <div class="col-md-6">
                            Topics
                        </div>
                        <div class="col-md-1 hidden-xs-down"><i class="fa fa-comments"></i></div>
                        <div class="col-md-1 hidden-xs-down"><i class="fa fa-eye"></i></div>
                        <div class="col-md-4 hidden-xs-down"><i class="fa fa-clock"></i></div>
                    </div>
                </div>
                <div class="forum_body">
                    <?php foreach($Topics as $topic):
                        //print_r($topic);
                        ?>
                        <div class="item">
                                    <div class="row">
                                        <div class="col-md-6 topic-title">
                                            <i class="fa fa-comment"></i>
                                            <a class="title" href="<?php echo site_url('forum/topic/detail/'.$topic['issueId']); ?>">
                                                <?php echo $topic['Title']; ?>
                                            </a>
                                <span class="forum_description">
                                    <?php echo strip_tags(substr($topic['description'],0,100)); ?>...
                                </span>
                                            <br>
                                            <div class="additional hidden-xs-up">
                                                <span>Replies: <strong><?php echo $topic['Replies'];?></strong></span>
                                                <span>Views: <strong><?php echo $topic['Views'];?></strong></span>
                                            </div>
                                        </div>
                                        <div class="col-md-1 hidden-xs-down">
                                            <?php
                                            echo $topic['Replies'];
                                            ?>
                                        </div>
                                        <div class="col-md-1 hidden-xs-down">
                                            <?php
                                            echo $topic['Views'];
                                            ?>
                                        </div>
                                        <div class="col-md-4 avatar hidden-xs-down">
                                <span>
                                    <?php if($topic['avatar']): ?>
                                        <img src="<?php echo $topic['avatar']; ?>" width="30" height="30" alt="">
                                    <?php endif; ?>
                                </span>
                                            <span>
                                    by <a href="<?php echo site_url('profile/view/'.$topic['user_id']); ?>"><?php echo $topic['Author']; ?></a>
                                    <br>
                                                <?php echo humanreadableTime($topic['lastPost']); ?>
                                </span>

                                        </div>
                                    </div>
                                </div>

                                <?php
                        endforeach;

                    ?>

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
                                <input type="hidden" name="category" value="<?php echo $forumId; ?>">
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
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit Question</button>
                    <button type="reset" name="reset" class="btn btn-default">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>