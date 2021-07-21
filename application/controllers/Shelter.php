<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Admin.php');
class Shelter extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');			
	}
	
	public function index($date = '')
	{
		$start = '';
		$start = isset($_GET['start']) ? $_GET['start'] : $start;
		$date = isset($_GET['end']) ? $_GET['end'] : $date;		

		if($date === '' || strtotime($date) > strtotime(date('Y-m-d')))
			$date = date('Y-m-d',strtotime("-1 days"));
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
	
		if(strtotime($start) > strtotime($date)){
			$temp = $start;
			$start = $date;
			$date = $start;
		}

		//CHECK LAST UPDATE
		$check = date('j F Y H:i:s', strtotime($this->dashboard_model->check_ritase_shelter($start, $date)[0]['last_update']));
		$arr = array();
		$arr['last_update'] = $check;
		$arr['shelter'] = array();
		$arr['tipe'] = array();	
		$arr['area'] = array();
		$arr['pool'] = array();						
		$arr['total_ritase'] = 0;
		$arr['total_argo'] = 0;
		$arrData = $this->dashboard_model->get_ritase_shelter($start, $date);
		$arr['series'] = $arrData['series'];		
		$arr['series_rds'] = $this->dashboard_model->get_monthly_series_shelter($date);		
		$arr['hourly_ritase'] = $this->dashboard_model->get_ritase_hour_shelter($start, $date);	
		$arrTipe = $this->dashboard_model->get_ritase_shelter_by_tipe($start, $date);
		$arrArea = $this->dashboard_model->get_ritase_shelter_by_area($start, $date);
		$arrPool = $this->dashboard_model->get_ritase_shelter_by_pool($start, $date);				
		foreach((Array) $arrData['data'] AS $key => $val){
			$a = array();
			$a['id'] = $val['id'];
			$a['name'] = $val['name'];
			$a['ritase'] = $val['ritase'];			
			$a['argo'] = $val['argo'];	
			$a['arpu'] = $val['argo'] / ($val['ritase'] > 0 ? $val['ritase'] : 1);	
			$a['ritase_mtd'] = $val['ritase_mtd'];
			$a['argo_mtd'] = $val['argo_mtd'];
			$a['arpu_mtd'] = $val['argo_mtd'] / ($val['ritase_mtd'] > 0 ? $val['ritase_mtd'] : 1);
			$a['ritase_ytd'] = $val['ritase_ytd'];
			$a['argo_ytd'] = $val['argo_ytd'];
			$a['arpu_ytd'] = $val['argo_ytd'] / ($val['ritase_ytd'] > 0 ? $val['ritase_ytd'] : 1);			
			$arr['total_ritase'] += $val['ritase'];		
			$arr['total_argo'] += $val['argo'];
			array_push($arr['shelter'], $a);	
		}
		
		foreach((Array) $arrTipe AS $key => $val){
			$a = array();
			$a['tipe'] = $val['tipe'];
			$a['ritase'] = $val['ritase'];			
			$a['argo'] = $val['argo'];	
			$a['arpu'] = $val['argo'] / ($val['ritase'] > 0 ? $val['ritase'] : 1);	
			$a['ritase_mtd'] = $val['ritase_mtd'];
			$a['argo_mtd'] = $val['argo_mtd'];
			$a['arpu_mtd'] = $val['argo_mtd'] / ($val['ritase_mtd'] > 0 ? $val['ritase_mtd'] : 1);
			$a['ritase_ytd'] = $val['ritase_ytd'];
			$a['argo_ytd'] = $val['argo_ytd'];
			$a['arpu_ytd'] = $val['argo_ytd'] / ($val['ritase_ytd'] > 0 ? $val['ritase_ytd'] : 1);			
			array_push($arr['tipe'], $a);	
		}
		
		$arr['area_a'] = $arr['area_b'] = array();
		
		foreach((Array) $arrArea AS $key => $val){
			$a = array();
			$a['area'] = $val['area'];
			$a['ritase'] = $val['ritase'];			
			$a['argo'] = $val['argo'];	
			$a['arpu'] = $val['argo'] / ($val['ritase'] > 0 ? $val['ritase'] : 1);	
			$a['ritase_mtd'] = $val['ritase_mtd'];
			$a['argo_mtd'] = $val['argo_mtd'];
			$a['arpu_mtd'] = $val['argo_mtd'] / ($val['ritase_mtd'] > 0 ? $val['ritase_mtd'] : 1);
			$a['ritase_ytd'] = $val['ritase_ytd'];
			$a['argo_ytd'] = $val['argo_ytd'];
			$a['arpu_ytd'] = $val['argo_ytd'] / ($val['ritase_ytd'] > 0 ? $val['ritase_ytd'] : 1);			
			array_push($arr['area'], $a);
			if($a['area'] == 2 || $a['area'] == 5 || $a['area'] == 6) {
				array_push($arr['area_a'], $a);
			} else if ($a['area'] == 1 || $a['area'] == 3 || $a['area'] == 4){
				array_push($arr['area_b'], $a);			
			}	
		}
		
		foreach((Array) $arrPool AS $key => $val){
			$a = array();
			$a['id_pool'] = $val['id'];
			$a['name'] = $val['name'];			
			$a['argo'] = $val['argo'];	
			$a['ct'] = $val['ct'];
			$a['unit'] = $val['unit'];
			$a['avg_argo'] = $val['argo'] / ($val['ct'] > 0 ? $val['ct'] : 1);
			$a['avg_ritase'] = $val['ct'] / ($val['unit'] > 0 ? $val['unit'] : 1);
			$a['avg_unit'] = $val['argo'] / ($val['unit'] > 0 ? $val['unit'] : 1);												
			array_push($arr['pool'], $a);	
		}
		
		$arr['unique_unit'] = $arrData['unit_unique'][0]['ct'];
		$arr['avg_ritase'] = $arr['total_ritase'] / (Count($arrData) > 0 ? Count($arrData) : 1);
		$arr['avg_argo'] = $arr['total_argo'] / (Count($arrData) > 0 ? Count($arrData) : 1);
		$arr['arpu_shelter'] = $arr['total_argo'] / ($arr['total_ritase'] > 0 ? $arr['total_ritase'] : 1);
		$arr['total_arit'] = $arr['total_ritase'] / ($arr['unique_unit'] > 0 ? $arr['unique_unit'] : 1);
		$arr['total_aapu'] = $arr['total_argo'] / ($arr['unique_unit'] > 0 ? $arr['unique_unit'] : 1);				
		$this->load->view('header');
		$this->load->view('shelter', Array('data' => $arr, 'start' => $start, 'date' => $date));
		$this->load->view('footer');	
	}
	
	public function detail(){
		if(isset($_GET['id']))
			$id = $_GET['id'];
		if(isset($_GET['date']))
			$date = $_GET['date'];
			
		$start = '';
		$start = isset($_GET['start']) ? $_GET['start'] : $start;
		$date = isset($_GET['end']) ? $_GET['end'] : $date;		

		if($date === '' || strtotime($date) > strtotime(date('Y-m-d')))
			$date = date('Y-m-d');
		if($start === '')
			$start = $date;
	
		if(strtotime($start) > strtotime($date)){
			$temp = $start;
			$start = $date;
			$date = $start;
		}
			
		$arrData = $this->dashboard_model->get_detail_shelter($id, $start, $date);
		$arr = array();	
		$check = date('j F Y H:i:s', strtotime($this->dashboard_model->check_ritase_shelter($start, $date)[0]['last_update']));
		$arr['shelter'] = $this->dashboard_model->get_shelter($id);
		$arr['last_update'] = $check;
		$arr['series'] = $arrData['series'];		
		$arr['series_rds'] = $this->dashboard_model->get_monthly_series_shelter_detail($id, $date);		
		$arr['hourly_ritase'] = $this->dashboard_model->get_ritase_hour_shelter_detail($id, $start, $date);	
		$arr['detail_unit'] = $this->dashboard_model->get_shelter_detail_unit($id, $start, $date);		
		foreach((Array) $arrData['data'] AS $key => $val){
			$arr['id'] = $val['id'];
			$arr['name'] = $val['name'];
			$arr['total_ritase'] = $val['ritase'];			
			$arr['total_argo'] = $val['argo'];	
			$arr['arpu'] = $val['argo'] / ($val['ritase'] > 0 ? $val['ritase'] : 1);	
			$arr['ritase_mtd'] = $val['ritase_mtd'];
			$arr['argo_mtd'] = $val['argo_mtd'];
			$arr['arpu_mtd'] = $val['argo_mtd'] / ($val['ritase_mtd'] > 0 ? $val['ritase_mtd'] : 1);
			$arr['ritase_ytd'] = $val['ritase_ytd'];
			$arr['argo_ytd'] = $val['argo_ytd'];
			$arr['arpu_ytd'] = $val['argo_ytd'] / ($val['ritase_ytd'] > 0 ? $val['ritase_ytd'] : 1);			
		}
		$arr['unique_unit'] = $arrData['unit_unique'][0]['ct'];
		$arr['avg_ritase'] = $arr['total_ritase'] / (Count($arrData) > 0 ? Count($arrData) : 1);
		$arr['avg_argo'] = $arr['total_argo'] / (Count($arrData) > 0 ? Count($arrData) : 1);
		$arr['arpu_shelter'] = $arr['total_argo'] / ($arr['total_ritase'] > 0 ? $arr['total_ritase'] : 1);
		$arr['total_arit'] = $arr['total_ritase'] / ($arr['unique_unit'] > 0 ? $arr['unique_unit'] : 1);
		$arr['total_aapu'] = $arr['total_argo'] / ($arr['unique_unit'] > 0 ? $arr['unique_unit'] : 1);	
		$this->load->view('header');
		$this->load->view('shelter', Array('data' => $arr, 'start' => $start, 'date' => $date, 'detail' => $id));
		$this->load->view('footer');	
		
	}
	
	public function detailPool(){
		if(isset($_GET['id']))
			$id = $_GET['id'];
		if(isset($_GET['date']))
			$date = $_GET['date'];
		if(isset($_GET['idPool']))
			$idPool = $_GET['idPool'];	
			
		$start = '';
		$start = isset($_GET['start']) ? $_GET['start'] : $start;
		$date = isset($_GET['end']) ? $_GET['end'] : $date;		

		if($date === '' || strtotime($date) > strtotime(date('Y-m-d')))
			$date = date('Y-m-d');
		if($start === '')
			$start = $date;
	
		if(strtotime($start) > strtotime($date)){
			$temp = $start;
			$start = $date;
			$date = $start;
		}
			
		$arrData = $this->dashboard_model->get_detail_shelter_by_pool($id, $idPool, $start, $date);
		$arr = array();	
		$check = date('j F Y H:i:s', strtotime($this->dashboard_model->check_ritase_shelter($start, $date)[0]['last_update']));
		$arr['shelter'] = $this->dashboard_model->get_shelter($id);
		$arr['last_update'] = $check;
		$arr['series'] = $arrData['series'];		
		$arr['series_rds'] = $this->dashboard_model->get_monthly_series_shelter_detail_pool($id, $idPool, $date);		
		$arr['hourly_ritase'] = $this->dashboard_model->get_ritase_hour_shelter_detail_pool($id, $idPool, $start, $date);	
		$arr['detail_unit'] = $this->dashboard_model->get_shelter_detail_unit_pool($id, $idPool, $start, $date);		
		foreach((Array) $arrData['data'] AS $key => $val){
			$arr['id'] = $val['id'];
			$arr['name'] = $val['name'];
			$arr['total_ritase'] = $val['ritase'];			
			$arr['total_argo'] = $val['argo'];	
			$arr['arpu'] = $val['argo'] / ($val['ritase'] > 0 ? $val['ritase'] : 1);	
			$arr['ritase_mtd'] = $val['ritase_mtd'];
			$arr['argo_mtd'] = $val['argo_mtd'];
			$arr['arpu_mtd'] = $val['argo_mtd'] / ($val['ritase_mtd'] > 0 ? $val['ritase_mtd'] : 1);
			$arr['ritase_ytd'] = $val['ritase_ytd'];
			$arr['argo_ytd'] = $val['argo_ytd'];
			$arr['arpu_ytd'] = $val['argo_ytd'] / ($val['ritase_ytd'] > 0 ? $val['ritase_ytd'] : 1);			
		}
		$arr['unique_unit'] = $arrData['unit_unique'][0]['ct'];
		$arr['avg_ritase'] = $arr['total_ritase'] / (Count($arrData) > 0 ? Count($arrData) : 1);
		$arr['avg_argo'] = $arr['total_argo'] / (Count($arrData) > 0 ? Count($arrData) : 1);
		$arr['arpu_shelter'] = $arr['total_argo'] / ($arr['total_ritase'] > 0 ? $arr['total_ritase'] : 1);
		$arr['total_arit'] = $arr['total_ritase'] / ($arr['unique_unit'] > 0 ? $arr['unique_unit'] : 1);
		$arr['total_aapu'] = $arr['total_argo'] / ($arr['unique_unit'] > 0 ? $arr['unique_unit'] : 1);	
		$this->load->view('header');
		$this->load->view('shelter', Array('data' => $arr, 'start' => $start, 'date' => $date, 'detail' => $id, 'idPool' => $idPool));
		$this->load->view('footer');	
		
	}
	
	public function tipe(){
		if(isset($_GET['id']))
			$id = $_GET['id'];
		if(isset($_GET['date']))
			$date = $_GET['date'];
		$start = '';
		$start = isset($_GET['start']) ? $_GET['start'] : $start;
		$date = isset($_GET['end']) ? $_GET['end'] : $date;		

		if($date === '' || strtotime($date) > strtotime(date('Y-m-d')))
			$date = date('Y-m-d');
		if($start === '')
			$start = date('Y-m-d');
	
		if(strtotime($start) > strtotime($date)){
			$temp = $start;
			$start = $date;
			$date = $start;
		}

		//CHECK LAST UPDATE
		$check = date('j F Y H:i:s', strtotime($this->dashboard_model->check_ritase_shelter($start, $date)[0]['last_update']));
		$arr = array();
		$arr['last_update'] = $check;
		$arr['shelter'] = array();
		$arr['tipe'] = array();		
		$arr['total_ritase'] = 0;
		$arr['total_argo'] = 0;
		$arrData = $this->dashboard_model->get_detail_tipe_shelter($id, $start, $date);
		$arr['series'] = $arrData['series'];		
		$arr['series_rds'] = $this->dashboard_model->get_monthly_series_tipe_shelter($id, $date);		
		$arr['hourly_ritase'] = $this->dashboard_model->get_ritase_hour_tipe_shelter($id, $start, $date);	
		foreach((Array) $arrData['data'] AS $key => $val){
			$a = array();
			$a['id'] = $val['id'];
			$a['name'] = $val['name'];
			$a['ritase'] = $val['ritase'];			
			$a['argo'] = $val['argo'];	
			$a['arpu'] = $val['argo'] / ($val['ritase'] > 0 ? $val['ritase'] : 1);	
			$a['ritase_mtd'] = $val['ritase_mtd'];
			$a['argo_mtd'] = $val['argo_mtd'];
			$a['arpu_mtd'] = $val['argo_mtd'] / ($val['ritase_mtd'] > 0 ? $val['ritase_mtd'] : 1);
			$a['ritase_ytd'] = $val['ritase_ytd'];
			$a['argo_ytd'] = $val['argo_ytd'];
			$a['arpu_ytd'] = $val['argo_ytd'] / ($val['ritase_ytd'] > 0 ? $val['ritase_ytd'] : 1);			
			$arr['total_ritase'] += $val['ritase'];		
			$arr['total_argo'] += $val['argo'];
			array_push($arr['shelter'], $a);	
		}
		
		$arr['unique_unit'] = $arrData['unit_unique'][0]['ct'];
		$arr['avg_ritase'] = $arr['total_ritase'] / (Count($arrData) > 0 ? Count($arrData) : 1);
		$arr['avg_argo'] = $arr['total_argo'] / (Count($arrData) > 0 ? Count($arrData) : 1);
		$arr['arpu_shelter'] = $arr['total_argo'] / ($arr['total_ritase'] > 0 ? $arr['total_ritase'] : 1);
		$arr['total_arit'] = $arr['total_ritase'] / ($arr['unique_unit'] > 0 ? $arr['unique_unit'] : 1);
		$arr['total_aapu'] = $arr['total_argo'] / ($arr['unique_unit'] > 0 ? $arr['unique_unit'] : 1);				
		$this->load->view('header');
		$this->load->view('shelter', Array('data' => $arr, 'start' => $start, 'date' => $date, 'tipe' => $id));
		$this->load->view('footer');	
	}
	
	public function area(){
		if(isset($_GET['id']))
			$id = $_GET['id'];
		if(isset($_GET['date']))
			$date = $_GET['date'];
		$start = '';
		$start = isset($_GET['start']) ? $_GET['start'] : $start;
		$date = isset($_GET['end']) ? $_GET['end'] : $date;		

		if($date === '' || strtotime($date) > strtotime(date('Y-m-d')))
			$date = date('Y-m-d');
		if($start === '')
			$start = date('Y-m-d');
	
		if(strtotime($start) > strtotime($date)){
			$temp = $start;
			$start = $date;
			$date = $start;
		}
		
		//CHECK LAST UPDATE
		$check = date('j F Y H:i:s', strtotime($this->dashboard_model->check_ritase_shelter($start, $date)[0]['last_update']));
		$arr = array();
		$arr['last_update'] = $check;
		$arr['shelter'] = array();
		$arr['tipe'] = array();		
		$arr['total_ritase'] = 0;
		$arr['total_argo'] = 0;
		$arrData = $this->dashboard_model->get_detail_area_shelter($id, $start, $date);
		$arr['series'] = $arrData['series'];		
		$arr['series_rds'] = $this->dashboard_model->get_monthly_series_area_shelter($id, $date);		
		$arr['hourly_ritase'] = $this->dashboard_model->get_ritase_hour_area_shelter($id, $start,$date);	
		foreach((Array) $arrData['data'] AS $key => $val){
			$a = array();
			$a['id'] = $val['id'];
			$a['name'] = $val['name'];
			$a['ritase'] = $val['ritase'];			
			$a['argo'] = $val['argo'];	
			$a['arpu'] = $val['argo'] / ($val['ritase'] > 0 ? $val['ritase'] : 1);	
			$a['ritase_mtd'] = $val['ritase_mtd'];
			$a['argo_mtd'] = $val['argo_mtd'];
			$a['arpu_mtd'] = $val['argo_mtd'] / ($val['ritase_mtd'] > 0 ? $val['ritase_mtd'] : 1);
			$a['ritase_ytd'] = $val['ritase_ytd'];
			$a['argo_ytd'] = $val['argo_ytd'];
			$a['arpu_ytd'] = $val['argo_ytd'] / ($val['ritase_ytd'] > 0 ? $val['ritase_ytd'] : 1);			
			$arr['total_ritase'] += $val['ritase'];		
			$arr['total_argo'] += $val['argo'];
			array_push($arr['shelter'], $a);	
		}
		
		$arr['unique_unit'] = $arrData['unit_unique'][0]['ct'];
		$arr['avg_ritase'] = $arr['total_ritase'] / (Count($arrData) > 0 ? Count($arrData) : 1);
		$arr['avg_argo'] = $arr['total_argo'] / (Count($arrData) > 0 ? Count($arrData) : 1);
		$arr['arpu_shelter'] = $arr['total_argo'] / ($arr['total_ritase'] > 0 ? $arr['total_ritase'] : 1);
		$arr['total_arit'] = $arr['total_ritase'] / ($arr['unique_unit'] > 0 ? $arr['unique_unit'] : 1);
		$arr['total_aapu'] = $arr['total_argo'] / ($arr['unique_unit'] > 0 ? $arr['unique_unit'] : 1);				
		$this->load->view('header');
		$this->load->view('shelter', Array('data' => $arr, 'start' => $start, 'date' => $date, 'area' => $id));
		$this->load->view('footer');	
	}
	
	public function area_big(){
		if(isset($_GET['id']))
			$id = $_GET['id'];
		if(isset($_GET['date']))
			$date = $_GET['date'];
		$start = '';
		$start = isset($_GET['start']) ? $_GET['start'] : $start;
		$date = isset($_GET['end']) ? $_GET['end'] : $date;		

		if($date === '' || strtotime($date) > strtotime(date('Y-m-d')))
			$date = date('Y-m-d');
		if($start === '')
			$start = date('Y-m-d');
	
		if(strtotime($start) > strtotime($date)){
			$temp = $start;
			$start = $date;
			$date = $start;
		}
		
		//CHECK LAST UPDATE
		$check = date('j F Y H:i:s', strtotime($this->dashboard_model->check_ritase_shelter($start, $date)[0]['last_update']));
		$arr = array();
		$arr['last_update'] = $check;
		$arr['shelter'] = array();
		$arr['tipe'] = array();		
		$arr['total_ritase'] = 0;
		$arr['total_argo'] = 0;
		$arrData = $this->dashboard_model->get_detail_area_big_shelter($id, $start, $date);
		$arr['series'] = $arrData['series'];		
		$arr['series_rds'] = $this->dashboard_model->get_monthly_series_area_big_shelter($id, $date);		
		$arr['hourly_ritase'] = $this->dashboard_model->get_ritase_hour_area_big_shelter($id, $start,$date);	
		foreach((Array) $arrData['data'] AS $key => $val){
			$a = array();
			$a['id'] = $val['id'];
			$a['name'] = $val['name'];
			$a['ritase'] = $val['ritase'];			
			$a['argo'] = $val['argo'];	
			$a['arpu'] = $val['argo'] / ($val['ritase'] > 0 ? $val['ritase'] : 1);	
			$a['ritase_mtd'] = $val['ritase_mtd'];
			$a['argo_mtd'] = $val['argo_mtd'];
			$a['arpu_mtd'] = $val['argo_mtd'] / ($val['ritase_mtd'] > 0 ? $val['ritase_mtd'] : 1);
			$a['ritase_ytd'] = $val['ritase_ytd'];
			$a['argo_ytd'] = $val['argo_ytd'];
			$a['arpu_ytd'] = $val['argo_ytd'] / ($val['ritase_ytd'] > 0 ? $val['ritase_ytd'] : 1);			
			$arr['total_ritase'] += $val['ritase'];		
			$arr['total_argo'] += $val['argo'];
			array_push($arr['shelter'], $a);	
		}
		
		$arr['unique_unit'] = $arrData['unit_unique'][0]['ct'];
		$arr['avg_ritase'] = $arr['total_ritase'] / (Count($arrData) > 0 ? Count($arrData) : 1);
		$arr['avg_argo'] = $arr['total_argo'] / (Count($arrData) > 0 ? Count($arrData) : 1);
		$arr['arpu_shelter'] = $arr['total_argo'] / ($arr['total_ritase'] > 0 ? $arr['total_ritase'] : 1);
		$arr['total_arit'] = $arr['total_ritase'] / ($arr['unique_unit'] > 0 ? $arr['unique_unit'] : 1);
		$arr['total_aapu'] = $arr['total_argo'] / ($arr['unique_unit'] > 0 ? $arr['unique_unit'] : 1);				
		$this->load->view('header');
		$this->load->view('shelter', Array('data' => $arr, 'start' => $start, 'date' => $date, 'area' => $id, 'big' => true));
		$this->load->view('footer');	
	}
	
	public function pool(){
		if(isset($_GET['id']))
			$id = $_GET['id'];
		if(isset($_GET['date']))
			$date = $_GET['date'];
		$start = '';
		$start = isset($_GET['start']) ? $_GET['start'] : $start;
		$date = isset($_GET['end']) ? $_GET['end'] : $date;		

		if($date === '' || strtotime($date) > strtotime(date('Y-m-d')))
			$date = date('Y-m-d');
		if($start === '')
			$start = date('Y-m-d');
	
		if(strtotime($start) > strtotime($date)){
			$temp = $start;
			$start = $date;
			$date = $start;
		}
		
		//CHECK LAST UPDATE
		$check = date('j F Y H:i:s', strtotime($this->dashboard_model->check_ritase_shelter($start, $date)[0]['last_update']));
		$arr = array();
		$arr['last_update'] = $check;
		$arr['shelter'] = array();
		$arr['tipe'] = array();		
		$arr['total_ritase'] = 0;
		$arr['total_argo'] = 0;
		$arrData = $this->dashboard_model->get_detail_pool_shelter($id, $start, $date);
		$arr['series'] = $arrData['series'];		
		$arr['series_rds'] = $this->dashboard_model->get_monthly_series_pool_shelter($id, $date);		
		$arr['hourly_ritase'] = $this->dashboard_model->get_ritase_hour_pool_shelter($id, $start,$date);	
		$pool = $this->dashboard_model->get_pool_by_id($id)[0]['name'];
		foreach((Array) $arrData['data'] AS $key => $val){
			$a = array();
			$a['id'] = $val['id'];
			$a['name'] = $val['name'];
			$a['ritase'] = $val['ritase'];			
			$a['argo'] = $val['argo'];	
			$a['arpu'] = $val['argo'] / ($val['ritase'] > 0 ? $val['ritase'] : 1);	
			$a['ritase_mtd'] = $val['ritase_mtd'];
			$a['argo_mtd'] = $val['argo_mtd'];
			$a['arpu_mtd'] = $val['argo_mtd'] / ($val['ritase_mtd'] > 0 ? $val['ritase_mtd'] : 1);
			$a['ritase_ytd'] = $val['ritase_ytd'];
			$a['argo_ytd'] = $val['argo_ytd'];
			$a['arpu_ytd'] = $val['argo_ytd'] / ($val['ritase_ytd'] > 0 ? $val['ritase_ytd'] : 1);			
			$arr['total_ritase'] += $val['ritase'];		
			$arr['total_argo'] += $val['argo'];
			array_push($arr['shelter'], $a);	
		}
		
		$arr['unique_unit'] = $arrData['unit_unique'][0]['ct'];
		$arr['avg_ritase'] = $arr['total_ritase'] / (Count($arrData) > 0 ? Count($arrData) : 1);
		$arr['avg_argo'] = $arr['total_argo'] / (Count($arrData) > 0 ? Count($arrData) : 1);
		$arr['arpu_shelter'] = $arr['total_argo'] / ($arr['total_ritase'] > 0 ? $arr['total_ritase'] : 1);
		$arr['total_arit'] = $arr['total_ritase'] / ($arr['unique_unit'] > 0 ? $arr['unique_unit'] : 1);
		$arr['total_aapu'] = $arr['total_argo'] / ($arr['unique_unit'] > 0 ? $arr['unique_unit'] : 1);				
		$this->load->view('header');
		$this->load->view('shelter', Array('data' => $arr, 'start' => $start, 'date' => $date, 'area' => $id, 'pool' => $pool));
		$this->load->view('footer');	
	}
	
	public function get_shelter(){
		$id = $_GET['id'];
		$data = $this->dashboard_model->get_shelter_locations($id);
		$this->load->view('shelter_location', Array('data'=> $data));
	}
	
	public function get_map(){
		$id = $_GET['id'];
		$is_tiara = $_GET['is_tiara'];		
		$this->load->view('map_location', Array('id_trip'=> $id, 'is_tiara' => $is_tiara));
	}
}
