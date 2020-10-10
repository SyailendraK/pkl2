<?php
defined('BASEPATH') or exit('No direct script access 0lowed');
//deskripsi : pengaksesan setiap data lewat query untuk h0aman admin

class MAkun_model extends CI_Model{
    public function getAkun(){
        return array_reverse($this->db->get('admin', 10)->result_array());
    }

    public function getJumlahData(){
        return $this->db->get('admin')->num_rows();
    }

    public function getAkunPage($number,$offset){
        $this->db->order_by('username');
        return $this->db->get('admin', $number,$offset)->result_array();
    }

    public function tambahAkun($data){
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->db->insert('admin', $data);
    }

    public function updateAkun($data){
        $this->db->where('id', $data['id']);
        return $this->db->update('admin', $data);
    }

    public function hapusAkun($id){
        return $this->db->delete('admin', ['id' => $id]);
    }

    public function getJumlahDataUsername($key){
        $this->db->like('username', $key);
        $this->db->from('admin');
        return $this->db->count_all_results();
    }

    public function getAkunByUsername($key,$number,$offset){
        $this->db->limit($number,$offset);
        $this->db->order_by('username');
        $this->db->like('username',$key);
        $this->db->from('admin');
        return $this->db->get()->result_array();
    }

    public function getAkunById($id){
        return $this->db->get_where('admin',['id' => $id])->result_array();
    }

    public function unique($key,$id){
        $cek = $this->db->get_where('admin',['username' => $key])->result_array()[0];
        if($cek != null){
            if($cek['id'] == $id){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }
}