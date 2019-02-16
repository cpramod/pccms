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
                        <h5>Page Title <i class="tip" data-tip-content="Name of the page"></i></h5>
                        <input class="search-field" type="text" name="title" value="<?php echo set_value('title'); ?>" />
                    </div>
                </div>

                <!-- Row -->
                <div class="row with-forms">
                    <!-- Type -->
                    <div class="col-md-6">
                        <h5>URL title <i class="tip" data-tip-content="This is the 'slug' shown in the URL of your post. If you enter this, there must be NO spaces between words, instead, used dashes. You can leave this blank and we'll build one for you based on the title of your post. 
IE: new-url-title"></i></h5>
                        <input type="text" placeholder="Slug should have no space between the words" name="slug" value="<?php echo set_value('slug'); ?>">
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        
                    </div>

                    

                </div>
                <!-- Row / End -->

            </div>
            <!-- Section / End -->

            

            <!-- Section -->
            <div class="add-listing-section margin-top-45">

                <!-- Headline -->
                <div class="add-listing-headline">
                    <h3><i class="sl sl-icon-docs"></i> Details</h3>
                </div>

                <!-- Description -->
                <div class="form">
                    <h5>Description</h5>
                    <textarea data-provide="markdown" class="wysiwyg" name="body" cols="40" rows="3" id="summary" spellcheck="true"></textarea>
                </div>

                <!-- Row -->
                <div class="row with-forms">

                    <!-- Phone -->
                    <div class="col-md-6">
                        <h5>Body Class <span>(optional)</span></h5>
                        <input type="text" name="body_class" value="<?php echo set_value('body_class'); ?>">
                    </div>

                    <!-- Website -->
                    <div class="col-md-6">
                        <h5>Published </h5>
                        <div class="checkboxes in-row margin-bottom-20">
                            <input type="radio" id="pub_yes" name="is_published" value="1" checked>
                            <label for="pub_yes">Yes</label>
                            <input type="radio" id="pub_no" name="is_published" value="0">
                            <label for="pub_no">No</label>
                        </div>
                    </div>

                    
                </div>
                <!-- Row / End -->

            </div>
            <!-- Section / End -->

            <!-- Section -->
            <div class="add-listing-section margin-top-45">

                <!-- Headline -->
                <div class="add-listing-headline">
                    <h3><i class="sl sl-icon-docs"></i> SEO</h3>
                </div>

                <!-- Title -->
                <div class="row with-forms">
                    <div class="col-md-12">
                        <h5>Meta Keywords <i class="tip" data-tip-content="Keywords must be separated with comma"></i></h5>
                        <input class="search-field" type="text" name="meta_keywords" value="<?php echo set_value('meta_keywords'); ?>" />
                    </div>
                </div>

                <!-- Description -->
                <div class="form">
                    <h5>Meta Description</h5>
                    <textarea class="" name="meta_description" cols="40" rows="3" id="meta_description" spellcheck="true"><?php echo set_value('meta_description'); ?></textarea>
                </div>

            </div>
            <!-- Section / End -->


            <button type="submit" class="button preview">Submit <i class="fa fa-arrow-circle-right"></i></button>
            </form>
        </div>
    </div>


 