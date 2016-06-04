<style>
    .col-sm-12 h2{
        padding: 3px;
        color: #333333;
        font-weight: 600;
        font-size: medium;
    }
    .resume-chapter h2 {
        font-weight: 400;
    }
    .education{
        border-bottom: 1px solid #F7F7F7;
        padding-bottom: 5px;
    }

    .education:last-child{
        border-bottom: 0px;
        padding-bottom: 0px;
    }
    .workinghistory{
        padding-top: 10px;
        border-bottom: 1px solid #F7F7F7;
        padding-bottom: 10px;
    }

    .workinghistory:last-child{

        border-bottom: 0px;
        padding-bottom: 0px;
    }

</style>
<?php // echo form_open('WorkExperince/work_exp')       ?>
<div class="container-fluid">
    <div class="resume">
        <div class="resume-main">
            <div class="resume-main-image">
                <img src="<?php echo asset_url(); ?>assets/img/default.png" alt="">

            </div>

            <div class="resume-main-content">
                <h2><?php
                    if ($user['name'] == '') {
                        echo "Not Mentioned";
                    } else {
                        echo $user['name'];
                    }
                    ?>
                    <small class="pull-right"><a class="btn btn-sm" onclick="request('<?php echo site_url('User/Add_profile?section=section1'); ?>')"><i class="fa fa-2x fa-edit" style="margin-right: 0px;font-size: 1.5em;"></i></a></small>

                </h2>

                <h3><?php echo isset($user['rol']) && $user['rol'] != '' ? $user['rol'] : ''; ?></h3>

                <p class="resume-main-contacts">
                    <?php echo isset($user['address1']) && $user['address1'] != '' ? $user['address1'] : ''; ?><?php echo isset($user['city']) && $user['city'] != '' ? ',' . $user['city'] : ''; ?><?php echo isset($user['pincode']) && $user['pincode'] != '' ? ',' . $user['pincode'] : ''; ?>
                    <br>
                    <b>Email: </b><a href="mailto:<?php echo isset($user['email']) && $user['email'] != '' ? $user['email'] : ''; ?>"><?php echo isset($user['email']) && $user['email'] != '' ? $user['email'] : ''; ?></a> <span class="resume-main-verified"><i class="fa fa-check"></i></span><br/>
                    <b>Mobile :</b> <?php echo isset($user['mobile']) && $user['mobile'] != '' ? $user['mobile'] : ''; ?><span class="resume-main-verified"><i class="fa fa-check"></i></span>
                </p><!-- /.resume-main-contact -->

                <!--                <div class="resume-main-actions">
                                    <a href="#" class="btn btn-secondary"><i class="fa fa-download"></i> Download</a>
                                    <a href="#" class="btn btn-default">Contact</a>
                                    <a href="#" class="btn btn-default">Save</a>
                                </div> /.resume-main-actions -->
            </div><!-- /.resume-main-content -->
        </div><!-- /.resume-main -->
        <div class="resume-chapter">
            <div class="resume-chapter-inner">
                <div class="resume-chapter-content">
                    <h2 class="mb40">Summary<span class="pull-right" onclick="request('<?php echo site_url('User/Add_profile?section=section2'); ?>')"><i class="fa <?php echo isset($user['resume_headline']) && $user['resume_headline'] != '' ? 'fa-edit' : 'fa-plus'; ?>" ></i><?php echo isset($user['resume_headline']) && $user['resume_headline'] != '' ? '' : ' Add Summary'; ?></span></h2>
                    <div class="col-sm-12">
                        <p><?php echo isset($user['resume_headline']) && $user['resume_headline'] != '' ? $user['resume_headline'] : ''; ?></p>
                    </div>
                </div><!-- /.resume-chapter-content -->
            </div><!-- /.resume-chapter-inner -->
        </div><!-- /.resume-chapter -->

        <div class="resume-chapter">
            <div class="resume-chapter-inner">
                <div class="resume-chapter-content">
                    <h2 class="mb40">Working History<span class="pull-right" onclick="request('<?php echo site_url('User/user_projects'); ?>')"><i class="fa fa-plus"> </i> Add Position</span></h2>
                    <div class="col-sm-12">
                        <?php foreach ($user2 as $u) : ?>
                            <div class="workinghistory">
                                <h2 style="font-weight: 700;color: #666666"><?php echo $u->role; ?></h2>
                                <h2 style="color: #666666;"><?php echo $u->client; ?><small class="pull-right"><a onclick="request('<?php echo site_url('User/edit_project') . '?id=' . $u->id; ?>')"><i class="fa  fa-edit" style=" font-size: 1.5em;cursor: pointer"></i>  </a>
                                        <a onclick="deleteworkexp('<?php echo site_url('User/delete_project') . '?id=' . $u->id; ?>')"> <i class="fa  fa-trash" style="color:#CE5858; font-size: 1.5em ;cursor: pointer" ></i>  </a>
                                    </small></h2>
                                <h2 style="color: #666666;font-weight: 300"><?php echo date('M-Y', strtotime($u->from)); ?> - <?php echo date('M-Y', strtotime($u->to)); ?> | <?php echo $u->location; ?></h2>
                                <p style="padding-left: 3px"><?php echo $u->role_description; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div><!-- /.resume-chapter-content -->
            </div><!-- /.resume-chapter-inner -->
        </div><!-- /.resume-chapter -->

        <div class="resume-chapter">
            <div class="resume-chapter-inner">
                <div class="resume-chapter-content">
                    <h2 class="mb40">Education Detail<a class="pull-right" onclick="request('<?php echo site_url('User/user_qualification'); ?>')"><i class="fa fa-plus"></i> Add Education</a></h2>

                    <div class="col-sm-12">
                        <?php if (!empty($user3)) foreach ($user3 as $u) : ?>
                                <div class="education">
                                    <h2><?php echo $u->institute; ?></h2>
                                    <h2 style="color: #666666" class="mb40"><?php echo $u->qualification . ', ' . $u->specialization; ?><small class="pull-right"><a onclick="request('<?php echo site_url('User/edit_qualification') . '?id=' . $u->idd; ?>')"><i class="fa  fa-edit" style="margin-right: 0px;font-size: 1.5em; cursor: pointer"></i></a>


                                            <a onclick="deleteeduction('<?php echo site_url('User/delete_edu') . '?id=' . $u->idd; ?>')"> <i class="fa  fa-trash" style="color:#CE5858; font-size: 1.5em;cursor: pointer"></i>  </a>

                                        </small></h2>
                                    <h2 style="color: #666666;font-weight: 300;padding-bottom: 10px"><?php echo $u->year; ?></h2>
                                </div>
                            <?php endforeach; ?>
                    </div>

                </div><!-- /.resume-chapter-content -->
            </div><!-- /.resume-chapter-inner -->
        </div><!-- /.resume-chapter -->

        <div class="resume-chapter">
            <div class="resume-chapter-inner">
                <div class="resume-chapter-content">
                    <h2 class="mb40">Other Details<small class="pull-right"><a class="btn btn-sm" onclick="request('<?php echo site_url('User/Add_profile?section=section4'); ?>')"><i class="fa  fa-edit" style="margin-right: 0px;font-size: 1.5em;"></i></a></small></h2>
                    <div class="col-sm-4">
                        <ul>
                            <li>Marital Status, <span><?php echo $user['marital_status'] != '' && $user['marital_status'] != '0000-00-00' ? $user['marital_status'] : ''; ?></span></li>
                            <li>Date Of Birth, <span><?php echo $user['dob'] != '' && $user['dob'] != '0000-00-00' ? $user['dob'] : ''; ?></span></li>
                            <li>Gender, <span><?php echo $user['gender'] != '' && $user['gender'] != '0000-00-00' ? $user['gender'] : ''; ?></span></li>
                        </ul>
                    </div><!-- /.col-* -->
                    <div class="col-sm-8">
                        <ul>

                            <li>Functional Area, <span><?php echo $user['fun_area'] != '' ? $user['fun_area'] : ''; ?></span></li>
                            <li>Preferred Location, <span><?php echo $user['prefred_location'] != '' ? $user['prefred_location'] : ''; ?></span></li>
                        </ul>
                    </div><!-- /.col-* -->

                </div>
            </div>
        </div>
        <div class="resume-chapter">
            <div class="resume-chapter-inner">
                <div class="resume-chapter-content">
                    <h2 class="mb40">Skills</h2>
                    <div class="col-sm-4">
                        <h3>Skills<small class="pull-right"><a class="btn btn-sm" style="padding: 0" onclick="request('<?php echo site_url('User/skill?section=section1'); ?>')"><i class="fa fa-2x <?php echo empty($skill) ? 'fa-plus' : 'fa-edit' ?>" style="margin-right: 0px;font-size: 1.5em;"><?php echo empty($skill) ? '' : '' ?></i></a></small></h3>

                        <ul>
                            <?php
                            if (!empty($skill)) {
                                foreach ($skill as $value) {
                                    echo '<li>' . $value->skill_name . '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div><!-- /.col-* -->
                    <div class="col-sm-4">
                        <h3>Computer Skills<small class="pull-right"><a class="btn btn-sm" style="padding: 0" onclick="request('<?php echo site_url('User/skill?section=section2'); ?>')"><i class="fa fa-2x <?php echo empty($comskill) ? 'fa-plus' : 'fa-edit' ?>" style="margin-right: 0px;font-size: 1.5em;"><?php echo empty($comkill) ? '' : '' ?></i></a></small></h3>
                        <ul>
                            <?php
                            if (!empty($comskill)) {
                                $comskill = array_shift($comskill);
                                $comskill = explode(",", $comskill->com_skill);
                                foreach ($comskill as $value) {
                                    echo '<li>' . $value . '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div><!-- /.col-* -->
                    <div class="col-sm-4">
                        <h3>Language<small class="pull-right"><a class="btn btn-sm" style="padding: 0" onclick="request('<?php echo site_url('User/skill?section=section3'); ?>')"><i class="fa fa-2x <?php echo empty($lang) ? 'fa-plus' : 'fa-edit' ?>" style="margin-right: 0px;font-size: 1.5em;"><?php echo empty($lang) ? '' : '' ?></i></a></small></h3>
                        <ul>
                            <?php
                            if (!empty($lang)) {
                                //var_dump($lang);
                                foreach ($lang as $value) {
                                    echo '<li>' . $value->language . '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div><!-- /.col-* -->

                </div>
            </div>
        </div>
    </div><!-- /.resume -->
</div><!-- /.container -->
<div id="ajaxcontainer">

</div>

<script>
    $(document).ready(function () {
        var isIE = navigator.userAgent.indexOf(' MSIE ') > -1;
        if (isIE) {
            $('#BookAppointment').removeClass('fade');
        }
        $("#fullCalModal").modal();
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });


    function request(url) {
        var url = url;
        $.ajax({
            //Send request
            type: 'GET',
            data: {},
            url: url,
            success: function (data) {
                $("#loader").hide();
                $("#ajaxcontainer").html(data);

                $("#fullCalModal").modal();
            }
        });
    }
</script>
<style>
    .education_margin{
        margin-bottom: 10px;
    }
</style>
<script>
    function deleteworkexp(url) {
        var r = confirm("Are you sure you want to delete");
        if (r == true)
        {
            window.location = url;

        }
        else
        {
            return false;
        }
    }

    function deleteeduction(url) {
        var r = confirm("Are you sure you want to delete");
        if (r == true)
        {
            window.location = url;

        }
        else
        {
            return false;
        }
    }
</script>
