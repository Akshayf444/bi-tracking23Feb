<div id="fullCalModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Experience</h4>
            </div>
            <?php echo form_open('User/edit_project') ?>
            <div  class="modal-body">

                <div class="row"><?php echo validation_errors(); ?></div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="hidden" name="id"  value="<?php echo $sh['id'] ?>"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Company*</label>
                            <input type="text" name="client" required="required" class="form-control" value="<?php echo $sh['client'] ?>"/>

                        </div>
                        <div class="form-group">
                            <label class="control-label">Role</label>
                            <input type="text" name="role" class="form-control" value="<?php echo $sh['role']; ?>"/>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Role Description</label>
                            <textarea name="role_description"  class="form-control"><?php echo $sh['role_description']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Duration*</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    From 
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php
                                            $month = explode("-", $sh['from']);

                                            $month = $this->Master_model->generateDropdown($this->User_model->getMonthObject(), 'month', 'monthname', (int) $month[1]);
                                            ?>
                                            <select name="from[]" class="form-control">
                                                <option>Select Month</option>
                                                <?php
                                                echo $month;
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <?php $year = explode("-", $sh['from']); ?>
                                            <input type="text" name="from[]" class="form-control" placeholder="Year" value="<?php echo $year[0]; ?>">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6"> to 
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <select name="to[]" class="form-control">
                                                <option>Select Month</option>
                                                <?php
                                                $month = explode("-", $sh['to']);
                                                $month = $this->Master_model->generateDropdown($this->User_model->getMonthObject(), 'month', 'monthname', (int) $month[1]);
                                                echo $month;
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <?php $year = explode("-", $sh['to']); ?>
                                            <input type="text" name="to[]" class="form-control" placeholder="Year" value="<?php echo $year[0]; ?>">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Location</label>
                                <input type="text" name="location" required="required" class="form-control" value="<?php echo $sh['location']; ?>"/> 
                            </div>

                        </div>
                    </div>
                </div>
                <div  class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Update"/>
                </div>   
                </form>

            </div>
        </div>
    </div>