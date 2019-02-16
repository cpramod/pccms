<div class="row">
    
        <?php $this->load->view('partials/left-sidebar'); ?>
    
    <div class="col-md-6">
        <div class="breadcrumb">
            <ul>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <?php foreach ($template['breadcrumbs'] as $breadcrumb) { ?>
                    <li><a href="<?php echo $breadcrumb['uri']; ?>"><?php echo $breadcrumb['name']; ?></a></li>
                <?php } ?>
            </ul>
            
        </div>
        <div class="filter">
            <div class="col-md-6">
                <h2>Available Jobs (<?php echo $total; ?>)</h2>
            </div>
            <div class="col-md-4 pull-right">
                    <form action="<?php echo current_url(); ?>" method="GET">
                        <select name="order" id="order">
                            <option value="">Select Option</option>
                            <option value="desc">Date Descending</option>
                            <option value="asc">Date Ascending</option>

                        </select>
                    </form>
            </div>
            <div class="clearfix"></div>
            
            
        </div>
        <div class="job-list">
            <div class="row">
                <?php 
                if(count($jobs)>0){
                foreach ($jobs as $job) {
                    ?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="job-content">
                            <div class="logo">
                                <a href="<?php echo site_url('jobs/view/' . ($job['slug'] != '' ? $job['slug'] : $job['id'])); ?>"><img src="<?php echo $job['company_logo'] ? getFileUrl($job['company_logo']) : getFileUrl($job['avatar']); ?>"></a>
                            </div>
                            <div class="content">
                                <a href="<?php echo site_url('jobs/view/' . ($job['slug'] != '' ? $job['slug'] : $job['id'])); ?>"><div class="title"><?php echo $job['title']; ?></div></a>
                                <div class="company">
                                    <i class="fa fa-bank"></i> <?php echo $job['company'] ? $job['company'] : $job['main_company']; ?>
                                </div>
                                <div class="location">
                                    <i class="fa fa-map-marker"></i>
                                    <?php echo $job['address']; ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="toolbar">
                                <ul>
                                    <li><a href="<?php echo site_url('jobs/view/' . ($job['slug'] != '' ? $job['slug'] : $job['id'])); ?>"><i class="fa fa-clock-o"></i> <?php echo time_elapsed_string(date('Y-m-d H:i:s',$job['date'])); ?></a></li>
                                    <li><a href="<?php echo site_url('jobs/view/' . ($job['slug'] != '' ? $job['slug'] : $job['id'])); ?>"><i class="fa fa-money"></i> <?php echo $job['offered_salary']?Modules::load('jobs')->getTitleBySlug($job['offered_salary'], 'salary'):'Negotiable'; ?></a></li>
                                    <li><a class="view <?php echo $job['job_type']; ?>" href="<?php echo site_url('jobs/view/' . ($job['slug'] != '' ? $job['slug'] : $job['id'])); ?>"><?php echo Modules::load('jobs')->getTitleBySlug($job['job_type'], 'job_type'); ?></a></li>
                                    <?php if($job['deadline'] < strtotime(date('Y-m-d'))): ?>
                                        <li><a href="javascript:" class="expired">Expired</a></li>
                                        <?php else:?>
                                            <li><a href="<?php echo site_url('jobs/view'. ($job['slug'] != '' ? $job['slug'] : $job['id'])); ?>" class="view">View</a></li>
                                        <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        
                        
                    </div>
                    <?php

                }

                ?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php echo $pagination; ?>
                </div>
                <?php

                
            }else{
                echo '<h2>No Job found!</h2>';
            }

                ?>
                </div>
        </div>

    </div>

    <?php $this->load->view('partials/right-sidebar'); ?>

</div>