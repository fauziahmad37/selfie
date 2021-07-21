<?php

class Uber_model extends CI_Model {
	function uber_upload_data($post)
	{
		$pool_id = $post['id_pool'];
		if($post['type_upload'] === '1') {		
			$fp = fopen($_FILES['userfile']['tmp_name'],'r') or die("can't open file");
			$first = true;
			while($csv_line = fgetcsv($fp,1024)) 
			{
				if($first){
					$first = false;
					if($csv_line[0] !== 'Driver' && $csv_line[0] !== 'Pengemudi'){
						fclose($fp) or die("can't close file");
						return false;
					}
					continue;
				}
				$a = array();
				$a['driver'] = $csv_line[0];
				$a['status'] = $csv_line[1];
				$a['no_hp'] = $csv_line[3];
				$a['id_pool'] = $pool_id;
				$a['last_update'] = date('Y-m-d H:i:s');				
			
				$this->db->where('id_pool', $a['id_pool']);
				$this->db->where('driver', $a['driver']);			
				$q= $this->db->get('uber_driver');
				if( $q->num_rows() > 0 )
				{
					$this->db->where('id_pool', $a['id_pool']);
					$this->db->where('driver', $a['driver']);	
					$this->db->update('uber_driver',$a);
				}
				else
				{
					$a['registered_dt'] = date('Y-m-d', strtotime("previous monday"));				
					$this->db->insert('uber_driver', $a);
				}    
			}
			fclose($fp) or die("can't close file");
		} else if($post['type_upload'] === '2'){
			if($post['tgl'] === '') return false;
			$fp = fopen($_FILES['userfile']['tmp_name'],'r') or die("can't open file");
			$first = true;		
			while($csv_line = fgetcsv($fp,1024)) 
			{			
				if($first){
					$first = false;
					if($csv_line[0] !== 'Name' && $csv_line[0] !== 'Nama'){
						fclose($fp) or die("can't close file");
						return false;
					}
					continue;
				}
				$a = array();
				$driver = $this->db->where('driver', $csv_line[0])->where('id_pool', $pool_id)->limit(1)->get('uber_driver')->row_array();
				if(count($driver) < 1) continue;
				$a['id_driver'] = $driver['id'];			
				$a['trips'] = ($csv_line[5] === '—' ? null : $csv_line[5]);
				$a['acceptance_rate'] = ($csv_line[11] === '—' ? null : str_replace('%','',$csv_line[11]));
				$a['gross_fares'] = $csv_line[1];
				//$a['completion_rate'] = ($csv_line[4] === '—' ? null : str_replace('%','',$csv_line[4]));				
				$a['hours_online'] = ($csv_line[6] * 60); //IN MINUTE
				$a['hours_online'] = $a['hours_online'] == 0 ? null : $a['hours_online'];
				if($a['hours_online'] == null) continue;
				$a['lifetime_rating'] = $csv_line[10];
				//$a['cash_collected'] = $csv_line[7] == '—' ? 0 : $csv_line[7];
				$a['tgl'] = date('Y-m-d', strtotime($post['tgl']));																				
				$a['last_update'] = date('Y-m-d H:i:s');		
				$this->db->where('id_driver', $a['id_driver']);
				$this->db->where('tgl', $a['tgl']);				
				$q= $this->db->get('uber_driver_performance');
				if( $q->num_rows() > 0 )
				{
					$this->db->where('id_driver', $a['id_driver']);	
					$this->db->where('tgl', $a['tgl']);					
					$this->db->update('uber_driver_performance',$a);
				}
				else
				{
					$this->db->insert('uber_driver_performance', $a);
				}    
			}
			fclose($fp) or die("can't close file");
		} else if($post['type_upload'] === '3'){
			$this->load->library('excel');
			$objPHPExcel = PHPExcel_IOFactory::load($_FILES['userfile']['tmp_name']);
			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
			for($i=3;$i<=$arrayCount;$i++)
			{
				$driver = $this->db->where('lower(driver)', strtolower($allDataInSheet[$i]['B']))->where('id_pool', $pool_id)->limit(1)->get('uber_driver')->row_array();
				if(count($driver) < 1) continue;
				for($j = 0;$j<7;$j++){
					if($allDataInSheet[1][chr(ord('D') + (3 * $j))] === '') break;
					$a = array();				
					$a['id_driver'] = $driver['id'];
					$a['tgl'] = date('Y-m-d', strtotime($post['tgl'].'+ '.$j.' day'));
					$a['setoran'] = preg_replace('/[^0-9]/', '', $allDataInSheet[$i][chr(ord('D') + (3 * $j))]);
					$a['ks'] = preg_replace('/[^0-9]/', '', $allDataInSheet[$i][chr(ord('E') + (3 * $j))]);	
					$a['no_pintu'] = str_replace(' ', '', $allDataInSheet[$i][chr(ord('F') + (3 * $j))]);								
					
					$a['last_update'] = date('Y-m-d H:i:s');					
					if($a['setoran'] == null && $a['ks'] == null) continue;
					if($a['setoran'] == '' && $a['ks'] == '') continue;					
					if($a['setoran'] == 0 && $a['ks'] == 0) continue;					
					if($a['setoran'] == null && $a['ks'] == 0) continue;
					if($a['setoran'] == '' && $a['ks'] == 0) continue;					
					if($a['setoran'] == 0 && $a['ks'] == null) continue;
					if($a['setoran'] == 0 && $a['ks'] == '') continue;					
					if($a['setoran'] == null && $a['ks'] > 0) $a['setoran'] = 0;
					if($a['setoran'] > 0 && $a['ks'] == null) $a['ks'] = 0;		
					if($a['setoran'] == '' && $a['ks'] > 0) $a['setoran'] = 0;
					if($a['setoran'] > 0 && $a['ks'] == '') $a['ks'] = 0;										
				
					$this->db->where('id_driver', $a['id_driver']);
					$this->db->where('tgl', $a['tgl']);				
					$q= $this->db->get('uber_driver_ks');
					if( $q->num_rows() > 0 )
					{
						$this->db->where('id_driver', $a['id_driver']);	
						$this->db->where('tgl', $a['tgl']);				
						$this->db->update('uber_driver_ks',$a);
					}
					else
					{
						$this->db->insert('uber_driver_ks', $a);
					} 
				} 
			}
		}
// 		return date('Y-m-d', strtotime($post['tgl'].'+1 day'));
		return true;
	}
	
	function get_updated_data(){
		$data = $this->db->query('select master_pool.name, max(uber_driver.last_update) as dt, 
				max(uber_driver_performance.last_update) as dt2, max(uber_driver_ks.last_update) as dt3
				from master_pool
				left join uber_driver on uber_driver.id_pool = master_pool.id
				left join uber_driver_performance on uber_driver.id = uber_driver_performance.id_driver
				left join uber_driver_ks on uber_driver.id = uber_driver_ks.id_driver								
				where master_pool.active = 1 and master_pool.use_uber = 1
				group by master_pool.name, master_pool.id 
				order by master_pool.id')->result_array();
		return $data;
	}
	
	function get_pool_uber(){
		$data = $this->db->query("select * from master_pool where active = 1 and use_uber = 1 order by id;")->result_array();
		return $data;
	}
	
	function get_pool_uber_detail($id){
		$data = $this->db->query("select * from master_pool where active = 1 and use_uber = 1 and id = ".$id." limit 1;")->row_array();
		return $data;
	}
	
	function get_uber_data($date = '', $next_7 = ''){
		if($date === '') 
			return array();
		$last_30 = date('Y-m-d', strtotime($next_7.'- 30 day'));
		
		$data['data'] = $this->db->query("select a.id_pool, a.status, a.ct, a.fare, a.trip, b.ct as online, c.ct as has_trip,
			coalesce(b.hours_online, 0) as hours_online from 
			(select id_pool, status, count(distinct(uber_driver.id)) as ct,
			sum(gross_fares) as fare, sum(trips) as trip from uber_driver
			left join uber_driver_performance on uber_driver.id = uber_driver_performance.id_driver and tgl >= '".$date."' and tgl <= '".$next_7."'
			where registered_dt <= '".$next_7."'
			group by id_pool, status) a
			left join (			
			select id_pool, status, count(distinct(driver)) as ct, sum(hours_online) as hours_online 
			from uber_driver
			join uber_driver_performance on uber_driver.id = uber_driver_performance.id_driver and tgl >= '".$date."' and tgl <= '".$next_7."'
			and hours_online > 1
			where registered_dt <= '".$next_7."'			
			group by id_pool, status) b on a.id_pool = b.id_pool and a.status = b.status
			left join (			
			select id_pool, status, count(distinct(driver)) as ct
			from uber_driver
			join uber_driver_performance on uber_driver.id = uber_driver_performance.id_driver and tgl >= '".$date."' and tgl <= '".$next_7."'
			and trips > 1
			where registered_dt <= '".$next_7."'			
			group by id_pool, status) c on a.id_pool = c.id_pool and a.status = c.status;")->result_array();
		
		$data['setoran'] = $this->db->query("select id_pool, sum(setoran) as setoran, sum(ks) as ks 
			from uber_driver_ks join uber_driver on uber_driver.id = id_driver
			where tgl >= '".$date."' and tgl <= '".$next_7."'
			group by id_pool
			;")->result_array();
		
		$data['next_7'] = $this->db->query("select count(distinct(id_driver)) as ct, sum(gross_fares) as fare, sum(trips) as trip
			from uber_driver_performance where hours_online > 1 and tgl >= '".$date."' and tgl <= '".$next_7."';")->result_array();

		$data['last_30'] = $this->db->query("select tgl, sum(case when hours_online > 1 then 1 else 0 end) as online, 
			sum(case when trips > 0 then 1 else 0 end) as ct, sum(gross_fares) as fare, sum(trips) as trip 
			from uber_driver_performance where tgl >= '".$last_30."' and tgl <= '".$next_7."' 
			group by tgl order by tgl;")->result_array();		
		
		$data['top'] = $this->db->query("select master_pool.name, driver, sum(gross_fares) as fare , sum(trips) as trip, no_hp
			from uber_driver join uber_driver_performance on uber_driver.id = uber_driver_performance.id_driver
			join master_pool on master_pool.id = id_pool
			where tgl >= '".$date."' and tgl <= '".$next_7."'
			group by id_pool, name, driver, no_hp order by fare desc limit 20;")->result_array();
			
		return $data;
	}

	function get_last_update($date){
		if($date === '')
			$date = date('Y-m-d');			
		$data = $this->db->query("select max(last_update) as last_update from uber_driver_performance where tgl <= '".$date."';")->result_array();
		
		return $data;
	}
	
	function get_uber_data_detail($date = '', $next_7 = '', $id = ''){
		if($date === '' || $id === '') 
			return array();		
		$last_30 = date('Y-m-d', strtotime($next_7.'- 30 day'));
		
		$data['data'] = $this->db->query("select uber_driver.id, driver, no_hp, status, sum(trips) as trip, sum(gross_fares) as fare, 
			sum(hours_online) as hours_online, sum(gross_fares) / sum(trips) as avg_fare, count(tgl) as hk,
			avg(completion_rate) as avg_completion, avg(acceptance_rate) as avg_acceptance from uber_driver
			left join uber_driver_performance on uber_driver.id = uber_driver_performance.id_driver and tgl >= '".$date."' and tgl <= '".$next_7."'
			where id_pool = ".$id." and registered_dt <= '".$next_7."'
			group by uber_driver.id;")->result_array();
			
		$data['setoran'] = $this->db->query("select uber_driver.id, sum(setoran) as setoran, sum(ks) as ks, count(tgl) as spj 
			from uber_driver_ks
			join uber_driver on uber_driver.id = id_driver and id_pool = ".$id."
			where tgl >= '".$date."' and tgl <= '".$next_7."' and registered_dt <= '".$next_7."' 
			group by uber_driver.id;")->result_array();
		
		$data['next_7'] = $this->db->query("select count(distinct(id_driver)) as ct, sum(gross_fares) as fare, sum(trips) as trip
			from uber_driver_performance join uber_driver on uber_driver.id = id_driver and id_pool = ".$id."
			where hours_online > 1 and tgl >= '".$date."' and tgl <= '".$next_7."';")->result_array();

		$data['last_30'] = $this->db->query("select tgl, sum(case when hours_online > 1 then 1 else 0 end) as online, 
			sum(case when trips > 0 then 1 else 0 end) as ct, sum(gross_fares) as fare, sum(trips) as trip 
			from uber_driver_performance join uber_driver on uber_driver.id = id_driver and id_pool = ".$id."
			where tgl >= '".$last_30."' and tgl <= '".$next_7."'
			group by tgl order by tgl;")->result_array();		
		
		$data['top'] = $this->db->query("select master_pool.name, driver, sum(gross_fares) as fare , sum(trips) as trip, no_hp
			from uber_driver join uber_driver_performance on uber_driver.id = uber_driver_performance.id_driver
			join master_pool on master_pool.id = id_pool
			where tgl >= '".$date."' and tgl <= '".$next_7."' and id_pool = ".$id."
			group by id_pool, name, driver, no_hp order by fare desc limit 20;")->result_array();
			
		return $data;
	}
	
	function get_uber_driver_detail($id, $date = ''){
		if($date === '' || $id === '') 
			return array();
		$next_7 = date('Y-m-d', strtotime($date.'+ 6 day'));
		$data = $this->db->query("select uber_driver_performance.tgl, coalesce(trips, 0) as trip, 
				coalesce(hours_online, 0) as hours_online, setoran, ks, coalesce(gross_fares, 0) as fare, no_pintu 
			from uber_driver left join uber_driver_ks on uber_driver_ks.id_driver = uber_driver.id
			left join uber_driver_performance on uber_driver_performance.id_driver = uber_driver.id and uber_driver_performance.tgl = uber_driver_ks.tgl
			where uber_driver.id = ".$id." and uber_driver_performance.tgl >= '".$date."' and uber_driver_performance.tgl <= '".$next_7."'
			order by uber_driver_performance.tgl;")->result_array();
		return $data;
	}
	
}

