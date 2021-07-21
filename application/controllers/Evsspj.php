<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('api/Api.php');
ini_set('max_execution_time', 600); 
ini_set('memory_limit','2048M');

include_once('Admin.php');
class Evsspj extends Api {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');	
	}
	
	function runRental(){ 
		$this->load->model('evsspj_model');
		$dataSpj = $this->evsspj_model->getDataSpjRental();
		
		$this->evsspj_model->deleteTaxiRegister();
		
		foreach($dataSpj as $row){
			$this->evsspj_model->insertTaxiDriver($row['kip_number'],$row['name']);
		}
		
		foreach($dataSpj as $row){
			$this->evsspj_model->insertTaxiImeiLogin(str_replace(' ','',$row['no_pintu']),$row['doc_number'],$row['kip_number'],$row['created']);
		}
		
		$dataSetoran = $this->evsspj_model->getDataSetoranRental();
		
		foreach ($dataSetoran as $row){
			$this->evsspj_model->updateTaxiImeiLogin(str_replace(' ','',$row['no_pintu']),$row['doc_number'],$row['kip_number'],$row['created']);	
		}
		
		//echo "sukses";die;
	}
	
	function runEtaxi()
		{ 
			$this->load->model('evsspj_model');
			$dataSpj = $this->evsspj_model->getDataSpj();
			
			//insert taxi register
			/*
			foreach($dataSpj as $row)
			{
			$this->evsspj_model->insertTaxiRegister(str_replace(' ','',$row['door_number']));
			}
			*/
			
			//delete taxi register yang double
			$this->evsspj_model->deleteTaxiRegister();
			
			//insert taxi driver
			
			foreach($dataSpj as $row)
			{
				$this->evsspj_model->insertTaxiDriver($row['kip_number'],$row['name']);
			}
			
			
			//insert taxi imei
			foreach($dataSpj as $row)
			{
				$this->evsspj_model->insertTaxiImeiLogin(str_replace(' ','',$row['door_number']),$row['doc_number'],$row['kip_number'],$row['created']);
			}
			
			$dataSetoran = $this->evsspj_model->getDataSetoran();
			//var_dump($dataSetoran);
			foreach ($dataSetoran as $row)
			{
			$this->evsspj_model->updateTaxiImeiLogin(str_replace(' ','',$row['door_number']),$row['doc_number'],$row['kip_number'],$row['modified']);	
			}
			//return $this->_print('SUCCESS!');
		}


	function runDice()
		{ 
			$this->load->model('evsspj_model');
			$dataSpj = $this->evsspj_model->getDataSpjDice();
			
			/*
			foreach($dataSpj as $row)
			{
			$this->evsspj_model->insertTaxiRegisterDice(str_replace(' ','',$row['nomor_pintu']));
			}
			*/
			
			//delete taxi register yang double
			$this->evsspj_model->deleteTaxiRegister();
			
			foreach($dataSpj as $row)
			{
				$this->evsspj_model->insertTaxiDriver($row['no_kip'],$row['nama']);
			}
			
			foreach($dataSpj as $row)
			{
				$this->evsspj_model->insertTaxiImeiLogin(str_replace(' ','',$row['nomor_pintu']),$row['nomor_spj'],$row['no_kip'],$row['jam_mulai_spj']);
			}
			
			$dataSetoran = $this->evsspj_model->getDataSetoranDice();
			//var_dump($dataSetoran);
			foreach ($dataSetoran as $row)
			{
			$this->evsspj_model->updateTaxiImeiLogin(str_replace(' ','',$row['nomor_pintu']),$row['nomor_spj'],$row['no_kip'],$row['jam_selesai_spj']);	
			}
			//return $this->_print('SUCCESS!');
		}
		
		function runDiceTiara()
		{ 
			$this->load->model('evsspj_model');
			$dataSpj = $this->evsspj_model->getDataSpjDiceTiara();
			/*
			foreach($dataSpj as $row)
			{		
			$this->evsspj_model->insertTaxiRegisterDiceTiara(str_replace(' ','',$row['nomor_pintu']));
			}
			*/
			$this->evsspj_model->deleteTaxiRegister();
			
			foreach($dataSpj as $row)
			{
			$this->evsspj_model->insertTaxiDriver($row['no_kip'],$row['nama']);
			}
			
			foreach($dataSpj as $row)
			{	
			$this->evsspj_model->insertTaxiImeiLogin(str_replace(' ','',$row['nomor_pintu']),$row['nomor_spj'],$row['no_kip'],$row['jam_mulai_spj']);
			}
			
			
			$dataSetoran = $this->evsspj_model->getDataSetoranDiceTiara();
			//var_dump($dataSetoran);
			foreach ($dataSetoran as $row)
			{
			$this->evsspj_model->updateTaxiImeiLogin(str_replace(' ','',$row['nomor_pintu']),$row['nomor_spj'],$row['no_kip'],$row['jam_selesai_spj']);	
			//echo $row['nomor_pintu'];
			}
			//return $this->_print('SUCCESS!');
		}
	
	
}
