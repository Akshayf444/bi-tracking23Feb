<div id="fullCalModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 90%">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header btn-warning">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $view['name'] ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="text-primary" ><?php echo $view['title'] ?></h4>
                        <div class="row">
                            <dl>
                                <dt class="col-sm-2">
                                <h6><i class="fa fa-suitcase"> </i><?php echo ' ' . $view['exp_min'] ?>-<?php echo $view['exp_max'] ?> Yrs</h6>
                                </dt>
                                <dt class="col-sm-4">
                                <h6><i class="fa fa-map-marker"> </i><?php echo ' ' . $view['location'] ?></h6>
                                </dt>
                                <dt class="col-sm-6">
                                <h6><b>Key Skills :</b> <?php echo $view['keyword'] ?></h6>
                                </dt>
                            </dl>
                        </div>

                        <h6><i class="fa fa-inr"> </i><?php
                            echo " ".$view['ctc_min'];
                            echo isset($view['ctc_type']) && $view['ctc_type'] == 0 ? ' P.M.' : ' P.A.';
                            ?>
                        </h6>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class=" col-lg-12 ">
                                <div class="">
                                    <h5><b>Job Description</b></h5>
                                    <h6><?php echo $view['description']; ?></h6>
                                </div>
                                <div class="form-group">
                                    <h6><b>Functional Area :</b></h6>
                                    <h6><?php echo $view['fun_area'] ?></h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>