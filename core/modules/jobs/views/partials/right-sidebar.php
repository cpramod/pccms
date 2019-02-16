<div class="col-md-3 right">
    <h3>Featured Jobs</h3>
    <div class="sidebar">
        <?php foreach($featured as $feature){ //print_r($feature); ?>
            <div class="feature">
                <div class="type"><?php echo Modules::load('jobs')->getTitleBySlug($feature['job_type'], 'job_type'); ?></div>
                <h4><a href="<?php echo site_url('jobs/view/'.$feature['id']); ?>"><?php echo $feature['title']; ?></a></h4>
                <div class="meta"><i class="fa fa-bank"></i> <?php echo $feature['main_company']?$feature['main_company']:$feature['company']; ?></div>
                <div class="meta"><i class="fa fa-map-marker"></i> <?php echo $feature['address']; ?></div>
                <div class="meta"><i class="fa fa-clock-o"></i> <?php echo date('M d, Y',$feature['date']); ?></div>
                <div class="meta"><i class="fa fa-money"></i> <?php echo Modules::load('jobs')->getTitleBySlug($feature['offered_salary'],'salary'); ?></div>
            </div>
        <?php } ?>
    </div>
</div>