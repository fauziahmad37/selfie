<?php

class Xone_tiara_model extends CI_Model{
	private $db_local;
	private $db_name = 'x_one_tiara';
	function __construct() {
		parent::__construct();
		
	}
	
	function order($date){
		if($date === '')
			$date = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-d', strtotime($date .' -30 day'));
			
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data['order'] = $this->db_local->query("select thomas, status, count(*) as ct
			from tiara_x1.order where date(created) = '".$date."' group by thomas, status order by thomas, status;")->result_array();
		$data['order_cancel'] = $this->db_local->query("select cancel_type, count(status) as ct from tiara_x1.order 
			where date(created) = '".$date."' and cancel_type is not null group by cancel_type;")->result_array();
		$data['broadcast'] = $this->db_local->query("select pool_id, name, count(*) as ct, sum(case when a.status = 2 then 1 else 0 end) as accept, 
			sum(case when a.status = 3 then 1 else 0 end) as reject from order_broadcast a 
			join taxi on taxi.id =  taxi_id join pool on pool.id = taxi.pool_id
			where date(a.created) = '".$date."' group by pool_id, pool.name;")->result_array();
		$data['broadcast_series'] = $this->db_local->query("select date(created) as dt, count(status) as broadcast, 
			sum(case when status = 2 then 1 else 0 end) as accept, sum(case when status = 3 then 1 else 0 end) as reject 
			from order_broadcast where date(created) >= '".$start."' and date(created) <= '".$date."' group by date(created);")->result_array();			
		$data['order_series'] = $this->db_local->query("select x.dt as dt, mytrip, call_center from 
			(select date(created) as dt, count(status) as mytrip from tiara_x1.order where date(created) >= '".$start."' 
			and date(created) <= '".$date."' and thomas = 't' group by date(created)) as x join
			(select date(created) as dt, count(status) as call_center from tiara_x1.order where date(created) >= '".$start."' 
			and date(created) <= '".$date."' and thomas = 'f' group by date(created)) as y
			on x.dt = y.dt order by x.dt;")->result_array();
		$this->db_local->close();	
		return $data;
	}
	
	function detail_order($id, $date){
		if($date === '')
			$date = date('Y-m-d',strtotime("-1 days"));
		
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = $this->db_local->query("select reg_no, count(*) as broadcast, sum(case when a.status = 2 then 1 else 0 end) as accept, 
			sum(case when a.status = 3 then 1 else 0 end) as reject from taxi left join order_broadcast a on taxi.id =  taxi_id 
			where pool_id = ".$id." and date(a.created) = '".$date."' group by reg_no order by reg_no;")->result_array();
		$this->db_local->close();	
		return $data;
	}
	
	function get_trip($date, $reg_no, $tipe){
		$this->db_local = $this->load->database($this->db_name, TRUE);
		if($tipe === '0') //REGULER
		{
			$start = date('Y-m-d H:i:s', strtotime($date.'+5 hours'));
			$end = date('Y-m-d H:i:s', strtotime($start.'+24 hours'));
		} else {
			$start = date('Y-m-d H:i:s', strtotime($date.'+16 hours'));
			$end = date('Y-m-d H:i:s', strtotime($start.'+24 hours'));
		}
		$data = $this->db_local->query("select (case when \"order\".thomas = 'T' then 'MyTrip' when \"order\".thomas = 'F' then 'Call Center' else 'Melambai' end) as tipe, 
			reg_no, start, trip.end, fare as argo from trip join taxi on taxi.id = taxi_id left join \"order\" on order_id = \"order\".id  
			where trip.start >= '".$start."' 
			and trip.start <= '".$end."' and replace(taxi.reg_no, ' ','') = replace('".$reg_no."', ' ','') and fare > 0 order by start;")
			->result_array();
		$this->db_local->close();		
		return $data;
	}
	
	function load_database(){
		$this->db_local = $this->load->database($this->db_name, TRUE);
	}
	
	function close_database(){
		$this->db_local->close();	
	}
	
	function get_trip_sum($date, $reg_no, $tipe){
		if($tipe === '0') //REGULER
		{
			$start = date('Y-m-d H:i:s', strtotime($date.'+5 hours'));
			$end = date('Y-m-d H:i:s', strtotime($start.'+24 hours'));
		} else {
			$start = date('Y-m-d H:i:s', strtotime($date.'+16 hours'));
			$end = date('Y-m-d H:i:s', strtotime($start.'+24 hours'));
		}
		$data = $this->db_local->query("select count(reg_no) as trip, sum(fare) as argo
			from trip join taxi on taxi.id = taxi_id
			where trip.start >= '".$start."' 
			and trip.start <= '".$end."' and replace(taxi.reg_no, ' ','') = replace('".$reg_no."', ' ','') and fare > 0")
			->result_array();	
		return $data;
	}
	
	function ritase_by_rds($start, $end){
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = $this->db_local->query("select dt, pool_id, ritase, count(ritase) as ct, sum(argo) as total_argo, sum(ritase) as total_ritase 
			from (select date(start) as dt, pool_id, count(start) as ritase, sum(fare) as argo from trip join taxi on trip.taxi_id = taxi.id
			where fare > 0 and date(start) >= '".$start."' and date(start) <= '".$end."' group by dt, pool_id, taxi_id) as x
			group by dt, pool_id, x.ritase order by dt, pool_id, x.ritase;")->result_array();	
		$this->db_local->close();	
		return $data;
	}
	
	function get_status_taxi(){
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data['status'] = $this->db_local->query("select 
                    Taxi.reg_no,
                    Taxi.pool_id,
                    Taxi.lat,
                    Taxi.lng,
                    Taxi.hired_status,
                    Taxi.last_location_update,
                    DriverAccess.assignment_code,
                    driver.name,
                    driver.mobile_no,
                    simcard.msisdn,
                    EXTRACT(EPOCH FROM Taxi.last_location_update AT TIME ZONE 'gmt-7') AS last_location_time,
                    EXTRACT(EPOCH FROM DriverAccess.created AT TIME ZONE 'gmt-7') AS access_time
                FROM taxi Taxi
                JOIN driver_access DriverAccess ON (
                    Taxi.id = DriverAccess.taxi_id
                    AND DriverAccess.is_active = 1
                    AND DriverAccess.access_expiration > LOCALTIMESTAMP
                )
                join driver_card on driver_card.id = DriverAccess.driver_card_id
                join driver on driver.id = driver_card.driver_id
                join simcard on simcard.id = Taxi.simcard_id
				where taxi.pool_id = 24;")->result_array();
        $data['ct'] = $this->db_local->query("select 
                    count(reg_no) from taxi
                ;")->row_array();
		$data['status_atr'] = $this->db_local->query("select 
                    Taxi.reg_no,
                    Taxi.pool_id,
                    Taxi.lat,
                    Taxi.lng,
                    Taxi.hired_status,
                    Taxi.last_location_update,
                    DriverAccess.assignment_code,
                    driver.name,
                    driver.mobile_no,
                    simcard.msisdn,
                    EXTRACT(EPOCH FROM Taxi.last_location_update AT TIME ZONE 'gmt-7') AS last_location_time,
                    EXTRACT(EPOCH FROM DriverAccess.created AT TIME ZONE 'gmt-7') AS access_time
                FROM taxi Taxi
                JOIN driver_access DriverAccess ON (
                    Taxi.id = DriverAccess.taxi_id
                    AND DriverAccess.is_active = 1
                    AND DriverAccess.access_expiration > LOCALTIMESTAMP
                )
                join driver_card on driver_card.id = DriverAccess.driver_card_id
                join driver on driver.id = driver_card.driver_id
                join simcard on simcard.id = Taxi.simcard_id
				where taxi.pool_id = 30;")->result_array();
		$data['status_tamcit'] = $this->db_local->query("select 
                    Taxi.reg_no,
                    Taxi.pool_id,
                    Taxi.lat,
                    Taxi.lng,
                    Taxi.hired_status,
                    Taxi.last_location_update,
                    DriverAccess.assignment_code,
                    driver.name,
                    driver.mobile_no,
                    simcard.msisdn,
                    EXTRACT(EPOCH FROM Taxi.last_location_update AT TIME ZONE 'gmt-7') AS last_location_time,
                    EXTRACT(EPOCH FROM DriverAccess.created AT TIME ZONE 'gmt-7') AS access_time
                FROM taxi Taxi
                JOIN driver_access DriverAccess ON (
                    Taxi.id = DriverAccess.taxi_id
                    AND DriverAccess.is_active = 1
                    AND DriverAccess.access_expiration > LOCALTIMESTAMP
                )
                join driver_card on driver_card.id = DriverAccess.driver_card_id
                join driver on driver.id = driver_card.driver_id
                join simcard on simcard.id = Taxi.simcard_id
				where taxi.pool_id = 29;")->result_array();
        $this->db_local->close();	
		return $data;
	}
	
	function ritase_hour_rds($start, $end){
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = $this->db_local->query("select date(start) as dt, extract(hour from start) as hr, pool_id, count(start) as ritase, sum(fare) as argo 
			from trip join taxi on trip.taxi_id = taxi.id where fare > 0 and date(start) >= '".$start."' and date(start) <= '".$end."' 
			group by dt, hr, pool_id order by dt, hr, pool_id;")->result_array();
        $this->db_local->close();				
		return $data;				
	}
	
	function get_rds_status($isTiara = false){
		$date = date('Y-m-d H:i:s');
		$data = $this->db_local->query("select a.pool_id, connected, error, argo, none, na, total, coalesce(fail, 0) as fail, coalesce(manual, 0) as manual from (
		select taxi.pool_id, sum(case when device_status = 1 then 1 else 0 end) as connected, 
					sum(case when device_status = 2 then 1 else 0 end) as error, sum(case when device_status = 3 then 1 else 0 end) as argo, 
					sum(case when device_status = 4 then 1 else 0 end) as none, sum(case when Taxi.last_location_update < driver_access.created then 1 else 0 end) as na, 
					count(reg_no) as total, sum(case when assignment_code is null then 1 else 0 end) as manual from taxi join driver_access on driver_access.taxi_id = taxi.id and access_expiration >= current_timestamp 
					join pool on pool.id = taxi.pool_id where is_active = 1 ".($isTiara? 'and taxi.pool_id in( 24,29,31,28)' : 'and taxi.pool_id = 26')." group by taxi.pool_id ) a
					full join 
					(select pool_id, count(distinct(reg_no)) as fail from (					
select pool_id, reg_no from log_login 
		join dds on dds.imei = log_login.imei 
		and dds.imei not in (select log_login.imei from log_login where date(log_login.created) = current_date and success = 1
		)
		join taxi on taxi.dds_id = dds.id where date(log_login.created) = current_date and success = 0 ".($isTiara? 'and taxi.pool_id in( 24,29,31,28)' : 'and taxi.pool_id = 26')." group by pool_id, reg_no) x
		group by x.pool_id) b on a.pool_id = b.pool_id
					order by a.pool_id;")->result_array();				
		return $data;
	}
	
	function get_rds_status_detail($id){
		$date = date('Y-m-d H:i:s');
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = $this->db_local->query("select taxi.id, name, card_no, assignment_code, reg_no, (case when device_status = 1 then 'All Connected' 
			when device_status = 2 then 'Error' when device_status = 3 then 'Argo Not Connected' 
			when device_status = 4 then 'None Connected' end) as status, last_location_update, driver_access.created, (case when Taxi.last_location_update < driver_access.created then 'N/A' else 'Normal' end) as na,
			(case when hired_status = 1 then 'Vacant' when hired_status = 2 then 'Hired' when hired_status = 3 then 'Sheltered' when hired_status = 4 or hired_status = 5 then 'Board' end) as hired_status,
			lat, lng, battery_level, Taxi.last_location_update from taxi join driver_access on driver_access.taxi_id = taxi.id and access_expiration >= '".$date."'  
			join driver_card on driver_card.id = driver_access.driver_card_id join driver on driver.id = driver_card.driver_id
			where is_active = 1 and taxi.pool_id = ".$id." order by na, status desc, battery_level;
			")->result_array();
        $this->db_local->close();			
		return $data;
	}
	
	function get_rds_fail_login_detail($id){
		$date = date('Y-m-d H:i:s');
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = $this->db_local->query("select username as username_spj, dds.imei, reg_no, response, attempt_time from log_login 
		join dds on dds.imei = log_login.imei and dds.imei not in (select log_login.imei from log_login where date(log_login.created) = current_date and success = 1)
		join taxi on taxi.dds_id = dds.id where date(log_login.created) = current_date and success = 0 and pool_id = ".$id."
		order by reg_no, attempt_time desc;
			")->result_array();
		return $data;
	}	
	
	function get_lat_lng($day, $start, $end, $hour, $hour_end){
		$dt = "";
		if($day == 1){
			$dt = "and to_char(start, 'dy') like 'mon' ";
		} else if($day == 2){
			$dt = "and to_char(start, 'dy') like 'tue' ";
		} else if($day == 3){
			$dt = "and to_char(start, 'dy') like 'wed' ";
		} else if($day == 4){
			$dt = "and to_char(start, 'dy') like 'thu' ";
		} else if($day == 5){
			$dt = "and to_char(start, 'dy') like 'fri' ";
		} else if($day == 6){
			$dt = "and to_char(start, 'dy') like 'sat' ";
		} else if($day == 7){
			$dt = "and to_char(start, 'dy') like 'sun' ";
		} else if($day == 8){
			$dt = "and to_char(start, 'dy') IN ('mon', 'tue', 'wed', 'thu', 'fri') ";
		} else if($day == 9){
			$dt = "and to_char(start, 'dy') IN ('sat', 'sun') ";
		} 		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = $this->db_local->query("select start as dt, start_lat as lat, start_lng as lng from trip 
			where start_lat is not null and start_lng is not null and fare > 0 
			and date(start) >= '".$start."' and date(start) <= '".$end."'
			and start::time >= '".$hour."' and start::time <= '".$hour_end."'
			".$dt."
			;")->result_array();
		return $data;
	}
	
	function get_taxi_shelter($start, $end, $lat, $lng, $radius){
		$data = $this->db_local->query("Select start as time_start, \"end\" as time_end, reg_no as no_pintu, fare as argo, start_lat, start_lng, end_lat, end_lng, trip.id, pool_id from trip join taxi on taxi_id = taxi.id 
			where fare > 0 and date(start) >= '".$start."' and date(start) <= '".$end."'
			and earth_box(ll_to_earth(".$lat.",".$lng."), ".$radius.") @> (ll_to_earth(start_lat, start_lng));")->result_array();
		return $data;
	}
	function get_trip_sum_spj($query){
		$data = $this->db_local->query("select count(fare) as trip, sum(fare) as argo from (
			select max(fare) as fare from trip join driver_access on driver_access_id = driver_access.id and assignment_code = '".$query."'
			join (select username, max(attempt_time) as dt from log_login where success = 1 and username = '".$query."' group by username) x on x.username = assignment_code
			and (start) >= (dt) 
			group by assignment_code, start) a;")->result_array();	
		return $data;
	}
	function get_trip_spj($query){
		$this->db_local = $this->load->database($this->db_name, TRUE);
		$data = $this->db_local->query("select (case when \"order\".thomas = 'T' then 'MyTrip' when \"order\".thomas = 'F' then 'Call Center' else 'Melambai' end) as tipe, 
			max(start) as start, max(trip.end) as end, max(fare) as argo, max(distance) as distance from trip left join \"order\" on order_id = \"order\".id  
			join driver_access on trip.driver_access_id = driver_access.id and assignment_code = '".$query."' 
			join (select username, max(attempt_time) as dt from log_login where success = 1 and username = '".$query."' group by username) x on x.username = assignment_code
			and (start) >= (dt) group by tipe, start order by start;")
			->result_array();
		$this->db_local->close();						
		return $data;
	}
}

?>