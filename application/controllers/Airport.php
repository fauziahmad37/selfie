<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Admin.php');
class Airport extends Admin {
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
		$check = date('j F Y H:i:s', strtotime($this->dashboard_model->check_ritase_airport($start, $date)[0]['last_update']));
		$arr = array();
		$arr['last_update'] = $check;
		$arr['shelter'] = array();
		$arr['tipe'] = array();	
		$arr['area'] = array();		
		$arr['pool'] = array();		
		$arr['total_ritase'] = 0;
		$arr['total_argo'] = 0;
		$arrData = $this->dashboard_model->get_ritase_bandara($start, $date);
		$arrPool = $this->dashboard_model->get_ritase_bandara_by_pool($start, $date);						
		$arr['series'] = $arrData['series'];		
		$arr['series_rds'] = $this->dashboard_model->get_monthly_series_bandara($date);		
		$arr['hourly_ritase'] = $this->dashboard_model->get_ritase_hour_bandara($start, $date);										
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
		
		$arr['tiara_unit'] = $arrData['tiara'][0]['ct_tiara'];
		$arr['non_tiara_unit'] = $arr['unique_unit'] - $arr['tiara_unit'];
		$arr['tiara_rit'] = $arrData['tiara'][0]['rit_tiara'];
		$arr['non_tiara_rit'] = $arr['total_ritase'] - $arr['tiara_rit'];
		$arr['tiara_argo'] = $arrData['tiara'][0]['argo_tiara'];
		$arr['non_tiara_argo'] = $arr['total_argo'] - $arr['tiara_argo'];	
		
		$this->load->view('header');
		$this->load->view('airport', Array('data' => $arr, 'start' => $start, 'date' => $date));
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
			
		$arrData = $this->dashboard_model->get_detail_bandara($id, $start, $date);
		$arr = array();	
		$check = date('j F Y H:i:s', strtotime($this->dashboard_model->check_ritase_airport($start, $date)[0]['last_update']));
		$arr['shelter'] = $this->dashboard_model->get_bandara($id);
		$arr['last_update'] = $check;
		$arr['series'] = $arrData['series'];		
		$arr['series_rds'] = $this->dashboard_model->get_monthly_series_bandara_detail($id, $date);		
		$arr['hourly_ritase'] = $this->dashboard_model->get_ritase_hour_bandara_detail($id, $start, $date);	
		$arr['detail_unit'] = $this->dashboard_model->get_bandara_detail_unit($id, $start, $date);		
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
		
		$arr['tiara_unit'] = $arrData['tiara'][0]['ct_tiara'];
		$arr['non_tiara_unit'] = $arr['unique_unit'] - $arr['tiara_unit'];
		$arr['tiara_rit'] = $arrData['tiara'][0]['rit_tiara'];
		$arr['non_tiara_rit'] = $arr['total_ritase'] - $arr['tiara_rit'];
		$arr['tiara_argo'] = $arrData['tiara'][0]['argo_tiara'];
		$arr['non_tiara_argo'] = $arr['total_argo'] - $arr['tiara_argo'];
		
		$this->load->view('header');
		$this->load->view('airport', Array('data' => $arr, 'start' => $start, 'date' => $date, 'detail' => $id));
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
			$start = $date;
	
		if(strtotime($start) > strtotime($date)){
			$temp = $start;
			$start = $date;
			$date = $start;
		}
			
		$arrData = $this->dashboard_model->get_detail_bandara_by_pool($id, $start, $date);
		$arr = array();	
		$check = date('j F Y H:i:s', strtotime($this->dashboard_model->check_ritase_airport($start, $date)[0]['last_update']));
		$arr['shelter'] = $this->dashboard_model->get_pool_by_id($id);
		$arr['last_update'] = $check;
		$arr['series'] = $arrData['series'];		
		$arr['series_rds'] = $this->dashboard_model->get_monthly_series_bandara_detail_pool($id, $date);		
		$arr['hourly_ritase'] = $this->dashboard_model->get_ritase_hour_bandara_detail_pool($id, $start, $date);	
		$arr['detail_unit'] = $this->dashboard_model->get_bandara_detail_unit_pool($id, $start, $date);		
		$arr['total_ritase'] = 0;
		$arr['total_argo'] = 0;		
		foreach((Array) $arrData['data'] AS $key => $val){
			$arr['total_ritase'] += $val['ritase'];			
			$arr['total_argo'] += $val['argo'];	
		}
		$arr['unique_unit'] = $arrData['unit_unique'][0]['ct'];
		$arr['avg_ritase'] = $arr['total_ritase'] / (Count($arrData) > 0 ? Count($arrData) : 1);
		$arr['avg_argo'] = $arr['total_argo'] / (Count($arrData) > 0 ? Count($arrData) : 1);
		$arr['arpu_shelter'] = $arr['total_argo'] / ($arr['total_ritase'] > 0 ? $arr['total_ritase'] : 1);
		$arr['total_arit'] = $arr['total_ritase'] / ($arr['unique_unit'] > 0 ? $arr['unique_unit'] : 1);
		$arr['total_aapu'] = $arr['total_argo'] / ($arr['unique_unit'] > 0 ? $arr['unique_unit'] : 1);	
		
		$arr['tiara_unit'] = $arrData['tiara'][0]['ct_tiara'];
		$arr['non_tiara_unit'] = $arr['unique_unit'] - $arr['tiara_unit'];
		$arr['tiara_rit'] = $arrData['tiara'][0]['rit_tiara'];
		$arr['non_tiara_rit'] = $arr['total_ritase'] - $arr['tiara_rit'];
		$arr['tiara_argo'] = $arrData['tiara'][0]['argo_tiara'];
		$arr['non_tiara_argo'] = $arr['total_argo'] - $arr['tiara_argo'];
		
		$this->load->view('header');
		$this->load->view('airport', Array('data' => $arr, 'start' => $start, 'date' => $date, 'detail' => $id, 'pool' => true));
		$this->load->view('footer');	
		
	}
	
	public function get_bandara(){
		$id = $_GET['id'];
		$data = $this->dashboard_model->get_bandara_locations($id);
		$this->load->view('shelter_location', Array('data'=> $data));
	}
	
	public function get_map(){
		$id = $_GET['id'];
		$is_tiara = $_GET['is_tiara'];		
		$this->load->view('map_location', Array('id_trip'=> $id, 'is_tiara' => $is_tiara));
	}
}
