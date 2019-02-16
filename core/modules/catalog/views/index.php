    <h2>Our <strong>Catalog</strong></h2>

    <div class="row align-items-center">
        <div class="col-lg-10">
            <p class="lead">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla non pulvinar. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut eu risus enim, ut pulvinar lectus. Sed hendrerit nibh metus.
            </p>
        </div>

    </div>

    <hr>

    <div class="featured-boxes">
        <div class="row">
            <?php if(count($catalogs)>0){
                foreach($catalogs as $catalog){
                    ?>

                    <div class="col-lg-3 col-sm-6">
                        <div class="featured-box featured-box-primary featured-box-effect-1 mt-0 mt-lg-5">
                            <div class="box-content">
                                <?php if($catalog->featured_image): ?>

                                <img class="icon-featured" src="<?php echo getFileUrl($catalog->featured_image); ?>" width="100%" alt="">

                        <?php endif; ?>
                                <h4 class="text-uppercase"><?php echo $catalog->title; ?></h4>
                                <p><?php echo substr($catalog->description, 0, 80); ?></p>
                                <p><a href="<?php echo site_url('catalog/'.$catalog->slug); ?>" class="lnk-primary learn-more">Learn More <i class="fas fa-angle-right"></i></a></p>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            }

            ?>

        </div>
    </div>

