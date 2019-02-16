<div id="infoMessage" style="text-align:center;"><?php echo $message;?></div>

<?php echo form_open('auth/reset_password/' . $code,array('id' => 'sign_in'));?>
    <div class="msg"><?php echo lang('reset_password_heading');?></div>

	<div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">lock</i>
        </span>

		<div class="form-line">
            <?php echo form_input($new_password);?>
        </div>
	</div>

	<div class="input-group">
        <span class="input-group-addon">
              <i class="material-icons">lock</i>
        </span>

		<div class="form-line">
            <?php echo form_input($new_password_confirm);?>
        </div>
	</div>

	<?php echo form_input($user_id);?>
	<?php echo form_hidden($csrf); ?>
    <div class="row">
        <div class="col-xs-12">
            <?php echo form_submit('submit', lang('reset_password_submit_btn'), array('class' => 'btn btn-block bg-pink waves-effect'));?>
        </div>
    </div>

<?php echo form_close();?>