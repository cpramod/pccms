	<h4 class="heading-primary">Poll</h4>
	<?php if($this->session->flashdata('voted')): ?>
		<div class="alert alert-success"><?php echo $this->session->flashdata('voted'); ?></div>
	<?php elseif($this->session->flashdata('error')): ?>
		<div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
	<?php elseif ($this->session->flashdata('success')) : ?>
		<div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
	<?php endif; ?>

	<form action="<?php echo site_url('polls/vote/'.$poll_id); ?>" method="POST">
		<div class="form-row">
			<div class="form-group">
				<h4><?php echo $title; ?></h4>
				
				<?php $i=0; foreach($options as $option){
					//print_r($option);
					?>
					<div class="col">
						<input type="radio" name="option" value="<?php echo $option['option_id']; ?>"> <label><?php echo $option['title']; ?></label> 
					</div>
					<?php
					$i++;
				} ?>
				
			</div>
			<div class="form-group">
				<button type="submit" name="submit" class="btn btn-success" value="">Mark Your Vote</button>
			</div>
			<br>			
			
		</div>

			
		<div class="form-row" style="display:<?php echo $this->session->flashdata('voted')?'block':'none'; ?>">
			<hr>		
			<h4 class="heading-primary">Result of User Votes:</h4>
					<?php
			$color = array('progress-bar-success', 'progress-bar-info', 'progress-bar-warning', 'progress-bar-danger', 'progress-bar-primary');
			$i = 0;
			foreach ($options as $option) {
				?>
					<div class="col-lg-12">
						<?php echo $option['title']; ?> (<?php echo $option['vote']; ?>%)
					<div class="progress mb-2">
						<div class="progress-bar <?php echo $color[$i]; ?>" role="progressbar" aria-valuenow="<?php echo $option['vote']; ?>" aria-valuemin="0" style="width:<?php echo $option['vote']; ?>%;">
							<span class="sr-only"><?php echo $option['vote']; ?>% complete</span>
						</div>
					</div>
					</div>
					<?php
				$i++;
			}
			?>
			</div>
	</form>
	<hr>