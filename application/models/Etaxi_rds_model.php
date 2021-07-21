<?php

class Etaxi_rds_model extends CI_Model {	


		function getDataSpj()
		{
		
		$CI = &get_instance();
        $this->db = $CI->load->database('etaxi', TRUE);
        $res = $this->db->query("select a.doc_number, b.kip_number, d.door_number from doc_spj a
								 left join ms_driver b on (a.driver_id = b.id)
								 left join ms_armada c on (a.armada_id = c.id)
								 left join ms_vehicle d on (c.vehicle_id = d.id)
								 where a.created  >= (NOW() - INTERVAL '1 hours')
								 order by a.created asc; ")->result_array();
		return $res;
		}
		
		function getDataSetoran()
		{
		
		$CI = &get_instance();
        $this->db = $CI->load->database('etaxi', TRUE);
        $res = $this->db->query("select a.doc_number, b.kip_number, d.door_number from trx_spj_m z
								 left join doc_spj a on (z.spj_id = a.id)
								 left join ms_driver b on (a.driver_id = b.id)
								 left join ms_armada c on (a.armada_id = c.id)
								 left join ms_vehicle d on (c.vehicle_id = d.id)
								 where z.created  >= (NOW() - INTERVAL '1 hours')
								 order by z.created asc;")->result_array();
		return $res;
		}
		
		
		function loginRds($doc_number,$kip,$door_number)
		{
		$CI = &get_instance();
		$this->db = $CI->load->database('x_one_ice', TRUE);
		//echo $kip;
		$driver_id = 0;
		$pool_id = 0;
		$q1 = $this->db->query("select id, pool_id from driver_card where card_no = '".$kip."';")->row();
		if (q10) {
		$driver_id =  $q1->id;
		$pool_id =  $q1->pool_id;
		};
		
		$car_id = 0;
		$q2 = $this->db->query("select id from taxi where reg_no = '".$door_number."';")->row();
		if (q2) {
		$car_id =  $q2->id;
		}
		
		$cek_data = 1;
		if ($driver_id == 0 || $car_id == 0 || $pool_id ==0) {
			$res = 0;
		} else {	
		$q3 = $this->db->query("select count(0) as cek_data from driver_access where driver_card_id = ".$driver_id." and taxi_id = ".$car_id." and is_active = 1;")->row();
		$cek_data=  $q3->cek_data;
		}
		
		if ($cek_data > 0) {
			$res = 0;
		} else {
		$access_token = rand();
		$res = $this->db->query("INSERT INTO tiara_x1.driver_access ( driver_card_id, taxi_id, access_token, access_expiration, created, is_active, ended, assignment_code, pool_id, mirror_push_reg_no)
                                 VALUES( ".$driver_id.", ".$car_id.", '".$access_token."', (now() + INTERVAL '3 days'), now(), 1, NULL, 'ETAXI-".$doc_number."', ".$pool_id.", NULL);");
		}
		return $res;
		}
		
		function logoutRds($doc_number,$kip,$door_number)
		{
		$CI = &get_instance();
		$this->db = $CI->load->database('x_one_ice', TRUE);
		//echo $kip;
		$driver_id = 0;
		$pool_id = 0;
		$q1 = $this->db->query("select id, pool_id from driver_card where card_no = '".$kip."';")->row();
		if (q10) {
		$driver_id =  $q1->id;
		$pool_id =  $q1->pool_id;
		};
		
		$car_id = 0;
		$q2 = $this->db->query("select id from taxi where reg_no = '".$door_number."';")->row();
		if (q2) {
		$car_id =  $q2->id;
		}
		
		$cek_data = 0;
		
		if ($driver_id == 0 || $car_id == 0 || $pool_id ==0) {
			$res = 0;
		} else {	
		$q3 = $this->db->query("select count(0) as cek_data from driver_access where driver_card_id = ".$driver_id." and taxi_id = ".$car_id." and is_active = 1;")->row();
		
		$cek_data=  $q3->cek_data;
		}
		
		if ($cek_data > 0) {
			$res = $this->db->query("update tiara_x1.driver_access set is_active = 0, ended = now() where driver_card_id = ".$driver_id." and taxi_id = ".$car_id." and is_active = 1;");
		} else {
		 $res = 0;
		}
		return $res;
		}
	
		
		
		
		
		
		
}

