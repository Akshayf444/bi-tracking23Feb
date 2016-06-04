<div id="fullCalModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <link href="<?php echo asset_url(); ?>assets/libraries/choosen/chosen.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo asset_url(); ?>assets/libraries/choosen/chosen.jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo asset_url(); ?>assets/libraries/choosen/chosen.proto.js" type="text/javascript"></script>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Basic Profile</h4>
            </div>

            <?php echo form_open('User/Add_profile') ?>
            <div class="modal-body">
                <div class="row"><?php echo validation_errors(); ?></div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="section1" style="display: none">
                            <div class="form-group">
                                <label class="control-label">Name*</label><input type="text"  class="form-control" placeholder="Enter Name" name="name" value="<?php
                                if (isset($user['name'])) {
                                    echo $user['name'];
                                }
                                ?>" />

                            </div>
                            <div class="form-group">
                                <label class="control-label">Profile Headline*</label>
                                <input type="text" class="form-control"  name="role" value="<?php
                                if (isset($user['role'])) {
                                    echo $user['role'];
                                }
                                ?>"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Permanent Address</label>
                                <textarea name="address1" class="form-control"><?php
                                    if (isset($user['address1'])) {
                                        echo $user['address1'];
                                    }
                                    ?></textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="control-label">City </label>
                                        <input type="text" name="city" class="form-control"  id="city" value="<?php
                                        if (isset($user['city'])) {
                                            echo $user['city'];
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-6">

                                        <label class="control-label">State </label>
                                        <input type="text" name="state" class="form-control" id="state" value="<?php
                                        if (isset($user['state'])) {
                                            echo $user['state'];
                                        }
                                        ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Pincode</label>
                                <input type="text" name="pincode" class="form-control"  id="pincode"value="<?php
                                if (isset($user['pincode'])) {
                                    echo $user['pincode'];
                                }
                                ?>">

                                <img src="<?php echo asset_url() ?>images/38-1.gif" id="img" style="display: none"/>
                            </div>
                        </div>
                        <div id="section4"  style="display: none">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="control-label">Date Of Birth*</label>
                                        <div class="row">
                                            <?php
                                            if (isset($user['dob']) && $user['dob'] != '0000-00-00') {
                                                $dob = explode("-", $user['dob']);
                                            }
                                            if (!empty($dob)) {
                                                $month = $this->Master_model->generateDropdown($this->User_model->getMonthObject(), 'month', 'monthname', (int) $dob[1]);
                                                $day = $this->Master_model->generateDropdown($this->User_model->getDayObject(), 'month', 'monthname', (int) $dob[2]);
                                            } else {
                                                $month = $this->Master_model->generateDropdown($this->User_model->getMonthObject(), 'month', 'monthname');
                                                $day = $this->Master_model->generateDropdown($this->User_model->getDayObject(), 'month', 'monthname');
                                            }
                                            ?>
                                            <div class="col-sm-3" style="padding-right: 0px">
                                                <select name="dob[]" class="form-control">
                                                    <option value="">Select Day</option>
                                                    <?php echo $day; ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4" style="padding-right: 0px">
                                                <select name="dob[]" class="form-control">
                                                    <option value="">Select Month</option>
                                                    <?php echo $month; ?> 
                                                </select>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" placeholder="Year"  name="dob[]" value="<?php
                                                if (isset($dob[0])) {
                                                    echo $dob[0];
                                                }
                                                ?>"/>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label">Gender*</label><br>
                                        <input type="radio"   name="sex" <?php
                                        if (isset($user['gender']) && $user['gender'] == 'Male') {
                                            echo "checked";
                                        }
                                        ?> value="Male"/>Male
                                        <input type="radio"  <?php
                                        if (isset($user['gender']) && $user['gender'] == 'Female') {
                                            echo "checked";
                                        }
                                        ?>  name="sex" value="Female "/>Female
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="control-label">Marital Status</label>
                                        <select class="form-control"  name="marital_status">
                                            <option value="single">Single</option>
                                            <option value="married">Married</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label">Function Area</label>
                                        <select class="form-control "  name="function_area">
                                            <?php echo $function; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="control-label">Prefered Location</label>
                                        <?php
                                        $location_master = $this->Master_model->listLocation();
                                        $location = array();
                                        if (isset($user['prefred_location']) && $user['prefred_location'] != '') {
                                            $location = explode(",", $user['prefred_location']);
                                        }
                                        ?>
                                        <select class="form-control chosen-select-no-results" multiple="multiple" name="prefred_location[]">
                                            <?php
                                            foreach ($location_master as $value) {
                                                if (in_array($value->location, $location)) {
                                                    echo '<option value="' . $value->location . '" selected>' . $value->location . '</option>';
                                                } else {
                                                    echo '<option value="' . $value->location . '" >' . $value->location . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="section5"  style="display: none">
                            <div class="form-group">
                                <label class="control-label">Key Skills</label>
                                <input type="text" class="form-control"  name="key_skill" value="<?php
                                if (isset($user['key_skill'])) {
                                    echo $user['key_skill'];
                                }
                                ?>"/>
                            </div>
                        </div>
                        <div id="section2"  style="display: none">
                            <div class="form-group">
                                <label class="control-label">Summary</label>
                                <textarea class="form-control"  name="resume_headline" ><?php
                                    if (isset($user['resume_headline'])) {
                                        echo $user['resume_headline'];
                                    }
                                    ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success" value="Update" />
            </div>
            </form>
        </div>
    </div>  
</div>


<script>
    var config = {
        '.chosen-select': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chosen-select-width': {width: "95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
    $("#<?php echo isset($_GET['section']) ? $_GET['section'] : 'section1'; ?>").show();


    jQuery(function () {

        var typingTimer; //timer identifier
        var doneTypingInterval = 1000;
        jQuery("#pincode ").keyup(function () {
            clearTimeout(typingTimer);
            if ($(this).val) {
                $(".mask").show();

                typingTimer = setTimeout(function () {
                    if ($("#pincode").val().length == 6) {

                        var search_term = $("#pincode").val();
                        var dataString = 'pincode=' + search_term;
                        sendRequest(dataString);
                    }


                }, doneTypingInterval);
            }

        });
    });
    function sendRequest(dataString) {

        var data = dataString;
        $("#img").show();
        $.ajax({
            //Send request

            type: 'get',
            data: data,
            url: '<?php echo site_url(); ?>/Employee/add_pincode',
            success: function (data) {

                var json = JSON.parse(data);
                $("#state").val(json[0].State);
                $("#city").val(json[0].District);
                $("#img").hide();

            }
        });
    }

</script>