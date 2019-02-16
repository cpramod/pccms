<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="dashboard-list-box margin-top-0">
            <h4>
                <?php echo $template['title']; ?>
                <a href="<?php echo site_url('admin/forum/forums_add'); ?>" class="button pull-right">Add New
                    </a>
            </h4>
            <ul>
                <li>
            
                <?php 
                if (count($forums) > 0) {
                    ?>
                    <table class="basic-table">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Priority</th>
                    <th>Action</th>
                </tr>
                    <?php
                    $i = 0;
                    foreach ($forums as $forum) : //print_r($category); ?>
                    <tr>
                        <td><?php echo $forum->id; ?></td>
                        <td><?php echo $forum->title; ?></td>
                        <td><?php echo $forum->slug; ?></td>
                        <td><?php echo $forum->sort_order; ?></td>
                        <td>
                            <a href="<?php echo site_url('admin/forum/forums_edit/' . $forum->id); ?>" class="button gray"><i class="sl sl-icon-note"></i> Edit</a>
                            <a onclick="return confirm('Are you sure?');" href="<?php echo site_url('admin/forum/forums_delete/' . $forum->id); ?>" class="button gray"><i class="sl sl-icon-close"></i> Delete</a>
                        </td>
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
