<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Review List
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">

        </div>
    </div>
    <div class="m-portlet__body">
        <div id="m_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row">
                <div class="col-sm-12">
                    <table role="grid" id="m_table_1" class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline collapsed">
                        <thead>
                        <tr role="row">
                            <th class="dt-right sorting_disabled" rowspan="1" colspan="1" style="width: 30.5px;" aria-label="Record ID">
                                <label for="" class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">
                                    <span></span>
                                </label>
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="m_table_1" rowspan="1" colspan="1" width="width: 38.25px;" aria-sort="descending" aria-label="Order ID: activate to sort column ascending">
                                Author
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="m_table_1" rowspan="1" colspan="1" width="width: 38.25px;" aria-sort="descending" aria-label="Order ID: activate to sort column ascending">
                                Review
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="m_table_1" rowspan="1" colspan="1" width="width: 38.25px;" aria-sort="descending" aria-label="Order ID: activate to sort column ascending">
                                In Response To
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="m_table_1" rowspan="1" colspan="1" width="width: 38.25px;" aria-sort="descending" aria-label="Order ID: activate to sort column ascending">
                                Submitted On
                            </th>
                            <th class="sorting_disabled" tabindex="0" rowspan="1" colspan="1" width="" aria-sort="descending" aria-label="Action">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach($reviews as $review) : ?>

                            <tr role="row" class="odd">
                                <td class=" dt-right" tabindex="0" style></td>
                                <td><?php echo $review->name; ?></td>
                                <td><?php echo $review->description; ?></td>
                                <td><a target="_blank" href="<?php echo site_url('catalog/'.$review->catalog); ?>"><?php echo $review->catalog; ?></a></td>
                                <td><?php echo Date('Y-m-d',strtotime($review->date)) .' at '.Date('H:i', strtotime($review->date)); ?></td>

                                <td>
                                    <?php if($review->status==1): ?>
                                        <span><a href="javascript:" class="m-badge  m-badge--success m-badge--wide">Approved</a></span>
                                    <?php else:?>
                                        <span><a href="<?php echo base_url(); ?>admin/catalog/review_approve/<?php echo $review->id; ?>" class="m-badge  m-badge--primary m-badge--wide">Approve</a></span>
                                    <?php endif; ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
