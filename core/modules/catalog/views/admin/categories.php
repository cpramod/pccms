<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="dashboard-list-box margin-top-0">
            <h4>
                <?php echo $template['title']; ?>
                <a href="<?php echo site_url('admin/catalog/add_categories'); ?>" class="button pull-right">Add New
                    Category</a>
            </h4>
            <ul>
                <li>

                    <?php 
                if (count($categories) > 0) {
                    ?>
                    <table class="basic-table">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Slug</th>
                            <th>Count</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php

            $i = 0;

            foreach ($categories as $category) {
                ?>
                            <tr>
                                <td>
                                    <?php echo $category->id; ?>
                                </td>
                                <td>
                                    <?php echo $category->title; ?>
                                </td>
                                <td>
                                    <?php echo $category->description; ?>
                                </td>
                                <td>
                                    <?php echo $category->slug; ?>
                                </td>
                                <td></td>
                                <td nowrap>
                                    <span><a class="button gray" href="<?php echo site_url('admin/catalog/edit_category/' . $category->id); ?>">
                                            <i class="sl sl-icon-note"></i>Edit</a></span>
                                    <span><a class="button gray" href="<?php echo site_url('admin/catalog/delete_category/' . $category->id); ?>"
                                            onclick="return confirm('Are you sure?');"> <i class="sl sl-icon-close"></i>
                                            Delete</a></span>

                                </td>
                            </tr>

                            <?php
                $i++;
            }

            ?>

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
