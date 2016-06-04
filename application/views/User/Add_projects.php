<div id="fullCalModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Experience</h4>
            </div>
            <?php echo form_open('User/user_projects') ?>
            <div  class="modal-body">
                <div class="row"><?php echo validation_errors(); ?></div>
                <div class="row">

                    <div class="col-sm-12 ">
                        <div class="form-group">
                            <label class="control-label">Company*</label>
                            <input type="text" name="client" required="required" class="form-control"/>

                        </div>
                        <div class="form-group">
                            <label class="control-label">Location*</label>
                            <input type="text" name="location" required="required" class="form-control"/>

                        </div>
                        <div class="form-group">
                            <label class="control-label">Position*</label>
                <!--                <select name="role" class="form-control">
                                <option>Programmer</option>
                                <option>other</option>
                            </select>-->
                            <input type="text" name="role" required="required" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Duration*</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    From 
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <select name="from[]" class="form-control">
                                                <option>Select Month</option>
                                                <?php
                                                echo $month;
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="from[]" class="form-control" placeholder="Year">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6"> to 
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <select name="to[]" class="form-control">
                                                <option>Select Month</option>
                                                <?php
                                                echo $month;
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="to[]" class="form-control" placeholder="Year">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Position Description</label>
                            <textarea name="role_description"  class="form-control"></textarea>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success" value="Save"/>
            </div>
            </form>
        </div>
    </div>
</div>