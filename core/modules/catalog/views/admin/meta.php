<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3></h3>
            </div>
        </div>

        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="<?php echo site_url('admin/catalog/add_meta'); ?>" class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--air">
                    <span>
                        <i class="la la-plus"></i>
                        <span>Add Meta</span>
                    </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="m-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
            <thead>
            <tr>
                <th>#</th>
                <th>Key</th>
                <th>Value</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $i=0;

            foreach($categories as $category){
                ?>
                <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $category->title; ?></td>
                    <td><?php echo $category->description; ?></td>
                    <td><?php echo $category->slug; ?></td>
                    <td></td>
                    <td nowrap>
                        <span><a class="m-badge  m-badge--success m-badge--wide" href="<?php echo site_url('admin/catalog/edit_category/'.$category->id); ?>">Edit</a></span>
                        <span><a class="m-badge  m-badge--danger m-badge--wide" href="<?php echo site_url('admin/catalog/delete_category/'.$category->id); ?>" onclick="return confirm('Are you sure?');">Delete</a></span>

                    </td>
                </tr>

                <?php
                $i++;
            }

            ?>


            </tbody>
        </table>

    </div>

</div>