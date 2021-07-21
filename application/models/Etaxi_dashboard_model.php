<?php

class Etaxi_dashboard_model extends CI_Model {	

// ============================================================================================================================
// ==================================================== TOTAL SPJ AKTIF  ====================================================
// ============================================================================================================================
	function Dashboard_spj_aktif_pondok_bambu(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(0) from doc_spj where status = 'Active' and pool_id = 18;")->row_array();
		return $res;
	}
	
	function Dashboard_spj_aktif_pekapuran(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(0) from doc_spj where status = 'Active' and pool_id = 17;")->row_array();
		return $res;
	}
	
	function Dashboard_spj_aktif_jagakarsa(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(0) from doc_spj where status = 'Active' and pool_id = 1;")->row_array();
		return $res;
	}
	
	function Dashboard_spj_aktif_cipayung(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(0) from doc_spj where status = 'Active' and pool_id = 16;")->row_array();
		return $res;
	}
	
// ============================================================================================================================
// ==================================================== TOTAL CETAK SPJ HARI INI  ====================================================
// ============================================================================================================================
	function Dashboard_cetak_spj_today_pondok_bambu(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(0) from doc_spj where  pool_id = 18 and created >= CURRENT_DATE and status not in ('Cancelled');")->row_array();
		return $res;
	}
	
	function Dashboard_cetak_spj_today_pekapuran(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(0) from doc_spj where  pool_id = 17 and created >= CURRENT_DATE and status not in ('Cancelled');")->row_array();
		return $res;
	}
	
	function Dashboard_cetak_spj_today_jagakarsa(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(0) from doc_spj where  pool_id = 1 and created >= CURRENT_DATE and status not in ('Cancelled');")->row_array();
		return $res;
	}
	
	function Dashboard_cetak_spj_today_cipayung(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(0) from doc_spj where  pool_id = 16 and created >= CURRENT_DATE and status not in ('Cancelled');")->row_array();
		return $res;
	}
	
// ============================================================================================================================
// ==================================================== UNIT SOS HARI INI =====================================================
// ============================================================================================================================
	
	function sos_pd_bambu(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(0) from stg_daily_armada a
			left join ms_armada b on (a.armada_id = b.id)
			left join ms_vehicle c on (b.vehicle_id = c.id)
			left join sys_pool d on (a.pool_id = d.id)
			where a.created >=CURRENT_DATE 
			and a.status_pko ='Approved'
			and b.status ='Stop Operasi Sementara' and a.pool_id=18;")->row_array();
		return $res;
	}
	
	function sos_pekapuran(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(0) from stg_daily_armada a
			left join ms_armada b on (a.armada_id = b.id)
			left join ms_vehicle c on (b.vehicle_id = c.id)
			left join sys_pool d on (a.pool_id = d.id)
			where a.created >=CURRENT_DATE 
			and a.status_pko ='Approved'
			and b.status ='Stop Operasi Sementara' and a.pool_id=17;")->row_array();
		return $res;
	}
	
	function sos_jagakarsa(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(0) from stg_daily_armada a
			left join ms_armada b on (a.armada_id = b.id)
			left join ms_vehicle c on (b.vehicle_id = c.id)
			left join sys_pool d on (a.pool_id = d.id)
			where a.created >=CURRENT_DATE 
			and a.status_pko ='Approved'
			and b.status ='Stop Operasi Sementara' and a.pool_id=1;")->row_array();
		return $res;
	}
	
	function sos_cipayung(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(0) from stg_daily_armada a
			left join ms_armada b on (a.armada_id = b.id)
			left join ms_vehicle c on (b.vehicle_id = c.id)
			left join sys_pool d on (a.pool_id = d.id)
			where a.created >=CURRENT_DATE 
			and a.status_pko ='Approved'
			and b.status ='Stop Operasi Sementara' and a.pool_id=16;")->row_array();
		return $res;
	}
	
// ============================================================================================================================
// ==================================================== DETAIL SOS HARI INI =====================================================
// ============================================================================================================================
	
	function detail_sos_pd_bambu(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select distinct c.door_number from stg_daily_armada a
			left join ms_armada b on (a.armada_id = b.id)
			left join ms_vehicle c on (b.vehicle_id = c.id)
			left join sys_pool d on (a.pool_id = d.id)
			where a.created >=CURRENT_DATE 
			and a.status_pko ='Approved'
			and b.status ='Stop Operasi Sementara' and a.pool_id=18;")->result_array();
		return $res;
	}
	
	function detail_sos_pekapuran(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select distinct c.door_number from stg_daily_armada a
			left join ms_armada b on (a.armada_id = b.id)
			left join ms_vehicle c on (b.vehicle_id = c.id)
			left join sys_pool d on (a.pool_id = d.id)
			where a.created >=CURRENT_DATE 
			and a.status_pko ='Approved'
			and b.status ='Stop Operasi Sementara' and a.pool_id=17;")->result_array();
		return $res;
	}
	
	function detail_sos_jagakarsa(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select distinct c.door_number from stg_daily_armada a
			left join ms_armada b on (a.armada_id = b.id)
			left join ms_vehicle c on (b.vehicle_id = c.id)
			left join sys_pool d on (a.pool_id = d.id)
			where a.created >=CURRENT_DATE 
			and a.status_pko ='Approved'
			and b.status ='Stop Operasi Sementara' and a.pool_id=1;")->result_array();
		return $res;
	}
	
	function detail_sos_cipayung(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select distinct c.door_number from stg_daily_armada a
			left join ms_armada b on (a.armada_id = b.id)
			left join ms_vehicle c on (b.vehicle_id = c.id)
			left join sys_pool d on (a.pool_id = d.id)
			where a.created >=CURRENT_DATE 
			and a.status_pko ='Approved'
			and b.status ='Stop Operasi Sementara' and a.pool_id=16;")->result_array();
		return $res;
	}
	
// ============================================================================================================================
// ==================================================== UNIT TP HARI INI =====================================================
// ============================================================================================================================
	function tp_pd_bambu(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(distinct c.door_number) from ar_setoran_wajib a
left join ms_armada b on (a.armada_id = b.id)
left join ms_vehicle c on (b.vehicle_id = c.id)
left join sys_pool d on (a.pool_id = d.id)
where a.created >=CURRENT_DATE and a.spj_id is null and a.armada_id not in (
select armada_id from doc_spj
where status = 'Active')
and a.pool_id = 18;")->row_array();
		return $res;
	}
	
	function tp_pekapuran(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(distinct c.door_number) from ar_setoran_wajib a
left join ms_armada b on (a.armada_id = b.id)
left join ms_vehicle c on (b.vehicle_id = c.id)
left join sys_pool d on (a.pool_id = d.id)
where a.created >=CURRENT_DATE and a.spj_id is null and a.armada_id not in (
select armada_id from doc_spj
where status = 'Active')
and a.pool_id = 17;")->row_array();
		return $res;
	}
	
	function tp_jagakarsa(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(distinct c.door_number) from ar_setoran_wajib a
left join ms_armada b on (a.armada_id = b.id)
left join ms_vehicle c on (b.vehicle_id = c.id)
left join sys_pool d on (a.pool_id = d.id)
where a.created >=CURRENT_DATE and a.spj_id is null and a.armada_id not in (
select armada_id from doc_spj
where status = 'Active')
and a.pool_id = 1;")->row_array();
		return $res;
	}
	
	function tp_cipayung(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(distinct c.door_number) from ar_setoran_wajib a
left join ms_armada b on (a.armada_id = b.id)
left join ms_vehicle c on (b.vehicle_id = c.id)
left join sys_pool d on (a.pool_id = d.id)
where a.created >=CURRENT_DATE and a.spj_id is null and a.armada_id not in (
select armada_id from doc_spj
where status = 'Active')
and a.pool_id = 16;")->row_array();
		return $res;
	}
	
// ============================================================================================================================
// ==================================================== DETAIL UNIT TP HARI INI ===============================================
// ============================================================================================================================
	function detail_tp_pd_bambu(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select distinct c.door_number from ar_setoran_wajib a
			left join ms_armada b on (a.armada_id = b.id)
			left join ms_vehicle c on (b.vehicle_id = c.id)
			left join sys_pool d on (a.pool_id = d.id)
			where a.created >=CURRENT_DATE and a.spj_id is null and a.armada_id not in (
			select armada_id from doc_spj
			where status = 'Active')
			and a.pool_id = 18;")->result_array();
		return $res;
	}
	
	function detail_tp_pekapuran(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select distinct c.door_number from ar_setoran_wajib a
			left join ms_armada b on (a.armada_id = b.id)
			left join ms_vehicle c on (b.vehicle_id = c.id)
			left join sys_pool d on (a.pool_id = d.id)
			where a.created >=CURRENT_DATE and a.spj_id is null and a.armada_id not in (
			select armada_id from doc_spj
			where status = 'Active')
			and a.pool_id = 17;")->result_array();
		return $res;
	}
	
	function detail_tp_jagakarsa(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select distinct c.door_number from ar_setoran_wajib a
			left join ms_armada b on (a.armada_id = b.id)
			left join ms_vehicle c on (b.vehicle_id = c.id)
			left join sys_pool d on (a.pool_id = d.id)
			where a.created >=CURRENT_DATE and a.spj_id is null and a.armada_id not in (
			select armada_id from doc_spj
			where status = 'Active')
			and a.pool_id = 1;")->result_array();
		return $res;
	}
	
	function detail_tp_cipayung(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select distinct c.door_number from ar_setoran_wajib a
			left join ms_armada b on (a.armada_id = b.id)
			left join ms_vehicle c on (b.vehicle_id = c.id)
			left join sys_pool d on (a.pool_id = d.id)
			where a.created >=CURRENT_DATE and a.spj_id is null and a.armada_id not in (
			select armada_id from doc_spj
			where status = 'Active')
			and a.pool_id = 16;")->result_array();
		return $res;
	}
	
// =============================================================================================================================================================
// ==================================================== TOTAL UNIT YANG BELUM PULANG DALAM 5 HARI TERAKHIR  ====================================================
// =============================================================================================================================================================
	function Dashboard_spj_aktif_5_days_pondok_bambu(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(0) from doc_spj where status = 'Active' and pool_id = 18 and created < current_date-4;")->row_array();
		return $res;
	}
	
	function Dashboard_spj_aktif_5_days_pekapuran(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(0) from doc_spj where status = 'Active' and pool_id = 17 and created < current_date-4;")->row_array();
		return $res;
	}
	
	function Dashboard_spj_aktif_5_days_jagakarsa(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(0) from doc_spj where status = 'Active' and pool_id = 1 and created < current_date-4;")->row_array();
		return $res;
	}
	
	function Dashboard_spj_aktif_5_days_cipayung(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select count(0) from doc_spj where status = 'Active' and pool_id = 16 and created < current_date-4;")->row_array();
		return $res;
	}
	
// =============================================================================================================================================================
// ==================================================== DEATIL UNIT YANG BELUM PULANG DALAM 5 HARI TERAKHIR  ====================================================
// =============================================================================================================================================================
	function detail_spj_aktif_5_days_pondok_bambu(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select door_number from doc_spj
			join ms_armada on (ms_armada.id=doc_spj.armada_id)
			join ms_vehicle on (ms_vehicle.id=ms_armada.vehicle_id)
			where doc_spj.status = 'Active' and doc_spj.pool_id = 18 and doc_spj.created < current_date-4;")->result_array();
		return $res;
	}
	
	function detail_spj_aktif_5_days_pekapuran(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select door_number from doc_spj
			join ms_armada on (ms_armada.id=doc_spj.armada_id)
			join ms_vehicle on (ms_vehicle.id=ms_armada.vehicle_id)
			where doc_spj.status = 'Active' and doc_spj.pool_id = 17 and doc_spj.created < current_date-4;")->result_array();
		return $res;
	}
	
	function detail_spj_aktif_5_days_jagakarsa(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select door_number from doc_spj
			join ms_armada on (ms_armada.id=doc_spj.armada_id)
			join ms_vehicle on (ms_vehicle.id=ms_armada.vehicle_id)
			where doc_spj.status = 'Active' and doc_spj.pool_id = 1 and doc_spj.created < current_date-4;")->result_array();
		return $res;
	}
	
	function detail_spj_aktif_5_days_cipayung(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res =  $this->db->query("select door_number from doc_spj
			join ms_armada on (ms_armada.id=doc_spj.armada_id)
			join ms_vehicle on (ms_vehicle.id=ms_armada.vehicle_id)
			where doc_spj.status = 'Active' and doc_spj.pool_id = 16 and doc_spj.created < current_date-4;")->result_array();
		return $res;
	}
	
}


// --check sos








?>