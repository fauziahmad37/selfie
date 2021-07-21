<?php

class finance_model extends CI_Model {	


    function getDataKs($connDb,$noKip){
        $CI = &get_instance();
        $this->db = $CI->load->database($connDb,TRUE);
        $res = $this->db->query("select NO_PINTU, KIP_SETOR, NAMA_SETOR , sum(total_ks_terbit) as TOTAL_KS from trx_setoran where KIP_SETOR = '".$noKip."' group by NO_PINTU;")->result_array();
        return $res;
    }
	
	function getDataKsDetail($connDb,$noKip){
        $CI = &get_instance();
        $this->db = $CI->load->database($connDb,TRUE);
        $res = $this->db->query("select NO_PINTU, KIP_SETOR, NAMA_SETOR ,SPJ_DATE, sum(total_ks_terbit) as TOTAL_KS from trx_setoran where KIP_SETOR = '".$noKip."'  group by NO_PINTU,KIP_SETOR,SPJ_DATE, NAMA_SETOR;")->result_array();
        return $res;
    }


     
       
}

