<?php

class Dice_eagle_model extends CI_Model{
	private $db_local;
	private $db_name = 'dice_eagle';
	function __construct() {
		parent::__construct();

	}
	
	function data($date = ''){
		if($date === '')
			$date = date('Y-m-d',strtotime("-1 days"));

		$this->db_local = $this->load->database($this->db_name, TRUE);

		$data['operasi'] = $this->db_local->query("select id_pool_mobil, id_jam_operasional, count(*) as ct 
			from spj_operasional where tgl_spj = '".$date."' AND status::text = 'CANCELED'::text group by id_pool_mobil, id_jam_operasional 
			order by id_pool_mobil")->result_array();
		$data['status_all'] = $this->db_local->query("select id_pool, master_pool.nama as nama, status, count(*) as ct 
			from mobil_pool join master_pool on master_pool.id = mobil_pool.id_pool 
			group by id_pool, nama, status order by id_pool;")->result_array();
		$this->db_local->close();
		return $data;
	}
	
	function revenue($date = ''){
		if($date === '')
			$date = date('Y-m-d',strtotime("-1 days"));

		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = $this->db_local->query("
			select id_pool_mobil, master_pool.nama as NAMA_POOL, count(id_pool_mobil) as SPJ, sum(total_pembayaran) as REVENUE 
			from spj_operasional join tanda_terima on spj_operasional.id = tanda_terima.id_spj 
			join master_pool on master_pool.id = spj_operasional.id_pool_mobil 
			where tgl_spj = '".$date."' AND status::text = 'CLOSED'::text group by id_pool_mobil, master_pool.nama order by id_pool_mobil;")->result_array();
		$this->db_local->close();
		return $data;
	}
	
	function datas($start, $end){
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = array();
		$data['operasi'] = array();
		$query = $this->db_local->query("select tgl_spj, id_pool_mobil, sum(case when id_jam_operasional = 1 then 1 else 0 end) as reguler, sum(case when id_jam_operasional = 2 then 1 else 0 end) as kalong 
			from spj_operasional where tgl_spj >= '".$start."' and tgl_spj <= '".$end."' AND status::text != 'CANCELED'::text group by tgl_spj, id_pool_mobil
			order by tgl_spj, id_pool_mobil;");
		if(is_object($query)){
			$data['operasi'] = $query->result_array();
		}
		$data['status_all'] = array();
		$query = $this->db_local->query("select id_pool, status, count(*) as ct from mobil_pool group by id_pool, status order by id_pool;");
		if(is_object($query)){
			$data['status_all'] = $query->result_array();
		}
		$this->db_local->close();
		return $data;	
	}
	
	function revenues($start, $end){
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = array();
		$query = $this->db_local->query("select x.tgl_spj, x.id_pool_mobil, total_spj, total_gross, (total_gross - total_komisi - total_bbm - hutang_baru) as total_rev, total_komisi, total_bbm, total_denda, total_lain, hutang_baru, bayar_hutang 
			from (select tgl_spj, id_pool_mobil, count(id_pool_mobil) as total_spj, 
			sum(argo_setelah_adj) as total_gross, sum(total_komisi) as total_komisi
			from faktur  
			join spj_operasional a on faktur.id_spj = a.id 
			where tgl_spj >= '".$start."' and tgl_spj <= '".$end."' AND a.status::text = 'CLOSED'::text
			group by tgl_spj, id_pool_mobil) x
			join (select tgl_spj, id_pool_mobil, sum(nominal) as total_bbm from bahan_bakar_faktur 
			join spj_operasional on bahan_bakar_faktur.id_faktur = spj_operasional.id
			and tgl_spj >= '".$start."' and tgl_spj <= '".$end."'
			group by id_pool_mobil, tgl_spj
			) y on x.id_pool_mobil = y.id_pool_mobil and x.tgl_spj = y.tgl_spj
			join 
			(select tgl_spj, id_pool_mobil, sum(adjusment) as total_denda from denda_faktur 
			join spj_operasional on denda_faktur.id_faktur = spj_operasional.id
			and tgl_spj >= '".$start."' and tgl_spj <= '".$end."'
			group by id_pool_mobil, tgl_spj
			) z on x.id_pool_mobil = z.id_pool_mobil and z.tgl_spj = x.tgl_spj
			join (
			select tgl_spj, id_pool_mobil, sum(case when id_komponen_setoran <= 3 then nominal else -nominal end) as total_lain from komponen_setoran_faktur 
			join spj_operasional on komponen_setoran_faktur.id_faktur = spj_operasional.id
			and tgl_spj >= '".$start."' and tgl_spj <= '".$end."'
			group by id_pool_mobil, tgl_spj) d on d.id_pool_mobil = x.id_pool_mobil and d.tgl_spj = x.tgl_spj
			join 
			(select tgl_spj, id_pool_mobil, sum(total_hutang_baru) as hutang_baru, sum(pembayaran_transaksi) as bayar_hutang from hutang_faktur
			join spj_operasional on hutang_faktur.id_faktur = spj_operasional.id
			and tgl_spj >= '".$start."' and tgl_spj <= '".$end."'
			group by id_pool_mobil, tgl_spj) e on e.id_pool_mobil = x.id_pool_mobil and e.tgl_spj = x.tgl_spj
			order by x.tgl_spj, x.id_pool_mobil
			;");
		if(is_object($query)){
			$data = $query->result_array();
		}
		$this->db_local->close();
		return $data;
	}
	
	function load_db(){
		return $this->load->database($this->db_name, TRUE);
	}
	
	function drivers_backup($db_local, $start, $end){
		if($end === '' || strtotime($end) >= strtotime(date('Y-m-d')))
			$end = date('Y-m-d',strtotime("-1 days"));
		$start_mth = date('Y-m-01', strtotime($end));
		$data = $db_local->query("select zz.*, active, inactive, retire, blacklist from (
			select '".$end."' as tgl_snapshot, id_pool_mobil as id_pool, sum(case when hk = 1 then ct else 0 end) as d1,
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
				select id_pool_mobil, hk, count(hk) as ct from 
					(select id_pool_mobil, count(*) as hk from spj_operasional 
					where tgl_spj >= '".$start_mth."' and tgl_spj <= '".$end."' and status <> 'CANCELED' group by id_pool_mobil, id_kip) ded
			group by id_pool_mobil, hk order by id_pool_mobil, hk) b
			group by id_pool_mobil order by id_pool_mobil) zz
			join (select x.tgl_snapshot as tgl_snapshot, x.id_pool, COALESCE(active, 0) as active, COALESCE(inactive, 0) as inactive, 
			COALESCE(retire, 0) as retire, COALESCE(blacklist, 0) as blacklist from 
			(select tgl_snapshot, id_pool, count(*) as active from harian_operasi_pengemudi where tgl_snapshot >= '".$start."' and tgl_snapshot <= '".$end."'
			and status = 'active' group by tgl_snapshot, id_pool order by tgl_snapshot) x
			left join 
			(select tgl_snapshot, id_pool, count(*) as inactive from harian_operasi_pengemudi where tgl_snapshot >= '".$start."' and tgl_snapshot <= '".$end."'
			and status = 'inactive' group by tgl_snapshot, id_pool order by tgl_snapshot) y
			on x.tgl_snapshot = y.tgl_snapshot and x.id_pool = y.id_pool
			left join
			(select tgl_snapshot, id_pool, count(*) as retire from harian_operasi_pengemudi where tgl_snapshot >= '".$start."' and tgl_snapshot <= '".$end."' 
			and status = 'retire' group by tgl_snapshot, id_pool order by tgl_snapshot) z
			on z.tgl_snapshot = y.tgl_snapshot and z.tgl_snapshot = x.tgl_snapshot and z.id_pool = y.id_pool and x.id_pool = z.id_pool
			left join
			(select tgl_snapshot, id_pool, count(*) as blacklist from harian_operasi_pengemudi where tgl_snapshot  >= '".$start."' and tgl_snapshot <= '".$end."'
			and status = 'blacklist' group by tgl_snapshot, id_pool order by tgl_snapshot) a
			on a.tgl_snapshot = x.tgl_snapshot and a.tgl_snapshot = y.tgl_snapshot and a.tgl_snapshot = z.tgl_snapshot 
			and x.id_pool = a.id_pool and a.id_pool = z.id_pool and a.id_pool = y.id_pool) xxx on xxx.tgl_snapshot = '".$end."' and xxx.id_pool = zz.id_pool
			;")->result_array();
		return $data;
	}
	
	function car_backup($db_local, $start, $end){
		if($end === '' || strtotime($end) >= strtotime(date('Y-m-d')))
			$end = date('Y-m-d',strtotime("-1 days"));
		$start_mth = date('Y-m-01', strtotime($end));
		$data = $db_local->query("select '".$end."' as tgl_snapshot, id_pool_mobil as id_pool, sum(case when hk = 1 then ct else 0 end) as d1,
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
				select id_pool_mobil, hk, count(hk) as ct from 
					(select id_pool_mobil, count(*) as hk from spj_operasional 
					where tgl_spj >= '".$start_mth."' and tgl_spj <= '".$end."' and status <> 'CANCELED' group by id_pool_mobil, id_mobil_pool) ded
			group by id_pool_mobil, hk order by id_pool_mobil, hk) b
			group by id_pool_mobil order by id_pool_mobil
			;")->result_array();
		return $data;
	}
	
	function drivers($start, $end = ''){
		if($end === '' || strtotime($end) >= strtotime(date('Y-m-d')))
			$end = date('Y-m-d',strtotime("-1 days"));
		$start_mth = date('Y-m-01', strtotime($end));
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = $this->db_local->query("select zz.*, active, inactive, retire, blacklist from (
			select '".$end."' as tgl_snapshot, id_pool_mobil as id_pool, sum(case when hk = 1 then ct else 0 end) as d1,
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
				select id_pool_mobil, hk, count(hk) as ct from 
					(select id_pool_mobil, count(*) as hk from spj_operasional 
					where tgl_spj >= '".$start_mth."' and tgl_spj <= '".$end."' and status <> 'CANCELED' group by id_pool_mobil, id_kip) ded
			group by id_pool_mobil, hk order by id_pool_mobil, hk) b
			group by id_pool_mobil order by id_pool_mobil) zz
			join (select x.tgl_snapshot as tgl_snapshot, x.id_pool, COALESCE(active, 0) as active, COALESCE(inactive, 0) as inactive, 
			COALESCE(retire, 0) as retire, COALESCE(blacklist, 0) as blacklist from 
			(select tgl_snapshot, id_pool, count(*) as active from harian_operasi_pengemudi where tgl_snapshot >= '".$start."' and tgl_snapshot <= '".$end."'
			and status = 'active' group by tgl_snapshot, id_pool order by tgl_snapshot) x
			left join 
			(select tgl_snapshot, id_pool, count(*) as inactive from harian_operasi_pengemudi where tgl_snapshot >= '".$start."' and tgl_snapshot <= '".$end."'
			and status = 'inactive' group by tgl_snapshot, id_pool order by tgl_snapshot) y
			on x.tgl_snapshot = y.tgl_snapshot and x.id_pool = y.id_pool
			left join
			(select tgl_snapshot, id_pool, count(*) as retire from harian_operasi_pengemudi where tgl_snapshot >= '".$start."' and tgl_snapshot <= '".$end."' 
			and status = 'retire' group by tgl_snapshot, id_pool order by tgl_snapshot) z
			on z.tgl_snapshot = y.tgl_snapshot and z.tgl_snapshot = x.tgl_snapshot and z.id_pool = y.id_pool and x.id_pool = z.id_pool
			left join
			(select tgl_snapshot, id_pool, count(*) as blacklist from harian_operasi_pengemudi where tgl_snapshot  >= '".$start."' and tgl_snapshot <= '".$end."'
			and status = 'blacklist' group by tgl_snapshot, id_pool order by tgl_snapshot) a
			on a.tgl_snapshot = x.tgl_snapshot and a.tgl_snapshot = y.tgl_snapshot and a.tgl_snapshot = z.tgl_snapshot 
			and x.id_pool = a.id_pool and a.id_pool = z.id_pool and a.id_pool = y.id_pool) xxx on xxx.tgl_snapshot = '".$end."' and xxx.id_pool = zz.id_pool
			;")->result_array();
		$this->db_local->close();
		return $data;
	}
	
	function get_detail_unit($id_pool, $date){
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = $this->db_local->query("select nomor_spj, nama, no_kip, nomor_pintu, (id_jam_operasional - 1) as jenis_ops, argo_setelah_adj, total_komisi, total_bbm, liter, 
			a.bayar_hutang, a.hutang_baru, denda_faktur.adjusment as bayar_denda, total_setoran, lain, d.speedo, d.rit, d.drop, adjustment
			from faktur join spj_operasional on id_spj = spj_operasional.id and spj_operasional.status = 'CLOSED' and tgl_spj = '".$date."' and id_pool_mobil = ".$id_pool."
			join mobil_pool on mobil_pool.id = spj_operasional.id_mobil_pool and id_pool_mobil = ".$id_pool." and spj_operasional.status = 'CLOSED' and tgl_spj = '".$date."'
			join master_kip on master_kip.id_pengemudi = spj_operasional.id_kip
			join master_pengemudi on master_pengemudi.id = spj_operasional.id_kip			
			JOIN (select id_faktur, sum(total_hutang_baru) as hutang_baru, sum(pembayaran_transaksi) as bayar_hutang from hutang_faktur 
			join spj_operasional on id_faktur = spj_operasional.id and tgl_spj = '".$date."' group by id_faktur) a on a.id_faktur = id_spj
			join (select id_faktur, sum(nominal) as total_bbm, sum(liter) as liter from bahan_bakar_faktur group by id_faktur) b on b.id_faktur = id_spj
			join denda_faktur on denda_faktur.id_faktur = id_spj
			join (select id_faktur, sum(case when id_komponen_setoran <= 3 then nominal else 0 end) as adjustment, sum(case when id_komponen_setoran <= 3 then nominal else -nominal end) lain from komponen_setoran_faktur 
			join spj_operasional on id_faktur = spj_operasional.id and tgl_spj = '".$date."' group by id_faktur) c on c.id_faktur = id_spj
			join (select id_faktur, sum(case when id_komponen = 1 then nett else 0 end) as rit, sum(case when id_komponen = 2 then nett else 0 end) as drop, 
			sum(case when id_komponen = 3 then nett else 0 end) as argo, sum(case when id_komponen = 4 then nett else 0 end) as speedo 
			from komponen_argo_faktur join spj_operasional on id_faktur = spj_operasional.id and tgl_spj = '".$date."' 
			and spj_operasional.id_pool_mobil = ".$id_pool." group by id_faktur) d on d.id_faktur = id_spj
			order by total_setoran desc;")->result_array();
		$this->db_local->close();
		return $data;
	}
}

?>