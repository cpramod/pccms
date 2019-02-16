<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="dashboard-list-box margin-top-0">
            <h4>
                <?php echo $template['title']; ?>
                <a href="<?php echo site_url('admin/blog/addPost'); ?>" class="button pull-right">Add New
                    Post</a>
            </h4>
            <ul>
                <li>
            
                <?php 
                if (count($posts) > 0) {
                    ?>
                    <table class="basic-table">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Author</th>
                    <th>Categories</th>
                    <th>Comments</th>
                    <th>Actions</th>
                </tr>
                    <?php
                    $i = 0;
                    foreach ($posts as $post) : //print_r($post); ?>
                    <tr>
                        <td><?php echo $post->id; ?></td>
                        <td><?php echo $post->title; ?></td>
                        <td><?php echo $post->date_posted; ?></td>
                        <td><?php $user = user($post->author); echo $user->first_name.' '.$user->last_name; ?></td>
                        <td><?php $i=1; foreach($post->category as $category){ 
                            echo $category->name; 
                            if($i<count($post->category)){
                                echo ',';
                            }
                            $i++;

                            } ?></td>
                        <td><?php echo countComments($post->id); ?></td>
                        <td>
                            <a target="_blank" href="<?php echo site_url($post->url_title); ?>" class="button gray"><i class="fa fa-arrow-circle-right"></i> Preview</a>
                            <a href="<?php echo site_url('admin/blog/edit/' . $post->id); ?>" class="button gray"><i class="sl sl-icon-note"></i> Edit</a>
                            <a onclick="return confirm('Are you sure?');" href="<?php echo site_url('admin/blog/delete/' . $post->id); ?>" class="button gray"><i class="sl sl-icon-close"></i> Delete</a>
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


