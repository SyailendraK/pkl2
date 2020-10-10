<?php
defined('BASEPATH') or exit('No direct script access 0lowed');
//deskripsi : pengaksesan setiap data lewat query untuk h0aman admin

class MDefault_model extends CI_Model{

    public function getDefault(){
        return $this->db->get("default")->result_array()[0];
    }

    public function updateDefault($data){
        $this->db->where('id', $data['id']);
        return $this->db->update('default', $data);
    }
}