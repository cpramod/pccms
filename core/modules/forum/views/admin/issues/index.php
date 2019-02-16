<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="dashboard-list-box margin-top-0">
            <h4>
                <?php echo $template['title']; ?>
                
            </h4>
            <ul>
                <li>
            
                <?php 
                if (count($topics) > 0) {
                    ?>
                    <table class="basic-table">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                    <?php
                    $i = 0;
                    foreach ($topics as $category) : //print_r($category); ?>
                    <tr>
                        <td><?php echo $category['id']; ?></td>
                        <td><?php echo $category['title']; ?></td>
                        <td><?php echo $category['url_friendly_name']; ?></td>
                        <td><?php echo substr($category['description'],0,100).'...'; ?></td>
                        <td><?php echo $category['category_title']; ?></td>
                        <td>
                            <?php if($category['is_announcement'] == 0){?>
                                <a href="<?php echo site_url('admin/forum/addToAnnouncement/'.$category['id']); ?>" class="button gray"> <i class="fa fa-arrow-circle-right"></i> Mark as Announcement</a>
                            <?php }else{
                                ?>
                                <a href="<?php echo site_url('admin/forum/removeFromAnnouncement/' . $category['id']); ?>" class="button red"> <i class="fa fa-arrow-circle-right"></i> Remove as Announcement</a>
                                <?php
                            } ?>
                            
                            <a href="<?php echo site_url('admin/forum/view/' . $category['id']); ?>" class="button gray"><i class="fa fa-arrow-circle-right"></i> View</a>
                            <a onclick="return confirm('Are you sure?');" href="<?php echo site_url('admin/forum/delete/' . $category['id']); ?>" class="button gray"><i class="sl sl-icon-close"></i> Delete</a>
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
