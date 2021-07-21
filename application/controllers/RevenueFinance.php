<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Admin.php');
class RevenueFinance extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');	
	}
	
	public function index($date = '')
	{
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d',strtotime("-1 days"))))
			$date = date('Y-m-d',strtotime("-1 days"));
		
		//CHECK LAST UPDATE
		$check = $this->dashboard_model->check_rev();
		if(!$check){
// 			$this->backup_revenue_this_week();
			$check = date('j F Y H:i:s');
		} else {
			$datetime = new DateTime($check);
			$check = date('j F Y H:i:s', strtotime($check));
		}

		$data = array();
		$data['pool_reguler'] = $data['pool_reguler2'] = $data['pool_reguler3'] = $data['pool_reguler4'] = $data['eagle'] = $data['tiara'] = array();	
		$data['last_update'] = $check;
		$data['annual_revenue'] = $this->dashboard_model->annual_revenue($date);
		
		$ct_total_fleet = 0;
		$ct_reg_rev = 0;
		$ct_reg_tagihan_operasi = 0;		
		$ct_reg_ks_operasi = 0;
		$ct_reg_spj = 0;
		$ct_reg_ks_non_operasi = 0;
		$ct_reg_angsuran_ks = 0;
		$ct_reg_bayar_hutang = 0;	
		$ct_reg_setoran_telat = 0;
		
		$ct_eagle_rev = 0;
		$ct_eagle_spj = 0;
		$ct_eagle_komisi = 0;
		$ct_eagle_bbm = 0;
		$ct_eagle_gross = 0;
		$ct_eagle_hutang_baru = 0;
		$ct_eagle_lain = 0;
		$ct_eagle_denda = 0;
		$ct_eagle_bayar_hutang = 0;
		
		$ct_tiara_rev = 0;
		$ct_tiara_spj = 0;
		$ct_tiara_komisi = 0;
		$ct_tiara_bbm = 0;
		$ct_tiara_gross = 0;
		$ct_tiara_hutang_baru = 0;
		$ct_tiara_lain = 0;
		$ct_tiara_denda = 0;
		$ct_tiara_bayar_hutang = 0;
		$ct_tiara_insentif = 0;
				
		$arrData = $this->dashboard_model->get_revenue($date);
		if(Count($arrData) == 0){
// 			$arrData = $this->backup_revenue_now($date);
		}
		
		$data['series'] = $this->dashboard_model->get_series_revenue($date);
		$arrTelatSetor = $this->dashboard_model->get_reguler_ks_telat($date);
				
		foreach((Array) $arrData AS $key => $val){
			//REGULER
			if($val['pool_area'] == Admin::AREA_REGULER_1 
				|| $val['pool_area'] == Admin::AREA_REGULER_2
				|| $val['pool_area'] == Admin::AREA_REGULER_3
				|| $val['pool_area'] == Admin::AREA_REGULER_4								
				) {
				$arr = array();
				$arr['id'] = $val['id_pool'];
				$arr['name'] = $val['name'];
				$arr['setoran'] = $val['total_rev'];
				$arr['total_rev'] = $val['total_rev'];
				$arr['total_spj'] = $val['total_spj'];
				$arr['total_arpof'] = $val['total_arpof'];
				$arr['tagihan_operasi'] = $val['tagihan_operasi'];
				$arr['ks_operasi'] = $val['ks_operasi'];
				$arr['ks_non_operasi'] = $val['ks_non_operasi'];
				$arr['ksmurni_ytd'] = $val['ksmurni_ytd'];
				$arr['kstp_ytd'] = $val['kstp_ytd'];
				$arr['ks_total_ytd'] = $val['ks_total_ytd'];
				$arr['ksmurni_mtd'] = $val['ksmurni_mtd'];
				$arr['kstp_mtd'] = $val['kstp_mtd'];				
				$arr['ks_total_mtd'] = $val['ks_total_mtd'];				
				$arr['bayar_hutang'] = $val['bayar_hutang'];	
				$arr['total_cash_inflow'] = $val['total_rev'] + $val['bayar_hutang'] + $val['angsuran_ks'];	
				$arr['total_spj_telat'] = $this->get_total_spj_telat($arrTelatSetor, $arr['id']);
				$arr['total_spj_setor'] = $arr['total_spj'] - $arr['total_spj_telat'];	
				$arr['total_spj_telat_sudah_setor'] = $this->get_total_spj_telat_sudah_setor($arrTelatSetor, $arr['id']);
				$arr['total_setoran_spj_telat'] = $val['total_setoran_telat'];
				$arr['total_spj_sudah_setor'] = $arr['total_spj_setor'] + $arr['total_spj_telat_sudah_setor'];
				$arr['total_setoran_sudah_setor'] = $arr['setoran'] + $arr['total_setoran_spj_telat'];
				$arr['ks_after_bayar_telat'] = $arr['ks_operasi'] + $arr['total_setoran_spj_telat'];
				$arr['angsuran_ks'] = $val['angsuran_ks'] - $arr['total_setoran_spj_telat'];		
				$arr['total_tagihan'] = $arr['setoran'] + $arr['total_setoran_spj_telat'] - $arr['ks_after_bayar_telat'] - $arr['ks_non_operasi'];				
				$arr['pct_ks'] = -$arr['ks_after_bayar_telat'] / ($arr['total_tagihan'] > 0 ? $arr['total_tagihan'] : 1) * 100;
				
				$ct_reg_rev += $arr['total_rev'];
				$ct_reg_tagihan_operasi += $arr['tagihan_operasi'];
				$ct_reg_ks_operasi += $arr['ks_operasi'] + $arr['total_setoran_spj_telat'];
				$ct_reg_spj += $arr['total_spj'];
				$ct_reg_ks_non_operasi += $arr['ks_non_operasi'];
				$ct_reg_angsuran_ks += $arr['angsuran_ks'];
				$ct_reg_bayar_hutang += $arr['bayar_hutang'];
				$ct_reg_setoran_telat += $arr['total_setoran_spj_telat'];

				if($val['pool_area'] == Admin::AREA_REGULER_1)
					array_push($data['pool_reguler'], $arr);
				else if($val['pool_area'] == Admin::AREA_REGULER_2)
					array_push($data['pool_reguler2'], $arr);
				else if($val['pool_area'] == Admin::AREA_REGULER_3)
					array_push($data['pool_reguler3'], $arr);
				else if($val['pool_area'] == Admin::AREA_REGULER_4)
					array_push($data['pool_reguler4'], $arr);					
			}
			
			//EAGLE
			if($val['pool_area'] === '4') { 
				$arr = array();
				$arr['id'] = $val['id_pool'];
				$arr['name'] = $val['name'];
				$arr['total_rev'] = $val['total_rev'];
				$arr['total_spj'] = $val['total_spj'];
				$arr['total_gross'] = $val['total_gross'];
				$arr['total_komisi'] = $val['total_komisi'];
				$arr['total_bbm'] = $val['total_bbm'];
				$arr['total_arpof'] = $val['total_arpof'];
				$arr['total_lain'] = $val['total_lain'];
				$arr['total_denda'] = $val['total_denda'];
				$arr['bayar_hutang'] = $val['bayar_hutang'];
				$arr['hutang_baru'] = $val['hutang_baru'];
				$arr['cash_inflow'] = $val['total_rev'] + $val['total_denda'] + $val['bayar_hutang'] + ($val['total_lain'] > 0 ? $val['total_lain'] : 0);								
				$arr['rev_mtd'] = $val['rev_mtd'];
				$arr['spj_mtd'] = $val['spj_mtd'];									
				$arr['rev_ytd'] = $val['rev_ytd'];
				$arr['spj_ytd'] = $val['spj_ytd'];
				
				$ct_eagle_rev += $arr['total_rev'];
				$ct_eagle_spj += $arr['total_spj'];
				$ct_eagle_komisi += $arr['total_komisi'];
				$ct_eagle_bbm += $arr['total_bbm'];
				$ct_eagle_gross += $arr['total_gross'];
				$ct_eagle_hutang_baru += $arr['hutang_baru'];
				$ct_eagle_lain += $arr['total_lain'];
				$ct_eagle_denda += $arr['total_denda'];
				$ct_eagle_bayar_hutang += $arr['bayar_hutang'];
				
				array_push($data['eagle'], $arr);
			}
			
			//TIARA
			if($val['pool_area'] === '5') { 
				$arr = array();
				$arr['id'] = $val['id_pool'];
				$arr['name'] = $val['name'];
				$arr['total_rev'] = $val['total_rev'];
				$arr['total_spj'] = $val['total_spj'];
				$arr['total_gross'] = $val['total_gross'];
				$arr['total_komisi'] = $val['total_komisi'];
				$arr['total_bbm'] = $val['total_bbm'];
				$arr['total_arpof'] = $val['total_arpof'];
				$arr['total_lain'] = $val['total_lain'];
				$arr['total_denda'] = $val['total_denda'];
				$arr['bayar_hutang'] = $val['bayar_hutang'];
				$arr['hutang_baru'] = $val['hutang_baru'];
				$arr['cash_inflow'] = $val['total_rev'] + $val['total_denda'] + $val['bayar_hutang'] + ($val['total_lain'] > 0 ? $val['total_lain'] : 0);				
				$arr['rev_mtd'] = $val['rev_mtd'];
				$arr['spj_mtd'] = $val['spj_mtd'];									
				$arr['rev_ytd'] = $val['rev_ytd'];
				$arr['spj_ytd'] = $val['spj_ytd'];		
				$arr['total_insentif'] = $val['nominal_insentif_kehadiran'];							
				
				$ct_tiara_rev += $arr['total_rev'];
				$ct_tiara_spj += $arr['total_spj'];
				$ct_tiara_komisi += $arr['total_komisi'];
				$ct_tiara_bbm += $arr['total_bbm'];
				$ct_tiara_gross += $arr['total_gross'];
				$ct_tiara_hutang_baru += $arr['hutang_baru'];
				$ct_tiara_lain += $arr['total_lain'];
				$ct_tiara_denda += $arr['total_denda'];
				$ct_tiara_bayar_hutang += $arr['bayar_hutang'];
				$ct_tiara_insentif += $arr['total_insentif'];
				
				array_push($data['tiara'], $arr);
			}
		}
		$data['reguler_setoran'] = $ct_reg_rev;
		$data['reguler_setoran_telat'] = $ct_reg_setoran_telat;
		$data['reguler_tagihan'] = $ct_reg_tagihan_operasi;
		$data['reguler_ks'] = $ct_reg_ks_operasi;
		$data['reguler_ks_non_operasi'] = $ct_reg_ks_non_operasi;
		$data['reguler_spj'] = $ct_reg_spj;
		$data['reguler_angsuran_ks'] = $ct_reg_angsuran_ks;
		$data['reguler_bayar_ks'] = $ct_reg_bayar_hutang;
		$data['reguler_rev'] = $ct_reg_rev + $ct_reg_angsuran_ks + $ct_reg_bayar_hutang + $ct_reg_setoran_telat;
		$data['reguler_total_tagihan'] = $data['reguler_setoran'] + -$data['reguler_ks'] + -$data['reguler_ks_non_operasi'] + $ct_reg_setoran_telat;
		$data['reguler_rate'] = number_format(($data['reguler_ks'] + $data['reguler_ks_non_operasi']) / ($data['reguler_total_tagihan'] > 0 ? $data['reguler_total_tagihan'] : 1) * -100, 2);
		
		$data['eagle_rev'] = $ct_eagle_rev;
		$data['eagle_spj'] = $ct_eagle_spj;
		$data['eagle_komisi'] = $ct_eagle_komisi;
		$data['eagle_bbm'] = $ct_eagle_bbm;
		$data['eagle_gross'] = $ct_eagle_gross;
		$data['eagle_hutang_baru'] = $ct_eagle_hutang_baru;
		$data['eagle_lain'] = $ct_eagle_lain;
		$data['eagle_denda'] = $ct_eagle_denda;
		$data['eagle_bayar_hutang'] = $ct_eagle_bayar_hutang;
		$data['eagle_cash_inflow'] = $ct_eagle_rev + $ct_eagle_denda + $ct_eagle_bayar_hutang + ($ct_eagle_lain > 0 ? $ct_eagle_lain : 0);
		
		$data['tiara_rev'] = $ct_tiara_rev;
		$data['tiara_spj'] = $ct_tiara_spj;
		$data['tiara_komisi'] = $ct_tiara_komisi;
		$data['tiara_bbm'] = $ct_tiara_bbm;
		$data['tiara_gross'] = $ct_tiara_gross;
		$data['tiara_hutang_baru'] = $ct_tiara_hutang_baru;
		$data['tiara_lain'] = $ct_tiara_lain;
		$data['tiara_denda'] = $ct_tiara_denda;
		$data['tiara_bayar_hutang'] = $ct_tiara_bayar_hutang;
		$data['tiara_cash_inflow'] = $ct_tiara_rev + $ct_tiara_denda + $ct_tiara_bayar_hutang + ($ct_tiara_lain > 0 ? $ct_tiara_lain : 0);
		$data['tiara_insentif'] = $ct_tiara_insentif;
		
		$data['total_rev'] = $data['reguler_rev'] + $data['eagle_cash_inflow'] + $data['tiara_cash_inflow'];
		$data['total_op'] = $data['reguler_spj'] + $data['eagle_spj'] + $data['tiara_spj'];
		$data['total_arof'] = $data['total_rev'] / ($data['total_op'] > 0 ? $data['total_op'] : 1);				
		
		$yest = Count($data['series']['revs']) >= 2 ? $data['series']['revs'][Count($data['series']['revs']) - 2]['total_rev'] : 0;
		$data['rev_yest'] = ($data['total_rev'] - $yest) / ($yest > 0 ? $yest : 1) * 100;
		
		$this->load->view('header');
		$this->load->view('revenueFinance', Array('data' => $data, 'date' => $date));
		$this->load->view('footer');
	}
}
