<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Admin.php');
class Inventory extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');			
	}
	
	public function index($date = '')
	{
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d')))
			$date = date('Y-m-d');

		//CHECK LAST UPDATE
		$arr = array();
		$arrData = $this->dashboard_model->get_inventory_pool_area($date);
		$arr['inventory'] = array();
		
		foreach((Array) $arrData AS $key => $val){
			$isFound = false;
			foreach((Array) $arr['inventory'] AS $key2 => $val2){
				if($val2['id_item'] === $val['id_item']){
					if($val['pool_area'] == Admin::AREA_REGULER_1){
						$arr['inventory'][$key2]['qty1'] = $val['qty'];
					}	
					else if($val['pool_area'] == Admin::AREA_REGULER_2){
						$arr['inventory'][$key2]['qty2'] = $val['qty'];
					}
					else if($val['pool_area'] == Admin::AREA_REGULER_3){
						$arr['inventory'][$key2]['qty3'] = $val['qty'];
					}
					else if($val['pool_area'] == Admin::AREA_REGULER_4){
						$arr['inventory'][$key2]['qty4'] = $val['qty'];
					}										
					$isFound = true;
				}
			}				
			if(!$isFound){
				$a = array();
				$a['namepart'] = $val['namepart'];			
				$a['satuan'] = $val['satuan'];	
				$a['jenis'] = $val['jenis'];
				$a['id_item'] = $val['id_item'];
				if($val['pool_area'] == Admin::AREA_REGULER_1){
					$a['qty1'] = $val['qty'];
					$a['qty2'] = 0;
					$a['qty4'] = 0;
					$a['qty3'] = 0;
				}	
				else if($val['pool_area'] == Admin::AREA_REGULER_2){
					$a['qty2'] = $val['qty'];
					$a['qty1'] = 0;
					$a['qty4'] = 0;
					$a['qty3'] = 0;					
				}
				else if($val['pool_area'] == Admin::AREA_REGULER_3){
					$a['qty3'] = $val['qty'];
					$a['qty1'] = 0;
					$a['qty2'] = 0;
					$a['qty4'] = 0;					
				}
				else if($val['pool_area'] == Admin::AREA_REGULER_4){
					$a['qty4'] = $val['qty'];
					$a['qty1'] = 0;
					$a['qty2'] = 0;
					$a['qty3'] = 0;					
				} 
				array_push($arr['inventory'], $a);	
			}
		}
		$this->load->view('header');
		$this->load->view('inventory', Array('data' => $arr, 'date' => $date));
		$this->load->view('footer');	
	}
	
	function pool(){
		$id = $_GET['id'];
		$date = $_GET['date'];
		$area = $_GET['area'];	
		
		$data = $this->dashboard_model->get_inventory_pool($id, $date, $area);
		
		$this->load->view('inventory_pool', Array('data'=> $data));			
	}
}
