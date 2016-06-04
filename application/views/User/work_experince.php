<?php echo form_open('WorkExperince/work_exp') ?>
<h3 class="page-header"> Enter Your Work Experince Details</h3>
<div class="row"><?php echo validation_errors(); ?></div>
<div class="row">
<!--    <div class="col-lg-3"></div>-->
    <div class="panel panel-default col-lg-6 " >
        <div class="form-group " style="text-align: center">
            <!--                <h3>Enter Your Projects Detail</h3>-->
        </div>
        <div class="col-lg-12">

            <div class="form-group">
                <label class="control-label">Employer Name*</label>
                <input type="text" name="employer_name" required="required" class="form-control" value="<?php
//                if (empty($show['emp_name'])) {
//                    echo "Enter";
//                } else {
//                    echo $show['emp_name'];
//                }
                ?>"/>

            </div>
            <div class="form-group">

                <input type="radio" id="one" name="employer_type" required="required" value="0"
                <?php
//                if (empty($show['type'])) {
//                    echo "";
//                } else {
//                    if ($show['type'] == 0) {
//                        echo "checked";
//                    }
//                }
                ?>
                       />Current Employer
                <input type="radio" id="two" name="employer_type" required="required" value="1"
                <?php
//                if (empty($show['type'])) {
//                    echo "";
//                } else {
//                    if ($show['type'] == 1) {
//                        echo "checked";
//                    }
//                }
                ?>
                       />Previous Employer
                <input type="radio" id="three" name="employer_type" required="required" value="2"
                <?php
//                if (empty($show['type'])) {
//                    echo "";
//                } else {
//                    if ($show['type'] == 2) {
//                        echo "checked";
//                    }
//                }
                ?>
                       />Other Employer

            </div>
            <div class="form-group">
                <label class="control-label">Duration*</label>
                <input type="date" name="from" required="required" class="form-control" value="<?php
//                if (empty($show['from'])) {
//                    echo "";
//                } else {
//                    echo $show['from'];
//                }
                ?>"/>to 
                <input type="date" name="to" required="required" class="form-control" value="<?php
//                if (empty($show['to'])) {
//                    echo "";
//                } else {
//                    echo $show['to'];
//                }
                ?>"/> 

            </div>
            <div class="form-group">
                <label class="control-label">Designation</label>
                <input type="text" name="designation" required="required" class="form-control"value="<?php
//                if (empty($show['designation'])) {
//                    echo "";
//                } else {
//                    echo $show['designation'];
//                }
                ?>"/>

            </div>
            <div class="form-group">
                <label class="control-label">Job Profile</label>
                <textarea class="form-control" name="job_profile"><?php
//                    if (empty($show['job_profile'])) {
//                        echo "";
//                    } else {
//                        echo $show['job_profile'];
//                    }
                    ?></textarea>
            </div>
            <div class="form-group">
                <label class="control-label notice" style="display: none" >Notice Period</label>

                <select style="display: none"  name="notice_period"  class="form-control notice">
                    <option value="">None</option>
                    <option value="15 Days Or Less"
                    <?php
//                    if (empty($show['type'])) {
//                        echo "";
//                    } else {
//                        if ($show['type'] == "15 Days Or Less") {
//                            echo "selected";
//                        }
//                    }
                    ?>
                            >15 Days Or Less</option>
                    <option value="1 Month"
                    <?php
//                    if (empty($show['type'])) {
//                        echo "";
//                    } else {
//                        if ($show['type'] == "1 Month") {
//                            echo "selected";
//                        }
//                    }
                    ?>
                            >1 Month</option>
                    <option value="2 Month"
                    <?php
//                    if (empty($show['type'])) {
//                        echo "";
//                    } else {
//                        if ($show['type'] == "2 Month") {
//                            echo "selected";
//                        }
//                    }
                    ?>
                            >2 Month</option>
                    <option value="3 Month"
                    <?php
//                    if (empty($show['type'])) {
//                        echo "";
//                    } else {
//                        if ($show['type'] == "3 Month") {
//                            echo "selected";
//                        }
//                    }
                    ?>
                            >3 Month</option>
                    <option value="More Than 3 Month"

                            <?php
//                            if (empty($show['type'])) {
//                                echo "";
//                            } else {
//                                if ($show['type'] == "More Than 3 Month") {
//                                    echo "selected";
//                                }
//                            }
                            ?>>More Than 3 Month</option>
                </select>

            </div>
            <div class="form-group">
                <input type="submit" value="Add Designation" class="btn btn-success"/>
            </div>
        </div>




    </div>
    <div class="col-lg-3"></div>
</div>

</form>

<script>
    $(document).ready(function () {
        $('#one').click(function () {
            $('.notice').show();
        })
        $('#two').click(function () {
            $('.notice').hide();
        })
        $('#three').click(function () {
            $('.notice').hide();
        })
    })
</script>