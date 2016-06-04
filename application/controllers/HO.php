<?php

class HO extends MY_Controller {

    public $nextMonth;
    public $nextYear;

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->nextMonth = date('m');
        $this->nextYear = date('Y');
    }

    public function dashboard() {
        $data['productlist'] = $this->admin_model->show_pro_list();
        $data['Doctor_Count'] = $this->admin_model->count();
        $data['Actual_Count'] = $this->admin_model->count_achive($this->nextMonth, $this->nextYear);
        $data['Target_Count'] = $this->admin_model->total_target($this->nextMonth, $this->nextYear);
        $data['Con_Count'] = $this->admin_model->total_convertion();

        $data = array('title' => 'Dashboard', 'content' => 'ho/dashboard', 'page_title' => 'Dashboard', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function dashboardTab() {
        if ($this->input->post('Product_Id')) {
            $Product_id = $this->input->post('Product_Id');
            $noofdoctors = 0;
            $target = 0;
            $planned = 0;

            $result = $this->admin_model->adminDashboardCount2($Product_id, $this->nextMonth, $this->nextYear);
            if (!empty($result)) {
                foreach ($result as $value) {
                    $target+= $value->Target_New_Rxn_for_the_month;
                    $planned+= $value->Planned_New_Rxn;
                    $noofdoctors+= $value->No_of_Doctors;
                }
            }
            ?>
            <div id="<?php echo $Product_id ?>" class="tab-pane fade in active">
                <div class="row" style="margin-top:5px">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="fa fa-user-md"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Doctors </span>
                                <span class="info-box-number"><?php echo $noofdoctors; ?></span>
                                <!--                                                <div class="progress">
                                                                                    <div class="progress-bar" style="width: 50%"></div>
                                                                                </div>
                                                                                <span class="progress-description">
                                                                                    50% Increase in 30 Days
                                                                                </span>-->
                            </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                    </div><!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="fa fa-medkit"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Target</span>
                                <span class="info-box-number"><?php
                                    echo $target;
                                    ?></span>
                                <!--                                                <div class="progress">
                                                                                    <div class="progress-bar" style="width: 50%"></div>
                                                                                </div>
                                                                                <span class="progress-description">
                                                                                    50% Increase in 30 Days
                                                                                </span>-->
                            </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                    </div><!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="ion ion-ios-cart-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Planned</span>
                                <span class="info-box-number"><?php
                                    echo $planned;
                                    ?></span>
                                <!--                                                <div class="progress">
                                                                                    <div class="progress-bar" style="width: 50%"></div>
                                                                                </div>
                                                                                <span class="progress-description">
                                                                                    50% Increase in 30 Days
                                                                                </span>-->
                            </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>

            <?php
        }
    }

    function dailyTrend() {
        $this->load->model('Master_Model');
        $this->load->model('User_model');
        $result = $this->admin_model->find_zone();
        $data['zone'] = $this->Master_Model->generateDropdown($result, 'Zone', 'Zone');
        $product = $this->admin_model->show_pro_list();
        $data['productlist'] = $this->Master_Model->generateDropdown($product, 'id', 'Brand_Name');
        $condition = array();
        $product = 0;
        $start_date = '';

        if ($this->input->get('Zone') != '') {
            $condition[0] = "em.Zone = '" . $this->input->get('Zone') . "'";
            $data['zone'] = $this->Master_Model->generateDropdown($result, 'Zone', 'Zone', $this->input->get('Zone'));
        }
        if ($this->input->get('Division') != '') {
            $condition[1] = "em.Division = '" . $this->input->get('Division') . "'";
        }

        if ($this->input->get('Product') != '') {
            $data['productlist'] = $this->Master_Model->generateDropdown($product, 'id', 'Brand_Name', $this->input->get('Product'));
        }

        if ($this->input->get('Start_date') != '' && $this->input->get('End_date') != '') {
            $start_date = " BETWEEN '" . $this->input->get('Start_date') . "'  AND '" . $this->input->get('End_date') . " ' ";
            $data['result'] = $this->User_model->dailyTrend($start_date, $this->nextYear, $product, $condition, $this->input->get('Start_date'), $this->input->get('End_date'));
        }


        $data = array('title' => 'Daily Trend', 'content' => 'ho/dailyTrend', 'page_title' => 'Daily Rx Trend', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    function monthlyTrend() {
        $this->load->model('Master_Model');
        $this->load->model('User_model');
        $result = $this->admin_model->find_zone();
        $data['zone'] = $this->Master_Model->generateDropdown($result, 'Zone', 'Zone');
        $product = $this->admin_model->show_pro_list();
        $data['productlist'] = $this->Master_Model->generateDropdown($product, 'id', 'Brand_Name');
        $condition = array();
        if ($this->input->get('Zone') != '') {
            $condition[0] = "em.Zone = '" . $this->input->get('Zone') . "'";
            $data['zone'] = $this->Master_Model->generateDropdown($result, 'Zone', 'Zone', $this->input->get('Zone'));
        }
        if ($this->input->get('Division') != '') {
            $condition[1] = "em.Division = '" . $this->input->get('Division') . "'";
        }
        if ($this->input->get('Product') != '') {
            $condition[2] = "rp.Product_id = " . $this->input->get('Product');
            $data['result'] = $this->User_model->monthlyTrend2(1, $this->nextYear, $this->input->get('Product'), $condition);
            $data['productlist'] = $this->Master_Model->generateDropdown($product, 'id', 'Brand_Name', $this->input->get('Product'));
        } else {
            $data['result'] = $this->User_model->monthlyTrend2(1, $this->nextYear, $this->input->get('Product'), $condition);
        }

        $data = array('title' => 'Monthly Trend', 'content' => 'ho/monthlyTrend', 'page_title' => 'Monthly Rx Trend', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    function dailyTrend2() {
        $this->load->model('User_model');
        $this->User_model->dailyTrend2('2016-02-01', '2016-02-10', '');
    }

    function diabetesTrend() {
        $this->load->model('Master_Model');
        $this->load->model('User_model');
        $condition = array();
        $result = $this->admin_model->find_zone();
        $data['zone'] = $this->Master_Model->generateDropdown($result, 'Zone', 'Zone');

        $data['result'] = $this->User_model->DivisionWise($this->nextYear, '4,5,6', $condition);

        $data = array('title' => 'Division Trend', 'content' => 'ho/DivisionTrend', 'page_title' => 'Monthly Rx Trend', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    function ThrombiTrend() {
        $this->load->model('Master_Model');
        $this->load->model('User_model');
        $condition = array();
        $result = $this->admin_model->find_zone();
        $data['zone'] = $this->Master_Model->generateDropdown($result, 'Zone', 'Zone');
        $data['result'] = $this->User_model->DivisionWise2($this->nextYear, '1,2,3', $condition);

        $data = array('title' => 'Division Trend', 'content' => 'ho/DivisionTrend2', 'page_title' => 'Monthly Rx Trend', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

}
