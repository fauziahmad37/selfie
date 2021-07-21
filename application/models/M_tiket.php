<?php
	
	class M_tiket extends CI_Model{

		function insert_master_customer($insert){
			$this->db->insert('ms_customer',$insert);
		}

		function insert_master_ct($insert){
			$this->db->insert('ms_credit_ticket',$insert);
		}

		function cek_master_customer($data){
			$data = $data['customer_shortname'];
			$CI = &get_instance();
			$this->db = $CI->load->database('default',TRUE);
			$res = $this->db->query("select count(customer_shortname) from ms_customer where customer_shortname ='$data'")->result_array();
			return $res;
		}

		
		function load_data_by_name_customer($name_customer){
		$res = $this->db->query("select * from ms_customer
			where lower(customer_name) like lower('%".$name_customer."%');")->result_array();
		
		return $res;
		}
		
		
	function dataDetailCreditTicketEagle(){
		$CI = &get_instance();
		$this->db = $CI->load->database('dice_eagle', TRUE);
		$this->db->select('nomor_voucher');
		$this->db->from('voucher_ticket');
		$this->db->where('created >=','2018-10-1');
		return $this->db->get()->result_array();
	}
	
	function dataDetailCreditTicketTiara(){
		$CI = &get_instance();
		$this->db = $CI->load->database('dice_tiara', TRUE);
		$this->db->select('nomor_voucher');
		$this->db->from('voucher_ticket');
		$this->db->where('created >=','2018-10-1');
		return $this->db->get()->result_array();
	}
	
	function dataDetailCreditTicketEtaxi(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$this->db->select('code');
		$this->db->from('trx_non_tunai');
		$this->db->where('created >=','2018-10-1');
		return $this->db->get()->result_array();
		
	}
	
	
	function cekDataDiMasterSimtax($data){
		$id_str = '';
		foreach($data as $voucher) {
		$id_str .= "'".$voucher['nomor_voucher']."'" . ',';
		}
		$id_str = rtrim($id_str, ', '); //remove the trailing comma and space
		//var_dump($id_str);
		$CI = &get_instance();
		$this->db = $CI->load->database('simtax_pusat', TRUE);
		$res = $this->db->query("select CT_NO from ms_credit_ticket
			where CT_NO in (".$id_str.");")->result_array();
			//var_dump( $this->db );
		return $res;
	}
	
	function cekDataDiMasterSimtaxEtaxi($data){
		$id_str = '';
		foreach($data as $voucher) {
		$id_str .= "'".$voucher['code']."'" . ',';
		}
		$id_str = rtrim($id_str, ', '); //remove the trailing comma and space
		//var_dump($id_str);
		$CI = &get_instance();
		$this->db = $CI->load->database('simtax_pusat', TRUE);
		$res = $this->db->query("select CT_NO from ms_credit_ticket
			where CT_NO in (".$id_str.");")->result_array();
			//var_dump( $this->db );
		return $res;
	}
	
	function cekDataYangTidakAdaDiMasterCT($data){
		$id_str = '';
		foreach($data as $voucher) {
		$id_str .= "'".$voucher['CT_NO']."'" . ',';
		}
		$id_str = rtrim($id_str, ', '); //remove the trailing comma and space
		//var_dump($id_str);
		$CI = &get_instance();
		$this->db = $CI->load->database('dice_eagle', TRUE);
		$res = $this->db->query("select nomor_voucher from voucher_ticket
			where created >='2018-10-1' and  nomor_voucher not in (".$id_str.");")->result_array();
				//var_dump( $this->db );
		return $res;
		
	}
	
	function cekDataYangTidakAdaDiMasterCTTiara($data){
		$id_str = '';
		foreach($data as $voucher) {
		$id_str .= "'".$voucher['CT_NO']."'" . ',';
		}
		$id_str = rtrim($id_str, ', '); //remove the trailing comma and space
		//var_dump($id_str);
		$CI = &get_instance();
		$this->db = $CI->load->database('dice_tiara', TRUE);
		$res = $this->db->query("select nomor_voucher from voucher_ticket
			where created >='2018-10-1' and  nomor_voucher not in (".$id_str.");")->result_array();
				//var_dump( $this->db );
		return $res;
		
	}
	
	function cekDataYangTidakAdaDiMasterCTEtaxi($data){
		$id_str = '';
		foreach($data as $voucher) {
		$id_str .= "'".$voucher['CT_NO']."'" . ',';
		}
		$id_str = rtrim($id_str, ', '); //remove the trailing comma and space
		//var_dump($id_str);
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		$res = $this->db->query("select code from trx_non_tunai
			where created >='2018-10-1' and  code not in (".$id_str.");")->result_array();
				//var_dump( $this->db );
		return $res;
		
	}
	
	}
?>