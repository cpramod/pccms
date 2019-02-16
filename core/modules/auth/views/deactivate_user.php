<div class="row deactivate">
    <div class="col-md-12">
        <h3><?php echo lang('deactivate_heading'); ?></h3>

        <?php echo form_open("auth/deactivate/" . $user->id); ?>
        <p><?php echo sprintf(lang('deactivate_subheading'), $user->username); ?></p>
        <p>
            <input type="radio" class="with-gap" name="confirm" value="yes" id="yes" checked="checked" />
            <label for="yes">Yes</label>
                    
            <input type="radio" class="with-gap" id="no" name="confirm" value="no" />
            <label for="no">No</label>
        </p>
        <?php echo form_hidden($csrf); ?>
        <?php echo form_hidden(array('id' => $user->id)); ?>

        <p><?php echo form_submit('submit', lang('deactivate_submit_btn')); ?></p>

        <?php echo form_close(); ?>

    </div>
</div>



