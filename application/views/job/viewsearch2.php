<div class="row" >
    <div class="col-lg-1"></div>
    <div class="col-lg-10 panel panel-default">
        <h4 class="text-primary" ><?php echo $view['title'] ?></h4>
        <h5><?php echo $view['name'] ?></h5>
        <div class="row">
            <dl>
                <dt class="col-sm-2">
                <h6><i class="fa fa-suitcase"> </i><?php echo ' '.$view['exp_min'] ?>-<?php echo $view['exp_max'] ?> Yrs</h6>
                </dt>
                <dt class="col-sm-2">
                <h6><i class="fa fa-map-marker"> </i><?php echo ' '.$view['loc'] ?></h6>
                </dt>
                <dt class="col-sm-8">
                <h6>Key Skills : <?php echo $view['keyword'] ?></h6>
                </dt>
            </dl>
        </div>
        <div class="row">
            <dl>
                <dt class="col-sm-1">
                <h6><i class="fa fa-inr"></i></h6>
                </dt>
                <dt class="col-sm-2">
                <h6><?php
                    if ($view['hide_ctc'] == 1) {
                        echo $view['ctc_min'];
                        echo isset($view['ctc_type']) && $view['ctc_type'] == 0 ? ' P.M.' : ' P.A.';
                    } else {
                        echo 'Not to be disclosed';
                    }
                    ?></h6>
                </dt>
            </dl>
        </div>
    </div>
    <div class="col-lg-10 col-lg-offset-1 panel panel-default panel-body">
        <div class="row">
            <div class=" col-lg-12 ">
                <div class="">
                    <h5>Job Description</h5>
                    <h6><?php echo $view['description']; ?></h6>
                </div>
                <div class="form-group">
                    <h6><b>Industry :</b></h6>
                    <h6><?php echo $view['industry_name'] ?></h6>
                </div>
                <div class="form-group">
                    <h6><b>Functional Area :</b></h6>
                    <h6><?php echo $view['fun_area'] ?></h6>
                </div>
                <div class="form-group">
                    <?php
                    if ($is_logged_in == FALSE) {
                        ?>
                        <a href="<?php echo site_url('Job/apply/' . $view['job_id']); ?>"><button class="btn btn-success">Login to Apply</button></a>
                        <a href="<?php echo site_url('User/register/'); ?>"><button class="btn btn-info">Register to Apply</button></a>
                        <?php
                    } elseif ($is_logged_in == TRUE && $is_applied == TRUE) {
                        echo '<button class="btn btn-success">Already Applied</button>';
                    } else {
                        ?>
                        <a href="<?php echo site_url('Job/apply/' . $view['job_id']); ?>"><button class="btn btn-success">Apply</button></a>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>