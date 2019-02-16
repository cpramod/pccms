<div class="row">
<?php 
$i=0;
foreach($jobs as $job){
    //print_r($job);
    ?>
    <div class="col-md-4 col-sd-6 col-xs-12">
        <div class="job-content">
            <div class="logo">
                <a href="<?php echo site_url('jobs/view/'.($job['slug']!=''?$job['slug']:$job['id'])); ?>"><img src="<?php echo $job['company_logo']?getFileUrl($job['company_logo']):getFileUrl($job['avatar']); ?>" alt="<?php echo $job['title']; ?>"></a>
            </div>
            <div class="content">
                <a href="<?php echo site_url('jobs/view/' . ($job['slug'] != '' ? $job['slug'] : $job['id'])); ?>"><div class="title"><?php echo $job['title']; ?></div></a>
                <div class="company">
                    <?php echo $job['company']?$job['company']:$job['main_company']; ?>
                </div>
                <div class="location">
                    <i class="fa fa-map-marker"></i>
                    <?php echo $job['address']; ?>
                </div>
                <div class="toolbar">
                    <ul>
                        <li><a href="<?php echo site_url('jobs/view/' . ($job['slug'] != '' ? $job['slug'] : $job['id'])); ?>"><i class="fa fa-clock-o"></i> <?php echo time_elapsed_string(date('Y-m-d H:i:s', $job['date'])); ?></a></li>
                        <!-- <li><a href="<?php //echo site_url('jobs/view/' . $job['id']); ?>"><i class="fa fa-money"></i> <?php //echo $job['offered_salary'] ? Modules::load('jobs')->getTitleBySlug($job['offered_salary'], 'salary') : 'Negotiable'; ?></a></li> -->
                        <li><a class="view <?php echo $job['job_type']; ?>" href="<?php echo site_url('jobs/view/' . ($job['slug'] != '' ? $job['slug'] : $job['id'])); ?>"><?php echo Modules::load('jobs')->getTitleBySlug($job['job_type'], 'job_type'); ?></a></li>
                        <!-- <li><a href="<?php //echo site_url('jobs/view/' . $job['id']); ?>" class="view">View</a></li> -->
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
            
        </div>
    </div>
    <?php
    $i++;
    if($i%3 ==0){
        echo '</div><div class="row">';
    }
}

?>
</div>