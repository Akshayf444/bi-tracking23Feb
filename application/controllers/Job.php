<?php

class Job extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Job_model');
    }

    function Jobs() {
        
    }

    function index() {
        $this->load->model('Master_model');
        $this->load->model('Job_model');
        $result = $this->Job_model->countSearch(array(), array());

        $data['trendingJob'] = $this->Job_model->trendingJob();
        $data['companies'] = $this->Job_model->companies();
        $data['totalCount'] = $result->jobsearch;
        $data = array('title' => 'Search Job', 'content' => 'job/searchJob', 'view_data' => $data, 'frontImage' => 'search.jpg', 'searchBar' => TRUE, 'dropdowns' => $this->Master_model->listLocation());
        $user_id = $this->session->userdata("user_id");

        $this->load->view('frontTemplate', $data);
    }

    function add() {
        //var_dump($_POST);
        $data['auth_id'] = $this->session->userdata("user_id");
        if (isset($this->user_id) && $this->user_id != '' && $this->user_type == 'Employee') {
            if ($this->input->post()) {
                $this->form_validation->set_rules('title', 'title', 'trim|required');
                $this->form_validation->set_rules('description', 'description', 'trim|required');
                $this->form_validation->set_rules('skill', 'skill', 'required');
                $this->form_validation->set_rules('exp_min', 'Minimum Experience', 'trim|required');
                $this->form_validation->set_rules('exp_max', 'Maximum Experience', 'trim|required');
                $this->form_validation->set_rules('ctc_min', 'CTC', 'trim|required');
                $this->form_validation->set_rules('location', 'Location', 'required');
                $this->form_validation->set_rules('functional_area', 'Functional Area', 'trim|required');
//                $this->form_validation->set_rules('industry', 'Industry', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $this->Job_model->add($data['auth_id']);
                }
            }

            $this->load->model('Master_model');
            $data['location'] = $this->Master_model->getLocation();
            $data['experience'] = $this->Master_model->getWorkExperience();
            $data['industry'] = $this->Master_model->getIndustry();
            $data['functional_area'] = $this->Master_model->getFunctionArea();

            $data = array('title' => 'Add Job', 'content' => 'job/add', 'view_data' => $data);
            $this->load->view('frontTemplate5', $data);
        } else {
            redirect('Employee/logout', 'refresh');
        }
    }

    public function edit($id) {
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');
        $this->form_validation->set_rules('keyword', 'keyword', 'trim|required');
        $this->form_validation->set_rules('exp_min', 'Minimum Experience', 'trim|required');
        $this->form_validation->set_rules('exp_max', 'Maximum Experience', 'trim|required');
        $this->form_validation->set_rules('ctc_min', 'CTC', 'trim|required');
        $this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_rules('functional_area', 'Functional Area', 'trim|required');
        $this->form_validation->set_rules('industry', 'Industry', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $this->Job_model->update_job($id);
        }
        $result = $this->Job_model->view_job($id);
        $data['user'] = $result;
        $this->load->model('Master_model');
        $data['industry'] = $this->Master_model->getFunctionArea($result['industry']);
        $data['location'] = $this->Master_model->getLocation($result['location']);
        $data['experience'] = $this->Master_model->getWorkExperience($result['exp_min']);
        $data['experience1'] = $this->Master_model->getWorkExperience($result['exp_max']);
        $data['functional_area'] = $this->Master_model->getFunctionArea($result['functional_area']);
        $userdata = array('title' => ' update Job', 'content' => 'job/edit', 'view_data' => $data);
        $this->load->view('template1', $userdata);
    }

    public function Job_list() {
        $user_id = $this->session->userdata("user_id");
        $userdata['users'] = $this->Job_model->job_list($user_id);
        $data = array('title' => 'List Of Jobs ', 'content' => 'job/job_list', 'view_data' => $userdata);
        $this->load->view('frontTemplate5', $data);
    }

    public function view($id) {
//        $user_id = $this->session->userdata("user_id");
        $userData['user'] = $this->Job_model->view_job($id);
        $data = array('title' => 'Basic Employee Profile', 'content' => 'job/view', 'view_data' => $userData);
        $this->load->view('template1', $data);
    }

    ///Get List Of Applied Candidates
    public function candidates() {
        $id = $this->session->userdata("user_id");
        $condition = array(
            'jobs.auth_id = ' . $id
        );
        if (isset($_GET['job'])) {
            $condition[2] = 'jobs.job_id = ' . $_GET['job'];
        }
        $userData['user'] = $this->Job_model->appiled_job($condition);

//        $this->load->view('job/view_applied_job',$userData);
        $data = array('title' => 'Applied Jobs List', 'content' => 'job/view_applied_job', 'view_data' => $userData);

        $this->load->view('frontTemplate5', $data);
    }

    public function Search($page = 1) {
        $page = isset($page) && $page > 0 ? $page : 1;
        $perpage = 20;
        $offset = 0;
        $this->load->model('Master_model');
        $search = array();
        $user_id = $this->session->userdata("user_id");
        if ($this->input->get()) {
            $conditions = array();
            $conditions3 = array();
            $conditions2 = array();
            $location_condition = array();

            if ($this->input->get('skill') != '') {
                $skill = explode(",", $this->input->get('skill'));
                $skill = array_filter(array_map('trim', $skill));
                foreach ($skill as $value) {
                    $conditions3[] = " ( j.`keyword` LIKE '%$value%'  OR j.`title` LIKE '%$value%' OR ep.`name` LIKE '%$value%' ) ";
                }

                $conditions[] = join(" OR ", $conditions3);
            }

            if ($this->input->get('location') != '') {
                $location = explode(",", $this->input->get('location'));
                $location = array_filter(array_map('trim', $location));

                foreach ($location as $value) {
                    $conditions2[] = " `location` LIKE '%$value%'";
                }
                $location_condition[] = join(" OR ", $conditions2);
            }


            if ($this->input->get('experince') != '') {
                $experince = $this->input->get('experince');
                $conditions[] = "j.exp_max =$experince ";
            }

//            isset($user_profile['current_location']) ? $this->Master_model->getLocation($user_profile['current_location']) : 
            $search['dropdowns'] = $this->Master_model->listLocation();
            $search['industry'] = $this->Master_model->listIndustry();
            $total_count = $this->Job_model->countSearch($conditions, $location_condition);

            if (isset($total_count->jobsearch)) {
                $search['total_pages'] = ceil($total_count->jobsearch / $perpage);
                $search['total_count'] = $total_count->jobsearch;
                $offset = ($page - 1) * $perpage;
            }

            //$conditions[] = " LIMIT {$perpage}  OFFSET  {$offset} ";

            $search['job'] = $this->Job_model->search($conditions, $perpage, $offset, $location_condition);

            $search['page'] = $page;
            $data = array('title' => 'Search Job', 'content' => 'job/index', 'view_data' => $search);
            $user_id = $this->session->userdata("user_id");
            //echo $user_id;
            if (isset($user_id) && $user_id > 0) {
                $this->load->view('frontTemplate3', $data);
            } else {
                $this->load->view('frontTemplate', $data);
            }
        }
    }

    public function viewDetails($id) {

        $this->load->model('Master_model');
        $user_id = $this->session->userdata("user_id");
        $is_logged_in = FALSE;
        $is_applied = FALSE;
        $data['view'] = $this->Job_model->view_job($id);
        if (isset($this->user_id) && $this->user_id > 0 && $this->user_type == 'User') {
            $is_logged_in = TRUE;
            $applied = $this->Job_model->applied($id, $user_id);
            if (!empty($applied)) {
                $is_applied = TRUE;
            }
        }
        $data['is_applied'] = $is_applied;
        $data['is_logged_in'] = $is_logged_in;

        $data = array('title' => 'Job Search', 'content' => 'Job/viewsearch2', 'view_data' => $data);
        $this->load->view('frontTemplate', $data);
    }

    public function apply($id) {
        if (isset($_GET['redirect_url']) && $_GET['redirect_url'] != '') {
            $redirect_url = $_GET['redirect_url'] . '&location=' . $_GET['location'];
        } else {
            $redirect_url = site_url('User/login');
        }
        if ($this->session->userdata("user_id") > 0) {
            $user_id = $this->session->userdata("user_id");
            $this->session->unset_userdata("redirect_url");
            $data['job'] = $this->Job_model->apply_id($id, $user_id);
            if (!empty($data['job'])) {
                ///echo $redirect_url;
                redirect($redirect_url);
                header("Location : " . $redirect_url);
            } else {
                $this->Job_model->apply($id, $user_id);
                //echo $redirect_url;
                redirect($redirect_url);
                header("Location : " . $redirect_url);
            }
        } else {
            $this->session->set_userdata("redirect_url", $redirect_url);
            redirect('User/login', 'refresh');
        }
        // print_r($this->session->all_userdata());
    }

    public function filter() {
        if ($this->session->userdata("user_id")) {
            $user_id = $this->session->userdata("user_id");
            if ($this->input->get()) {
                $conditions = array();
                if ($this->input->get('location') != '') {
                    $skill = $this->input->get('location');
                    $join = implode("','", $skill);
                    $conditions[] = "lm.`location` IN ('$join')";
                }
                if ($this->input->get('industry') != '') {
                    $skill = $this->input->get('industry');
                    $conditions[] = "im.`industry` LIKE '$skill%'";
                }


                $search['job'] = $this->Job_model->filter($conditions);

                $data = array('title' => 'Search Job', 'content' => 'job/filterresult', 'view_data' => $search);
                $this->load->view('template2', $data);
            }
        }
    }

    public function indus() {
        if ($_POST) {
            $q = $_POST['industry'];

            $areaList = array();
            $sql_res = $this->Job_model->type($q);

            if (!empty($sql_res)) {
                foreach ($sql_res as $res) {
                    $area_name = $res->industry;
                    array_push($areaList, $area_name);
                }
                echo json_encode($areaList);
            }
        }
    }

    public function getSkills() {
        $term = $_GET['term'];
        $skills = array();
        $sql = "SELECT DISTINCT(skill_name) as skill FROM skill_master where skill_name != '' AND skill_name LIKE '%$term%' UNION ALL SELECT DISTINCT(role) as skill FROM user where role != '' AND role LIKE '%$term%'  UNION ALL SELECT DISTINCT(name) as skill FROM emp_profile where name != ''  AND name LIKE '%$term%' ";
        $query = $this->db->query($sql);
        $result = $query->result();

        if (!empty($result)) {
            foreach ($result as $value) {
                array_push($skills, $value->skill);
            }
            echo json_encode($skills);
        } else {
            echo '';
        }
    }

    public function viewJobDetails($id) {

        $this->load->model('Master_model');
        $user_id = $this->session->userdata("user_id");
        $is_logged_in = FALSE;
        $is_applied = FALSE;
        $data['view'] = $this->Job_model->view_job($id);
        //var_dump($data['view']);
        $this->load->view('Job/viewJob', $data);
    }

}
