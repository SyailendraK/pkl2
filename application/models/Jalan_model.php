<?php
defined('BASEPATH') or exit('No direct script access 0lowed');
//deskripsi : pengaksesan setiap data lewat query untuk h0aman admin

class Jalan_model extends CI_Model{

    public function submit($data){
        $ary = [
            "id" => $data['id'],
            "kepada" => $data['kepada'],
            "jumlah" => $data['jumlah'],
            "nama_barang" => $data['nama'],
            "keterangan" => $data['keterangan'],
            "tanggal" => $data['tanggal'],
            "date_created" => time(),
            "pt" => $data['pt'],
            "nomor_jalan" => $data['nomor_jalan'],
            "id_nomor_polisi" => $data['nomor_polisi']
            // "penerima" => $data['penerima']
        ];
        // var_dump($ary);die;
        return $this->db->insert("jalan", $ary);
    }

    public function getPangkalan(){
        $this->db->order_by('nama_pangkalan', 'ASC');
        return $this->db->get("pangkalan")->result_array();
    }

    public function getPangkalanById($id){
        return $this->db->get_where("pangkalan",['id' => $id])->result_array()[0]['nama_pangkalan'];
    }

    public function getKeterangan(){
        return $this->db->get("default")->result_array()[0];
    }

    public function getJumlahData(){
        return $this->db->get('jalan')->num_rows();
    }

    public function getJumlahDataSearch($key){
        return $this->db->get_where('jalan',['tanggal' => $key])->num_rows();
    }

    public function getJalanPage($number,$offset){
        $this->db->order_by('date_created', 'DESC');
        $data = $this->db->get("jalan", $number,$offset)->result_array();
        for ($i=0; $i < sizeof($data); $i++) { 
            $data[$i]['kepada2'] = $this->db->get_where("pangkalan",['id' => $data[$i]['kepada']])->result_array()[0]['nama_pangkalan'];
        }
        return $data;
    }

    public function getJalanPageSearch($number,$offset,$key){
        $this->db->order_by('date_created', 'DESC');
        $data = $this->db->get_where("jalan",['tanggal' => $key],$number,$offset)->result_array();
        for ($i=0; $i < sizeof($data); $i++) { 
            $data[$i]['kepada2'] = $this->db->get_where("pangkalan",['id' => $data[$i]['kepada']])->result_array()[0]['nama_pangkalan'];
        }
        return $data;
    }

    public function getJalan(){
        $this->db->order_by('date_created', 'DESC');
        $data = $this->db->get("jalan", 10)->result_array();
        for ($i=0; $i < sizeof($data); $i++) { 
            $data[$i]['kepada2'] = $this->db->get_where("pangkalan",['id' => $data[$i]['kepada']])->result_array()[0]['nama_pangkalan'];
        }
        return $data;
    }

    public function getJalanByID($id){
        $data = $this->db->get_where("jalan", ['id' => $id])->result_array();
        $data[0]['kepada2'] = $data[0]['kepada'];
        // var_dump($this->db->get_where("pangkalan",['id' => $data[0]['kepada']])->result_array());die;
        $data[0]['kepada'] = $this->db->get_where("pangkalan",['id' => $data[0]['kepada']])->result_array()[0]['nama_pangkalan'];
        return $data;
    }

    public function updateJalan($data){
        $this->db->where('id', $data['id']);
        return $this->db->update('jalan', $data);
    }
    
    public function deleteJalan($id){
        unset($_SESSION['print'][$id]);
        return $this->db->delete("jalan",['id' => $id]);
    }

    public function getNomorPolisi(){
        $this->db->order_by('nomor_polisi', 'ASC');
        return $this->db->get("pengirim")->result_array();
    }

    public function getNomorPolisiByID($id){
        return $this->db->get_where('pengirim',['id' => $id])->result_array();
    }

    public function getPengemudi($id){
        return $this->db->get_where("pengirim", ['nomor_polisi' => $id])->result_array();
    }

    public function getListPrint(){
        $ary = [];
        $result = [];
        $temp = $this->session->userdata('print');
        if($temp != null){
            foreach ($temp as $n){
                $result[$n] = $this->db->get_where("jalan",["id" => $n])->result_array();
            }
        }
        return $result;
    }
}