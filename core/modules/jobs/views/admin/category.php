<div class="row">
    <div class="col-xl-12">
        <!-- Default -->
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4><?php echo $template['title']; ?></h4>
                <a href="<?php echo site_url('admin/jobs/category_add'); ?>" class="btn btn-primary mr-1 mb-2 pull-right">Add New</a>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Icon</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($categories as $category): ?>
                            <tr>
                                <td><span class="text-primary"><?php echo $category['id']; ?></span></td>
                                <td><?php echo $category['title']; ?></td>
                                <td><?php echo $category['slug']; ?></td>
                                <td><?php echo $category['icon']?$category['icon']:''; ?></td>
                                <td class="td-actions">
                                    <a href="<?php echo site_url('admin/jobs/category_edit/'.$category['id']); ?>"><i class="la la-edit edit"></i></a>
                                    <a onclick="return confirm('Are you sure?');" href="<?php echo site_url('admin/jobs/category_delete/' . $category['id']); ?>"><i class="la la-close delete"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Default -->
    </div>
</div>
