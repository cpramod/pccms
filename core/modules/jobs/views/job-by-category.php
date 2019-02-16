<div class="row">
    <?php $i=0; foreach($categories as $category): ?>
        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
            <a href="<?php echo site_url('jobs/index/'.$category['slug']); ?>">
                <div class="img-holder">
                    <i class="<?php echo $category['icon']; ?>"></i>
                </div>
            </a>
            <div class="text-holder">
                <a href="<?php echo site_url('jobs/index/' . $category['slug']); ?>"><?php echo $category['title']; ?></a>
                <span></span>
            </div>
        </div>
        <?php 
            $i++;
            if($i%6 == 0){
                ?>
                <div class="clearfix"></div>
                <?php
            } 
        ?>
        
    <?php endforeach; ?>
</div>