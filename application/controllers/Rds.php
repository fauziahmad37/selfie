<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Admin.php');
class Rds extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('xone_model');
		$this->load->model('xone_tiara_model');
		$this->load->model('dashboard_model');		
	}
	
	public function index()
	{
		$isChecker = false;
		if($this->user['id_privilege'] === '7'){
			$isChecker = true;
			$areaChecker = $this->user['pool'];
			$arrAreaChecker = $this->dashboard_model->get_area_checker($areaChecker);
		}
		$date = date('Y-m-d H:i:s');
		$arrData = $this->xone_model->get_rds_status();
		$this->xone_tiara_model->load_database();
		$arrDataTiara = $this->xone_tiara_model->get_rds_status(true);
		$arrDataEagleHigh = $this->xone_tiara_model->get_rds_status(false);				
		$this->xone_tiara_model->close_database();
		$arrPool = $this->dashboard_model->get_pools();
		$data = array();
		$data['area_1'] = $data['area_2'] = $data['area_3'] = $data['area_4'] = $data['area_eagle'] = $data['area_tiara'] = $data['area_checker'] = $data['area_eagle_high'] = array();
		$data['total_connected'] = 0;
		$data['total_error'] = 0;
		$data['total_argo'] = 0;
		$data['total_none'] = 0;
		$data['total_na'] = 0;
		$data['total_total'] = 0;
		$data['total_normal'] = 0;
		foreach((Array) $arrData AS $key => $val){
			$a = array();
			if(!isset($val['pool_id'])) continue;
			$a['id'] = $this->arrPool[$val['pool_id']];
			
			if($isChecker){
				$isFoundAreaChecker = false;			
				foreach((Array) $arrAreaChecker AS $keyChecker => $valChecker){
					if($valChecker['id_pool'] == $a['id']) {
						$isFoundAreaChecker = true;
						break;	
					}
				}
				if(!$isFoundAreaChecker) continue;
			}
			
			$a['name'] = $this->getPoolName($arrPool, $a['id']);
			$a['connected'] = $val['connected'];
			$a['error'] = $val['error'];
			$a['argo'] = $val['argo'];
			$a['none'] = $val['none'];
			$a['na'] = $val['na'];	
			$a['total'] = $val['total'];
			$a['fail'] = $val['fail'];
			$a['manual'] = $val['manual'];						
			$a['normal'] = $a['total'] - $a['na'];				
			$a['area'] = $this->getPoolArea($arrPool, $a['id']);					
			
			$data['total_connected'] += $a['connected'];
			$data['total_error'] += $a['error'];
			$data['total_argo'] += $a['argo'];
			$data['total_none'] += $a['none'];
			$data['total_na'] += $a['na'];
			$data['total_total'] += $a['total'];
			$data['total_normal'] += $a['normal'];
			
			if(!$isChecker){						
				if($a['area'] == 1){
					array_push($data['area_1'], $a);
				} else if($a['area'] == 2){
					array_push($data['area_2'], $a);
				} else if($a['area'] == 4){
					array_push($data['area_eagle'], $a);
				} else if($a['area'] == 5){
					array_push($data['area_tiara'], $a);
				} else if($a['area'] == 6){
					array_push($data['area_3'], $a);
				} else if($a['area'] == 7){
					array_push($data['area_4'], $a);
				}
			}
			if($isChecker){
				array_push($data['area_checker'], $a);
			}

		}
		
		foreach((Array) $arrDataTiara AS $key => $val){
			$a = array();
			//$a['id'] = '33';
			if ($val['pool_id'] == 24){
			$a['id'] = '33';
			} else if ($val['pool_id'] == 29) {
				$a['id'] = '62';
			} else if ($val['pool_id'] == 31) {
				$a['id'] = '63';
			} else if ($val['pool_id'] == 28) {
				$a['id'] = '61';
			}
			
			/*$a = array(
            'id'  =>  '33'
						); */
						//$a['id'] = $this->arrPoolTiara[$val['pool_id']];
						
			
			
			if($isChecker){
				$isFoundAreaChecker = false;			
				foreach((Array) $arrAreaChecker AS $keyChecker => $valChecker){
					if($valChecker['id_pool'] == $a['id']) {
						$isFoundAreaChecker = true;
						break;	
					}
				}
				if(!$isFoundAreaChecker) continue;
			}
			
			$a['name'] = $this->getPoolName($arrPool, $a['id']);
			
			$a['connected'] = $val['connected'];
			$a['error'] = $val['error'];
			$a['argo'] = $val['argo'];
			$a['none'] = $val['none'];
			$a['na'] = $val['na'];	
			$a['total'] = $val['total'];
			$a['fail'] = $val['fail'];		
			$a['manual'] = $val['manual'];				
			$a['area'] = $this->getPoolArea($arrPool, $a['id']);	
			$a['normal'] = $a['total'] - $a['na'];	
			
			$data['total_connected'] += $a['connected'];
			$data['total_error'] += $a['error'];
			$data['total_argo'] += $a['argo'];
			$data['total_none'] += $a['none'];
			$data['total_na'] += $a['na'];
			$data['total_total'] += $a['total'];
			$data['total_normal'] += $a['normal'];

			if(!$isChecker){						
				if($a['area'] == 1){
					array_push($data['area_1'], $a);
				} else if($a['area'] == 2){
					array_push($data['area_2'], $a);
				} else if($a['area'] == 4){
					array_push($data['area_eagle'], $a);
				} else if($a['area'] == 5){
					array_push($data['area_tiara'], $a);
				}
			}
			if($isChecker){
				array_push($data['area_checker'], $a);
			}
		}
		
		foreach((Array) $arrDataEagleHigh AS $key => $val){
			$a = array();
			$a['id'] = '99';
			
			if($isChecker){
				$isFoundAreaChecker = false;			
				foreach((Array) $arrAreaChecker AS $keyChecker => $valChecker){
					if($valChecker['id_pool'] == $a['id']) {
						$isFoundAreaChecker = true;
						break;	
					}
				}
				if(!$isFoundAreaChecker) continue;
			}
			
			$a['name'] = 'Eagle High';
			$a['connected'] = $val['connected'];
			$a['error'] = $val['error'];
			$a['argo'] = $val['argo'];
			$a['none'] = $val['none'];
			$a['na'] = $val['na'];	
			$a['total'] = $val['total'];
			$a['fail'] = $val['fail'];		
			$a['manual'] = $val['manual'];				
			$a['area'] = 'eagle_high';
			$a['normal'] = $a['total'] - $a['na'];
			
			array_push($data['area_eagle_high'], $a);
		}
		
		usort($data['area_1'], function($a, $b) {
			return $a['id'] - $b['id'];
		});
		usort($data['area_2'], function($a, $b) {
			return $a['id'] - $b['id'];
		});
		usort($data['area_3'], function($a, $b) {
			return $a['id'] - $b['id'];
		});
		usort($data['area_4'], function($a, $b) {
			return $a['id'] - $b['id'];
		});
		usort($data['area_eagle'], function($a, $b) {
			return $a['id'] - $b['id'];
		});
		usort($data['area_tiara'], function($a, $b) {
			return $a['id'] - $b['id'];
		});
		$data['total_trouble'] = $data['total_error'] + $data['total_argo'] + $data['total_none'] + $data['total_na'];		
		$data['pct_na'] = number_format($data['total_trouble'] / ($data['total_total'] > 0 ? (2 * $data['total_total']) : 1) * 100, 2);
		
		$this->load->view('header');
		$this->load->view('rds', Array('data' => $data, 'date' => $date));
		$this->load->view('footer');	
	}
	
	public function Detail(){
		$id = $_GET['id'];
		$date = date('Y-m-d H:i:s');
		$is_tiara = false;
		
		$isChecker = false;
		if($this->user['id_privilege'] === '7'){
			$isChecker = true;
			$areaChecker = $this->user['pool'];
			$arrAreaChecker = $this->dashboard_model->get_area_checker($areaChecker);
		}
		
		if($isChecker){
			$isFoundAreaChecker = false;			
			foreach((Array) $arrAreaChecker AS $keyChecker => $valChecker){
				if($valChecker['id_pool'] == $id) {
					$isFoundAreaChecker = true;
					break;	
				}
			}
			if(!$isFoundAreaChecker) return show_404();
		}
		
		if($id == 33){
			$arrData = $this->xone_tiara_model->get_rds_status_detail(24);
			$data['fail'] = $this->xone_tiara_model->get_rds_fail_login_detail(24);
			$is_tiara = true;			
		} else if($id == 62){
			$arrData = $this->xone_tiara_model->get_rds_status_detail(29);
			$data['fail'] = $this->xone_tiara_model->get_rds_fail_login_detail(29);
			$is_tiara = true;			
		} else if($id == 63){
			$arrData = $this->xone_tiara_model->get_rds_status_detail(31);
			$data['fail'] = $this->xone_tiara_model->get_rds_fail_login_detail(31);
			$is_tiara = true;			
		}else if($id == 61){
			$arrData = $this->xone_tiara_model->get_rds_status_detail(28);
			$data['fail'] = $this->xone_tiara_model->get_rds_fail_login_detail(28);
			$is_tiara = true;			
		}else if($id == 99){
			$arrData = $this->xone_tiara_model->get_rds_status_detail(26);
			$data['fail'] = $this->xone_tiara_model->get_rds_fail_login_detail(26);
			$is_tiara = true;			
		} else {
			$arrData = $this->xone_model->get_rds_status_detail($this->translate_xone($id));		
			$data['fail'] = $this->xone_model->get_rds_fail_login_detail($this->translate_xone($id));					
		}
		$arrPool = $this->dashboard_model->get_pools();
		
		$name = $this->getPoolName($arrPool, $id);
		if($id == 99) {
			$name = 'Eagle High';
		}
		$data['total_connected'] = 0;
		$data['total_error'] = 0;
		$data['total_argo'] = 0;
		$data['total_none'] = 0;
		$data['total_na'] = 0;
		$data['total_total'] = 0;
		$data['total_normal'] = 0;
		ini_set('memory_limit', '512M');	
		foreach((Array) $arrData AS $key => $a){
			if($a['status'] === 'All Connected')
				$data['total_connected']++;
			else if($a['status'] === 'Error')
				$data['total_error']++;
			else if($a['status'] === 'Argo Not Connected')
				$data['total_argo']++;
			else if($a['status'] === 'None Connected')
				$data['total_none']++;
			if($a['na'] === 'Normal')
				$data['total_normal']++;
			else
				$data['total_na']++;

			$data['total_total']++;

			//STATUS HISTORY
			$arrData[$key]['since'] = 0;			
			if($a['status'] !== 'All Connected' && $id != 99){
				$found = false;
				if(strtotime($a['created']) < strtotime(date('Y-m-d')))
					$res = $this->load_file($is_tiara, $a, $key, date('Ymd', strtotime('-1 days')));
				else 
					$res = array();
				$res = array_merge($res, $this->load_file($is_tiara, $a, $key, date('Ymd')));	
				foreach ($res as $string) {
					$arr = json_decode($string, true);
					if (!empty($arr['v']['type'])) {
						continue;
					}
					if($arr['v']['power_status'] !== null) {
						$obuStatus = $arr['v']['power_status'];
						$argoStatus = ($arr['v']['km'] === null) ? 0: 1;
						if($argoStatus * 2 + $obuStatus == 3){
							$found = false;
							$arrData[$key]['since'] = 0;								
						}
						if($found) continue;
						else if($a['status'] === 'Error' && $argoStatus * 2 + $obuStatus == 0
						|| $a['status'] === 'Argo Not Connected' && $argoStatus * 2 + $obuStatus == 1
						|| $a['status'] === 'None Connected' && $argoStatus * 2 + $obuStatus == 2						
						){
							if(strtotime($arrData[$key]['since']) < strtotime($arr['v']['transaction_time'])){
								$arrData[$key]['since'] = $arr['v']['transaction_time'];
								$found = true;
							}
						}
					}
				}				
			}
		}
		$data['pct_na'] = number_format($data['total_na'] / ($data['total_total'] > 0 ? $data['total_total'] : 1) * 100, 2);
		$data['data'] = $arrData;
		$this->load->view('header');
		$this->load->view('rds_detail', Array('data' => $data, 'name' => $name, 'date' => $date));
		$this->load->view('footer');	
	}
	
	private function load_file($is_tiara, $a, $key, $search_date){
		$log_file = $search_date.'-'.$a['id'].'-'.preg_replace('/\s+/', '', (strtolower($a['reg_no'])));
		$arrData[$key]['since'] = 0;
		$ch = curl_init();
		$header = array(
			'Content-Type: application/json'
		);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if($is_tiara)
			curl_setopt($ch, CURLOPT_URL, 'http://tiara.expressgroup.co.id/app/webroot/files/logger/'.$log_file.'.log');
		else
			curl_setopt($ch, CURLOPT_URL, 'http://eagle.expressgroup.co.id/app/webroot/files/dailylog/'.$log_file.'.log');
		$res = curl_exec($ch);
		$res = explode("\n", $res);
		curl_close($ch);
		return $res;
	}
	
	private function getPoolName($arr, $id){
		foreach((Array) $arr AS $key => $val){
			if($val['id'] === $id) return $val['name'];
		}
		return "";
	}	
	
	private function getPoolArea($arr, $id){
		foreach((Array) $arr AS $key => $val){
			if($val['id'] === $id) return $val['pool_area'];
		}
		return 0;
	}
}
