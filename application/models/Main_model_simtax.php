<?php

class Main_model_simtax extends CI_Model{
	protected $db_local;
	protected $db_name;
	protected $wh_id = -1;
	
	protected function data_setoran($start, $end){	
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = array();
		$query = $this->db_local->query("select trid, setoran_code, setoran_date, spj_code, spj_date, posted, posted_by, posted_date, car_id, no_pintu, pool_id, owner_pt_id, kip_setor, nama_setor, status_operasi, s_denda, s_waktu_denda, s_awal_denda, tipe_operasi, note_tab_part, note_ks, s_wajib, s_tab_wajib, s_lain, s_cuci, s_laka, s_aqua, biaya_order, jam_masuk, tambah_denda_perjam, total_denda, terima_cash, terima_ct, terima_flash, terima_express_card, total_terima, terima_cuci, terima_laka, terima_aqua, terima_order, total_koperasi, terima_lain, terima_denda, terima_tab_part, terima_tab_part_note, total_ks_terbit, kembali_ct, jumlah_bayar_ks, ks_adjusment, tab_part_adjustment, lain_adjusment, released, printed
                                                 from trx_setoran where spj_date >= (CURRENT_DATE - INTERVAL 4 day) and spj_date <= (CURRENT_DATE - INTERVAL 2 day);");
		if(is_object($query)){
			$data = $query->result_array();
		}	
		$this->db_local->close();
		return $data;
	}
        
        protected function data_koreksi($start, $end){	
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = array();
		$query = $this->db_local->query("select trid, trcode, trdate, owner_pt_id, pool_id, car_id, no_pintu, tipe_operasi, type_koreksi, ar_ks_saldo_awal, ar_tabsp_awal, ar_lain_awal, ar_ks_saldo_koreksi, ar_tabsp_koreksi, ar_lain_koreksi, ar_ks_saldo_akhir, ar_tabsp_akhir, ar_lain_akhir, notes, posted, posted_by, posted_date, released, printed, impact
                                                 from trx_koreksi_ar_armada where trdate >= (CURRENT_DATE - INTERVAL 4 day) and trdate <= (CURRENT_DATE - INTERVAL 2 day);");
		if(is_object($query)){
			$data = $query->result_array();
		}	
		$this->db_local->close();
		return $data;
	}
	
	protected function data_credit_ticket($start, $end){	
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = array();
		$query = $this->db_local->query("select ct_no, ct_released_date, costumer_id, costumer_name, trid, trcode, trdate, setoran_code, spj_code, used_date, used_by, used_value, used_poolid, used_ptid, driver_id, driver_name, car_id, no_pintu, status_invoice, no_invoice, purpose, status_double
                                                 from ms_credit_ticket where used_date >= (CURRENT_DATE - INTERVAL 4 day) and used_date <= (CURRENT_DATE - INTERVAL 2 day);");
		if(is_object($query)){
			$data = $query->result_array();
		}	
		$this->db_local->close();
		return $data;
	}
	
	protected function data_set($start, $end){	
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = array();
		$query = $this->db_local->query('select spj_date, 
		sum(case when status_operasi = 0 and tipe_operasi = 0 then 1 else 0 end) as reguler, 
		sum(case when status_operasi = 0 and tipe_operasi = 1 then 1 else 0 end) as kalong, 
		sum(case when status_operasi = 1 then 1 else 0 end) as tp, 
		sum(case when status_operasi = 2 then 1 else 0 end) as broken, 
		sum(case when status_operasi = 3 then 1 else 0 end) as other, 
		sum(case when status_operasi = 4 then 1 else 0 end) as sos
		from trx_operasi_armada where spj_date >= "'.$start.'" and spj_date <= "'.$end.'" group by spj_date order by spj_date');
		if(is_object($query)){
			$data = $query->result_array();
		}	
		$this->db_local->close();
		return $data;
	}
	
	protected function data_data($date = ''){
		if($date === '')
			$date = date('Y-m-d',strtotime("-1 days"));
		$data = array();
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$query = $this->db_local->query('select TIPE_OPERASI, STATUS_OPERASI, count(*) as ct from trx_operasi_armada where spj_date = "'.$date.'" group by TIPE_OPERASI, STATUS_OPERASI');
		if(is_object($query)){
			$data = $query->result_array();
		}
		$this->db_local->close();
		return $data;
	}
	
	protected function revenues($date = ''){
		if($date === '')
			$date = date('Y-m-d',strtotime("-1 days"));
		$data = array();
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$query = $this->db_local->query('select sum(case when status_operasi = 0 then 1 else 0 end) as "SPJ", 
			sum(case when status_operasi = 1 then 1 else 0 end) as "TP", sum(case when status_operasi = 2 then 1 else 0 end) as "TL", 
			sum(case when status_operasi = 3 then 1 else 0 end) as "LAIN", sum(case when status_operasi = 4 then 1 else 0 end) as "SO",
			sum(TOTAL_TERIMA)-sum(KEMBALI_CT)-sum(TERIMA_CUCI)-sum(TERIMA_LAKA)-sum(TERIMA_AQUA)-sum(TERIMA_TAB_PART) as "REVENUE", 
			sum(S_WAJIB) + sum(S_LAIN) + sum(TOTAL_DENDA) as "TAGIHAN", sum(TOTAL_KS_TERBIT) as "KS" from trx_setoran where SPJ_DATE = "'.$date.'";');
		if(is_object($query)){
			$data = $query->result_array();
		}
		$this->db_local->close();
		return $data;
	}
	
	public function revenue_set($start, $end){
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = array();
		$query = $this->db_local->query("select x.spj_date, total_spj, total_rev_spj - (ks_total - coalesce(ks_spj,0)) as total_rev_spj, tagihan_spj, ks_total, tagihan_non_spj, coalesce(ks_spj,0) as ks_spj, 
			-(coalesce(adjust_ks,0)) as angsuran_ks, (ks_total - coalesce(ks_spj,0)) as bayar_hutang from (select spj_date, sum(case when status_operasi = 0 then 1 else 0 end) as total_spj,
			sum(TOTAL_TERIMA)-sum(KEMBALI_CT)-sum(TERIMA_CUCI)-sum(TERIMA_LAKA)-sum(TERIMA_AQUA)-sum(TERIMA_TAB_PART) as total_rev_spj, 
			sum(S_WAJIB) + sum(S_LAIN) + sum(TOTAL_DENDA) as tagihan_spj, sum(TOTAL_KS_TERBIT) as ks_total
			from trx_setoran where spj_date >= '".$start."' and spj_date <= '".$end."' and STATUS_OPERASI = 0 group by SPJ_DATE) as x 
			join		
			(select spj_date, 
			sum(TOTAL_KS_TERBIT) as tagihan_non_spj
			from trx_setoran where spj_date >= '".$start."' and spj_date <= '".$end."' and STATUS_OPERASI > 0 group by SPJ_DATE order by SPJ_DATE) as y 
			on x.spj_date = y.spj_date 
			left join		
			(select spj_date, 
			sum(TOTAL_KS_TERBIT) as ks_spj
			from trx_setoran where spj_date >= '".$start."' and spj_date <= '".$end."' and STATUS_OPERASI = 0 and TOTAL_KS_TERBIT < 0 group by SPJ_DATE order by SPJ_DATE) as z 
			on z.spj_date = x.spj_date and z.spj_date = y.spj_date
			left join(SELECT date(TRDATE) as dt, SUM(AR_KS_SALDO_KOREKSI) as adjust_ks FROM trx_koreksi_ar_armada where date(TRDATE) >= '".$start."' 
			and date(TRDATE) <= '".$end."' and impact = 1 group by dt order by dt) as a 
			on a.dt = x.spj_date
			group by x.spj_date;");
		if(is_object($query)){
			$data = $query->result_array();
		}	
		$this->db_local->close();
		return $data;	
	}
	
	public function ks_get($start, $end){
		$day = date('Y-m-d', strtotime($start .' +1 day'));
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = array();
		$query = $this->db_local->query("select spj_date, reg_no, setor, s_wajib, s_lain, denda, ks, tipe_ops, 
			(case when setor <= 0 then coalesce(adjust_ks,0) else 0 end) as bayar_ks
			from (select spj_date, NO_PINTU as reg_no, TOTAL_TERIMA - KEMBALI_CT as setor, S_WAJIB as s_wajib, 
			S_LAIN as s_lain, TOTAL_DENDA as denda, TOTAL_KS_TERBIT as ks, TIPE_OPERASI as tipe_ops from trx_setoran 
			where SPJ_DATE >= '".$start."' and spj_date <= '".$end."' and STATUS_OPERASI = 0 and TOTAL_KS_TERBIT < 0) x
			left join (
			SELECT NO_PINTU, sum(AR_KS_SALDO_KOREKSI) as adjust_ks FROM trx_koreksi_ar_armada where date(TRDATE) > '".$start."' 
			and date(TRDATE) <= '".$day."' and impact = 1 group by NO_PINTU order by date(TRDATE)
			)y on x.reg_no = y.NO_PINTU
			;");
		if(is_object($query)){
			$data = $query->result_array();
		}	
		$this->db_local->close();
		return $data;
	}
	
	public function ks_get_with_db($db, $start, $end){
		$day = date('Y-m-d', strtotime($start .' +1 day'));
		$day2 = date('Y-m-d', strtotime($end .' +1 day'));
		$data = array();
		$data['setoran'] = array();
		$data['adjust'] = array();		
		$query1 = $db->query("select spj_date, NO_PINTU as reg_no, TOTAL_TERIMA - KEMBALI_CT as setor, S_WAJIB as s_wajib, 
			S_LAIN as s_lain, TOTAL_DENDA as denda, TOTAL_KS_TERBIT as ks, TIPE_OPERASI as tipe_ops, ms_driver.STATUS as jenis_mitra, spj_code 
			from trx_setoran join ms_driver on ms_driver.FNO_KIP = KIP_SETOR
			where SPJ_DATE >= '".$start."' and spj_date <= '".$end."' and STATUS_OPERASI = 0 and TOTAL_KS_TERBIT < 0;");
		if(is_object($query1)){
			$data['setoran'] = $query1->result_array();
		}
		$query2 = $db->query("SELECT date(TRDATE) as tgl, NO_PINTU as reg_no, sum(AR_KS_SALDO_KOREKSI) as adjust_ks FROM trx_koreksi_ar_armada where date(TRDATE) >= '".$day."' 
			and date(TRDATE) <= '".$day2."' and impact = 1 group by tgl, NO_PINTU");
		if(is_object($query2)){
			$data['adjust'] = $query2->result_array();
		}
		return $data;
	}
	
	function load_db(){
		$this->db_local =  $this->load->database($this->db_name, TRUE);
		return $this->db_local;
	}
	
	function drivers_backup($db_local, $start, $end){
		if($end === '' || strtotime($end) >= strtotime(date('Y-m-d')))
			$end = date('Y-m-d',strtotime("-1 days"));
		$start_mth = date('Y-m-01', strtotime($end));
		$data = array();
		$query = $db_local->query("
			select * from (			
			select '".$end."' as tgl_snapshot, sum(case when hk = 1 then ct else 0 end) as d1,
			sum(case when hk = 2 then ct else 0 end) as d2,
			sum(case when hk = 3 then ct else 0 end) as d3,
			sum(case when hk = 4 then ct else 0 end) as d4,
			sum(case when hk = 5 then ct else 0 end) as d5,
			sum(case when hk = 6 then ct else 0 end) as d6,
			sum(case when hk = 7 then ct else 0 end) as d7,
			sum(case when hk = 8 then ct else 0 end) as d8,
			sum(case when hk = 9 then ct else 0 end) as d9,
			sum(case when hk = 10 then ct else 0 end) as d10,
			sum(case when hk = 11 then ct else 0 end) as d11,
			sum(case when hk = 12 then ct else 0 end) as d12,
			sum(case when hk = 13 then ct else 0 end) as d13,
			sum(case when hk = 14 then ct else 0 end) as d14,
			sum(case when hk = 15 then ct else 0 end) as d15,
			sum(case when hk = 16 then ct else 0 end) as d16,
			sum(case when hk = 17 then ct else 0 end) as d17,
			sum(case when hk = 18 then ct else 0 end) as d18,
			sum(case when hk = 19 then ct else 0 end) as d19,
			sum(case when hk = 20 then ct else 0 end) as d20,
			sum(case when hk = 21 then ct else 0 end) as d21,
			sum(case when hk = 22 then ct else 0 end) as d22,
			sum(case when hk = 23 then ct else 0 end) as d23,
			sum(case when hk = 24 then ct else 0 end) as d24,
			sum(case when hk = 25 then ct else 0 end) as d25,
			sum(case when hk = 26 then ct else 0 end) as d26,
			sum(case when hk = 27 then ct else 0 end) as d27,
			sum(case when hk = 28 then ct else 0 end) as d28,
			sum(case when hk = 29 then ct else 0 end) as d29,
			sum(case when hk = 30 then ct else 0 end) as d30,
			sum(case when hk = 31 then ct else 0 end) as d31
			from(
			select hk, count(hk) as ct from 
					(select count(*) as hk from trx_operasi_armada
					where SPJ_DATE >= '".$start_mth."' and SPJ_DATE <= '".$end."' and STATUS_OPERASI = 0 group by KIP_SETOR) dd
			group by hk order by hk
			) aa) bb join (select * from (select count(*) as bravo_aktif from ms_driver where berlaku_kip >= '".$end."' and status = 'B') a
						join
						(select count(*) as bravo_inaktif from ms_driver where aktif = 1 and berlaku_kip >= '".$end."' and status = 'B') b
						join
						(select count(*) as charli_aktif from ms_driver where berlaku_kip >= '".$end."' and status = 'C') c
						join
						(select count(*) as charli_inaktif from ms_driver where aktif = 1 and berlaku_kip >= '".$end."' and status = 'C') d) cc limit 1
			;");
		if(is_object($query)){
			$data = $query->result_array();
		}
		return $data;
	}
	
	function car_backup($db_local, $start, $end){
		if($end === '' || strtotime($end) >= strtotime(date('Y-m-d')))
			$end = date('Y-m-d',strtotime("-1 days"));
		$start_mth = date('Y-m-01', strtotime($end));
		$data = array();
		$query = $db_local->query("
			select * from (			
			select '".$end."' as tgl_snapshot, sum(case when hk = 1 then ct else 0 end) as d1,
			sum(case when hk = 2 then ct else 0 end) as d2,
			sum(case when hk = 3 then ct else 0 end) as d3,
			sum(case when hk = 4 then ct else 0 end) as d4,
			sum(case when hk = 5 then ct else 0 end) as d5,
			sum(case when hk = 6 then ct else 0 end) as d6,
			sum(case when hk = 7 then ct else 0 end) as d7,
			sum(case when hk = 8 then ct else 0 end) as d8,
			sum(case when hk = 9 then ct else 0 end) as d9,
			sum(case when hk = 10 then ct else 0 end) as d10,
			sum(case when hk = 11 then ct else 0 end) as d11,
			sum(case when hk = 12 then ct else 0 end) as d12,
			sum(case when hk = 13 then ct else 0 end) as d13,
			sum(case when hk = 14 then ct else 0 end) as d14,
			sum(case when hk = 15 then ct else 0 end) as d15,
			sum(case when hk = 16 then ct else 0 end) as d16,
			sum(case when hk = 17 then ct else 0 end) as d17,
			sum(case when hk = 18 then ct else 0 end) as d18,
			sum(case when hk = 19 then ct else 0 end) as d19,
			sum(case when hk = 20 then ct else 0 end) as d20,
			sum(case when hk = 21 then ct else 0 end) as d21,
			sum(case when hk = 22 then ct else 0 end) as d22,
			sum(case when hk = 23 then ct else 0 end) as d23,
			sum(case when hk = 24 then ct else 0 end) as d24,
			sum(case when hk = 25 then ct else 0 end) as d25,
			sum(case when hk = 26 then ct else 0 end) as d26,
			sum(case when hk = 27 then ct else 0 end) as d27,
			sum(case when hk = 28 then ct else 0 end) as d28,
			sum(case when hk = 29 then ct else 0 end) as d29,
			sum(case when hk = 30 then ct else 0 end) as d30,
			sum(case when hk = 31 then ct else 0 end) as d31
			from(
			select hk, count(hk) as ct from 
					(select count(*) as hk from trx_operasi_armada
					where SPJ_DATE >= '".$start_mth."' and SPJ_DATE <= '".$end."' and STATUS_OPERASI = 0 group by NO_PINTU) dd
			group by hk order by hk
			) aa) bb limit 1
			;");
		if(is_object($query)){
			$data = $query->result_array();
		}
		return $data;
	}
	
	public function drivers($start, $end){
		if($end === '' || strtotime($end) >= strtotime(date('Y-m-d')))
			$end = date('Y-m-d',strtotime("-1 days"));
		$start_mth = date('Y-m-01', strtotime($end));
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = array();
		$query = $this->db_local->query("
			select * from (			
			select '".$end."' as tgl_snapshot, sum(case when hk = 1 then ct else 0 end) as d1,
			sum(case when hk = 2 then ct else 0 end) as d2,
			sum(case when hk = 3 then ct else 0 end) as d3,
			sum(case when hk = 4 then ct else 0 end) as d4,
			sum(case when hk = 5 then ct else 0 end) as d5,
			sum(case when hk = 6 then ct else 0 end) as d6,
			sum(case when hk = 7 then ct else 0 end) as d7,
			sum(case when hk = 8 then ct else 0 end) as d8,
			sum(case when hk = 9 then ct else 0 end) as d9,
			sum(case when hk = 10 then ct else 0 end) as d10,
			sum(case when hk = 11 then ct else 0 end) as d11,
			sum(case when hk = 12 then ct else 0 end) as d12,
			sum(case when hk = 13 then ct else 0 end) as d13,
			sum(case when hk = 14 then ct else 0 end) as d14,
			sum(case when hk = 15 then ct else 0 end) as d15,
			sum(case when hk = 16 then ct else 0 end) as d16,
			sum(case when hk = 17 then ct else 0 end) as d17,
			sum(case when hk = 18 then ct else 0 end) as d18,
			sum(case when hk = 19 then ct else 0 end) as d19,
			sum(case when hk = 20 then ct else 0 end) as d20,
			sum(case when hk = 21 then ct else 0 end) as d21,
			sum(case when hk = 22 then ct else 0 end) as d22,
			sum(case when hk = 23 then ct else 0 end) as d23,
			sum(case when hk = 24 then ct else 0 end) as d24,
			sum(case when hk = 25 then ct else 0 end) as d25,
			sum(case when hk = 26 then ct else 0 end) as d26,
			sum(case when hk = 27 then ct else 0 end) as d27,
			sum(case when hk = 28 then ct else 0 end) as d28,
			sum(case when hk = 29 then ct else 0 end) as d29,
			sum(case when hk = 30 then ct else 0 end) as d30,
			sum(case when hk = 31 then ct else 0 end) as d31
			from(
			select hk, count(hk) as ct from 
					(select count(*) as hk from trx_operasi_armada
					where SPJ_DATE >= '".$start_mth."' and SPJ_DATE <= '".$end."' and STATUS_OPERASI = 0 group by KIP_SETOR) dd
			group by hk order by hk
			) aa) bb join (select * from (select count(*) as bravo_aktif from ms_driver where aktif = 1 and status = 'B') a
						join
						(select count(*) as bravo_inaktif from ms_driver where aktif = 0 and status = 'B') b
						join
						(select count(*) as charli_aktif from ms_driver where aktif = 1 and status = 'C') c
						join
						(select count(*) as charli_inaktif from ms_driver where aktif = 0 and status = 'C') d) cc limit 1
			;");
		if(is_object($query)){
			$data = $query->result_array();
		}
		$this->db_local->close();
		return $data;
	}
	
	public function setoran_get($start, $end, $kip){
		$data = array();
		$query = $this->db_local->query("select spj_date, NO_PINTU as reg_no, TOTAL_TERIMA - KEMBALI_CT as setor, S_WAJIB as s_wajib, 
			S_LAIN as s_lain, TOTAL_DENDA as denda, TOTAL_KS_TERBIT as ks, TIPE_OPERASI as tipe_ops, status_operasi from trx_setoran 
			where SPJ_DATE >= '".$start."' and spj_date <= '".$end."' and KIP_SETOR = '".$kip."' and status_operasi = 0;");
		if(is_object($query)){
			$data = $query->result_array();
		}
		return $data;
	}
	
	public function adjustment_get($date, $no_pintu){
		$date = date('Y-m-d',strtotime($date." +1 days"));
		$data = array();
		$query = $this->db_local->query("SELECT sum(AR_KS_SALDO_KOREKSI) as adjust_ks FROM trx_koreksi_ar_armada where date(TRDATE) = '".$date."'
			and NO_PINTU = '".$no_pintu."' and impact = 1;");
		if(is_object($query)){
			$data = $query->result_array();
		}
		return $data;
	}
	
	public function inventory_get($db_local, $period){
		$data = array();
		$query = $db_local->query("select itemcode as item_id, coalesce(QTYAKHIR, 0) as qty from iv_stock_warehouse join ms_items on 
			iv_stock_warehouse.ITEMID = ms_items.ITEMID where itemcode in ('1MU070ME35',
			'1MU070EVA2','1MU070GLF2','1MU070GLF3','1MU070ME35','1MU070ME40','1MU070ME42','1MU070ME43','1MU070ME48','1MU070ME34',
			'1MU070ML38','1MU070ME38','1CN426524A','1CN426525A','1CN426527A','1CN42652AC','1CN42652D1','1CN42652HK','1MU0101AMR',
			'1MU0101WSA','1MU0101YUB','1EN312500A','1EN312100A','1EN312300A','1CN485100C','1CN485200C','1CN485300A','1CN450460A',
			'1CN450470A','1CN455030B','1CN430400A','1CN04465PM','1CN044660E','1BN561110B','1CN42450AC','1EN164000C','1EN163610A',
			'1AN883200A','1CN123720A','1AN884100B','1EV163631C','1CN89465AA','1CN894650A','1AN884600A','1EN16361AF','1EN19100TA',
			'1BN812701C','1MU0504GLA','1MU0503COB','1MU0501DWH','1MU0301ENB','1MU0301ENA' ) and PERIODID = ".$period." ".($this->wh_id > -1 ? (' and WHID = '.$this->wh_id) : '')." ;");
		if(is_object($query)){
			$data = $query->result_array();
		}
		return $data;
	}
	
	//SPJ
	public function data_spj($start, $end){
		$data = array();
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$query = $this->db_local->query("select SPJ_DATE, SPJ_CODE, NAMA_SETOR, TIPE_OPERASI, NO_PINTU, STATUS_BEBAS_SETOR, POSTED_DATE, KIP_SETOR 
			from trx_operasi_armada where SPJ_DATE >= '".$start."' and spj_date <= '".$end."' and status_operasi = 0;");
		if(is_object($query)){
			$data = $query->result_array();
		}
		return $data;
	}
}

?>