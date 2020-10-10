<?php
defined('BASEPATH') or exit('No direct script access allowed');
// session_start();
class Printf extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rencana_model', 'rencana');
        $this->load->model('Pesanan_model', 'pesanan');
        $this->load->model('Jalan_model', 'jalan');
        $this->load->model('Nota_model', 'nota');
        if($this->session->userdata("id") == null){
            redirect('Auth');
        }
    }

    public function nota($data){
        // var_dump($data);die;
        if(isset($_SESSION['id'])){
            $data['kepada1'] = $this->nota->getKepadaByID($data['data'][0]['kepada'])[0]['nama_pangkalan'];
            $data['kepada2'] = $this->nota->getKepadaByID($data['data'][1]['kepada'])[0]['nama_pangkalan'];
            $this->load->view("Print/notaP",$data);
        }else{
            echo "gagal";
        }
    }

    public function rencana($data){
        if(isset($_SESSION['id'])){
            $this->load->view("Print/rencanaP",$data);
        }else{
            echo "gagal";
        }
    }

    public function pesanan($data){
        if(isset($_SESSION['id'])){
            $this->load->view("Print/pesananP",$data);
        }else{
            echo "gagal";
        }
    }

    public function jalan($data){
        if(isset($_SESSION['id'])){
            $this->load->view("Print/jalanP",$data);
        }else{
            echo "gagal";
        }
    }



    public function printAll(){
        $print = $this->session->userdata('print');
        $count = 0;
        $marGen = 6;
        $marGan = 5;
        $nota = [];
        arsort($print);
        
        if(isset($print)){
            $ps = 1;
            foreach($print as $n => $val){
                $x = explode("-", $val);
                if($x[0] == "nt"){
                    $nota[$count] = $this->nota->getNotaByID($val)[0];
                    $count++;
                    // $this->nota($data);
                }elseif($x[0] == "rc"){
                    $data['data'] = $this->rencana->getRencanaByID($val);
                    $this->rencana($data);
                }elseif($x[0] == "jl"){
                    $data['data'] = $this->jalan->getJalanByID($val)[0];
                    $data['nopol'] =  $this->jalan->getNomorPolisiByID($data['data']['id_nomor_polisi'])[0];
                    $this->jalan($data);
                }elseif($x[0] == "ps"){
                    $data['data'] = $this->pesanan->getPesananByID($val)[0];
                    $data['harga_faktur'] = $this->pesanan->getHargaFaktur();
                    $data['pad'] = 0.5;
                    if($ps % 2 != 0 && $ps != 1){
                        $data['pad'] = 5;
                    }
                    $this->pesanan($data);
                    $ps++;
                }
            }
        }

        if($count > 1){
            $even = false;
            if($count%2 == 0){
                $even = true;
            }
            if($even){
                for($i=0;$i<$count;$i+=2){
                    $data['data'][0] = $nota[$i];
                    $data['data'][1] = $nota[$i+1];
                    $data['count'] = 'even';
                    $data['margin'] = null;
                    if($i+2 == $marGen){
                        $data['margin'] = 5;
                        $marGen += 4;
                    }
                    $this->nota($data);
                }
            }elseif($count == 3){
                $data['data'][0] = $nota[0];
                $data['data'][1] = $nota[1];
                $data['count'] = 'tiga';
                $data['margin'] = null;
                $this->nota($data);
                $data['data'][0] = $nota[2];
                $this->nota($data);
            }else{
                for($i=0;$i<$count-1;$i+=2){
                    $data['data'][0] = $nota[$i];
                    $data['data'][1] = $nota[$i+1];
                    $data['margin'] = null;
                    if($i+1 == $marGan){
                        $data['margin'] = 5;
                        $marGan += 4;
                    }
                    // var_dump($i+2);
                    $this->nota($data);
                }
                if($count == $marGan){
                    $data['margin'] = 5;
                }else{
                    $data['margin'] = null;
                }
                $data['count'] = 'banyak';
                $data['data'][0] = $nota[$count-1];
                $this->nota($data);
            }
        }elseif($count == 1){
            $data['data'][0] = $nota[0];
            $data['data'][1] = $nota[0];
            $data['count'] = 'satu';
            $data['margin'] = null;
            $this->nota($data);
        }else{
            // echo "Error print";
        }
    }
}