<div class="row flex-row">
    
    <div class="col-xl-12">
        <form method="POST" class="form-horizontal" action="<?php echo site_url('admin/auth/edit_user/'.$id); ?>">
            <div class="widget has-shadow">
                <div class="widget-header bordered no-actions d-flex align-items-center">
                    <h4>Update Profile</h4>
                </div>
                <div class="widget-body">
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Company Logo</label>
                        <div class="col-lg-8">
                            <div class="edit-profile-photo company-logo">
                                <img src="<?php echo $avatar?getFileUrl($avatar):img('avatar/avatar-01.jpg', true); ?>">
                                <div class="change-photo-btn">
                                    <div class="photoUpload">
                                        <span>
                                            <i class="fa fa-upload"></i> Upload Logo
                                        </span>
                                        <input type="file" name="logo" class="upload">
                                        <input type="hidden" name="avatar" value="">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="col-10 ml-auto">
                        <div class="section-title mt-3 mb-3">
                            <h4>01. Company Profile</h4>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Company Name</label>
                        <div class="col-lg-8">
                            <input type="text" name="company" class="form-control" value="<?php echo set_value('company',$user_details['company']); ?>"
                                placeholder="Butwal Jobs">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Specialisms</label>
                        <div class="col-lg-8">
                            <select name="job_category" class="selectpicker show-menu-arrow form-control" id="">
                                <option value="">Select Specialism</option>
                                <?php 
                                    foreach($categories as $category){
                                                            ?>
                                <option value="<?php echo $category->id; ?>" <?php echo $category->id==$job_category?'selected':''; ?>>
                                    <?php echo $category->title; ?>
                                </option>
                                <?php
                                                        }
                                                        ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Description</label>
                        <div class="col-lg-8">
                            <textarea name="bio" id="" cols="30" rows="10" class="form-control summernote"><?php echo set_value('bio',$bio); ?></textarea>
                        </div>
                    </div>


                    <div class="col-10 ml-auto">
                        <div class="section-title mt-3 mb-3">
                            <h4>02. Contact Informations</h4>
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Phone Number</label>
                        <div class="col-lg-8">
                            <input type="text" name="phone" value="<?php echo set_value('phone',$phone); ?>" class="form-control"
                                placeholder="980000000">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Email Address</label>
                        <div class="col-lg-8">
                            <input type="text" name="email" value="<?php echo set_value('email',$email); ?>" class="form-control"
                                placeholder="dummy@dummy.com">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Website</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="website" value="<?php echo set_value('website',$website); ?>"
                                placeholder="http://abc.com">
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Address</label>
                        <div class="col-lg-8">
                            <input type="text" name="address" value="<?php echo set_value('address',$address); ?>"
                                class="form-control" placeholder="Pradhan Path, Devinagar">
                        </div>
                    </div>


                    <div class="col-10 ml-auto">
                        <div class="section-title mt-3 mb-3">
                            <h4>03. Extra Information</h4>
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Ownership</label>
                        <div class="col-lg-8">
                            <select name="ownership" class="form-control">
                                <option value="government" <?php echo $ownership=='government' ?'selected':''; ?>>Government</option>
                                <option value="private" <?php echo $ownership=='private' ? 'selected' : '' ; ?>>Private</option>
                                <option value="public" <?php echo $ownership=='public' ? 'selected' : '' ; ?>>Public</option>
                                <option value="no-profit" <?php echo $ownership=='no-profit' ? 'selected' : '' ; ?>>Non
                                    Profit</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Team size</label>
                        <div class="col-lg-8">
                            <input type="text" name="team_size" value="<?php echo set_value('team_size',$team_size); ?>"
                                placeholder="20" class="form-control">
                        </div>
                    </div>

                    <div class="col-10 ml-auto">
                        <div class="section-title mt-3 mb-3">
                            <h4>04. Contact Person</h4>
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">First Name</label>
                        <div class="col-lg-8">
                            <input type="text" name="first_name" value="<?php echo set_value('first_name',$first_name); ?>"
                                placeholder="Ram" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Last Name</label>
                        <div class="col-lg-8">
                            <input type="text" name="last_name" value="<?php echo set_value('last_name',$last_name); ?>"
                                placeholder="Hari" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Designation</label>
                        <div class="col-lg-8">
                            <select name="contact_designation" class="form-control">
                                <option value="">Select Designation</option>
                                <option value="manager" <?php echo $contact_designation=='manager' ?'selected':''; ?>>Manager</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Contact Number</label>
                        <div class="col-lg-8">
                            <input type="text" name="contact_phone" value="<?php echo set_value('contact_phone',$contact_phone); ?>"
                                placeholder="98410000" class="form-control">
                        </div>
                    </div>

                                <?php echo form_hidden('id', $id); ?>
                                <?php echo form_hidden($csrf); ?>


                    <div class="em-separator separator-dashed"></div>
                    <div class="text-right">
                        <button class="btn btn-gradient-01" type="submit">Save Changes</button>
                        <button class="btn btn-shadow" type="reset">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Row -->

