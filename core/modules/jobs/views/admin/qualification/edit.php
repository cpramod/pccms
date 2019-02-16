<div class="row flex-row">
    <div class="col-12">
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4></h4>
            </div>
            <div class="widget-body">
                <form class="form-horizontal" action="<?php echo current_url(); ?>" method="POST">
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label">Title</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="title" value="<?php echo set_value('title', $title); ?>">
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label">Status</label>
                        <div class="col-lg-9">
                            <select name="status" class="form-control" id="">
                                <option value="1" <?php echo $status==1?'selected':''; ?>>Enable</option>
                                <option value="0" <?php echo $status == 0 ? 'selected' : ''; ?>>Disable</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-gradient-01" type="submit">Save</button>
                        <button class="btn btn-shadow" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>