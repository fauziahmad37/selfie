<?php

class Summary_model extends CI_Model{
	function __construct() {
		parent::__construct();
		
	}
	
	function get_pools(){
		$data = $this->db->query("select id, name, pool_area from master_pool where pool_area <> 3 and active = 1 order by pool_area, id;")->result_array();
		return $data;
	}
	
	function get_data_ops($from, $to){
		$data = $this->db->query("select pool_area, ops_pool.id_pool, avg(ops_operasi) as ops, avg(ops_total) as ops_total
		from ops_pool 
		join master_pool on master_pool.id = ops_pool.id_pool and pool_area <> 3 and master_pool.active = 1
		where ops_pool.tgl_spj >= '".$from."' and ops_pool.tgl_spj <= '".$to."'
		group by ops_pool.id_pool, master_pool.pool_area order by master_pool.pool_area, ops_pool.id_pool;")->result_array();
		return $data;
	
	}
	
	function get_available_unit_pool(){
		$data = $this->db->query("select id_pool, avg(total_car), avg(total_aktif + total_so_ringan) as aktif 
			from pool_available_unit group by id_pool;")->result_array();
		return $data;
	}
	
	function get_target($date, $quarter){
		$year = date('Y', strtotime($date));
		$data = $this->db->query("select *
			from pool_kpi_target where y = ".$year." and q = ".$quarter.";")->result_array();
		return $data;
	}
	
	function get_data_arpu_reg($from, $to){		
		$data = $this->db->query("select pool_area, rev_pool.id_pool, avg(tagihan_operasi) as cap_rev,
			avg(tagihan_operasi + ks_operasi + coalesce(total_setoran_telat, 0) + bayar_hutang) as total_rev, 
			sum(ks_operasi + ks_non_operasi + coalesce(total_setoran_telat, 0) + bayar_hutang) as total_ks, sum(ks_non_operasi) as ks_tp
		from rev_pool
		join master_pool on master_pool.id = rev_pool.id_pool and pool_area < 3 and master_pool.active = 1
		where rev_pool.tgl_spj >= '".$from."' and rev_pool.tgl_spj <= '".$to."'
		group by rev_pool.id_pool, master_pool.pool_area order by master_pool.pool_area, rev_pool.id_pool;")->result_array();
		return $data;
	}
	
	function get_data_arpu_komisi($from, $to){	
		$data = $this->db->query("select pool_area, rev_pool.id_pool, sum(total_gross - total_komisi - total_bbm) / sum(ops_pool.ops_operasi) as arpu
		from rev_pool join ops_pool on ops_pool.id_pool = rev_pool.id_pool and rev_pool.tgl_spj = ops_pool.tgl_spj
		join master_pool on master_pool.id = rev_pool.id_pool and pool_area > 3 and master_pool.active = 1
		where rev_pool.tgl_spj >= '".$from."' and rev_pool.tgl_spj <= '".$to."'
		group by rev_pool.id_pool, master_pool.pool_area order by master_pool.pool_area, rev_pool.id_pool;")->result_array();
		return $data;
	}
	
	function get_data_rit($from, $to){	
		$data = $this->db->query("select pool_area, master_pool.id, sum(total_ritase) as rit, sum(ct) as unit
		from ritase_rds
		join master_pool on master_pool.id = ritase_rds.pool_id and pool_area <> 3 and master_pool.active = 1
		where tgl >= '".$from."' and tgl <= '".$to."'
		group by master_pool.id, master_pool.pool_area order by master_pool.pool_area, master_pool.id;")->result_array();
		return $data;
	}
	
	function get_data_driver($from, $to){
		$today = date('Y-m-d');
		$day = date('Y-m-t', strtotime($from));
		$str = '';
		
		while(strtotime($day) <= strtotime($to)){
			if($str === '')
				$str = "'".$day."'";
			else
				$str = $str.",'".$day."'";
			$day = date('Y-m-t', strtotime($day.'+1 day'));
		}
		$str = $str.",'".$today."'";
		$arr = $this->db->query("select id_pool, sum(d1 + d2 + d3 + d4 + d5 + d6 + d7 + d8 + d9 + d10 + d11 + 
				d12 + d13 + d14 + d15 + d16 + d17 + d18 + d19 + d20 + d21 + d22 + d23 + d24 + d25 + d26 + d27 + d28 + d29 + d30 + d31) as ct,
			sum(d1 * 1 + d2 * 2 + d3 * 3 + d4 * 4 + d5 * 5 + d6 * 6 + d7 * 7 + d8 * 8 + d9 * 9 + d10 * 10 + d11 * 11 + d12 * 12 + 
				d13 * 13 + d14 * 14 + d15 * 15 + d16 * 16 + d17 * 17 + d18 * 18 + d19 * 19 + d20 * 20 + d21 * 21 + d22 * 22 + 
				d23 * 23 + d24 * 24 + d25 * 25+ d26 * 26+ d27 * 27 + d28 * 28 + d29 * 29 + d30 * 30 + d31 * 31) as total_hk
			from driver_pool where tgl in (".$str.") group by id_pool order by id_pool;")->result_array();
		
		$data = array();
		foreach((Array) $arr AS $key => $val){
			$a = array();
			$a['id_pool'] = $val['id_pool'];
			$a['hk'] = $val['total_hk'] / ($val['ct'] > 0 ? $val['ct'] : 1);
			array_push($data, $a);
		}	
		
		return $data;
	}
	
	function get_data_car($from, $to){
		$today = date('Y-m-d');
		$day = date('Y-m-t', strtotime($from));
		$str = '';
		
		while(strtotime($day) <= strtotime($to)){
			if($str === '')
				$str = "'".$day."'";
			else
				$str = $str.",'".$day."'";
			$day = date('Y-m-t', strtotime($day.'+1 day'));
		}
		$str = $str.",'".$today."'";
		$arr = $this->db->query("select id_pool, sum(d1 + d2 + d3 + d4 + d5 + d6 + d7 + d8 + d9 + d10 + d11 + 
				d12 + d13 + d14 + d15 + d16 + d17 + d18 + d19 + d20 + d21 + d22 + d23 + d24 + d25 + d26 + d27 + d28 + d29 + d30 + d31) as ct,
			sum(d1 * 1 + d2 * 2 + d3 * 3 + d4 * 4 + d5 * 5 + d6 * 6 + d7 * 7 + d8 * 8 + d9 * 9 + d10 * 10 + d11 * 11 + d12 * 12 + 
				d13 * 13 + d14 * 14 + d15 * 15 + d16 * 16 + d17 * 17 + d18 * 18 + d19 * 19 + d20 * 20 + d21 * 21 + d22 * 22 + 
				d23 * 23 + d24 * 24 + d25 * 25+ d26 * 26+ d27 * 27 + d28 * 28 + d29 * 29 + d30 * 30 + d31 * 31) as total_hk
			from car_pool where tgl in (".$str.") group by id_pool order by id_pool;")->result_array();
		
		$data = array();
		foreach((Array) $arr AS $key => $val){
			$a = array();
			$a['id_pool'] = $val['id_pool'];
			$a['hk'] = $val['total_hk'] / ($val['ct'] > 0 ? $val['ct'] : 1);
			array_push($data, $a);
		}	
		
		return $data;
	}
	
}

?>