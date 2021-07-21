<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Admin.php');
class Summary extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('summary_model');					
	}
	
	public function index()
	{
		$pools = $this->summary_model->get_pools();
		$this->load->view('header');
		$this->load->view('summary', array('pools' => $pools));
		$this->load->view('footer');	
	}
	
	public function get_data(){
		$date = date('2017-3-31');
		$quarter = 	date('m', strtotime($date));
		if($quarter < 4){
			$quarter = 1;
			$from = date('Y-1-1', strtotime($date));
			$to = date('Y-3-31', strtotime($date));
		}
		else if($quarter < 7){
			$quarter = 2;
			$from = date('Y-4-1', strtotime($date));
			$to = date('Y-6-30', strtotime($date));
		}
		else if($quarter < 10){
			$quarter = 3;
			$from = date('Y-7-1', strtotime($date));
			$to = date('Y-9-30', strtotime($date));
		}
		else{
			$quarter = 4;		
			$from = date('Y-10-1', strtotime($date));
			$to = date('Y-12-31', strtotime($date));
		}
		
		$pools = $this->summary_model->get_pools();
		$dataAvailable = $this->summary_model->get_available_unit_pool();
		$dataTarget = $this->summary_model->get_target($date, $quarter);				
		$dataOps = $this->summary_model->get_data_ops($from, $to);
		$dataARPU_reg = $this->summary_model->get_data_arpu_reg($from, $to);
		$dataARPU = $this->summary_model->get_data_arpu_komisi($from, $to);
		$dataRit = $this->summary_model->get_data_rit($from, $to);
		$dataHKDriver = $this->summary_model->get_data_driver($from, $to);
		$dataHKCar = $this->summary_model->get_data_car($from, $to);													
		
		$data = array();
		foreach((Array) $pools AS $key => $val){
			$a = array();
			$a['id_pool'] = $val['id'];
			$a['pool_area'] = $val['pool_area'];
			$a['name'] = $val['name'];	
			$target = $this->get_target($dataTarget, $a['pool_area']);					
			$a['target_ops_pct'] = $target['ops_target'];
			$ops = $this->get_ops($dataOps, $a['id_pool']);
			$rit = $this->get_rit($dataRit, $a['id_pool']);	
			$driver = $this->get_hk($dataHKDriver, $a['id_pool']);
			$car = $this->get_hk($dataHKCar, $a['id_pool']);									
			
			//PCT
			$a['ops_pct'] = 25;
			$a['hk_pct'] = 25;
			$a['arpu_pct'] = 20;
			$a['rit_pct'] = 15;									
			
			//TARGET
			$a['target_ops'] = $ops['ops_total'];
			if($a['pool_area'] < 3)
				$a['target_ops'] = $this->get_available_car($dataAvailable, $a['id_pool']);
			$a['cal_target_ops'] = round($a['target_ops'] * $a['target_ops_pct'] / 100, 2);
			$a['target_ops'] = round($a['target_ops'], 2);
			$a['target_rit'] = $target['rit_target'];
			$a['target_min_rit'] = $target['rit_min'];			
			$a['target_driver'] = $target['hk_target'];
			$a['target_car'] = $target['hk_target'];			
			
			//ACTUAL
			$a['act_ops'] = round($ops['ops'], 2);
			$a['act_rit'] = round($rit['rit'] / ($rit['unit'] > 0 ? $rit['unit'] : 1), 2);	
			$a['act_driver'] = round($driver['hk'], 2);
			$a['act_car'] = round($car['hk'], 2);

			$a['act_ops_pct'] = min(round($a['act_ops'] / ($a['target_ops'] > 0 ? $a['target_ops'] : 1) * 100, 2), 100);			
			$a['ops'] = min($a['act_ops'] / ($a['cal_target_ops'] > 0 ? $a['cal_target_ops'] : 1) * $a['ops_pct'], $a['ops_pct']);
			$a['graph_ops'] = min($a['act_ops'] / ($a['cal_target_ops'] > 0 ? $a['cal_target_ops'] : 1) * 100, 100);			
			$a['rit'] = min($a['act_rit'] / $a['target_rit'] * $a['rit_pct'], $a['rit_pct']);
			$a['graph_rit'] = min($a['act_rit'] / ($a['target_rit'] > 0 ? $a['target_rit'] : 1) * 100, 100);			
			$a['rit'] = $a['act_rit'] >= $a['target_min_rit'] ? $a['rit'] : 0;
			
			if($a['pool_area'] < 3){
				$arpu = $this->get_arpu_reg($dataARPU_reg, $a['id_pool']);				
				$a['target_arpu'] = round($arpu['cap_rev'] / $a['act_ops'], 2);
				$a['act_arpu'] = round($arpu['total_rev'] / $a['act_ops'], 2);				
				$a['arpu'] = min($a['act_arpu'] / ($a['target_arpu'] > 0 ? $a['target_arpu'] : 1) * $a['arpu_pct'], $a['arpu_pct']);
				$a['graph_arpu'] = min($a['act_arpu'] / ($a['target_arpu'] > 0 ? $a['target_arpu'] : 1) * 100, 100);
			}
			else {
				$rev = $this->get_arpu($dataARPU, $a['id_pool']);
				$a['target_rev'] = $target['arpu_target'];
				$a['act_rev'] = round($rev['arpu'], 2);
				$a['rev'] = min($a['act_rev'] / $a['target_rev'] * $a['arpu_pct'], $a['arpu_pct']);
				$a['graph_rev'] = min($a['act_rev'] / $a['target_rev'] * 100, 100);
			}
			
			$a['hk_driver'] = min($a['act_driver'] / $a['target_driver'] * $a['hk_pct'], $a['hk_pct']);																	
			$a['graph_hk_driver'] = min($a['act_driver'] / $a['target_driver'] * 100, 100);																	
			$a['hk_car'] = min($a['act_car'] / $a['target_car'] * $a['hk_pct'], $a['hk_pct']);
			$a['graph_hk_car'] = min($a['act_car'] / $a['target_car'] * 100, 100);
			$a['overall'] = $a['ops'] + $a['rit'] + ($a['pool_area'] < 3 ? ($a['hk_car'] + $a['arpu']): ($a['hk_driver'] + $a['rev']));
			array_push($data, $a);
		}
		
		return print_r(json_encode($data));
	}
	
	private function get_ops($arr, $id){
		foreach((Array) $arr as $key => $val){
			if($val['id_pool'] == $id)
				return $val;
		}
		return 0;
	}
	
	private function get_target($arr, $area){
		foreach((Array) $arr as $key => $val){
			if($val['pool_area'] == $area)
				return $val;
		}
		return 0;
	}
	
	private function get_available_car($arr, $id){
		foreach((Array) $arr as $key => $val){
			if($val['id_pool'] == $id)
				return $val['aktif'];
		}
		return 0;
	}
	
	private function get_arpu_reg($arr, $id){
		foreach((Array) $arr as $key => $val){
			if($val['id_pool'] == $id)
				return $val;
		}
		return 0;
	}
	
	private function get_arpu($arr, $id){
		foreach((Array) $arr as $key => $val){
			if($val['id_pool'] == $id)
				return $val;
		}
		return 0;
	}
	
	private function get_rit($arr, $id){
		foreach((Array) $arr as $key => $val){
			if($val['id'] == $id)
				return $val;
		}
		return 0;
	}
	
	private function check_pool($arrPoolKode, $code){
		foreach((Array) $arrPoolKode AS $key => $val){
			if(strcasecmp($val['kode'],trim($code)) == 0){				 
				return $val['id_pool'];
			}
		}
		return 0;
	}
	
	private function get_hk($arr, $id){
		foreach((Array) $arr as $key => $val){
			if($val['id_pool'] == $id)
				return $val;
		}
		return 0;
	}
}