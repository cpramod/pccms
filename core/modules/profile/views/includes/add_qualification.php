<div id="add_education" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>Add Education</h3>
    </div>
    <div class="sign-in-form style-1">
        <div class="tabs-container">
            <div class="tab-content">

                <form action="<?php echo site_url('profile/resume/education/add'); ?>" method="POST">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Title *</label>
                                <input type="text" name="title" value="" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="from_date">From Date *</label>
                                <input type="text" name="from_date" value="" placeholder="Year of Start" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="to_date">To Date *</label>
                                <input type="text" name="to_date" value="" placeholder="Year of End" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="institute">Institute *</label>
                                <input type="text" name="institute" value="" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control summernote" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-control">
                                <input type="submit" name="submit" value="Save" class="btn btn-primary btn-lg pull-right">
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>

</div>
