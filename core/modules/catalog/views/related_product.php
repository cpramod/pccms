<div class="row">
    <div class="col">
        <hr class="tall">

        <h4 class="mb-3 text-uppercase">Related <strong>Products</strong></h4>
        <div class="featured-boxes">
            <div class="row pt-2">
                <?php //print_r($related_products);

                foreach ($related_products as $product) {
                    ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="featured-box featured-box-primary featured-box-effect-1 mt-0 mt-lg-5">
                            <div class="box-content">
                                <img src="<?php echo getFileUrl($product->featured_image); ?>" alt="" class="icon-featured">
                                <h4 class="text-uppercase"><?php echo $product->title; ?></h4>
                                <p><?php echo substr($product->description,0,80); ?></p>
                                <p><a href="<?php echo site_url('catalog/'.$product->slug); ?>" class="lnk-primary learn-more">Learn More <i class="fas fa-angle-right"></i></a></p>
                            </div>

                        </div>
                    </div>

                    <?php
                }
                ?>

            </div>
        </div>

    </div>
</div>