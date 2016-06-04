<div id="fullCalModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Education</h4>
            </div>
            <?php echo form_open('User/user_qualification') ?>
            <div class="modal-body">
                <div class="row"><?php echo validation_errors(); ?></div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="one">
                            <div class="form-group">
                                <label class="control-label">Degree</label>
                                <?php echo $dropdowns[0]; ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Specialization</label>
                                <?php echo $dropdowns[1]; ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Year</label>
                                <input type="text" name="year[]" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Institute</label>
                                <select class="form-control" name="institute[]">
                                    <?php foreach ($institute as $ins): ?>
                                        <option value="<?php echo $ins->id ?>"><?php echo $ins->institute ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                                               
                        <label class="pull-right del" style="display: none">Delete -</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success" value="Add Qualification"/>
            </div>
            </form>
        </div> 
    </div>
</div>
<script><?php echo $dropdowns[2]; ?></script>
<script>

        $(document).ready(function () {
            $('#add').click(function () {

            //$('.one').append("<div class='second' ><hr style='border: 1px solid;'><div class='form-group' style='text-align: center'><h3>Second Highest Qualification</h3></div><div class='form-group'><label class='control-label'>Second Highest Qualification Held</label><input type='text' name='qualification' class='form-control'/></div><div class='form-group'><label class='control-label'>Specialization</label><?php echo $dropdowns[1]; ?></div><div class='form-group'><label class='control-label'>Year</label><input type='text' name='year' class='form-control'/></div><div class='form-group'><label class='control-label'>Institute</label><input type='text' name='year' class='form-control'/></div></div>");
            $('.del').show();
            $('.second').show();
        $('.add').hide();
        })
            $('.del').click(function () {

            $('.second').hide();
            $('.del').hide();
        $('.add').show();
    })

})

</script>