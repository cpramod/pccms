<div class="row flex-row">
      <div class="col-12">
            <div class="widget has-shadow">
                  <div class="widget-header bordered no-actions d-flex align-items-center">
                        <h4><?php echo lang('change_password_heading'); ?></h4>
                  </div>
                  <div class="widget-body">
                        <form class="form-horizontal" method="POST" action="<?php echo current_url(); ?>">
                              <div class="form-group row d-flex align-items-center mb-5">
                                    <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"><?php echo lang('change_password_old_password_label', 'old_password'); ?></label>
                                    <div class="col-lg-5">
                                          <?php echo form_input($old_password); ?>
                                    </div>
                                    
                              </div>
                              <div class="form-group row d-flex align-items-center mb-5">
                                    <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length); ?></label>
                                    <div class="col-lg-5">
                                          <?php echo form_input($new_password); ?>
                                    </div>
                              </div>
                              <div class="form-group row d-flex align-items-center mb-5">
                                    <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"><?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm'); ?></label>
                                    <div class="col-lg-5">
                                          <?php echo form_input($new_password_confirm); ?>
                                    </div>
                              </div>  
                        
                              <?php echo form_input($user_id); ?>
                              <div class="text-right">
                                    <button class="btn btn-gradient-01" type="submit"><?php echo lang('change_password_submit_btn'); ?></button>
                              </div>
                              
                        </form>
                  </div>
            </div>
            
      </div>
</div>



