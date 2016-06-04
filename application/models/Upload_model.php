<?php
class Upload_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    public function add($id)
    {
        $data=array(
          'resume'=>$this->input->post('resume'),
            'auth_id'=>$id,
        );
        return $this->db->insert('resume',$data);
    }
}