<?php

class Job_model extends CI_Model {

    function add($auth_id) {

        $field_array = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'no_of_vacancy' => $this->input->post('no_of_vacancy'),
            'exp_min' => $this->input->post('exp_min'),
            'exp_max' => $this->input->post('exp_max'),
            'ctc_min' => $this->input->post('ctc_min'),
            'ctc_type' => $this->input->post('ctc_type'),
            'hide_ctc' => $this->input->post('hide_ctc'),
            'location' => $this->input->post('location'),
            'industry' => $this->input->post('industry'),
            'functional_area' => $this->input->post('functional_area'),
            'auth_id' => $auth_id,
            'keyword' => $this->input->post('skill'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('jobs', $field_array);
    }

    public function job_list($id) {
        $sql = "SELECT j.*,count(aj.id) as applied_count FROM (SELECT * FROM jobs WHERE auth_id = '$id' AND status = 0 ) AS j LEFT JOIN apply_job aj ON aj.job_id = j.job_id GROUP BY j.job_id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function view_job($id = 0) {
        $sql = "SELECT 
                `jobs`.*,
                `u`.`mobile` AS contact,
                `industry_master`.`industry` AS industry_name,
                `functional_area`.`fun_area`,
                `emp`.name 
              FROM
                (SELECT 
                  * 
                FROM
                  jobs 
                WHERE job_id = {$id}) AS jobs
                LEFT JOIN `industry_master` 
                  ON `jobs`.`industry` = `industry_master`.`indus_id` 
                LEFT JOIN `functional_area` 
                  ON `jobs`.`functional_area` = `functional_area`.`fun_id` 
                LEFT JOIN `emp_profile` emp 
                  ON `jobs`.`auth_id` = `emp`.`auth_id` 
                LEFT JOIN `authentication` u 
                  ON `jobs`.`auth_id` = `u`.`auth_id` ";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        return $query->row_array();
    }

    public function update_job($id) {
//        $query = $this->view_job($id);
        $field_array = array(
            'job_id' => $this->input->post('id'),
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'no_of_vacancy' => $this->input->post('no_of_vacancy'),
            'exp_min' => $this->input->post('exp_min'),
            'exp_max' => $this->input->post('exp_max'),
            'ctc_min' => $this->input->post('ctc_min'),
            'ctc_type' => $this->input->post('ctc_type'),
            'hide_ctc' => $this->input->post('hide_ctc'),
            'location' => $this->input->post('location'),
            'industry' => $this->input->post('industry'),
            'functional_area' => $this->input->post('functional_area'),
            'keyword' => $this->input->post('skill'),
            'updated_at' => date('Y-m-d H:i:s'),
        );

        $this->db->where('jobs.job_id', $id);
        return $this->db->update('jobs', $field_array);
    }

    public function appiled_job($conditions = array()) {
        $query = "SELECT jobs.`job_id`,u.role,u.prefred_location as location,em.qualification,sm.specialization,apply_job.created as apply_date,(u.name) AS NAME,(jobs.title) AS title,u.`mobile`,(apply_job.`auth_id`) AS user_id,(u.`email`)AS email FROM apply_job

            INNER JOIN (SELECT * FROM jobs ";
        if (!empty($conditions)) {
            $query .= " WHERE " . join(" AND ", $conditions);
        }
        $query .= " ) as jobs 
                    ON apply_job.job_id = jobs.job_id  and jobs.status=0

                    LEFT JOIN user u 
                    ON apply_job.auth_id = u.auth_id 
                    LEFT JOIN user_qualification q
                    ON apply_job.auth_id = u.auth_id 
                    LEFT JOIN education_master em 
                    ON em.edu_id = q.qualification
                    LEFT JOIN specialization_master sm 
                    ON sm.spec_id = q.specialization";
        $query .= " GROUP BY jobs.job_id,apply_job.auth_id ";

        $query = $this->db->query($query);
        // echo $this->db->last_query();
        return $query->result();
    }

    public function search($conditions, $limit = 0, $offset = 0, $location_condition = array()) {
        $auth_id = $this->session->userdata('user_id');
        $auth_id = $auth_id > 0 ? $auth_id : 0;
        $query = "SELECT j.*, ep.name, (lm.`location`) AS loc, (CASE WHEN aj.id IS NOT NULL THEN 1 ELSE 0 END) as applied_status, (j.job_id) AS job_id, (j.auth_id) AS auth_id, j.created_at as posted_at FROM ( SELECT * FROM jobs ";
        if (!empty($location_condition)) {
            $query .= " WHERE " . join(" ", $location_condition);
        }

        $query .= " ) AS j
LEFT JOIN emp_profile ep
ON j.auth_id = ep.`auth_id`
LEFT JOIN `location_master` lm
ON lm.loc_id = j.location
LEFT JOIN `functional_area` fa
ON fa.`fun_id` = j.`functional_area`
LEFT JOIN apply_job aj
ON j.job_id = aj.job_id AND aj.auth_id = {$auth_id} ";
        if (!empty($conditions)) {
            $query .= ' WHERE ' . join(' ', $conditions);
        }
        //var_dump($query);

        $query .= " LIMIT {$limit} OFFSET {$offset} ";
        //echo $query;
        $query = $this->db->query($query);

        return $query->result();
    }

    public function countSearch($conditions, $location_condition) {
        $query = "SELECT COUNT(*) jobsearch FROM ( SELECT * FROM jobs ";
        if (!empty($location_condition)) {
            $query .= " WHERE " . join(" ", $location_condition);
        }
        $query .= ") AS j
LEFT JOIN emp_profile ep
ON j.auth_id = ep.`auth_id`
LEFT JOIN `location_master` lm
ON lm.loc_id = j.location
LEFT JOIN `functional_area` fa
ON fa.`fun_id` = j.`functional_area`";
        if (!empty($conditions)) {
            $query .= ' WHERE ' . join(' ', $conditions);
        }
        //var_dump($query);
        //echo $query;
        $query = $this->db->query($query);

        return $query->row();
    }

    public function search3($conditions, $user_id = 0) {
        $query = "SELECT *, (lm.`location`) AS loc, CASE WHEN ap.`job_id` IS NOT NULL THEN 1 ELSE 0 END AS applied_status, (j.job_id) AS job_id, (j.auth_id) AS auth_id FROM jobs j
LEFT JOIN emp_profile ep
ON j.auth_id = ep.`auth_id`
LEFT JOIN `location_master` lm
ON lm.loc_id = j.location
LEFT JOIN `functional_area` fa
ON fa.`fun_id` = j.`functional_area`
LEFT JOIN apply_job ap
ON ap.`job_id` = j.`job_id` AND ap.auth_id = '$user_id' ";

        if (!empty($conditions)) {
            $query .= ' WHERE ' . join(' And ', $conditions);
        }

        //echo($query);
        $query = $this->db->query($query);

        return $query->result();
    }

    public function applied($job_id, $auth_id = 0) {
        $data = "SELECT j.*, aj.* FROM jobs j
LEFT JOIN apply_job aj
ON j.job_id = aj.job_id
WHERE aj.auth_id = $auth_id AND j.job_id = $job_id and j.status = 0";
        $query = $this->db->query($data);

        return $query->row_array();
    }

    public function apply($job_id, $auth_id) {
        $data = array(
            'job_id' => $job_id,
            'auth_id' => $auth_id,
            'created' => date('Y-m-d H:i:s'),
        );
        return $this->db->insert('apply_job', $data);
    }

    public function apply_id($job_id, $auth_id) {
        $data = "SELECT * FROM apply_job
WHERE job_id = $job_id AND auth_id = $auth_id";
        $query = $this->db->query($data);
        return $query->row_array();
    }

    public function user_applied($auth_id) {
        $data = "SELECT *, (l.location) AS loc, (lmm.location) AS location, (up.location) AS ploc, (up.role) AS prole FROM user u
LEFT JOIN work_exp we
ON u.auth_id = we.auth_id
LEFT JOIN `location_master`lm
ON lm.loc_id = u.current_location
LEFT JOIN `location_master`lmm
ON lmm.loc_id = u.prefred_location
LEFT JOIN user_qualification uq
ON uq.auth_id = u.auth_id
LEFT JOIN education_master em
ON em.edu_id = uq.qualification
LEFT JOIN location_master l
ON l.loc_id = u.`current_location`
LEFT JOIN functional_area fa
ON fa.fun_id = u.`function_area`
LEFT JOIN industry_master ind
ON ind.indus_id = u.`industry`
LEFT JOIN address_master am
ON am.`auth_id` = u.`auth_id`
LEFT JOIN user_project up
ON up.`auth_id` = u.`auth_id`
WHERE u.auth_id = $auth_id";
        $query = $this->db->query($data);
        return $query->row_array();
    }

    public function resume_search_view($location, $skill) {
        $data = "SELECT * FROM user u
LEFT JOIN `location_master` lm
ON lm.`loc_id` = u.`current_location`
WHERE u.`current_location` = '$location' AND u.`key_skill` LIKE '%$skill%'";

        $query = $this->db->query($data);

        return $query->result();
    }

    public function type($skill) {
        $data = "SELECT * FROM industry_master
WHERE industry LIKE '$skill%'";

        $query = $this->db->query($data);

        return $query->result();
    }

    public function filter($conditions) {
        $query = "SELECT *, (lm.`location`)AS loc FROM jobs j
LEFT JOIN `location_master` lm
ON lm.`loc_id` = j.`location`
LEFT JOIN `industry_master` im
ON im.`indus_id` = j.`industry`
LEFT JOIN `emp_profile` ep
ON ep.`auth_id` = j.`auth_id`";

        if (!empty($conditions)) {
            $query .= ' WHERE ' . join(' AND ', $conditions);
        }
        $query = $this->db->query($query);

        return $query->result();
    }

    public function job_apply_message($id) {
        $data = "SELECT * FROM jobs j
WHERE j.`job_id` = $id and j.status = 0";

        $query = $this->db->query($data);

        return $query->row_array();
    }

    public function visitor_detail($id) {
        $data = "SELECT(pv.visited_at) AS visited_date, ep.`name`, im.`industry` FROM profile_visit pv
LEFT JOIN `emp_profile` ep
ON ep.`auth_id` = pv.visitor_id
LEFT JOIN `industry_master` im
ON im.`indus_id` = ep.`industry_type`
WHERE pv.jobseeker_id = $id";

        $query = $this->db->query($data);
        return $query->result();
    }

    public function trendingJob() {
        $sql = "SELECT DISTINCT(title) as title FROM jobs WHERE title !='' and status = 0 ORDER BY job_id DESC LIMIT 10 ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function jobsbyrole() {
        $sql = "SELECT DISTINCT(title) as title FROM jobs where status = 0 ORDER BY job_id DESC LIMIT 10 ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function companies() {
        $sql = "SELECT DISTINCT(name) as title FROM emp_profile WHERE name != '' ORDER BY emp_id DESC LIMIT 50 ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getSkills() {
        $sql = "SELECT DISTINCT(skill_name) as skill FROM skill_master where skill_name != '' UNION ALL SELECT DISTINCT(role) as skill FROM user where role != '' UNION ALL SELECT DISTINCT(name) as skill FROM emp_profile where name != '' ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

}
