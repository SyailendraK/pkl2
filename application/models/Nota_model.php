<?php
defined('BASEPATH') or exit('No direct script access 0lowed');
//deskripsi : pengaksesan setiap data lewat query untuk h0aman admin

class Nota_model extends CI_Model{

    public function submit($data){
        $ary = [
            "id" => $data['id'],
            "kepada" => $data['kepada'],
            "jumlah" => $data['jumlah'],
            "nama_barang" => $data['nama'],
            "harga" => $data['harga'],
            "tanggal" => $data['tanggal'],
            "date_created" => time(),
            "pt" => $data['pt'],
            "nomor_nota" => $data['nomor_nota']
        ];
        // var_dump($ary);die;
        return $this->db->insert("nota", $ary);
    }

    public function getPangkalan(){
        $this->db->order_by('nama_pangkalan', 'ASC');
        return $this->db->get("pangkalan")->result_array();
    }

    public function getHarga(){
        return $this->db->get("default")->result_array()[0];
    }

    public function getJumlahData(){
        return $this->db->get('nota')->num_rows();
    }

    public function getJumlahDataSearch($key){
        return $this->db->get_where('nota',['tanggal' => $key])->num_rows();
    }

    public function getNotaPage($number,$offset){
        $this->db->order_by('date_created', 'DESC');
        $data = $this->db->get('nota',$number,$offset)->result_array();
        for ($i=0; $i < sizeof($data); $i++) { 
            $data[$i]['kepada2'] = $this->db->get_where("pangkalan",['id' => $data[$i]['kepada']])->result_array()[0]['nama_pangkalan'];
        }
        return $data;
    }

    public function getNotaPageSearch($number,$offset,$key){
        $this->db->order_by('date_created', 'DESC');
        $data = $this->db->get_where('nota',['tanggal' => $key],$number,$offset)->result_array();
        for ($i=0; $i < sizeof($data); $i++) { 
            $data[$i]['kepada2'] = $this->db->get_where("pangkalan",['id' => $data[$i]['kepada']])->result_array()[0]['nama_pangkalan'];
        }
        return $data;
    }

    public function getKepadaByID($id){
        return $this->db->get_where("pangkalan", ["id" => $id])->result_array();
    }

    public function getNota(){
        $this->db->order_by('date_created', 'DESC');
        return $this->db->get("nota", 10)->result_array();
    }

    public function getNotaByID($id){
        return $this->db->get_where("nota", ['id' => $id])->result_array();
    }

    public function update($data){
        $this->db->where('id', $data['id']);
        return $this->db->update('nota', $data);
    }

    public function deleteNota($id){
        unset($_SESSION['print'][$id]);
        return $this->db->delete("nota",['id' => $id]);
    }

    public function getListPrint(){
        $ary = [];
        $result = [];
        $temp = $this->session->userdata('print');
        if($temp != null){
            foreach ($temp as $n){
                $result[$n] = $this->db->get_where("nota",["id" => $n])->result_array();
            }
        }
        return $result;
    }
}