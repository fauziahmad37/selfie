<?php

class Consolidate_model extends CI_Model {	


		function getIdRecConsolidate($connDb)
		{
		
		$CI = &get_instance();
        $this->db = $CI->load->database($connDb, TRUE);
        $res = $this->db->query("select IDREC from consolidate where date_proccess >='2018-4-1' and STATUS = 0 order by idrec asc limit 50;")->result_array();
		return $res;
		}

		function getQueryConsolidate($connDb,$idRec)
		{
		$CI = &get_instance();
        $this->db = $CI->load->database($connDb, TRUE);
        $res = $this->db->query("select STRREC from consolidate where idrec = ".$idRec." ;")->row()->STRREC;
		return $res;
		}
		
		

		/*
		function execQueryConsolidate($queryExec)
		{
		$CI = &get_instance();
        $this->db = $CI->load->database('simtax_pusat', TRUE);
        $query = $queryExec; 
        $result = $this->db->query($query);;
        return $data;
		}
		*/
		
		function execQueryConsolidate($queryExec)
		{
		$CI = &get_instance();
        $this->db = $CI->load->database('simtax_pusat', TRUE);
        $query = explode(';', $queryExec);
		array_pop($query);
		$this->db->trans_start();		
		foreach($query as $statement){
		$statment = $statement . ";";
		$result = $this->db->query($statement);   
		}
		$this->db->trans_complete(); 
        return $data;
		}
		
		
		
		

		
		



		 function updateQueryConsolidate($connDb,$idRec)
		{
		$CI = &get_instance();
        $this->db = $CI->load->database($connDb, TRUE);
        $res = $this->db->query("update consolidate set STATUS = 1 where  idrec = ".$idRec." ;");
		return $res;
		}
		
}

