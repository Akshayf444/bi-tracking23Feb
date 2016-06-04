<script type="text/javascript" src="<?php echo asset_url(); ?>assets/libraries/countup/countup.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url(); ?>assets/libraries/choosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url(); ?>assets/libraries/choosen/chosen.proto.js"></script>
<link href="<?php echo asset_url(); ?>assets/libraries/choosen/chosen.min.css" rel="stylesheet" type="text/css" id="style-primary">
<style>
    .searchbox{
        padding: 5px;
    }
    .inputlg{
        height: 60px;
    }
    .bootstrap-tagsinput{
        width: 100%;
        height: 60px;

    }
    .recruit span {
        display: block;
        background: transparent url("<?php echo asset_url(); ?>assets/img/home.png") no-repeat scroll 0% 0%;
        width: 34px;
        height: 28px;
        margin: 10px 44%;
    }
    .recruit  span.cand {
        background-position: -46px -51px;
        width: 30px;
        height: 40px;
    }
    .recruit span.match {
        background-position: -78px -56px;
    }

    .recruit  span.company {
        background-position: -124px -57px;
    }
    .cand {
        color: #062937;
        float: left;
        font-size: 12px;
        height: 40px;
        margin: 9px 5px 0px;
        text-shadow: 1px 1px 1px #FFF;
        width: 120px;
        text-transform: uppercase;
    }

    .testmonial{
        background-color: #46b8da;
    }

    .dropdown-toggle{
        height: 60px;
    }

    .stats {
        margin: 0px 0px 20px 0px;
    }
</style>
<div class="hero-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 ">
                <div class="col-lg-12" style="text-align: center">
                    <h1 style="font-size: 30px;">We offer <span class="noofjob"><?php echo $totalCount; ?></span> job vacancies right now!</h1>
                </div>

                <?php
                $attribute = array('method' => 'get');
                echo form_open('Job/Search', $attribute);
                ?>
                <div class="row">
                    <div class="form-group col-sm-5 searchbox"  >
                        <input type="text" required="required" class="form-control inputlg" id="skills" name="skill" placeholder="Job Title / Skills / Company etc">
                    </div><!-- /.form-group -->
                    <div class="form-group col-sm-5 searchbox" >
                        <input type="text" class="form-control inputlg" id="location" name="location" placeholder="Type Location">
                    </div>
                    <div class="form-group col-sm-2 searchbox" >
                        <button type="submit" class="btn btn-block btn-success inputlg" style="font-size: 22px">Search</button>
                    </div><!-- /.form-group -->
                </div><!-- /.row -->
                </form>

            </div><!-- /.col-* -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.hero-content -->
<div class="stats">
    <div class="container">
        <div class="row">
            <div class="stat-item col-sm-4" data-to="<?php echo $totalCount; ?>">
                <strong id="stat-item-1">0</strong>
                <span>Jobs Added</span>
            </div><!-- /.col-* -->

            <div class="stat-item col-sm-4" data-to="187432">
                <strong id="stat-item-2">0</strong>
                <span>Active Resumes</span>
            </div><!-- /.col-* -->

            <div class="stat-item col-sm-4" data-to="140312">
                <strong id="stat-item-3">0</strong>
                <span>Positions Matched</span>
            </div><!-- /.col-* -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.stats -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <img src="https://tpc.googlesyndication.com/simgad/10807557515340730654">
            <img src="https://tpc.googlesyndication.com/simgad/6315498124850830248">
        </div>
        <div class="col-sm-12 col-md-9">
            <div class="col-lg-12 col-sm-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active" >
                        <a href="<?php //echo site_url('User/login');                    ?>" aria-controls="personal" role="tab" data-toggle="tab">
                            <strong>Top Companies/Consultancy</strong>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" style="margin-bottom: 10px">
                    <div role="tabpanel" class="tab-pane active col-sm-12 col-xs-12" id="personal">
                        <div class="candidate-boxes">
                            <div class="footer-top-block">                                
                                <?php
                                if (!empty($companies)) {
                                    foreach ($companies as $value) {
                                        echo '<div class="col-sm-4" style="padding-bottom:5px"><a href="' . site_url('Job/search') . '?location=&skill=' . $value->title . '">' . $value->title . '</a></div>';
                                    }
                                }
                                ?>                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12" style="margin-top: 20px">

                <!--                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" >
                                        <a href="<?php //echo site_url('Employee/login');                                                           ?>" aria-controls="company" role="tab" data-toggle="tab">
                                            <strong>Functional Area</strong>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                
                                    <div role="tabpanel" class="tab-pane active" id="industry">
                                        <div class="col-sm-12">
                                            <ul>
                                                <li>IT/Software Job</li>
                                                <li>BPO/Software Job</li>
                                                <li>IT/Software Job</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="company">
                
                                    </div>
                                </div>-->
            </div>
        </div>

    </div>
</div>
<style>
    .scrolling-bg {
        position: relative;
    }
    .scrolling-bg .scroll-container {
        margin: 0 auto;
    }
    .gradient {
        padding: 43px 0;
        background: #fff url(<?php echo asset_url() ?>assets/img/gradient-bg.jpg) top no-repeat;
        background-size: 100%;
        float: left;
        width: 100%;
    }

    .appinfo {
        width: 100%;
        margin: 0 auto;
    }
    .js-app {
        width: 35%;
        float: left;
        padding-left: 8%;
        padding-right: 1%;
        max-width: 100%;
        height: auto;
    }
    .main .gradient .l1 {
        font-size: 45px;
        line-height: 1.2em;
        letter-spacing: -0.06em;
        margin-bottom: 30px;
        margin-top: 0;
    }
    .Fw-800 {
        font-weight: 800;
    }

    .color-lightgrey {
        color: #6b6a6f;
    }
    .Fw-lr {
        font-weight: lighter;
    }

    .Fs-18 {
        font-size: 112.5%;
    }
    .appintro {
        width: 97%;
    }
    .inline-blk {
        display: inline-block;
    }
    .rec-app {
        width: 35%;
        float: left;
        padding-left: 4%;
        border-left: 1px solid #999;
        max-width: 100%;
        height: auto;
    }

    .main .gradient .l1 {
        font-size: 45px;
        line-height: 1.2em;
        letter-spacing: -0.06em;
        margin-bottom: 30px;
        margin-top: 0;
    }
    .recruiter-app-screen {
        position: absolute;
        background: url("http://cdn.hiree.com/resources/img/android_app.png") no-repeat;
        width: 27%;
        height: 150%;
        top: -40px;
        right: 0;
        background-size: 100%;
        z-index: 5;
    }
    
@media only screen and (max-width: 870px) and (min-width: 320px){
    .js-app {
        padding-left: 8%;
        max-width: 75%;
        width: 71%;
    }
    .rec-app {
        width: auto;
        border-left: 0;
        border-top: 1px solid #999;
        margin-top: 9%;
        padding-top: 5%;
    }
}
@media only screen and (max-width: 768px) and (min-width: 320px){
    .main .scrolling-bg .l1, .main .fixed-bg .l1 {
        font-size: 192.5%;
    }
    .Fs-18 {
        font-size: 77.75%;
    }
    .appinfo, .appintro {
        width: 100%;
        display: inline-block;
        position: relative;
    }
    .appinfo, .appintro {
        width: 100%;
        display: inline-block;
        position: relative;
    }   
}
</style>
<div class="container-fluid">
    <div class="scrolling-bg">
        <div class="scroll-container">
            <section id="section_appinfo">
                <div class="gradient clearfix">
                    <div class="container appinfo">

                        <div class="js-app" style="padding-left: 4%">
                            <h2 class="l1"><span class="Fw-800">Jobseeker</span> <span class="Fw-lr color-lightgrey">App</span></h2>
                            <div class="appintro Fs-18">
                                <p>Talent's jobseeker app provides you with all necessary tools to find that better offer, super fast!</p>
                                <br>
                                <div class="play-store">
                                    <a target="_blank" href="#"><img class="appstore inline-blk" src="https://cdn.hiree.com/resources/img/en_generic_rgb_wo_60.png" style="max-width: 100%; height: auto;" alt="Download from Google Play Store"></a>
                                </div>
                            </div>
                        </div> 


                        <div class="rec-app">
                            <div class="l1"><span class="Fw-800">Recruiter</span> <span class="Fw-lr color-lightgrey">App</span></div>
                            <div class="appintro Fs-18">
                                <p>Talent's recruiter app is dedicated specifically to your very busy schedule and connect with candidates .... all on the go!</p>
                                <br>
                                <div class="play-store">
                                    <a target="_blank" href="#"><img class="appstore inline-blk" src="https://cdn.hiree.com/resources/img/en_generic_rgb_wo_60.png" style="max-width: 100%; height: auto;" alt="Download from Google Play Store"></a>
                                </div>
                            </div>
                            <div class="recruiter-app-screen"><img class="hidden-xs" src="<?php echo asset_url(); ?>assets/img/android_app.png"></div>
                        </div>	

                    </div>
                </div>
            </section>
        </div> 
    </div>
</div>
<!--<div class="container-fluid">
    <div class="block background-secondary fullwidth candidate-title" style="padding-top: 10px;margin-bottom: 30px">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12" style="text-align: center">
                    <h2 class="header-logo-text">Apply For Jobs On The Go.</h2>
                    <div class="col-sm-2 col-sm-offset-5">
                        <img src="<?php echo asset_url(); ?>assets/img/playstore2.png" alt="Get It On Play Store" style="width: 100%">
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
</div>-->
<div class="clearfix"></div>
<div class="container">
    <div class="panels-highlighted" style="margin-bottom: 28px">
        <div class="row">
            <div class="panel-highlighted-wrapper col-sm-6">
                <div class="panel-highlighted-inner panel-highlighted-secondary">
                    <h2>Hire an employee</h2>
                    <p>
                        Vivamus congue rhoncus sem et placerat. Fusce nec nunc lobortis lorem ultrices facilisis. Ut dapibus blandit nunc, et consectetur dui.
                    </p>

                    <a href="<?php echo site_url('Employee/register'); ?>" class="btn btn-white">Sign up as company</a>
                </div><!-- /.panel-inner -->
            </div><!-- /.panel-wrapper -->

            <div class="panel-highlighted-wrapper col-sm-6">
                <div class="panel-highlighted-inner panel-highlighted-primary panel">
                    <h2>Looking for a job</h2>

                    <p>
                        Vivamus congue rhoncus sem et placerat. Fusce nec nunc lobortis lorem ultrices facilisis. Ut dapibus blandit nunc, et consectetur dui.
                    </p>

                    <a href="<?php echo site_url('User/register'); ?>" class="btn btn-white">Sign up as employee</a>
                </div><!-- /.panel-inner -->
            </div><!-- /.panel-wrapper -->
        </div><!-- /.row-->
    </div><!-- /.panels -->
</div>
<div class="container" style="background: #cccccc;padding-bottom: 10px">
    <div class="col-sm-12" style="border: 0;">
        <div class="row ">
            <h2>Recruit smart, recruit right <small><span class="pull-right label label-default">Post a job for almost free</span> </small></h2>
        </div>
        <div class="row recruit">
            <div class="col-sm-4" style="text-align: center" >
                <span class="cand"></span>
                <h5>More than 1.9 crore candidates</h5>
            </div><!-- /.panel-wrapper -->

            <div class=" col-sm-4" style="text-align: center" >
                <span class="match"></span>
                <h5>Get smart responses with unique two-way matching technology</h5>
            </div><!-- /.panel-wrapper -->

            <div class="col-sm-4" style="text-align: center" >
                <span class="company"></span>
                <h5>Highlight your company as a great place to work </h5>
            </div><!-- /.panel-wrapper -->
        </div><!-- /.row -->
    </div><!-- /.panels --> 
</div>
<div class="container-fluid testmonial">
    <div class="col-sm-12" style="border: 0;    background: azure;">
        <div class="row recruit">
            <div class="col-sm-6 " style="border-right: 1px dashed #4cae4c" >
                <h2>Employee Says</h2>
                <blockquote>
                    <p>
                        "We are using Pharma Talent to great effect. We have closed 6 positions in a matter of just 2 weeks. Congratulations for creating such a wonderful product."
                        <small>Amit Singh, Co-Founder</small>
                    </p>

                </blockquote>
            </div><!-- /.panel-wrapper -->

            <div class=" col-sm-6 ">
                <h2>Success Stories</h2>
                <blockquote>
                    <p>"My experience on Pharma Talent was simply superb. Data entry was hassle-free and categorization of data modules was in a very precise manner. Keep up the good work!"</p>
                    <small><b>Rohit Bhide </b>, Network Engineer</small>
                </blockquote>
            </div><!-- /.panel-wrapper -->

        </div><!-- /.row -->
    </div><!-- /.panels --> 
</div>
<div class="cta-text">
    <div class="container">
        <div class="cta-text-inner">
            <div class="cta-text-before">I want to</div><!-- /.cta-large-before -->

            <a href="candidates.html" class="btn btn-secondary">Hire Employee</a> or <a href="positions.html" class="btn btn-secondary">Find Job</a>
        </div><!-- /.cta-text-inner -->
    </div><!-- /.container -->
</div><!-- /.cta-text -->
<script>
    $(function () {
<?php
$skills = array();
$sql = "SELECT DISTINCT(skill_name) as skill FROM skill_master where skill_name != ''  UNION ALL SELECT DISTINCT(role) as skill FROM user where role != '' UNION ALL SELECT DISTINCT(name) as skill FROM emp_profile where name != '' ";
$query = $this->db->query($sql);
$result = $query->result();
?>
        var availableTags =
<?php
if (!empty($result)) {
    foreach ($result as $value) {
        array_push($skills, $value->skill);
    }
    echo json_encode($skills);
}
?>
        ;
        function split(val) {
            return val.split(/,\s*/);
        }
        function extractLast(term) {
            return split(term).pop();
        }

        $("#skills")
                // don't navigate away from the field on tab when selecting an item
                .bind("keydown", function (event) {
                    if (event.keyCode === $.ui.keyCode.TAB &&
                            $(this).autocomplete("instance").menu.active) {
                        event.preventDefault();
                    }
                })
                .autocomplete({
                    minLength: 0,
                    source: function (request, response) {
                        // delegate back to autocomplete, but extract the last term
                        response($.ui.autocomplete.filter(
                                availableTags, extractLast(request.term)));
                    },
                    focus: function () {
                        // prevent value inserted on focus
                        return false;
                    },
                    select: function (event, ui) {
                        var terms = split(this.value);
                        // remove the current input
                        terms.pop();
                        // add the selected item
                        terms.push(ui.item.value);
                        // add placeholder to get the comma-and-space at the end
                        terms.push("");
                        this.value = terms.join(", ");
                        return false;
                    }
                });
    });
</script>
<script>
    $(function () {
<?php
$locations = array();
?>
        var availableTags2 =
<?php
if (!empty($dropdowns)) {
    foreach ($dropdowns as $value) {
        array_push($locations, $value->location);
    }
    echo json_encode($locations);
}
?>
        ;
        function split(val) {
            return val.split(/,\s*/);
        }
        function extractLast(term) {
            return split(term).pop();
        }

        $("#location")
                // don't navigate away from the field on tab when selecting an item
                .bind("keydown", function (event) {
                    if (event.keyCode === $.ui.keyCode.TAB &&
                            $(this).autocomplete("instance").menu.active) {
                        event.preventDefault();
                    }
                })
                .autocomplete({
                    minLength: 0,
                    source: function (request, response) {
                        // delegate back to autocomplete, but extract the last term
                        response($.ui.autocomplete.filter(
                                availableTags2, extractLast(request.term)));
                    },
                    focus: function () {
                        // prevent value inserted on focus
                        return false;
                    },
                    select: function (event, ui) {
                        var terms = split(this.value);
                        // remove the current input
                        terms.pop();
                        // add the selected item
                        terms.push(ui.item.value);
                        // add placeholder to get the comma-and-space at the end
                        terms.push("");
                        this.value = terms.join(", ");
                        return false;
                    }
                });
    });
</script>