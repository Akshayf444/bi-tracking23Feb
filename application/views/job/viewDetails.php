<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10 panel panel-default">
        <h5 ><?php echo $view['title'] ?></h5>
        <h6><?php echo $view['name'] ?></h6>
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
    <div class="col-lg-1"></div>
    <div class="col-lg-10 panel panel-default">
        <div class="row">
            <div class=" col-lg-6 ">
                <div class="">
                    <h5><b>Job Description</b></h5>
                    <h6><?php echo $view['description']; ?></h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class=" col-lg-12 ">
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
            <div class=" col-lg-12 ">
                <div class="col-sm-2">
                    <h6>Industry :</h6>
                </div>
                <div class="col-sm-4">
                    <h6><?php echo $view['industry'] ?></h6>
                </div>
            </div>
            <div class=" col-lg-12 ">
                <div class="col-sm-2">
                    <h6>Function Area :</h6>
                </div>
                <div class="col-sm-4">
                    <h6><?php echo $view['fun_area'] ?></h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class=" col-lg-12 ">

                <h6>Key Skills</h6>

            </div>
            <div class="col-sm-6">
                <span><?php echo $view['keyword']; ?></span>

            </div>
        </div>
        <div class="row" style="margin-top: 58px;margin-bottom: 18px;">
            <div class="col-sm-4">
                <a href="../User/login"><button class="btn btn-success">Log In To Apply</button></a>
            </div>
            <div class="col-sm-4">
                <a href="../User/register"><button class="btn btn-primary">Register In To Apply</button></a>
            </div>
        </div>
    </div>

</div>