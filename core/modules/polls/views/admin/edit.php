<div class="row">
    <div class="col-lg-12">

        <div id="add-listing">
            <form action="<?php echo current_url(); ?>" method="post">

            <!-- Section -->
            <div class="add-listing-section">

                <!-- Headline -->
                <div class="add-listing-headline">
                    <h3><i class="sl sl-icon-doc"></i> Basic Informations</h3>
                </div>

                <!-- Title -->
                <div class="row with-forms">
                    <div class="col-md-12">
                        <h5>Title <i class="tip" data-tip-content="Title of the Poll"></i></h5>
                        <input class="search-field" type="text" name="title" value="<?php echo set_value('title',$title); ?>" />
                    </div>
                </div>

               

                
            </div>
            <!-- Section / End -->

<!-- Section -->
					<div class="add-listing-section margin-top-45">
						
						<!-- Headline -->
						<div class="add-listing-headline">
							<h3><i class="sl sl-icon-book-open"></i> Options</h3>
							<!-- Switcher -->
							<label class="switch" style="display:none;"><input type="checkbox" checked><span class="slider round"></span></label>
						</div>

						<!-- Switcher ON-OFF Content -->
						<div class="switcher-content">

							<div class="row">
								<div class="col-md-12">
									<table id="pricing-list-container">
                                        <?php if(count($options)>0):
                                            foreach($options as $option){ ?>
										<tr class="pricing-list-item pattern">
											<td>
												<div class="fm-move"><i class="sl sl-icon-cursor-move"></i></div>
												<div class="fm-input"><input type="text" placeholder="Option Name" name="options[]" value="<?php echo $option['title']; ?>" /></div>
												<div class="fm-close"><a class="delete" href="#"><i class="fa fa-remove"></i></a></div>
											</td>
                                        </tr>
                                            <?php }
                                            else: ?>

                                            <tr class="pricing-list-item pattern">
                                                <td>
                                                    <div class="fm-move"><i class="sl sl-icon-cursor-move"></i></div>
                                                    <div class="fm-input"><input type="text" placeholder="Option Name" name="options[]" value="" /></div>
                                                    <div class="fm-close"><a class="delete" href="#"><i class="fa fa-remove"></i></a></div>
                                                </td>
                                            </tr>

                                            <?php endif; ?>
									</table>
									<a href="#" class="button add-pricing-list-item">Add Option</a>
									
								</div>
							</div>

						</div>
						<!-- Switcher ON-OFF Content / End -->

					</div>
					<!-- Section / End -->
            


            <button type="submit" class="button preview">Submit <i class="fa fa-arrow-circle-right"></i></button>
            </form>
        </div>
    </div>


 