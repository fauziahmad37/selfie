<?php

class Enigma_model extends CI_Model{
	private $db_local;
	private $db_name = 'enigma';
	function __construct() {
		parent::__construct();		
	}
	
	public function load_database(){
		$this->db_local = $this->load->database($this->db_name, TRUE);
	}
	
	public function close_database(){
		$this->db_local->close();
	}
	
	public function get_complain($date){
		$end = date("Y-m-t", strtotime($date)); 
		$data = $this->db_local->query("select complain_date, complain_status, complain_type, pool_code
			from oms_complain where (complain_date >= '".$date."' and complain_date <= '".$end."') or (complain_status < 3 and complain_date <= '".$end."');")->result_array();	
		return $data;
	}
	
	public function get_lostfound($date){
		$end = date("Y-m-t", strtotime($date)); 
		$data = $this->db_local->query("select lostfound_date, lostfound_status, lostfound_type, pool_code, lostfound_kind2
			from oms_lostfound where (lostfound_date >= '".$date."' and lostfound_date <= '".$end."') 
			or (lostfound_status < 3 and lostfound_date <= '".$end."');")->result_array();
		return $data;
	}
	
	public function series_lostfound($date){
		$end = date("Y", strtotime($date));
		$start = date("Y", strtotime($date. "-1 year"));		 
		$data = $this->db_local->query("select year(lostfound_date) as y, month(lostfound_date) as mt, 
			count(lostfound_date) as cases, sum(case when lostfound_status = 3 then 1 else 0 end) as solves
			from oms_lostfound where year(lostfound_date) >= ".$start." and year(lostfound_date) <= ".$end." group by y,mt order by y,mt;")->result_array();
		return $data;
	}
	
	public function series_complain($date){
		$end = date("Y", strtotime($date));	
		$start = date("Y", strtotime($date. "-1 year")); 
		$data = $this->db_local->query("select year(complain_date) as y, month(complain_date) as mt, 
			count(complain_date) as cases, sum(case when complain_status = 3 then 1 else 0 end) as solves
			from oms_complain where year(complain_date) >= ".$start." and year(complain_date) <= ".$end." group by y,mt order by y,mt;")->result_array();
		return $data;
	}
	
	public function get_complain_detail($date, $poolKode, $isNotPool){
		$end = date("Y-m-t", strtotime($date)); 
		$str = '';
		foreach((Array) $poolKode AS $key => $val){
			$str = ($str == "" ? "('".$val."'" : $str.",'".$val."'");
		} 
		$str = $str.')';
		$notPool = $isNotPool ? "NOT" : "";	
		$data = $this->db_local->query("select *
			from oms_complain where ((complain_date >= '".$date."' and complain_date <= '".$end."') or (complain_status < 3 and complain_date <= '".$end."'))
			and pool_code ".$notPool." IN ".$str.";")->result_array();
		return $data;
	}
	
	public function get_lostfound_detail($date, $poolKode, $isNotPool){
		$end = date("Y-m-t", strtotime($date)); 
		$str = '';
		foreach((Array) $poolKode AS $key => $val){
			$str = ($str == "" ? "('".$val."'" : $str.",'".$val."'");
		} 
		$str = $str.')';
		$notPool = $isNotPool ? "NOT" : "";	
		$data = $this->db_local->query("select *
			from oms_lostfound where ((lostfound_date >= '".$date."' and lostfound_date <= '".$end."') 
			or (lostfound_status < 3 and lostfound_date <= '".$end."'))
			and pool_code ".$notPool." IN ".$str.";")->result_array();
		return $data;
	}
	
	public function series_lostfound_detail($date, $poolKode, $isNotPool){
		$end = date("Y", strtotime($date));	
		$start = date("Y", strtotime($date. "-1 year")); 
		$str = '';
		foreach((Array) $poolKode AS $key => $val){
			$str = ($str == "" ? "('".$val."'" : $str.",'".$val."'");
		} 
		$str = $str.')';
		$notPool = $isNotPool ? "NOT" : "";		
		$data = $this->db_local->query("select year(lostfound_date) as y, month(lostfound_date) as mt, 
			count(lostfound_date) as cases, sum(case when lostfound_status = 3 then 1 else 0 end) as solves
			from oms_lostfound where year(lostfound_date) >= ".$start." and year(lostfound_date) <= ".$end." and pool_code ".$notPool." IN ".$str." group by y,mt order by y,mt;")->result_array();
		return $data;
	}
	
	public function series_complain_detail($date, $poolKode, $isNotPool){
		$end = date("Y", strtotime($date));	
		$start = date("Y", strtotime($date. "-1 year")); 
		$str = '';
		foreach((Array) $poolKode AS $key => $val){
			$str = ($str == "" ? "('".$val."'" : $str.",'".$val."'");
		} 
		$str = $str.')';
		$notPool = $isNotPool ? "NOT" : "";
		$data = $this->db_local->query("select year(complain_date) as y, month(complain_date) as mt, 
			count(complain_date) as cases, sum(case when complain_status = 3 then 1 else 0 end) as solves
			from oms_complain where year(complain_date) >= ".$start." and year(complain_date) <= ".$end." and pool_code ".$notPool." IN ".$str." group by y,mt order by y,mt;")->result_array();
		return $data;
	}
}

?>