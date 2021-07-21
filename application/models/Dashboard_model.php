<?php

class Dashboard_model extends CI_Model {	

	function insertSetoranPusat($data){	
		foreach((Array) $data AS $key => $val){
			$save = array();
			foreach (Array('trid', 'setoran_code', 'setoran_date', 'spj_code', 'spj_date', 'posted', 'posted_by', 'posted_date', 'car_id', 'no_pintu', 'pool_id', 'owner_pt_id', 'kip_setor', 'nama_setor', 'status_operasi', 's_denda', 's_waktu_denda', 's_awal_denda', 'tipe_operasi', 'note_tab_part', 'note_ks', 's_wajib', 's_tab_wajib', 's_lain', 's_cuci', 's_laka', 's_aqua', 'biaya_order', 'jam_masuk', 'tambah_denda_perjam', 'total_denda', 'terima_cash', 'terima_ct', 'terima_flash', 'terima_express_card', 'total_terima', 'terima_cuci', 'terima_laka', 'terima_aqua', 'terima_order', 'total_koperasi', 'terima_lain', 'terima_denda', 'terima_tab_part', 'terima_tab_part_note', 'total_ks_terbit', 'kembali_ct', 'jumlah_bayar_ks', 'ks_adjusment', 'tab_part_adjustment', 'lain_adjusment', 'released', 'printed') AS $keys => $vals) {
				if (array_key_exists($vals, (array) $val))
					$save[$vals] = $val[$vals];
			}
                         $CI = &get_instance();
                        $this->db = $CI->load->database('simtax_pusat', TRUE);
			$this->db->insert('trx_setoran', $save);
		}
	}
        
        function insertKoreksiPusat($data){	
		foreach((Array) $data AS $key => $val){
			$save = array();
			foreach (Array('trid', 'trcode', 'trdate', 'owner_pt_id', 'pool_id', 'car_id', 'no_pintu', 'tipe_operasi', 'type_koreksi', 'ar_ks_saldo_awal', 'ar_tabsp_awal', 'ar_lain_awal', 'ar_ks_saldo_koreksi', 'ar_tabsp_koreksi', 'ar_lain_koreksi', 'ar_ks_saldo_akhir', 'ar_tabsp_akhir', 'ar_lain_akhir', 'notes', 'posted', 'posted_by', 'posted_date', 'released', 'printed', 'impact') AS $keys => $vals) {
				if (array_key_exists($vals, (array) $val))
					$save[$vals] = $val[$vals];
			}
                         $CI = &get_instance();
                        $this->db = $CI->load->database('simtax_pusat', TRUE);
			$this->db->insert('trx_koreksi_ar_armada', $save);
		}
	}
        
        function insertDiskonHist(){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
                 $this->db->query("insert into trx_discount_hist
                                         select POOL_ID, OWNER_PT_ID, NO_PINTU, S_SETORAN_AWAL, S_DOWNTIME, S_SETORAN_FINAL, DATE_ADD(tanggal, INTERVAL 1 MONTH), POSTED, POSTED_BY, DATE_ADD(POSTED_DATE, INTERVAL 1 MONTH) from trx_discount_hist
                                         where tanggal = ((CURRENT_DATE - INTERVAL 1 month) - interval 3 day)  and NO_PINTU <> '';");
	}
	
	function insertCreditTicket($data){	
		foreach((Array) $data AS $key => $val){
			$save = array();
			foreach (Array('ct_no','ct_released_date', 'costumer_id', 'costumer_name', 'trid', 'trcode', 'trdate', 'setoran_code', 'spj_code', 'used_date', 'used_by', 'used_value', 'used_poolid', 'used_ptid', 'driver_id', 'driver_name', 'car_id', 'no_pintu', 'status_invoice', 'no_invoice', 'purpose', 'status_double') AS $keys => $vals) {
				if (array_key_exists($vals, (array) $val))
					$save[$vals] = $val[$vals];
			}
                         $CI = &get_instance();
                        $this->db = $CI->load->database('simtax_pusat', TRUE);
			$this->db->replace('ms_credit_ticket', $save);
		}
	}

	
	function getDataDetailCreditTicket($date, $date1 )
		{
			  $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
        $res = $this->db->query("select * from ms_credit_ticket where used_date >= '".$date."' and used_date <= '".$date1."';")->result_array();
		return $res;
		}
		
	function downloadDataDetailCreditTicket($date,$date1 ){
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "CreditTicketExpress.csv";
        $query = "select * from ms_credit_ticket where used_date >= '".$date."' and used_date <= '".$date1."';"; //USE HERE YOUR QUERY
        $result = $this->db->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);

    }
	
	function getDataSetoranSimtax($date, $date1 )
		{
			  $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
        $res = $this->db->query("select a.SETORAN_CODE, a.SETORAN_DATE, a.SPJ_CODE, a.SPJ_DATE, a.POSTED_BY, a.NO_PINTU, b.POOLFULLNAME, c.PTFULLNAME, a.KIP_SETOR, a.NAMA_SETOR,
								 a.STATUS_OPERASI, a.S_DENDA, a.TIPE_OPERASI, a.S_WAJIB, a.S_LAIN, a.S_CUCI, a.JAM_MASUK, a.TOTAL_DENDA, a.TERIMA_CASH, a.TERIMA_CT,
								 a.TERIMA_FLASH,a.TERIMA_EXPRESS_CARD, a.TOTAL_TERIMA, a.TERIMA_CUCI, a.TERIMA_LAIN,  a.TERIMA_DENDA, a.TERIMA_TAB_PART,
								 a.TOTAL_KS_TERBIT, a.KEMBALI_CT, a.JUMLAH_BAYAR_KS, a.KS_ADJUSMENT, a.TAB_PART_ADJUSTMENT, a.LAIN_ADJUSMENT from trx_setoran a
								 left join ms_pool b on (a.POOL_ID = b.POOLID)
								 left join ms_pt c on (a.OWNER_PT_ID = c.PTID)
								 where spj_date >= '".$date."' and SPJ_DATE <= '".$date1."';")->result_array();
		return $res;
		}
		
		function downloadDataSetoranSimtax($date,$date1 ){
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "DetailSetoranSimtax.csv";
        $query = "select a.SETORAN_CODE, a.SETORAN_DATE, a.SPJ_CODE, a.SPJ_DATE, a.POSTED_BY, a.NO_PINTU, b.POOLFULLNAME, c.PTFULLNAME, a.KIP_SETOR, a.NAMA_SETOR,
								 a.STATUS_OPERASI, a.S_DENDA, a.TIPE_OPERASI, a.S_WAJIB, a.S_LAIN, a.S_CUCI, a.JAM_MASUK, a.TOTAL_DENDA, a.TERIMA_CASH, a.TERIMA_CT,
								 a.TERIMA_FLASH,a.TERIMA_EXPRESS_CARD, a.TOTAL_TERIMA, a.TERIMA_CUCI, a.TERIMA_LAIN,  a.TERIMA_DENDA, a.TERIMA_TAB_PART,
								 a.TOTAL_KS_TERBIT, a.KEMBALI_CT, a.JUMLAH_BAYAR_KS, a.KS_ADJUSMENT, a.TAB_PART_ADJUSTMENT, a.LAIN_ADJUSMENT from trx_setoran a
								 left join ms_pool b on (a.POOL_ID = b.POOLID)
								 left join ms_pt c on (a.OWNER_PT_ID = c.PTID)
								 where spj_date >= '".$date."' and SPJ_DATE <= '".$date1."';"; //USE HERE YOUR QUERY
        $result = $this->db->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);

    }
		
	
	function getDataReceiptTiara($date, $date1)
		{
			  $CI = &get_instance();
                $this->db = $CI->load->database('dice_tiara', TRUE);
        $res = $this->db->query("select e.no_kip, f.nomor_pintu, a.nomor_faktur, a.tgl_faktur, b.nominal , c.nett as ritase, d.nett as vdrop from spj_operasional z
								 left join faktur a on (z.id = a.id_spj)
								 left join metode_pembayaran_faktur b on (a.id_spj = b.id_faktur)
								 left join komponen_argo_faktur c on (a.id_spj = c.id_faktur)
								 left join komponen_argo_faktur d on (a.id_spj = d.id_faktur)
								 left join master_kip e on (z.id_kip = e.id_pengemudi)
								 left join mobil_pool f on (z.id_mobil_pool= f.id)
								 where a.tgl_faktur >= '".$date."' and a.tgl_faktur <= '".$date1."'
								 and b.id_metode_pembayaran= 3
								 and c.id_komponen = 1
								 and d.id_komponen = 2
								 and b.nominal >0;")->result_array();
		return $res;
		}
		
		function downloadDataReceiptTiara($date,$date1 ){
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "Receipt Tiara.csv";
        $query = "select e.no_kip, f.nomor_pintu, a.nomor_faktur, a.tgl_faktur, b.nominal , c.nett as ritase, d.nett as vdrop from spj_operasional z
								 left join faktur a on (z.id = a.id_spj)
								 left join metode_pembayaran_faktur b on (a.id_spj = b.id_faktur)
								 left join komponen_argo_faktur c on (a.id_spj = c.id_faktur)
								 left join komponen_argo_faktur d on (a.id_spj = d.id_faktur)
								 left join master_kip e on (z.id_kip = e.id_pengemudi)
								 left join mobil_pool f on (z.id_mobil_pool= f.id)
								 where a.tgl_faktur >= '".$date."' and a.tgl_faktur <= '".$date1."'
								 and b.id_metode_pembayaran= 3
								 and c.id_komponen = 1
								 and d.id_komponen = 2
								 and b.nominal >0;"; //USE HERE YOUR QUERY
        $result = $this->db->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);

    }
	
		
		function getDataCTEagle($date, $date1)
		{
			  $CI = &get_instance();
                $this->db = $CI->load->database('dice_eagle', TRUE);
        $res = $this->db->query("select e.no_kip, f.nomor_pintu, a.nomor_faktur, a.tgl_faktur, b.nominal , c.nett as ritase, d.nett as vdrop from spj_operasional z
								 left join faktur a on (z.id = a.id_spj)
								 left join metode_pembayaran_faktur b on (a.id_spj = b.id_faktur)
								 left join komponen_argo_faktur c on (a.id_spj = c.id_faktur)
								 left join komponen_argo_faktur d on (a.id_spj = d.id_faktur)
								 left join master_kip e on (z.id_kip = e.id_pengemudi)
								 left join mobil_pool f on (z.id_mobil_pool= f.id)
								 where a.tgl_faktur >= '".$date."' and a.tgl_faktur < '".$date1."'
								 and b.id_metode_pembayaran= 1
								 and c.id_komponen = 1
								 and d.id_komponen = 2
								 and b.nominal >0;")->result_array();
		return $res;
		}
		
		function downloadDataCTEagle($date,$date1 ){
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "CreditTicketEagle.csv";
        $query = "select e.no_kip, f.nomor_pintu, a.nomor_faktur, a.tgl_faktur, b.nominal , c.nett as ritase, d.nett as vdrop from spj_operasional z
				  left join faktur a on (z.id = a.id_spj)
				  left join metode_pembayaran_faktur b on (a.id_spj = b.id_faktur)
				  left join komponen_argo_faktur c on (a.id_spj = c.id_faktur)
				  left join komponen_argo_faktur d on (a.id_spj = d.id_faktur)
				  left join master_kip e on (z.id_kip = e.id_pengemudi)
				  left join mobil_pool f on (z.id_mobil_pool= f.id)
				 where a.tgl_faktur >= '".$date."' and a.tgl_faktur < '".$date1."'
				  and b.id_metode_pembayaran= 1
				  and c.id_komponen = 1
				  and d.id_komponen = 2
				  and b.nominal >0;"; //USE HERE YOUR QUERY
        $result = $this->db->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);

    }
	
	

		function dataActivity() {
		$res = $this->db->query("select * from public.log_proses order by Id DESC;");
		
		$out = ($res->result_array());
		
		return $out;
	}
        
        function getDataInputCT()
		{
        $res = $this->db->query("select count(0) as hitung from public.log_proses where name_case = 'inputCt';")->row()->hitung;
		return $res;
		}
		
		function getDataBatalOperasi()
		{
        $res = $this->db->query("select count(0) as hitung from public.log_proses where name_case = 'batalOperasi';")->row()->hitung;
		return $res;
		}
		
		function getDataBukaSos()
		{
        $res = $this->db->query("select count(0) as hitung from public.log_proses where name_case = 'bukaSos';")->row()->hitung;
		return $res;
		}
		
		function getDataBukaBs()
		{
        $res = $this->db->query("select count(0) as hitung from public.log_proses where name_case = 'bukaBs';")->row()->hitung;
		return $res;
		}
		
		function getDataDuplicateSpj()
		{
        $res = $this->db->query("select count(0) as hitung from public.log_proses where name_case = 'Duplicat SPJ';")->row()->hitung;
		return $res;
		}
		
		function save_backup($data){	
		foreach((Array) $data AS $key => $val){
			$save = array();
			foreach (Array('tgl_spj', 'id_pool', 'ops_reguler', 'ops_kalong', 'ops_tp', 'ops_broken', 'ops_other', 'ops_argo_rds', 
				'ops_surat', 'ops_tl', 'ops_so', 'ops_operasi', 'ops_non_operasi', 'ops_total') AS $keys => $vals) {
				if (array_key_exists($vals, (array) $val))
					$save[$vals] = $val[$vals];
			}
			$save['last_update'] = date('Y-m-d H:i:s');
			$this->db->insert('ops_pool', $save);
		}
	}
        
        
    
        
        
	
	function delete_backup($start, $end, $data){
		$id_pool = '';
		foreach((Array) $data AS $key => $val){
			if($id_pool === ''){
				$id_pool .= "'".$val."'";
			} else {
				$id_pool .= ", '".$val."'";
			}
		}
		$this->db->query("delete from ops_pool where tgl_spj >= '$start' and tgl_spj <= '$end' and id_pool in ($id_pool);");
// 		$this->db->where('tgl_spj >= ', $start)->where('tgl_spj <= ', $end)->delete('ops_pool');		
	}
	
	function get_operation($date = ''){
		if($date === '')
			$date = date('Y-m-d',strtotime("-1 days"));
		
		$last_30 = date('Y-m-d', strtotime($date .' -30 day'));	
		
		$data = $this->db->query("select * from (select * from master_pool left join ops_pool on id_pool = master_pool.id and tgl_spj = '".$date."' and active = 1
			where master_pool.pool_area <> 3) x left join (select id_pool, avg(ops_tp) as avg_tp, avg(ops_operasi) as avg_spj from ops_pool 
			where tgl_spj >= '".$last_30."' group by id_pool) y on x.id_pool = y.id_pool;")->result_array();
		return $data;
	}
	
	function get_series_operation($end = ''){
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-d', strtotime($end .' -30 day'));
		$start_120 = date('Y-m-d', strtotime($end .' -120 day'));
		
		$data['fleet'] = $this->db->query("
		select x.tgl_spj, reguler, eagle, tiara from (select tgl_spj, sum(ops_operasi) as reguler from ops_pool 
		join master_pool on master_pool.id = id_pool where tgl_spj >= '".$start."' and tgl_spj <= '".$end."' and (master_pool.pool_area <= 2 or master_pool.pool_area = 6 or master_pool.pool_area = 7)
		group by tgl_spj order by tgl_spj) as x
		join 
		(select tgl_spj, sum(ops_operasi) as eagle from ops_pool 
		join master_pool on master_pool.id = id_pool where tgl_spj >= '".$start."' and tgl_spj <= '".$end."' and master_pool.pool_area = 4 
		group by tgl_spj order by tgl_spj) as y on x.tgl_spj = y.tgl_spj
		join 
		(select tgl_spj, sum(ops_operasi) as tiara from ops_pool 
		join master_pool on master_pool.id = id_pool where tgl_spj >= '".$start."' and tgl_spj <= '".$end."' and master_pool.pool_area = 5 
		group by tgl_spj order by tgl_spj) as z on x.tgl_spj = z.tgl_spj;")->result_array();
		
		$data['spj'] = $this->db->query("
			select tgl_spj, sum(ops_operasi) as operasi, sum(ops_non_operasi) as no_operasi from ops_pool 
			join master_pool on master_pool.id = id_pool and master_pool.pool_area <> 3 where tgl_spj >= '".$start."' and tgl_spj <= '".$end."' 
			group by tgl_spj order by tgl_spj;")->result_array();
		
		$data['moving'] = $this->db->query("select tgl_spj, sum(ops_operasi) as operasi from ops_pool 
			where tgl_spj >= '".$start_120."' and tgl_spj <= '".$end."' group by tgl_spj order by tgl_spj;")->result_array();
		
		return $data;
	}
	
	function check(){
		$date = date('Y-m-d');
		$data = $this->db->query("select max(last_update) as max from ops_pool where tgl_spj = '".$date."' limit 1")->result_array();
		if(Count($data) > 0){
			if(strtotime($data[0]['max']) < strtotime(date('Y-m-d H:i:s', strtotime("-24 hours"))))
				return FALSE;
			return $data[0]['max'];
		}
		return FALSE;
	}
	
	function save_backup_rev($data){
		foreach((Array) $data AS $key => $val){
			$save = array();
			foreach (Array('tgl_spj', 'id_pool', 'total_spj', 'total_rev', 'total_arpof', 'total_gross', 'total_komisi', 'total_bbm', 
				'bayar_hutang', 'hutang_baru', 'total_lain', 'total_denda', 'tagihan_operasi', 'ks_operasi', 
				'ks_non_operasi', 'angsuran_ks', 'nominal_insentif_kehadiran', 'total_setoran_telat'
				) AS $keys => $vals) {
				if (array_key_exists($vals, (array) $val))
					$save[$vals] = $val[$vals];
			}
			$save['last_update'] = date('Y-m-d H:i:s');
			$this->db->insert('rev_pool', $save);
		}
	}
	
	function delete_backup_rev_reguler($start, $end){
		$this->db->where('tgl_spj >= ', $start)->where('tgl_spj <= ', $end)->where('id_pool <', 25)->delete('rev_pool');
	}
	
	function delete_backup_rev($start, $end, $data){
		$id_pool = '';
		foreach((Array) $data AS $key => $val){
			if($id_pool === ''){
				$id_pool .= "'".$val."'";
			} else {
				$id_pool .= ", '".$val."'";
			}
		}
		$this->db->query("delete from rev_pool where tgl_spj >= '$start' and tgl_spj <= '$end' and id_pool in ($id_pool);");
// 		$this->db->where('tgl_spj >= ', $start)->where('tgl_spj <= ', $end)->delete('rev_pool');
	}
	
	function get_revenue($date = ''){
		if($date === '')
			$date = date('Y-m-d',strtotime("-1 days"));
			
		$month = date("m",strtotime($date));
		$year = date("Y",strtotime($date));
		$data = array();
		$query = $this->db->query("
			select * from (select * from rev_pool join master_pool on master_pool.id = id_pool and master_pool.pool_area <> 3 where tgl_spj = '".$date."' order by id_pool) as x
			join 
			(select id_pool, -sum(ks_operasi + coalesce(total_setoran_telat, 0)) as ksmurni_ytd, -sum(ks_non_operasi) as kstp_ytd, -sum(ks_operasi + ks_non_operasi + coalesce(total_setoran_telat, 0)) as ks_total_ytd, sum(total_rev + bayar_hutang + (case when total_denda > 0 then total_denda else 0 end) + 
			(case when total_lain > 0 then total_lain else 0 end) + (case when angsuran_ks > 0 then angsuran_ks else 0 end) + (case when total_setoran_telat > 0 then total_setoran_telat else 0 end)) as rev_ytd, sum(total_spj) as spj_ytd from rev_pool 
			where tgl_spj <= '".$date."' and extract(year from tgl_spj) = ".$year." group by id_pool) as y on x.id_pool = y.id_pool
			join
			(select id_pool, -sum(ks_operasi + coalesce(total_setoran_telat, 0)) as ksmurni_mtd, -sum(ks_non_operasi) as kstp_mtd, -sum(ks_operasi + ks_non_operasi + coalesce(total_setoran_telat, 0)) as ks_total_mtd, sum(total_rev + bayar_hutang + (case when total_denda > 0 then total_denda else 0 end) + 
			(case when total_lain > 0 then total_lain else 0 end) + (case when angsuran_ks > 0 then angsuran_ks else 0 end) + (case when total_setoran_telat > 0 then total_setoran_telat else 0 end)) as rev_mtd, sum(total_spj) as spj_mtd from rev_pool 
			where tgl_spj <= '".$date."' and extract(year from tgl_spj) = ".$year." and extract(month from tgl_spj) = ".$month." group by id_pool) as z on x.id_pool = z.id_pool and y.id_pool = z.id_pool
			;");
		if(is_object($query)){
			$data = $query->result_array();
		}
		return $data;
	}
	
	function annual_revenue($date = ''){
		if($date === '')
			$date = date('Y-m-d',strtotime("-1 days"));

		$day = date("d",strtotime($date));			
		$month = date("m",strtotime($date));
		$year = date("Y",strtotime($date));
			
		$data['mtd_rev'] = $this->db->query('select sum(total_rev + coalesce(total_denda, 0) + coalesce(bayar_hutang, 0) + coalesce(angsuran_ks,0)) as rev from rev_pool 
			join master_pool on master_pool.id = rev_pool.id_pool and pool_area <> 3 
			where extract(day from tgl_spj) <= '.$day.' and extract(month from tgl_spj) = '.$month.' 
			and extract(year from tgl_spj) = '.$year.';')
			->result_array();
		
		$data['ytd_rev'] = $this->db->query("select sum(total_rev + coalesce(total_denda, 0) + coalesce(bayar_hutang, 0) + coalesce(angsuran_ks,0)) as rev from rev_pool 
			join master_pool on master_pool.id = rev_pool.id_pool and pool_area <> 3 
			where tgl_spj <= '".$date."' and extract(year from tgl_spj) = ".$year.";")
			->result_array();
		
		$data['series_ytd'] = $this->db->query("select extract(month from tgl_spj) as mth, sum(total_rev + coalesce(total_denda, 0) + coalesce(bayar_hutang, 0) + coalesce(angsuran_ks,0)) as rev
			from rev_pool join master_pool on master_pool.id = rev_pool.id_pool and pool_area <> 3 
			where tgl_spj <= '".$date."' and extract(year from tgl_spj) = ".$year." group by mth order by mth;")->result_array();
			
		return $data;	
	}
	
	function check_rev(){
		$date = date('Y-m-d', strtotime("-1 days"));
		$data = $this->db->query("select max(last_update) as max from rev_pool where tgl_spj = '".$date."' limit 1")->result_array();
		if(Count($data) > 0){
			if(strtotime($data[0]['max']) < strtotime(date('Y-m-d H:i:s', strtotime("-4 hours"))))
				return FALSE;
			return $data[0]['max'];
		}
		return FALSE;
	}
	
	function get_series_revenue($end = ''){
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-d', strtotime($end .' -30 day'));
		
		$data['rev'] = $this->db->query("
		select x.tgl_spj, reguler, eagle, tiara from (select tgl_spj, sum(total_rev + coalesce(angsuran_ks,0) + coalesce(bayar_hutang, 0)) as reguler from rev_pool 
		join master_pool on master_pool.id = id_pool where tgl_spj >= '".$start."' and tgl_spj <= '".$end."' and (master_pool.pool_area <= 2 or master_pool.pool_area = 6 or master_pool.pool_area = 7)
		group by tgl_spj order by tgl_spj) as x
		join 
		(select tgl_spj, sum(total_rev + coalesce(total_denda, 0) + coalesce(bayar_hutang, 0)) as eagle from rev_pool 
		join master_pool on master_pool.id = id_pool where tgl_spj >= '".$start."' and tgl_spj <= '".$end."' and master_pool.pool_area = 4 
		group by tgl_spj order by tgl_spj) as y on x.tgl_spj = y.tgl_spj
		join 
		(select tgl_spj, sum(total_rev + coalesce(total_denda, 0) + coalesce(bayar_hutang, 0)) as tiara from rev_pool 
		join master_pool on master_pool.id = id_pool where tgl_spj >= '".$start."' and tgl_spj <= '".$end."' and master_pool.pool_area = 5 
		group by tgl_spj order by tgl_spj) as z on x.tgl_spj = z.tgl_spj;")->result_array();
		
		$data['revs'] = $this->db->query("
			select tgl_spj, sum(total_rev + coalesce(total_denda, 0) + coalesce(bayar_hutang, 0) + coalesce(angsuran_ks, 0)) as total_rev, sum(ks_operasi + ks_non_operasi + coalesce(total_setoran_telat, 0)) as total_ks from rev_pool 
			join master_pool on master_pool.id = id_pool and master_pool.pool_area <> 3 where tgl_spj >= '".$start."' and tgl_spj <= '".$end."' 
			group by tgl_spj order by tgl_spj;")->result_array();
	
		return $data;
	}
	
	function get_detail($id, $date){
		$data = $this->db->query("select * from ops_pool join master_pool on master_pool.id = ops_pool.id_pool 
		left join rev_pool on ops_pool.id_pool = rev_pool.id_pool and master_pool.id = rev_pool.id_pool and rev_pool.tgl_spj = ops_pool.tgl_spj 
		where ops_pool.id_pool = ".$id." and ops_pool.tgl_spj = '".$date."';")->result_array();
		return $data;
	}
	
	function get_detail_area($id, $date){
		$month = date("m",strtotime($date));
		$year = date("Y",strtotime($date));
		$last_30 = date('Y-m-d', strtotime($date .' -30 day'));
		$day1 = date('Y-m-1', strtotime($date));
		$data = $this->db->query("select * from (select ops_pool.id_pool as id_poolx, * from ops_pool join master_pool on master_pool.id = ops_pool.id_pool 
			left join rev_pool on ops_pool.id_pool = rev_pool.id_pool and master_pool.id = rev_pool.id_pool and rev_pool.tgl_spj = ops_pool.tgl_spj 
			where master_pool.pool_area = ".$id." and ops_pool.tgl_spj = '".$date."') x join 
			(select id_pool, avg(ops_tp) as avg_tp, avg(ops_operasi) as avg_spj from ops_pool 
			where tgl_spj >= '".$last_30."' group by id_pool) y on x.id_poolx = y.id_pool
			join 
			(select id_pool, -sum(ks_operasi + coalesce(total_setoran_telat, 0)) as ksmurni_ytd, -sum(ks_non_operasi) as kstp_ytd, -sum(ks_operasi + ks_non_operasi + coalesce(total_setoran_telat, 0)) as ks_total_ytd, sum(total_rev + bayar_hutang + (case when total_denda > 0 then total_denda else 0 end) + 
			(case when total_lain > 0 then total_lain else 0 end) + (case when angsuran_ks > 0 then angsuran_ks else 0 end) + (case when total_setoran_telat > 0 then total_setoran_telat else 0 end)) as rev_ytd, sum(total_spj) as spj_ytd from rev_pool 
			where tgl_spj <= '".$date."' and extract(year from tgl_spj) = ".$year." group by id_pool) as w on x.id_poolx = w.id_pool and y.id_pool = w.id_pool
			join
			(select id_pool, -sum(ks_operasi + coalesce(total_setoran_telat, 0)) as ksmurni_mtd, -sum(ks_non_operasi) as kstp_mtd, -sum(ks_operasi + ks_non_operasi + coalesce(total_setoran_telat, 0)) as ks_total_mtd, sum(total_rev + bayar_hutang + (case when total_denda > 0 then total_denda else 0 end) + 
			(case when total_lain > 0 then total_lain else 0 end) + (case when angsuran_ks > 0 then angsuran_ks else 0 end) + 
			(case when total_setoran_telat > 0 then total_setoran_telat else 0 end)) as rev_mtd, sum(total_spj) as spj_mtd from rev_pool 
			where tgl_spj <= '".$date."' and extract(year from tgl_spj) = ".$year." and extract(month from tgl_spj) = ".$month." group by id_pool) as z on x.id_poolx = z.id_pool 
			and w.id_pool = z.id_pool and y.id_pool = z.id_pool
			join
			(select rev_pool.id_pool, sum(total_rev + bayar_hutang + (case when total_denda > 0 then total_denda else 0 end) + (case when total_lain > 0 then total_lain else 0 end) + (case when angsuran_ks > 0 then angsuran_ks else 0 end) + (case when total_setoran_telat > 0 then total_setoran_telat else 0 end)) as rev_mtd from rev_pool join master_pool on master_pool.id = rev_pool.id_pool and master_pool.pool_area = ".$id." 
			where tgl_spj >= '".$day1."' and tgl_spj <= '".$date."' group by rev_pool.id_pool) as revs on revs.id_pool = x.id_poolx
			join
			(select ops_pool.id_pool, sum(ops_operasi) as ops_mtd from ops_pool join master_pool on master_pool.id = ops_pool.id_pool and master_pool.pool_area = ".$id." 
			where tgl_spj >= '".$day1."' and tgl_spj <= '".$date."' group by ops_pool.id_pool) as ops on ops.id_pool = x.id_poolx
			;")->result_array();

		return $data;
	}
	
	function get_series_detail($id, $end){
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-d', strtotime($end .' -30 day'));
		$start_120 = date('Y-m-d', strtotime($end .' -120 day'));
				
		$data['operasi'] = $this->db->query("
		select ops_pool.tgl_spj, sum(ops_operasi) as op, sum(ops_non_operasi) as non_op, sum(ops_tp) as tp, sum(ops_so) as sos
		, sum(ops_broken) as broken, sum(ops_other) as other, sum(ops_argo_rds) as argo_rds, sum(ops_surat) as surat, sum(ops_tl) as tl, sum(ops_other) as lain from ops_pool 
		where ops_pool.tgl_spj >= '".$start."' and ops_pool.tgl_spj <= '".$end."' and ops_pool.id_pool = ".$id." 
		group by ops_pool.tgl_spj order by ops_pool.tgl_spj;")->result_array();
		
		$data['revenue'] = $this->db->query("
		select rev_pool.tgl_spj, sum(total_rev + coalesce(total_denda, 0) + coalesce(bayar_hutang, 0) + coalesce(angsuran_ks, 0)) as rev, sum(nominal_insentif_kehadiran) as insentif, sum(total_bbm) as bbm, sum(total_komisi) as komisi, sum(total_gross) as gross, -sum(ks_non_operasi + ks_operasi + coalesce(total_setoran_telat, 0)) as ks,
		-sum(ks_non_operasi) as kstp, -sum(ks_operasi + coalesce(total_setoran_telat, 0)) as ksmurni from rev_pool 
		where rev_pool.tgl_spj >= '".$start."' and rev_pool.tgl_spj <= '".$end."' and rev_pool.id_pool = ".$id." 
		group by rev_pool.tgl_spj order by rev_pool.tgl_spj;")->result_array();
		
		$data['moving'] = $this->db->query("select tgl_spj, sum(ops_operasi) as operasi from ops_pool
			where tgl_spj >= '".$start_120."' and tgl_spj <= '".$end."' and ops_pool.id_pool = ".$id."  group by tgl_spj order by tgl_spj;")->result_array();
		
		return $data;
	}
	
	function get_series_area($id, $end){
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-d', strtotime($end .' -30 day'));
		$start_120 = date('Y-m-d', strtotime($end .' -120 day'));
		
		$data['operasi'] = $this->db->query("
		select tgl_spj, sum(ops_operasi) as op, sum(ops_non_operasi) as non_op, sum(ops_tp) as tp, sum(ops_so) as sos, sum(ops_broken) as broken, sum(ops_other) as other, 
		sum(ops_argo_rds) as argo_rds, sum(ops_surat) as surat, sum(ops_tl) as tl, sum(ops_other) as lain from ops_pool 
		join master_pool on master_pool.id = ops_pool.id_pool 
		where ops_pool.tgl_spj >= '".$start."' and ops_pool.tgl_spj <= '".$end."' and master_pool.pool_area = ".$id." 
		group by ops_pool.tgl_spj order by ops_pool.tgl_spj;")->result_array();
		
		$data['revenue'] = $this->db->query("
		select tgl_spj, sum(total_rev + coalesce(total_denda, 0) + coalesce(bayar_hutang, 0) + coalesce(angsuran_ks, 0)) as rev, sum(total_bbm) as bbm, sum(nominal_insentif_kehadiran) as insentif, sum(total_komisi) as komisi, sum(total_gross) as gross, -sum(ks_non_operasi + ks_operasi + coalesce(total_setoran_telat, 0)) as ks,
		-sum(ks_non_operasi) as kstp, -sum(ks_operasi) as ksmurni from rev_pool 
		join master_pool on master_pool.id = rev_pool.id_pool 
		where rev_pool.tgl_spj >= '".$start."' and rev_pool.tgl_spj <= '".$end."' and master_pool.pool_area = ".$id." 
		group by rev_pool.tgl_spj order by rev_pool.tgl_spj;")->result_array();
		
		$data['moving'] = $this->db->query("select tgl_spj, sum(ops_operasi) as operasi from ops_pool join master_pool on master_pool.id = ops_pool.id_pool 
			and master_pool.pool_area = ".$id." 
			where tgl_spj >= '".$start_120."' and tgl_spj <= '".$end."' group by tgl_spj order by tgl_spj;")->result_array();
		
		return $data;
	}
	
	function check_area($area, $id_pool){
		$data = $this->db->query("select id from master_pool where pool_area = ".$area." and id = '".$id_pool."' limit 1;")->num_rows();
		return $data;
	}
	
	function check_reguler_area($id_pool){
		$data = $this->db->query("select id from master_pool where pool_area < 4 and id = '".$id_pool."' limit 1;")->num_rows();
		return $data;
	}
	
	//KS UNIT
	function save_backup_ks($data){
		$saves = array();
		foreach((Array) $data AS $key => $val){
			$save = array();
			foreach (Array('tgl_spj', 'id_pool', 'reg_no', 'setor', 'ks', 's_wajib', 's_lain', 'denda', 'bayar_ks', 'tipe_ops',
				'spj_code', 'jenis_mitra') AS $keys => $vals) {
				if (array_key_exists($vals, (array) $val))
					$save[$vals] = $val[$vals];
			}
			$save['last_update'] = date('Y-m-d H:i:s');
			array_push($saves, $save);
		}
		$this->db->insert_batch('reguler_ks', $saves);
	}
	
	function delete_backup_ks($start, $end, $data){
		$id_pool = '';
		foreach((Array) $data AS $key => $val){
			if($id_pool === ''){
				$id_pool .= "'".$val."'";
			} else {
				$id_pool .= ", '".$val."'";
			}
		}
		$this->db->query("delete from reguler_ks where tgl_spj >= '$start' and tgl_spj <= '$end' and id_pool in ($id_pool);");		
// 		$this->db->where('tgl_spj >= ', $start)->where('tgl_spj <= ', $end)->delete('reguler_ks');
	}
	
	function get_ks_unit($id, $date){
		if($date === '')
			$date = date('Y-m-d',strtotime("-1 days"));
			
		$data = $this->db->query("select reguler_ks.*, username, tipe_alasan, komentar, create_dt from reguler_ks 
			left join comment_ks on comment_ks.spj_code = reguler_ks.spj_code
			where reguler_ks.id_pool = ".$id." and tgl_spj = '".$date."' order by setor desc, ks, bayar_ks desc, reg_no;")->result_array();
		return $data;	
	}
	
	function check_ks_unit($id, $date){
		if(strtotime($date) > strtotime(date('Y-m-d', strtotime("-1 day")))) 
			return TRUE;
			
		$data = $this->db->query("select max(last_update), sum(case when setor = 0 and bayar_ks = 0 then 1 else 0 end) as telat_setor from reguler_ks where id_pool = ".$id." and tgl_spj = '".$date."' limit 1;")->result_array();
		if($data[0]['telat_setor'] === null) return FALSE;
		if(strtotime($data[0]['max']) < strtotime(date('Y-m-d H:i:s', strtotime("-6 hours"))) && $data[0]['telat_setor'] > 0)
			return FALSE;
		return TRUE;
	}
	
	function get_comment_ks($spj_array){
		$data = $this->db->query("select * from comment_ks where spj_code in ($spj_array);")->result_array();
		return $data;
	}
	
	function check_comment_ks($id_pool, $date){
		$data = $this->db->query("select id, tgl_spj, id_pool from(
			select tgl_spj, reguler_ks.id_pool as id_pool, comment_ks.id from reguler_ks left join comment_ks on comment_ks.spj_code = reguler_ks.spj_code 
			where tgl_spj >= '".Admin::DATE_USE_COMMENT_KS."' and reguler_ks.id_pool IN ($id_pool) and tgl_spj < '$date' and bayar_ks + ks < 0) b where id is null;")->result_array();
		return $data;
	}
	
	function get_alasan_ks(){
		$data = $this->db->query("select id, alasan_ks from master_alasan_ks where active = 1 order by id;")->result_array();
		return $data;
	}
	
	function save_comment_ks($data){
		$save = array();
		foreach (Array('username', 'tipe_alasan', 'komentar', 'spj_code', 'id_pool', 'rit', 'argo'
			) AS $keys => $vals) {
			if (array_key_exists($vals, (array) $data))
				$save[$vals] = $data[$vals];
		}
		$save['create_dt'] = date('Y-m-d H:i:s');
		$this->db->insert('comment_ks', $save);
		return TRUE;
	}
	
	function get_performa_operasi_ks($id, $date){
		$start = date('Y-m-1', strtotime($date));
		$data = $this->db->query("select a.username, coalesce(sum(ks + bayar_ks), 0) as ks, count(ks) as ct from cac_user a
			left join comment_ks b on a.username = b.username  and b.id_pool = pool and pool = $id
			left join reguler_ks on reguler_ks.spj_code = b.spj_code and reguler_ks.id_pool = pool and reguler_ks.id_pool = b.id_pool 
				and pool = $id and tgl_spj >= '$start' and tgl_spj <= '$date'
			where pool = $id and id_privilege = 6 and a.active = 1
			group by a.username order by ks;")->result_array();
		return $data;
	}
	
	function get_performa_operasi_ks_detail($username, $id, $date){
		$start = date('Y-m-1', strtotime($date));
		$data = $this->db->query("select tgl_spj, argo, rit, c.alasan_ks, komentar, setor + bayar_ks as setor, ks, a.spj_code 
			from comment_ks a join master_alasan_ks c on c.id = a.tipe_alasan 
			join reguler_ks b on a.spj_code = b.spj_code and a.id_pool = $id and tgl_spj >= '$start' and username = '$username'
			and tgl_spj <= '$date' order by tgl_spj, alasan_ks;")->result_array();
		return $data;
	}
	
	function get_pool_id_in_area($id_area){
		$data = $this->db->query("select id from master_pool where active = 1 and pool_area = ".$id_area.";")->result_array();
		return $data;
	}
	
	function check_rit_rds_unit($id, $date){
		$data = $this->db->query("select max(last_update), sum(case when setor = 0 then 1 else 0 end) as telat_setor, sum(coalesce(rit_from_rds, 0)) as rit from reguler_ks where id_pool = ".$id." and tgl_spj = '".$date."' limit 1;")->result_array();
		if($data[0]['telat_setor'] === null) return FALSE;
		if($data[0]['rit'] === '0') return FALSE;
		if(strtotime($data[0]['max']) < strtotime(date('Y-m-d H:i:s', strtotime("-2 hours"))) && $data[0]['telat_setor'] > 0)
			return FALSE;
		return TRUE;
	}
	
	function update_ks_unit_rit_rds($data){
// 		$arr = array('argo_from_rds' => $data['argo_from_rds'], 'rit_from_rds' => $data['rit_from_rds'], 'last_update' => date('Y-m-d H:i:s'));
// 		$this->db->where('id', $data['id']);
// 		$this->db->update('reguler_ks',$arr);
		$this->db->update_batch('reguler_ks',$data, 'id'); 
	}
	
	function get_reguler_ks_telat($date){
		if($date === '')
			$date = date('Y-m-d',strtotime("-1 days"));
		
		$data = $this->db->query("select id_pool, count(reg_no) as ct, sum(bayar_ks) total_setoran, sum(case when bayar_ks > 0 then 1 else 0 end) as sudah_setor from reguler_ks
			where tgl_spj = '".$date."' and setor = 0 group by id_pool order by id_pool;")->result_array();
		
		return $data;
			
	}
	
	//DRIVER
	function save_backup_driver($data){
		foreach((Array) $data AS $key => $val){
			$save = array();
			foreach (Array('tgl', 'id_pool', 'bravo_aktif', 'bravo_inaktif', 'charli_aktif', 'charli_inaktif', 'driver_aktif', 'driver_inaktif', 
				'driver_retire', 'driver_blacklist', 
				'd1', 'd2', 'd3', 'd4', 'd5', 'd6', 'd7', 'd8', 'd9', 'd10', 
				'd11', 'd12', 'd13', 'd14', 'd15', 'd16', 'd17', 'd18', 'd19', 'd20',
				'd21', 'd22', 'd23', 'd24', 'd25', 'd26', 'd27', 'd28', 'd29', 'd30', 'd31'
				) AS $keys => $vals) {
				if (array_key_exists($vals, (array) $val))
					$save[$vals] = $val[$vals];
			}
			$save['last_update'] = date('Y-m-d H:i:s');
			$this->db->insert('driver_pool', $save);
		}
	}
	
	function delete_backup_driver($start, $end){
		$this->db->where('tgl >=', $start)->where('tgl <=', $end)->delete('driver_pool');
	}
	
	function get_driver($date = ''){
		if($date === '')
			$date = date('Y-m-d',strtotime("-1 days"));
			
		$data = $this->db->query("select * from 
			(select name, pool_area, driver_pool.* from driver_pool join master_pool on master_pool.id = driver_pool.id_pool where tgl = '".$date."' order by id_pool) a join
			(select tgl, id_pool, sum(d1 + d2 + d3 + d4 + d5 + d6 + d7 + d8 + d9 + d10 + d11 + d12 + d13 + d14 + d15 + d16 + d17 + d18 + d19 + d20 + d21 + d22 + d23 + d24 + d25 + d26 + d27 + d28 + d29 + d30 + d31) as ct,
			sum(d1 * 1 + d2 * 2 + d3 * 3 + d4 * 4 + d5 * 5 + d6 * 6 + d7 * 7 + d8 * 8 + d9 * 9 + d10 * 10 + d11 * 11 + d12 * 12 + d13 * 13 + d14 * 14 + d15 * 15 + 
			d16 * 16 + d17 * 17 + d18 * 18 + d19 * 19 + d20 * 20 + d21 * 21 + d22 * 22 + d23 * 23 + d24 * 24 + d25 * 25+ d26 * 26+ d27 * 27 + d28 * 28 + d29 * 29 + d30 * 30 + d31 * 31) as total_hk
			from driver_pool where tgl = '".$date."' group by tgl, id_pool) b on a.id_pool = b.id_pool and a.tgl = b.tgl")->result_array();
		return $data;
	}
	
	function get_series_driver($end){
		$start = date('Y-m-01', strtotime($end));	
		$data = $this->db->query("select tgl, sum(d1) as d1, sum(d2) as d2, sum(d3) as d3, sum(d4) as d4, sum(d5) as d5, sum(d6) as d6, sum(d7) as d7, sum(d8) as d8, sum(d9) as d9, sum(d10) as d10, 
			sum(d11) as d11, sum(d12) as d12, sum(d13,22) as d13, sum(d14) as d14, sum(d15) as d15, sum(d16) as d16, sum(d17) as d17, sum(d18) as d18, sum(d19) as d19, sum(d20) as d20,
			sum(d21) as d21, sum(d22) as d22, sum(d23) as d23, sum(d24) as d24, sum(d25) as d25, sum(d26) as d26, sum(d27) as d27, sum(d28) as d28, sum(d29) as d29, sum(d30) as d30,
			sum(d31) as d31, sum(d1 + d2 + d3 + d4 + d5 + d6 + d7 + d8 + d9 + d10 + d11 + d12 + d13 + d14 + d15 + d16 + d17 + d18 + d19 + d20 + d21 + d22 + d23 + d24 + d25 + d26 + d27 + d28 + d29 + d30 + d31) as total,
			sum(d1 * 1 + d2 * 2 + d3 * 3 + d4 * 4 + d5 * 5 + d6 * 6 + d7 * 7 + d8 * 8 + d9 * 9 + d10 * 10 + d11 * 11 + d12 * 12 + d13 * 13 + d14 * 14 + d15 * 15 + 
			d16 * 16 + d17 * 17 + d18 * 18 + d19 * 19 + d20 * 20 + d21 * 21 + d22 * 22 + d23 * 23 + d24 * 24 + d25 * 25+ d26 * 26+ d27 * 27 + d28 * 28 + d29 * 29 + d30 * 30 + d31 * 31) as ct
			from driver_pool join master_pool on master_pool.id = driver_pool.id_pool where tgl = '".$end."' group by tgl;")->result_array();
			
		return $data;	
	}
	
	function get_series_driver_area($area, $end){
		$start = date('Y-m-01', strtotime($end));	
		$data = $this->db->query("select tgl, sum(d1) as d1, sum(d2) as d2, sum(d3) as d3, sum(d4) as d4, sum(d5) as d5, sum(d6) as d6, sum(d7) as d7, sum(d8) as d8, sum(d9) as d9, sum(d10) as d10, 
			sum(d11) as d11, sum(d12) as d12, sum(d13,22) as d13, sum(d14) as d14, sum(d15) as d15, sum(d16) as d16, sum(d17) as d17, sum(d18) as d18, sum(d19) as d19, sum(d20) as d20,
			sum(d21) as d21, sum(d22) as d22, sum(d23) as d23, sum(d24) as d24, sum(d25) as d25, sum(d26) as d26, sum(d27) as d27, sum(d28) as d28, sum(d29) as d29, sum(d30) as d30,
			sum(d31) as d31, sum(d1 + d2 + d3 + d4 + d5 + d6 + d7 + d8 + d9 + d10 + d11 + d12 + d13 + d14 + d15 + d16 + d17 + d18 + d19 + d20 + d21 + d22 + d23 + d24 + d25 + d26 + d27 + d28 + d29 + d30 + d31) as total,
			sum(d1 * 1 + d2 * 2 + d3 * 3 + d4 * 4 + d5 * 5 + d6 * 6 + d7 * 7 + d8 * 8 + d9 * 9 + d10 * 10 + d11 * 11 + d12 * 12 + d13 * 13 + d14 * 14 + d15 * 15 + 
			d16 * 16 + d17 * 17 + d18 * 18 + d19 * 19 + d20 * 20 + d21 * 21 + d22 * 22 + d23 * 23 + d24 * 24 + d25 * 25+ d26 * 26+ d27 * 27 + d28 * 28 + d29 * 29 + d30 * 30 + d31 * 31) as ct
			from driver_pool join master_pool on master_pool.id = driver_pool.id_pool and master_pool.pool_area = ".$area." where tgl = '".$end."' group by tgl;")->result_array();
			
		return $data;	
	}
	
	function get_series_driver_pool($id, $end){
		$start = date('Y-m-01', strtotime($end));	
		$data = $this->db->query("select tgl, sum(d1) as d1, sum(d2) as d2, sum(d3) as d3, sum(d4) as d4, sum(d5) as d5, sum(d6) as d6, sum(d7) as d7, sum(d8) as d8, sum(d9) as d9, sum(d10) as d10, 
			sum(d11) as d11, sum(d12) as d12, sum(d13,22) as d13, sum(d14) as d14, sum(d15) as d15, sum(d16) as d16, sum(d17) as d17, sum(d18) as d18, sum(d19) as d19, sum(d20) as d20,
			sum(d21) as d21, sum(d22) as d22, sum(d23) as d23, sum(d24) as d24, sum(d25) as d25, sum(d26) as d26, sum(d27) as d27, sum(d28) as d28, sum(d29) as d29, sum(d30) as d30,
			sum(d31) as d31, sum(d1 + d2 + d3 + d4 + d5 + d6 + d7 + d8 + d9 + d10 + d11 + d12 + d13 + d14 + d15 + d16 + d17 + d18 + d19 + d20 + d21 + d22 + d23 + d24 + d25 + d26 + d27 + d28 + d29 + d30 + d31) as total,
			sum(d1 * 1 + d2 * 2 + d3 * 3 + d4 * 4 + d5 * 5 + d6 * 6 + d7 * 7 + d8 * 8 + d9 * 9 + d10 * 10 + d11 * 11 + d12 * 12 + d13 * 13 + d14 * 14 + d15 * 15 + 
			d16 * 16 + d17 * 17 + d18 * 18 + d19 * 19 + d20 * 20 + d21 * 21 + d22 * 22 + d23 * 23 + d24 * 24 + d25 * 25+ d26 * 26+ d27 * 27 + d28 * 28 + d29 * 29 + d30 * 30 + d31 * 31) as ct
			from driver_pool join master_pool on master_pool.id = driver_pool.id_pool and driver_pool.id_pool = ".$id." where tgl = '".$end."' group by tgl;")->result_array();
			
		return $data;	
	}
	
	function check_driver($date){
		$data = $this->db->query("select max(last_update) as max from driver_pool where tgl = '".$date."' limit 1")->result_array();
		if(Count($data) > 0){
			return $data[0]['max'];
		}
		return FALSE;
	}
	
	//CAR
	function save_backup_car($data){
		$saves = array();
		foreach((Array) $data AS $key => $val){
			$save = array();
			foreach (Array('tgl', 'id_pool', 
				'd1', 'd2', 'd3', 'd4', 'd5', 'd6', 'd7', 'd8', 'd9', 'd10', 
				'd11', 'd12', 'd13', 'd14', 'd15', 'd16', 'd17', 'd18', 'd19', 'd20',
				'd21', 'd22', 'd23', 'd24', 'd25', 'd26', 'd27', 'd28', 'd29', 'd30', 'd31'
				) AS $keys => $vals) {
				if (array_key_exists($vals, (array) $val))
					$save[$vals] = $val[$vals];
			}
			$save['last_update'] = date('Y-m-d H:i:s');
			array_push($saves, $save);
		}
		$this->db->insert_batch('car_pool', $saves);
	}
	
	function delete_backup_car($start, $end){
		$this->db->where('tgl >=', $start)->where('tgl <=', $end)->delete('car_pool');
	}
	
	function get_car_by_id($id, $date){
		$data = $this->db->query("select * from car_pool where id_pool = ".$id." and tgl = '".$date."';")->result_array();
		return $data;
	}
	
	function get_car($date = ''){
		if($date === '')
			$date = date('Y-m-d',strtotime("-1 days"));
			
		$data = $this->db->query("select * from 
			(select name, pool_area, car_pool.* from car_pool join master_pool on master_pool.id = car_pool.id_pool where tgl = '".$date."' order by id_pool) a join
			(select tgl, id_pool, sum(d1 + d2 + d3 + d4 + d5 + d6 + d7 + d8 + d9 + d10 + d11 + d12 + d13 + d14 + d15 + d16 + d17 + d18 + d19 + d20 + d21 + d22 + d23 + d24 + d25 + d26 + d27 + d28 + d29 + d30 + d31) as ct,
			sum(d1 * 1 + d2 * 2 + d3 * 3 + d4 * 4 + d5 * 5 + d6 * 6 + d7 * 7 + d8 * 8 + d9 * 9 + d10 * 10 + d11 * 11 + d12 * 12 + d13 * 13 + d14 * 14 + d15 * 15 + 
			d16 * 16 + d17 * 17 + d18 * 18 + d19 * 19 + d20 * 20 + d21 * 21 + d22 * 22 + d23 * 23 + d24 * 24 + d25 * 25+ d26 * 26+ d27 * 27 + d28 * 28 + d29 * 29 + d30 * 30 + d31 * 31) as total_hk
			from car_pool where tgl = '".$date."' group by tgl, id_pool) b on a.id_pool = b.id_pool and a.tgl = b.tgl")->result_array();
		return $data;
	}
	
	function get_series_car($end){
		$start = date('Y-m-01', strtotime($end));	
		$data = $this->db->query("select tgl, sum(d1) as d1, sum(d2) as d2, sum(d3) as d3, sum(d4) as d4, sum(d5) as d5, sum(d6) as d6, sum(d7) as d7, sum(d8) as d8, sum(d9) as d9, sum(d10) as d10, 
			sum(d11) as d11, sum(d12) as d12, sum(d13,22) as d13, sum(d14) as d14, sum(d15) as d15, sum(d16) as d16, sum(d17) as d17, sum(d18) as d18, sum(d19) as d19, sum(d20) as d20,
			sum(d21) as d21, sum(d22) as d22, sum(d23) as d23, sum(d24) as d24, sum(d25) as d25, sum(d26) as d26, sum(d27) as d27, sum(d28) as d28, sum(d29) as d29, sum(d30) as d30,
			sum(d31) as d31, sum(d1 + d2 + d3 + d4 + d5 + d6 + d7 + d8 + d9 + d10 + d11 + d12 + d13 + d14 + d15 + d16 + d17 + d18 + d19 + d20 + d21 + d22 + d23 + d24 + d25 + d26 + d27 + d28 + d29 + d30 + d31) as total,
			sum(d1 * 1 + d2 * 2 + d3 * 3 + d4 * 4 + d5 * 5 + d6 * 6 + d7 * 7 + d8 * 8 + d9 * 9 + d10 * 10 + d11 * 11 + d12 * 12 + d13 * 13 + d14 * 14 + d15 * 15 + 
			d16 * 16 + d17 * 17 + d18 * 18 + d19 * 19 + d20 * 20 + d21 * 21 + d22 * 22 + d23 * 23 + d24 * 24 + d25 * 25+ d26 * 26+ d27 * 27 + d28 * 28 + d29 * 29 + d30 * 30 + d31 * 31) as ct
			from car_pool join master_pool on master_pool.id = car_pool.id_pool where tgl = '".$end."' group by tgl;")->result_array();
			
		return $data;	
	}
	
	function get_series_car_pool($id, $end){
		$start = date('Y-m-01', strtotime($end));	
		$data = $this->db->query("select tgl, sum(d1) as d1, sum(d2) as d2, sum(d3) as d3, sum(d4) as d4, sum(d5) as d5, sum(d6) as d6, sum(d7) as d7, sum(d8) as d8, sum(d9) as d9, sum(d10) as d10, 
			sum(d11) as d11, sum(d12) as d12, sum(d13,22) as d13, sum(d14) as d14, sum(d15) as d15, sum(d16) as d16, sum(d17) as d17, sum(d18) as d18, sum(d19) as d19, sum(d20) as d20,
			sum(d21) as d21, sum(d22) as d22, sum(d23) as d23, sum(d24) as d24, sum(d25) as d25, sum(d26) as d26, sum(d27) as d27, sum(d28) as d28, sum(d29) as d29, sum(d30) as d30,
			sum(d31) as d31, sum(d1 + d2 + d3 + d4 + d5 + d6 + d7 + d8 + d9 + d10 + d11 + d12 + d13 + d14 + d15 + d16 + d17 + d18 + d19 + d20 + d21 + d22 + d23 + d24 + d25 + d26 + d27 + d28 + d29 + d30 + d31) as total,
			sum(d1 * 1 + d2 * 2 + d3 * 3 + d4 * 4 + d5 * 5 + d6 * 6 + d7 * 7 + d8 * 8 + d9 * 9 + d10 * 10 + d11 * 11 + d12 * 12 + d13 * 13 + d14 * 14 + d15 * 15 + 
			d16 * 16 + d17 * 17 + d18 * 18 + d19 * 19 + d20 * 20 + d21 * 21 + d22 * 22 + d23 * 23 + d24 * 24 + d25 * 25+ d26 * 26+ d27 * 27 + d28 * 28 + d29 * 29 + d30 * 30 + d31 * 31) as ct
			from car_pool join master_pool on master_pool.id = car_pool.id_pool and car_pool.id_pool = ".$id." where tgl = '".$end."' group by tgl;")->result_array();
			
		return $data;	
	}
	
	function get_series_car_area($area, $end){
		$start = date('Y-m-01', strtotime($end));	
		$data = $this->db->query("select tgl, sum(d1) as d1, sum(d2) as d2, sum(d3) as d3, sum(d4) as d4, sum(d5) as d5, sum(d6) as d6, sum(d7) as d7, sum(d8) as d8, sum(d9) as d9, sum(d10) as d10, 
			sum(d11) as d11, sum(d12) as d12, sum(d13,22) as d13, sum(d14) as d14, sum(d15) as d15, sum(d16) as d16, sum(d17) as d17, sum(d18) as d18, sum(d19) as d19, sum(d20) as d20,
			sum(d21) as d21, sum(d22) as d22, sum(d23) as d23, sum(d24) as d24, sum(d25) as d25, sum(d26) as d26, sum(d27) as d27, sum(d28) as d28, sum(d29) as d29, sum(d30) as d30,
			sum(d31) as d31, sum(d1 + d2 + d3 + d4 + d5 + d6 + d7 + d8 + d9 + d10 + d11 + d12 + d13 + d14 + d15 + d16 + d17 + d18 + d19 + d20 + d21 + d22 + d23 + d24 + d25 + d26 + d27 + d28 + d29 + d30 + d31) as total,
			sum(d1 * 1 + d2 * 2 + d3 * 3 + d4 * 4 + d5 * 5 + d6 * 6 + d7 * 7 + d8 * 8 + d9 * 9 + d10 * 10 + d11 * 11 + d12 * 12 + d13 * 13 + d14 * 14 + d15 * 15 + 
			d16 * 16 + d17 * 17 + d18 * 18 + d19 * 19 + d20 * 20 + d21 * 21 + d22 * 22 + d23 * 23 + d24 * 24 + d25 * 25+ d26 * 26+ d27 * 27 + d28 * 28 + d29 * 29 + d30 * 30 + d31 * 31) as ct
			from car_pool join master_pool on master_pool.id = car_pool.id_pool and master_pool.pool_area = ".$area." where tgl = '".$end."' group by tgl;")->result_array();
		return $data;	
	}
	
	//MAP
	function get_pools(){
		$data = $this->db->query("select * from master_pool where pool_area <> 3 and active = 1 order by id;")->result_array();
		return $data;
	}
	
	function get_pools_maps(){
		$data = $this->db->query("select * from master_pool where pool_area <> 3 and active = 1 and (name not like '%Eagle%') and pool_area not in (8) and id not in (61,63) order by id;")->result_array();
		return $data;
	}
	
	
	function get_shelters(){
		$data = $this->db->where('active', 1)->get('master_shelter')->result_array();
		return $data;
	}
	
	function get_shelters_premium(){
		$data = $this->db->where('active', 1)->get('master_shelter_premium')->result_array();
		return $data;
	}
	
	//RITASE SHELTER
	function save_backup_taxi_shelter($data){
		$saves = array();
		foreach((Array) $data AS $key => $val){
			$save = array();
			foreach (Array('time_start', 'time_end', 'id_shelter', 'no_pintu', 'argo', 'start_lat', 'start_lng', 'end_lat', 'end_lng', 'flag_tiara', 'id_pool', 'id_trip'
				) AS $keys => $vals) {
				if (array_key_exists($vals, (array) $val))
					$save[$vals] = $val[$vals];
			}
			array_push($saves, $save);
		}
		$this->db->insert_batch('taxi_shelter', $saves);
	}
	
	function delete_backup_taxi_shelter($start, $end){
		$this->db->where('date(time_start) >=', $start)->where('date(time_start) <=', $end)->delete('taxi_shelter');
	}
	
	function check_ritase_shelter($start, $end){
		$end = date('Y-m-d 23:59:59', strtotime($end));
		$data = $this->db->query("select max(time_start) as last_update from taxi_shelter where time_start >='".$start."' and time_start <= '".$end."' limit 1;")->result_array();
		return $data;
	}
	
	function get_ritase_shelter($start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));	
		$data['data'] = $this->db->query("select a.id, name, tipe, argo, ritase, coalesce(ritase_mtd,0) as ritase_mtd, 
			coalesce(argo_mtd,0) as argo_mtd, coalesce(ritase_ytd,0) as ritase_ytd, coalesce(argo_ytd,0) as argo_ytd from
			(select master_shelter.id, name, tipe, coalesce(count(no_pintu), 0) as ritase, coalesce(sum(argo),0) as argo from master_shelter 
			full join taxi_shelter on master_shelter.id = taxi_shelter.id_shelter and date(time_start) >= '".$start."' and date(time_start) <= '".$end."' where active = 1
			group by master_shelter.id, name, tipe) a
			full join
			(select id_shelter, count(no_pintu) as ritase_mtd, sum(argo) as argo_mtd from taxi_shelter join master_shelter on master_shelter.id = id_shelter where active = 1
			and date(time_start) >= '".$month."' and date(time_start) <= '".$end."' group by id_shelter) b on b.id_shelter = a.id
			full join 
			(select id_shelter, count(no_pintu) as ritase_ytd, sum(argo) as argo_ytd from taxi_shelter join master_shelter on master_shelter.id = id_shelter where active = 1
			and extract(year from time_start) = '".$year."' and date(time_start) <= '".$end."' group by id_shelter) c on c.id_shelter = a.id
			order by ritase_ytd desc;")->result_array();
		$data['unit_unique'] = $this->db->query("select count(distinct(no_pintu)) as ct from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."';")->result_array();	
		$data['series'] = $this->db->query("select ct as ritase, count(ct) as ct from (select no_pintu, count(no_pintu) as ct 
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' group by no_pintu order by ct) x group by ct;")->result_array();
		return $data;
	}
	
	function get_ritase_shelter_by_tipe($start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));	
		$data = $this->db->query("select a.tipe, argo, ritase, ritase_mtd, argo_mtd, ritase_ytd, argo_ytd from (select tipe, sum(argo) as argo, count(id_shelter) as ritase 
			from master_shelter left join taxi_shelter on taxi_shelter.id_shelter = id  where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and active = 1 group by tipe) a 
			join
			(select tipe, count(no_pintu) as ritase_mtd, sum(argo) as argo_mtd from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1
			where date(time_start) >= '".$month."' and date(time_start) <= '".$end."' and active = 1 group by tipe) b on b.tipe = a.tipe
			join 
			(select tipe, count(no_pintu) as ritase_ytd, sum(argo) as argo_ytd from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1
			where extract(year from time_start) = '".$year."' and date(time_start) <= '".$end."'  and active = 1 group by tipe) c on c.tipe = a.tipe
			order by ritase_ytd desc
			;")->result_array();
		return $data;
	}
	
	function get_ritase_shelter_by_area($start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));	
		$data = $this->db->query("select a.area, argo, ritase, ritase_mtd, argo_mtd, ritase_ytd, argo_ytd from (select area, sum(argo) as argo, count(id_shelter) as ritase 
			from master_shelter left join taxi_shelter on taxi_shelter.id_shelter = id  where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and active = 1 group by area) a 
			join
			(select area, count(no_pintu) as ritase_mtd, sum(argo) as argo_mtd from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1
			where date(time_start) >= '".$month."' and date(time_start) <= '".$end."' and active = 1 group by area) b on b.area = a.area
			join 
			(select area, count(no_pintu) as ritase_ytd, sum(argo) as argo_ytd from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1
			where extract(year from time_start) = '".$year."' and date(time_start) <= '".$end."' and active = 1 group by area) c on c.area = a.area
			order by a.area
			;")->result_array();
		return $data;
	}
	
	function get_ritase_shelter_by_pool($start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));	
		$data = $this->db->query("select id, name, coalesce(argo, 0) as argo, coalesce(ct, 0) as ct, coalesce(units, 0) as unit from (select id, name from master_pool where pool_area <> 3 and active = 1) x 
			full join 
			(select id_pool, sum(argo) as argo, count(no_pintu) as ct, count(distinct(no_pintu)) as units from taxi_shelter 
				where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' group by id_pool) y
			on y.id_pool = x.id order by id;")->result_array();
		return $data;
	}
	
	function get_detail_tipe_shelter($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));	
		$data['data'] = $this->db->query("select a.id, name, tipe, argo, ritase, coalesce(ritase_mtd,0) as ritase_mtd, 
			coalesce(argo_mtd,0) as argo_mtd, coalesce(ritase_ytd,0) as ritase_ytd, coalesce(argo_ytd,0) as argo_ytd from
			(select master_shelter.id, name, tipe, coalesce(count(no_pintu), 0) as ritase, coalesce(sum(argo),0) as argo from master_shelter 
			left join taxi_shelter on master_shelter.id = taxi_shelter.id_shelter and date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and tipe = '".$id."' and active = 1
			group by master_shelter.id, name, tipe) a
			join
			(select id_shelter, count(no_pintu) as ritase_mtd, sum(argo) as argo_mtd from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1
			where date(time_start) >= '".$month."' and date(time_start) <= '".$end."' and tipe = '".$id."' and active = 1 group by id_shelter) b on b.id_shelter = a.id
			join 
			(select id_shelter, count(no_pintu) as ritase_ytd, sum(argo) as argo_ytd from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1
			where extract(year from time_start) = '".$year."' and date(time_start) <= '".$end."' and tipe = '".$id."' and active = 1 group by id_shelter) c on c.id_shelter = a.id
			order by ritase_ytd desc;")->result_array();
		$data['unit_unique'] = $this->db->query("select count(distinct(no_pintu)) as ct from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 
			where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and tipe = '".$id."';")->result_array();	
		$data['series'] = $this->db->query("select ct as ritase, count(ct) as ct from (select no_pintu, count(no_pintu) as ct 
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and tipe = '".$id."'
			group by no_pintu order by ct) x group by ct;")->result_array();
		return $data;
	}
	
	function get_detail_area_shelter($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));		
		$data['data'] = $this->db->query("select a.id, name, area, argo, ritase, coalesce(ritase_mtd,0) as ritase_mtd, 
			coalesce(argo_mtd,0) as argo_mtd, coalesce(ritase_ytd,0) as ritase_ytd, coalesce(argo_ytd,0) as argo_ytd from
			(select master_shelter.id, name, area, coalesce(count(no_pintu), 0) as ritase, coalesce(sum(argo),0) as argo from master_shelter 
			left join taxi_shelter on master_shelter.id = taxi_shelter.id_shelter and date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and area = '".$id."' and active = 1
			group by master_shelter.id, name, area) a
			join
			(select id_shelter, count(no_pintu) as ritase_mtd, sum(argo) as argo_mtd from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1
			where date(time_start) >= '".$month."' and date(time_start) <= '".$end."' and area = '".$id."' and active = 1 group by id_shelter) b on b.id_shelter = a.id
			join 
			(select id_shelter, count(no_pintu) as ritase_ytd, sum(argo) as argo_ytd from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1
			where extract(year from time_start) = '".$year."' and date(time_start) <= '".$end."' and area = '".$id."' and active = 1 group by id_shelter) c on c.id_shelter = a.id
			order by ritase_ytd desc;")->result_array();
		$data['unit_unique'] = $this->db->query("select count(distinct(no_pintu)) as ct from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 
			where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and area = '".$id."';")->result_array();	
		$data['series'] = $this->db->query("select ct as ritase, count(ct) as ct from (select no_pintu, count(no_pintu) as ct 
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and area = '".$id."'
			group by no_pintu order by ct) x group by ct;")->result_array();
		return $data;
	}
	
	function get_detail_area_big_shelter($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));		
		
		if($id === 'A'){
			$id = '2,5,6';
		} else if($id === 'B'){
			$id = '1,3,4';
		}
		
		$data['data'] = $this->db->query("select a.id, name, area, argo, ritase, coalesce(ritase_mtd,0) as ritase_mtd, 
			coalesce(argo_mtd,0) as argo_mtd, coalesce(ritase_ytd,0) as ritase_ytd, coalesce(argo_ytd,0) as argo_ytd from
			(select master_shelter.id, name, area, coalesce(count(no_pintu), 0) as ritase, coalesce(sum(argo),0) as argo from master_shelter 
			left join taxi_shelter on master_shelter.id = taxi_shelter.id_shelter and date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and area in (".$id.") and active = 1
			group by master_shelter.id, name, area) a
			join
			(select id_shelter, count(no_pintu) as ritase_mtd, sum(argo) as argo_mtd from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1
			where date(time_start) >= '".$month."' and date(time_start) <= '".$end."' and area in (".$id.") and active = 1 group by id_shelter) b on b.id_shelter = a.id
			join 
			(select id_shelter, count(no_pintu) as ritase_ytd, sum(argo) as argo_ytd from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1
			where extract(year from time_start) = '".$year."' and date(time_start) <= '".$end."' and area in (".$id.") and active = 1 group by id_shelter) c on c.id_shelter = a.id
			order by ritase_ytd desc;")->result_array();
		$data['unit_unique'] = $this->db->query("select count(distinct(no_pintu)) as ct from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 
			where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and area in (".$id.");")->result_array();	
		$data['series'] = $this->db->query("select ct as ritase, count(ct) as ct from (select no_pintu, count(no_pintu) as ct 
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and area in (".$id.")
			group by no_pintu order by ct) x group by ct;")->result_array();
		return $data;
	}
	
	function get_detail_pool_shelter($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));		
		$data['data'] = $this->db->query("select a.id, name, argo, ritase, coalesce(ritase_mtd,0) as ritase_mtd, 
			coalesce(argo_mtd,0) as argo_mtd, coalesce(ritase_ytd,0) as ritase_ytd, coalesce(argo_ytd,0) as argo_ytd from
			(select master_shelter.id, name, coalesce(count(no_pintu), 0) as ritase, coalesce(sum(argo),0) as argo from master_shelter 
			left join taxi_shelter on master_shelter.id = taxi_shelter.id_shelter and date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id_pool = '".$id."' and active = 1
			group by master_shelter.id, name) a
			join
			(select id_shelter, count(no_pintu) as ritase_mtd, sum(argo) as argo_mtd from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1
			where date(time_start) >= '".$month."' and date(time_start) <= '".$end."' and id_pool = '".$id."' and active = 1 group by id_shelter) b on b.id_shelter = a.id
			join 
			(select id_shelter, count(no_pintu) as ritase_ytd, sum(argo) as argo_ytd from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1
			where extract(year from time_start) = '".$year."' and date(time_start) <= '".$end."' and id_pool = '".$id."' and active = 1 group by id_shelter) c on c.id_shelter = a.id
			order by ritase_ytd desc;")->result_array();
		$data['unit_unique'] = $this->db->query("select count(distinct(no_pintu)) as ct from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 
			where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id_pool = '".$id."';")->result_array();	
		$data['series'] = $this->db->query("select ct as ritase, count(ct) as ct from (select no_pintu, count(no_pintu) as ct 
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id_pool = '".$id."'
			group by no_pintu order by ct) x group by ct;")->result_array();
		return $data;
	}
	
	function get_detail_shelter($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));		
		$data['data'] = $this->db->query("select a.id, name, argo, ritase, coalesce(ritase_mtd,0) as ritase_mtd, 
			coalesce(argo_mtd,0) as argo_mtd, coalesce(ritase_ytd,0) as ritase_ytd, coalesce(argo_ytd,0) as argo_ytd from
			(select master_shelter.id, name, coalesce(count(no_pintu), 0) as ritase, coalesce(sum(argo),0) as argo from master_shelter 
			left join taxi_shelter on master_shelter.id = taxi_shelter.id_shelter and date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id = ".$id." and active = 1
			group by master_shelter.id, name) a
			join
			(select id_shelter, count(no_pintu) as ritase_mtd, sum(argo) as argo_mtd from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1
			where date(time_start) >= '".$month."' and date(time_start) <= '".$end."' and id = ".$id." and active = 1 group by id_shelter) b on b.id_shelter = a.id
			join 
			(select id_shelter, count(no_pintu) as ritase_ytd, sum(argo) as argo_ytd from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1
			where extract(year from time_start) = '".$year."' and date(time_start) <= '".$end."' and id = ".$id." and active = 1 group by id_shelter) c on c.id_shelter = a.id
			order by ritase_ytd desc;")->result_array();
		$data['unit_unique'] = $this->db->query("select count(distinct(no_pintu)) as ct from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id = ".$id.";")->result_array();	
		$data['series'] = $this->db->query("select ct as ritase, count(ct) as ct from (select no_pintu, count(no_pintu) as ct 
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id = ".$id." group by no_pintu order by ct) x group by ct;")->result_array();
		return $data;
	}
	
	function get_detail_shelter_by_pool($id, $idPool, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));		
		$data['data'] = $this->db->query("select a.id, name, argo, ritase, coalesce(ritase_mtd,0) as ritase_mtd, 
			coalesce(argo_mtd,0) as argo_mtd, coalesce(ritase_ytd,0) as ritase_ytd, coalesce(argo_ytd,0) as argo_ytd from
			(select master_shelter.id, name, coalesce(count(no_pintu), 0) as ritase, coalesce(sum(argo),0) as argo from master_shelter 
			left join taxi_shelter on master_shelter.id = taxi_shelter.id_shelter and date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id = ".$id." and id_pool = ".$idPool." and active = 1
			group by master_shelter.id, name) a
			join
			(select id_shelter, count(no_pintu) as ritase_mtd, sum(argo) as argo_mtd from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1
			where date(time_start) >= '".$month."' and date(time_start) <= '".$end."' and id = ".$id." and id_pool = ".$idPool." and active = 1 group by id_shelter) b on b.id_shelter = a.id
			join 
			(select id_shelter, count(no_pintu) as ritase_ytd, sum(argo) as argo_ytd from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1
			where extract(year from time_start) = '".$year."' and date(time_start) <= '".$end."' and id = ".$id." and id_pool = ".$idPool." and active = 1 group by id_shelter) c on c.id_shelter = a.id
			order by ritase_ytd desc;")->result_array();
		$data['unit_unique'] = $this->db->query("select count(distinct(no_pintu)) as ct from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id = ".$id." and id_pool = ".$idPool.";")->result_array();	
		$data['series'] = $this->db->query("select ct as ritase, count(ct) as ct from (select no_pintu, count(no_pintu) as ct 
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id = ".$id." and id_pool = ".$idPool." group by no_pintu order by ct) x group by ct;")->result_array();
		return $data;
	}
	
	function get_monthly_series_shelter($end = ''){
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-d', strtotime($end ."-30 days"));	
		$data = $this->db->query("select date(time_start) as tgl, sum(argo) as total_argo, 			
			sum(case when area = 1 then 1 else 0 end) as rit_area1, sum(case when area = 2 then 1 else 0 end) as rit_area2, sum(case when area = 3 then 1 else 0 end) as rit_area3,
			sum(case when area = 4 then 1 else 0 end) as rit_area4, sum(case when area = 5 then 1 else 0 end) as rit_area5, sum(case when area = 6 then 1 else 0 end) as rit_area6,
			sum(case when tipe = 'Mall' then 1 else 0 end) as rit_mall, 
			sum(case when tipe = 'Apartment' then 1 else 0 end) as rit_apartment, sum(case when tipe = 'Hotel' then 1 else 0 end) as rit_hotel,
			sum(case when tipe = 'Other' then 1 else 0 end) as rit_other, sum(case when tipe = 'Office' then 1 else 0 end) as rit_office,
			sum(case when tipe = 'Hospital' then 1 else 0 end) as rit_hospital,
			count(distinct(no_pintu)) as total_unit
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' group by tgl order by tgl;")->result_array();
			
		return $data;	
	}
	
	function get_monthly_series_tipe_shelter($id, $end = ''){
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-d', strtotime($end ."-30 days"));	
		$data = $this->db->query("select date(time_start) as tgl, sum(argo) as total_argo, count(no_pintu) as total_ritase, count(distinct(no_pintu)) as total_unit
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 and tipe = '".$id."'
			where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' group by tgl order by tgl;")->result_array();
			
		return $data;	
	}
	
	function get_monthly_series_area_shelter($id, $end = ''){
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-d', strtotime($end ."-30 days"));	
		$data = $this->db->query("select date(time_start) as tgl, sum(argo) as total_argo, count(no_pintu) as total_ritase, count(distinct(no_pintu)) as total_unit
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 and area = '".$id."'
			where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' group by tgl order by tgl;")->result_array();
			
		return $data;	
	}
	
	function get_monthly_series_area_big_shelter($id, $end = ''){
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
			
		if($id === 'A'){
			$id = '2,5,6';
		} else if($id === 'B'){
			$id = '1,3,4';
		}
		
		$start = date('Y-m-d', strtotime($end ."-30 days"));	
		$data = $this->db->query("select date(time_start) as tgl, sum(argo) as total_argo, 			
			sum(case when area = 1 then 1 else 0 end) as rit_area1, sum(case when area = 2 then 1 else 0 end) as rit_area2, sum(case when area = 3 then 1 else 0 end) as rit_area3,
			sum(case when area = 4 then 1 else 0 end) as rit_area4, sum(case when area = 5 then 1 else 0 end) as rit_area5, sum(case when area = 6 then 1 else 0 end) as rit_area6,
			sum(case when tipe = 'Mall' then 1 else 0 end) as rit_mall, 
			sum(case when tipe = 'Apartment' then 1 else 0 end) as rit_apartment, sum(case when tipe = 'Hotel' then 1 else 0 end) as rit_hotel,
			sum(case when tipe = 'Other' then 1 else 0 end) as rit_other, sum(case when tipe = 'Office' then 1 else 0 end) as rit_office,
			sum(case when tipe = 'Hospital' then 1 else 0 end) as rit_hospital,
			count(distinct(no_pintu)) as total_unit
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 and area in (".$id.")
			where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' group by tgl order by tgl;")->result_array();
			
		return $data;	
	}
	
	function get_monthly_series_pool_shelter($id, $end = ''){
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-d', strtotime($end ."-30 days"));	
		$data = $this->db->query("select date(time_start) as tgl, sum(argo) as total_argo, 			
			sum(case when area = 1 then 1 else 0 end) as rit_area1, sum(case when area = 2 then 1 else 0 end) as rit_area2, sum(case when area = 3 then 1 else 0 end) as rit_area3,
			sum(case when area = 4 then 1 else 0 end) as rit_area4, sum(case when area = 5 then 1 else 0 end) as rit_area5, sum(case when area = 6 then 1 else 0 end) as rit_area6,
			sum(case when tipe = 'Mall' then 1 else 0 end) as rit_mall, 
			sum(case when tipe = 'Apartment' then 1 else 0 end) as rit_apartment, sum(case when tipe = 'Hotel' then 1 else 0 end) as rit_hotel,
			sum(case when tipe = 'Other' then 1 else 0 end) as rit_other, sum(case when tipe = 'Office' then 1 else 0 end) as rit_office,
			sum(case when tipe = 'Hospital' then 1 else 0 end) as rit_hospital,
			count(distinct(no_pintu)) as total_unit
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 and id_pool = '".$id."'
			where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' group by tgl order by tgl;")->result_array();
			
		return $data;	
	}
	
	function get_monthly_series_shelter_detail($id, $end = ''){
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-d', strtotime($end ."-30 days"));	
		$data = $this->db->query("select date(time_start) as tgl, sum(argo) as total_argo, count(no_pintu) as total_ritase, count(distinct(no_pintu)) as total_unit
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id = ".$id." group by tgl order by tgl;")->result_array();
			
		return $data;	
	}
	
	function get_monthly_series_shelter_detail_pool($id, $idPool, $end = ''){
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-d', strtotime($end ."-30 days"));	
		$data = $this->db->query("select date(time_start) as tgl, sum(argo) as total_argo, count(no_pintu) as total_ritase, count(distinct(no_pintu)) as total_unit
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id = ".$id." and id_pool = ".$idPool." group by tgl order by tgl;")->result_array();
			
		return $data;	
	}
	
	function get_ritase_hour_shelter($start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$data = $this->db->query("select extract(hour from time_start) as hr, sum(case when tipe = 'Mall' then 1 else 0 end) as rit_mall, 
			sum(case when tipe = 'Apartment' then 1 else 0 end) as rit_apartment, sum(case when tipe = 'Hotel' then 1 else 0 end) as rit_hotel,
			sum(case when tipe = 'Other' then 1 else 0 end) as rit_other, sum(case when tipe = 'Office' then 1 else 0 end) as rit_office,
			sum(case when tipe = 'Hospital' then 1 else 0 end) as rit_hospital, count(no_pintu) as total_ritase, sum(argo) as total_argo 
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' group by hr order by hr;")->result_array();
		return $data;
	}
	
	function get_ritase_hour_tipe_shelter($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));	
		$data = $this->db->query("select extract(hour from time_start) as hr, count(no_pintu) as total_ritase, sum(argo) as total_argo 
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 and tipe = '".$id."'
			where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' group by hr order by hr;")->result_array();
		return $data;
	}
	
	function get_ritase_hour_area_shelter($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));	
		$data = $this->db->query("select extract(hour from time_start) as hr, count(no_pintu) as total_ritase, sum(argo) as total_argo 
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 and area = '".$id."'
			where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' group by hr order by hr;")->result_array();
		return $data;
	}
	
	function get_ritase_hour_area_big_shelter($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		
		if($id === 'A'){
			$id = '2,5,6';
		} else if($id === 'B'){
			$id = '1,3,4';
		}	
		
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));	
		$data = $this->db->query("select extract(hour from time_start) as hr, sum(case when tipe = 'Mall' then 1 else 0 end) as rit_mall, 
			sum(case when tipe = 'Apartment' then 1 else 0 end) as rit_apartment, sum(case when tipe = 'Hotel' then 1 else 0 end) as rit_hotel,
			sum(case when tipe = 'Other' then 1 else 0 end) as rit_other, sum(case when tipe = 'Office' then 1 else 0 end) as rit_office,
			sum(case when tipe = 'Hospital' then 1 else 0 end) as rit_hospital, count(no_pintu) as total_ritase, sum(argo) as total_argo 
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 and area in (".$id.")
			where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' group by hr order by hr;")->result_array();
		return $data;
	}
	
	function get_ritase_hour_pool_shelter($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));	
		$data = $this->db->query("select extract(hour from time_start) as hr, sum(case when tipe = 'Mall' then 1 else 0 end) as rit_mall, 
			sum(case when tipe = 'Apartment' then 1 else 0 end) as rit_apartment, sum(case when tipe = 'Hotel' then 1 else 0 end) as rit_hotel,
			sum(case when tipe = 'Other' then 1 else 0 end) as rit_other, sum(case when tipe = 'Office' then 1 else 0 end) as rit_office,
			sum(case when tipe = 'Hospital' then 1 else 0 end) as rit_hospital, count(no_pintu) as total_ritase, sum(argo) as total_argo 
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 and id_pool = '".$id."'
			where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' group by hr order by hr;")->result_array();
		return $data;
	}
	
	function get_ritase_hour_shelter_detail($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));	
		$data = $this->db->query("select extract(hour from time_start) as hr, count(no_pintu) as total_ritase, sum(argo) as total_argo 
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 
			where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id = ".$id." group by hr order by hr;")->result_array();
		return $data;
	}
	
	function get_ritase_hour_shelter_detail_pool($id, $idPool, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));	
		$data = $this->db->query("select extract(hour from time_start) as hr, count(no_pintu) as total_ritase, sum(argo) as total_argo 
			from taxi_shelter join master_shelter on master_shelter.id = id_shelter and active = 1 
			where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id = ".$id." and id_pool = ".$idPool." group by hr order by hr;")->result_array();
		return $data;
	}
	
	function get_shelter_detail_unit($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$data = $this->db->query("select * from taxi_shelter where id_shelter = ".$id." and date(time_start) >= '".$start."' and date(time_start) <= '".$end."' order by time_start, no_pintu;")->result_array();
		return $data;
	}
	
	function get_shelter_detail_unit_pool($id, $idPool, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$data = $this->db->query("select * from taxi_shelter where id_shelter = ".$id." and date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id_pool = ".$idPool." order by time_start, no_pintu;")->result_array();
		return $data;
	}
	
	function get_shelter($id){
		$data = $this->db->query("select * from master_shelter where id = ".$id." and active = 1;")->result_array();
		return $data;
	}
	
	function get_shelter_locations($id){
		$data = $this->db->query("select name, master_shelter.lat as mst_lat, master_shelter.lng as mst_lng, 
			shelter_coordinate.lat, shelter_coordinate.lng, shelter_coordinate.radius from master_shelter 
			left join shelter_coordinate on master_shelter.id = id_shelter where master_shelter.id = ".$id.";")->result_array();
		return $data;
	}
	
	function get_all_shelters_locations(){
		$data = $this->db->query("select master_shelter.id, shelter_coordinate.lat, shelter_coordinate.lng, shelter_coordinate.radius from master_shelter 
			left join shelter_coordinate on master_shelter.id = id_shelter where master_shelter.active = 1;")->result_array();
		return $data;
	}
	
	function get_all_shelters_tiara(){
		$data = $this->db->query("select master_shelter.id, shelter_coordinate.lat, shelter_coordinate.lng, shelter_coordinate.radius from master_shelter 
			left join shelter_coordinate on master_shelter.id = id_shelter where master_shelter.active = 1 and master_shelter.flag_tiara = 1;")->result_array();
		return $data;	
	}
	
	//RITASE AIRPORT
	function save_backup_taxi_bandara($data){
		$saves = array();
		foreach((Array) $data AS $key => $val){
			$save = array();
			foreach (Array('time_start', 'time_end', 'id_shelter', 'no_pintu', 'argo', 'start_lat', 'start_lng', 'end_lat', 'end_lng', 'id_trip', 'flag_tiara', 'id_pool'
				) AS $keys => $vals) {
				if (array_key_exists($vals, (array) $val))
					$save[$vals] = $val[$vals];
			}
			array_push($saves, $save);
		}
		$this->db->insert_batch('taxi_bandara', $saves);
	}
	
	function delete_backup_taxi_bandara($start, $end){
		$this->db->where('date(time_start) >=', $start)->where('date(time_start) <=', $end)->delete('taxi_bandara');
	}
	
	function check_ritase_airport($start, $end){
		$end = date('Y-m-d 23:59:59', strtotime($end));
		$data = $this->db->query("select max(time_start) as last_update from taxi_bandara where time_start >='".$start."' and time_start <= '".$end."' limit 1;")->result_array();
		return $data;
	}
	
	function get_ritase_bandara($start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));	
		$data['data'] = $this->db->query("select a.id, name, area, argo, ritase, coalesce(ritase_mtd,0) as ritase_mtd, 
			coalesce(argo_mtd,0) as argo_mtd, coalesce(ritase_ytd,0) as ritase_ytd, coalesce(argo_ytd,0) as argo_ytd from
			(select master_bandara.id, name, area, coalesce(count(no_pintu), 0) as ritase, coalesce(sum(argo),0) as argo from master_bandara 
			left join taxi_bandara on master_bandara.id = taxi_bandara.id_shelter and date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and active = 1
			group by master_bandara.id, name, area) a
			join
			(select id_shelter, count(no_pintu) as ritase_mtd, sum(argo) as argo_mtd from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1
			where date(time_start) >= '".$month."' and date(time_start) <= '".$end."' and active = 1 group by id_shelter) b on b.id_shelter = a.id
			join 
			(select id_shelter, count(no_pintu) as ritase_ytd, sum(argo) as argo_ytd from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1
			where extract(year from time_start) = '".$year."' and date(time_start) <= '".$end."' and active = 1 group by id_shelter) c on c.id_shelter = a.id
			order by ritase_ytd desc;")->result_array();
		$data['unit_unique'] = $this->db->query("select count(distinct(no_pintu)) as ct from taxi_bandara join master_shelter on master_shelter.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."';")->result_array();	
		$data['series'] = $this->db->query("select ct as total_ritase, count(ct) as ct from (select no_pintu, count(no_pintu) as ct 
			from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' group by no_pintu order by ct) x group by ct;")->result_array();
		$data['tiara'] = $this->db->query("select count(distinct(no_pintu)) as ct_tiara, count(no_pintu) as rit_tiara, sum(argo) as argo_tiara from taxi_bandara join master_shelter on master_shelter.id = id_shelter and taxi_bandara.flag_tiara = 1 and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."';")->result_array();	
		return $data;
	}
	
	function get_ritase_bandara_by_pool($start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));	
		$data = $this->db->query("select id, name, coalesce(argo, 0) as argo, coalesce(ct, 0) as ct, coalesce(units, 0) as unit from (select id, name from master_pool where pool_area <> 3 and active = 1) x 
			full join 
			(select id_pool, sum(argo) as argo, count(no_pintu) as ct, count(distinct(no_pintu)) as units from taxi_bandara 
				where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' group by id_pool) y
			on y.id_pool = x.id order by id;")->result_array();
		return $data;
	}
	
	function get_detail_bandara($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));		
		$data['data'] = $this->db->query("select a.id, name, argo, ritase, coalesce(ritase_mtd,0) as ritase_mtd, 
			coalesce(argo_mtd,0) as argo_mtd, coalesce(ritase_ytd,0) as ritase_ytd, coalesce(argo_ytd,0) as argo_ytd from
			(select master_bandara.id, name, coalesce(count(no_pintu), 0) as ritase, coalesce(sum(argo),0) as argo from master_bandara 
			left join taxi_bandara on master_bandara.id = taxi_bandara.id_shelter and date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id = ".$id." and active = 1
			group by master_bandara.id, name) a
			join
			(select id_shelter, count(no_pintu) as ritase_mtd, sum(argo) as argo_mtd from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1
			where date(time_start) >= '".$month."' and date(time_start) <= '".$end."' and id = ".$id." and active = 1 group by id_shelter) b on b.id_shelter = a.id
			join 
			(select id_shelter, count(no_pintu) as ritase_ytd, sum(argo) as argo_ytd from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1
			where extract(year from time_start) = '".$year."' and date(time_start) <= '".$end."' and id = ".$id." and active = 1 group by id_shelter) c on c.id_shelter = a.id
			order by ritase_ytd desc;")->result_array();
		$data['unit_unique'] = $this->db->query("select count(distinct(no_pintu)) as ct from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id = ".$id.";")->result_array();	
		$data['series'] = $this->db->query("select ct as total_ritase, count(ct) as ct from (select no_pintu, count(no_pintu) as ct 
			from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id = ".$id." group by no_pintu order by ct) x group by ct;")->result_array();
		$data['tiara'] = $this->db->query("select count(distinct(no_pintu)) as ct_tiara, count(no_pintu) as rit_tiara, sum(argo) as argo_tiara from taxi_bandara join master_shelter on master_shelter.id = id_shelter and taxi_bandara.flag_tiara = 1 and id = ".$id." and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."';")->result_array();				
		return $data;
	}
	
	function get_detail_bandara_by_pool($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));		
		$data['data'] = $this->db->query("select a.id, name, argo, ritase, coalesce(ritase_mtd,0) as ritase_mtd, 
			coalesce(argo_mtd,0) as argo_mtd, coalesce(ritase_ytd,0) as ritase_ytd, coalesce(argo_ytd,0) as argo_ytd from
			(select master_bandara.id, name, coalesce(count(no_pintu), 0) as ritase, coalesce(sum(argo),0) as argo from master_bandara 
			left join taxi_bandara on master_bandara.id = taxi_bandara.id_shelter and date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id_pool = ".$id." and active = 1
			group by master_bandara.id, name) a
			join
			(select id_shelter, count(no_pintu) as ritase_mtd, sum(argo) as argo_mtd from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1
			where date(time_start) >= '".$month."' and date(time_start) <= '".$end."' and id_pool = ".$id." and active = 1 group by id_shelter) b on b.id_shelter = a.id
			join 
			(select id_shelter, count(no_pintu) as ritase_ytd, sum(argo) as argo_ytd from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1
			where extract(year from time_start) = '".$year."' and date(time_start) <= '".$end."' and id_pool = ".$id." and active = 1 group by id_shelter) c on c.id_shelter = a.id
			order by ritase_ytd desc;")->result_array();
		$data['unit_unique'] = $this->db->query("select count(distinct(no_pintu)) as ct from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id_pool = ".$id.";")->result_array();	
		$data['series'] = $this->db->query("select ct as total_ritase, count(ct) as ct from (select no_pintu, count(no_pintu) as ct 
			from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id_pool = ".$id." group by no_pintu order by ct) x group by ct;")->result_array();
		$data['tiara'] = $this->db->query("select count(distinct(no_pintu)) as ct_tiara, count(no_pintu) as rit_tiara, sum(argo) as argo_tiara from taxi_bandara join master_shelter on master_shelter.id = id_shelter and taxi_bandara.flag_tiara = 1 and id_pool = ".$id." and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."';")->result_array();				
		return $data;
	}
	
	function get_monthly_series_bandara($end = ''){
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-d', strtotime($end ."-30 days"));	
		$data = $this->db->query("select date(time_start) as tgl, sum(argo) as total_argo, 
			sum(case when id_shelter = 1 then 1 else 0 end) as rit_1, sum(case when id_shelter = 2 then 1 else 0 end) as rit_2, sum(case when id_shelter = 3 then 1 else 0 end) as rit_3,
			sum(case when id_shelter = 4 then 1 else 0 end) as rit_4, sum(case when id_shelter = 5 then 1 else 0 end) as rit_5, sum(case when id_shelter = 6 then 1 else 0 end) as rit_6,
			sum(case when id_shelter = 7 then 1 else 0 end) as rit_7, 			
			sum(case when flag_tiara = 1 then 1 else 0 end) as rit_tiara, sum(case when flag_tiara = 0 then 1 else 0 end) as rit_non_tiara,
			count(distinct(no_pintu)) as total_unit
			from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' group by tgl order by tgl;")->result_array();
			
		return $data;	
	}
	
	function get_monthly_series_bandara_detail($id, $end = ''){
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-d', strtotime($end ."-30 days"));	
		$data = $this->db->query("select date(time_start) as tgl, sum(argo) as total_argo, count(no_pintu) as total_ritase, count(distinct(no_pintu)) as total_unit,
			sum(case when flag_tiara = 1 then 1 else 0 end) as rit_tiara, sum(case when flag_tiara = 0 then 1 else 0 end) as rit_non_tiara	
			from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id = ".$id." group by tgl order by tgl;")->result_array();
			
		return $data;	
	}
	
	function get_monthly_series_bandara_detail_pool($id, $end = ''){
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-d', strtotime($end ."-30 days"));	
		$data = $this->db->query("select date(time_start) as tgl, sum(argo) as total_argo, 
			sum(case when id_shelter = 1 then 1 else 0 end) as rit_1, sum(case when id_shelter = 2 then 1 else 0 end) as rit_2, sum(case when id_shelter = 3 then 1 else 0 end) as rit_3,
			sum(case when id_shelter = 4 then 1 else 0 end) as rit_4, sum(case when id_shelter = 5 then 1 else 0 end) as rit_5, sum(case when id_shelter = 6 then 1 else 0 end) as rit_6,
			sum(case when id_shelter = 7 then 1 else 0 end) as rit_7, 			
			sum(case when flag_tiara = 1 then 1 else 0 end) as rit_tiara, sum(case when flag_tiara = 0 then 1 else 0 end) as rit_non_tiara,
			count(distinct(no_pintu)) as total_unit	
			from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id_pool = ".$id." group by tgl order by tgl;")->result_array();
			
		return $data;	
	}
	
	function get_ritase_hour_bandara($start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$data = $this->db->query("select extract(hour from time_start) as hr, sum(argo) as total_argo, count(no_pintu) as total_ritase,
			sum(case when id_shelter = 1 then 1 else 0 end) as rit_1, sum(case when id_shelter = 2 then 1 else 0 end) as rit_2, sum(case when id_shelter = 3 then 1 else 0 end) as rit_3,
			sum(case when id_shelter = 4 then 1 else 0 end) as rit_4, sum(case when id_shelter = 5 then 1 else 0 end) as rit_5, sum(case when id_shelter = 6 then 1 else 0 end) as rit_6,
			sum(case when id_shelter = 7 then 1 else 0 end) as rit_7
			from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1 where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' group by hr order by hr;")->result_array();
		return $data;
	}
	
	function get_ritase_hour_bandara_detail($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));	
		$data = $this->db->query("select extract(hour from time_start) as hr, count(no_pintu) as total_ritase, sum(argo) as total_argo,
			sum(case when flag_tiara = 1 then 1 else 0 end) as rit_tiara, sum(case when flag_tiara = 0 then 1 else 0 end) as rit_non_tiara
			from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1 
			where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id = ".$id." group by hr order by hr;")->result_array();
		return $data;
	}
	
	function get_ritase_hour_bandara_detail_pool($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$month = date('Y-m-01', strtotime($end));	
		$year = date("Y",strtotime($end));	
		$data = $this->db->query("select extract(hour from time_start) as hr, sum(argo) as total_argo, count(no_pintu) as total_ritase,
			sum(case when id_shelter = 1 then 1 else 0 end) as rit_1, sum(case when id_shelter = 2 then 1 else 0 end) as rit_2, sum(case when id_shelter = 3 then 1 else 0 end) as rit_3,
			sum(case when id_shelter = 4 then 1 else 0 end) as rit_4, sum(case when id_shelter = 5 then 1 else 0 end) as rit_5, sum(case when id_shelter = 6 then 1 else 0 end) as rit_6,
			sum(case when id_shelter = 7 then 1 else 0 end) as rit_7
			from taxi_bandara join master_bandara on master_bandara.id = id_shelter and active = 1 
			where date(time_start) >= '".$start."' and date(time_start) <= '".$end."' and id_pool = ".$id." group by hr order by hr;")->result_array();
		return $data;
	}
	
	function get_bandara_detail_unit($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$data = $this->db->query("select * from taxi_bandara where id_shelter = ".$id." and date(time_start) >= '".$start."' and date(time_start) <= '".$end."' order by time_start, no_pintu;")->result_array();
		return $data;
	}
	
	function get_bandara_detail_unit_pool($id, $start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$data = $this->db->query("select taxi_bandara.*, master_bandara.name from taxi_bandara join master_bandara on master_bandara.id = id_shelter where id_pool = ".$id." and date(time_start) >= '".$start."' and date(time_start) <= '".$end."' order by time_start, no_pintu;")->result_array();
		return $data;
	}
	
	function get_bandara($id){
		$data = $this->db->query("select * from master_bandara where id = ".$id." and active = 1;")->result_array();
		return $data;
	}
	
	function get_bandara_locations($id){
		$data = $this->db->query("select name, master_bandara.lat as mst_lat, master_bandara.lng as mst_lng, lat, lng,
			radius from master_bandara where master_bandara.id = ".$id.";")->result_array();
		return $data;
	}
	
	function get_all_bandara_locations(){
		$data = $this->db->query("select id, lat, lng, radius from master_bandara where master_bandara.active = 1;")->result_array();
		return $data;
	}
	
	//SETORAN DRIVER UBER
	function check_uber_driver_setoran($date, $id){
		$data = $this->db->query("select id_pool from uber_driver_setoran where id_pool = ".$id." and tgl_spj = '".$date."';")->num_rows();
		return $data > 0;
	}
	
	function load_pool_driver_uber(){
		$data = $this->db->query("select id_pool from uber_driver group by id_pool order by id_pool;")->result_array();
		return $data;
	}
	
	function load_drivers_from_pool($id){
		$data = $this->db->query("select name, kip from uber_driver where id_pool = ".$id.";")->result_array();
		return $data;
	}
	
	function delete_backup_uber_driver_setoran($start, $end){
		$this->db->where('tgl_spj >=', $start)->where('tgl_spj <=', $end)->delete('uber_driver_setoran');
	}
	
	function delete_backup_uber_driver_setoran_pool($date, $id){
		$this->db->where('tgl_spj =', $date)->where('id_pool =', $id)->delete('uber_driver_setoran');
	}
	
	function save_backup_uber_driver_setoran($data){
		$saves = array();
		foreach((Array) $data AS $key => $val){
			$save = array();
			foreach (Array('tgl_spj', 'id_pool', 'kip', 'no_pintu', 'setor', 'ks', 's_wajib', 
				'rit_rds', 'argo_rds', 's_lain', 'denda', 'bayar_ks', 'tipe_ops') AS $keys => $vals) {
				if (array_key_exists($vals, (array) $val))
					$save[$vals] = $val[$vals];
			}
			$save['last_update'] = date('Y-m-d H:i:s');
			array_push($saves, $save);
		}
		$this->db->insert_batch('uber_driver_setoran', $saves);
	}
	
	function get_uber_driver_setoran($date, $id){
		$data = $this->db->query("select name, no_pintu, uber_driver.kip, setor, s_wajib, s_lain, denda, ks, bayar_ks, rit_rds, argo_rds from uber_driver left join uber_driver_setoran on uber_driver_setoran.kip = uber_driver.kip and tgl_spj = '".$date."' where uber_driver.id_pool = ".$id." order by ks, s_wajib desc;")->result_array();
		return $data;
	}
	
	function is_uber_pool($id){
		$data = $this->db->query("select id_pool from uber_driver where id_pool = ".$id.";")->num_rows();
		if($data > 0){
			return TRUE;
		}
		return FALSE;
	}
	
	//RITASE RDS
	function check_ritase_rds(){
		$date = date('Y-m-d', strtotime("-1 days"));
		$data = $this->db->query("select max(last_update) as max from ritase_rds where tgl = '".$date."' limit 1")->result_array();
		if(Count($data) > 0){
			return $data[0]['max'];
		}
		return FALSE;
	}
	
	function save_backup_ritase_rds($data){
		$saves = array();
		foreach((Array) $data AS $key => $val){
			$save = array();
			foreach (Array('tgl', 'id', 'pool_id', 'ritase', 'ct', 'total_ritase', 'total_argo'
				) AS $keys => $vals) {
				if (array_key_exists($vals, (array) $val))
					$save[$vals] = $val[$vals];
			}
			$save['last_update'] = date('Y-m-d H:i:s');
			array_push($saves, $save);
		}
		$this->db->insert_batch('ritase_rds', $saves);
	}
	
	function delete_backup_ritase_rds($start, $end){
		$this->db->where('tgl >=', $start)->where('tgl <=', $end)->delete('ritase_rds');
	}
	
	function get_ritase_rds($start = '', $end = ''){
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$data['data'] = $this->db->query("select pool_area, name, total_unit, total_ritase, total_argo, ops_operasi from 
			(select pool_area, pool_id, name, sum(ct) as total_unit, sum(total_ritase) as total_ritase, sum(total_argo) as total_argo from ritase_rds 
			join master_pool on ritase_rds.pool_id = master_pool.id where tgl >= '".$start."' and tgl <= '".$end."' group by pool_area, pool_id, name order by pool_id) x
			join (select id_pool, sum(ops_operasi) as ops_operasi from ops_pool where tgl_spj >= '".$start."' and tgl_spj <= '".$end."' group by id_pool) y on x.pool_id = y.id_pool order by id_pool
			;")->result_array();
		$data['series'] = $this->db->query("select ritase, sum(ct) as ct from ritase_rds where tgl >= '".$start."' and tgl <= '".$end."' group by ritase order by ritase;")->result_array();
		return $data;
	}
	
	function get_monthly_series_rds($end = ''){
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-d', strtotime($end ."-30 days"));	
		$data = $this->db->query("select tgl, sum(total_ritase) as total_ritase, sum(total_unit) as total_unit, sum(total_argo) as total_argo from 			
			(select tgl, pool_id, sum(total_ritase) as total_ritase, sum(ct) as total_unit, sum(total_argo) as total_argo
			from ritase_rds group by tgl, pool_id) x
			join (select tgl_spj, id_pool from ops_pool) y on x.pool_id = y.id_pool and y.tgl_spj = x.tgl
			where tgl >= '".$start."' and tgl <= '".$end."' group by tgl order by tgl;")->result_array();
		return $data;	
	}
	
	function get_pool(){
		$data = $this->db->query("select id, name from master_pool order by id")->result_array();
		return $data;	
	}
	
	function get_pool_by_id($id){
		$data = $this->db->query("select * from master_pool where id = ".$id.";")->result_array();
		return $data;
	}
	
	//RITASE HOUR RDS
	function save_backup_ritase_hour_rds($data){
		$saves = array();
		foreach((Array) $data AS $key => $val){
			$save = array();
			foreach (Array('tgl', 'hr', 'pool_id', 'total_ritase', 'total_argo'
				) AS $keys => $vals) {
				if (array_key_exists($vals, (array) $val))
					$save[$vals] = $val[$vals];
			}
			$save['last_update'] = date('Y-m-d H:i:s');
			array_push($saves, $save);
		}
		$this->db->insert_batch('ritase_hour_rds', $saves);
	}
	
	function delete_backup_ritase_hour_rds($start, $end){
		$this->db->where('tgl >=', $start)->where('tgl <=', $end)->delete('ritase_hour_rds');
	}
	
	function get_ritase_hour_rds($date = ''){
		if($date === '')
			$date = date('Y-m-d',strtotime("-1 days"));
		$data = $this->db->query("select hr, sum(total_ritase) as total_ritase, sum(total_argo) as total_argo from ritase_hour_rds where tgl = '".$date."' group by hr order by hr;")->result_array();
		return $data;
	}
	
	//INVENTORY POOL
	function save_backup_inventory_pool($data){
		$saves = array();
		foreach((Array) $data AS $key => $val){
			$save = array();
			foreach (Array('tgl', 'id_item', 'id_pool', 'qty'
				) AS $keys => $vals) {
				if (array_key_exists($vals, (array) $val))
					$save[$vals] = $val[$vals];
			}
			array_push($saves, $save);
		}
		$this->db->insert_batch('inventory_pool', $saves);
	}
	
	function delete_backup_inventory_pool($start, $end){
		$this->db->where('tgl >=', $start)->where('tgl <=', $end)->delete('inventory_pool');
	}
	
	function get_inventory_pool_area($date = ''){
		if($date === '')
			$date = date('Y-m-d',strtotime("-1 days"));
		$data = $this->db->query("select id_item, master_inventory.name as namepart, satuan, jenis, sum(qty) as qty, pool_area from master_inventory 
			left join inventory_pool on id_item = master_inventory.id join master_pool on id_pool = master_pool.id where tgl = '".$date."'
			group by pool_area, id_item, namepart, satuan, jenis order by pool_area, jenis, id_item;")->result_array();
		return $data;
	}
	
	function get_inventories_in_pool($id, $date = ''){
		if($date === '')
			$date = date('Y-m-d',strtotime("-1 days"));
		$data = $this->db->query("select id_item, master_inventory.name as namepart, satuan, jenis, sum(qty) as qty, pool_area from master_inventory 
			left join inventory_pool on id_item = master_inventory.id join master_pool on id_pool = master_pool.id where tgl = '".$date."' and master_pool.id = ".$id."
			group by pool_area, id_item, namepart, satuan, jenis order by pool_area, jenis, id_item;")->result_array();
		return $data;
	}
	
	function get_inventory_pool($id = '', $date = '', $area = ''){
		if($id === '' || $date === '' || $area === '') return array();
		
		$data['pool'] = $this->db->query("select id, name, coalesce(x.qty, 0) as qty from master_pool left join (
			select id_pool, master_inventory.name as namepart, sum(qty) as qty from inventory_pool 
			join master_inventory on id_item = master_inventory.id and id_item = '".$id."' where tgl = '".$date."'
			group by id_pool, namepart) x on x.id_pool = id where pool_area = ".$area."")->result_array();
		$data['name'] = $this->db->query("select name from master_inventory where id = '".$id."';")->row_array();
		return $data;
	}
	
	//CLUSTERS
	function get_clusters(){
		$data = $this->db->query("select * from master_cluster where active = 1;")->result_array();
		return $data;
	}
	
	//KODE PINTU POOL
	function get_kode_pintu_pool(){
		$data = $this->db->query("select * from master_kode_pintu_pool where active = 1;")->result_array();
		return $data;
	}
	
	//AREA CHECKER
	function get_area_checker($areaChecker){
		$data = $this->db->query("select * from master_checker_pool where id_area = ".$areaChecker." and active = 1;")->result_array();
		return $data;
	}
	
	//SPJ
	function save_backup_spj($data){	
		$saves = array();
		foreach((Array) $data AS $key => $val){
			$save = array();
			foreach (Array('tgl_spj', 'id_pool', 'nama', 'tipe_ops', 'no_pintu', 'spj_code', 'status_bs', 'jam_spj', 'kip_setor') AS $keys => $vals) {
				if (array_key_exists($vals, (array) $val))
					$save[$vals] = $val[$vals];
			}
			$save['last_update'] = date('Y-m-d H:i:s');
			array_push($saves, $save);
		}
		$this->db->insert_batch('spj_pool', $saves);
	}
	
	function delete_backup_spj($start, $end, $data){
		$id_pool = '';
		foreach((Array) $data AS $key => $val){
			if($id_pool === ''){
				$id_pool .= "'".$val."'";
			} else {
				$id_pool .= ", '".$val."'";
			}
		}
		$this->db->query("delete from spj_pool where tgl_spj >= '$start' and tgl_spj <= '$end' and id_pool in ($id_pool);");		
// 		$this->db->where('tgl_spj >= ', $start)->where('tgl_spj <= ', $end)->where('id_pool <', 25)->delete('spj_pool');
	}
	
	function get_spj($id, $date){
		$data = $this->db->where('id_pool', $id)->where('tgl_spj',$date)->order_by('tipe_ops')->get('spj_pool')->result_array();
		return $data;
	}
	
	//Checker
	function get_operation_reguler($start, $date){
		$data = $this->db->query("select master_pool.id, name, sum(ops_operasi) as ops_operasi from master_pool 
			left join ops_pool on id_pool = master_pool.id and tgl_spj >= '".$start."' and tgl_spj <= '".$date."' 
			where active = 1 and pool_area in (1,2,6,7)
			group by master_pool.id, name
			order by master_pool.id")->result_array();
		return $data;
	}
	
	function get_operation_reguler_detail($id, $start, $date){
		$data = $this->db->query("select no_pintu, spj_code, tgl_spj, tipe_ops from spj_pool 
			where id_pool = ".$id." and tgl_spj >= '".$start."' and tgl_spj <= '".$date."';")->result_array();
		return $data;
	}
	
	function get_pool_name($id){
		$data = $this->db->query("select name from master_pool where id = ".$id.";")->row_array();
		return $data['name'];
	}
	
	//RENTAL
	function check_rental(){
		$date = date('Y-m-d');
		$data = $this->db->query("select max(last_update) as max from rental where tgl_spj = '".$date."' limit 1")->result_array();
		if(Count($data) > 0){
			if(strtotime($data[0]['max']) < strtotime(date('Y-m-d H:i:s', strtotime("-24 hours"))))
				return FALSE;
			return $data[0]['max'];
		}
		return FALSE;
	}
	
	function get_operation_rental($date){
		$data = $this->db->join('master_pool', 'master_pool.id = id_pool')->where('tgl_spj', $date)->get('rental');
		return $data->result_array();
	}
	
	function get_series_rental($end = ''){
		if($end === '')
			$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-d', strtotime($end .' -30 day'));
		$start_120 = date('Y-m-d', strtotime($end .' -120 day'));

		$data = $this->db->query("select tgl_spj, count(tgl_spj) as operasi, 
			sum(harga_sewa + coalesce(nominal_bayar_denda,0)) as revenue from rental 
			where tgl_spj >= '$start' and tgl_spj <= '$end' 
			group by tgl_spj order by tgl_spj;")->result_array();
		
		return $data;
	}
	
	function save_backup_rental($data){	
		$saves = array();
		foreach((Array) $data AS $key => $val){
			$save = array();
			foreach (Array('id_pool', 'no_pintu', 'pengemudi', 'kip', 'no_spj', 'lama_sewa',
				'tgl_spj', 'waktu_sewa', 'harga_sewa', 'waktu_kembali', 'jam_terlambat', 'nominal_denda_perjam', 
				'total_denda', 'nominal_bayar_sewa', 'nominal_bayar_denda', 'status', 'jenis'
				) AS $keys => $vals) {
				if (array_key_exists($vals, (array) $val))
					$save[$vals] = $val[$vals];
			}
			$save['last_update'] = date('Y-m-d H:i:s');
			array_push($saves, $save);
		}
		$this->db->insert_batch('rental', $saves);
	}
	
	function delete_backup_rental($start, $end){
		$this->db->where('tgl_spj >=', $start)->where('tgl_spj <=', date('Y-m-d 23:59:59', strtotime($end)))->delete('rental');
	}
	
	function insertDiskonHistEtu(){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
                $this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 1 and POOL_ID = 3 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 1 and  POOL_ID = 3 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 1 and POOL_ID = 4 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 1 and  POOL_ID = 4 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 1 and POOL_ID = 2 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 1 and  POOL_ID = 2 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 1 and POOL_ID = 34 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 1 and  POOL_ID = 34 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 1 and POOL_ID = 11 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 1 and  POOL_ID = 11 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 1 and POOL_ID = 35 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 1 and  POOL_ID = 35 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 1 and POOL_ID = 37 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 1 and  POOL_ID = 37 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 1 and POOL_ID = 12 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 1 and  POOL_ID = 12 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");


$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 1 and POOL_ID = 5 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 1 and  POOL_ID = 5 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 1 and POOL_ID = 6 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 1 and  POOL_ID = 6 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 1 and POOL_ID = 9 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 1 and  POOL_ID = 9 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 1 and POOL_ID = 10 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 1 and  POOL_ID = 10 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 1 and POOL_ID = 19 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 1 and  POOL_ID = 19 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 1 and POOL_ID = 20 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 1 and  POOL_ID = 20 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 1 and POOL_ID = 36 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 1 and  POOL_ID = 36 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 1 and POOL_ID = 38 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 1 and  POOL_ID = 38 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");
	}
	
	function insertDiskonHistWmk(){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
				
			$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 2 and POOL_ID = 5 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 2 and  POOL_ID = 5 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 2 and POOL_ID = 6 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 2 and  POOL_ID = 6 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");


$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 2 and POOL_ID = 7 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 2 and  POOL_ID = 7 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");


$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 2 and POOL_ID = 33 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 2 and  POOL_ID = 33 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");
			
	}
	
	function insertDiskonHistSip(){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
				
				$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 3 and POOL_ID = 3 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 3 and  POOL_ID = 3 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 3 and POOL_ID = 4 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 3 and  POOL_ID = 4 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 3 and POOL_ID = 2 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 3 and  POOL_ID = 2 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 3 and POOL_ID = 34 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 3 and  POOL_ID = 34 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 3 and POOL_ID = 12 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 3 and  POOL_ID = 12 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 3 and POOL_ID = 7 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 3 and  POOL_ID = 7 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 3 and POOL_ID = 9 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 3 and  POOL_ID = 9 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 3 and POOL_ID = 10 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 3 and  POOL_ID = 10 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 3 and POOL_ID = 36 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 3 and  POOL_ID = 36 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 3 and POOL_ID = 37 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 3 and  POOL_ID = 37 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");
				
	}
	
	function insertDiskonHistTss(){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
				
				$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 5 and POOL_ID = 11 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 5 and  POOL_ID = 11 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");
				
	}
	
	function insertDiskonHistMep(){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
				
				$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 4 and POOL_ID = 9 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 4 and  POOL_ID = 9 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 4 and POOL_ID = 10 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 4 and  POOL_ID = 10 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");


$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 4 and POOL_ID = 19 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 4 and  POOL_ID = 19 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");


$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 4 and POOL_ID = 20 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 4 and  POOL_ID = 20 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

				
	}
	
	function insertDiskonHistEkl(){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
				
				$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 9 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 9 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 19 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 19 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 20 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 20 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 7 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 7 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 5 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 5 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 12 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 12 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 4 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 4 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 2 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 2 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 11 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 11 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 3 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 3 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

	

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 33 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 33 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 32 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 32 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 50 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 50 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 36 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 36 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 38 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 38 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 37 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 37 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 10 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 10 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 6 and POOL_ID = 34 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 6 and  POOL_ID = 34 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

				
	}
	
	function insertDiskonHistFmt(){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
				
				$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 7 and POOL_ID = 3 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 7 and  POOL_ID = 3 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 7 and POOL_ID = 1 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 7 and  POOL_ID = 11 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 7 and POOL_ID = 5 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 7 and  POOL_ID = 5 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 7 and POOL_ID = 6 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 7 and  POOL_ID = 6 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 7 and POOL_ID = 7 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 7 and  POOL_ID = 7 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 7 and POOL_ID = 32 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 7 and  POOL_ID = 32 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 7 and POOL_ID = 2 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 7 and  POOL_ID = 2 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 7 and POOL_ID = 36 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 7 and  POOL_ID = 36 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");
				
	}
	
	function insertDiskonHistEsbc(){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
				
				$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 8 and POOL_ID = 9 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 8 and  POOL_ID = 9 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 8 and POOL_ID = 10 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 8 and  POOL_ID = 10 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 8 and POOL_ID = 19 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 8 and  POOL_ID = 19 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 8 and POOL_ID = 20 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 8 and  POOL_ID = 20 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 8 and POOL_ID = 50 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 8 and  POOL_ID = 50 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 8 and POOL_ID = 7 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 8 and  POOL_ID = 7 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 8 and POOL_ID = 12 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 8 and  POOL_ID = 12 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 8 and POOL_ID = 3 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 8 and  POOL_ID = 3 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");
	
	}
	
	function insertDiskonHistEmk(){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
				
				$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 12 and POOL_ID = 3 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 12 and  POOL_ID = 3 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 12 and POOL_ID = 4 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 12 and  POOL_ID = 4 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 12 and POOL_ID = 2 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 12 and  POOL_ID = 2 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 12 and POOL_ID = 34 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 12 and  POOL_ID = 34 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 12 and POOL_ID = 11 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 12 and  POOL_ID = 11 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 12 and POOL_ID = 35 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 12 and  POOL_ID = 35 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 12 and POOL_ID = 37 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 12 and  POOL_ID = 37 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 12 and POOL_ID = 12 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 12 and  POOL_ID = 12 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 12 and POOL_ID = 5 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 12 and  POOL_ID = 5 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 12 and POOL_ID = 6 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 12 and  POOL_ID = 6 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 12 and POOL_ID = 9 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 12 and  POOL_ID = 9 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 12 and POOL_ID = 20 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 12 and  POOL_ID = 20 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 12 and POOL_ID = 36 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 12 and  POOL_ID = 36 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");

$this->db->query("insert into trx_discount_hist
select POOL_ID,OWNER_PT_ID,no_pintu,150000,0,150000,SPJ_DATE,1, POSTED_BY, SPJ_DATE from trx_setoran 
where  owner_pt_id = 12 and POOL_ID = 38 and spj_date >='2018-7-1' and spj_date <'2018-8-1'
and (spj_date, NO_PINTU) not in (select tanggal, NO_PINTU from trx_discount_hist 
where OWNER_PT_ID = 12 and  POOL_ID = 38 and tanggal >= '2018-7-1' and tanggal < '2018-8-1');");
				
	}
	
	function updateJurnalLastStep(){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
				
				$this->db->query("UPDATE trx_discount_hist a INNER JOIN TRX_SETORAN B
ON a.NO_PINTU = b.NO_PINTU AND a.POOL_ID = b.POOL_ID AND TANGGAL = SPJ_DATE
SET A.S_SETORAN_AWAL='0',A.S_DOWNTIME='0'
WHERE A.TANGGAL >= '2018-7-1' AND A.TANGGAL < '2018-8-1'
AND b.s_wajib='0' AND a.S_SETORAN_AWAL!='0'
AND a.owner_pt_id in (1,2,3,4,5,6,7,8,12,13,22);");

$this->db->query("UPDATE trx_discount_hist a INNER JOIN TRX_SETORAN B
ON a.NO_PINTU = b.NO_PINTU AND a.POOL_ID = b.POOL_ID AND TANGGAL = SPJ_DATE
SET A.S_SETORAN_AWAL='80000',
A.S_DOWNTIME='0'
WHERE A.TANGGAL >= '2018-7-1' AND A.TANGGAL < '2018-8-1'
and a.S_DOWNTIME != a.S_SETORAN_AWAL - b.S_WAJIB and b.S_WAJIB = 80000
and a.owner_pt_id in(1,2,3,4,5,6,7,8,12,13,22);");

$this->db->query("UPDATE trx_discount_hist a INNER JOIN TRX_SETORAN B
ON a.NO_PINTU = b.NO_PINTU AND a.POOL_ID = b.POOL_ID AND TANGGAL = SPJ_DATE
SET A.S_SETORAN_AWAL='99000',
A.S_DOWNTIME='0'
WHERE A.TANGGAL >= '2018-7-1' AND A.TANGGAL < '2018-8-1'
and a.S_DOWNTIME != a.S_SETORAN_AWAL - b.S_WAJIB and b.S_WAJIB = 99000
and a.owner_pt_id in(1,2,3,4,5,6,7,8,12,13,22);");

$this->db->query("UPDATE trx_discount_hist a INNER JOIN TRX_SETORAN B
ON a.NO_PINTU = b.NO_PINTU AND a.POOL_ID = b.POOL_ID AND TANGGAL = SPJ_DATE
SET A.S_SETORAN_AWAL='215000',
A.S_DOWNTIME='110000'
WHERE A.TANGGAL >= '2018-7-1' AND A.TANGGAL < '2018-8-1'
and a.S_DOWNTIME != a.S_SETORAN_AWAL - b.S_WAJIB and b.S_WAJIB = 105000
and a.owner_pt_id in(1,2,3,4,5,6,7,8,12,13,22);");

$this->db->query("UPDATE trx_discount_hist a INNER JOIN TRX_SETORAN B
ON a.NO_PINTU = b.NO_PINTU AND a.POOL_ID = b.POOL_ID AND TANGGAL = SPJ_DATE
SET A.S_SETORAN_AWAL='235000',
A.S_DOWNTIME='129250'
WHERE A.TANGGAL >= '2018-7-1' AND A.TANGGAL < '2018-8-1'
and a.S_DOWNTIME != a.S_SETORAN_AWAL - b.S_WAJIB and b.S_WAJIB = 105750
and a.owner_pt_id in(1,2,3,4,5,6,7,8,12,13,22);");

$this->db->query("UPDATE trx_discount_hist a INNER JOIN TRX_SETORAN B
ON a.NO_PINTU = b.NO_PINTU AND a.POOL_ID = b.POOL_ID AND TANGGAL = SPJ_DATE
SET A.S_SETORAN_AWAL='240000',
A.S_DOWNTIME='90000'
WHERE A.TANGGAL >= '2018-7-1' AND A.TANGGAL < '2018-8-1'
and a.S_DOWNTIME != a.S_SETORAN_AWAL - b.S_WAJIB and b.S_WAJIB = 150000
and a.owner_pt_id in(1,2,3,4,5,6,7,8,12,13,22);");

$this->db->query("UPDATE trx_discount_hist a INNER JOIN TRX_SETORAN B
ON a.NO_PINTU = b.NO_PINTU AND a.POOL_ID = b.POOL_ID AND TANGGAL = SPJ_DATE
SET A.S_SETORAN_AWAL='160000',
A.S_DOWNTIME='0'
WHERE A.TANGGAL >= '2018-7-1' AND A.TANGGAL < '2018-8-1'
and a.S_DOWNTIME != a.S_SETORAN_AWAL - b.S_WAJIB and b.S_WAJIB = 160000
and a.owner_pt_id in(1,2,3,4,5,6,7,8,12,13,22);");

$this->db->query("UPDATE trx_discount_hist a INNER JOIN TRX_SETORAN B
ON a.NO_PINTU = b.NO_PINTU AND a.POOL_ID = b.POOL_ID AND TANGGAL = SPJ_DATE
SET A.S_SETORAN_AWAL='265000',
A.S_DOWNTIME='85000'
WHERE A.TANGGAL >= '2018-7-1' AND A.TANGGAL < '2018-8-1'
and a.S_DOWNTIME != a.S_SETORAN_AWAL - b.S_WAJIB and b.S_WAJIB = 180000
and a.owner_pt_id in(1,2,3,4,5,6,7,8,12,13,22);");

$this->db->query("UPDATE trx_discount_hist a INNER JOIN TRX_SETORAN B
ON a.NO_PINTU = b.NO_PINTU AND a.POOL_ID = b.POOL_ID AND TANGGAL = SPJ_DATE
SET A.S_SETORAN_AWAL='200000',
A.S_DOWNTIME='0'
WHERE A.TANGGAL >= '2018-7-1' AND A.TANGGAL < '2018-8-1'
and a.S_DOWNTIME != a.S_SETORAN_AWAL - b.S_WAJIB and b.S_WAJIB = 200000
and a.owner_pt_id in(1,2,3,4,5,6,7,8,12, 13,22);");

$this->db->query("UPDATE trx_discount_hist a INNER JOIN TRX_SETORAN B
ON a.NO_PINTU = b.NO_PINTU AND a.POOL_ID = b.POOL_ID AND TANGGAL = SPJ_DATE
SET A.S_SETORAN_AWAL='215000',
A.S_DOWNTIME='0'
WHERE A.TANGGAL >= '2018-7-1' AND A.TANGGAL < '2018-8-1'
and a.S_DOWNTIME != a.S_SETORAN_AWAL - b.S_WAJIB and b.S_WAJIB = 215000
and a.owner_pt_id in(1,2,3,4,5,6,7,8,12,13,22);");

$this->db->query("UPDATE trx_discount_hist a INNER JOIN TRX_SETORAN B
ON a.NO_PINTU = b.NO_PINTU AND a.POOL_ID = b.POOL_ID AND TANGGAL = SPJ_DATE
SET A.S_SETORAN_AWAL='220000',
A.S_DOWNTIME='0'
WHERE A.TANGGAL >= '2018-7-1' AND A.TANGGAL < '2018-8-1'
and a.S_DOWNTIME != a.S_SETORAN_AWAL - b.S_WAJIB and b.S_WAJIB = 220000
and a.owner_pt_id in(1,2,3,4,5,6,7,8,12,13,22);");

$this->db->query("UPDATE trx_discount_hist a INNER JOIN TRX_SETORAN B
ON a.NO_PINTU = b.NO_PINTU AND a.POOL_ID = b.POOL_ID AND TANGGAL = SPJ_DATE
SET A.S_SETORAN_AWAL='235000',
A.S_DOWNTIME='0'
WHERE A.TANGGAL >= '2018-7-1' AND A.TANGGAL < '2018-8-1'
and a.S_DOWNTIME != a.S_SETORAN_AWAL - b.S_WAJIB and b.S_WAJIB = 235000
and a.owner_pt_id in(1,2,3,4,5,6,7,8,12,13,22);");

$this->db->query("UPDATE trx_discount_hist a INNER JOIN TRX_SETORAN B
ON a.NO_PINTU = b.NO_PINTU AND a.POOL_ID = b.POOL_ID AND TANGGAL = SPJ_DATE
SET A.S_SETORAN_AWAL='285000',
A.S_DOWNTIME='0'
WHERE A.TANGGAL >= '2018-7-1' AND A.TANGGAL < '2018-8-1'
and a.S_DOWNTIME != a.S_SETORAN_AWAL - b.S_WAJIB and b.S_WAJIB = 285000
and a.owner_pt_id in(1,2,3,4,5,6,7,8,12,13,22);");

$this->db->query("UPDATE trx_discount_hist a INNER JOIN TRX_SETORAN B
ON a.NO_PINTU = b.NO_PINTU AND a.POOL_ID = b.POOL_ID AND TANGGAL = SPJ_DATE
SET A.S_SETORAN_AWAL='240000',
A.S_DOWNTIME='0'
WHERE A.TANGGAL >= '2018-7-1' AND A.TANGGAL < '2018-8-1'
and a.S_DOWNTIME != a.S_SETORAN_AWAL - b.S_WAJIB and b.S_WAJIB = 240000
and a.owner_pt_id in(1,2,3,4,5,6,7,8,12,13,22);");


$this->db->query("UPDATE trx_setoran SET TOTAL_KS_TERBIT='0',KS_ADJUSMENT='0', 
TERIMA_TAB_PART=TOTAL_TERIMA-S_WAJIB-S_LAIN-TOTAL_DENDA-TERIMA_LAKA-KEMBALI_CT,
TAB_PART_ADJUSTMENT=TERIMA_TAB_PART                                                              
WHERE spj_date>='2018-7-1' AND spj_date <'2018-8-1' and OWNER_PT_ID in (1,2,3,4,5,6,7,8,12,13,22);");

$this->db->query("UPDATE TRX_SETORAN SET 
TOTAL_KS_TERBIT=TERIMA_TAB_PART,
KS_ADJUSMENT=TERIMA_TAB_PART,
TERIMA_TAB_PART='0',TAB_PART_ADJUSTMENT='0'
WHERE spj_date>='2018-7-1' AND spj_date <'2018-8-1' and OWNER_PT_ID in (1,2,3,4,5,6,7,8,12,13,22)
AND SUBSTR(TERIMA_TAB_PART,1,1)='-';");
				
	}
}

