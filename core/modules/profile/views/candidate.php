<div class="gradient" id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-title">
                    <?php echo $template['title']; ?>
                </h1>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <?php foreach ($template['breadcrumbs'] as $breadcrumb) {
                            ?>
                        <li><a href="<?php echo $breadcrumb['uri']; ?>">
                                <?php echo $breadcrumb['name']; ?></a></li>
                        <?php

                            } ?>
                    </ul>
                </nav>
                <div class="cv">
                    <?php
                    if(count($cv)>0){
                        ?>
                        <a href="<?php echo getFileUrl($cv[0]['cv']); ?>" class="button voilet"><i class="fa fa-download"></i> Download CV</a>
                        <?php
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="candidate-info">
                <h3>About Me</h3>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $bio; ?>
                    </div>
                </div>

                <h3>Skills</h3>
                <ul class="skills">
                    <?php foreach($skills as $skill): ?>
                    <li>
                        <?php echo $skill['title']; ?>
                        <div class="skill-container">
                            <div class="skill" style="width:<?php echo $skill['rate']; ?>%;">
                                <?php echo $skill['rate']; ?>%</div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <h3>Education</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div id="timeline" class="timeline-container">

                            <?php foreach($educations as $education): //print_r($education); ?>
                            <div class="timeline-wrapper row">
                                <div class="content">
                                    <div class="date">
                                        <?php echo $education['from_date'] . ' - ' . $education['to_date']; ?>
                                    </div>
                                    <h2>
                                        <?php echo $education['institute']; ?>
                                    </h2>
                                    <div class="level">
                                        <?php echo $education['title']; ?>
                                    </div>
                                    <div class="description">
                                        <?php echo $education['description']; ?>
                                    </div>
                                </div>
                            </div>

                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>

                <h3>Work Experience</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div id="timeline" class="timeline-container">

                            <?php foreach ($experiences as $experience) : //print_r($education); ?>
                            <div class="timeline-wrapper row">
                                <div class="content">
                                    <div class="date">
                                        <?php echo $experience['from_date'] . ' - ' . $experience['to_date']; ?>
                                    </div>
                                    <h2>
                                        <?php echo $experience['company']; ?>
                                    </h2>
                                    <div class="level">
                                        <?php echo $experience['title']; ?>
                                    </div>
                                    <div class="description">
                                        <?php echo $experience['description']; ?>
                                    </div>
                                </div>
                            </div>


                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>

                <h3>Awards and Certificates</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div id="timeline" class="timeline-container">

                            <?php foreach ($awards as $award) : //print_r($education); ?>

                            <div class="timeline-wrapper row">
                                <div class="content">
                                    <div class="date">
                                        <?php echo date('M d, Y', strtotime($award['date'])); ?>
                                    </div>
                                    <h2>
                                        <?php echo $award['title']; ?>
                                    </h2>
                                    <div class="description">
                                        <?php echo $award['description']; ?>
                                    </div>
                                </div>
                            </div>

                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>



            </div>

        </div>
        <div class="col-md-3">
            <div class="sidebar">
                <img src="<?php echo getFileUrl($avatar); ?>">
                <h3>
                    <?php echo $first_name.' '.$last_name; ?>
                </h3>
                <div class="position">
                    <?php echo $meta['job_title']; ?>
                </div>
            </div>
            <div class="sidebar info">
                <h3>Candidate Detail</h3>
                <ul class="info">
                    <li><i class="fa fa-calendar"></i>Member Since <br> <strong>
                            <?php echo date('M d, Y',$created_on); ?></strong></li>
                    <li><i class="fa fa-phone"></i>Cell No <br> <strong>
                            <?php echo $phone; ?></strong></li>
                    <li><i class="sl sl-icon-envelope-open"></i>Email Address <br> <strong>
                            <?php echo $email; ?></strong></li>
                    <li><i class="fa fa-map-marker"></i>Location Address <br> <strong>
                            <?php echo $meta['address']; ?></strong></li>
                </ul>
            </div>
        </div>
    </div>
</div>
