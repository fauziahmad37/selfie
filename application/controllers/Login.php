<?php

include_once('Admin.php');

class Login extends Admin {
	function index() {
		$check_cookie = $this->cac_user_model->validate_cookie();
// 		$check_cookie = false;
		if (($this->input->post('username') && $this->input->post('password')) || $check_cookie) {
			$login = $this->cac_user_model->login($this->input->post()) || $check_cookie;
			
			if ($login) {
				$user = $this->cac_user_model->get_current();
				return redirect('/Dashboard');
				exit();
			} else {
				return redirect('/Login?error=1');
				exit();
			}
		}
		
		$this->load->view('/login');
	}
	
	function logout() {
		$this->cac_user_model->logout();
		return redirect('/Login?success=1');
	}
}