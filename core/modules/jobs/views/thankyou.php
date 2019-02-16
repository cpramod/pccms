<div class="row">
    <div class="col-md-12">
        <h3>Thank You</h3>
        <div class="row">
            <div class="col-md-12">
                <p>Thank you for posting your job with us. Your Job post will be live once the payment is processed. You will be notified on the process.</p>

                <h4>Job Summary</h4>
                <?php /// print_r($jobs); ?>
                <table class="basic-table">
                    <tr>
                        <th>Features</th>
                        <th>Options</th>
                        
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td><?php echo $jobs['title']; ?></td>
                    </tr>
                    <tr>
                        <td>Job Type</td>
                        <td><?php echo Modules::load('jobs')->getTitleBySlug($jobs['job_type'],'job_type'); ?></td>
                    </tr>
                    <tr>
                        <td>Specialism</td>
                        <td><?php echo Modules::load('jobs')->getTitleBySlug($jobs['job_category'],'job_category'); ?></td>
                    </tr>
                    <tr>
                        <td>Offered Salary</td>
                        <td><?php echo $jobs['offered_salary']?Modules::load('jobs')->getTitleBySlug($jobs['offered_salary'],'salary'):'Negotiable'; ?></td>
                    </tr>
                    <tr>
                        <td>Career Level</td>
                        <td><?php echo Modules::load('jobs')->getTitleBySlug($jobs['career_level'],'career_level'); ?></td>
                    </tr>
                    <tr>
                        <td>Experience</td>
                        <td><?php echo Modules::load('jobs')->getTitleBySlug($jobs['experience'],'experience'); ?></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td><?php echo Modules::load('jobs')->getTitleBySlug($jobs['gender'],'gender'); ?></td>
                    </tr>
                    <tr>
                        <td>Industry</td>
                        <td><?php echo Modules::load('jobs')->getTitleBySlug($jobs['industry'],'industry'); ?></td>
                    </tr>
                    <tr>
                        <td>Qualification</td>
                        <td><?php echo Modules::load('jobs')->getTitleBySlug($jobs['qualification'],'qualification'); ?></td>
                    </tr>
                    <tr>
                        <td>Application Deadline</td>
                        <td><?php echo date('M d,Y',$jobs['deadline']); ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo $jobs['address']; ?></td>
                    </tr>
                    <tr>
                        <td>Package</td>
                        <td><?php echo package($jobs['package']); ?></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>