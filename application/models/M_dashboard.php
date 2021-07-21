<?php
	
	class M_dashboard extends CI_Model{

		public function count_armada(){
			$CI = &get_instance();
			$this->db = $CI->load->database('etaxi',TRUE);
			$res = $this->db->query("select count(id)as armada  from ms_armada where status='Active'")->result_array();
			return $res;
		}

		public function count_spj(){
			$CI = &get_instance();
			$this->db = $CI->load->database('etaxi',TRUE);
			$res = $this->db->query("select count(id) as spj from doc_spj where to_char(created,'YYYY-MM-DD') = '2018-11-29' ")->result_array();
			return $res;
		}

		public function total_setoran_wajib(){
			$CI = &get_instance();
			$this->db = $CI->load->database('etaxi',TRUE);
			$res = $this->db->query("select sum(setoran) as setoran from ms_armada where status='Active' ")->result_array();
			return $res;
		}

		public function total_pendapatan(){
			$CI = &get_instance();
			$this->db = $CI->load->database('etaxi',TRUE);
			$res = $this->db->query("select sum(paid_amount) as total_pendapatan from doc_spj where to_char(created,'YYYY-MM-DD') = '2018-11-01'")->result_array();
			return $res;
		}

		public function revenue_pool(){
			$CI = &get_instance();
			$this->db = $CI->load->database('etaxi',TRUE);
			$res = $this->db->query("select nama_pool,sum(presentasi) as presentasi,sum(jumlah_armada)as jumlah_armada, sum(reguler) as reguler,sum(kalong) as kalong from(
			select b.name  as nama_pool, count(a.id) as reguler , 0 as kalong, 0 as jumlah_armada,round((count(a.id) *100 /(select count(id) from ms_vehicle where status='Active'  )),0) 
			as presentasi
			from doc_spj a
			left join sys_pool b on b.id = a.pool_id 
			where to_char(a.created,'YYYY-MM-DD')='2018-12-01' and a.tipe_operasi='Regular'  and status !='Cancelled'  group by b.name
			union
			select b.name  as nama_pool,  0 as reguler , count(a.id) as kalong, 0 as jumlah_armada,
			round((count(a.id) *100 /(select count(id) from ms_vehicle where status='Active'  )),0) 
			as presentasi
			from doc_spj a
			left join sys_pool b on b.id = a.pool_id 
			where to_char(a.created,'YYYY-MM-DD')='2018-12-01' and a.tipe_operasi='Kalong'  and status !='Cancelled'  group by b.name
			union
			select b.name as nama_pool, 0 as reguler,0 as kalong, count(0) as jumlah_armada,
			round((count(a.id) *100 /(select count(id) from ms_vehicle where status='Active'  )),0) 
			as presentasi from ms_vehicle a 
			left join sys_pool b on (a.pool_id = b.id)
			where a.status='Active' group by b.name
			)as revenue group by nama_pool;")->result_array();
			return $res;
		}
	}
?>
