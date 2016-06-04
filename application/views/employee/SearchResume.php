<h3 class="page-header"> Search Resume</h3>

<div class="row"><?php echo validation_errors(); ?></div>
<div class="row">
    <div class="col-lg-3"></div>
    <?php echo form_open('Employee/resumesearchview') ?>
    <div class="col-lg-6 panel panel-default" style="padding-top: 15px;margin-top: 40px;">
        <div class="form-group col-sm-4" >
            <input type="text" class="form-control" style="width: 167px;height: 40px;" name="skill" placeholder="Enter skills"/>
        </div>
        <div class="form-group col-sm-4">
            <select name="location" style="width: 167px;height: 40px;" class="form-control">
                <?php echo $dropdowns ?>
            </select>
        </div>
        <div class="form-group col-sm-4">
            <input type="submit" style="width: 100px;height: 40px;" class="btn btn-success" value="Search"/>
        </div>
    </div>
</form>
<div class="col-lg-3"></div>
</div>