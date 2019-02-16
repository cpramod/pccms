<div class="row">
    <div class="col-lg-12">

        <div id="add-listing">
            <?php echo form_open_multipart(current_url(), array('class' => '')); ?>

            <!-- Section -->
            <div class="add-listing-section">

                <!-- Headline -->
                <div class="add-listing-headline">
                    <h3><i class="sl sl-icon-doc"></i> Basic Information</h3>
                    <label class="switch" for="" style="width:auto;"><a href="<?php echo base_url(). $post['url_title']; ?>" target="_blank" class="button red">Preview</a> <button type="submit" class="button pull-right">Save <i class="fa fa-arrow-circle-right"></i></button></label>
                </div>

                <!-- Title -->
                <div class="row with-forms">
                    <div class="col-md-12">
                        <h5>Page Title <i class="tip" data-tip-content="Name of the page"></i></h5>
                        <?php echo form_input(['name' => 'title', 'class' => 'search-field', 'value' => $post['title']]); ?>
                        
                    </div>
                </div>

                <!-- Row -->
                <div class="row with-forms">
                    <!-- Type -->
                    <div class="col-md-6">
                        <h5>URL title <i class="tip" data-tip-content="This is the 'slug' shown in the URL of your post. If you enter this, there must be NO spaces between words, instead, used dashes. You can leave this blank and we'll build one for you based on the title of your post. 
IE: new-url-title"></i></h5>
                        <?php echo form_input(['name' => 'url_title', 'class' => '', 'value' => $post['url_title'], 'placeholder' => lang('post_form_url_title_text')]); ?>
                        
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <h5>Category</h5>
                        <?php echo form_multiselect('cats[]', $post['cats'], $post['selected_cats'], ['class' => 'chosen-select-no-single']) ?>
                        
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
                    <textarea data-provide="markdown" class="wysiwyg" name="content" cols="40" rows="3" id="summary" spellcheck="true"><?php echo set_value('content', $post['content']); ?></textarea>
                </div>

                <div class="form">
                    <h5>Post Excerpt <i class="tip" data-tip-content="Enter a short ~200 character excerpt (teaser) of your post below."></i></h5>
                    <textarea data-provide="markdown" class="wysiwyg" name="excerpt" cols="40" rows="3" id="summary" spellcheck="true"><?php echo set_value('excerpt', $post['excerpt']); ?></textarea>
                </div>

                <!-- Row -->
                <div class="row with-forms">

                    <!-- Phone -->
                    <div class="col-md-6">
                        <h5>Body Class <span>(optional)</span></h5>
                        <input type="text" name="body_class" value="<?php echo set_value('body_class', $post['body_class']); ?>">
                    </div>

                    <!-- Website -->
                    <div class="col-md-6">
                        <h5>Published </h5>
                        <div class="checkboxes in-row margin-bottom-20">
                            <input type="radio" id="pub_yes" name="status" value="published" <?php echo $post['status'] == 'published'?'checked':''; ?>>
                            <label for="pub_yes">Yes</label>
                            <input type="radio" id="pub_no" name="status" value="draft" <?php echo $post['status'] == 'draft' ? 'checked' : ''; ?>>
                            <label for="pub_no">No</label>
                        </div>
                    </div>

                    
                </div>
                <!-- Row / End -->
                <div class="row with-forms">
                    <div class="col-md-12">
                        <h5>Featured Image</h5>
                        <div class="edit-profile-photo">
                            <?php if (($post['feature_image']) && is_numeric($post['feature_image'])) : ?>
                                    <img src="<?php echo getFileUrl($post['feature_image']); ?>"
                                         class="img-responsive" alt="<?php echo $post['title'] ?>">
                            <?php else: ?>
                                <?php echo img('user-avatar.jpg'); ?>
                            <?php endif; ?>
                            
                            <div class="change-photo-btn">
                                <div class="photoUpload">
                                    <span>
                                        <i class="fa fa-upload"></i>
                                        Upload Featured Image
                                    </span>
                                    <?php echo form_upload(['name' => 'file', 'class' => 'upload', 'id' => 'customFile']); ?>
                                </div>
                            </div>
                        </div>

                        OR
                        <h5>External Feature Image</h5>
                        <input type="text" name="feature_image" value="<?php echo is_numeric($post['feature_image'])==false?$post['feature_image']:''; ?>">
                        
                    </div>
                </div>

            </div>
            <!-- Section / End -->

            <!-- Section -->
            <div class="add-listing-section margin-top-45">

                <!-- Headline -->
                <div class="add-listing-headline">
                    <h3><i class="sl sl-icon-docs"></i> SEO</h3>
                </div>

                <div class="row with-forms">
                    <div class="col-md-12">
                        <h5>Meta Title <i class="tip" data-tip-content="Usually the same as your post title, but you can enter a different one here."></i></h5>
                        <?php echo form_input(['name' => 'meta_title', 'class' => 'search-field', 'value' => $post['meta_title']]); ?>
                        
                    </div>
                </div>

                <!-- Title -->
                <div class="row with-forms">
                    <div class="col-md-12">
                        <h5>Meta Keywords <i class="tip" data-tip-content="Enter the keywords for this post separated by commas."></i></h5>
                        <?php echo form_input(['name' => 'meta_keywords', 'class' => 'search-field', 'value' => $post['meta_keywords']]); ?>
                        
                    </div>
                </div>

                <!-- Description -->
                <div class="form">
                    <h5>Meta Description</h5>
                    <textarea class="" id="meta_description" name="meta_description" cols="40" rows="3" spellcheck="true"><?php echo set_value('meta_description', trim($post['meta_description'])); ?></textarea>
                </div>

            </div>
            <!-- Section / End -->


            <button type="submit" class="button preview">Submit <i class="fa fa-arrow-circle-right"></i></button>
            </form>
        </div>
    </div>

