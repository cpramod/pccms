<!-- Form -->
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Wizard Example</h4>
    </div>
    <div class="widget-body">
        <div class="row flex-row justify-content-center">
            <div class="col-xl-10">
                <div id="rootwizard">
                    <div class="step-container">
                        <div class="step-wizard">
                            <div class="progress">
                                <div class="progressbar"></div>
                            </div>
                            <ul>
                                <li>
                                    <a href="#tab1" data-toggle="tab">
                                        <span class="step">1</span>
                                        <span class="title">Job Detail</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab">
                                        <span class="step">2</span>
                                        <span class="title">Package & Payments</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab3" data-toggle="tab">
                                        <span class="step">3</span>
                                        <span class="title">Confirmation</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">

                            <div class="form-group row mb-3">
                                <div class="col-xl-12 mb-3">
                                    <label class="form-control-label">Job Title<span class="text-danger ml-2">*</span></label>
                                    <input type="text" name="title" value="" class="form-control">
                                </div>
                                <div class="col-xl-12">
                                    <label class="form-control-label">Job Description<span class="text-danger ml-2">*</span></label>
                                    <textarea name="description" class="form-control summernote" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <div class="col-xl-6 mb-3">
                                    <label class="form-control-label">Job Type</label>
                                    <select name="type" class="custom-select form-control" id="">
                                        <option value="freelance">Freelance</option>
                                        <option value="full-time">Full Time</option>
                                        <option value="internship">Internship</option>
                                        <option value="part-time">Part Time</option>
                                        <option value="temporary">Temporary</option>
                                        <option value="volunteer">Volunteer</option>
                                    </select>
                                    
                                </div>
                                <div class="col-xl-6">
                                    <label class="form-control-label">Specialisms</label>
                                    <select name="specialism" class="custom-select form-control" id="">
                                        <option value="">Please Select</option>
                                        <?php
                                        foreach($specialisms as $specialism){
                                            ?>
                                            <option value="<?php echo $specialism->slug; ?>"><?php echo $specialism->title; ?></option>
                                            <?php
                                        }
                                        ?>
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-xl-6 mb-3">
                                    <label class="form-control-label">Offerd Salary<span class="text-danger ml-2">*</span></label>
                                    <select name="offered-salary" class="custom-select form-control" id="">
                                        <option value="">Please Select</option>
                                        <?php
                                        foreach($salaries as $salary){
                                            ?>
                                            <option value="<?php echo $salary->slug; ?>"><?php echo $salary->title; ?></option>
                                            <?php
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xl-6">
                                    <label class="form-control-label">Career Level<span class="text-danger ml-2">*</span></label>
                                    <select name="career-level" class="custom-select form-control" id="">
                                        <option value="">Please Select</option>
                                        <?php 
                                        foreach($career_levels as $level){
                                            ?>
                                            <option value="<?php echo $level->slug; ?>"><?php echo $level->title; ?></option>
                                            <?php
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-xl-6 mb-3">
                                    <label class="form-control-label">Experience<span class="text-danger ml-2">*</span></label>
                                    <select name="experience" class="custom-select form-control" id="">
                                        <option value="">Please Select</option>
                                        <?php foreach($experiences as $experience){
                                            ?>
                                            <option value="<?php echo $experience->slug; ?>"><?php echo $experience->title; ?></option>
                                            <?php
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-xl-6">
                                    <label class="form-control-label">Gender<span class="text-danger ml-2">*</span></label>
                                    <select name="gender" class="custom-select form-control" id="">
                                        <option value="">Please Select</option>
                                        <?php
                                        foreach($genders as $gender){
                                            ?>
                                            <option value="<?php echo $gender->slug; ?>"><?php echo $gender->title; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                
                                <div class="col-xl-6">
                                    <label class="form-control-label">Qualification<span class="text-danger ml-2">*</span></label>
                                    <select name="gender" class="custom-select form-control" id="">
                                        <option value="">Please Select</option>
                                        <?php
                                        foreach($qualifications as $qualification){
                                            ?>
                                            <option value="<?php echo $qualification->slug; ?>"><?php echo $qualification->title; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-xl-12 mb-3">
                                    <label class="form-control-label">Application Deadline Date<span class="text-danger ml-2">*</span></label>
                                    <input type="text" name="deadline" value="<?php echo date('m/d/Y'); ?>" class="form-control datepicker ll-skin-melon">
                                </div>
                            </div>
                            <div class="section-title mt-5 mb-5">
                                <h4>Address</h4>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-xl-4 mb-3">
                                    <label class="form-control-label">City<span class="text-danger ml-2">*</span></label>
                                    <input type="text" name="city" value="" placeholder="Butwal" class="form-control">
                                </div>
                                <div class="col-xl-4 mb-5">
                                    <label class="form-control-label">District<span class="text-danger ml-2">*</span></label>
                                    <input type="district" value="" placeholder="Rupandehi" class="form-control">
                                </div>
                                <div class="col-xl-4">
                                    <label class="form-control-label">Zone<span class="text-danger ml-2">*</span></label>
                                    <input type="zone" value="" placeholder="Lumbini" class="form-control">
                                </div>
                                <div class="col-xl-12">
                                    <label class="form-control-label">Street / Tol<span class="text-danger ml-2">*</span></label>
                                    <input type="street" value="" placeholder="Horizon Chok" class="form-control">
                                </div>
                            </div>
                            <ul class="pager wizard text-right">
                                <li class="previous d-inline-block">
                                    <a href="javascript:;" class="btn btn-secondary ripple">Previous</a>
                                </li>
                                <li class="next d-inline-block">
                                    <a href="javascript:;" class="btn btn-gradient-01">Next</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="section-title mt-5 mb-5">
                                <h4>Account Details</h4>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-xl-6 mb-3">
                                    <label class="form-control-label">Username<span class="text-danger ml-2">*</span></label>
                                    <input type="text" value="DGreen" class="form-control">
                                </div>
                                <div class="col-xl-6">
                                    <label class="form-control-label">Password<span class="text-danger ml-2">*</span></label>
                                    <input type="text" value="**********" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-xl-12">
                                    <label class="form-control-label">Url</label>
                                    <input type="url" value="http://mywebsite.com" class="form-control">
                                </div>
                            </div>
                            <div class="section-title mt-5 mb-5">
                                <h4>Billing Information</h4>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-xl-12 mb-3">
                                    <label class="form-control-label">Card Number</label>
                                    <input type="text" value="98765432145698547" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-xl-4 mb-3">
                                    <label class="form-control-label">Exp Month<span class="text-danger ml-2">*</span></label>
                                    <select name="exp-month" class="custom-select form-control">
                                        <option value="">Select</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06" selected>06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col-xl-4 mb-3">
                                    <label class="form-control-label">Exp Year<span class="text-danger ml-2">*</span></label>
                                    <select name="exp-month" class="custom-select form-control">
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023" selected>2023</option>
                                        <option value="2024">2024</option>
                                    </select>
                                </div>
                                <div class="col-xl-4">
                                    <label class="form-control-label">CVV<span class="text-danger ml-2">*</span></label>
                                    <input type="email" value="651" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-xl-12">
                                    <div class="styled-checkbox">
                                        <input type="checkbox" name="savecard" id="check-card">
                                        <label for="check-card">Save this card</label>
                                    </div>
                                </div>
                            </div>
                            <ul class="pager wizard text-right">
                                <li class="previous d-inline-block">
                                    <a href="javascript:;" class="btn btn-secondary ripple">Previous</a>
                                </li>
                                <li class="next d-inline-block">
                                    <a href="javascript:;" class="btn btn-gradient-01">Next</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <div class="section-title mt-5 mb-5">
                                <h4>Confirmation</h4>
                            </div>
                            <div id="accordion-icon-right" class="accordion">
                                <div class="widget has-shadow">
                                    <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse"
                                        href="#IconRightCollapseOne" aria-expanded="true">
                                        <div class="card-title w-100">1. Client Informations</div>
                                    </a>
                                    <div id="IconRightCollapseOne" class="card-body collapse show" data-parent="#accordion-icon-right">
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Name</div>
                                            <div class="col-sm-8 form-control-plaintext">David Green</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Email</div>
                                            <div class="col-sm-8 form-control-plaintext">dgreen@elisyam.com</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Phone</div>
                                            <div class="col-sm-8 form-control-plaintext">+00 987 654 32</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Occupation</div>
                                            <div class="col-sm-8 form-control-plaintext">UX Designer</div>
                                        </div>
                                    </div>
                                    <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse"
                                        href="#IconRightCollapseTwo">
                                        <div class="card-title w-100">2. Address</div>
                                    </a>
                                    <div id="IconRightCollapseTwo" class="card-body collapse" data-parent="#accordion-icon-right">
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Address</div>
                                            <div class="col-sm-8 form-control-plaintext">123 Century Blvd</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Country</div>
                                            <div class="col-sm-8 form-control-plaintext">Country</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">City</div>
                                            <div class="col-sm-8 form-control-plaintext">Los Angeles</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">State</div>
                                            <div class="col-sm-8 form-control-plaintext">CA</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Zip</div>
                                            <div class="col-sm-8 form-control-plaintext">90045</div>
                                        </div>
                                    </div>
                                    <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse"
                                        href="#IconRightCollapseThree">
                                        <div class="card-title w-100">3. Account Details</div>
                                    </a>
                                    <div id="IconRightCollapseThree" class="card-body collapse" data-parent="#accordion-icon-right">
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Username</div>
                                            <div class="col-sm-8 form-control-plaintext">Saerox</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Password</div>
                                            <div class="col-sm-8 form-control-plaintext"><span class="la-2x">*********</span></div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Url</div>
                                            <div class="col-sm-8 form-control-plaintext">http://mywebsite.com</div>
                                        </div>
                                    </div>
                                    <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse"
                                        href="#IconRightCollapseFour">
                                        <div class="card-title w-100">4. Billing Information</div>
                                    </a>
                                    <div id="IconRightCollapseFour" class="card-body collapse" data-parent="#accordion-icon-right">
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Card
                                                Number</div>
                                            <div class="col-sm-8 form-control-plaintext">98765432145698547</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Exp
                                                Month</div>
                                            <div class="col-sm-8 form-control-plaintext">06</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Exp Year</div>
                                            <div class="col-sm-8 form-control-plaintext">2023</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">CVV</div>
                                            <div class="col-sm-8 form-control-plaintext">651</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-xl-12">
                                                <div class="styled-checkbox">
                                                    <input type="checkbox" name="checkbox" id="agree">
                                                    <label for="agree">I Accept <a href="#">Terms and Conditions</a></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="pager wizard text-right">
                                <li class="previous d-inline-block">
                                    <a href="javascript:void(0)" class="btn btn-secondary ripple">Previous</a>
                                </li>
                                <li class="next d-inline-block">
                                    <a href="javascript:void(0)" class="finish btn btn-gradient-01" data-toggle="modal">Finish</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Form -->
