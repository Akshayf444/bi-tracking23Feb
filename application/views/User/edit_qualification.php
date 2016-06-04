<div id="fullCalModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Education</h4>
            </div>
            <?php echo form_open('User/edit_qualification') ?>
            <div class="modal-body">
                <div class="row"><?php echo validation_errors(); ?></div>
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="form-group">
                            <label class="control-label">Highest Qualification Held</label>
                            <?php echo $dropdowns[0]; ?>

                        </div>
                        <div class="form-group">
                            <label class="control-label">Specialization</label>
                            <?php echo $dropdowns[1]; ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Year</label>
                            <input type="text" name="year[]" class="form-control" value="<?php echo isset($sh['year']) ? $sh['year'] : ''; ?>"/>
                        </div>

                        <input type="hidden" name="id" class="form-control" value="<?php echo isset($sh['id']) ? $sh['id'] : ''; ?>"/>

                        <div class="form-group">
                            <label class="control-label">Institute</label>
                            <select class="form-control" name="institute[]">
                                <?php foreach ($institute as $ins): ?>
                                    <option value="<?php echo $ins->id ?>"><?php echo $ins->institute ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success" value="Update Qualification"/>
            </div>
            </form>
        </div>
    </div>
</div>
<script><?php echo $dropdowns[2]; ?></script>
