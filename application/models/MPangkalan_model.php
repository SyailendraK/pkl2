<?php
defined('BASEPATH') or exit('No direct script access 0lowed');
//deskripsi : pengaksesan setiap data lewat query untuk h0aman pangkalan

class MPangkalan_model extends CI_Model{
    public function getPangkalan(){
        return array_reverse($this->db->get('pangkalan', 10)->result_array());
    }

    public function getJumlahData(){
        return $this->db->get('pangkalan')->num_rows();
    }

    public function getPangkalanPage($number,$offset){
        return array_reverse($this->db->get('pangkalan', $number,$offset)->result_array());
    }

    public function tambahPangkalan($data){
        return $this->db->insert('pangkalan', $data);
    }

    public function updatePangkalan($data){
        $this->db->where('id', $data['id']);
        return $this->db->update('pangkalan', $data);
    }

    public function hapusPangkalan($id){
        return $this->db->delete('pangkalan', ['id' => $id]);
    }

    public function getPangkalanById($id){
        return $this->db->get_where('pangkalan', ['id' => $id])->result_array();
    }

    public function getJumlahDataPangkalan($key){
        $this->db->like('nama_pangkalan', $key);
        $this->db->from('pangkalan');
        return $this->db->count_all_results();
    }

    public function getAkunByPangkalan($key,$number,$offset){
        $this->db->limit($number,$offset);
        $this->db->order_by('nama_pangkalan');
        $this->db->like('nama_pangkalan',$key);
        $this->db->from('pangkalan');
        return $this->db->get()->result_array();
    }
}