<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('api/Api.php');
ini_set('max_execution_time', 600); 
ini_set('memory_limit','2048M');

include_once('Admin.php');
class Jurnal extends Api {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');	
	}
	
	function prosesJurnal1()
	{   
            $start = date('Y-m-d',strtotime("-4 days"));
            $end = date('Y-m-d');
            $data = array();
            $this->load->model('simtax_bekasi_b_model');
            $this->load->model('simtax_bekasi_c_model');
            //$this->load->model('simtax_bekasi_d_model');
            $this->load->model('simtax_bintaro_model');
            $this->load->model('simtax_ciganjur_model');
            $bekasi_b = $this->simtax_bekasi_b_model->dataSetoran($start, $end);
            $bekasi_c = $this->simtax_bekasi_c_model->dataSetoran($start, $end);
            //$bekasi_d = $this->simtax_bekasi_d_model->dataSetoran($start, $end);
            $bintaro = $this->simtax_bintaro_model->dataSetoran($start, $end);
            $ciganjur = $this->simtax_ciganjur_model->dataSetoran($start, $end);

            $arrData = array();
            array_push($arrData, $bekasi_b);
            array_push($arrData, $bekasi_c);
            //array_push($arrData, $bekasi_d);
            array_push($arrData, $bintaro);
            array_push($arrData, $ciganjur);
            
            foreach((Array) $arrData AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['trid'] = $val['trid'];
                                $arr['setoran_code'] = $val['setoran_code'];
                                $arr['setoran_date'] = $val['setoran_date'];
                                $arr['spj_code'] = $val['spj_code'];
                                $arr['spj_date'] = $val['spj_date'];
                                $arr['posted'] = $val['posted'];
                                $arr['posted_by'] = $val['posted_by'];
                                $arr['posted_date'] = $val['posted_date'];
                                $arr['car_id'] = $val['car_id'];
                                $arr['no_pintu'] = $val['no_pintu'];
                                $arr['pool_id'] = $val['pool_id'];
                                $arr['owner_pt_id'] = $val['owner_pt_id'];
                                $arr['kip_setor'] = $val['kip_setor'];
                                $arr['nama_setor'] = $val['nama_setor'];
                                $arr['status_operasi'] = $val['status_operasi'];
                                $arr['s_denda'] = $val['s_denda'];
                                $arr['s_waktu_denda'] = $val['s_waktu_denda'];
                                $arr['s_awal_denda'] = $val['s_awal_denda'];
                                $arr['tipe_operasi'] = $val['tipe_operasi'];
                                $arr['note_tab_part'] = $val['note_tab_part'];
                                $arr['note_ks'] = $val['note_ks'];
                                $arr['s_wajib'] = $val['s_wajib'];
                                $arr['s_tab_wajib'] = $val['s_tab_wajib'];
                                $arr['s_lain'] = $val['s_lain'];
                                $arr['s_cuci'] = $val['s_cuci'];
                                $arr['s_laka'] = $val['s_laka'];
                                $arr['s_aqua'] = $val['s_aqua'];
                                $arr['biaya_order'] = $val['biaya_order'];
                                $arr['jam_masuk'] = $val['jam_masuk'];
                                $arr['tambah_denda_perjam'] = $val['tambah_denda_perjam'];
                                $arr['total_denda'] = $val['total_denda'];
                                $arr['terima_cash'] = $val['terima_cash'];
                                $arr['terima_ct'] = $val['terima_ct'];
                                $arr['terima_flash'] = $val['terima_flash'];
                                $arr['terima_express_card'] = $val['terima_express_card'];
                                $arr['total_terima'] = $val['total_terima'];
                                $arr['terima_cuci'] = $val['terima_cuci'];
                                $arr['terima_laka'] = $val['terima_laka'];
                                $arr['terima_aqua'] = $val['terima_aqua'];
                                $arr['terima_order'] = $val['terima_order'];
                                $arr['total_koperasi'] = $val['total_koperasi'];
                                $arr['terima_lain'] = $val['terima_lain'];
                                $arr['total_koperasi'] = $val['total_koperasi'];
                                $arr['terima_denda'] = $val['terima_denda'];
                                $arr['terima_tab_part'] = $val['terima_tab_part'];
                                $arr['terima_tab_part_note'] = $val['terima_tab_part_note'];
                                $arr['total_ks_terbit'] = $val['total_ks_terbit'];
                                $arr['kembali_ct'] = $val['kembali_ct'];
                                $arr['jumlah_bayar_ks'] = $val['jumlah_bayar_ks'];
                                $arr['ks_adjusment'] = $val['ks_adjusment'];
                                $arr['tab_part_adjustment'] = $val['tab_part_adjustment'];
                                $arr['lain_adjusment'] = $val['lain_adjusment'];
                                $arr['released'] = $val['released'];
                                $arr['printed'] = $val['printed'];
                                
                                array_push($data, $arr);
			}
		}
                
                $this->load->model('dashboard_model');
		
		//INSERT NEW BACKUP FILES
		$this->dashboard_model->insertSetoranPusat($data);
                $this->dashboard_model->insertDiskonHist();
		
		return $this->_print('SUCCESS!');
            
	}
        
        function prosesJurnal2()
	{   
            $start = date('Y-m-d',strtotime("-4 days"));
            $end = date('Y-m-d');
            $data = array();
            
            $this->load->model('simtax_cipayung_model');
            $this->load->model('simtax_cipendawa_model');
            //$this->load->model('simtax_cipondoh_a_model');
            $this->load->model('simtax_cipondoh_b_model');
            $this->load->model('simtax_cipondoh_c_model');
            $cipayung = $this->simtax_cipayung_model->dataSetoran($start, $end);
            $cipendawa = $this->simtax_cipendawa_model->dataSetoran($start, $end);
            //$cipondoh_a = $this->simtax_cipondoh_a_model->dataSetoran($start, $end);
            $cipondoh_b = $this->simtax_cipondoh_b_model->dataSetoran($start, $end);
            $cipondoh_c = $this->simtax_cipondoh_c_model->dataSetoran($start, $end);

            $arrData = array();
            array_push($arrData, $cipayung);
            array_push($arrData, $cipendawa);
            //array_push($arrData, $cipondoh_a);
            array_push($arrData, $cipondoh_b);
            array_push($arrData, $cipondoh_c);
            
            foreach((Array) $arrData AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['trid'] = $val['trid'];
                                $arr['setoran_code'] = $val['setoran_code'];
                                $arr['setoran_date'] = $val['setoran_date'];
                                $arr['spj_code'] = $val['spj_code'];
                                $arr['spj_date'] = $val['spj_date'];
                                $arr['posted'] = $val['posted'];
                                $arr['posted_by'] = $val['posted_by'];
                                $arr['posted_date'] = $val['posted_date'];
                                $arr['car_id'] = $val['car_id'];
                                $arr['no_pintu'] = $val['no_pintu'];
                                $arr['pool_id'] = $val['pool_id'];
                                $arr['owner_pt_id'] = $val['owner_pt_id'];
                                $arr['kip_setor'] = $val['kip_setor'];
                                $arr['nama_setor'] = $val['nama_setor'];
                                $arr['status_operasi'] = $val['status_operasi'];
                                $arr['s_denda'] = $val['s_denda'];
                                $arr['s_waktu_denda'] = $val['s_waktu_denda'];
                                $arr['s_awal_denda'] = $val['s_awal_denda'];
                                $arr['tipe_operasi'] = $val['tipe_operasi'];
                                $arr['note_tab_part'] = $val['note_tab_part'];
                                $arr['note_ks'] = $val['note_ks'];
                                $arr['s_wajib'] = $val['s_wajib'];
                                $arr['s_tab_wajib'] = $val['s_tab_wajib'];
                                $arr['s_lain'] = $val['s_lain'];
                                $arr['s_cuci'] = $val['s_cuci'];
                                $arr['s_laka'] = $val['s_laka'];
                                $arr['s_aqua'] = $val['s_aqua'];
                                $arr['biaya_order'] = $val['biaya_order'];
                                $arr['jam_masuk'] = $val['jam_masuk'];
                                $arr['tambah_denda_perjam'] = $val['tambah_denda_perjam'];
                                $arr['total_denda'] = $val['total_denda'];
                                $arr['terima_cash'] = $val['terima_cash'];
                                $arr['terima_ct'] = $val['terima_ct'];
                                $arr['terima_flash'] = $val['terima_flash'];
                                $arr['terima_express_card'] = $val['terima_express_card'];
                                $arr['total_terima'] = $val['total_terima'];
                                $arr['terima_cuci'] = $val['terima_cuci'];
                                $arr['terima_laka'] = $val['terima_laka'];
                                $arr['terima_aqua'] = $val['terima_aqua'];
                                $arr['terima_order'] = $val['terima_order'];
                                $arr['total_koperasi'] = $val['total_koperasi'];
                                $arr['terima_lain'] = $val['terima_lain'];
                                $arr['total_koperasi'] = $val['total_koperasi'];
                                $arr['terima_denda'] = $val['terima_denda'];
                                $arr['terima_tab_part'] = $val['terima_tab_part'];
                                $arr['terima_tab_part_note'] = $val['terima_tab_part_note'];
                                $arr['total_ks_terbit'] = $val['total_ks_terbit'];
                                $arr['kembali_ct'] = $val['kembali_ct'];
                                $arr['jumlah_bayar_ks'] = $val['jumlah_bayar_ks'];
                                $arr['ks_adjusment'] = $val['ks_adjusment'];
                                $arr['tab_part_adjustment'] = $val['tab_part_adjustment'];
                                $arr['lain_adjusment'] = $val['lain_adjusment'];
                                $arr['released'] = $val['released'];
                                $arr['printed'] = $val['printed'];
                                
                                array_push($data, $arr);
			}
		}
                
                $this->load->model('dashboard_model');
		
		//INSERT NEW BACKUP FILES
		$this->dashboard_model->insertSetoranPusat($data);
		
		return $this->_print('SUCCESS!');
            
	}
        
         function prosesJurnal3()
	{   
            $start = date('Y-m-d',strtotime("-4 days"));
            $end = date('Y-m-d');
            $data = array();
            $this->load->model('simtax_depok_model');
            $this->load->model('simtax_jagakarsa_model');
            $this->load->model('simtax_joglo_baru_model');
            $this->load->model('simtax_joglo_model');
            $this->load->model('simtax_mustikasari_model');
            $depok = $this->simtax_depok_model->dataSetoran($start, $end);
            $jagakarsa = $this->simtax_jagakarsa_model->dataSetoran($start, $end);
            $joglo_baru = $this->simtax_joglo_baru_model->dataSetoran($start, $end);
            $joglo = $this->simtax_joglo_model->dataSetoran($start, $end);
            $mustikasari = $this->simtax_mustikasari_model->dataSetoran($start, $end);

            $arrData = array();
            array_push($arrData, $depok);
            array_push($arrData, $jagakarsa);
            array_push($arrData, $joglo_baru);
            array_push($arrData, $joglo);
            array_push($arrData, $mustikasari);
            
            foreach((Array) $arrData AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['trid'] = $val['trid'];
                                $arr['setoran_code'] = $val['setoran_code'];
                                $arr['setoran_date'] = $val['setoran_date'];
                                $arr['spj_code'] = $val['spj_code'];
                                $arr['spj_date'] = $val['spj_date'];
                                $arr['posted'] = $val['posted'];
                                $arr['posted_by'] = $val['posted_by'];
                                $arr['posted_date'] = $val['posted_date'];
                                $arr['car_id'] = $val['car_id'];
                                $arr['no_pintu'] = $val['no_pintu'];
                                $arr['pool_id'] = $val['pool_id'];
                                $arr['owner_pt_id'] = $val['owner_pt_id'];
                                $arr['kip_setor'] = $val['kip_setor'];
                                $arr['nama_setor'] = $val['nama_setor'];
                                $arr['status_operasi'] = $val['status_operasi'];
                                $arr['s_denda'] = $val['s_denda'];
                                $arr['s_waktu_denda'] = $val['s_waktu_denda'];
                                $arr['s_awal_denda'] = $val['s_awal_denda'];
                                $arr['tipe_operasi'] = $val['tipe_operasi'];
                                $arr['note_tab_part'] = $val['note_tab_part'];
                                $arr['note_ks'] = $val['note_ks'];
                                $arr['s_wajib'] = $val['s_wajib'];
                                $arr['s_tab_wajib'] = $val['s_tab_wajib'];
                                $arr['s_lain'] = $val['s_lain'];
                                $arr['s_cuci'] = $val['s_cuci'];
                                $arr['s_laka'] = $val['s_laka'];
                                $arr['s_aqua'] = $val['s_aqua'];
                                $arr['biaya_order'] = $val['biaya_order'];
                                $arr['jam_masuk'] = $val['jam_masuk'];
                                $arr['tambah_denda_perjam'] = $val['tambah_denda_perjam'];
                                $arr['total_denda'] = $val['total_denda'];
                                $arr['terima_cash'] = $val['terima_cash'];
                                $arr['terima_ct'] = $val['terima_ct'];
                                $arr['terima_flash'] = $val['terima_flash'];
                                $arr['terima_express_card'] = $val['terima_express_card'];
                                $arr['total_terima'] = $val['total_terima'];
                                $arr['terima_cuci'] = $val['terima_cuci'];
                                $arr['terima_laka'] = $val['terima_laka'];
                                $arr['terima_aqua'] = $val['terima_aqua'];
                                $arr['terima_order'] = $val['terima_order'];
                                $arr['total_koperasi'] = $val['total_koperasi'];
                                $arr['terima_lain'] = $val['terima_lain'];
                                $arr['total_koperasi'] = $val['total_koperasi'];
                                $arr['terima_denda'] = $val['terima_denda'];
                                $arr['terima_tab_part'] = $val['terima_tab_part'];
                                $arr['terima_tab_part_note'] = $val['terima_tab_part_note'];
                                $arr['total_ks_terbit'] = $val['total_ks_terbit'];
                                $arr['kembali_ct'] = $val['kembali_ct'];
                                $arr['jumlah_bayar_ks'] = $val['jumlah_bayar_ks'];
                                $arr['ks_adjusment'] = $val['ks_adjusment'];
                                $arr['tab_part_adjustment'] = $val['tab_part_adjustment'];
                                $arr['lain_adjusment'] = $val['lain_adjusment'];
                                $arr['released'] = $val['released'];
                                $arr['printed'] = $val['printed'];
                                
                                array_push($data, $arr);
			}
		}
                
                $this->load->model('dashboard_model');
		
		//INSERT NEW BACKUP FILES
		$this->dashboard_model->insertSetoranPusat($data);
		
		return $this->_print('SUCCESS!');
            
	}
        
        function prosesJurnal4()
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
            $mustikasari = $this->simtax_mustikasari_model->dataSetoran($start, $end);
            $padang = $this->simtax_padang_model->dataSetoran($start, $end);
            $pekapuran = $this->simtax_pekapuran_model->dataSetoran($start, $end);
            $pondok_bambu = $this->simtax_pondok_bambu_model->dataSetoran($start, $end);
            $star = $this->simtax_star_model->dataSetoran($start, $end);
            $tangsel = $this->simtax_tangsel_model->dataSetoran($start, $end);

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
				$arr['trid'] = $val['trid'];
                                $arr['setoran_code'] = $val['setoran_code'];
                                $arr['setoran_date'] = $val['setoran_date'];
                                $arr['spj_code'] = $val['spj_code'];
                                $arr['spj_date'] = $val['spj_date'];
                                $arr['posted'] = $val['posted'];
                                $arr['posted_by'] = $val['posted_by'];
                                $arr['posted_date'] = $val['posted_date'];
                                $arr['car_id'] = $val['car_id'];
                                $arr['no_pintu'] = $val['no_pintu'];
                                $arr['pool_id'] = $val['pool_id'];
                                $arr['owner_pt_id'] = $val['owner_pt_id'];
                                $arr['kip_setor'] = $val['kip_setor'];
                                $arr['nama_setor'] = $val['nama_setor'];
                                $arr['status_operasi'] = $val['status_operasi'];
                                $arr['s_denda'] = $val['s_denda'];
                                $arr['s_waktu_denda'] = $val['s_waktu_denda'];
                                $arr['s_awal_denda'] = $val['s_awal_denda'];
                                $arr['tipe_operasi'] = $val['tipe_operasi'];
                                $arr['note_tab_part'] = $val['note_tab_part'];
                                $arr['note_ks'] = $val['note_ks'];
                                $arr['s_wajib'] = $val['s_wajib'];
                                $arr['s_tab_wajib'] = $val['s_tab_wajib'];
                                $arr['s_lain'] = $val['s_lain'];
                                $arr['s_cuci'] = $val['s_cuci'];
                                $arr['s_laka'] = $val['s_laka'];
                                $arr['s_aqua'] = $val['s_aqua'];
                                $arr['biaya_order'] = $val['biaya_order'];
                                $arr['jam_masuk'] = $val['jam_masuk'];
                                $arr['tambah_denda_perjam'] = $val['tambah_denda_perjam'];
                                $arr['total_denda'] = $val['total_denda'];
                                $arr['terima_cash'] = $val['terima_cash'];
                                $arr['terima_ct'] = $val['terima_ct'];
                                $arr['terima_flash'] = $val['terima_flash'];
                                $arr['terima_express_card'] = $val['terima_express_card'];
                                $arr['total_terima'] = $val['total_terima'];
                                $arr['terima_cuci'] = $val['terima_cuci'];
                                $arr['terima_laka'] = $val['terima_laka'];
                                $arr['terima_aqua'] = $val['terima_aqua'];
                                $arr['terima_order'] = $val['terima_order'];
                                $arr['total_koperasi'] = $val['total_koperasi'];
                                $arr['terima_lain'] = $val['terima_lain'];
                                $arr['total_koperasi'] = $val['total_koperasi'];
                                $arr['terima_denda'] = $val['terima_denda'];
                                $arr['terima_tab_part'] = $val['terima_tab_part'];
                                $arr['terima_tab_part_note'] = $val['terima_tab_part_note'];
                                $arr['total_ks_terbit'] = $val['total_ks_terbit'];
                                $arr['kembali_ct'] = $val['kembali_ct'];
                                $arr['jumlah_bayar_ks'] = $val['jumlah_bayar_ks'];
                                $arr['ks_adjusment'] = $val['ks_adjusment'];
                                $arr['tab_part_adjustment'] = $val['tab_part_adjustment'];
                                $arr['lain_adjusment'] = $val['lain_adjusment'];
                                $arr['released'] = $val['released'];
                                $arr['printed'] = $val['printed'];
                                
                                array_push($data, $arr);
			}
		}
                
                $this->load->model('dashboard_model');
		
		//INSERT NEW BACKUP FILES
		$this->dashboard_model->insertSetoranPusat($data);
		
		return $this->_print('SUCCESS!');
            
	}
        
        function prosesJurnalCustom()
	{   
            $start = date('Y-m-d',strtotime("-4 days"));
            $end = date('Y-m-d');
            $data = array();
            $this->load->model('simtax_padang_model');
            $poolcustom = $this->simtax_padang_model->dataSetoran($start, $end);

            $arrData = array();
            array_push($arrData, $poolcustom);
            
            foreach((Array) $arrData AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['trid'] = $val['trid'];
                                $arr['setoran_code'] = $val['setoran_code'];
                                $arr['setoran_date'] = $val['setoran_date'];
                                $arr['spj_code'] = $val['spj_code'];
                                $arr['spj_date'] = $val['spj_date'];
                                $arr['posted'] = $val['posted'];
                                $arr['posted_by'] = $val['posted_by'];
                                $arr['posted_date'] = $val['posted_date'];
                                $arr['car_id'] = $val['car_id'];
                                $arr['no_pintu'] = $val['no_pintu'];
                                $arr['pool_id'] = $val['pool_id'];
                                $arr['owner_pt_id'] = $val['owner_pt_id'];
                                $arr['kip_setor'] = $val['kip_setor'];
                                $arr['nama_setor'] = $val['nama_setor'];
                                $arr['status_operasi'] = $val['status_operasi'];
                                $arr['s_denda'] = $val['s_denda'];
                                $arr['s_waktu_denda'] = $val['s_waktu_denda'];
                                $arr['s_awal_denda'] = $val['s_awal_denda'];
                                $arr['tipe_operasi'] = $val['tipe_operasi'];
                                $arr['note_tab_part'] = $val['note_tab_part'];
                                $arr['note_ks'] = $val['note_ks'];
                                $arr['s_wajib'] = $val['s_wajib'];
                                $arr['s_tab_wajib'] = $val['s_tab_wajib'];
                                $arr['s_lain'] = $val['s_lain'];
                                $arr['s_cuci'] = $val['s_cuci'];
                                $arr['s_laka'] = $val['s_laka'];
                                $arr['s_aqua'] = $val['s_aqua'];
                                $arr['biaya_order'] = $val['biaya_order'];
                                $arr['jam_masuk'] = $val['jam_masuk'];
                                $arr['tambah_denda_perjam'] = $val['tambah_denda_perjam'];
                                $arr['total_denda'] = $val['total_denda'];
                                $arr['terima_cash'] = $val['terima_cash'];
                                $arr['terima_ct'] = $val['terima_ct'];
                                $arr['terima_flash'] = $val['terima_flash'];
                                $arr['terima_express_card'] = $val['terima_express_card'];
                                $arr['total_terima'] = $val['total_terima'];
                                $arr['terima_cuci'] = $val['terima_cuci'];
                                $arr['terima_laka'] = $val['terima_laka'];
                                $arr['terima_aqua'] = $val['terima_aqua'];
                                $arr['terima_order'] = $val['terima_order'];
                                $arr['total_koperasi'] = $val['total_koperasi'];
                                $arr['terima_lain'] = $val['terima_lain'];
                                $arr['total_koperasi'] = $val['total_koperasi'];
                                $arr['terima_denda'] = $val['terima_denda'];
                                $arr['terima_tab_part'] = $val['terima_tab_part'];
                                $arr['terima_tab_part_note'] = $val['terima_tab_part_note'];
                                $arr['total_ks_terbit'] = $val['total_ks_terbit'];
                                $arr['kembali_ct'] = $val['kembali_ct'];
                                $arr['jumlah_bayar_ks'] = $val['jumlah_bayar_ks'];
                                $arr['ks_adjusment'] = $val['ks_adjusment'];
                                $arr['tab_part_adjustment'] = $val['tab_part_adjustment'];
                                $arr['lain_adjusment'] = $val['lain_adjusment'];
                                $arr['released'] = $val['released'];
                                $arr['printed'] = $val['printed'];
                                
                                array_push($data, $arr);
			}
		}
                
                $this->load->model('dashboard_model');
		
		//INSERT NEW BACKUP FILES
		$this->dashboard_model->insertSetoranPusat($data);
		
		return $this->_print('SUCCESS!');
            
	}
        
        function prosesKoreksi1()
	{   
            $start = date('Y-m-d',strtotime("-4 days"));
            $end = date('Y-m-d');
            $data = array();
            $this->load->model('simtax_bekasi_b_model');
            $this->load->model('simtax_bekasi_c_model');
            //$this->load->model('simtax_bekasi_d_model');
            $this->load->model('simtax_bintaro_model');
            $this->load->model('simtax_ciganjur_model'); 
            $bekasi_b = $this->simtax_bekasi_b_model->dataKoreksi($start, $end);
            $bekasi_c = $this->simtax_bekasi_c_model->dataKoreksi($start, $end);
            //$bekasi_d = $this->simtax_bekasi_d_model->dataSetoran($start, $end);
            $bintaro = $this->simtax_bintaro_model->dataKoreksi($start, $end);
            $ciganjur = $this->simtax_ciganjur_model->dataKoreksi($start, $end);

            $arrData = array();
            array_push($arrData, $bekasi_b);
            array_push($arrData, $bekasi_c);
            //array_push($arrData, $bekasi_d);
            array_push($arrData, $bintaro);
            array_push($arrData, $ciganjur); 

 
            foreach((Array) $arrData AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['trid'] = $val['trid'];
                                $arr['trcode'] = $val['trcode'];
                                $arr['trdate'] = $val['trdate'];
                                $arr['owner_pt_id'] = $val['owner_pt_id'];
                                $arr['pool_id'] = $val['pool_id'];
                                $arr['car_id'] = $val['car_id'];
                                $arr['no_pintu'] = $val['no_pintu'];
                                $arr['tipe_operasi'] = $val['tipe_operasi'];
                                $arr['type_koreksi'] = $val['type_koreksi'];
                                $arr['ar_ks_saldo_awal'] = $val['ar_ks_saldo_awal'];
                                $arr['ar_tabsp_awal'] = $val['ar_tabsp_awal'];
                                $arr['ar_lain_awal'] = $val['ar_lain_awal'];
                                $arr['ar_ks_saldo_koreksi'] = $val['ar_ks_saldo_koreksi'];
                                $arr['ar_tabsp_koreksi'] = $val['ar_tabsp_koreksi'];
                                $arr['ar_lain_koreksi'] = $val['ar_lain_koreksi'];
                                $arr['ar_ks_saldo_akhir'] = $val['ar_ks_saldo_akhir'];
                                $arr['ar_tabsp_akhir'] = $val['ar_tabsp_akhir'];
                                $arr['ar_lain_akhir'] = $val['ar_lain_akhir'];
                                $arr['notes'] = $val['notes'];
                                $arr['posted'] = $val['posted'];
                                $arr['posted_by'] = $val['posted_by'];
                                $arr['posted_date'] = $val['posted_date'];
                                $arr['released'] = $val['released'];
                                $arr['printed'] = $val['printed'];
                                $arr['impact'] = $val['impact'];
                                
                                array_push($data, $arr);
			}
		}
                
                $this->load->model('dashboard_model');
		
		//INSERT NEW BACKUP FILES
		//$this->dashboard_model->insertSetoranPusat($data);
                //$this->dashboard_model->insertDiskonHist();
                $this->dashboard_model->insertKoreksiPusat($data);
		
		return $this->_print('SUCCESS!');
            
	}
        
        function prosesKoreksi2()
	{   
            $start = date('Y-m-d',strtotime("-4 days"));
            $end = date('Y-m-d');
            $data = array();
            
            $this->load->model('simtax_cipayung_model');
            $this->load->model('simtax_cipendawa_model');
            $this->load->model('simtax_cipondoh_a_model');
            $this->load->model('simtax_cipondoh_b_model');
            $this->load->model('simtax_cipondoh_c_model');
            $cipayung = $this->simtax_cipayung_model->dataKoreksi($start, $end);
            $cipendawa = $this->simtax_cipendawa_model->dataKoreksi($start, $end);
            $cipondoh_a = $this->simtax_cipondoh_a_model->dataKoreksi($start, $end);
            $cipondoh_b = $this->simtax_cipondoh_b_model->dataKoreksi($start, $end);
            $cipondoh_c = $this->simtax_cipondoh_c_model->dataKoreksi($start, $end);

            $arrData = array();
            array_push($arrData, $cipayung);
            array_push($arrData, $cipendawa);
            array_push($arrData, $cipondoh_a);
            array_push($arrData, $cipondoh_b);
            array_push($arrData, $cipondoh_c);

 
            foreach((Array) $arrData AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['trid'] = $val['trid'];
                                $arr['trcode'] = $val['trcode'];
                                $arr['trdate'] = $val['trdate'];
                                $arr['owner_pt_id'] = $val['owner_pt_id'];
                                $arr['pool_id'] = $val['pool_id'];
                                $arr['car_id'] = $val['car_id'];
                                $arr['no_pintu'] = $val['no_pintu'];
                                $arr['tipe_operasi'] = $val['tipe_operasi'];
                                $arr['type_koreksi'] = $val['type_koreksi'];
                                $arr['ar_ks_saldo_awal'] = $val['ar_ks_saldo_awal'];
                                $arr['ar_tabsp_awal'] = $val['ar_tabsp_awal'];
                                $arr['ar_lain_awal'] = $val['ar_lain_awal'];
                                $arr['ar_ks_saldo_koreksi'] = $val['ar_ks_saldo_koreksi'];
                                $arr['ar_tabsp_koreksi'] = $val['ar_tabsp_koreksi'];
                                $arr['ar_lain_koreksi'] = $val['ar_lain_koreksi'];
                                $arr['ar_ks_saldo_akhir'] = $val['ar_ks_saldo_akhir'];
                                $arr['ar_tabsp_akhir'] = $val['ar_tabsp_akhir'];
                                $arr['ar_lain_akhir'] = $val['ar_lain_akhir'];
                                $arr['notes'] = $val['notes'];
                                $arr['posted'] = $val['posted'];
                                $arr['posted_by'] = $val['posted_by'];
                                $arr['posted_date'] = $val['posted_date'];
                                $arr['released'] = $val['released'];
                                $arr['printed'] = $val['printed'];
                                $arr['impact'] = $val['impact'];
                                
                                array_push($data, $arr);
			}
		}
                
                $this->load->model('dashboard_model');
		
		//INSERT NEW BACKUP FILES
		//$this->dashboard_model->insertSetoranPusat($data);
                //$this->dashboard_model->insertDiskonHist();
                $this->dashboard_model->insertKoreksiPusat($data);
		
		return $this->_print('SUCCESS!');
            
	}
        
        function prosesKoreksi3()
	{   
            $start = date('Y-m-d',strtotime("-4 days"));
            $end = date('Y-m-d');
            $data = array();
            $this->load->model('simtax_depok_model');
            $this->load->model('simtax_jagakarsa_model');
            $this->load->model('simtax_joglo_baru_model');
            $this->load->model('simtax_joglo_model');
            $this->load->model('simtax_mustikasari_model');
            $depok = $this->simtax_depok_model->dataKoreksi($start, $end);
            $jagakarsa = $this->simtax_jagakarsa_model->dataKoreksi($start, $end);
            $joglo_baru = $this->simtax_joglo_baru_model->dataKoreksi($start, $end);
            $joglo = $this->simtax_joglo_model->dataKoreksi($start, $end);
            $mustikasari = $this->simtax_mustikasari_model->dataKoreksi($start, $end);

            $arrData = array();
            array_push($arrData, $depok);
            array_push($arrData, $jagakarsa);
            array_push($arrData, $joglo_baru);
            array_push($arrData, $joglo);
            array_push($arrData, $mustikasari);

 
            foreach((Array) $arrData AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['trid'] = $val['trid'];
                                $arr['trcode'] = $val['trcode'];
                                $arr['trdate'] = $val['trdate'];
                                $arr['owner_pt_id'] = $val['owner_pt_id'];
                                $arr['pool_id'] = $val['pool_id'];
                                $arr['car_id'] = $val['car_id'];
                                $arr['no_pintu'] = $val['no_pintu'];
                                $arr['tipe_operasi'] = $val['tipe_operasi'];
                                $arr['type_koreksi'] = $val['type_koreksi'];
                                $arr['ar_ks_saldo_awal'] = $val['ar_ks_saldo_awal'];
                                $arr['ar_tabsp_awal'] = $val['ar_tabsp_awal'];
                                $arr['ar_lain_awal'] = $val['ar_lain_awal'];
                                $arr['ar_ks_saldo_koreksi'] = $val['ar_ks_saldo_koreksi'];
                                $arr['ar_tabsp_koreksi'] = $val['ar_tabsp_koreksi'];
                                $arr['ar_lain_koreksi'] = $val['ar_lain_koreksi'];
                                $arr['ar_ks_saldo_akhir'] = $val['ar_ks_saldo_akhir'];
                                $arr['ar_tabsp_akhir'] = $val['ar_tabsp_akhir'];
                                $arr['ar_lain_akhir'] = $val['ar_lain_akhir'];
                                $arr['notes'] = $val['notes'];
                                $arr['posted'] = $val['posted'];
                                $arr['posted_by'] = $val['posted_by'];
                                $arr['posted_date'] = $val['posted_date'];
                                $arr['released'] = $val['released'];
                                $arr['printed'] = $val['printed'];
                                $arr['impact'] = $val['impact'];
                                
                                array_push($data, $arr);
			}
		}
                
                $this->load->model('dashboard_model');
		
		//INSERT NEW BACKUP FILES
		//$this->dashboard_model->insertSetoranPusat($data);
                //$this->dashboard_model->insertDiskonHist();
                $this->dashboard_model->insertKoreksiPusat($data);
		
		return $this->_print('SUCCESS!');
            
	}
        
        function prosesKoreksi4()
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
            $mustikasari = $this->simtax_mustikasari_model->dataKoreksi($start, $end);
            $padang = $this->simtax_padang_model->dataKoreksi($start, $end);
            $pekapuran = $this->simtax_pekapuran_model->dataKoreksi($start, $end);
            $pondok_bambu = $this->simtax_pondok_bambu_model->dataKoreksi($start, $end);
            $star = $this->simtax_star_model->dataKoreksi($start, $end);
            $tangsel = $this->simtax_tangsel_model->dataKoreksi($start, $end);

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
				$arr['trid'] = $val['trid'];
                                $arr['trcode'] = $val['trcode'];
                                $arr['trdate'] = $val['trdate'];
                                $arr['owner_pt_id'] = $val['owner_pt_id'];
                                $arr['pool_id'] = $val['pool_id'];
                                $arr['car_id'] = $val['car_id'];
                                $arr['no_pintu'] = $val['no_pintu'];
                                $arr['tipe_operasi'] = $val['tipe_operasi'];
                                $arr['type_koreksi'] = $val['type_koreksi'];
                                $arr['ar_ks_saldo_awal'] = $val['ar_ks_saldo_awal'];
                                $arr['ar_tabsp_awal'] = $val['ar_tabsp_awal'];
                                $arr['ar_lain_awal'] = $val['ar_lain_awal'];
                                $arr['ar_ks_saldo_koreksi'] = $val['ar_ks_saldo_koreksi'];
                                $arr['ar_tabsp_koreksi'] = $val['ar_tabsp_koreksi'];
                                $arr['ar_lain_koreksi'] = $val['ar_lain_koreksi'];
                                $arr['ar_ks_saldo_akhir'] = $val['ar_ks_saldo_akhir'];
                                $arr['ar_tabsp_akhir'] = $val['ar_tabsp_akhir'];
                                $arr['ar_lain_akhir'] = $val['ar_lain_akhir'];
                                $arr['notes'] = $val['notes'];
                                $arr['posted'] = $val['posted'];
                                $arr['posted_by'] = $val['posted_by'];
                                $arr['posted_date'] = $val['posted_date'];
                                $arr['released'] = $val['released'];
                                $arr['printed'] = $val['printed'];
                                $arr['impact'] = $val['impact'];
                                
                                array_push($data, $arr);
			}
		}
                
                $this->load->model('dashboard_model');
		
		//INSERT NEW BACKUP FILES
		//$this->dashboard_model->insertSetoranPusat($data);
                //$this->dashboard_model->insertDiskonHist();
                $this->dashboard_model->insertKoreksiPusat($data);
		
		return $this->_print('SUCCESS!');
            
	}
	
	 function prosesFixJurnal()
	{  
	$this->load->model('dashboard_model');
	$this->dashboard_model->insertDiskonHistEtu();
	$this->dashboard_model->insertDiskonHistWmk();
	$this->dashboard_model->insertDiskonHistSip();
	$this->dashboard_model->insertDiskonHistTss();
	$this->dashboard_model->insertDiskonHistMep();
	$this->dashboard_model->insertDiskonHistEkl();
	$this->dashboard_model->insertDiskonHistFmt();
	$this->dashboard_model->insertDiskonHistEsbc();
	$this->dashboard_model->insertDiskonHistEmk();
	$this->dashboard_model->updateJurnalLastStep();
	
	return $this->_print('SUCCESS!');
	}
        
        
	
	
}
