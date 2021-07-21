<?php

include_once('Admin.php');

class Uber extends Admin {
	public $data;
	function __construct() {
		parent::__construct();
		$this->load->model('uber_model');
	}
	
	function index(){
		if(!isset($_GET['start'])){
			$start = date('Y-m-1', strtotime('-1 month'));
			$date = date('Y-m-t', strtotime('-1 month'));
		} else {
			$start = $_GET['start'];
			$date = $_GET['end'];
		}
			
		$arrData = $this->uber_model->get_uber_data($start, $date);
		
		$data = array();
		$data['last_update'] = date('Y-m-d H:i:s', strtotime($this->uber_model->get_last_update($date)[0]['last_update']));
		$data['last_30'] = $arrData['last_30'];
		$data['has_online'] = $arrData['next_7'][0]['ct'];				
		$data['total_trip'] = $arrData['next_7'][0]['trip'];	
		$data['total_fare'] = $arrData['next_7'][0]['fare'];
		$data['active'] = 0;
		$arrPool = $this->uber_model->get_pool_uber();
		$data['top'] = $arrData['top'];
		$data['pool'] = array();
		foreach((Array) $arrPool AS $key => $val){
			$a = array();		
			$a['id'] = $val['id'];
			$a['name'] = $val['name'];
			$a['active'] = 0;
			$a['waitlisted'] = 0;
			$a['online'] = 0;
			$a['trip'] = 0;
			$a['fare'] = 0;
			$a['has_trip'] = 0;		
			$a['hours_online'] = 0;		
			$a['setoran'] = 0;
			$a['ks'] = 0;														
			foreach((Array) $arrData['data'] AS $key2 => $val2){
				if($val2['id_pool'] === $a['id']){
					if($val2['status'] === 'active' || $val2['status'] === 'aktif')
						$a['active'] += $val2['ct'];
					if($val2['status'] === 'waitlisted' || $val2['status'] === 'mendaftar')
						$a['waitlisted'] += $val2['ct'];
					$a['online'] += $val2['online'];
					$a['trip'] += $val2['trip'];
					$a['fare'] += $val2['fare'];	
					$a['has_trip'] += $val2['has_trip'];
					$a['hours_online'] += $val2['hours_online'];					
				}
			}
			foreach((Array) $arrData['setoran'] AS $key2 => $val2){
				if($val2['id_pool'] === $a['id']){
					$a['setoran'] += $val2['setoran'];
					$a['ks'] += $val2['ks'];					
				}
			}
			$a['hours_online'] /= 60;
			$a['avg_trip'] = $a['trip'] / ($a['has_trip'] > 0 ? $a['has_trip'] : 1);
			$a['avg_fare'] = $a['fare'] / ($a['trip'] > 0 ? $a['trip'] : 1);
			$a['avg_hours_online'] = $a['hours_online'] / ($a['online'] > 0 ? $a['online'] : 1);			
			$data['active'] += $a['active'];
			if($a['active'] == 0) continue;
			array_push($data['pool'], $a);																									
		}
		$data['avg_fare'] = $data['total_fare'] / ($data['total_trip'] > 0 ? $data['total_trip'] : 1);				
		$data['active_rate'] = $data['has_online'] / ($data['active'] > 0 ? $data['active'] : 1) * 100;
		
		$this->load->view('header');
		$this->load->view('uber', array('start' => $start, 'date' => $date, 'data' => $data));
		$this->load->view('footer');
	}
	
	function detail($period = ''){
		if(!isset($_GET['start'])){
			$start = date('Y-m-1', strtotime('-1 month'));
			$date = date('Y-m-t', strtotime('-1 month'));
		} else {
			$start = $_GET['start'];
			$date = $_GET['end'];
		}
		
		$id = $_GET['id'];		
		$arrData = $this->uber_model->get_uber_data_detail($start, $date, $id);
		
		$data = array();
		$data['last_update'] = date('Y-m-d H:i:s', strtotime($this->uber_model->get_last_update($date)[0]['last_update']));
		$data['last_30'] = $arrData['last_30'];
		$data['has_online'] = $arrData['next_7'][0]['ct'];				
		$data['total_trip'] = $arrData['next_7'][0]['trip'];	
		$data['total_fare'] = $arrData['next_7'][0]['fare'];
		$data['active'] = 0;
		$data['top'] = $arrData['top'];		
		$arrPool = $this->uber_model->get_pool_uber_detail($id);
		if(Count($arrPool) == 0) return show_404();
						
		$data['id'] = $id;
		$data['name'] = $arrPool['name'];
		$data['active'] = 0;
		$data['waitlisted'] = 0;
		$data['trip'] = 0;
		$data['fare'] = 0;
		$data['has_trip'] = 0;															
		foreach((Array) $arrData['data'] AS $key2 => $val2){
			if($val2['status'] === 'active' || $val2['status'] === 'aktif')
				$data['active']++;
			$data['trip'] += $val2['trip'];
			$data['fare'] += $val2['fare'];	
			if($val2['trip'] > 0)
				$data['has_trip']++;
		}
		$data['drivers'] = $arrData['data'];
		
		foreach((Array) $data['drivers'] AS $key => $val){
			$data['drivers'][$key]['setoran'] = 0;
			$data['drivers'][$key]['ks'] = 0;
			$data['drivers'][$key]['spj'] = 0;					
			foreach((Array) $arrData['setoran']  AS $key2 => $val2){
				if($val2['id'] === $val['id']){
					$data['drivers'][$key]['setoran'] += $val2['setoran'];
					$data['drivers'][$key]['ks'] += $val2['ks'];
					$data['drivers'][$key]['spj'] += $val2['spj'];										
					break;
				}
			}
		}
		
		$data['avg_fare'] = $data['total_fare'] / ($data['total_trip'] > 0 ? $data['total_trip'] : 1);				
		$data['active_rate'] = $data['has_online'] / ($data['active'] > 0 ? $data['active'] : 1) * 100;
		
		$this->load->view('header');
		$this->load->view('uber', array('date' => $date, 'data' => $data, 'start' => $start, 'name' => $data['name'], 'is_detail' => true, 'id' => $id));
		$this->load->view('footer');
	}
}