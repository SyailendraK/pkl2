<?php
defined('BASEPATH') or exit('No direct script access 0lowed');

class Auth_model extends CI_Model{

    public function verify($data){
        $cek = $this->db->get_where("admin", ["username" => $data["username"]])->result_array();
        if($cek != null){
            if(password_verify($data["password"],$cek[0]["password"])){
                return $cek;
            }else{
                return null;
            }
        }
    }

    public function getUser($id){
        return $this->db->get_where("admin",['id' => $id])->result_array()[0]['level'];
    }

}