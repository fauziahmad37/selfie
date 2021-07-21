<?php
	
	class M_callcenter extends CI_Model{

			public function getDataDetail ($connDb,$latitude,$longtitude,$km,$tgl_awal,$tgl_akhir){
			$CI = &get_instance();
	        $this->db = $CI->load->database($connDb,TRUE);
	        $res = $this->db->query("SELECT *
				FROM symtax_bdt_log_archive
				WHERE earth_box(ll_to_earth($latitude,$longtitude), $km) @>ll_to_earth(n_latitude, n_longitude)
				AND d_gps_time_stamp>='$tgl_awal'
				AND d_gps_time_stamp<='$tgl_akhir'
				ORDER by d_gps_time_stamp")->result_array();
	        return $res;
		}
	}

?>