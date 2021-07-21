<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Admin.php');
class Callcenter extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('enigma_model');		
		$this->load->model('dashboard_model');					
	}
	
	public function index($date = '')
	{
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d')))
			$date = date('Y-m-1');
		$this->enigma_model->load_database();
		$arrDataComplain = $this->enigma_model->get_complain($date);
		$arrDataLostFound = $this->enigma_model->get_lostfound($date);
		$arrPool = $this->dashboard_model->get_pool();
		//$arrPoolKode = $this->dashboard_model->get_kode_pintu_pool();		
		$this->enigma_model->close_database();		
		$arr = array();
		$arr['data'] = array();
		$arr['series_complain'] = $this->enigma_model->series_complain($date);
		$arr['series_lostfound'] = $this->enigma_model->series_lostfound($date);		
		foreach((Array) $arrPool AS $key => $val){
			if($val['id'] >= 11 && $val['id'] <= 14) continue;
			$arr['data'][$val['id']] = array();
			$arr['data'][$val['id']]['id'] = $val['id'];
			$arr['data'][$val['id']]['name'] = $val['name'];						
			$arr['data'][$val['id']]['ct'] = 0;
			$arr['data'][$val['id']]['open'] = 0;
			$arr['data'][$val['id']]['fu'] = 0;
			$arr['data'][$val['id']]['closed'] = 0;
			$arr['data'][$val['id']]['kondisi'] = 0;
			$arr['data'][$val['id']]['pengemudi'] = 0;
			$arr['data'][$val['id']]['tertib'] = 0;
			$arr['data'][$val['id']]['sikap'] = 0;
			$arr['data'][$val['id']]['latest'] = 0;	
			$arr['data'][$val['id']]['lost_ct'] = 0;
			$arr['data'][$val['id']]['lost_open'] = 0;
			$arr['data'][$val['id']]['lost_fu'] = 0;
			$arr['data'][$val['id']]['lost_closed'] = 0;
			$arr['data'][$val['id']]['lost'] = 0;
			$arr['data'][$val['id']]['found'] = 0;
			$arr['data'][$val['id']]['lost_found'] = 0;
			$arr['data'][$val['id']]['found_found'] = 0;
			$arr['data'][$val['id']]['lost_notfound'] = 0;
			$arr['data'][$val['id']]['found_notfound'] = 0;						
			$arr['data'][$val['id']]['lost_latest'] = 0;
			$arr['data'][$val['id']]['mewah'] = 0;
			$arr['data'][$val['id']]['not_mewah'] = 0;																								
		}
		
		$arr['data'][0] = array();
		$arr['data'][0]['id'] = 0;
		$arr['data'][0]['name'] = 'Unknown';
		$arr['data'][0]['ct'] = 0;
		$arr['data'][0]['open'] = 0;
		$arr['data'][0]['fu'] = 0;
		$arr['data'][0]['closed'] = 0;
		$arr['data'][0]['kondisi'] = 0;
		$arr['data'][0]['pengemudi'] = 0;
		$arr['data'][0]['tertib'] = 0;
		$arr['data'][0]['sikap'] = 0;
		$arr['data'][0]['latest'] = 0;
		$arr['data'][0]['lost_ct'] = 0;
		$arr['data'][0]['lost_open'] = 0;
		$arr['data'][0]['lost_fu'] = 0;
		$arr['data'][0]['lost_closed'] = 0;
		$arr['data'][0]['lost'] = 0;
		$arr['data'][0]['found'] = 0;
		$arr['data'][0]['lost_found'] = 0;
		$arr['data'][0]['found_found'] = 0;
		$arr['data'][0]['lost_notfound'] = 0;
		$arr['data'][0]['found_notfound'] = 0;				
		$arr['data'][0]['lost_latest'] = 0;
		$arr['data'][0]['mewah'] = 0;
		$arr['data'][0]['not_mewah'] = 0;				
		
		$arr['data'][99] = array();
		$arr['data'][99]['id'] = 0;
		$arr['data'][99]['name'] = 'CC / Shelter';
		$arr['data'][99]['ct'] = 0;
		$arr['data'][99]['open'] = 0;
		$arr['data'][99]['fu'] = 0;
		$arr['data'][99]['closed'] = 0;
		$arr['data'][99]['kondisi'] = 0;
		$arr['data'][99]['pengemudi'] = 0;
		$arr['data'][99]['tertib'] = 0;
		$arr['data'][99]['sikap'] = 0;
		$arr['data'][99]['latest'] = 0;	
		$arr['data'][99]['lost_ct'] = 0;
		$arr['data'][99]['lost_open'] = 0;
		$arr['data'][99]['lost_fu'] = 0;
		$arr['data'][99]['lost_closed'] = 0;
		$arr['data'][99]['lost'] = 0;
		$arr['data'][99]['found'] = 0;
		$arr['data'][99]['lost_found'] = 0;
		$arr['data'][99]['found_found'] = 0;
		$arr['data'][99]['lost_notfound'] = 0;
		$arr['data'][99]['found_notfound'] = 0;				
		$arr['data'][99]['lost_latest'] = 0;
		$arr['data'][99]['mewah'] = 0;
		$arr['data'][99]['not_mewah'] = 0;
		
		$arr['ct'] = 0;
		$arr['open'] = 0;
		$arr['fu'] = 0;
		$arr['closed'] = 0;
		$arr['kondisi'] = 0;
		$arr['pengemudi'] = 0;
		$arr['tertib'] = 0;
		$arr['sikap'] = 0;
		$arr['callcenter'] = 0;		
		$arr['latest'] = 0;	
		$arr['lost_ct'] = 0;
		$arr['lost_open'] = 0;
		$arr['lost_fu'] = 0;
		$arr['lost_closed'] = 0;
		$arr['lost'] = 0;
		$arr['found'] = 0;
		$arr['lost_latest'] = 0;
		
		foreach((Array) $arrDataComplain as $key => $val){
			$id = $this->check_pool($arrPoolKode, $val['pool_code']);
			if($id == 0 && $val['complain_type'] == 8){
				$arr['callcenter']++;
				$id = 99;	
			}
			$arr['data'][$id]['ct']++;
			if($val['complain_status'] == 1){
				$arr['data'][$id]['open']++;
				$arr['open']++;
			}
			if($val['complain_status'] == 2){
				$arr['data'][$id]['fu']++;
				$arr['fu']++;
			}
			if($val['complain_status'] == 3){			
				$arr['data'][$id]['closed']++;
				$arr['closed']++;
			}
			if($val['complain_type'] == 2){				
				$arr['data'][$id]['kondisi']++;
				$arr['kondisi']++;
			}
			if($val['complain_type'] == 3){
				$arr['data'][$id]['pengemudi']++;
				$arr['pengemudi']++;
			}
			if($val['complain_type'] == 4){
				$arr['data'][$id]['tertib']++;
				$arr['tertib']++;
			}
			if($val['complain_type'] == 5){
				$arr['data'][$id]['sikap']++;
				$arr['sikap']++;
			}
			if($val['complain_status'] < 3 && strtotime($arr['data'][$id]['latest']) < strtotime($val['complain_date']))
				$arr['data'][$id]['latest'] = $val['complain_date'];	

			$arr['ct']++;
			if($val['complain_status'] < 3 && strtotime($arr['latest']) < strtotime($val['complain_date']))
				$arr['latest'] = $val['complain_date'];														
		}	

		foreach((Array) $arrDataLostFound as $key => $val){
			$id = $this->check_pool($arrPoolKode, $val['pool_code']);
			$arr['data'][$id]['lost_ct']++;
			if($val['lostfound_status'] == 1){
				$arr['data'][$id]['lost_open']++;
				$arr['lost_open']++;
			}
			if($val['lostfound_status'] == 2){
				$arr['data'][$id]['lost_fu']++;
				$arr['lost_fu']++;
			}
			if($val['lostfound_status'] == 3){			
				$arr['data'][$id]['lost_closed']++;
				$arr['lost_closed']++;
			}
			if($val['lostfound_type'] == 1){				
				$arr['data'][$id]['lost']++;
				$arr['lost']++;
				if($val['lostfound_status'] == 3){
					$arr['data'][$id]['lost_found']++;
				} else {
					$arr['data'][$id]['lost_notfound']++;
				}
			}
			if($val['lostfound_type'] == 2){
				$arr['data'][$id]['found']++;
				$arr['found']++;
				if($val['lostfound_status'] == 3){
					$arr['data'][$id]['found_found']++;
				} else {
					$arr['data'][$id]['found_notfound']++;
				}
			}
			if($val['lostfound_kind2'] == 'MEWAH')
				$arr['data'][$id]['mewah']++;
			else 
				$arr['data'][$id]['not_mewah']++;
			if($val['lostfound_status'] < 3 && strtotime($arr['data'][$id]['lost_latest']) < strtotime($val['lostfound_date']))
				$arr['data'][$id]['lost_latest'] = $val['lostfound_date'];	

			$arr['lost_ct']++;
			if($val['lostfound_status'] < 3 && strtotime($arr['lost_latest']) < strtotime($val['lostfound_date']))
				$arr['lost_latest'] = $val['lostfound_date'];														
		}	
		
		$this->load->view('header');
		$this->load->view('callcenter', Array('data' => $arr, 'date' => $date));
		$this->load->view('footer');	
	}
	
	public function detail(){
		$id_pool = $_GET['id'];
		$date = $_GET['date'];
		
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d')))
			$date = date('Y-m-1');
		$arr = array();
		$this->enigma_model->load_database();		
		$arrPool = $this->dashboard_model->get_pool_by_id($id_pool);
		$arrPoolKode = $this->dashboard_model->get_kode_pintu_pool();	
		$poolKode = $this->getPoolKode($arrPoolKode, $id_pool, ($id_pool == 99 || $id_pool == 0));
		$arr['series_complain'] = $this->enigma_model->series_complain_detail($date, $poolKode, ($id_pool == 99 || $id_pool == 0));
		$arr['series_lostfound'] = $this->enigma_model->series_lostfound_detail($date, $poolKode, ($id_pool == 99 || $id_pool == 0));	
		$arrDataComplain = $this->enigma_model->get_complain_detail($date, $poolKode, ($id_pool == 99 || $id_pool == 0));
		$arrDataLostFound = $this->enigma_model->get_lostfound_detail($date, $poolKode, ($id_pool == 99 || $id_pool == 0));
		$this->enigma_model->close_database();		

		$arr['complain'] = array();
		$arr['lostfound'] = array();		
		$arr['ct'] = 0;
		$arr['open'] = 0;
		$arr['fu'] = 0;
		$arr['closed'] = 0;	
		$arr['kondisi'] = 0;	
		$arr['pengemudi'] = 0;	
		$arr['tertib'] = 0;	
		$arr['sikap'] = 0;
		$arr['callcenter'] = 0;			
		$arr['lost_ct'] = 0;	
		$arr['lost_open'] = 0;	
		$arr['lost_fu'] = 0;	
		$arr['lost_closed'] = 0;	
		$arr['lost'] = 0;
		$arr['found'] = 0;														
		
		foreach((Array) $arrDataComplain as $key => $val){
// 			$check = $this->check_pool($arrPoolKode, $val['pool_code']);
// 			if($check != $id_pool) continue;
			$a = array();
			$arr['ct']++;
			$a['complainid'] = $val['complainid'];
			$a['caller_name'] = $val['caller_name'];
			$a['caller_number'] = $val['caller_number'];
			if($val['complain_status'] == 1){
				$a['complain_status'] = 'Open';
				$arr['open']++;
			}
			if($val['complain_status'] == 2){
				$a['complain_status'] = 'In Progress';
				$arr['fu']++;
			}
			if($val['complain_status'] == 3){			
				$a['complain_status'] = 'Closed';
				$arr['closed']++;
			}
			if($val['complain_type'] == 2){				
				$a['complain_type'] = 'Kondisi Unit';
				$arr['kondisi']++;
			}
			else if($val['complain_type'] == 3){
				$a['complain_type'] = 'Pelayanan Pengemudi';
				$arr['pengemudi']++;
			}
			else if($val['complain_type'] == 4){
				$a['complain_type'] = 'Tata Tertib';
				$arr['tertib']++;
			}
			else if($val['complain_type'] == 5){
				$a['complain_type'] = 'Sikap dan Perilaku';
				$arr['sikap']++;
			} else {
				$a['complain_type'] = 'CC / Shelter';				
			}
			$a['complain_date'] = $val['complain_date'];
			$a['complain_detail'] = $val['complain_detail'];
			$a['complain_result'] = $val['complain_result'];
			$a['no_pintu'] = $val['pool_code'].' '.$val['hull_number'];
			$a['police_number'] = $val['police_number'];
			$a['driver_name'] = $val['driver_name'];
			$a['closed_date'] = $val['complain_status'] == 3 ? $val['date_updated'] : 0;	
			array_push($arr['complain'], $a);					
		}	
		
		foreach((Array) $arrDataLostFound as $key => $val){
// 			$check = $this->check_pool($arrPoolKode, $val['pool_code']);
// 			if($check != $id_pool) continue;
			$a = array();
			$arr['lost_ct']++;
			$a['lostfoundid'] = $val['lostfoundid'];
			$a['caller_name'] = $val['caller_name'];
			$a['caller_number'] = $val['caller_number'];
			if($val['lostfound_status'] == 1){
				$a['lostfound_status'] = 'Open';
				$arr['lost_open']++;
			}
			if($val['lostfound_status'] == 2){
				$a['lostfound_status'] = 'In Progress';
				$arr['lost_fu']++;
			}
			if($val['lostfound_status'] == 3){			
				$a['lostfound_status'] = 'Closed';
				$arr['lost_closed']++;
			}
			if($val['lostfound_type'] == 1){				
				$a['lostfound_type'] = 'Lost';
				$arr['lost']++;
			}
			else if($val['lostfound_type'] == 2){
				$a['lostfound_type'] = 'Found';
				$arr['found']++;
			}
			$a['lostfound_date'] = $val['lostfound_date'];
			$a['lostfound_kind'] = $val['lostfound_kind'];			
			$a['lostfound_kind2'] = $val['lostfound_kind2'];
			$a['lostfound_qty'] = $val['lostfound_qty'];						
			$a['lostfound_detail'] = $val['lostfound_detail'];
			$a['lostfound_result'] = $val['lostfound_result'];
			$a['lostfound_result2'] = $val['lostfound_result2'];			
			$a['no_pintu'] = $val['pool_code'].' '.$val['hull_number'];
			$a['police_number'] = $val['police_number'];
			$a['driver_name'] = $val['driver_name'];
			$a['closed_date'] = $val['lostfound_status'] == 3 ? $val['date_updated'] : 0;
			array_push($arr['lostfound'], $a);									
		}	
		if($id_pool == 0)
			$name = 'Unknown';
		else if($id_pool == 99)	
			$name = 'CC / Shelter';
		else
			$name = $arrPool[0]['name'];
			
		$this->load->view('header');
		$this->load->view('callcenter', Array('data' => $arr, 'date' => $date, 'name' => $name));
		$this->load->view('footer');	
	}
	
	function check_pool($arrPoolKode, $code){
		foreach((Array) $arrPoolKode AS $key => $val){
			if(strcasecmp($val['kode'],trim($code)) == 0){				 
				return $val['id_pool'];
			}
		}
		return 0;
	}
	
	function getPoolKode($arrPoolKode, $code, $isNotPool){
		$str = array();
		if(!$isNotPool){
			foreach((Array) $arrPoolKode AS $key => $val){
				if($val['id_pool'] === trim($code)){
					array_push($str, $val['kode']);
				}
			}
		} else {
			foreach((Array) $arrPoolKode AS $key => $val){
				array_push($str, $val['kode']);
			}
		}
		return $str;
	}
}
