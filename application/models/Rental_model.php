<?php
class Rental_model extends CI_Model{
	private $db_local;
	private $db_name = 'rental';
	
	function __construct() {
		parent::__construct();
	}
	
	function data_rental($start, $end){
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = $this->db_local->query("select b.no_pintu, b.jenis, a.*, c.nama, c.no_kip 
			from tbl_spj_operasional a join tbl_ms_mobil b on a.id_ms_mobil = b.id_ms_mobil 
			join tbl_ms_pengemudi c on c.id_ms_pengemudi = a.id_ms_pengemudi
			where waktu_sewa >= '$start 00:00:00' and waktu_sewa <= '$end 23:59:59';")->result_array();
		$this->db_local->close();	
		return $data;
	}
}

?>