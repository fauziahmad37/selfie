<?php
class Taxi_ads_model extends CI_Model {
	
// ======================================== CINEMAXX ===========================================
	function Cinemaxx(){
		$CI = &get_instance();
		$this->db = $CI->load->database('default', TRUE);
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://taxiads.expdds.com/api/v2/get_batch?company=Cinemaxx&signature=51e2b013c94c4d1c25025d234a803e5a",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"postman-token: 45467764-9e21-69b6-bbf8-f0c79e0d8316"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$data = json_decode($response, true);
		}
		return $data;
	}
	
	function Cinemaxx_dice(){
		$CI = &get_instance();
		$this->db = $CI->load->database('dice_eagle', TRUE);
		
		$res = $this->db->query("select spj_operasional.jam_mulai_spj, spj_operasional.nomor_spj, spj_operasional.status, 
			CASE WHEN spj_operasional.status='OPEN' THEN 'UNIT SEDANG BEROPERASI'
            WHEN spj_operasional.status='CLOSED' THEN 'UNIT TIDAK BEROPERASI'
            ELSE 'other'
			END,
			mobil_pool.nomor_pintu  from spj_operasional 
			join mobil_pool on(mobil_pool.id=spj_operasional.id_mobil_pool)
			where (id_mobil_pool, tgl_spj) in (
			select id_mobil_pool, max(b.tgl_spj) from mobil_pool a
			join spj_operasional b on(b.id_mobil_pool=a.id)
			where  (REPLACE(lower(nomor_pintu), ' ', '') in (
			'boa106', 'boa120', 'boa124', 'boa126', 'boa139', 'boa151', 'boa156', 'boa159', 'boa187', 'boa228', 'cdc237', 'cdc288', 'cfh131', 'cfh175', 'goa102', 'goa110', 'goa113', 'goa139', 'goa165', 'goa180', 'goa187', 'goa210', 'goa224', 'goa228', 'goa265','boa179'
			))  and a.status='active' group by id_mobil_pool);")->result_array();
		return $res;
	}
	
// ======================================== ITOP STREET HUNT ===========================================
	function Itop_street_hunt(){
		$CI = &get_instance();
		$this->db = $CI->load->database('default', TRUE);
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://taxiads.expdds.com/api/v2/get_batch?company=ItopStreetHunt&signature=52e98f44bf2b828e4202d010231b70f6",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"postman-token: 45467764-9e21-69b6-bbf8-f0c79e0d8316"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$data = json_decode($response, true);
		}
		return $data;
	}
	
	function Itop_street_hunt_dice(){
		$CI = &get_instance();
		$this->db = $CI->load->database('dice_eagle', TRUE);
		
		$res = $this->db->query("select spj_operasional.jam_mulai_spj, spj_operasional.nomor_spj, spj_operasional.status, 
			CASE WHEN spj_operasional.status='OPEN' THEN 'UNIT SEDANG BEROPERASI'
            WHEN spj_operasional.status='CLOSED' THEN 'UNIT TIDAK BEROPERASI'
            ELSE 'other'
			END,
			mobil_pool.nomor_pintu   from spj_operasional 
			join mobil_pool on(mobil_pool.id=spj_operasional.id_mobil_pool)
			where (id_mobil_pool, tgl_spj) in (
			select id_mobil_pool, max(b.tgl_spj) from mobil_pool a
			join spj_operasional b on(b.id_mobil_pool=a.id)
			where  (REPLACE(lower(nomor_pintu), ' ', '') in ('aoa101', 'boa108', 'boa110', 'boa119', 'boa122', 'boa131', 'boa134', 'boa152', 'boa160', 'boa171', 'boa172', 'boa175', 'boa177', 'boa180', 'boa181', 'boa182', 'boa183', 'boa184', 'boa186', 'boa188', 'boa229', 'goa106', 'goa111', 'goa119', 'goa124', 'goa126', 'goa127', 'goa128', 'goa130', 'goa136', 'goa146', 'goa147', 'goa162', 'goa164', 'goa168', 'goa169', 'goa181', 'goa182', 'goa185', 'goa188', 'goa189', 'goa194', 'goa203', 'goa207', 'goa209', 'goa211', 'goa214', 'goa219', 'goa221', 'goa229'
			))  and a.status='active' group by id_mobil_pool);")->result_array();
		return $res;
	}

	// ======================================== SHOPEE ===========================================
	function Shopee(){
		$CI = &get_instance();
		$this->db = $CI->load->database('default', TRUE);
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://taxiads.expdds.com/api/v2/get_batch?company=Shopee&signature=bdebd557bd4396465ef3e83f69d7fc70",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"postman-token: 45467764-9e21-69b6-bbf8-f0c79e0d8316"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$data = json_decode($response, true);
		}
		return $data;
	}
	
	function Shopee_dice(){
		$CI = &get_instance();
		$this->db = $CI->load->database('dice_eagle', TRUE);
		
		$res = $this->db->query("select spj_operasional.jam_mulai_spj, spj_operasional.nomor_spj, spj_operasional.status, 
			CASE WHEN spj_operasional.status='OPEN' THEN 'UNIT SEDANG BEROPERASI'
            WHEN spj_operasional.status='CLOSED' THEN 'UNIT TIDAK BEROPERASI'
            ELSE 'other'
			END,
			mobil_pool.nomor_pintu   from spj_operasional 
			join mobil_pool on(mobil_pool.id=spj_operasional.id_mobil_pool)
			where (id_mobil_pool, tgl_spj) in (
			select id_mobil_pool, max(b.tgl_spj) from mobil_pool a
			join spj_operasional b on(b.id_mobil_pool=a.id)
			where  (REPLACE(lower(nomor_pintu), ' ', '') in (
			'boa142', 'boa149', 'boa174', 'goa238', 'goa271'
			))  and a.status='active' group by id_mobil_pool);")->result_array();
		return $res;
	}
	
// ========================================= Venom ======================================================
// ======================================================================================================
	
	function Venom(){
		$CI = &get_instance();
		$this->db = $CI->load->database('default', TRUE);
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://taxiads.expdds.com/api/v2/get_batch?company=Venom&signature=40e1c3783e9a4729ca484fe01d498fa7",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"postman-token: 45467764-9e21-69b6-bbf8-f0c79e0d8316"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$data = json_decode($response, true);
		}
		return $data;
	}
	
	function Venom_dice(){
		$CI = &get_instance();
		$this->db = $CI->load->database('dice_eagle', TRUE);
		
		$res = $this->db->query("select spj_operasional.jam_mulai_spj, spj_operasional.nomor_spj, spj_operasional.status, 
			CASE WHEN spj_operasional.status='OPEN' THEN 'UNIT SEDANG BEROPERASI'
            WHEN spj_operasional.status='CLOSED' THEN 'UNIT TIDAK BEROPERASI'
            ELSE 'other'
			END,
			mobil_pool.nomor_pintu   from spj_operasional 
			join mobil_pool on(mobil_pool.id=spj_operasional.id_mobil_pool)
			where (id_mobil_pool, tgl_spj) in (
			select id_mobil_pool, max(b.tgl_spj) from mobil_pool a
			join spj_operasional b on(b.id_mobil_pool=a.id)
			where  (REPLACE(lower(nomor_pintu), ' ', '') in (
			'boa145','boa158','boa232','goa159','goa230'
			))  and a.status='active' group by id_mobil_pool);")->result_array();
		return $res;
	}

// ========================================= Blibli =====================================================
// ======================================================================================================

	function Blibli(){
		$CI = &get_instance();
		$this->db = $CI->load->database('default', TRUE);
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://taxiads.expdds.com/api/v2/get_batch?company=Blibli&signature=90b27909431a81bf30990f155186ee88",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"postman-token: 45467764-9e21-69b6-bbf8-f0c79e0d8316"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$data = json_decode($response, true);
		}
		return $data;
	}
	
	function blibli_dice(){
		$CI = &get_instance();
		$this->db = $CI->load->database('dice_eagle', TRUE);
		
		$res = $this->db->query("select spj_operasional.jam_mulai_spj, spj_operasional.nomor_spj, spj_operasional.status, 
			CASE WHEN spj_operasional.status='OPEN' THEN 'UNIT SEDANG BEROPERASI'
            WHEN spj_operasional.status='CLOSED' THEN 'UNIT TIDAK BEROPERASI'
            ELSE 'other'
			END,
			mobil_pool.nomor_pintu   from spj_operasional 
			join mobil_pool on(mobil_pool.id=spj_operasional.id_mobil_pool)
			where (id_mobil_pool, tgl_spj) in (
			select id_mobil_pool, max(b.tgl_spj) from mobil_pool a
			join spj_operasional b on(b.id_mobil_pool=a.id)
			where  (REPLACE(lower(nomor_pintu), ' ', '') in (
			'boa104','boa144','boa147','boa154','goa231','goa235','goa268','goa272','goa275','goa276'
			))  and a.status='active' group by id_mobil_pool);")->result_array();
		return $res;
	}

// ========================================= Tokopedia ==================================================
// ======================================================================================================

	function Tokopedia(){
		$CI = &get_instance();
		$this->db = $CI->load->database('default', TRUE);
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://taxiads.expdds.com/api/v2/get_batch?company=Tokopedia&signature=9c70165b0b83d392dba11dd86e6d1d82",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"postman-token: 45467764-9e21-69b6-bbf8-f0c79e0d8316"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$data = json_decode($response, true);
		}
		return $data;
	}
	
	function Tokopedia_dice(){
		$CI = &get_instance();
		$this->db = $CI->load->database('dice_eagle', TRUE);
		
		$res = $this->db->query("select spj_operasional.jam_mulai_spj, spj_operasional.nomor_spj, spj_operasional.status, 
			CASE WHEN spj_operasional.status='OPEN' THEN 'UNIT SEDANG BEROPERASI'
            WHEN spj_operasional.status='CLOSED' THEN 'UNIT TIDAK BEROPERASI'
            ELSE 'other'
			END,
			mobil_pool.nomor_pintu   from spj_operasional 
			join mobil_pool on(mobil_pool.id=spj_operasional.id_mobil_pool)
			where (id_mobil_pool, tgl_spj) in (
			select id_mobil_pool, max(b.tgl_spj) from mobil_pool a
			join spj_operasional b on(b.id_mobil_pool=a.id)
			where  (REPLACE(lower(nomor_pintu), ' ', '') in (
			'boa147','cdc187','cdc212','cdc270','cia262','jia154','jia159','jia162','jia169','jia196','cfh119'
			))  and a.status='active' group by id_mobil_pool);")->result_array();
		return $res;
	}

// ========================================= Ovutest ==================================================
// ======================================================================================================
	
	function Ovutest(){
		$CI = &get_instance();
		$this->db = $CI->load->database('default', TRUE);
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://taxiads.expdds.com/api/v2/get_batch?company=Ovutest&signature=f967d7a4e385d9f8924b09f578f33f40",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"postman-token: 45467764-9e21-69b6-bbf8-f0c79e0d8316"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$data = json_decode($response, true);
		}
		return $data;
	}
	
	function Ovutest_dice(){
		$CI = &get_instance();
		$this->db = $CI->load->database('dice_eagle', TRUE);
		
		$res = $this->db->query("select spj_operasional.jam_mulai_spj, spj_operasional.nomor_spj, spj_operasional.status, 
			CASE WHEN spj_operasional.status='OPEN' THEN 'UNIT SEDANG BEROPERASI'
            WHEN spj_operasional.status='CLOSED' THEN 'UNIT TIDAK BEROPERASI'
            ELSE 'other'
			END,
			mobil_pool.nomor_pintu   from spj_operasional 
			join mobil_pool on(mobil_pool.id=spj_operasional.id_mobil_pool)
			where (id_mobil_pool, tgl_spj) in (
			select id_mobil_pool, max(b.tgl_spj) from mobil_pool a
			join spj_operasional b on(b.id_mobil_pool=a.id)
			where  (REPLACE(lower(nomor_pintu), ' ', '') in (
			'boa139','boa159','goa228','goa233','goa265'
			))  and a.status='active' group by id_mobil_pool);")->result_array();
		return $res;
	}

// ========================================= Ovutest ==================================================
// ======================================================================================================
	
	function Lazada(){
		$CI = &get_instance();
		$this->db = $CI->load->database('default', TRUE);
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://taxiads.expdds.com/api/v2/get_batch?company=Lazada&signature=ce36fc4131cdfa24214676e9ae7405a2",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"postman-token: 45467764-9e21-69b6-bbf8-f0c79e0d8316"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$data = json_decode($response, true);
		}
		return $data;
	}
	
	function Lazada_dice(){
		$CI = &get_instance();
		$this->db = $CI->load->database('dice_eagle', TRUE);
		
		$res = $this->db->query("select spj_operasional.jam_mulai_spj, spj_operasional.nomor_spj, spj_operasional.status, 
			CASE WHEN spj_operasional.status='OPEN' THEN 'UNIT SEDANG BEROPERASI'
            WHEN spj_operasional.status='CLOSED' THEN 'UNIT TIDAK BEROPERASI'
            ELSE 'other'
			END,
			mobil_pool.nomor_pintu   from spj_operasional 
			join mobil_pool on(mobil_pool.id=spj_operasional.id_mobil_pool)
			where (id_mobil_pool, tgl_spj) in (
			select id_mobil_pool, max(b.tgl_spj) from mobil_pool a
			join spj_operasional b on(b.id_mobil_pool=a.id)
			where  (REPLACE(lower(nomor_pintu), ' ', '') in (	'boa142','boa144','boa145','boa147','boa149','boa153','boa156','boa170','boa171','boa172','boa174','boa177','boa180','boa181','boa182','boa183','boa184','boa186','boa228','boa229','goa162','goa168','goa230','goa231','goa238','goa264','goa266','goa268','goa271','goa277'
			))  and a.status='active' group by id_mobil_pool);")->result_array();
		return $res;
	}
	
	
}	
?>