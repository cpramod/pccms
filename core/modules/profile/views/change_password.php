<div class="row">
    <div class="col-lg-12">
        <form method="POST" action="<?php echo site_url('auth/change_password'); ?>">
            <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" name="old" value="<?php echo set_value('old'); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="new_password">New Password (at least 8 characters long):</label>
                <input type="password" name="new" value="<?php echo set_value('new'); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="old_password">Confirm New Password</label>
                <input type="password" name="new_confirm" value="" class="form-control">
            </div>
            <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
            <?php echo form_hidden($csrf); ?>
            <div class="form-group">
                <input type="submit" name="submit" value="Change Password" class="button">
            </div>

        </form>
    </div>
</div>