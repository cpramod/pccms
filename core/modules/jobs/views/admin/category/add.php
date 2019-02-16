<div class="row flex-row">
    <div class="col-12">
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4></h4>
            </div>
            <div class="widget-body">
                <form class="form-horizontal" action="<?php echo current_url();?>" method="POST">
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label">Title</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="title" value="<?php echo set_value('title'); ?>">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label">Slug</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="slug" value="<?php echo set_value('slug');?>">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label">Description</label>
                        <div class="col-lg-9">
                            <textarea name="description" class="form-control summernote"><?php echo set_value('description'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label">Icon</label>
                        <div class="col-lg-9">
                            <input type="text" name="icon" value="<?php echo set_value('icon'); ?>" class="form-control">
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