<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"> <?php echo $user['title'];?></h3>
    </div></div>
<div class="row">
    <div class="col-lg-12">
        <a href="<?php echo site_url("Job/edit/{$user['job_id']}" ); ?>" class="pull-right">Edit</a> 
        
        <p><b>  No of vacancies </b>  &nbsp;<?php
            if ($user['no_of_vacancy'] == '') {
                echo ' Not Mention';
            } else {
                echo $user['no_of_vacancy'];
            }
            ?></p>

        <p><b>  Job Description  </b><?php if ($user['description'] == '') {
                echo ' Not Mention';
            } else {
                echo $user['description'];
            }
            ?>
        
        <p><b>  keywords </b>  &nbsp;<?php
            if ($user['keyword'] == '') {
                echo ' Not Mention';
            } else {
                echo $user['keyword'];
            }
            ?>

        </p>

        <p><b>  Work Experince</b>  &nbsp;<?php
            if ($user['exp_min'] && $user['exp_max'] == '') {
                echo ' Not Mention';
            } else {
                echo $user['exp_min'] ." Year";
                echo $user['exp_max'] ." Month";
            }
            ?></p>




        </p>

        <p><b>  CTC </b>  &nbsp;<?php
            if ($user['ctc_type'] == '') {
                echo ' Not Mention';
            }
            if ($user['ctc_type'] == 0) {
                echo 'Per Month';
            } else {
                echo 'Per Year';
            }
            ?></p>
        <p><b>  Hide Salary From Jobseeker </b>  &nbsp;<?php
            if ($user['hide_ctc'] == '') {
                echo ' Not Mention';
            }
            if ($user['hide_ctc'] == 0) {
                echo 'Yes';
            } else {
                echo 'No ';
            }
            ?>
        </p>
        <p><b> Location </b>  &nbsp;<?php
            if ($user['loc'] == '') {
                echo ' Not Mention';
            } else {
                echo $user['loc'];
            }
            ?>
        </p>
        <p><b> Industry</b>  &nbsp;<?php
            if ($user['industry_name'] == '') {
                echo ' Not Mention';
            } else {
                echo $user['industry_name'];
            }
            ?>
        </p>
        <p><b> Function Area</b>  &nbsp;<?php
            if ($user['fun_area'] == '') {
                echo ' Not Mention';
            } else {
                echo $user['fun_area'];
            }
            ?></p>


    </div>
</div>




