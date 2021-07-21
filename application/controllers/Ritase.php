<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Admin.php');
class Ritase extends Admin {
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
		
		$data = array();
		$arrData = $this->dashboard_model->get_ritase_rds($start, $date);
		$data['total_ritase'] = 0;
		$data['total_argo'] = 0;
		$data['total_unit'] = 0;
		$data['total_spj'] = 0;
		$data['pool_reguler'] = $data['pool_reguler2'] = $data['pool_reguler3'] = $data['pool_reguler4'] = $data['pool_eagle'] = $data['pool_tiara'] = array();
		$data['series'] = $arrData['series'];
		$check = $this->dashboard_model->check_ritase_rds();
		$data['last_update'] = date('j F Y H:i:s', strtotime($check));
		$data['series_rds'] = $this->dashboard_model->get_monthly_series_rds($date);
		$data['hourly_ritase'] = $this->dashboard_model->get_ritase_hour_rds($date);
		foreach((Array) $arrData['data'] AS $key => $val){	
			$arr = array();
			$arr['name'] = $val['name'];
			$arr['ritase'] = $val['total_ritase'];
			$arr['argo'] = $val['total_argo'];
			$arr['unit'] = $val['total_unit'];
			$arr['spj'] = $val['ops_operasi'];
			$arr['arit'] = $arr['ritase'] / $arr['unit'];			
			$arr['arpu'] = $arr['argo'] / $arr['unit'];
			$arr['aapr'] = $arr['argo'] / $arr['ritase'];									
			
			if($val['pool_area'] === '1'){
				array_push($data['pool_reguler'], $arr);
			} else if($val['pool_area'] === '2'){
				array_push($data['pool_reguler2'], $arr);
			} else if($val['pool_area'] === '6'){
				array_push($data['pool_reguler3'], $arr);
			} else if($val['pool_area'] === '7'){
				array_push($data['pool_reguler4'], $arr);
			} else if($val['pool_area'] === '4'){
				array_push($data['pool_eagle'], $arr);
			} else if($val['pool_area'] === '5'){
				array_push($data['pool_tiara'], $arr);
			}
			
			$data['total_ritase'] += $arr['ritase'];
			$data['total_argo'] += $arr['argo'];
			$data['total_unit'] += $arr['unit'];
			$data['total_spj'] += $arr['spj'];
		}
		$data['total_arpu'] = $data['total_argo'] / ($data['total_unit'] > 0 ? $data['total_unit'] : 1);
		$data['total_arit'] = $data['total_ritase'] / ($data['total_unit'] > 0 ? $data['total_unit'] : 1);
		$data['total_aapr'] = $data['total_argo'] / ($data['total_ritase'] > 0 ? $data['total_ritase'] : 1);		
		$this->load->view('header');
		$this->load->view('ritase', Array('data' => $data, 'start' => $start, 'date' => $date));
		$this->load->view('footer');	
	}
}
