<div class="row">
    <div class="col-md-12">
        <!-- start of search part -->
        <div class="search">
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4"></div>
            </div>
        </div>
        <!-- end of search part -->
        <div class="candidates">
            <div class="row">
                <?php foreach($applied as $user): ?>
                    <div class="col-md-4">
                        <div class="candidate">
                            <img src="<?php echo getFileUrl($user['avatar']); ?>" alt="">
                            <div class="name"><?php echo $user['first_name'].' '.$user['last_name']; ?></div>
                            <div class="position"><?php echo $user['job_title']; ?></div>
                            <div class="expected-salary"><i class="fa fa-money"></i> <?php echo Modules::load('jobs')->getTitleBySlug($user['expected_salary'],'salary'); ?></div>
                            <div class="address"><i class="fa fa-map-marker"></i> <?php echo $user['address']; ?></div>
                            <a href="<?php echo site_url('profile/candidate/'.$user['id']); ?>" class="button">Quick View</a>
                            <div class="last-login"><?php echo time_elapsed_string(date('Y-m-d H:i:s', $user['last_login'])); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>