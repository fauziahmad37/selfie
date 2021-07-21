<?php

class Evsspj_model extends CI_Model {	
		
		function getDataSpjRental(){
			$CI = &get_instance();
			$this->db = $CI->load->database('rental', TRUE);
			$res = $this->db->query("select a.doc_number,a.created, b.kip_number, b.name, c.no_pintu 
				from trx_spj a 
				left join master_driver b on (a.driver_id = b.id) 
				left join master_car c on (a.car_id = c.id)
				where a.status in('Active')
				and  a.created > now() - interval '1 HOUR' order by a.created desc; ")->result_array();
			return $res;
		}

		function getDataSpj()
		{
		
		$CI = &get_instance();
        $this->db = $CI->load->database('etaxi_ice', TRUE);
        $res = $this->db->query("select a.doc_number,a.created, b.kip_number, b.name, d.door_number from doc_spj a 
									left join ms_driver b on (a.driver_id = b.id) 
										left join ms_armada c on (a.armada_id = c.id)
											left join ms_vehicle d on (c.vehicle_id = d.id) where a.status = 'Active'
												and  a.created > now() - interval '1 HOUR' order by a.created desc; ")->result_array();
		return $res;
		}
		
		function getDataSpjDice()
		{
		
		$CI = &get_instance();
        $this->db = $CI->load->database('dice_eagle', TRUE);
        $res = $this->db->query("select c.nomor_pintu, b.no_kip,d.nama ,a.jam_mulai_spj,a.nomor_spj, a.no_hp from spj_operasional a
									left join master_kip b on (a.id_kip = b.id_pengemudi )
										left join master_pengemudi d  on (a.id_kip = d.id)
											left join mobil_pool c on (a.id_mobil_pool = c.id)
												where a.status = 'OPEN' and a.jam_mulai_spj > now() - interval '1 HOUR' ;")->result_array();
		return $res;
		}
		
		function getDataSpjDiceTiara()
		{
		
		$CI = &get_instance();
        $this->db = $CI->load->database('dice_tiara', TRUE);
        $res = $this->db->query("select c.nomor_pintu, b.no_kip,d.nama ,a.jam_mulai_spj,a.nomor_spj from spj_operasional a
									left join master_kip b on (a.id_kip = b.id_pengemudi )
										left join master_pengemudi d  on (a.id_kip = d.id)
											left join mobil_pool c on (a.id_mobil_pool = c.id)
												where a.status = 'OPEN' and a.jam_mulai_spj > now() - interval '1 HOUR' ;")->result_array();
		return $res;
		}
		
		function getDataSetoranRental(){
		
			$CI = &get_instance();
			$this->db = $CI->load->database('rental', TRUE);
			$res = $this->db->query("select a.doc_number, d.created, b.kip_number, b.name, c.no_pintu 
				from trx_spj a
				left join trx_setoran d on (d.spj_id=a.id)
				left join master_driver b on (a.driver_id = b.id) 
				left join master_car c on (a.car_id = c.id)
				where a.status in ('Paid','Cancelled')
				and d.created > now() - interval '1 HOUR' order by d.created desc;")->result_array();
			return $res;
		}
		
		function getDataSetoran()
		{
		
		$CI = &get_instance();
        $this->db = $CI->load->database('etaxi_ice', TRUE);
        $res = $this->db->query("select a.doc_number,a.modified, b.kip_number, b.name, d.door_number from doc_spj a 
									left join ms_driver b on (a.driver_id = b.id) 
										left join ms_armada c on (a.armada_id = c.id)
											left join ms_vehicle d on (c.vehicle_id = d.id) where a.status in ('Paid','Cancelled')
												and  a.modified > now() - interval '1 HOUR' order by a.modified desc;")->result_array();
		return $res;
		}
		
		
		function getDataSetoranDice()
		{
		
		$CI = &get_instance();
        $this->db = $CI->load->database('dice_eagle', TRUE);
        $res = $this->db->query("select c.nomor_pintu, b.no_kip,d.nama ,a.jam_selesai_spj,a.nomor_spj, a.no_hp from spj_operasional a
									left join master_kip b on (a.id_kip = b.id_pengemudi )
										left join master_pengemudi d  on (a.id_kip = d.id)
											left join mobil_pool c on (a.id_mobil_pool = c.id)
												where a.status in ('CLOSED','CANCELED') and a.jam_selesai_spj > now() - interval '1 HOUR' ;")->result_array();
		return $res;
		}
		
		function getDataSetoranDiceTiara()
		{
		
		$CI = &get_instance();
        $this->db = $CI->load->database('dice_tiara', TRUE);
        $res = $this->db->query("select c.nomor_pintu, b.no_kip,d.nama ,a.jam_selesai_spj,a.nomor_spj from spj_operasional a
									left join master_kip b on (a.id_kip = b.id_pengemudi )
										left join master_pengemudi d  on (a.id_kip = d.id)
											left join mobil_pool c on (a.id_mobil_pool = c.id)
												where a.status in ('CLOSED','CANCELED') and a.jam_selesai_spj > now() - interval '1 HOUR' ;")->result_array();
		return $res;
		}

		
		function insertTaxiDriver($kip,$nama)
		{
		$CI = &get_instance();
		$this->db = $CI->load->database('evs', TRUE);
		$res = $this->db->query("INSERT INTO evoucher.taxi_driver
									(driver_id, driver_name, driver_status, driver_created, driver_created_by, driver_modified, driver_modified_by, driver_phone_no)
										VALUES('".$kip."', '".$nama."', 1, now(), 180751180316001, now(), 180751180316001, '0')
											ON CONFLICT (driver_id) DO UPDATE 
												SET driver_name = '".$nama."', 
													driver_modified = now(),
														driver_modified_by = '180751180316001';");
		return $res;
		}
		
		function deleteTaxiRegister()
		{
		$CI = &get_instance();
		$this->db = $CI->load->database('evs', TRUE);
		$res = $this->db->query("delete from taxi_register
									where taxi_id in (
										select taxi_id from taxi_register
											group by taxi_id
												having count(0) > 1) and taxi_id = taxi_imei;");
		return $res;
		}
		
		function insertTaxiRegister($door_number)
		{
		$CI = &get_instance();
		$this->db = $CI->load->database('evs', TRUE);
		$res = $this->db->query("INSERT INTO evoucher.taxi_register
									(taxi_id, taxi_imei, taxi_status, taxi_created, taxi_created_by, taxi_modified, taxi_modified_by, taxi_type)
										VALUES('".$door_number."', '".$door_number."', 1, now(), 180751180316001, now(), 180751180316001, 1)
											ON CONFLICT (taxi_id ,taxi_imei, taxi_status) 
												DO UPDATE SET  
													taxi_modified = now(),
														taxi_modified_by = '180751180316001',
															taxi_type = 1;");
		return $res;
		}
		
		function insertTaxiRegisterDice($door_number)
		{
		$CI = &get_instance();
		$this->db = $CI->load->database('evs', TRUE);
		$res = $this->db->query("INSERT INTO evoucher.taxi_register
									(taxi_id, taxi_imei, taxi_status, taxi_created, taxi_created_by, taxi_modified, taxi_modified_by, taxi_type)
										VALUES('".$door_number."', '".$door_number."', 1, now(), 180751180316001, now(), 180751180316001, 2)
											ON CONFLICT (taxi_id ,taxi_imei, taxi_status) 
												DO UPDATE SET  
													taxi_modified = now(),
														taxi_modified_by = '180751180316001',
															taxi_type = 2;");
		return $res;
		}
		
		function insertTaxiRegisterDiceTiara($door_number)
		{
		$CI = &get_instance();
		$this->db = $CI->load->database('evs', TRUE);
		$res = $this->db->query("INSERT INTO evoucher.taxi_register
									(taxi_id, taxi_imei, taxi_status, taxi_created, taxi_created_by, taxi_modified, taxi_modified_by, taxi_type)
										VALUES('".$door_number."', '".$door_number."', 1, now(), 180751180316001, now(), 180751180316001, 3)
											ON CONFLICT (taxi_id ,taxi_imei, taxi_status) 
												DO UPDATE SET  
													taxi_modified = now(),
														taxi_modified_by = '180751180316001',
															taxi_type = 3;");
		return $res;
		}
		
		function insertTaxiImeiLogin($door_number,$spj_number,$kip_number,$time)
		{
		$CI = &get_instance();
		$this->db = $CI->load->database('evs', TRUE);
		$res = $this->db->query("INSERT INTO evoucher.taxi_imei_login
									(taxi_id, taxi_imei, taxi_login, taxi_logout, taxi_spj, taxi_driver_id)
										VALUES('".$door_number."',  (select taxi_imei from taxi_register
															where taxi_id = '".$door_number."' and taxi_status = 1), '".$time."', '2040-03-02 12:00:00.000', '".$spj_number."', '".$kip_number."')
											ON CONFLICT (taxi_spj,taxi_driver_id) 
												DO UPDATE SET 
													taxi_login = '".$time."';");
		return $res;
		}
		
		function updateTaxiImeiLogin($door_number,$spj_number,$kip_number,$time)
		{
		$CI = &get_instance();
		$this->db = $CI->load->database('evs', TRUE);
		$res = $this->db->query("update evoucher.taxi_imei_login
									set taxi_logout = '".$time."'
										where taxi_id = '".$door_number."' and taxi_spj = '".$spj_number."' and taxi_driver_id = '".$kip_number."';");
		return $res;
		}
		
		
		
		
}

