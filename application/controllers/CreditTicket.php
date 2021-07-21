<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('api/Api.php');
ini_set('max_execution_time', 600); 
ini_set('memory_limit','2048M');

include_once('Admin.php');
class CreditTicket extends Api {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');
		$this->load->model('etaxi_model');
		$this->load->model('etaxi_dashboard_model');
		$this->load->model('m_tiket');		
	}
	
	public function DetailCreditTicket(){
		
		$creditTicketEtaxi['NOMORETAXI'] = $this->m_tiket->dataDetailCreditTicketEtaxi();
		$dataCT['data_ct_ada_etaxi'] = $this->m_tiket->cekDataDiMasterSimtaxEtaxi($creditTicketEtaxi['NOMORETAXI']);
		$dataCT['data_ct_tidak_ada_etaxi'] = $this->m_tiket->cekDataYangTidakAdaDiMasterCTEtaxi($dataCT['data_ct_ada_etaxi']);
		
		$creditTicketEagle['NOMOR'] = $this->m_tiket->dataDetailCreditTicketEagle();
		$dataCT['data_ct_ada'] = $this->m_tiket->cekDataDiMasterSimtax($creditTicketEagle['NOMOR']);
		$dataCT['data_ct_tidak_ada'] = $this->m_tiket->cekDataYangTidakAdaDiMasterCT($dataCT['data_ct_ada']);
		
		
		$creditTicketTiara['NOMORTIARA'] = $this->m_tiket->dataDetailCreditTicketTiara();
		$dataCT['data_ct_ada_tiara'] = $this->m_tiket->cekDataDiMasterSimtax($creditTicketTiara['NOMORTIARA']);
		$dataCT['data_ct_tidak_ada_tiara'] = $this->m_tiket->cekDataYangTidakAdaDiMasterCTTiara($dataCT['data_ct_ada_tiara']);
		
		$this->load->view('header');
		$this->load->view('creditTicketEagle', $dataCT);
		$this->load->view('footer');
	}
	
	function prosesCT1()
	{   
            $start = date('Y-m-d',strtotime("-4 days"));
            $end = date('Y-m-d');
            $data = array();
            $this->load->model('simtax_bekasi_b_model');
            $this->load->model('simtax_bekasi_c_model');
            //$this->load->model('simtax_bekasi_d_model');
			$this->load->model('simtax_bintaro_model');
            $this->load->model('simtax_ciganjur_model');
            $bekasi_b = $this->simtax_bekasi_b_model->dataCreditTicket($start, $end);
            $bekasi_c = $this->simtax_bekasi_c_model->dataCreditTicket($start, $end);
            //$bekasi_d = $this->simtax_bekasi_d_model->dataSetoran($start, $end);
            $bintaro = $this->simtax_bintaro_model->dataCreditTicket($start, $end);
            $ciganjur = $this->simtax_ciganjur_model->dataCreditTicket($start, $end);

            $arrData = array();
            array_push($arrData, $bekasi_b);
           array_push($arrData, $bekasi_c);
            //array_push($arrData, $bekasi_d);
            array_push($arrData, $bintaro);
            array_push($arrData, $ciganjur);
            
            foreach((Array) $arrData AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();

								$arr['ct_no'] = $val['ct_no'];
                                $arr['ct_released_date'] = $val['ct_released_date'];
                                $arr['costumer_id'] = $val['costumer_id'];
                                $arr['costumer_name'] = $val['costumer_name'];
                                $arr['trid'] = $val['trid'];
                                $arr['trcode'] = $val['trcode'];
                                $arr['trdate'] = $val['trdate'];
                                $arr['setoran_code'] = $val['setoran_code'];
                                $arr['spj_code'] = $val['spj_code'];
                                $arr['used_date'] = $val['used_date'];
                                $arr['used_by'] = $val['used_by'];
                                $arr['owner_pt_id'] = $val['owner_pt_id'];
                                $arr['used_value'] = $val['used_value'];
                                $arr['used_poolid'] = $val['used_poolid'];
                                $arr['used_ptid'] = $val['used_ptid'];
                                $arr['driver_id'] = $val['driver_id'];
                                $arr['driver_name'] = $val['driver_name'];
                                $arr['car_id'] = $val['car_id'];
                                $arr['no_pintu'] = $val['no_pintu'];
                                $arr['status_invoice'] = $val['status_invoice'];
                                $arr['no_invoice'] = $val['no_invoice'];
                                $arr['purpose'] = $val['purpose'];
                                $arr['status_double'] = $val['status_double'];
                                
                                
                                array_push($data, $arr);
			}
		}
                
                $this->load->model('dashboard_model');
		
		//INSERT NEW BACKUP FILES
		$this->dashboard_model->insertCreditTicket($data);
		
		return $this->_print('SUCCESS!');
            
	}
        
        function prosesCT2()
	{   
            $start = date('Y-m-d',strtotime("-4 days"));
            $end = date('Y-m-d');
            $data = array();
            
            $this->load->model('simtax_cipayung_model');
            $this->load->model('simtax_cipendawa_model');
            //$this->load->model('simtax_cipondoh_a_model');
            $this->load->model('simtax_cipondoh_b_model');
            $this->load->model('simtax_cipondoh_c_model');
            $cipayung = $this->simtax_cipayung_model->dataCreditTicket($start, $end);
            $cipendawa = $this->simtax_cipendawa_model->dataCreditTicket($start, $end);
            //$cipondoh_a = $this->simtax_cipondoh_a_model->dataCreditTicket($start, $end);
            $cipondoh_b = $this->simtax_cipondoh_b_model->dataCreditTicket($start, $end);
            $cipondoh_c = $this->simtax_cipondoh_c_model->dataCreditTicket($start, $end);

            $arrData = array();
            array_push($arrData, $cipayung);
            array_push($arrData, $cipendawa);
            //array_push($arrData, $cipondoh_a);
            array_push($arrData, $cipondoh_b);
            array_push($arrData, $cipondoh_c);
            
            foreach((Array) $arrData AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['ct_no'] = $val['ct_no'];
                                $arr['ct_released_date'] = $val['ct_released_date'];
                                $arr['costumer_id'] = $val['costumer_id'];
                                $arr['costumer_name'] = $val['costumer_name'];
                                $arr['trid'] = $val['trid'];
                                $arr['trcode'] = $val['trcode'];
                                $arr['trdate'] = $val['trdate'];
                                $arr['setoran_code'] = $val['setoran_code'];
                                $arr['spj_code'] = $val['spj_code'];
                                $arr['used_date'] = $val['used_date'];
                                $arr['used_by'] = $val['used_by'];
                                $arr['owner_pt_id'] = $val['owner_pt_id'];
                                $arr['used_value'] = $val['used_value'];
                                $arr['used_poolid'] = $val['used_poolid'];
                                $arr['used_ptid'] = $val['used_ptid'];
                                $arr['driver_id'] = $val['driver_id'];
                                $arr['driver_name'] = $val['driver_name'];
                                $arr['car_id'] = $val['car_id'];
                                $arr['no_pintu'] = $val['no_pintu'];
                                $arr['status_invoice'] = $val['status_invoice'];
                                $arr['no_invoice'] = $val['no_invoice'];
                                $arr['purpose'] = $val['purpose'];
                                $arr['status_double'] = $val['status_double'];
                                
                                
                                array_push($data, $arr);
			}
		}
                
                $this->load->model('dashboard_model');
		
		//INSERT NEW BACKUP FILES
		$this->dashboard_model->insertCreditTicket($data);
		
		return $this->_print('SUCCESS!');
            
	}
        
         function prosesCT3()
	{   
            $start = date('Y-m-d',strtotime("-4 days"));
            $end = date('Y-m-d');
            $data = array();
            $this->load->model('simtax_depok_model');
            $this->load->model('simtax_jagakarsa_model');
            $this->load->model('simtax_joglo_baru_model');
            $this->load->model('simtax_joglo_model');
            $this->load->model('simtax_mustikasari_model');
            $depok = $this->simtax_depok_model->dataCreditTicket($start, $end);
            $jagakarsa = $this->simtax_jagakarsa_model->dataCreditTicket($start, $end);
            $joglo_baru = $this->simtax_joglo_baru_model->dataCreditTicket($start, $end);
            $joglo = $this->simtax_joglo_model->dataCreditTicket($start, $end);
            $mustikasari = $this->simtax_mustikasari_model->dataCreditTicket($start, $end);

            $arrData = array();
            array_push($arrData, $depok);
            array_push($arrData, $jagakarsa);
            array_push($arrData, $joglo_baru);
            array_push($arrData, $joglo);
            array_push($arrData, $mustikasari);
            
            foreach((Array) $arrData AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['ct_no'] = $val['ct_no'];
                                $arr['ct_released_date'] = $val['ct_released_date'];
                                $arr['costumer_id'] = $val['costumer_id'];
                                $arr['costumer_name'] = $val['costumer_name'];
                                $arr['trid'] = $val['trid'];
                                $arr['trcode'] = $val['trcode'];
                                $arr['trdate'] = $val['trdate'];
                                $arr['setoran_code'] = $val['setoran_code'];
                                $arr['spj_code'] = $val['spj_code'];
                                $arr['used_date'] = $val['used_date'];
                                $arr['used_by'] = $val['used_by'];
                                $arr['owner_pt_id'] = $val['owner_pt_id'];
                                $arr['used_value'] = $val['used_value'];
                                $arr['used_poolid'] = $val['used_poolid'];
                                $arr['used_ptid'] = $val['used_ptid'];
                                $arr['driver_id'] = $val['driver_id'];
                                $arr['driver_name'] = $val['driver_name'];
                                $arr['car_id'] = $val['car_id'];
                                $arr['no_pintu'] = $val['no_pintu'];
                                $arr['status_invoice'] = $val['status_invoice'];
                                $arr['no_invoice'] = $val['no_invoice'];
                                $arr['purpose'] = $val['purpose'];
                                $arr['status_double'] = $val['status_double'];
                                
                                
                                array_push($data, $arr);
			}
		}
                
                $this->load->model('dashboard_model');
		
		//INSERT NEW BACKUP FILES
		$this->dashboard_model->insertCreditTicket($data);
		
		return $this->_print('SUCCESS!');
            
	}
        
        function prosesCT4()
	{   
            $start = date('Y-m-d',strtotime("-4 days"));
            $end = date('Y-m-d');
            $data = array();
            $this->load->model('simtax_mustikasari_model');
            $this->load->model('simtax_padang_model');
            $this->load->model('simtax_pekapuran_model');
            $this->load->model('simtax_pondok_bambu_model');
            $this->load->model('simtax_star_model');
            $this->load->model('simtax_tangsel_model');
            $mustikasari = $this->simtax_mustikasari_model->dataCreditTicket($start, $end);
            $padang = $this->simtax_padang_model->dataCreditTicket($start, $end);
            $pekapuran = $this->simtax_pekapuran_model->dataCreditTicket($start, $end);
            $pondok_bambu = $this->simtax_pondok_bambu_model->dataCreditTicket($start, $end);
            $star = $this->simtax_star_model->dataCreditTicket($start, $end);
            $tangsel = $this->simtax_tangsel_model->dataCreditTicket($start, $end);

            $arrData = array();
            array_push($arrData, $mustikasari);
            array_push($arrData, $padang);
            array_push($arrData, $pekapuran);
            array_push($arrData, $pondok_bambu);
            array_push($arrData, $star);
            array_push($arrData, $tangsel);
            
            foreach((Array) $arrData AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['ct_no'] = $val['ct_no'];
                                $arr['ct_released_date'] = $val['ct_released_date'];
                                $arr['costumer_id'] = $val['costumer_id'];
                                $arr['costumer_name'] = $val['costumer_name'];
                                $arr['trid'] = $val['trid'];
                                $arr['trcode'] = $val['trcode'];
                                $arr['trdate'] = $val['trdate'];
                                $arr['setoran_code'] = $val['setoran_code'];
                                $arr['spj_code'] = $val['spj_code'];
                                $arr['used_date'] = $val['used_date'];
                                $arr['used_by'] = $val['used_by'];
                                $arr['owner_pt_id'] = $val['owner_pt_id'];
                                $arr['used_value'] = $val['used_value'];
                                $arr['used_poolid'] = $val['used_poolid'];
                                $arr['used_ptid'] = $val['used_ptid'];
                                $arr['driver_id'] = $val['driver_id'];
                                $arr['driver_name'] = $val['driver_name'];
                                $arr['car_id'] = $val['car_id'];
                                $arr['no_pintu'] = $val['no_pintu'];
                                $arr['status_invoice'] = $val['status_invoice'];
                                $arr['no_invoice'] = $val['no_invoice'];
                                $arr['purpose'] = $val['purpose'];
                                $arr['status_double'] = $val['status_double'];
                                
                                
                                array_push($data, $arr);
			}
		}
                
                $this->load->model('dashboard_model');
		
		//INSERT NEW BACKUP FILES
		$this->dashboard_model->insertCreditTicket($data);
		
		return $this->_print('SUCCESS!');
            
	}
	
	
        
       
        
        
        
        
	
	
}
