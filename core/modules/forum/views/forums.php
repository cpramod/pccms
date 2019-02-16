<div class="forumbg">
    <?php 
    foreach($categories as $category){ ?>
    <div class="inner">
        <div class="forum_header">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <?php echo $category['title']; ?>
                </div>
                <div class="col-md-1 hidden-xs-down">Topics</div>
                <div class="col-md-1 hidden-xs-down">Posts</div>
                <div class="col-md-4 hidden-xs-down">Last post</div>
            </div>
        </div>
        <div class="forum_body">
            <?php 
            $forums = modules::load('forum')->getForums($category['id']); 
            ?>

<?php if (isset($forums) && !empty($forums)) {

    foreach ($forums as $Forum) {
        //print_r($Forum);
        ?>

            <a href="<?php echo site_url('forum/topics/'.$Forum->id); ?>">

                    <div class="item">
                        <div class="row">
                            <div class="col-md-6 topic-title">
                                <i class="fa fa-comment"></i>
                                <a class="title" href="<?php echo site_url('forum/topics/'.$Forum->id); ?>">
                                    <?php echo $Forum->title; ?>
                                </a>

                                <br>
                                <div class="additional hidden-xs-up">
                                    <span>Posts: <strong><?php echo $Forum->topics;?></strong></span>
                                    <span>Last Post: <strong><?php echo $Forum->posts;?></strong></span>
                                </div>
                            </div>
                            <div class="col-md-1 hidden-xs-down">
                                <?php
                                    echo $Forum->topics;
                                ?>
                            </div>
                            <div class="col-md-1 hidden-xs-down">
                                <?php
                                    echo $Forum->posts;
                                ?>
                            </div>
                            <div class="col-md-4 avatar hidden-xs-down">
                                <span>
                                    <?php if($Forum->lastPost): ?>
                                    by <a href="<?php echo site_url('profile/view/' . $Forum->lastPost['user_id']); ?>">
                                        <?php echo $Forum->lastPost['username']; ?>
                                    </a>
                                    <br>
                                    <?php echo ($Forum->lastPost['PostedOn']); ?>
                                    <?php endif; ?>
                                </span>

                            </div>
                        </div>
                    </div>



        <?php
    }
}
?>

        </div>
    </div>
    <?php } ?>
</div>


