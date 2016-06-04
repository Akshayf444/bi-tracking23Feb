<style>
    .btn-warning {
        padding: 5px;
        border-radius: 0px;
    }
    .btn-xs{
        padding: 5px;
        border-radius: 0px;
    }
</style>

<div class="container">
    <h1 class="center">Open Positions</h1>
</div><!-- /.container -->

<div class="container">    
    <h2 class="page-header"><strong><?php echo isset($total_count) ? $total_count : 0; ?></strong> jobs matches your search criteria</h2>
    <div class="row">
        <script src="<?php echo asset_url() ?>/js/bootstrap-multiselect.js" type="text/javascript"></script>
        <link href="<?php echo asset_url() ?>/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo asset_url() ?>/js/bootstrap-typeahead.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>/js/jquery-migrate-1.2.1.js" type="text/javascript"></script>


        <div class="col-sm-3 hidden-xs">
            <div class="filter-stacked">
                <?php
                $attribute = array('method' => 'get');
                echo form_open('Job/Search', $attribute);
                ?>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Keyword">
                </div>

                <h3>Salary <a href="#"><i class="fa fa-close"></i></a></h3>

                <div class="split-forms">
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Min.">
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Max.">
                    </div>
                </div>

                <h3>LOCATION <a href="#"><i class="fa fa-close"></i></a></h3>
                <ul>
                    <?php
                    $locations = array();
                    if (isset($_GET['location']))
                        $locations = explode(",", $_GET['location']);
                    $sql = "SELECT DISTINCT(sm.location)  as skill,count(j.job_id) as jobcount FROM location_master sm LEFT JOIN jobs j ON  j.location LIKE CONCAT('%', sm.location, '%') AND j.keyword LIKE '%" . $_GET['skill'] . "%'  where sm.location != '' GROUP BY sm.location HAVING jobcount > 0 ORDER BY jobcount DESC ";
                    //echo $sql;
                    $query = $this->db->query($sql);
                    $trendingJob = $query->result();
                    if (!empty($trendingJob)) {
                        foreach ($trendingJob as $value) {
                            $checked = in_array($value->skill, $locations) ? 'checked' : '';
                            echo '<div class="checkbox">
                                            <label><input type="checkbox" ' . $checked . ' class="location" value="' . $value->skill . '" > ' . $value->skill . '</label>
                                        </div>';
                        }
                        
                    }
                    ?>
                    <input type="hidden" name="location" id="location">
                    <input type="hidden" name="skill" value="<?php echo $_GET['skill']; ?>">
                </ul>
                <script>
                    $(".location").click(function () {
                        values = [];
                        $(".location").each(function () {
                            if ($(this).is(":checked"))
                                values.push($(this).val());
                        });
                        $("#location").val(values.join(','));
                    });
                </script>

                <button type="submit" class="btn btn-secondary btn-block">SEARCH</button>
                </form>
            </div><!-- /.filter-stacked -->

        </div><!-- /.col-* -->

        <div class="col-sm-9">
            <div class="positions-list">
                <?php
                if (isset($job)) {

                    foreach ($job as $j) {
                        ?>
                        <div class="positions-list-item">
                            <h2 style="font-weight: 600;font-size: 16px">
                                <a onclick="request('<?php echo site_url('Job/viewJobDetails/' . $j->job_id) ?>')" ><?php echo $j->title ?></a>
                                <small class="pull-right"><a href="<?php echo site_url('Job/apply/' . $j->job_id) . '?redirect_url=' . current_url() . '?skill=' . $_GET['skill'] . '&location=' . $_GET['location']; ?><?php //echo $j->link;                 ?>" class="btn btn-warning"><?php echo (int) $j->applied_status == 1 ? 'Applied' : 'Apply' ?></a></small>
                            </h2>
                            <p style="color: #777;font-size: 14px"><?php echo $j->name ?></p>
                            <div class="row">
                                <div class="col-sm-2" style="padding-right: 1px; ">
                                    <h6><i class="fa fa-suitcase"> </i><?php echo ' ' . $j->exp_min; ?>-<?php echo $j->exp_max ?> Yrs</h6>
                                </div>
                                <div class="col-sm-6">
                                    <h6><i class="fa fa-map-marker"> </i><?php echo ' ' . $j->location ?></h6>
                                </div>
                                <div class="col-sm-3">
                                    <h6><i class="fa fa-inr"></i> : <?php
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
                                    <p style="color: #717171"><?php echo $j->description ?></p>
                                    <h6><b>Key Skills : </b><?php echo $j->keyword ?><small class="pull-right"><?php echo date('d-m-Y', strtotime($j->posted_at)) ?></small></h6>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <?php
                if (isset($total_pages)) {
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if (isset($page) && $page == $i) {
                            echo '<a href="' . site_url('Job/search/' . $i) . '?skill=' . $_GET['skill'] . '&location=' . $_GET['location'] . '" class="active btn btn-xs">' . $i . '</a>';
                        } else {
                            echo '<a href="' . site_url('Job/search/' . $i) . '?skill=' . $_GET['skill'] . '&location=' . $_GET['location'] . '" class="btn btn-xs">' . $i . '</a>';
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div id="ajaxcontainer">

</div>
<script type="text/javascript">
    $(document).ready(function () {

        $('.multiselect').multiselect({
            numberDisplayed: 1
        });

    });

    $('#city1').typeahead({
        source: function (typeahead, query) {
            var industry = $('#city1').val();

            //            $(".loader").show();
            $.ajax({
                url: 'indus',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    industry: industry,
                },
                success: function (data) {
                    console.log(data);
                    typeahead.process(data);

                }
            });
        }
    });
</script>
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