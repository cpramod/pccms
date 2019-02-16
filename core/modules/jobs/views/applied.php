<div class="row">
<?php 
foreach ($jobs as $job) {
    ?>
    <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="job-content">
            <div class="logo">
                <a href="<?php echo site_url('jobs/view/' . $job['id']); ?>"><img src="<?php echo getFileUrl($job['avatar']); ?>"></a>
            </div>
            <div class="content">
                <a href="<?php echo site_url('jobs/view/' . $job['id']); ?>"><h2><?php echo $job['title']; ?></h2></a>
                <div class="company">
                    <i class="fa fa-bank"></i> <?php echo $job['company']; ?>
                </div>
                <div class="location">
                    <i class="fa fa-map-marker"></i>
                    <?php echo $job['address']; ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="toolbar">
                <ul>
                    <li><a href="<?php echo site_url('jobs/view/' . $job['id']); ?>"><i class="fa fa-clock-o"></i> <?php echo time_elapsed_string($job['date']); ?></a></li>
                    <li><a href="<?php echo site_url('jobs/view/' . $job['id']); ?>"><i class="fa fa-money"></i> <?php echo Modules::load('jobs')->getTitleBySlug($job['offered_salary'], 'salary'); ?></a></li>
                    <li><a href="<?php echo site_url('jobs/view/' . $job['id']); ?>"><i class="fa fa-hand-o-right"></i> <?php echo Modules::load('jobs')->getTitleBySlug($job['job_type'], 'job_type'); ?></a></li>
                    <li><a href="<?php echo site_url('jobs/view/' . $job['id']); ?>">View All</a></li>
                </ul>
            </div>
        </div>
        
        
    </div>
    <?php

}

?>
</div>