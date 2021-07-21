<?php
	class M_operasi_eagle extends CI_Model{

		public function getDataOperasi($connDb){
			$CI = &get_instance();
			$this->db = $CI->load->database('dice_eagle',TRUE);
			$res = $this->db->query("select master_kip.no_kip,master_pengemudi.nama as nama_pengemudi,mobil_pool.nomor_pintu,master_pool.nama as nama_pool,
			spj_operasional.nomor_spj,spj_operasional.status as status_spj,spj_operasional.tgl_spj from spj_operasional
			LEFT JOIN master_kip on master_kip.id_pengemudi = spj_operasional.id_kip
			LEFT JOIN mobil_pool on mobil_pool.id = spj_operasional.id_mobil_pool
			LEFT JOIN master_pool on master_pool.id = spj_operasional.id_pool_mobil
			LEFT JOIN master_pengemudi on master_pengemudi.id = master_kip.id_pengemudi
			 where tgl_spj ='2018-11-13' and id_pool_mobil='5'
			and  id_mobil_pool in (select id from mobil_pool where status='active')")->result_array();
			return $res;
		}

		public function getData($connDb,$idpool,$tgl_spj){
			//print_r($idpool);die;
			$CI = &get_instance();
			$this->db = $CI->load->database('dice_eagle',TRUE);
			$res = $this->db->query("select master_kip.no_kip,master_pengemudi.nama as nama_pengemudi,mobil_pool.nomor_pintu,master_pool.nama as nama_pool,
			spj_operasional.nomor_spj,spj_operasional.status as status_spj,spj_operasional.tgl_spj from spj_operasional
			LEFT JOIN master_kip on master_kip.id_pengemudi = spj_operasional.id_kip
			LEFT JOIN mobil_pool on mobil_pool.id = spj_operasional.id_mobil_pool
			LEFT JOIN master_pool on master_pool.id = spj_operasional.id_pool_mobil
			LEFT JOIN master_pengemudi on master_pengemudi.id = master_kip.id_pengemudi
			 where tgl_spj ='$tgl_spj' and id_pool_mobil='$idpool'
			and  id_mobil_pool in (select id from mobil_pool where status='active')")->result_array();
			return $res;
		}

		public function getDataawal($connDb,$idpool,$tgl_spj){
			//print_r($idpool);die;
			$CI = &get_instance();
			$this->db = $CI->load->database('dice_eagle',TRUE);
			$res = $this->db->query("select nomor_pintu,status,stiker_bandara from mobil_pool where id 
			not in (select id_mobil_pool from spj_operasional where tgl_spj='2018-11-13') and status='active' and id_pool='5'")->result_array();
			return $res;
		}
		public function getDataTidakOperasi($connDb,$idpool,$tgl_spj){
			//print_r($idpool);die;
			$CI = &get_instance();
			$this->db = $CI->load->database('dice_eagle',TRUE);
			$res = $this->db->query("select nomor_pintu,status,stiker_bandara from mobil_pool where id 
			not in (select id_mobil_pool from spj_operasional where tgl_spj='$tgl_spj') and status='active' and id_pool='$idpool'")->result_array();
			return $res;
		}
	}
?>