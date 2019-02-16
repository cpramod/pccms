<div class="gradient <?php echo $banner?'with-banner':''; ?>" id="titlebar" style="background-image:url(<?php echo $banner?getFileUrl($banner):img('banners/dream.jpg',true); ?>);">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1><?php echo $title; ?></h1>
                <div class="toolbar">
                    <ul>
                        <li><i class="fa fa-map-marker"></i> <?php echo $address; ?></li>
                        <li><i class="fa fa-hand-o-right"></i> <?php echo Modules::load('jobs')->getTitleBySlug($job_type, 'job_type'); ?></li>
                        <li><i class="fa fa-clock-o"></i> <?php echo time_elapsed_string(date('Y-m-d H:i:s',$date)); ?></li>
                        <li><i class="fa fa-eye"></i> <?php echo count($views); ?></li>
                        <li><i class="fa fa-money"></i> <?php echo $offered_salary?Modules::load('jobs')->getTitleBySlug($offered_salary, 'salary'):'Negotiable'; ?></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">

            <?php if($package ==0){
                if(!empty($apply_link)){
                    ?>
                    <a href="<?php echo $apply_link; ?>" class="button" target="_blank">Apply Now</a>
                    <?php
                    }
            }else{ ?>
            <!-- when user is not logged in -->
                <?php if(!$this->ion_auth->logged_in()){
                    ?>
                    <a href="#sign-in-dialog" class="button sign-in popup-with-zoom-anim">Apply Now</a>
                    <?php

                }else{

                    // logged in user 
                    
                    // only candidate can apply
                    if ($groups['id'] == 2) {
                            if (count($applied) > 0) {
                                ?>
                                    <a href="javascript:" class="button red">Applied</a>
                                <?php
                                
                            }elseif(!empty($apply_link)){?>
                                <a href="<?php echo $apply_link; ?>" class="button" target="_blank">Apply Now</a>
                            <?php
                            
                            }
                            else {
                        ?>
                            <a href="<?php echo site_url('jobs/apply/' . $id); ?>" class="button">Apply Now</a>
                        <?php

                            }

                } else {

                    // if it's not candidate show message
                    ?>
                        <a href="javascript:" class="button red">Only candidate can apply</a>
                        <?php

                    } ?>

                    <?php
                }
             } ?>
                
                
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="job-info">
                <h3>Job Information</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">Specialism <br><strong><?php echo Modules::load('jobs')->getTitleBySlug($job_category, 'job_category'); ?></strong></div>
                            <div class="col-md-4">Gender <br><strong><?php echo Modules::load('jobs')->getTitleBySlug($gender, 'gender'); ?></strong></div>
                            <div class="col-md-4">Posted On <br><strong><?php echo date('M d, Y',$date); ?></strong></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">No. Of Openings <br><strong><?php echo $no_of_vacancy; ?></strong></div>
                            <div class="col-md-4">Job Type <br><strong><?php echo Modules::load('jobs')->getTitleBySlug($job_type,'job_type'); ?></strong></div>
                            <div class="col-md-4">Job Experience <br><strong><?php echo Modules::load('jobs')->getTitleBySlug($experience,'experience'); ?></strong></div>
                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="job-description">
                <h3>Job Description</h3>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $description; ?>
                    </div>
                </div>
                
            </div>
            <div class="job-specification">
                <h3>Job Specification</h3>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $specification; ?>
                    </div>
                </div>
                
            </div>
            <div class="job-skills">
                <h3>Skills</h3>
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                        <?php $skills = explode(',', $skills);
                        foreach ($skills as $skill) {
                            echo '<li>' . $skill . '</li>';
                        }
                        ?>
                        </ul>
                    </div>
                </div>
                
            </div>

        </div>
        <div class="col-md-3">
            <?php if($deadline < strtotime(date('Y-m-d H:i:s'))): ?>
            <div class="deadline expired">
                <i class="im im-icon-Stopwatch"></i>
                <span><strong>Job is Expired!</strong></span>
                
            </div>

                    <?php else: ?>
            <div class="deadline">
                <i class="im im-icon-Stopwatch"></i>
                <span>Deadline <br> <strong><?php echo date('M d, Y', $deadline); ?></strong></span>
                
            </div>

                    <?php endif; ?>

            <div class="company-profile">
                <div class="logo">
                    <img src="<?php echo $company_logo?getFileUrl($company_logo): getFileUrl($avatar); ?>">
                </div>
                <h2><?php echo $company?$company:$main_company; ?></h2>
                
                <?php if($package == 0): ?>
                    <a href="javascript:" class="button">View Profile</a>
                <?php else: ?>
                    <?php if (!empty($website)) {
                        ?>
                        <a href="<?php echo $website; ?>" class="link" target="_blank">Visit Website</a>
                        <?php

                    } ?>
                    <a href="<?php echo site_url('profile/employer/' . $user_id); ?>" class="button">View Profile</a>
                <?php endif; ?>
            </div>
            <div class="search">
                <h3>Featured Jobs</h3>
                <div class="sidebar">
                    <?php foreach ($featured as $feature) { //print_r($feature); ?>
                        <div class="feature">
                            <div class="type"><?php echo Modules::load('jobs')->getTitleBySlug($feature['job_type'], 'job_type'); ?></div>
                            <h4><a href="<?php echo site_url('jobs/view/' . $feature['id']); ?>"><?php echo $feature['title']; ?></a></h4>
                            <div class="meta"><i class="fa fa-map-marker"></i> <?php echo $feature['address']; ?></div>
                            <div class="meta"><i class="fa fa-clock-o"></i> <?php echo date('M d, Y', $feature['date']); ?></div>
                            <div class="meta"><i class="fa fa-money"></i> <?php echo Modules::load('jobs')->getTitleBySlug($feature['offered_salary'], 'salary'); ?></div>
                        </div>
                    <?php 
                } ?>
                </div>
            </div>
            
        </div>
    </div>
</div>
<div class="related">
    <div class="container">
        <div class="row">
            <div class="col-md-12"><h3>Related Jobs</h3></div>
            <?php foreach($related as $job){
                ?>
                <div class="col-md-4 col-sd-6 col-xs-12">
                    <div class="job-content">
                        <div class="logo">
                            <a href="<?php echo site_url('jobs/view/' . ($job['slug'] != '' ? $job['slug'] : $job['id'])); ?>"><img src="<?php echo $job['company_logo'] ? getFileUrl($job['company_logo']) : getFileUrl($job['avatar']); ?>" alt="<?php echo $job['title']; ?>"></a>
                        </div>
                        <div class="content">
                            <a href="<?php echo site_url('jobs/view/' . ($job['slug'] != '' ? $job['slug'] : $job['id'])); ?>"><div class="title"><?php echo $job['title']; ?></div></a>
                            <div class="company">
                                <?php echo $job['company'] ? $job['company'] : $job['main_company']; ?>
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
            } ?>
        </div>
    </div>
</div>