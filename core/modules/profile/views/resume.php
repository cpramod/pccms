<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-graduation-cap"></i> Education</h3>

        <div class="row">
            <div class="col-md-12">
                <table class="basic-table">
                    <tr>
                        <th>Qualifications</th>
                        <th>Dates</th>
                        <th>School / Colleges</th>
                        <th></th>
                    </tr>
                    
                        <?php foreach($educations as $education){   
                            ?>
                            <tr class="">
                                <td><?php echo $education['title']; ?></td>
                                <td><?php echo $education['from_date'].'-'.$education['to_date']; ?></td>
                                <td><?php echo $education['institute']; ?></td>
                                <td>
                                    <div class="fm-close">
                                        <a class="education_edit popup-with-zoom-anim" data-id="<?php echo $education['id']; ?>" href="#add_education"><i class="fa fa-edit"></i></a>
                                        <a class="delete" onclick="return confirm('Are you sure?');" href="<?php echo site_url('profile/resume/education/delete/' . $education['id']); ?>"><i class="fa fa-remove"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <?php
                        } ?>
                        
                </table>

                
                <div class="row">
                    <div class="col-md-12">
                        <a href="#add_education" class="button popup-with-zoom-anim">Add New</a>
                    </div>
                </div>
                

            </div>
        </div>
        

        




        <h3><i class="fa fa-briefcase"></i> Experience</h3>
        <div class="row">
            <div class="col-md-12">
                <table class="basic-table">
                    <tr>
                        <th>Skills @ Company</th>
                        <th>Dates</th>
                        <th>Company</th>
                        <th></th>
                    </tr>
                    <?php foreach ($experiences as $experience) {
                        ?>
                            <tr class="">
                                <td><?php echo $experience['title']; ?></td>
                                <td><?php echo $experience['from_date'] . '-' . $experience['to_date']; ?></td>
                                <td><?php echo $experience['company']; ?></td>
                                <td>
                                    <div class="fm-close">
                                        <a class="experience_edit popup-with-zoom-anim" data-id="<?php echo $experience['id']; ?>" href="#add_experience"><i class="fa fa-edit"></i></a>
                                        <a class="delete" onclick="return confirm('Are you sure?');" href="<?php echo site_url('profile/resume/experience/delete/' . $experience['id']); ?>"><i class="fa fa-remove"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <?php

                        } ?>
                </table>
                <a href="#add_experience" class="button popup-with-zoom-anim">Add New</a>

            </div>

        </div>
        
        

        <!-- <h3>Portfolio</h3>
        <div class="row">
            <div class="col-md-12">
                <table class="basic-table">
                    <tr>
                        <th>Qualifications</th>
                        <th>Dates</th>
                        <th>School / Colleges</th>
                        <th></th>
                    </tr>
                    <tr class="">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="fm-close"><a class="delete" href="#"><i class="fa fa-remove"></i></a></div>
                        </td>
                    </tr>
                </table>
                <a href="#add_education" class="button popup-with-zoom-anim">Add Item</a>

            </div>

        </div> -->
        
        <h3><i class="fa fa-pie-chart"></i> Skills</h3>
        <div class="row">
            <div class="col-md-12">
                <table class="basic-table">
                    <tr>
                        <th>Skill Or Expertise</th>
                        <th>Level</th>
                        <th></th>
                    </tr>
                    <?php foreach ($skills as $skill) {
                        ?>
                            <tr class="">
                                <td><?php echo $skill['title']; ?></td>
                                <td><?php echo $skill['rate']; ?></td>
                                <td>
                                    <div class="fm-close">
                                        <a class="skill_edit skill-button " data-id="<?php echo $skill['id']; ?>" href="javascript:"><i class="fa fa-edit"></i></a>
                                        <a class="delete" onclick="return confirm('Are you sure?');" href="<?php echo site_url('profile/resume/skills/delete/' . $skill['id']); ?>"><i class="fa fa-remove"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <?php

                        } ?>
                </table>
                <?php echo $this->template->load_view('includes/add_skills'); ?>
                <a href="javascript:" class="button skill-button">Add New</a>

            </div>
        </div>

        <h3><i class="fa fa-trophy"></i> Honors & Awards</h3>
        <div class="row">
            <div class="col-md-12">
                <table class="basic-table">
                    <tr>
                        <th>Honors / Awards</th>
                        <th>Dates</th>
                        <th></th>
                    </tr>
                    <?php foreach ($awards as $award) {
                        ?>
                            <tr class="">
                                <td><?php echo $award['title']; ?></td>
                                <td><?php echo $award['date']; ?></td>
                                
                                <td>
                                    <div class="fm-close">
                                        <a class="awards_edit popup-with-zoom-anim" data-id="<?php echo $award['id']; ?>" href="#add_awards"><i class="fa fa-edit"></i></a>
                                        <a class="delete" onclick="return confirm('Are you sure?');" href="<?php echo site_url('profile/resume/awards/delete/' . $award['id']); ?>"><i class="fa fa-remove"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <?php

                        } ?>
                </table>
                <a href="#add_awards" class="button popup-with-zoom-anim">Add New</a>

            </div>
        </div>

    </div>

</div>


<?php echo $this->template->load_view('includes/add_qualification'); ?>
<?php echo $this->template->load_view('includes/add_experience'); ?>
<?php echo $this->template->load_view('includes/add_awards'); ?>