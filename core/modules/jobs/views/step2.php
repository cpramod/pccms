<div class="row">
    <div class="col-lg-12">
        <h3>Post Job</h3>
        
        <div class="row">
                <div class="col-md-12">
                    <div class="step-container">
                        <div class="step-wizard">
                            <div class="progress">
                                <div class="progressbar" style="width: 66.6666%;"></div>
                            </div>
                            <ul class="nav">
                                <li>
                                    <a href="" class="show">
                                        <span class="step"><i class="fa fa-suitcase"></i></span>
                                        <span class="title">Job Details</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="active show">
                                        <span class="step"><i class="fa fa-credit-card-alt"></i></span>
                                        <span class="title">Package</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="show">
                                        <span class="step"><i class="fa fa-check-circle"></i></span>
                                        <span class="title">Payments & Confirmation</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row / Start -->
            <div class="row">

                <div class="col-md-12">
                    <div class="pricing-container margin-top-30">
                        <!-- Plan #1 -->
                    
                        <div class="plan <?php echo (!empty($package) && ($package == 1)) ? 'featured':''; ?>">
                            <form method="post" action="<?php echo current_url(); ?>">
                            <?php if (!empty($package) && ($package == 1)) {
                                ?>
                                <div class="listing-badge">
                                    <span class="featured">Selected</span>
                                </div>
                                <?php
                            } ?>

                            <div class="plan-price">
                                <h3>Basic</h3>
                                
                                <span class="value">Rs.1000</span>
                                <span class="value"><del>Rs.5000</del></span>
                                <span class="period">One Job post active for 5 days</span>
                            </div>

                            <div class="plan-features">
                                <ul>
                                    <li>One Job Post</li>
                                    <li>5 Days Availability</li>
                                    <li>No social media marketing</li>
                                    <li>No Banner designed for your post </li>
                                    <li>Added under normal Job on homepage</li>
                                    <li>Lowest priority on search result</li>
                                </ul>
                                <label class="featured">
                                    <input type="hidden" name="package" value="1" class=""> 
                                    <input type="submit" name="submit" value="Select" class="button">
                                </label>
                            </div>
                            </form>
                        </div>
                    

                        <!-- Plan #3 -->
                        
                        <div class="plan <?php echo (($package == 2) || ($package == '')) ? 'featured' : ''; ?>">
                            <form method="post" action="<?php echo current_url(); ?>">
                            <?php if (!empty($package) && ($package == 2)) {
                                ?>
                                <div class="listing-badge">
                                    <span class="featured">Selected</span>
                                </div>
                                <?php

                            }elseif(empty($package)){ ?>
                            <div class="listing-badge">
                                <span class="featured">Featured</span>
                            </div>
                            <?php } ?>

                            <div class="plan-price">
                                <h3>Extended</h3>
                                <span class="value">Rs.3000</span>
                                <span class="value"><del>Rs.8000</del></span>
                                
                                <span class="period">Job post active for 15 days with social media marketing</span>
                            </div>
                            <div class="plan-features">
                                <ul>
                                    <li>One Job Post</li>
                                    <li>15 Days Availability</li>
                                    <li>Social Media marketing</li>
                                    <li>No Banner designed for your post </li>
                                    <li>Added under Hot Job on homepage</li>
                                    <li>Second priority on search result</li>

                                </ul>
                                <label class="featured">
                                    <input type="hidden" name="package" value="2" class=""> 
                                    <input type="submit" name="submit" value="Select" class="button">
                                </label>
                                    
                                
                            </div>
                            </form>
                        </div>
                    

                    
                    
                        <!-- Plan #3 -->
                        <div class="plan <?php echo (!empty($package) && ($package == 3)) ? 'featured' : ''; ?>">
                            <form method="post" action="<?php echo current_url(); ?>">
                            <?php if (!empty($package) && ($package == 3)) {
                                ?>
                                <div class="listing-badge">
                                    <span class="featured">Selected</span>
                                </div>
                                <?php

                            } ?>
                            <div class="plan-price">
                                <h3>Professional</h3>
                                <span class="value">Rs.5000</span>
                                <span class="value"><del>Rs.12000</del></span>
                                <span class="period">Job post active for a month with social media marketing</span>
                            </div>

                            <div class="plan-features">
                                <ul>
                                    <li>One Job Post</li>
                                    <li>30 Days Availability</li>
                                    <li>Social Media marketing</li>
                                    <li>Banner designed for your post </li>
                                    <li>Added under featured Job on homepage</li>
                                    <li>First priority on search result</li>
                                </ul>
                                <label class="featured">
                                    <input type="hidden" name="package" value="3" class=""> 
                                    <input type="submit" name="submit" value="Select" class="button">
                                </label>
                            </div>
                            </form>
                        </div>
                    
                    <!-- newspaper job package is only for admin -->
                    <?php if($this->ion_auth->is_admin()): ?>
                            
                        <!-- Newspaper package -->
                        <div class="plan <?php echo (!empty($package) && ($package === 0)) ? 'featured' : ''; ?>">
                            <form method="post" action="<?php echo current_url(); ?>">
                            <?php if (!empty($package) && ($package == 0)) {
                                ?>
                                <div class="listing-badge">
                                    <span class="featured">Selected</span>
                                </div>
                                <?php

                            } ?>
                            <div class="plan-price">
                                <h3>Newspaper</h3>
                                <span class="value">Rs.0</span>
                                
                                <span class="period">Newspaper Package</span>
                            </div>

                            <div class="plan-features">
                                <ul>
                                    <li>One Job Post</li>
                                </ul>
                                <label class="featured">
                                    <input type="hidden" name="package" value="0" class=""> 
                                    <input type="submit" name="submit" value="Select" class="button">
                                </label>
                            </div>
                            </form>
                        </div>
                    
                <?php endif; ?>

                        <!-- end of newspaper package -->

                    </div>
                </div>
            </div>
            <!-- Row / End -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-control">
                        <a href="<?php echo site_url('jobs/post/'.$id.'/1'); ?>" class="button previous">Previous</a>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-control">
                        <input type="submit" name="submit" value="Next" class="button next pull-right">
                    </div>
                </div> -->
            </div>
        </form>


    </div>
</div>
