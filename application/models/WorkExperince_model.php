<?php

class WorkExperince_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function add($id) {
        $data = array(
            'emp_name' => $this->input->post('employer_name'),
            'auth_id' => $id,
            'type' => $this->input->post('employer_type'),
            'from' => $this->input->post('from'),
            'to' => $this->input->post('to'),
            'designation' => $this->input->post('designation'),
            'job_profile' => $this->input->post('job_profile'),
            'notice_period' => $this->input->post('notice_period'),
        );
        return $this->db->insert('work_exp', $data);
    }
    public function add2($data) {
        return $this->db->insert('work_exp', $data);
    }

    public function update($id) {
        $data = array(
            'emp_name' => $this->input->post('employer_name'),
            'auth_id' => $id,
            'type' => $this->input->post('employer_type'),
            'from' => $this->input->post('from'),
            'to' => $this->input->post('to'),
            'designation' => $this->input->post('designation'),
            'job_profile' => $this->input->post('job_profile'),
            'notice_period' => $this->input->post('notice_period'),
        );
        $this->db->where(array('auth_id' => $id));
        return $this->db->update('work_exp', $data);
    }

    public function work_by_id($id) {

        $query = "SELECT *FROM work_exp u

                    WHERE u.auth_id=$id ORDER BY u.emp_id DESC  LIMIT 1";
        $query = $this->db->query($query);

        return $query->row_array();
    }

}
