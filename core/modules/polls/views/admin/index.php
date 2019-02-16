<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="dashboard-list-box margin-top-0">
            <h4>
                <?php echo $template['title']; ?>
                <a href="<?php echo site_url('admin/polls/add'); ?>" class="button pull-right">Add New
                    </a>
            </h4>
            <ul>
                <li>
            
                <?php 
                if (count($polls) > 0) {
                    ?>
                    <table class="basic-table">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Created Date</th>                    
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                    <?php
                    $i = 0;
                    foreach ($polls as $poll) : //print_r($category); ?>
                    <tr>
                        <td><?php echo $poll->poll_id; ?></td>
                        <td><?php echo $poll->title; ?></td>
                        <td><?php echo $poll->created; ?></td>
                       
                        <td><?php echo $poll->closed==0?'Active':'Closed'; ?></td>
                        <td>
                            <?php if($poll->closed==1){
                                ?>
                                <a href="<?php echo site_url('admin/polls/open/' . $poll->poll_id); ?>" class="button gray"><i class="sl sl-icon-note"></i> Open</a>
                                <?php
                            }else{ ?>
                            <a href="<?php echo site_url('admin/polls/close/' . $poll->poll_id); ?>" class="button gray"><i class="sl sl-icon-note"></i> Close</a>
                            <?php } ?>
                            <a href="<?php echo site_url('admin/polls/edit/' . $poll->poll_id); ?>" class="button gray"><i class="sl sl-icon-note"></i> Edit</a>
                            <a onclick="return confirm('Are you sure?');" href="<?php echo site_url('admin/polls/delete/' . $poll->poll_id); ?>" class="button gray"><i class="sl sl-icon-close"></i> Delete</a>
                        </td>
                    </tr>
                <?php $i++;
                endforeach; ?>
                </table>
                <?php echo $pagination; ?>
                <?php 
            } else {
                ?>
                <li>
                    <div class="list-box-listing">
                        <h3>No Record Found!</h3>
                    </div>
                </li>
                <?php

            } ?>
                
                </li>
            </ul>
        </div>
    </div>
</div>
