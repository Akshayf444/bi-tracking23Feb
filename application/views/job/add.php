 <link href="<?php echo asset_url(); ?>assets/libraries/choosen/chosen.min.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo asset_url(); ?>assets/libraries/choosen/chosen.jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo asset_url(); ?>assets/libraries/choosen/chosen.proto.js" type="text/javascript"></script>
<div class="document-title" style="">
    <div class="container">
        <h1 class="center">Post Job</h1>
    </div><!-- /.container -->
</div>
<div class="row">
    <div class="container " >
        <?php echo validation_errors(); ?>
        <?php echo form_open('Job/add'); ?>


        <div class="col-lg-6">
            <div class="form-group">
                <label>Job Title/Designation *</label>
                <input type="text" name="title" value="<?php echo set_value('title') ?>" class="form-control"/>
            </div>
            <div class="form-group">
                <label>No of vacancies</label>
                <input type="text" name="no_of_vacancy" value="<?php echo set_value('no_of_vacancy') ?>" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Job Description *</label>
                <textarea name="description" class="form-control"/><?php echo set_value('description') ?></textarea>
            </div>
            <div class="form-group">
                <label>keywords *</label>
                    <input type="text" required="required" class="form-control " id="skills" name="skill" placeholder="Job Title / Skills / Company etc">
            </div>

        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>CTC *</label>
                <div class="row">

                    <div class="col-sm-6">

                        <input type="text" value="<?php echo set_value('ctc_min') ?>" class="form-control half-formcontrol" placeholder="Enter Salary"  name="ctc_min">
                    </div>   
                    <div class="col-sm-6">   <select class="form-control half-formcontrol"  name="ctc_type">
                            <option value="0">Per Month</option>
                            <option value="1">Per Year</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">

                <label>Hide Salary From Jobseeker*</label>
                <input type="checkbox" name="hide_ctc" value="1">
            </div>
            <div class="form-group">
                <label>Work Experience *</label><br>
                <div class="row">
                    <div class="col-sm-6">
                        <select class="form-control half-formcontrol" name="exp_max"><?php echo $experience ?></select>

                    </div> <div class="col-sm-6">  <select class="form-control half-formcontrol"  name="exp_min"><?php echo $experience ?></select>     
                    </div>    </div>
            </div>
           
                   
                  
            <div class="form-group">
                <label>Locations *</label>

                <input type="text" class="form-control" id="location" name="location" placeholder="Type Location">
            </div>
<!--            <div class="form-group">
                <label>Industry *</label>
                <select class="form-control" name="industry"><?php echo $industry ?></select>
            </div>-->
            <div class="form-group">
                <label>Function Area *</label>
                <select class="form-control" name="functional_area"><?php echo $functional_area ?></select>
                <input type="hidden" name="auth_id" value="<?php echo $auth_id ?>"/>
            </div>

        </div>


        <div class="form-group">
            <input type="submit" class="btn btn-primary pull-right" name="submit" value="Save" >
        </div>
    </div>
</form>
</div>



<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script>tinymce.init({selector: 'textarea'});</script>

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
       