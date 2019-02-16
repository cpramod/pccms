<div id="add_experience" class="zoom-anim-dialog mfp-hide popup">
    <div class="small-dialog-header">
        <h3>Add Experience</h3>
    </div>
    <div class="sign-in-form style-1">
        <div class="tabs-container">
            <div class="tab-content">

                <form action="<?php echo site_url('profile/resume/experience/add'); ?>" method="POST">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Title *</label>
                                <input type="text" name="title" value="" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="from_date">From Date *</label>
                                <input type="text" name="from_date" value="" placeholder="Year of Start" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="to_date">To Date *</label>
                                <input type="text" name="to_date" value="" placeholder="Year of End" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="checkbox" name="present" value="1" class="form-control"> Present
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="company">Company *</label>
                                <input type="text" name="company" value="" class="form-control" required>
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
