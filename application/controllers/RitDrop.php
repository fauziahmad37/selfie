<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('max_execution_time', 600); 
ini_set('memory_limit','2048M');
include_once('Admin.php');
class RitDrop extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('Checker_model');	
	}
	
	
	
	public function index($date = '', $date1 = '')
	{
		
		$username = $this->user['username'];
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d',strtotime("-1 days"))))
			$date = date('Y-m-d',strtotime("days"));
		
		
		if ($date == ''){ 
			$dataCt = $this->Checker_model->getDataActivityChecker($date);
		}
		else {
	
		$dataCt = $this->Checker_model->getDataActivityChecker1($date,$date1);
		}
		
				
		
				
		
		$this->load->view('header');
		$this->load->view('ritdrop', Array('data' => $data, 'date' => $date, 'dataCt' => $dataCt, 'username' => $username, 'date1' => $date1));
		$this->load->view('footer');
	}
        
       
    public function download1($date = '', $date1 = '')
	{
		$username = $this->user['username'];
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d',strtotime("days"))))
			$date = date('Y-m-d',strtotime("days"));
		
		if($date1 === '' || strtotime($date1) > strtotime(date('Y-m-d',strtotime("days"))))
			$date1 = date('Y-m-d',strtotime("days"));
		

		if(!$check){

			$check = date('j F Y H:i:s');
		} else {
			$datetime = new DateTime($check);
			$check = date('j F Y H:i:s', strtotime($check));
		}
		$dataCt = $this->Checker_model->getDataActivityChecker($date, $date1);
		
	}    
      function download($date,$date1 ){
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "Detail Rit Drop.csv";
        $query = "select ID as ID, 
		tgl_spj as Tanggal_SPJ, 
		no_pintu as No_Pintu, 
		val_rit as Nilai_Ritase, 
		val_drop as Nilai_drop, 
		val_km_argo as KM_Argo, 
		val_km_speedo as KM_Speedo, 
		val_fix_part as Bagian_Yang_Perlu_Diperbaiki, 
		user_insert as ID_Checker, 
		dt_insert as Tanggal_input
		from dashboard.public.moce_regular where tgl_spj >= '".$date."' and tgl_spj <= '".$date1."'"; //USE HERE YOUR QUERY
        $result = $this->db->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);

    }      
        
        
	
	
}
