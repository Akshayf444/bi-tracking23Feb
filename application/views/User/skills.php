<style>
        .small-form-control{
        height: 32px;
    }
    
</style>
<div id="fullCalModal" class="modal fade" role="dialog">
    <link href="<?php echo asset_url(); ?>assets/libraries/choosen/chosen.min.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo asset_url(); ?>assets/libraries/choosen/chosen.jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo asset_url(); ?>assets/libraries/choosen/chosen.proto.js" type="text/javascript"></script>
    <link href="<?php echo asset_url(); ?>assets/libraries/taginput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo asset_url(); ?>assets/libraries/taginput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Skills</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="section1" style="display: none">
                            <?php echo form_open('User/skill') ?>
                            <div class="form-group">
                                <input type="hidden" name="section" value="section1">
                                <select name="skill[]" multiple class="chosen-select-no-results">
                                    <?php
                                    if (!empty($skill)) {
                                        foreach ($skill as $value) {
                                            if (is_null($value->auth_id)) {
                                                echo '<option value ="' . $value->skm_id . '" >' . $value->skill_name . '</option>';
                                            } else {
                                                echo '<option value ="' . $value->skm_id . '" selected>' . $value->skill_name . '</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>  
                            <div class="form-group">
                                <input type="submit" value="Save" name="saveSkills" class="btn btn-success">
                            </div>
                            </form>
                        </div>
                        <div id="section2" style="display: none">
                            <?php echo form_open('User/skill') ?>
                            <div class="form-group">
                                <input type="hidden" name="section" value="section2">
                                <?php
                                $computer_skill = '';
                                if (!empty($computerSkill)) {
                                    foreach ($computerSkill as $value) {
                                        $computer_skill = $value->com_skill;
                                    }
                                }
                                ?>
                                <input type="text" name="computer_skill"  class="form-control" data-role="tagsinput" value="<?php echo $computer_skill ?>">
                            </div>  
                            <div class="form-group">
                                <input type="submit" value="Save" name="saveSkills" class="btn btn-success">
                            </div>
                            </form>
                        </div>

                        <div id="section3" style="display: none">
                            <?php echo form_open('User/skill') ?>
                            <div class="form-group">

                                <input type="hidden" name="section" value="section3">
                                <?php
                                $computer_skill = '';
                                if (!empty($language)) {
                                    $language = array_shift($language);
                                    $language = json_decode($language->language);
                                    ///var_dump($language);
                                }
                                if (!empty($language)) {
                                    foreach ($language as $key => $value) {
                                        echo '<div class="row">';
                                        echo '<div class="col-sm-4">';
                                        echo '<select name="languages[]" class="form-control small-form-control" >';
                                        echo '<option value="">Select Language</option>';
                                        $languageDropdown = $this->Master_model->generateDropdown($language_master, 'lang', 'lang', $value->language);
                                        echo $languageDropdown;
                                        echo '</select>';
                                        echo '</div>';
                                        echo '<div class="col-sm-8">';
                                        echo '<select name="rate[]" class="form-control small-form-control" >';
                                        echo '<option value="">Select Proficiency</option>';
                                        $profdropdown = $this->Master_model->generateDropdown($prof, 'id', 'Parameter', (int)$value->rate);
                                        echo $profdropdown;
                                        echo '</select>';
                                        echo '</div>';
                                        echo '</div><br/>';
                                    }
                                    echo '<div class="row">';
                                    echo '<div class="col-sm-4">';
                                    echo '<select name="languages[]"  class="form-control small-form-control" >';
                                    echo '<option value="">Select Language</option>';
                                    $languageDropdown = $this->Master_model->generateDropdown($language_master, 'lang', 'lang');
                                    echo $languageDropdown;
                                    echo '</select>';
                                    echo '</div>';
                                    echo '<div class="col-sm-8">';
                                    echo '<select name="rate[]" class="form-control small-form-control" >';
                                    echo '<option value="">Select Proficiency</option>';
                                    $profdropdown = $this->Master_model->generateDropdown($prof, 'id', 'Parameter');
                                    echo $profdropdown;
                                    echo '</select>';
                                    echo '</div>';
                                    echo '</div><br/>';
                                } else {
                                    for ($index = 0; $index < 3; $index++) {
                                        echo '<div class="row">';
                                        echo '<div class="col-sm-4">';
                                        echo '<select name="languages[]"  class="form-control small-form-control" >';
                                        echo '<option value="">Select Language</option>';
                                        $languageDropdown = $this->Master_model->generateDropdown($language_master, 'lang', 'lang');
                                        echo $languageDropdown;
                                        echo '</select>';
                                        echo '</div>';
                                        echo '<div class="col-sm-8">';
                                        echo '<select name="rate[]" class="form-control small-form-control" >';
                                        echo '<option value="">Select Proficiency</option>';
                                        $profdropdown = $this->Master_model->generateDropdown($prof, 'id', 'Parameter');
                                        echo $profdropdown;
                                        echo '</select>';
                                        echo '</div>';
                                        echo '</div><br/>';
                                    }
                                }
                                ?>

                            </div> 

                            <div class="form-group">
                                <input type="submit" value="Save" name="saveSkills" class="btn btn-success">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
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

    $("#addmore").click(function () {
        $("#").insertBefore("#addmore");
    });
</script>