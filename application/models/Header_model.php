<?php
defined('BASEPATH') or exit('No direct script access 0lowed');
//deskripsi : pengaksesan setiap data lewat query untuk h0aman admin

class Header_model extends CI_Model{
    
    public function getListPrint(){
            $ary = [];
            $result = [];
            $temp = $this->session->userdata('print');
            if($temp != null){
                foreach ($temp as $n){
                    $x = explode("-",$n);
                    if($x[0] == "nt"){
                        $result[$n] = $this->db->get_where("nota",["id" => $n])->result_array();
                    }elseif ($x[0] == "rc"){
                        $result[$n] = $this->db->get_where("rencana",["id" => $n])->result_array();
                    }elseif ($x[0] == "jl"){
                        $result[$n] = $this->db->get_where("jalan",["id" => $n])->result_array();
                    }elseif ($x[0] == "ps"){
                        $result[$n] = $this->db->get_where("pesanan2",["id" => $n])->result_array();
                    }
                }
            }
            return $result;
        }

    public function search($data,$type){
        if($type == "Nota"){
            return $this->db->get_where('nota',['tanggal' => $data])->result_array();
        }else if($type = "Rencana"){
            return $this->db->get_where('rencana',['tanggal' => $data])->result_array();
        }else if($type = "Pesanan"){
            return $this->db->get_where('pesanan',['tanggal' => $data])->result_array();
        }else if($type = "Jalan"){
            return $this->db->get_where('jalan',['tanggal' => $data])->result_array();
        }else{
            return false;
        }
    }

    public function profile($id){
        return $this->db->get_where('admin', ['id' => $id])->result_array()[0];
    }

    public function validate($id,$pass,$username){
        $passL = $this->db->get_where('admin', ['id' => $id])->result_array()[0]['password'];
        $unique = $this->db->get_where('admin', ['username' => $username])->result_array()[0]['id'];
        if(password_verify($pass,$passL) && $unique == $id){
            return true;
        }else{
            return false;
        }
    }

    public function updateProfile($data){
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->db->where('id', $data['id']);
        return $this->db->update('admin', $data);
    }
}