<?php
defined('BASEPATH') or exit('No direct script access 0lowed');
//deskripsi : pengaksesan setiap data lewat query untuk h0aman admin

class Rencana_model extends CI_Model{

    public function submit($data){
        $ary_print;
        $ary1 = $data['id_pangkalan'];
        $id = "pm-".random_string("alnum",10);
        for($i=1;$i <= sizeof($ary1);$i++){
            $temp = [
                'id' => "pp-".random_string("alnum",10),
                'id_multi' => $id,
                'id_pangkalan' => $ary1[$i]['id_pangkalan'],
                'jumlah' => $ary1[$i]['jumlah'],
                'nomor_faktur' => $ary1[$i]['nomor_faktur']
            ];
            $ary_print[$i] = $temp;
        }
        // die;
        $boll = $this->db->insert_batch('print_pangkalan', $ary_print);

        $ary = [
            "id" => $data['id'],
            "loading_order" => $data['lo'],
            "id_no_polisi" => $data['id_nomor_polisi'],
            "id_print_pangkalan" => $id,
            "pt" => $data['agen'],
            "tanggal" => $data['tanggal'],
            "date_created" => time()
        ];
        // var_dump($ary);die;
        if($boll){
            return $this->db->insert("rencana", $ary);
        }else{
            return null;
        }
    }

    public function getJumlahData(){
        return $this->db->get('rencana')->num_rows();
    }

    public function getJumlahDataSearch($key){
        return $this->db->get_where('rencana',['tanggal' => $key])->num_rows();
    }

    public function getRencanaPage($number,$offset){
        $result = null;
        $pangkalan;
        $i=0;
        $j=0;
        $print_pangkalan;
        $this->db->order_by('date_created', 'DESC');
        $rencana = $this->db->get('rencana',$number,$offset)->result_array();

        if($rencana != null){
            foreach($rencana as $r => $val){ //1
                $print_pangkalan = $this->db->get_where('print_pangkalan',['id_multi' => $val['id_print_pangkalan']])->result_array();//2
                if($print_pangkalan != null){
                    foreach($print_pangkalan as $pp => $val2){
                        $pangkalan[$i] =  $this->db->get_where('pangkalan',['id' => $val2['id_pangkalan']])->result_array()[0];
                        $i++;
                    }//2
                    if($pangkalan != null){
                        $result[$j] = ['id' => $rencana[$j]['id'],'agen' => $rencana[$j]['pt'],'nama_pangkalan' => $pangkalan, 'tanggal' => $rencana[$j]['tanggal']];
                        $j++;
                        $print_pangkalan = null;
                        $pangkalan = null;
                    }

                }
            }
        }
        return $result;
    }

    public function getRencanaPageSearch($number,$offset,$key){
        $result = null;
        $pangkalan;
        $i=0;
        $j=0;
        $print_pangkalan;
        $this->db->order_by('date_created', 'DESC');
        $rencana = $this->db->get_where('rencana',['tanggal' => $key],$number,$offset)->result_array();

        if($rencana != null){
            foreach($rencana as $r => $val){ //1
                $print_pangkalan = $this->db->get_where('print_pangkalan',['id_multi' => $val['id_print_pangkalan']])->result_array();//2
                if($print_pangkalan != null){
                    foreach($print_pangkalan as $pp => $val2){
                        $pangkalan[$i] =  $this->db->get_where('pangkalan',['id' => $val2['id_pangkalan']])->result_array()[0];
                        $i++;
                    }//2
                    if($pangkalan != null){
                        $result[$j] = ['id' => $rencana[$j]['id'],'agen' => $rencana[$j]['pt'],'nama_pangkalan' => $pangkalan, 'tanggal' => $rencana[$j]['tanggal']];
                        $j++;
                        $print_pangkalan = null;
                        $pangkalan = null;
                    }

                }
            }
        }
        return $result;
    }

    public function getRencana(){
        $result = null;
        $pangkalan;
        $i=0;
        $j=0;
        $print_pangkalan;
        $this->db->order_by('date_created', 'DESC');
        $rencana = $this->db->get('rencana',10)->result_array();

        if($rencana != null){
            foreach($rencana as $r => $val){ //1
                $print_pangkalan = $this->db->get_where('print_pangkalan',['id_multi' => $val['id_print_pangkalan']])->result_array();//2
                if($print_pangkalan != null){
                    foreach($print_pangkalan as $pp => $val2){
                        $pangkalan[$i] =  $this->db->get_where('pangkalan',['id' => $val2['id_pangkalan']])->result_array()[0];
                        $i++;
                    }//2
                    if($pangkalan != null){
                        $result[$j] = ['id' => $rencana[$j]['id'],'agen' => $rencana[$j]['pt'],'nama_pangkalan' => $pangkalan, 'tanggal' => $rencana[$j]['tanggal']];
                        $j++;
                        $print_pangkalan = null;
                        $pangkalan = null;
                    }
                }
            }
        }
        return $result;
    }

    public function getRencanaByID($id){
        // $this->db->from('rencana');
        $result;
        $p;
        $this->db->join('pengirim','pengirim.id = rencana.id_no_polisi');
        $this->db->order_by('date_created', 'DESC');
        $result[0] = $this->db->get_where("rencana",  ['rencana.id' => $id])->result_array()[0];
        // $this->db->join('pangkalan','pangkalan.id = print_pangkalan.id_pangkalan');
        $temp = $this->db->get_where('print_pangkalan', ['id_multi' => $result[0]['id_print_pangkalan']])->result_array();
        $k=0;
        foreach($temp as $v => $val){
            // $this->db->get_where('rencana','rencana.id_print_pangkalan = print_pangkalan.id_multi');

            $p[$k] = $this->db->get_where('pangkalan',['pangkalan.id' => $val['id_pangkalan']])->result_array()[0];
            // array_push($p[$k],$result[0]['jumlah_tabung']);
            $p[$k]['jumlah']= $val['jumlah'];
            $p[$k]['nomor_faktur']= $val['nomor_faktur'];
            $k++;
        }
        $result[1] = $p;
        // var_dump($result);die;

        return $result;
    }
    
    public function getPangkalan(){
        $this->db->order_by('nama_pangkalan', 'ASC');
        return $this->db->get("pangkalan")->result_array();
    }

    public function getNomorPolisi(){
        $this->db->order_by('nomor_polisi', 'ASC');
        return $this->db->get("pengirim")->result_array();
    }

    public function getAlamatPangkalan($id){
        return $this->db->get_where("pangkalan", ['nama_pangkalan' => $id])->result_array();
    }

    public function deleteRencana($id){
        unset($_SESSION['print'][$id]);
        $temp = $this->db->get_where('rencana',['id' => $id])->result_array();
        if($this->db->delete('print_pangkalan',['id_multi' => $temp[0]['id_print_pangkalan']])){
            return $this->db->delete("rencana",['id' => $id]);
        }
    }

    public function getListPrint(){
        $ary = [];
        $result = [];
        $temp = $this->session->userdata('print');
        if($temp != null){
            foreach ($temp as $n){
                $result[$n] = $this->db->get_where("rencana",["id" => $n])->result_array();
            }
        }
        return $result;
    }

    public function getUpdate($id){
        return $this->db->get_where('rencana',['id' => $id])->result_array()[0];
    }
    public function getSelected($id){
        return $this->db->get_where('print_pangkalan',['id_multi' => $id])->result_array();
    }
}