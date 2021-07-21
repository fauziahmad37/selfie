<?php
class Moce_model extends CI_Model{
	private $db_local;
	private $db_name = 'moce';
	
	function __construct() {
		parent::__construct();
	}
	
	function get_trip_from_spj($query, $date){
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = $this->db_local->query("SELECT a.nomor_spj as assignment_code, c.rit as rit1, g.rit as rit2, c.drop as drop1, g.drop as drop2
			FROM spj_operasional a
			JOIN xi_trx_checker b ON a.id=b.assignment_id and a.nomor_spj IN ($query)
			JOIN (SELECT checker_id,
			SUM(CASE WHEN component_id=1 THEN VALUE ELSE 0 END) AS rit,
			SUM(CASE WHEN component_id=2 THEN VALUE ELSE 0 END) AS drop
			FROM xi_trx_checker_component GROUP BY checker_id) c ON b.id=c.checker_id
			JOIN (SELECT MAX(spj_operasional.id) AS id,
				id_mobil_pool FROM spj_operasional join xi_trx_checker on assignment_id = spj_operasional.id
				WHERE spj_operasional.id NOT IN (SELECT MAX(spj_operasional.id) FROM spj_operasional where nomor_spj in ($query) group by id) and tgl_spj < '".$date."' GROUP BY id_mobil_pool) e
				ON e.id_mobil_pool=a.id_mobil_pool
			JOIN xi_trx_checker f ON e.id=f.assignment_id
			JOIN (SELECT checker_id,
			SUM(CASE WHEN component_id=1 THEN VALUE ELSE 0 END) AS rit,
			SUM(CASE WHEN component_id=2 THEN VALUE ELSE 0 END) AS drop
			FROM xi_trx_checker_component GROUP BY checker_id) g ON f.id=g.checker_id;")->result_array();
		$this->db_local->close();	
		return $data;
	}
	
	function get_summary_moce($start, $date){
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = $this->db_local->query("select b.id, count(*) as ct from spj_operasional a
			join master_pool b on b.id = a.id_pool_user and a.tgl_spj >= '".$start."' and a.tgl_spj <= '".$date."' 
			JOIN xi_trx_checker c ON a.id=c.assignment_id
			join xi_trx_checker_component d on d.id = c.id 
			group by b.id;")->result_array();
		$this->db_local->close();
		return $data;
	}
	
	function get_summary_moce_detail($id, $start, $date){
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = $this->db_local->query("select nomor_spj, tgl_spj, b.name, c.rit, c.drop from spj_operasional o
			join xi_trx_checker a on a.assignment_id = o.id and o.id_pool_user = ".$id." and tgl_spj >= '".$start."' and tgl_spj <= '".$date."'
			join xi_sys_user b on a.creator = b.id
			JOIN (SELECT checker_id,
						SUM(CASE WHEN component_id=1 THEN VALUE ELSE 0 END) AS rit,
						SUM(CASE WHEN component_id=2 THEN VALUE ELSE 0 END) AS drop
						FROM xi_trx_checker_component GROUP BY checker_id) c ON a.id=c.checker_id;
		")->result_array();
		$this->db_local->close();
		return $data;
	}
}

?>