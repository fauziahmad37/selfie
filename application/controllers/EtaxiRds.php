<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('api/Api.php');
ini_set('max_execution_time', 600); 
ini_set('memory_limit','2048M');

include_once('Admin.php');
class EtaxiRds extends Api {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');	
	}
	
	function runEtaxi()
		{ 
			$this->load->model('etaxi_rds_model');
			$dataSpj = $this->etaxi_rds_model->getDataSpj();
					
			foreach($dataSpj as $row)
			{
				$this->etaxi_rds_model->loginRds($row['doc_number'],$row['kip_number'],$row['door_number']);
			}
		}
		
		function logoutRds()
		{ 
			$this->load->model('etaxi_rds_model');
			$dataSetoran = $this->etaxi_rds_model->getDataSetoran();
					
			foreach($dataSetoran as $row)
			{
				$this->etaxi_rds_model->logoutRds($row['doc_number'],$row['kip_number'],$row['door_number']);
			}
		}
		
			
			
		

	
	
	
}
