<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Admin.php');
class Rental extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');	
	}
	
	public function index($date = '')
	{
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d')))
			$date = date('Y-m-d');
		
		//CHECK LAST UPDATE
		$check = $this->dashboard_model->check_rental();
		if(!$check){
			$check = date('j F Y H:i:s');
		} else {
			$check = date('j F Y H:i:s', strtotime($check));
		}
		
		$data = array();	
		$data['last_update'] = $check;
		$data['data'] = $this->dashboard_model->get_operation_rental($date);
		$data['total_spj'] = $data['total_revenue'] = 0;
		$data['series'] = $this->dashboard_model->get_series_rental($date);
		
		foreach((Array) $data['data'] AS $key => $val){
			$arr = array();
			$data['total_spj']++;
			$data['total_revenue'] += $val['nominal_bayar_sewa'] + $val['nominal_bayar_denda'];			
		}
		
		$data['arpu'] = $data['total_revenue'] / ($data['total_spj'] > 0 ? $data['total_spj'] : 1);
		$this->load->view('header');
		$this->load->view('rental', Array('data' => $data, 'date' => $date));
		$this->load->view('footer');
	}
	
	function get_moving($arr, $date, $is_30){
		$a = array();
		$start = false;
		$ct = 0;
		$max = $is_30 ? 30 : 90;
		foreach((Array) $arr AS $key => $val){
			if(strtotime($val['tgl_spj']) == $date){
				$start = true;
			}
			if($start && $ct < $max){
				array_push($a, $val['operasi']);
				$ct++;
			}
			if($ct >= $max)
				break;
		}
		$avg = array_sum($a) / (count($a) > 0 ? count($a) : 1);
		return round($avg);
	}
}
