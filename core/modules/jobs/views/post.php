<div class="row">
    <div class="col-lg-12">
        <h3>Post Job</h3>
        <form method="post" action="<?php echo current_url(); ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="step-container">
                    <div class="step-wizard">
                        <div class="progress">
                            <div class="progressbar" style="width: 33.3333%;"></div>
                        </div>
                        <ul class="nav">
                            <li>
                                <a href="" class="active show">
                                    <span class="step"><i class="fa fa-suitcase"></i></span>
                                    <span class="title">Job Details</span>
                                </a>
                            </li>
                            <li>
                                <a href="" class="show">
                                    <span class="step"><i class="fa fa-credit-card-alt"></i></span>
                                    <span class="title">Package & Payments</span>
                                </a>
                            </li>
                            <li>
                                <a href="" class="show">
                                    <span class="step"><i class="fa fa-check-circle"></i></span>
                                    <span class="title">Confirmation</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
            <div class="form-group">
                <div class="edit-profile-photo avatar">
                    <img src="<?php echo $banner?getFileUrl($banner):img('banners/dream.jpg',true); ?>" width="240">
                    <div class="change-photo-btn">
                        <div class="photoUpload">
                            <span>
                                <i class="fa fa-upload"></i>
                                Upload Job Banner
                            </span>
                            <input type="file" id="file" class="upload">
                            <input type="hidden" name="banner" class="profile_pic" value="">
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">Job Title</label>
                    <input type="text" name="title" value="<?php echo set_value('title', $title); ?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">Job Description</label>
                    <textarea name="description" cols="10" rows="30" class="form-control summernote"><?php echo set_value('description', $description); ?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">Job Specification</label>
                    <textarea name="specification" cols="10" rows="30" class="form-control summernote"><?php echo set_value('specification', $specification); ?></textarea>
                </div>
            </div>
        </div>
        <h4>Job Options</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="job_type">Job Type</label>
                    <?php 
                    
                    echo form_dropdown('job_type', toAssociative($job_types), $job_type,array('class'=> 'chosen-select-no-single'));
                     ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="specialism">Specialism</label>
                    <?php 
                    echo form_dropdown('job_category', toAssociative($specialisms), $job_category, array('class' => 'chosen-select-no-single'));
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="offered_salary">Offered Salary</label>
                    <?php 
                    $salary = array('' => 'Negotiable');
                    foreach ($salaries as $ary) {
                        $salary[$ary['slug']] = $ary['title'];
                    }

                    echo form_dropdown('offered_salary', $salary , $offered_salary, array('class' => 'chosen-select-no-single'));
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="career_level">Career Level</label>
                    <?php 
                    echo form_dropdown('career_level', toAssociative($levels), $career_level, array('class' => 'chosen-select-no-single'));
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="experience">Experience</label>
                    <?php 
                    echo form_dropdown('experience', toAssociative($experiences), $experience, array('class' => 'chosen-select-no-single'));
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <?php 
                    echo form_dropdown('gender', toAssociative($genders), $gender, array('class' => 'chosen-select-no-single'));
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="industry">Industry</label>
                    <?php 
                    echo form_dropdown('industry', toAssociative($industries), $industry, array('class' => 'chosen-select-no-single'));
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="qualification">Qualification</label>
                    <?php 
                    echo form_dropdown('qualification', toAssociative($qualifications), $qualification, array('class' => 'chosen-select-no-single'));
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="deadline">Application Deadline Date</label>
                    <input type="text" name="deadline" value="<?php echo set_value('deadline', date('m/d/Y',$deadline?$deadline:'')); ?>" class="form-control datepicker">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_of_vacancy">No of Vacancy</label>
                    <input type="text" name="no_of_vacancy" value="<?php echo set_value('no_of_vacancy', $no_of_vacancy); ?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="skills">Skills Required</label>
                    <input type="text" name="skills" value="<?php echo set_value('skills', $skills); ?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="apply">Custom Apply Link</label>
                    <input type="text" name="apply_link" value="<?php echo set_value('apply_link',$apply_link); ?>" class="form-control">
                </div>
            </div>
        </div>
        <h4>Location Fields</h4>
        
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Complete Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="<?php echo set_value('address', $address); ?>">
                    <input type="hidden" name="latitude" id="latitude" value="<?php echo $latitude?$latitude:''; ?>">
                    <input type="hidden" name="longitude" id="longitude" value="<?php echo $longitude ? $longitude : ''; ?>">
                </div>
            </div>
        </div>
        <?php if($this->ion_auth->is_admin()): ?>
        <!-- code for newspaper jobs -->
        <h4>Company Fields</h4>
        <div class="form-group">
                <div class="edit-profile-photo company-logo">
                    <img src="<?php echo $company_logo ? getFileUrl($company_logo) : img('user-avatar.jpg', true); ?>" width="240">
                    <div class="change-photo-btn">
                        <div class="photoUpload">
                            <span>
                                <i class="fa fa-upload"></i>
                                Upload Company Logo
                            </span>
                            <input type="file" class="upload">
                            <input type="hidden" name="company_logo" class="logo" value="">
                        </div>
                    </div>
                </div>
            </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input type="text" name="company" value="<?php echo set_value('company',$company); ?>" class="form-control">
                </div>
            </div>
        </div>
        <!-- end of fields for newspapers job -->
        <?php endif; ?>
        
        <div class="row">
            <div class="col-md-12">
                <div class="form-control">
                    <input type="submit" name="submit" value="Next" class="button">
                </div>
            </div>
        </div>
        </form>
    </div>
</div>