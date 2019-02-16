<div class="row ">
    <div class="col-xl-3 col-md-3 col-sm-4 col-xs-12 sidebar">
        <div class="row">
            <div class="col-md-12">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        <a href="javascript:" class="btn m-btn--pill    btn-success" data-toggle="modal" data-target="#ask_question">Ask A Question</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-md-8 col-sm-8 col-xs-12">
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">Questions</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm">
                        <li class="nav-item m-tabs__item">
                            <a href="" class="nav-link m-tabs__link active" role="tab">
                                Latest
                            </a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a href="" class="nav-link m-tabs__link" role="tab">
                                Votes
                            </a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a href="" class="nav-link m-tabs__link" role="tab">
                                Unanswered
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="">

                                <div class="m-widget5">
                                    <?php
                                    foreach($questions['list'] as $question): ?>
                                    <div class="m-widget5__item">
                                        <div class="m-widget5__content">
                                            <div class="m-widget5__section">
                                                <h4 class="m-widget5__title">
                                                    <?php echo $question['issue_title']; ?>
                                                </h4>
                                                <span class="m-widget5__desc"><a href="<?php echo site_url('forums/question/'.$question['categoryUrlFriendlyName']); ?>" class="btn m-btn--pill btn-success btn-sm"><?php echo $question['categoryTitle']; ?></a></span>
                                                <div class="m-widget5__info">
                                                    <span class="m-widget5__author">Question By:</span>
                                                    <span class="m-widget5__info-author-name"><?php echo $question['username']; ?></span>
                                                    <span class="m-widget5__info-label">Asked:</span>
                                                    <span class="m-widget5__info-date m--font-info"><?php echo $question['issue_posted_on']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-widget5__content">
                                            <div class="m-widget5__stats1">
                                                <span class="m-widget5__number"><?php echo $question['totalViews']; ?></span><br>
                                                <span class="m-widget5__sales">Views</span>
                                            </div>
                                            <div class="m-widget5__stats2">
                                                <span class="m-widget5__number"><?php echo $question['totalAnswers'] ?></span><br>
                                                <span class="m-widget5__sales">Answers</span>
                                            </div>
                                            <div class="m-widget5__stats2">
                                                <span class="m-widget5__number"><?php echo $question['totalUpvotes']; ?></span><br>
                                                <span class="m-widget5__sales">Votes</span>
                                            </div>
                                        </div>

                                    </div>
                                    <?php endforeach; ?>
                                </div>
                    </div>
                </div>
            </div>
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
            <form action="<?php echo site_url('forums/questions'); ?>" class="m-form" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="m-scrollable m-scroller ps" data-scrollbar-shown="true" data-scrollable="true" data-height="400" >

                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">
                                <div class="form-group m-form__group">
                                    <label for="">Your Question</label>
                                    <input type="text" name="your_question" value="" class="form-control m-input" required>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="">Select Category</label>
                                    <select name="category" id="" class="form-control m-input" required>
                                        <option value="">Select</option>
                                        <?php if(count($categories)>0) { ?>
                                            <?php foreach($categories as $key => $list) { ?>
                                                <option value="<?php echo $list['id']?>"><?php echo $list['title']?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="">Attachments</label>
                                    <input type="file" name="attachments[]" value="" multiple="multiple" class="form-control m-input">
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="">Description</label>
                                    <textarea name="description" id="" cols="30" rows="10" class="form-control m-input wysihtml5"></textarea>
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