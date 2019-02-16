<div class="row">
    <div class="col">
        <hr class="tall">
    </div>
</div>

<div class="row">
    <div class="col-lg-6">

        <div class="owl-carousel owl-theme" data-plugin-options="{'items': 1}">
            <div>
                <div class="thumbnail">
                    <?php if ($featured_image): ?>
                        <img alt="" class="img-fluid border rounded" src="<?php echo getFileUrl($featured_image); ?>">
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>

    <div class="col-lg-6">

        <div class="summary entry-summary">

            <h1 class="mb-0"><strong><?php echo $title; ?></strong></h1>

            <div class="">
                <!--                    <span class="count" itemprop="ratingCount">-->
                <?php //echo count($reviews); ?><!--</span> reviews-->
            </div>


            <!--                <p class="price">-->
            <!--                    <span class="amount">$22</span>-->
            <!--                </p>-->

            <p class="mb-4"><?php echo $description; ?></p>

            <h4 class="heading-primary">Additional Information</h4>
            <table class="table mt-5">
                <tbody>
                <?php foreach ($metas as $meta) {
                    echo '<tr><td><strong>' . $meta->meta_key . '</strong></td><td>' . $meta->meta_value . '</td></tr>';
                } ?>
                </tbody>
            </table>


            <div class="product_meta">
                <?php // print_r($categories); ?>
                <span class="posted_in">Categories:
                    <?php foreach ($categories as $category) {
                        echo '<a href="' . site_url("catalog/category/" . $category["slug"]) . '" rel="tag">' . $category["title"] . '</a>,';
                    } ?>
                    .</span>
            </div>

        </div>


    </div>
</div>

<hr class="tall">

<!-- review -->
<?php echo $this->load->view('review',true); ?>

<?php echo $this->load->view('related_product',true); ?>

<?php echo js('bootstrap-rating-input.js'); ?>