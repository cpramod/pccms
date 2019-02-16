<div class="container">

    <div class="row">
        <div class="col-lg-9">
            <div class="blog-posts">

                <?php if ($posts): ?>
                    <?php foreach ($posts as $post): ?>

                        <article class="post post-large">
                            

                            <div class="post-date">
                                <span class="day"><?php echo date('d',strtotime($post->date_posted)); ?></span>
                                <span class="month"><?php echo date('M',strtotime($post->date_posted));?></span>
                            </div>

                            <div class="post-content">

                                <h2><a href="<?php echo site_url($post->url_title); ?>"><?php echo $post->title ?></a></h2>
                                <div class="post-image single">
                                <?php if($post->feature_image): ?>
                                    <img src="<?php echo is_numeric($post->feature_image)?getFileUrl($post->feature_image):$post->feature_image; ?>" class="img-thumbnail" alt="">
                                <?php endif ?>

                            </div>
                                <p><?php echo $post->excerpt ?>[..]</p>
                                <div class="post-meta">
                                    <span><i class="fas fa-user"></i> By <a href="<?php echo site_url('profile/view/'.$post->author); ?>"><?php echo $post->display_name ?></a> </span>
                                    <span><i class="fas fa-tag"></i> <?php if ($post->categories): ?>
                                            <?php foreach ($post->categories as $cat): ?>
                                                <a href="#"><?php echo $cat->name; ?></a> ,
                                            <?php endforeach ?>
                                        <?php endif ?>
                                        </span>
                                    <span><i class="fas fa-comments"></i> <?php echo $post->comment_count; ?> </span>
                                    <span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0"><a href="<?php echo site_url($post->url_title); ?>" class="btn btn-xs btn-primary">Read more...</a></span>
                                </div>

                            </div>
                        </article>


                    <?php endforeach ?>


                    <?php echo $pagination; ?>

                <?php else: ?>
                    <h3 class="text-center"><?= lang('no_posts_found') ?></h3>

                <?php endif ?>

            </div>
        </div>

        <?php include('sidebar.php'); ?>
    </div>

</div>



