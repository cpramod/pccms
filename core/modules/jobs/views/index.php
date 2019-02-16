<div class="row">
    <div class="col-md-12">
        <h3>Jobs</h3>
        <div class="row">
            <table class="basic-table">
                <tr>
                    <th>#</th>
                    <th>Job Title</th>
                    <th>Posted Date</th>
                    <th>Deadline</th>
                    <th>Users Applied</th>
                    <th>Views</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                
                    <?php 
                    //print_r($jobs);
                    $i=1;
                    foreach($jobs as $job):  ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $job['title']; ?></td>
                        <td><?php echo date('Y-m-d H:i:s',$job['date']); ?></td>
                        <td><?php echo date('Y-m-d',$job['deadline']); ?></td>
                        <td><?php echo $job['applied']; ?><br><a class="job-status resume" href="<?php echo site_url('jobs/resume/'.$job['id']); ?>">View users</a></td>
                        <td><?php echo $job['views']; ?></td>
                        <td><?php
                        $package = $job['package'];
                        if($package == 1){
                            $package_day = config('basic');
                        }elseif($package == 2){
                            $package_day = config('extended');
                        }elseif($package == 3){
                            $package_day = config('professional');
                        }elseif($package == 0){
                            $package_day = config('newspaper');
                        }


                        
                        if($job['status'] == 0){
                            echo '<span class="job-status draft">Draft</span>';
                        }elseif($job['status'] == 1){
                            echo '<span class="job-status processing">Processing</span>';
                        }elseif($job['date'] < strtotime(date('Y-m-d H:i:s',strtotime('-'.$package_day.' days')))){
                            echo '<span class="job-status expired">Package Expired</span>';
                        }elseif ($job['deadline'] <= strtotime(date('Y-m-d'))) {
                            echo '<span class="job-status expired">Expired</span>';
                        }elseif($job['status'] == 2){
                            echo '<span class="job-status live">Live</span>';
                        } ?></td>
                        <td>
                            <!-- allow to edit the job post which is not published -->
                            <?php if($job['status'] == 0){ ?>
                                <a class="button" href="<?php echo site_url('jobs/post/'.$job['id'].'/1'); ?>">Edit</a>
                            <?php } ?>
                            <!-- end of edit job script -->

                            <a target="_blank" class="button" href="<?php echo site_url('jobs/view/'. ($job['slug'] != '' ? $job['slug'] : $job['id'])); ?>?preview=1">Preview</a>
                            <?php if($this->ion_auth->is_admin()){
                                if($job['status'] == 2){
                                    ?>
                                    <a href="<?php echo site_url('jobs/deapprove/' . $job['id']); ?>" class="button">Disable</a>
                                    <?php
                                }elseif($job['status'] == 1){
                                    ?>
                                    <a href="<?php echo site_url('jobs/approve/' . $job['id']); ?>" class="button">Approve</a>
                                    <?php
                                }
                            } ?>
                        </td>
                    </tr>
                    <?php $i++; endforeach; ?>
                
            </table>
            <?php echo $pagination; ?>
        </div>
    </div>
</div>