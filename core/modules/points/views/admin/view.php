<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="dashboard-list-box margin-top-0">
            <h4>
                <?php echo $template['title']; ?>
                
            </h4>
            <ul>
                <li>
            
                <?php 
                if (count($points) > 0) {
                    ?>
                    <table class="basic-table">
                <tr>
                    <th>#</th>
                    <th>Activity</th>
                    <th>IP Address</th>
                    <th>Base Point</th>
                    <th>Multiplier</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                    <?php
                    $i = 0;
                    foreach ($points as $point) : //print_r($category); ?>
                    <tr>
                        <td><?php echo ($i + 1); ?></td>
                        <td><?php echo $point->activity_name; ?></td>
                        <td><?php echo $point->ip; ?></td>
                        <td><?php echo $point->base_point; ?></td>
                        <td><?php echo $point->multiplier; ?></td>
                        <td><?php echo $point->created_datetime; ?></td>
                        <td>
                            <a href="<?php echo site_url('admin/points/edit/'.$point->id); ?>" class="button red">Edit</a>
                            <a onclick="return confirm('Are you sure?');" href="<?php echo site_url('admin/points/delete/' .$user.'/'. $id); ?>" class="button grey">Delete</a></td>
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
