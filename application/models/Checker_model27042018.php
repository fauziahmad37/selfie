<?php

class checker_model extends CI_Model {	


    function insertDataMoce($tglSpjProses,$noPintuProses,$pool_id,$val_ritase,$val_drop,$val_km_argo,$val_km_speedo,$val_fix_part,$username){
                
                 $CI = &get_instance();
                 $this->db = $CI->load->database('default', TRUE);
                 $this->db->query("INSERT INTO public.moce_regular VALUES(nextval('log_proses_id_seq'), '".$tglSpjProses."', '".$noPintuProses."', '".$pool_id."', '".$val_ritase."','".$val_drop."','".$val_km_argo."','".$val_km_speedo."','".$val_fix_part."', '".$username."',now());");
             
                return $res;
    }
	
	function getDataActivityChecker($date)
		{
			  $CI = &get_instance();
                $this->db = $CI->load->database('default', TRUE);
		$res = $this->db->query("select * from moce_regular where tgl_spj = '".$date."';")->result_array();
		return $res;
		}

    
       
}

