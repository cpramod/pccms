<div class="row">
    <div class="col-lg-12">
        <h3>My Profile</h3>
        <form action="<?php echo site_url('auth/edit_user/'.$id);?>" method="POST">
            <div class="form-group">
                <div class="edit-profile-photo">
                    <img src="<?php echo $avatar ? getFileUrl($avatar) : img('user-avatar.jpg',true); ?>" class="profile-pic">
                    <div class="change-photo-btn">
                        <div class="photoUpload">
                            <span>
                                <i class="fa fa-upload"></i>
                                Upload Profile Picture
                            </span>
                            <input type="file" id="File" class="upload" size="" >
                            <input type="hidden" name="avatar" value="" class="avatar">
                        </div>
                    </div>
                </div>
                 
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" value="<?php echo set_value('first_name', $first_name); ?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" value="<?php echo set_value('last_name', $last_name); ?>" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="job_title">Job Title</label>
                        <input type="text" name="job_title" value="<?php echo set_value('job_title',$job_title); ?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Specialisms">Specialisms</label>
                        <?php

                        echo form_multiselect('job_category[]', toAssociative($specialisms),unserialize($job_category),array('class'=>'chosen-select-no-single'));
                        ?>
                        
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="bio" id="" cols="30" rows="10" class="form-control summernote"><?php echo set_value('bio', $bio); ?></textarea>
                    </div>
                </div>
            </div>
            
            
            
            
            <h3>CONTACT INFORMATION</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" value="<?php echo set_value('phone', $phone); ?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" value="<?php echo set_value('email', $email); ?>" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="text" name="website" value="<?php echo set_value('website', $website); ?>" class="form-control" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="address">Complete Address</label>
                        <input type="text" name="address" id="address" value="<?php echo set_value('address', $address); ?>" class="form-control">
                        <input type="hidden" name="latitude" id="latitude" value="<?php echo $latitude ? $latitude : ''; ?>">
                        <input type="hidden" name="longitude" id="longitude" value="<?php echo $longitude ? $longitude : ''; ?>">
                    </div>
                </div>
            </div>

            <h3>Extra Information</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="experience">Experience</label>

                            <?php 
                            echo form_dropdown('experience', toAssociative($experiences), $experience,array('class'=>'chosen-select-no-single'));
                            ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="age">Age</label>
                        <?php 
                        echo form_dropdown('age', toAssociative($ages), $age, array('class' => 'chosen-select-no-single'));
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="current_salary">Current Salary</label>
                        <?php 
                        echo form_dropdown('current_salary', toAssociative($salaries), $current_salary, array('class' => 'chosen-select-no-single'));
                        ?>

                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="expected_salary">Expected Salary</label>
                        <?php 
                        echo form_dropdown('expected_salary', toAssociative($salaries), $expected_salary, array('class' => 'chosen-select-no-single'));
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="language">Language</label>
                        <?php 
                        echo form_multiselect('language[]', toAssociative($languages), unserialize($language), array('class' => 'chosen-select-no-single'));
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="education_levels">Education Levels</label>
                        <?php 
                        echo form_dropdown('qualification', toAssociative($qualifications), $qualification, array('class' => 'chosen-select-no-single'));
                        ?>
                    </div>
                </div>
            </div>

            
            
           

            <div class="form-group">
                <input type="submit" name="submit" value="Save Changes" class="btn btn-primary btn-lg pull-right">
            </div>
            
            <?php echo form_hidden('id', $id); ?>
            <?php echo form_hidden($csrf); ?>

        </form>
    </div>
    
</div>
    

<!-- Sign In Popup -->
<div id="image-in-dialog" class="zoom-anim-dialog mfp-hide">

	<div class="small-dialog-header">
		<h3>Position and Size Your Photo</h3>
	</div>

	<!--Tabs -->
	<div class="sign-in-form style-1">

		

		<div class="tabs-container alt">

			<!-- Login -->
			<div class="tab-content" id="">
				<form method="post" action="#" class="logoUpdate">
					<div class="form-row">
						<div class="image-editor">
							<div class="cropit-preview"></div>
							<div class="controls-wrapper">
								<div class="slider-wrapper">
									<span class="icon icon-image small-image"><i class="fa fa-file-image-o"></i></span>
									<input type="range" class="cropit-image-zoom-input custom" min="0" max="1" step="0.01">
									<span class="icon icon-image large-image"><i class="fa fa-file-image-o"></i></span>
									<span style="margin-left:20px;"><button type="submit" class="button border margin-top-5" name="submit" value="Apply" >Apply</button></span>
								</div>
							</div>
							
							<input type="hidden" name="image-data" class="hidden-image-data" />
							
						</div>
					</div>
					
				</form>
			</div>


		</div>
	</div>
</div>
<!-- Sign In Popup / End -->

<a href="#image-in-dialog" class="profilePicUpload sign-in popup-with-zoom-anim" style="visibility:hidden;">start</a>
