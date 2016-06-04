<?php

class Verification_model extends CI_Model {

    function findByMobile($mobile) {
        $sql = "SELECT * FROM mobile_register WHERE mobile = '$mobile'  ";
        $query = $this->db->query($sql);
        return $query->row();
    }

}
