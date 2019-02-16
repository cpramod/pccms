<?php if($msg=$this->session->flashdata('success')): ?>
    <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30">
        <div class="m-alert__icon">
            <i class="flaticon-exclamation m--font-brand"></i>
        </div>
        <div class="m-alert__text">
            <?php echo $msg; ?>
        </div>
    </div>
<?php elseif($msg=$this->session->flashdata('error')):?>
    <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30">
        <div class="m-alert__icon">
            <i class="flaticon-exclamation m--font-brand"></i>
        </div>
        <div class="m-alert__text">

        </div>
    </div>
<?php endif; ?>

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
                    <a href="<?php echo site_url('admin/blog/add_tags'); ?>" class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--air">
                    <span>
                        <i class="la la-plus"></i>
                        <span>Add Tags</span>
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
                <th>Name</th>
                <th>Description</th>
                <th>Slug</th>
                <th>Count</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $i=0;

            foreach($tags as $tag){
                ?>
                <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $tag['name']; ?></td>
                    <td><?php echo $tag['description']; ?></td>
                    <td><?php echo $tag['slug']; ?></td>
                    <td></td>
                    <td nowrap>
                        <span><a class="m-badge  m-badge--success m-badge--wide" href="<?php echo site_url('admin/blog/tag/edit/'.$tag['id']); ?>">Edit</a></span>
                        <span><a class="m-badge  m-badge--danger m-badge--wide" href="<?php echo site_url('admin/blog/tag/delete/'.$tag['id']); ?>" onclick="return confirm('Are you sure?');">Delete</a></span>

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