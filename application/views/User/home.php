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
    .positions-list-item {
        padding-bottom: 5px;
        padding-top: 3px;
    }

    .resume {
        margin-bottom: 20px;
    }

    .btn-xs{
        line-height: 0.5;
    }
</style>
<?php // echo form_open('WorkExperince/work_exp')       ?>

<div class="container-fluid">
    <div class="resume">
        <div class="resume-main">
            <div class="resume-main-image">
                <img src="<?php echo asset_url(); ?>assets/img/default.png" alt="">

                <!--                <a href="#" class="resume-main-image-label">
                                    <img src="assets/img/tmp/instagram.png" alt="">
                                </a>-->
            </div>

            <div class="resume-main-content">
                <h2><?php
                    if ($user['name'] == '') {
                        echo "Not Mentioned";
                    } else {
                        echo $user['name'];
                    }
                    ?>


                </h2>

                <h3><?php echo isset($user['rol']) && $user['rol'] != '' ? $user['rol'] : ''; ?></h3>

                <p class="resume-main-contacts">
                    <?php echo isset($user['address1']) && $user['address1'] != '' ? $user['address1'] : ''; ?><?php echo isset($user['city']) && $user['city'] != '' ? ',' . $user['city'] : ''; ?><?php echo isset($user['pincode']) && $user['pincode'] != '' ? ',' . $user['pincode'] : ''; ?>
                    <br>
                    <b>Email: </b><a href="mailto:<?php echo isset($user['email']) && $user['email'] != '' ? $user['email'] : ''; ?>"><?php echo isset($user['email']) && $user['email'] != '' ? $user['email'] : ''; ?></a> <span class="resume-main-verified"><i class="fa fa-check"></i></span><br><b style="padding-left: 0px">Mobile :</b> <?php echo isset($user['mobile']) && $user['mobile'] != '' ? $user['mobile'] : ''; ?><span class="resume-main-verified"><i class="fa fa-check"></i></span>
                </p><!-- /.resume-main-contact -->


            </div><!-- /.resume-main-content -->
        </div><!-- /.resume-main -->
    </div><!-- /.resume -->
    <div class="row">
        <div class="col-sm-12">
            <h2>Latest Job Matching Your Profile</h2>
            <div class="positions-list">
                <?php
                if (isset($jobs) && !empty($jobs) && is_array($jobs)) {

                    foreach ($jobs as $j) {
                        ?>
                        <div class="positions-list-item">
                            <h3>
                                <a href="<?php echo site_url('Job/viewDetails/' . $j->job_id) ?>"><?php echo $j->title ?></a>
                                <small class="pull-right"><a href="<?php echo site_url('User/view_search2') . '?id=' . $j->job_id; ?>" class="btn btn-warning btn-xs">Apply</a></small>
                            </h3>
                            <p style="margin: 0px"><?php echo $j->name ?></p>
                            <div class="row">
                                <div class="col-sm-2">
                                    <h6 style="margin: 0;padding: 0px"><i class="fa fa-suitcase"> </i><?php echo ' ' . $j->exp_min; ?>-<?php echo $j->exp_max ?> Yrs</h6>
                                </div>
                                <div class="col-sm-2">
                                    <h6 style="margin: 0;padding: 0px"><i class="fa fa-map-marker"> </i><?php echo ' ' . $j->loc ?></h6>
                                </div>
                                <div class="col-sm-8">
                                    <h6 style="margin: 0;padding: 0px"><i class="fa fa-inr"></i> : <?php
                                        if ($j->hide_ctc == 1) {
                                            echo $j->ctc_min;
                                            echo isset($j->ctc_type) && $j->ctc_type == 0 ? ' P.M.' : ' P.A.';
                                        } else {
                                            echo 'Not to be disclosed';
                                        }
                                        ?></h6>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p><?php echo $j->description ?></p>
                                    <h6 style="margin: 0;padding: 0px"><b>Key Skills : </b><?php echo $j->keyword ?><small class="pull-right">Posted On : <?php echo date('d-m-Y', strtotime($j->posted_at)) ?></small></h6>
                                </div>
                            </div>

                            <!--                        <div class="position-list-item-date">10/11/2015</div> /.position-list-item-date 
                                                    <div class="position-list-item-action"><a href="#">Save Position</a></div> /.position-list-item-action -->
                        </div><!-- /.position-list-item -->
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
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
    });


    function request(url) {
        var url = url;
//        $.ajax({
//            //Send request
//            type: 'GET',
//            data: {},
//            url: url,
//            success: function (data) {
//                $("#loader").hide();
//                $("#ajaxcontainer").html(data);
//                
//                $("#fullCalModal").modal();
//            }
//        });
    }
</script>
<style>
    .education_margin{
        margin-bottom: 10px;
    }
</style>