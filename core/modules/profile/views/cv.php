<div class="row">
    <div class="col-lg-12">

        <form action="<?php echo current_url(); ?>" method="POST" enctype="multipart/form-data">
            <div class="row cv-upload">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="cv">CV</label>
                        <div class="edit-profile-photo">
                            <div class="change-photo-btn">
                                <div class="photoUpload">
                                    <span>
                                        <i class="fa fa-upload"></i>
                                        Browse Your CV
                                    </span>
                                    <input type="file" id="cv" class="upload" name="file" size="">

                                </div>
                            </div>

                        </div>
                        <?php if(!empty($cv)){
                            ?>
                            <div class="cvfile">
                                <a href="<?php echo getFileUrl($cv); ?>" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
                            </div>
                            <?php
                        } ?>
                        <span>Note: Suitable files are .doc,docx,pdf & .pdf</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="cover-letter">Your Cover Letter</label>
                        <textarea name="cover_letter" class="summernote" id="cl" cols="30" rows="10"><?php echo set_value('cover_letter', $cover_letter); ?></textarea>
                    </div>
                </div>
            </div>
            <?php if(isset($id)){
                ?>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <?php
            } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="submit" name="submit" value="Update" class="button">
                    </div>
                </div>
            </div>
    </div>
</div>
