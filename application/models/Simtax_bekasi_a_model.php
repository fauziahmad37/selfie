<?php
include_once('Main_model_simtax.php');
class Simtax_bekasi_a_model extends Main_model_simtax{
	function __construct() {
		parent::__construct();
		$this->db_name = 'simtax_bekasi_a';
	}
	
	function data($date = ''){		
		return $this->data_data($date);
	}
	
	function revenue($date = ''){	
		return $this->revenues($date);
	}
	
	function datas($start, $end){
		return $this->data_set($start, $end);
	}
	
	function dataSetoran($start, $end){
		return $this->data_setoran($start, $end);
	}
        
        function dataKoreksi($start, $end){
		return $this->data_koreksi($start, $end);
	}
}

?>