<!-- Slider
================================================== -->

<!-- Revolution Slider -->
<div id="rev_slider_4_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="classicslider1">

<!-- 5.0.7 auto mode -->
	<div id="rev_slider_4_1" class="rev_slider home fullwidthabanner" data-version="5.0.7">
		<ul>

			<!-- Slide  -->
			<li data-index="rs-2" data-transition="fade" data-slotamount="default"  data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="1000"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="800" data-fsslotamount="7" data-saveperformance="off">

				<!-- Background -->
				<img src="<?php echo img('banner.png', true); ?>"  alt="butwaljobs banner"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina data-kenburns="on" data-duration="12000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="103" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0"> 

				<!-- Caption-->
				<div class="tp-caption centered custom-caption-2 tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0" 
					id="slide-2-layer-2" 
					data-x="['center','center','center','center']" data-hoffset="['0']" 
					data-y="['middle','middle','middle','middle']" data-voffset="['0']" 
					data-width="['640','640', 640','420','320']"
					data-height="auto"
					data-whitespace="nowrap"
					data-transform_idle="o:1;"	
					data-transform_in="y:0;opacity:0;s:1000;e:Power2.easeOutExpo;s:400;e:Power2.easeOutExpo" 
					data-transform_out="" 
					data-mask_in="x:0px;y:[20%];s:inherit;e:inherit;" 
					data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
					data-start="1000" 
					data-responsive_offset="on">

					<!-- Caption Content -->
					<div class="R_title margin-bottom-15"
					id="slide-2-layer-3"
					data-x="['center','center','center','center']"
					data-hoffset="['0','0','0','0']"
					data-y="['middle','middle','middle','middle']"
					data-voffset="['-40','-40','-20','-80']"
					data-fontsize="['42','36', '32','36','22']"
					data-lineheight="['70','60','60','45','35']"
					data-width="['640','640', 640','420','320']"
					data-height="none" data-whitespace="normal"
					data-transform_idle="o:1;"
					data-transform_in="y:-50px;sX:2;sY:2;opacity:0;s:1000;e:Power4.easeOut;"
					data-transform_out="opacity:0;s:300;"
					data-start="600"
					data-splitin="none"
					data-splitout="none"
					data-basealign="slide"
					data-responsive_offset="off"
					data-responsive="off"><h1>Opportunity Unlimited</h1></div>

					<div class="caption-text">We Can Help You Find The Best Jobs And Employees</div>
					<a href="#sign-in-dialog" class="button medium popup-with-zoom-anim">Get Started</a>
				</div>

			</li>

		</ul>
		<div class="tp-static-layers"></div>

	</div>
</div>
<!-- Revolution Slider / End -->


<!-- Content
================================================== -->
<section class="container">
	<div class="row">

		<div class="col-md-12">
			<h2 class="headline centered margin-top-75">
				Featured Job Offers
				<span class="">A better career is out there. We'll help you find it to use</span>
				
			</h3>
			<?php $this->ion_auth_model->trigger_events('featured_job'); ?>
			<a href="<?php echo site_url('jobs'); ?>" class="button medium view-all">View All Jobs</a>
		</div>

	</div>
</section>
<section class="container">
	<div class="row">

		<div class="col-md-12">
			<h2 class="headline centered margin-top-75">
				Hot Job Offers
				<span>We help you find the right job right away</span>
			</h3>
			<?php $this->ion_auth_model->trigger_events('hot_job'); ?>
			<a href="<?php echo site_url('jobs'); ?>" class="button medium view-all">View All Jobs</a>
		</div>

	</div>
</section>

<section class="container">
	<div class="row">

		<div class="col-md-12">
			<h2 class="headline centered">
				Normal Job Offers
				
			</h3>
			<?php $this->ion_auth_model->trigger_events('normal_job'); ?>
			<a href="<?php echo site_url('jobs'); ?>" class="button medium view-all">View All Jobs</a>
		</div>

	</div>
</section>


<section id="register">

		<div class="col-md-6 employer">
			<div class="col-md-12">
				<h2>I'm an employer!</h2>
				<p>Signed in companies are able to post new job offers, searching for candidate...</p>
				<?php if($this->ion_auth->logged_in()){
				if (($groups['id'] == 3) || ($groups['id'] == 1)){
					?>
					<a class="button medium" href="<?php echo site_url('jobs/post');  ?>">Post new job</a>
					<?php
					}
				}else{ ?>
					<a class="button medium sign-in popup-with-zoom-anim" href="#sign-in-dialog">Post new job</a>
				<?php } ?>
				
			</div>
		</div>
		<div class="col-md-6 candidate">
			<div class="col-md-12">
				<h2>I'm Jobseeker!</h2>
				<p>Browse and search potential candidates for your job that match you, save job...</p>
				<a class="button medium" href="<?php echo site_url('jobs'); ?>">Browse jobs</a>
			</div>	
		</div>	
		<div class="clearfix"></div>


</section>
<section class="container job-by-category">
	<div class="row">
		<div class="col-md-12">
			<h2 class="headline centered">
				What Are You Interested In?
				<span>Explore some of the best jobs and opportunities from around the cities.</span>
			</h2>
		</div>
		<div class="col-md-12">
			<?php $this->ion_auth_model->trigger_events('interested_in'); ?>
			

		</div>
	</div>
</section>



<section id="how-it-works" data-background-color="#fafafa">
	<!-- Info Section -->
	<div class="container">

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h2 class="headline centered margin-top-80">
					How it work.
					<span class="margin-top-25">Find Jobs, Employment & Career Opportunities</span>
				</h2>
			</div>
		</div>

		<div class="row icons-container">
			<!-- Stage -->
			<div class="col-md-4">
				<div class="icon-box-2 with-line">
					<i class="fa fa-key"></i>
					<h3>Register an account</h3>
					<p>Add your all personal information including qualifications, education, etc</p>
				</div>
			</div>

			<!-- Stage -->
			<div class="col-md-4">
				<div class="icon-box-2 with-line">
					<i class="im im-icon-Data-Search"></i>
					<h3>Specify & search your job</h3>
					<p>Search for all the best job which match for expertise.</p>
				</div>
			</div>

			<!-- Stage -->
			<div class="col-md-4">
				<div class="icon-box-2">
					<i class="im im-icon-Checked-User"></i>
					<h3>Apply for job</h3>
					<p>Click apply on the job you are interested in and hopefully you will be called for interview soon by the employer.</p>
				</div>
			</div>

			<div class="col-md-12 centered-content">
					<a href="#sign-in-dialog" class="button border margin-top-10 popup-with-zoom-anim">Register Today!</a>
			</div>
		</div>

	</div>
</section>
<!-- Info Section / End -->


<!-- Recent Blog Posts -->
<section class="fullwidth border-top padding-top-75 padding-bottom-75" data-background-color="#fff">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h2 class="headline centered margin-bottom-45">
					Newspaper Jobs
					<span class="margin-top-25">Jobs from newspaper and other sources</span>
				</h2>
							<?php $this->ion_auth_model->trigger_events('newspaper'); ?>
							<a href="<?php echo site_url('jobs'); ?>" class="button medium view-all">Browse All Jobs</a>
			</div>
		</div>

		

	</div>
</section>
<!-- Recent Blog Posts / End -->


<!-- REVOLUTION SLIDER SCRIPT -->
<?php echo js("themepunch.tools.min.js");?>
<?php echo js("themepunch.revolution.min.js");?>

<script type="text/javascript">
	var tpj=jQuery;			
	var revapi4;
	tpj(document).ready(function() {
		if(tpj("#rev_slider_4_1").revolution == undefined){
			revslider_showDoubleJqueryError("#rev_slider_4_1");
		}else{
			revapi4 = tpj("#rev_slider_4_1").show().revolution({
				sliderType:"standard",
				jsFileLocation:"scripts/",
				sliderLayout:"auto",
				dottedOverlay:"none",
				delay:9000,
				navigation: {
					keyboardNavigation:"off",
					keyboard_direction: "horizontal",
					mouseScrollNavigation:"off",
					onHoverStop:"on",
					touch:{
						touchenabled:"on",
						swipe_threshold: 75,
						swipe_min_touches: 1,
						swipe_direction: "horizontal",
						drag_block_vertical: false
					}
					,
					arrows: {
						style:"zeus",
						enable:false,
						hide_onmobile:true,
						hide_under:600,
						hide_onleave:true,
						hide_delay:200,
						hide_delay_mobile:1200,
						tmp:'<div class="tp-title-wrap"></div>',
						left: {
							h_align:"left",
							v_align:"center",
							h_offset:40,
							v_offset:0
						},
						right: {
							h_align:"right",
							v_align:"center",
							h_offset:40,
							v_offset:0
						}
					}
					,
					bullets: {
						enable:false,
						hide_onmobile:true,
						hide_under:600,
						style:"hermes",
						hide_onleave:true,
						hide_delay:200,
						hide_delay_mobile:1200,
						direction:"horizontal",
						h_align:"center",
						v_align:"bottom",
						h_offset:0,
						v_offset:32,
						space:5,
						tmp:''
					}
				},
				viewPort: {
					enable:true,
					outof:"pause",
					visible_area:"80%"
			},
			responsiveLevels:[1200,992,768,480],
			visibilityLevels:[1200,992,768,480],
			gridwidth:[1180,1024,768,480],
			gridheight:[640,640,600,600],
			lazyType:"none",
			parallax: {
				type:"mouse",
				origo:"slidercenter",
				speed:2000,
				levels:[2,3,4,5,6,7,12,16,10,25,47,48,49,50,51,55],
				type:"mouse",
			},
			shadow:0,
			spinner:"off",
			stopLoop:"off",
			stopAfterLoops:-1,
			stopAtSlide:-1,
			shuffle:"off",
			autoHeight:"off",
			hideThumbsOnMobile:"off",
			hideSliderAtLimit:0,
			hideCaptionAtLimit:0,
			hideAllCaptionAtLilmit:0,
			debugMode:false,
			fallbacks: {
				simplifyAll:"off",
				nextSlideOnWindowFocus:"off",
				disableFocusListener:false,
			}
		});
		}
	});	/*ready*/
</script>	


<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  
	(Load Extensions only on Local File Systems ! 
	The following part can be removed on Server for On Demand Loading) -->	
<?php echo js("extensions/revolution.extension.actions.min.js");?>
<?php echo js("extensions/revolution.extension.carousel.min.js");?>
<?php echo js("extensions/revolution.extension.kenburn.min.js");?>
<?php echo js("extensions/revolution.extension.layeranimation.min.js");?>
<?php echo js("extensions/revolution.extension.migration.min.js");?>
<?php echo js("extensions/revolution.extension.navigation.min.js");?>
<?php echo js("extensions/revolution.extension.parallax.min.js");?>
<?php echo js("extensions/revolution.extension.slideanims.min.js");?>
<?php echo js("extensions/revolution.extension.video.min.js");?>

