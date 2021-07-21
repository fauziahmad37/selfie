<?php
	class M_penghitaman extends CI_Model{
		public function getDataPenghitaman($connDb){
			$CI = &get_instance();
	        $this->db = $CI->load->database($connDb,TRUE);
	        $res = $this->db->query("
	        		select * from tes_penghitaman
	        	")->result_array();
	        return $res;
		}

		public function getCallProcedure($connDb){
			$CI = &get_instance();
	        $this->db = $CI->load->database($connDb,TRUE);
	        $res = $this->db->query("call testPenghitaman()");
	        return $res;
		}
	}
?>