<?php 

function tgl($tgl){
	$bulan = explode("-",$tgl); 
	if($bulan[1] == '01'){
		$bulan[1] = "Januari";
	}elseif ($bulan[1] == '02'){
		$bulan[1] = "Februari";
	}elseif ($bulan[1] == '03'){
		$bulan[1] = "Maret";
	}elseif ($bulan[1] == '04'){
		$bulan[1] = "April";
	}elseif ($bulan[1] == '05'){
		$bulan[1] = "Mei";
	}elseif ($bulan[1] == '06'){
		$bulan[1] = "Juni";
	}elseif ($bulan[1] == '07'){
		$bulan[1] = "Juli";
	}elseif ($bulan[1] == '08'){
		$bulan[1] = "Agustus";
	}elseif ($bulan[1] == '09'){
		$bulan[1] = "September";
	}elseif ($bulan[1] == '10'){
		$bulan[1] = "Oktober";
	}elseif ($bulan[1] == '11'){
		$bulan[1] = "November";
	}elseif ($bulan[1] == '12'){
		$bulan[1] = "Desember";
	}
	return $bulan[2]."-".$bulan[1]."-".$bulan[0];
}

function tglNumber($tgl){
	$bulan = explode("-",$tgl); 
	return $bulan[2]."-".$bulan[1]."-".$bulan[0];
}

?>