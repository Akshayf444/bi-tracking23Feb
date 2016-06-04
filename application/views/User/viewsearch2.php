<style>
    h6{
        font-weight: 700;
    }
</style>
<div class="container">
    <div class="row" >
        <div class="col-sm-12 panel panel-default">
            <h5 ><?php echo $view['title'] ?></h5>
            <h6><?php echo $view['name'] ?></h6>


            <?php if ($is_logged_in == TRUE && $is_applied2 == TRUE) { ?>
                <button class="btn btn-primary pull-right">Already Saved</button>

            <?php } else {
                ?>
                <a href="<?php echo site_url('User/saved_jobs/' . $view['job_id']); ?>"><button class="btn btn-primary pull-right">Save This Job</button></a>


            <?php } ?>
            <div class="row">
                <dl>
                    <dt class="col-sm-1">
                    <h6><?php echo $view['exp_min'] ?>-<?php echo $view['exp_max'] ?>Yrs</h6>
                    </dt>
                    <dt class="col-sm-2">
                    <h6><?php echo $view['loc'] ?></h6>
                    </dt>
                    <dt class="col-sm-2">
                    <h6>Key Skills :</h6>
                    </dt>
                    <dt class="col-sm-2">
                    <h6><?php echo $view['keyword'] ?></h6>
                    </dt>
                </dl>
            </div>

            <div class="row">
                <dl>
                    <dt class="col-sm-1">
                    <h6>RS</h6>
                    </dt>
                    <dt class="col-sm-2">
                    <h6><?php echo $view['ctc_min'] ?> P.A</h6>
                    </dt>
                </dl>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 panel panel-default">
            <div class="row">
                <div class=" col-lg-12 ">
                    <div class="">
                        <h5><b>Job Description</b></h5>
                        <?php echo $view['description']; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class=" col-sm-12 ">
                    <div class="row">
                        <div class="col-sm-2">
                            <h6>Salary :</h6>
                        </div>
                        <div class="col-sm-4">
                            <h6><?php
                                if ($view['hide_ctc'] == 1) {

                                    echo $view['ctc_min'] . " PA";
                                } else {
                                    echo "not disclose";
                                }
                                ?></h6>
                        </div>
                    </div>
                </div>
                <div class=" col-lg-12 ">
                    <div class="row">
                        <div class="col-sm-2">
                            <h6>Industry :</h6>
                        </div>
                        <div class="col-sm-4">
                            <h6><?php echo $view['industry'] ?></h6>
                        </div>
                    </div>
                </div>
                <div class=" col-lg-12 ">
                    <div class="row">
                        <div class="col-sm-2">
                            <h6>Function Area :</h6>
                        </div>
                        <div class="col-sm-4">
                            <h6><?php echo $view['fun_area'] ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class=" col-lg-12 ">
                    <p><b>Key Skills : </b> <?php echo $view['keyword']; ?></p>
                </div>
            </div>
            <div class="row" style="margin-top: 58px;margin-bottom: 18px;">
                <div class="col-sm-12">
                    <?php
                    if ($is_logged_in == FALSE) {
                        ?>
                        <a href="<?php echo site_url('Job/apply/' . $view['job_id']); ?>"><button class="btn btn-success">Login to Apply</button></a>
                        <a href=""><button class="btn btn-info">Register to Apply</button></a>
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
