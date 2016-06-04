<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" type="text/css">
        <link href="<?php echo asset_url(); ?>assets/fonts/profession/style.css" rel="stylesheet" type="text/css">
        <link href="<?php echo asset_url(); ?>assets/css/Custom.css" rel="stylesheet" type="text/css">
        <link href="<?php echo asset_url(); ?>assets/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo asset_url(); ?>assets/libraries/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo asset_url(); ?>assets/libraries/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo asset_url(); ?>assets/libraries/bootstrap-wysiwyg/bootstrap-wysiwyg.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo asset_url(); ?>assets/css/profession-black-green.css" rel="stylesheet" type="text/css" id="style-primary">
        <script type="text/javascript" src="<?php echo asset_url(); ?>assets/js/jquery.js"></script>        
        <script type="text/javascript" src="<?php echo asset_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo asset_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
        <link href="<?php echo asset_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo asset_url(); ?>assets/js/datepicker.js" type="text/javascript"></script>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo asset_url(); ?>assets/favicon.png">
        <title>Pharma Talent</title>
        <style>
            .header-nav .sub-menu {
                top: 48px;
            }

            .sub-menu2 li {
                padding: 2px;
                padding-left: 30px;

            }
            .sub-menu2 li a{
                color: #000;
            }
            .document-title {
                padding: 14px 0px;
                margin: -60px 0px 26px 0px;
            }
            .resume-main-verified {
                background-color: #55a747;
                border-radius: 50%;
                color: #fff;
                display: inline-block;
                font-size: 10px;
                height: 20px;
                line-height: 18px;
                margin: 0px 0px 0px 15px;
                text-align: center;
                vertical-align: 0px;
                width: 19px;
            }

            .resume-chapter {
                padding-top: 20px;
            }

            .header-nav li {
                padding-bottom:4px;
                padding-top: 3px;
            }

        </style>
    </head>
    <body class="hero-content-dark footer-dark">
        <div class="page-wrapper">
            <div class="header-wrapper">
                <div class="header">
                    <div class="header-top">
                        <div class="container">
                            <div class="header-brand">
                                <div class="header-logo">
                                    <a href="<?php echo site_url('User/home'); ?>">
                                        <i class="profession profession-logo"></i>
                                        <span class="header-logo-text">Pharma Talent</span>
                                    </a>
                                </div><!-- /.header-logo-->

                                <div class="header-slogan">
                                    <span class="header-slogan-slash">|</span>
                                    <span class="header-slogan-text"></span>

                                </div><!-- /.header-slogan-->

                            </div><!-- /.header-brand -->
                            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".header-nav">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                        </div><!-- /.container -->
                    </div><!-- /.header-top -->

                    <div class="header-bottom">
                        <div class="container">
                            <ul class="header-nav nav nav-pills collapse">
                                <?php
                                $CI = & get_instance();
                                $this->load->view('Sidebar', $CI->loadSidebar());
                                ?>

                            </ul>

                        </div>
                    </div> 
                </div><!-- /.header -->
            </div><!-- /.header-wrapper-->
            <div class="main-wrapper">
                <div class="main">
                    <div class="container-fluid">
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
$this->load->model('Master_model');
$dropdowns = $this->Master_model->listLocation();
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
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="document-title">
                                    <?php
                                    $attribute = array('method' => 'get');
                                    echo form_open('Job/Search', $attribute);
                                    ?>
                                    <div class="container">
                                        <div class="col-sm-4" >
                                            <input type="text" required="required" class="form-control" id="skills" name="skill" placeholder="Job Skill">
                                        </div>
                                        <div class="col-sm-4" >
                                            <input type="text" class="form-control" id="location" name="location" placeholder="Location">
                                        </div>
                                        <div class="col-sm-4" >
                                            <input type="submit" class="btn btn-default" value="Search Job">
                                        </div>
                                    </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 col-xs-offset-1" style="padding-right: 0px" id="sidebar"  >
                                <ul class="nav nav-pills nav-stacked" >
                                    <?php
                                    $CI = & get_instance();
                                    $this->load->view('Sidebar2', $CI->loadSidebar());
                                    ?>
                                </ul>
                                <div class="pull-right">
<!--                                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                     sidebar 
                                    <ins class="adsbygoogle"
                                         style="display:inline-block;width:300px;height:600px"
                                         data-ad-client="ca-pub-4494527869099710"
                                         data-ad-slot="8845432514"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>-->
                                </div>
                            </div>
                            <div class="col-sm-6" style="padding-left: 0px">
                                <?php $this->load->view($content, $view_data); ?>
                            </div>
                            <div class="col-sm-2 " style="border: 1px solid #cccccc" >
                                <script src="https://code.highcharts.com/highcharts.js"></script>
                                <script src="https://code.highcharts.com/highcharts-more.js"></script>
                                <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>

                                <div id="dial" class="pull-right panel-danger" style="height: 200px;width: 200px;"></div>
                                <script>
                            $(function () {

                                // Uncomment to style it like Apple Watch
                                /*
                                 if (!Highcharts.theme) {
                                 Highcharts.setOptions({
                                 chart: {
                                 backgroundColor: 'black'
                                 },
                                 colors: ['#F62366', '#9DFF02', '#0CCDD6'],
                                 title: {
                                 style: {
                                 color: 'silver'
                                 }
                                 },
                                 tooltip: {
                                 style: {
                                 color: 'silver'
                                 }
                                 }
                                 });
                                 }
                                 // */

                                Highcharts.chart('dial', {
                                    chart: {
                                        type: 'solidgauge',
                                        marginTop: 20
                                    },
                                    title: {
                                        text: '<h2>Profile Completed</h2>',
                                        style: {
                                            fontSize: '12px'
                                        }
                                    },
                                    credits: {
                                        enabled: false
                                    },
                                    tooltip: {
                                        borderWidth: 0,
                                        backgroundColor: 'none',
                                        shadow: false,
                                        style: {
                                            fontSize: '10px'
                                        },
                                        pointFormat: '{series.name}<br><span style="font-size:1.5em; color: {point.color}; font-weight: bold">{point.y}%</span>',
                                        positioner: function (labelWidth, labelHeight) {
                                            return {
                                                x: 100 - labelWidth / 2,
                                                y: 60
                                            };
                                        }
                                    },
                                    pane: {
                                        startAngle: 0,
                                        endAngle: 360,
                                        background: [{// Track for Move
                                                outerRadius: '100%',
                                                innerRadius: '88%',
                                                backgroundColor: Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0.3).get(),
                                                borderWidth: 0
                                            }]
                                    },
                                    yAxis: {
                                        min: 0,
                                        max: 100,
                                        lineWidth: 0,
                                        tickPositions: []
                                    },
                                    plotOptions: {
                                        solidgauge: {
                                            borderWidth: '12px',
                                            dataLabels: {
                                                enabled: true
                                            },
                                            linecap: 'round',
                                            stickyTracking: false
                                        }
                                    },
                                    series: [{
                                            name: 'Completed',
                                            borderColor: Highcharts.getOptions().colors[0],
                                            data: [{
                                                    color: Highcharts.getOptions().colors[0],
                                                    radius: '100%',
                                                    innerRadius: '100%',
                                                    y: 80
                                                }]
                                        }]
                                },
                                /**
                                 * In the chart load callback, add icons on top of the circular shapes
                                 */
                                function callback() {

                                    // Move icon
                                    this.renderer.path(['M', -8, 0, 'L', 8, 0, 'M', 0, -8, 'L', 8, 0, 0, 8])
                                            .attr({
                                                'stroke': '#303030',
                                                'stroke-linecap': 'round',
                                                'stroke-linejoin': 'round',
                                                'stroke-width': 2,
                                                'zIndex': 10
                                            })
                                            .translate(190, 26)
                                            .add(this.series[2].group);

                                    // Exercise icon
                                    this.renderer.path(['M', -8, 0, 'L', 8, 0, 'M', 0, -8, 'L', 8, 0, 0, 8, 'M', 8, -8, 'L', 16, 0, 8, 8])
                                            .attr({
                                                'stroke': '#303030',
                                                'stroke-linecap': 'round',
                                                'stroke-linejoin': 'round',
                                                'stroke-width': 2,
                                                'zIndex': 10
                                            })
                                            .translate(190, 61)
                                            .add(this.series[2].group);

                                    // Stand icon
                                    this.renderer.path(['M', 0, 8, 'L', 0, -8, 'M', -8, 0, 'L', 0, -8, 8, 0])
                                            .attr({
                                                'stroke': '#303030',
                                                'stroke-linecap': 'round',
                                                'stroke-linejoin': 'round',
                                                'stroke-width': 2,
                                                'zIndex': 10
                                            })
                                            .translate(190, 96)
                                            .add(this.series[2].group);
                                });


                            });
                                </script>
                                <div ><p style="border-top: 1px solid #cccccc">Profiles that are more than 90% complete are most preferred by recruiters.</p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div><!-- /.main -->
            </div><!-- /.main-wrapper -->

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Login</h4>
                        </div>
                        <?php echo form_open('User/login') ?>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group col-sm-6">
                                        <label >E-mail</label>
                                        <input type="text" class="form-control" name="email"/>
                                    </div><!-- /.form-group -->

                                    <div class="form-group col-sm-6" >
                                        <label >Password</label>
                                        <input type="password" class="form-control" name="password"/>
                                    </div><!-- /.form-group -->

                                </div><!-- /.col-* -->
                            </div><!-- /.row -->

                        </div>
                        </form>
                        <div class="modal-footer">
                            <a href="<?php echo site_url('Linkedin_signup/initiate'); ?>">Linked In</a>
                            <button type="submit" class="btn btn-secondary">Login</button>
                            <a href="<?php echo site_url('User/register') ?>">Click Here To Register</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('footer', $view_data); ?>

        </div><!-- /.page-wrapper -->
        <?php $this->load->view('links', $view_data); ?>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Ptalent_home_upper -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:728px;height:90px"
             data-ad-client="ca-pub-4494527869099710"
             data-ad-slot="2079045313"></ins>
        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>

    </body>
</html>