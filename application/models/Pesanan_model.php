<?php
defined('BASEPATH') or exit('No direct script access 0lowed');
//deskripsi : pengaksesan setiap data lewat query untuk h0aman admin

class Pesanan_model extends CI_Model{

    public function submit($data){
        $ary = [
            "id" => $data['id'],
            "nomor_pesanan" => $data['nomor_pesanan'],
            "trip" => $data['trip'],
            "nomor_do" => $data['nomor_do'],
            "nomor_sa" => $data['nomor_sa'],
            "tanggal" => $data['tanggal'],
            "pt" => $data['pt'],
            "date_created" => time()
        ];
        return $this->db->insert("pesanan2", $ary);
    }

    public function getPesananByID($id){
        return $this->db->get_where("pesanan2", ['id' => $id])->result_array();
    }

    public function getHargaFaktur(){
        return $this->db->get("default")->result_array()[0];
    }

    public function getJumlahData(){
        return $this->db->get('pesanan2')->num_rows();
    }

    public function getJumlahDataSearch($key){
        return $this->db->get_where('pesanan2',['tanggal' => $key])->num_rows();
    }

    public function getPesananPage($number,$offset){
        $this->db->order_by('date_created', 'DESC');
        return $this->db->get("pesanan2",$number,$offset)->result_array();
    }

    public function getPesananPageSearch($number,$offset,$key){
        $this->db->order_by('date_created', 'DESC');
        return $this->db->get_where("pesanan2",['tanggal' => $key],$number,$offset)->result_array();
    }

    public function getPesanan(){
        $this->db->order_by('date_created', 'DESC');
        return $this->db->get("pesanan2", 10)->result_array();
    }
    
    public function deletePesanan($id){
        unset($_SESSION['print'][$id]);
        return $this->db->delete("pesanan2",['id' => $id]);
    }

    public function update($data){
        $this->db->where('id', $data['id']);
        return $this->db->update('pesanan2', $data);
    }

    public function getListPrint(){
        $result = [];
        $temp = $this->session->userdata('print');
        if($temp != null){
            foreach ($temp as $n){
                $result[$n] = $this->db->get_where("pesanan2",["id" => $n])->result_array();
            }
        }
        return $result;
    }
}