<?php

class address_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function add_address($id) {
        $query = $this->db->get_where('address_master', array('auth_id' => $id));
        $field_array = array(
            'auth_id' => $id,
            'address1' => $this->input->post('address1'),
            'pincode' => $this->input->post('pincode'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'updated_at' => date('Y-m-d H:i:s'),
        );

        if ($query->num_rows() > 0) {
            $this->db->where('auth_id', $id);
            return $this->db->update('address_master', $field_array);
        } else {
            $field_array['created_at'] = date('Y-m-d H:i:s');
            return $this->db->insert('address_master', $field_array);
        }
    }
    public function add_address3($id,$field_array) {
        $query = $this->db->get_where('address_master', array('auth_id' => $id));
        

        if ($query->num_rows() > 0) {
            $this->db->where('auth_id', $id);
            return $this->db->update('address_master', $field_array);
        } else {
            $field_array['created_at'] = date('Y-m-d H:i:s');
            return $this->db->insert('address_master', $field_array);
        }
    }

    public function find_id($id) {
        $query = $this->db->get_where('address_master', array('auth_id' => $id));
        return $query->row_array();
    }
    public function add_address2($id,$data) {
        $query = $this->db->get_where('address_master', array('auth_id' => $id));
        

        if ($query->num_rows() > 0) {
            $this->db->where('auth_id', $id);
            return $this->db->update('address_master', $data);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            return $this->db->insert('address_master', $data);
        }
    }

}
