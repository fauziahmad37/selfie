<?php

class cac_user_model extends CI_Model {
	
	private $temp = Array();
	
	function validate_cookie(){	
		$this->load->helper('cookie');
		$cookie = $this->input->cookie('dboardexp', false);
		if($cookie !== null){		
			$res = $this->search_cookie($cookie);
			if($res !== null){						
				return $this->login($res, true);
			}
		}
		return FALSE;
	}
		
	function login($post, $cookie_login = false) {
		$this->load->helper('string');
		$this->load->helper('cookie');
		$res = $this->db->where('username', $post['username'])->limit(1)->get('cac_user');
		if(!is_object($res)) return FALSE;				
		if (!$res->num_rows()) return FALSE;
		$row = $res->row_array();
		if ($row['active'] !== "1") return FALSE;
		if($post['password'] === 'express' && $row['password'] === 'express'){
			$this->session->set_userdata('uname', $row['username']);
			$this->save_login();
			return redirect('/Users/ch_pass');
		}				
		if ($this->_hash($post['password']) != $row['password'] && !$cookie_login) return FALSE;
		if(isset($post['remember'])) {
			$cookie = array(
				'name'   => 'dboardexp',
				'value'  => random_string('alnum', 64),
				'expire' =>  time()+60*60*24*365,
				'secure' => false
			);
			$this->input->set_cookie($cookie);			
			$this->save_cookie($row['username'], $cookie['value']);
		}
		$this->session->set_userdata('uname', $row['username']);
		$this->save_login();
		return TRUE;
	}
	
	private function _hash($str) {
		return sha1(md5($str).substr($str, 3));
	}
	
	function is_login() {
		if(Count($this->temp) > 0 && $this->session->userdata('uname')){
			return $this->temp[$this->session->userdata('uname')];
		} else {
			$user = $this->get_current();
		}
		if ($user === '' || $user['active'] !== '1') return FALSE;
		return $user;
	}
	
	function logout() {
		$this->load->helper('cookie');
		$this->del_cookie($this->session->userdata('uname'), $this->input->cookie('dboardexp', false));		
		$this->session->unset_userdata('uname');
		delete_cookie('dboardexp'); 
	}
	
	function search_cookie($cookie){
		$res = $this->db->where('cookie', $cookie)->limit(1)->join('cac_user','cac_user.username = cac_user_cookie.username')->get('cac_user_cookie');
		if(!is_object($res)) return null;
		if(!$res->num_rows()) return null;
		return $res->row_array();
	}
	
	function save_cookie($username, $cookie) {
		$res = $this->db->query("insert into cac_user_cookie values('".$username."', '".$cookie."');");
		return TRUE;
	}
	
	function del_cookie($username, $cookie){
		$this->db->query("delete from cac_user_cookie where username = '".$username."' and cookie = '".$cookie."';");
	}
	
	function detail($name) {
		$res = $this->db->where('username', $name)->limit(1)->get('cac_user');
		if (!$res->num_rows()) return Array();
		$this->temp[$name] = $res->row_array();
		
		return $this->temp[$name];
	}
	
	// function data() {
		// $this->db->order_by('username ASC');
		// $res = $this->db->query('select a.*, max(a.dt) as login_dt, count(a.dt) as ct from a 
			// left join cac_login_log on a.username = cac_login_log.username where active = 1 
			// group by a.username, a.password, a.active, a.id_privilege, a.create_dt, a.area');
		// $out = ($res->result_array());
		
		// return $out;
	// }
	
	function data(){
			$res = $this->db->select('cac_user.*, name')->join('master_pool', 'master_pool.id = pool')->order_by('username ASC')->get('cac_user');
			$out = ($res->result_array());
			return $out;
		}
	
	function get_current($field = '') {
		if (!$this->session->userdata('uname')) return '';
		$user = $this->detail($this->session->userdata('uname'));
		if ($field) return $user[$field];
		return $user;
	}
	
	function is_administrator() {
		return $this->get_current('id_privilege') === '1';
	}
	
	function get_privilege() {
		return $this->get_current('id_privilege');
	}
	
	function save($post) {
		foreach (Array('username', 'id_privilege', 'active', 'area', 'pool') AS $key => $val) {
			if (isset($post[$val])) $save[$val] = $post[$val];
		}
		
		if ($save['pool'] == 1)
		{
			$save['id_pool_simtax'] =9;
		} else if ($save['pool'] == 2)
		{
			$save['id_pool_simtax'] =10;
		} else if ($save['pool'] == 3)
		{
			$save['id_pool_simtax'] =19;
		} else if ($save['pool'] == 4)
		{
			$save['id_pool_simtax'] =20;
		} else if ($save['pool'] == 5)
		{
			$save['id_pool_simtax'] =38;
		} else if ($save['pool'] == 6)
		{
			$save['id_pool_simtax'] =37;
		} else if ($save['pool'] == 7)
		{
			$save['id_pool_simtax'] =35;
		} else if ($save['pool'] == 8)
		{
			$save['id_pool_simtax'] =33;
		} else if ($save['pool'] == 9)
		{
			$save['id_pool_simtax'] =50;
		} else if ($save['pool'] == 10)
		{
			$save['id_pool_simtax'] =36;
		} else if ($save['pool'] == 11)
		{
			$save['id_pool_simtax'] =62;
		} else if ($save['pool'] == 12)
		{
			$save['id_pool_simtax'] =61;
		} else if ($save['pool'] == 15)
		{
			$save['id_pool_simtax'] =3;
		} else if ($save['pool'] == 16)
		{
			$save['id_pool_simtax'] =4;
		} else if ($save['pool'] == 17)
		{
			$save['id_pool_simtax'] =2;
		} else if ($save['pool'] == 18)
		{
			$save['id_pool_simtax'] =34;
		} else if ($save['pool'] == 19)
		{
			$save['id_pool_simtax'] =11;
		} else if ($save['pool'] == 20)
		{
			$save['id_pool_simtax'] =12;
		} else if ($save['pool'] == 21)
		{
			$save['id_pool_simtax'] =5;
		} else if ($save['pool'] == 22)
		{
			$save['id_pool_simtax'] =6;
		} else if ($save['pool'] == 23)
		{
			$save['id_pool_simtax'] =7;
		} else if ($save['pool'] == 24)
		{
			$save['id_pool_simtax'] =32;
		}
		
		if (!$save['active']) $save['active'] = '0';
		$save['password'] = "express";
		
		$res = $this->db->insert('cac_user', $save);
		if (!$res) return $this->db->_error_message();
		
		return TRUE;
	}
	
	function update($post){
		foreach (Array('id_privilege', 'active', 'area', 'pool') AS $key => $val) {
			if (isset($post[$val])) $save[$val] = $post[$val];
		}
		
		if ($save['pool'] == 1)
		{
			$save['id_pool_simtax'] =9;
		} else if ($save['pool'] == 2)
		{
			$save['id_pool_simtax'] =10;
		} else if ($save['pool'] == 3)
		{
			$save['id_pool_simtax'] =19;
		} else if ($save['pool'] == 4)
		{
			$save['id_pool_simtax'] =20;
		} else if ($save['pool'] == 5)
		{
			$save['id_pool_simtax'] =38;
		} else if ($save['pool'] == 6)
		{
			$save['id_pool_simtax'] =37;
		} else if ($save['pool'] == 7)
		{
			$save['id_pool_simtax'] =35;
		} else if ($save['pool'] == 8)
		{
			$save['id_pool_simtax'] =33;
		} else if ($save['pool'] == 9)
		{
			$save['id_pool_simtax'] =50;
		} else if ($save['pool'] == 10)
		{
			$save['id_pool_simtax'] =36;
		} else if ($save['pool'] == 11)
		{
			$save['id_pool_simtax'] =62;
		} else if ($save['pool'] == 12)
		{
			$save['id_pool_simtax'] =61;
		} else if ($save['pool'] == 15)
		{
			$save['id_pool_simtax'] =3;
		} else if ($save['pool'] == 16)
		{
			$save['id_pool_simtax'] =4;
		} else if ($save['pool'] == 17)
		{
			$save['id_pool_simtax'] =2;
		} else if ($save['pool'] == 18)
		{
			$save['id_pool_simtax'] =34;
		} else if ($save['pool'] == 19)
		{
			$save['id_pool_simtax'] =11;
		} else if ($save['pool'] == 20)
		{
			$save['id_pool_simtax'] =12;
		} else if ($save['pool'] == 21)
		{
			$save['id_pool_simtax'] =5;
		} else if ($save['pool'] == 22)
		{
			$save['id_pool_simtax'] =6;
		} else if ($save['pool'] == 23)
		{
			$save['id_pool_simtax'] =7;
		} else if ($save['pool'] == 24)
		{
			$save['id_pool_simtax'] =32;
		}
		
		if (!$save['active']) $save['active'] = '0';
		$res = $this->db->where('username', $post['username'])->limit(1)->update('cac_user', $save);
		if (!$res) return $this->db->_error_message();
		
		return TRUE;
	}
	
	function login_log_data(){
		$res = $this->db->order_by('dt desc')->limit(25)->get('cac_login_log');
		
		$out = ($res->result_array());
		
		return $out;
	}
	
	private function save_login() {
		if ($this->cac_user_model->is_login() === FALSE) return;
		
		$this->load->library('user_agent');
		
		$log = array(
			'ip' => (string) $this->input->ip_address(),
			'user_agent' => (string) $this->agent->agent_string(),
			'browser' => (string) $this->agent->browser(),
			'username' => (string) $this->get_current('username'),
			'dt' => (string) date('Y-m-d H:i:s')
			);
		
		$this->db->insert('cac_login_log', $log);
	}
	
	function reset_pass($username){
		$this->db->query("update cac_user set password = 'express' where username = '$username';");
		return $this->db->affected_rows();
	}
	
	function chpass($post) {
		$save['password'] = $this->_hash($post['password']);
		$unique = $post['username'];
		
		$res = $this->db->where('username', $unique)->limit(1)->update('cac_user', $save);
		if (!$res) return FALSE;
		
		return TRUE;
	}
	
	function get_area_checker($areaChecker){
		$data = $this->db->query("select * from master_checker_pool where id_area = ".$areaChecker." and active = 1;")->result_array();
		return $data;
	}
	
}

