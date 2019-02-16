<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="dashboard-list-box margin-top-0">
            <h4>
                <?php echo $template['title']; ?>
                <a href="<?php echo site_url('admin/catalog/add'); ?>" class="button pull-right">Add New
                </a>
            </h4>
            <ul>
                <li>

                    <?php 
                if (count($catalogs) > 0) {
                    ?>
                    <table class="basic-table">
                        <tr>
                            <th>#</th>
                            <th>Featured Image</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Slug</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                    $i = 0;
                    foreach ($catalogs as $catalog) : ?>
                        <tr>
                            <td>
                                <?php echo $catalog->id; ?>
                            </td>
                            <td><img src="<?php echo $catalog->featured_image ? getFileUrl($catalog->featured_image) : 'https://via.placeholder.com/80x80'; ?>"
                                    width="80"></td>
                            <td>
                                <?php echo $catalog->title; ?>
                            </td>
                            <td>
                                <?php echo $catalog->publish_date; ?>
                            </td>
                            <td>
                                <?php echo $catalog->slug; ?>
                            </td>

                            <td>
                                <?php if (count($catalog->categories) > 0) {
                                foreach ($catalog->categories as $cat) {
                                    echo $cat['title'] . ',';
                                }
                            } ?>
                            </td>
                            <td>
                                <span><a href="<?php echo site_url('admin/catalog/edit/' . $catalog->id); ?>" class="button gray"><i
                                            class="sl sl-icon-note"></i> Edit</a></span>
                                <a href="<?php echo site_url('admin/catalog/delete/' . $catalog->id); ?>" class="button gray"
                                    onclick="return confirm('Are you sure?');"><i class="sl sl-icon-close"></i> Delete</a>

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
