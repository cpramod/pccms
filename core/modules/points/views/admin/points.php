<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="dashboard-list-box margin-top-0">
            <h4>
                <?php echo $template['title']; ?>
                
            </h4>
            <ul>
                <li>
            
                <?php 
                if (count($users) > 0) {
                    ?>
                    <table class="basic-table">
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Total Points</th>
                    <th>Last Login</th>
                    <th>Action</th>
                </tr>
                    <?php
                    $i = 0;
                    foreach ($users as $user) : //print_r($category); ?>
                    <tr>
                        <td><?php echo ($i + 1); ?></td>
                        <td><?php echo $user->first_name.' '.$user->last_name; ?></td>
                        <td><?php echo $user->points; ?></td>
                        <td><?php echo date('Y-m-d H:i:s',$user->last_login); ?></td>
                        <td><a href="<?php echo site_url('admin/points/view/'.$user->id); ?>" class="button grey">View</a></td>
                    </tr>
                <?php $i++;
                endforeach; ?>
                </table>
                <?php 
                echo $pagination;
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
