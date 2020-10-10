<?php
// session_start();
class Jalan extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jalan_model', 'jalan');
        index();
    }
    public function index(){
        $data = $this->jalan->getPengemudi($this->input->post('id'));
        echo '<label for="kepada">Pengemudi :</label>
        <input type="text" class="form-control" id="pengemudi" placeholder="*Pengemudi"
            name="pengemudi">';
    }

}