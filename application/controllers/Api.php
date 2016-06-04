<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Sendsms');
        $this->load->model('WorkExperince_model');
        $this->load->model('address_model');
        $this->load->model('Job_model');
        $this->load->model('notification_model');
        $this->load->model('employee_model');
    }

    public function login() {
        $this->load->model('User_model');
        $email = $_GET['email'];
        $password = md5($_GET['password']);
        $content = array();
        $check = $this->User_model->log($email, $password);
        $device_id = $_REQUEST['device_id'];

        if (!empty($check) && $check['type'] == 'User') {
            //$content[] = $check;
            $view['user3'] = array_shift($this->User_model->qualification_view($check['auth_id']));
            $view['profile'] = $this->User_model->view($check['auth_id']);
            $view['verify'] = $this->User_model->veiw3($check['auth_id']);
            // $verify = $view['verify']['verified'];
//           var_dump($view['verify']);
            $verify = is_null($view['verify']) ? '1' : '0';
            $content[] = array(
                'email' => $view['profile']['email'],
                'name' => $view['profile']['name'],
                'user_id' => $view['profile']['user_id'],
                'mobile' => $view['profile']['mobile'],
                'location' => $view['profile']['cuurentloc'],
                'key skill' => $view['profile']['key_skill'],
                'experince_month' => $view['profile']['experince_month'],
                'experince_year' => $view['profile']['exp_year'],
                'qualification' => $view['user3']->qualification,
                'specialization' => $view['user3']->specialization,
                'institute' => $view['user3']->institute,
                'year' => $view['user3']->year,
                'auth_id' => $view['user3']->auth_id,
                'verified' => $verify,
            );
            $id = $view['user3']->auth_id;
            if (!empty($device_id)) {
                $data = array(
                    'auth_id' => $id,
                    'device_id' => $device_id,
                );
                $this->User_model->device_id($id, $data);
            }

            $output = array('status' => 'success', 'message' => $content);
        } else {
            $output = array('status' => 'Error', 'message' => 'Error');
        }


        header('content-type: application/json');
        echo json_encode($output);
    }

    public function register() {
        $this->load->model('User_model');
        $this->load->model('address_model');

        if ($this->input->post()) {

            $field_array = array(
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'mobile' => $this->input->post('mobile'),
                'created_at' => date('Y-m-d H:i:s'),
                'type' => 'User'
            );
            $check = $this->User_model->find_by_email($this->input->post('email'), $this->input->post('mobile'));
            ///////Create New User
            if (empty($check)) {
                $id = $this->User_model->create($field_array);
            } else {
                $id = 'Already register';
            }


            $data = array(
                'name' => $this->input->post('name'),
                'dob' => $this->input->post('dob'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'auth_id' => $id,
                'updated_at' => date('Y-m_d H:i:s'),
                'gender' => $this->input->post('sex'),
                'exp_year' => $this->input->post('experince_year'),
                'experince_month' => $this->input->post('experince_month'),
                'current_location' => $this->input->post('current_location'),
                'prefred_location' => $this->input->post('prefred_location'),
                'industry' => $this->input->post('industry'),
                'function_area' => $this->input->post('function_area'),
                'role' => $this->input->post('role'),
                'key_skill' => $this->input->post('key_skill'),
                'marital_status' => $this->input->post('marital_status'),
                'resume_headline' => $this->input->post('resume_headline'),
            );

            /////////Insert Basic Profile
            $this->User_model->Add_detail($id, $data);

            ////////Insert education Details
            $qualification = $this->input->post("qualification");
            $specialization = $this->input->post("specialization");
            $institute = $this->input->post("institute");
            $year = $this->input->post("year");

            for ($i = 0; $i < count($this->input->post('qualification')); $i++) {
                $education_details = array(
                    'qualification' => $qualification[$i],
                    'specialization' => $specialization[$i],
                    'institute' => $institute[$i],
                    'year' => $year[$i],
                    'created' => date('Y-m-d H:i:s'),
                    'auth_id' => $id
                );

                $this->User_model->user_qualification($education_details);
            }

            $output = array('status' => 'success', 'message' => $id);
        } else {
            $output = array('status' => 'error', 'message' => 'Error');
        }

        header('content-type: application/json');
        echo json_encode($output);
    }

    public function getLocation() {
        $this->load->model('Master_model');
        $locations = $this->Master_model->listLocation();
        $content = array();
        if (!empty($locations)) {
            foreach ($locations as $loc) {
                $content[] = array(
                    'loc_id' => $loc->loc_id,
                    'location' => $loc->location
                );
            }
            $output = array('status' => 'success', 'message' => $content);
        } else {
            $output = array('status' => 'error', 'message' => 'Details Not Found');
        }

        header('content-type: application/json');
        echo json_encode($output);
    }

    public function changepassword() {
        $this->load->model('User_model');
        $this->load->model('address_model');
        $auth_id = $_GET['auth_id'];
        $password = md5($_GET['password']);
        $old_password = md5($_GET['old_password']);
        $check = $this->User_model->find_by_id($auth_id);
//        $field_array=array();
        $field_array = array(
            'password' => $password,
        );
        if ($check['password'] == $old_password) {
            if (!empty($field_array)) {
                $id = $this->User_model->changepassword($field_array, $auth_id);
                $output = array('status' => 'success', 'message' => 'successfully changed');
            } else {
                $output = array('status' => 'error', 'message' => 'Enter Password');
            }
        } else {
            $output = array('status' => 'error', 'message' => 'Details Not Found');
        }

        header('content-type: application/json');
        echo json_encode($output);
    }

    public function resume_add() {
//            if ($this->input->post()) {
        $user_id = $_REQUEST['id'];
        $detail = $_REQUEST['detail'];

        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '\jobportal\assets\Resume';
        $config['allowed_types'] = '*';
        $config['max_size'] = '4096';
        $old = $_FILES['resume']['name'];
        $new_name = time();
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        $this->upload->display_errors('', '');
        $this->form_validation->set_rules('detail', 'client', 'trim|required');
        if (!$this->upload->do_upload("resume")) {
            echo $this->upload->display_errors();
            die();
            $this->data['error'] = array('error' => $this->upload->display_errors());
            $output = array('status' => 'error', 'message' => 'Details Not Found');
        } else {
            $upload_result = $this->upload->data();

            // print_r($upload_result['file_name']); //or print any valid
            $content = array();
            $content[] = array(
                'Success' => 'Successfully Uploded',
            );
            $this->User_model->resume2($upload_result['file_name'], $user_id, $detail, $old);
            $output = array('status' => 'success', 'message' => $content);
        }


//            $data = array('title' => 'Resume Upload', 'content' => 'User/resume', 'view_data' => 'blank');
//            $this->load->view('template1', $data);
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function view() {

        $user_id = $_REQUEST['id'];
        $content = array();
        $view['profile'][] = $this->User_model->view4($user_id);
        $view['projects'] = $this->User_model->view2($user_id);
        $view['verified'][] = $this->User_model->veiw3($user_id);
        $view['qualification'] = $this->User_model->qualification_view2($user_id);
        $view['workexperince'] = $this->User_model->show_workexp($user_id);
        // $view['work_exp'][] = $this->User_model->work_exp_show($user_id);
        $check = $this->User_model->user_resume($user_id);

        if (!empty($check)) {
            $view['resume'][] = array(
                'resume' => (base_url() . 'assets/Resume/' . $check['resume']),
                'name' => $check['old'],
            );
        } else {
            $view['resume'][] = array('message' => 'Error');
        }
        if (!empty($view['profile']) || !empty($view['projects']) || !empty($view['verified']) || !empty($view['qualification']) || !empty($view['workexperince'])) {
            //$output = array('status' => 'Success', 'message' => array('profile'=>$view['profile'],'Education'=>$view['user3']));
            $output = array('status' => 'Success', 'message' => array($view));
        } else {
            $content[] = array(
                'Message' => 'Details Not Found'
            );
            $output = array('status' => 'error', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function show_skill() {
        //.$skill = $_REQUEST['skill'];
        $user_id = $_REQUEST['id'];
        $find = $this->User_model->find_by_user_id($user_id);
        $content = array();
        $content[] = array(
            'key skill' => $find['key_skill']
        );
        $output = array('status' => 'success', 'message' => $content);
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function edit_skill() {
        $skill = $_REQUEST['skill'];
        $user_id = $_REQUEST['id'];

        $data = array('key_skill' => $skill);
        $find = $this->User_model->Add_skill($data, $user_id);

        $output = array('status' => 'success', 'message' => 'updated Successfully');

        $data1 = array();
        $data = array('key_skill' => $skill);
        $find = $this->User_model->Add_skill($data, $user_id);
        $find1 = $this->User_model->find_by_user_id($user_id);
        $data1[] = array(
            'Key skill' => $find1['key_skill'],
        );
        $output = array('status' => 'success', 'message' => $data1);
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function verification() {
        $id = $_REQUEST['id'];
        $number = $_REQUEST['mobile'];
        $code = rand(0, 9999);
        $message = 'This Is Your Verification Code ' . $code;
        $check1 = array();
        $data = array(
            'auth_id' => $id,
            'mobile' => $number,
            'code' => $code,
            'created' => date('Y-m-d H:i:s'),
        );
        $check = $this->User_model->verification_by_id($id);
        if (empty($check)) {
            $enter = $this->User_model->verification($data);
            $check1[] = $this->User_model->verification_by_id($id);
            $this->Sendsms->sendsms($number, $message);
            $output = array('status' => 'success', 'message' => $check1);
        } else {
            $content = array();
            if ($check['verified'] == 1) {

                $content[] = array(
                    'Message' => 'Verified'
                );
                $output = array('status' => 'error', 'message' => $content);
            } else {
                $content[] = array(
                    'Message' => 'Error'
                );
                $output = array('status' => 'error', 'message' => $content);
            }
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function verified() {
        $code = $_REQUEST['code'];
        $id = $_REQUEST['id'];
        $check = $this->User_model->verification_by_id($id);
        if (!empty($check)) {
            if ($check['code'] == $code) {

                if ($check['verified'] == 1) {
                    $output = array('status' => 'success', 'message' => 'Already Verified');
                } else {
                    $data = array(
                        'verified' => 1
                    );
                    $update = $this->User_model->verification_update($id, $data);
                    $output = array('status' => 'success', 'message' => 'Verified');
                }
            } else {
                $output = array('status' => 'success', 'message' => 'Wrong Verification Code');
            }
        }

        header('content-type: application/json');
        echo json_encode($output);
    }

    public function Qualification() {
        $qualification = $_REQUEST['qualification'];
        $specialization = $_REQUEST['specialization'];
        $id = $_REQUEST['id'];
        $institute = $_REQUEST['institute'];
        $year = $_REQUEST['year'];
        $content = array();

        $education_details = array(
            'qualification' => $qualification,
            'specialization' => $specialization,
            'institute' => $institute,
            'year' => $year,
            'created' => date('Y-m-d H:i:s'),
            'auth_id' => $id
        );
        if (!empty($education_details)) {
            $this->User_model->user_qualification($education_details);
            $content[] = array(
                'Message' => 'Added Succesfully',
            );
            $output = array('status' => 'success', 'message' => $content);
        } else {
            $content[] = array(
                'Message' => 'Error',
            );
            $output = array('status' => 'error', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function workexperince() {

        $name = $_REQUEST['name'];
        $type = $_REQUEST['type'];
        $form = $_REQUEST['from'];
        $to = $_REQUEST['to'];
        $designation = $_REQUEST['designation'];
        $profile = $_REQUEST['profile'];
        $id = $_REQUEST['id'];


        $data1 = array(
            'emp_name' => $name,
            'type' => $type,
            'from' => $form,
            'to' => $to,
            'auth_id' => $id,
            'designation' => $designation,
            'job_profile' => $profile,
        );

        if (!empty($data1)) {
            $content = array();

            $data = $this->WorkExperince_model->add2($data1);
            $content[] = array(
                'Message' => 'successfully Added'
            );
            $output = array('status' => 'succcess', 'message' => $content);
        } else {
            $content = array();
            $content[] = array(
                'Message' => 'Error'
            );
            $output = array('status' => 'error', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function projects() {
        $this->load->model('Master_model');
        $client = $_REQUEST['client'];
        $id = $_REQUEST['id'];
        $projects_title = $_REQUEST['title'];
        $from = $_REQUEST['from'];
        $to = $_REQUEST['to'];
        $detail = $_REQUEST['detail'];
        $content = array();
        $data = array(
            'client' => $client,
            'auth_id' => $id,
            'projects_title' => $projects_title,
            'to' => $to,
            'from' => $from,
            'detail' => $detail,
        );
        if (!empty($data)) {

            $this->User_model->project_add2($data);
            $content[] = array(
                'Message' => 'Successfully Added'
            );
            $output = array('status' => 'success', 'message' => $content);
        } else {
            $content[] = array(
                'Message' => 'Error'
            );
            $output = array('status' => 'error', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function Personal_detail() {
        $dob = $_REQUEST['dob'];
        $id = $_REQUEST['id'];
        $pincode = $_REQUEST['pincode'];
        $maritial = $_REQUEST['Maritialstatus'];
        $address = $_REQUEST['address'];
        $gender = $_REQUEST['gender'];

        $content = array();
        $data = array(
            'dob' => $dob,
            'marital_status' => $maritial,
            'gender' => $gender,
        );
        $data2 = array(
            'address1' => $address,
            'auth_id' => $id,
            'pincode' => $pincode,
        );
        if (!empty($data) && !empty($data2)) {
            $upadte = $this->User_model->personal_detail($id, $data);
            $upadte2 = $this->address_model->add_address2($id, $data2);
            $content[] = array(
                'Message' => 'Successfully Added'
            );
            $output = array('status' => 'success', 'message' => $content);
        } else {
            $content[] = array(
                'Message' => 'Error'
            );
            $output = array('status' => 'error', 'message' => $content);
        }

        header('content-type: application/json');
        echo json_encode($output);
    }

    public function work_detail() {
        $industry = $_REQUEST['industry'];
        $id = $_REQUEST['id'];
        $function_area = $_REQUEST['function_area'];
        $role = $_REQUEST['role'];
        $prefred_location = $_REQUEST['preferd_location'];

        $content = array();
        $data = array(
            'industry' => $industry,
            'function_area' => $function_area,
            'role' => $role,
            'prefred_location' => $prefred_location,
        );
        if (!empty($data)) {
            $upadte = $this->User_model->personal_detail($id, $data);
            $content[] = array(
                'Message' => 'Successfully Added'
            );
            $output = array('status' => 'success', 'message' => $content);
        } else {
            $content[] = array(
                'Message' => 'Error'
            );
            $output = array('status' => 'error', 'message' => $content);
        }

        header('content-type: application/json');
        echo json_encode($output);
    }

    public function SearchJob() {
        $this->load->model('Master_model');
        $this->load->model('Job_model');
        $skill = $_REQUEST['skill'];
        $location = $_REQUEST['location'];
        $experince = $_REQUEST['experince'];
        if ($skill || $location || $experince) {
            $conditions = array();
            if ($_REQUEST['skill'] != '') {
                $skill = $_REQUEST['skill'];
                $conditions[] = "j.`keyword` LIKE '%$skill%'";
            }
            if ($_REQUEST['skill'] != '') {
                $skill = $_REQUEST['skill'];
                $conditions[] = "j.`title` LIKE '%$skill%'";
            }
            if ($_REQUEST['location'] != '') {
                $location = $_REQUEST['location'];
                $conditions[] = "j.`location` ='$location'";
            }
            if ($_REQUEST['experince'] != '') {
                $experince = $_REQUEST['experince'];
                $conditions[] = "j.exp_max =$experince ";
            }
            //$data = array();
            $data = $this->Job_model->search($conditions);
            if (!empty($data)) {
                $output = array('status' => 'success', 'message' => $data);
            } else {
                $content = array();
                $content[] = array(
                    'Message' => 'Error'
                );
                $output = array('status' => 'error', 'message' => $content);
            }
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function SearchJob3() {

        $this->load->model('Master_model');
        $this->load->model('Job_model');
        $skill = $_REQUEST['skill'];
        $location = $_REQUEST['location'];
        $experince = $_REQUEST['experince'];
        $id = $_REQUEST['id'];
        if ($skill || $location || $experince) {
            $conditions = array();
            if ($_REQUEST['skill'] != '') {
                $skill = $_REQUEST['skill'];
                $conditions[] = "j.`keyword` LIKE '%$skill%'";
            }
            if ($_REQUEST['skill'] != '') {
                $skill = $_REQUEST['skill'];
                $conditions[] = "j.`title` LIKE '%$skill%'";
            }
            if ($_REQUEST['location'] != '') {
                $location = $_REQUEST['location'];
                $conditions[] = "j.`location` ='$location'";
            }
            if ($_REQUEST['experince'] != '') {
                $experince = $_REQUEST['experince'];
                $conditions[] = "j.exp_max =$experince ";
            }
            //$data = array();
            $data = $this->Job_model->search3($conditions, $id);
            if (!empty($data)) {
                $output = array('status' => 'success', 'message' => $data);
            } else {
                $content = array();
                $content[] = array(
                    'Message' => 'Error'
                );
                $output = array('status' => 'error', 'message' => $content);
            }
        }

        header('content-type: application/json');
        echo json_encode($output);
    }

    public function SearchJob2() {

        $this->load->model('Master_model');
        $user_id = $_REQUEST['id'];

        $data1 = $this->User_model->find_by_user_id2($user_id);
        $data = $this->User_model->all_job3($data1['function_area'], $data1['key_skill'], $user_id);
        if (!empty($data)) {
            $output = array('status' => 'success', 'message' => $data);
        } else {
            $content = array();
            $content[] = array(
                'Message' => 'Error'
            );
            $output = array('status' => 'error', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function jobview() {

        $this->load->model('Master_model');
        $id = $_REQUEST['jobid'];


        $data[] = $this->Job_model->view_job($id);
        if (!empty($data)) {
            $output = array('status' => 'success', 'message' => $data);
        } else {
            $content = array();
            $content[] = array(
                'Message' => 'Error'
            );
            $output = array('status' => 'error', 'message' => 'error');
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function apply() {
        $user_id = $_REQUEST['user'];
        $id = $_REQUEST['job'];
        $ck = $this->Job_model->job_apply_message($id);
        $message = 'You Successfully Applied for' . $ck['title'] . 'Job';
        $data = $this->Job_model->apply_id($id, $user_id);

        if (!empty($data)) {
            $content = array();
            $content[] = array(
                'Message' => 'Allready Applied',
            );
            $output = array('status' => 'error', 'message' => $content);
        } else {
            $this->Job_model->apply($id, $user_id);
            $content = array();
            $content[] = array(
                'Message' => 'Succesfully Applied',
            );
            $notification['noti'] = $this->User_model->find_by_id($user_id);
            $not = $this->notification_model->pushNotification($message, $notification['noti']['device_id'], $user_id);
            $output = array('status' => 'success', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function applicationhistory() {
        $user_id = $_REQUEST['user'];
        $data = $this->User_model->application($user_id);
        if (!empty($data)) {
//            $content = array();
//            $content[] = array(
//                'Message' => 'Allready Applied',
//            );
            $output = array('status' => 'success', 'message' => $data);
        } else {
            $content = array();
            $content[] = array(
                'Message' => 'error',
            );
            $output = array('status' => 'error', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function show_alljobs() {
        $job_id = $_REQUEST['job_id'];
        $user_id = $_REQUEST['user_id'];
        $data = $this->User_model->show_alljobs($job_id, $user_id);
        if (!empty($data)) {
            $output = array('status' => 'success', 'message' => $data);
        } else {
            $content = array();
            $content[] = array(
                'Message' => 'error',
            );
            $output = array('status' => 'error', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function profile_update() {
        $user_id = $_REQUEST['user_id'];
        $chk['chk'] = $this->User_model->find_by_id($user_id);
        //$field
        $data = array(
            'name' => $_REQUEST['name'],
            'dob' => $_REQUEST['dob'],
            'email' => $chk['chk']['email'],
            'mobile' => $chk['chk']['mobile'],
            'auth_id' => $user_id,
            'updated_at' => date('Y-m_d H:i:s'),
            'gender' => $_REQUEST['gender'],
            'exp_year' => $_REQUEST['experince_year'],
            'experince_month' => $_REQUEST['experince_month'],
            'current_location' => $_REQUEST['current_location'],
            'prefred_location' => $_REQUEST['prefred_location'],
            'industry' => $_REQUEST['industry'],
            'function_area' => $_REQUEST['function_area'],
            'role' => $_REQUEST['role'],
            'key_skill' => $_REQUEST['key_skill'],
            'marital_status' => $_REQUEST['marital_status'],
            'resume_headline' => $_REQUEST['resume_headline'],
        );
        $field_array = array(
            'auth_id' => $user_id,
            'address1' => $_REQUEST['address1'],
            'pincode' => $_REQUEST['pincode'],
            'state' => $_REQUEST['state'],
            'city' => $_REQUEST['city'],
            'updated_at' => date('Y-m-d H:i:s'),
        );

        $check['User1'] = $this->User_model->Add_detail($user_id, $data);
        $check['User2'] = $this->address_model->add_address3($user_id, $field_array);
        if (!empty($check)) {
            $content = array();
            $content[] = array(
                'Message' => 'Successfully Updated',
            );
            $output = array('status' => 'success', 'message' => $content);
        } else {
            $content = array();
            $content[] = array(
                'Message' => 'error',
            );
            $output = array('status' => 'error', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function project_update() {
        $project_id = $_REQUEST['project_id'];
        $data = array(
            'client' => $_REQUEST['client'],
            'projects_title' => $_REQUEST['projects_title'],
            'to' => $_REQUEST['to'],
            'from' => $_REQUEST['from'],
            'detail' => $_REQUEST['detail'],
        );
        $data1 = $this->User_model->project_update3($project_id, $data);
        if (!empty($data1)) {
            $content = array();
            $content[] = array(
                'Message' => 'Successfully Updated Project Detail   ',
            );
            $output = array('status' => 'success', 'message' => $content);
        } else {
            $content = array();
            $content[] = array(
                'Message' => 'error',
            );
            $output = array('status' => 'error', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function qualification_update() {
        $qualification_id = $_REQUEST['qualification_id'];
        $qualification = $_REQUEST['qualification'];
        $specialization = $_REQUEST['specialization'];
        $institute = $_REQUEST['institute'];
        $year = $_REQUEST['year'];
        $user_id = $_REQUEST['user_id'];
        $data = array(
            'qualification' => $qualification,
            'specialization' => $specialization,
            'institute' => $institute,
            'year' => $year,
            'updated_at' => date('Y-m-d H:i:s'),
            'auth_id' => $user_id,
        );
        $data1 = $this->User_model->user_qualification_update($data, $qualification_id);
        if (!empty($data1)) {
            $content = array();
            $content[] = array(
                'Message' => 'Successfully Updated Qualification Detail',
            );
            $output = array('status' => 'success', 'message' => $content);
        } else {
            $content = array();
            $content[] = array(
                'Message' => 'error',
            );
            $output = array('status' => 'error', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function percentage() {
        $user_id = $_REQUEST['user_id'];
        $percentage = $this->User_model->percentage($user_id);
        $updateDate = $this->User_model->find_by_user_id($user_id);
        $data[] = array(
            'updated_at' => $updateDate['updated_at'],
            'percentage' => '' . $percentage . ''
        );
        if (!empty($data)) {
            $output = array('status' => 'success', 'message' => $data);
        } else {
            $content = array();
            $content[] = array(
                'Message' => 'error',
            );
            $output = array('status' => 'error', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function visitor_count() {
        $user_id = $_REQUEST['auth_id'];
        $data['count'] = $this->employee_model->visitor_visit($user_id);
        $content = array();
        if (!empty($data)) {
            $dataq = array();
            $dataq['count'][] = array(
                'count' => $data['count']['count']
            );
            $dataq['visitor detail'] = $this->Job_model->visitor_detail($user_id);
            $content[] = $dataq;
            $output = array('status' => 'success', 'message' => $content);
        } else {
            $content = array();
            $content[] = array(
                'Message' => 'error',
            );
            $output = array('status' => 'error', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function workexp_update() {
        $emp_id = $_REQUEST['emp_id'];
        $emp_name = $_REQUEST['emp_name'];
        $from = $_REQUEST['from'];
        $to = $_REQUEST['to'];
        $job_profile = $_REQUEST['job_profile'];
        $type = $_REQUEST['type'];
        $data = array(
            'emp_name' => $emp_name,
            'from' => $from,
            'to' => $to,
            'job_profile' => $job_profile,
            'type' => $type,
        );
        $find = $this->User_model->find_by_emp_id($emp_id);
        if (!empty($find)) {

            $data1 = $this->User_model->user_workexp_update($data, $emp_id);
            if (!empty($data1)) {
                $content = array();
                $content[] = array(
                    'Message' => 'Successfully Updated Work Experince Detail',
                );
                $output = array('status' => 'success', 'message' => $content);
            }
        } else {
            $content = array();
            $content[] = array(
                'Message' => 'error',
            );
            $output = array('status' => 'error', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function forget_password() {
        $mobile = $_REQUEST['mobile'];
        if (!empty($mobile)) {
            $code = rand(0, 9999);
            $message = 'This Is Your Verification Code ' . $code;
            $this->Sendsms->sendsms($mobile, $message);
            $data = array(
                'code' => $code,
                'mobile' => $mobile,
                'created' => date('Y-m-d H:i:s'),
            );
            $check = $this->User_model->find_by_mobile($mobile);
            if (!empty($check)) {
                $update = $this->User_model->update_code($data, $check['id']);
            } else {
                $create = $this->User_model->insert_code($data);
            }
            $content = array();
            $content[] = array(
                'Message' => 'Verification Code succefully send',
                'code'=>''.$code.'',
            );
            $output = array('status' => 'Success', 'message' => $content);
        } else {
            $content = array();
            $content[] = array(
                'Message' => 'Please Enter Mobile Number',
            );
            $output = array('status' => 'error', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function forget_password_verify() {
        $code = $_REQUEST['code'];
        $mobile = $_REQUEST['mobile'];
        $password = $_REQUEST['password'];
        $check = $this->User_model->find_by_mobile($mobile);
        if ($code == $check['code']) {
            $data = array(
                'password' => md5($password),
            );
            $update_password = $this->User_model->update_password($data, $mobile);
            $content = array();
            $content[] = array(
                'Message' => 'Succefully updated Password',
            );
            $output = array('status' => 'Success', 'message' => $content);
        } else {
            $content = array();
            $content[] = array(
                'Message' => 'Please Enter Correct Password',
            );
            $output = array('status' => 'error', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

    public function getSkills() {
        $result = $this->Job_model->getSkills();

        $content = array();
        if (!empty($result)) {
            foreach ($result as $value) {
                $content[] = array(
                    'skill' => $value->skill
                );
            }
            $output = array('status' => 'success', 'message' => $content);
        } else {
            $output = array('status' => 'error', 'message' => $content);
        }
        header('content-type: application/json');
        echo json_encode($output);
    }

}
