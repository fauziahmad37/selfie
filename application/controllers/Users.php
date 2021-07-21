<?php

include_once('Admin.php');

class Users extends Admin {
	function index($name = '') {
		if(!$this->cac_user_model->is_administrator()){
			return show_404();
		}
		
		$post = $this->input->post();
		if(isset($post['username']))
		{
			if(isset($post['update'])) {
				$this->cac_user_model->update($post);
			}
			else if(isset($post['reset_pass'])){
				$this->cac_user_model->reset_pass($post['username']);
			}
			else {
				$this->cac_user_model->save($post);
			}
		}
		
		$user = array();
		if($name !== '')
			$user = $this->cac_user_model->detail($name);
			
		$data = $this->cac_user_model->data();
		$this->load->model('dashboard_model');
		$dataPool = $this->dashboard_model->get_pools();
		$arrPool = array();
		$arrPool[0] = 'All';
		foreach((Array) $dataPool AS $key => $val){
			$arrPool[$val['id']] = $val['name'];
		}
		
		$this->load->view('header');
		$this->load->view('users', Array('data' => $data, 'user' => $user, 'arrPool' => $arrPool));
		$this->load->view('footer');
		
		//mulai
		// $this->load->library('email');
		// $config['protocol']    = 'smtp';		
		// $config['smtp_host']    = 'mail.expressgroup.co.id';		
		// $config['smtp_port']    = '25';		
		// $config['smtp_timeout'] = '7';		
		// $config['smtp_user']    = 'reza.adiatmaja@expressgroup.co.id';		
		// $config['smtp_pass']    = 'express';		
		// $config['charset']    = 'utf-8';		
		// $config['newline']    = "\r\n";		
		// $config['mailtype'] = 'html'; // or html		
		// $config['validation'] = TRUE; // bool whether to validate email or not      		
		// $this->email->initialize($config);				
		// $this->email->from('reza.adiatmaja@expressgroup.co.id', 'sender_name');
		// $this->email->to('rezapawanov@gmail.com'); 				
		// $this->email->subject('Email Test');		
		// $mesg = $this->load->view('header','',true);
		// $mesg =	$this->load->view('users', Array('data' => $data, 'user' => $user, 'arrPool' => $arrPool),true);
		// $mesg =	$this->load->view('footer','',true);
		// $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
		// $this->email->set_header('Content-type', 'text/html');		
		// $this->email->message($mesg);		
		// $this->email->send();		
		// echo $this->email->print_debugger();
		//selesai
		
		
		
	}
	
	function login_log($name = '') {
		if(!$this->cac_user_model->is_administrator()){
			return show_404();
		}
			
		$data = $this->cac_user_model->login_log_data();
		
		$this->load->view('header');
		$this->load->view('login_log', Array('data' => $data));
		$this->load->view('footer');
		
	}
	
	function ch_pass(){
		$this->load->view('/ch_pass');
	}
	
	function chpass(){
		if(!isset($_POST['password']) || !isset($_POST['password2'])) {return redirect('/Users/ch_pass?error=1'); exit();}
		if($_POST['password'] !== $_POST['password2']) {return redirect('/Users/ch_pass?error=1'); exit();}
		$_POST['username'] = $this->cac_user_model->get_current("username");
		if($this->cac_user_model->chpass($_POST) === FALSE) 
			{return redirect('/Users/ch_pass?error=1'); exit();}
		return redirect('/'); 
		exit();
	}
	
	 function send_mail() { 
         $this->load->library('email');

$config['protocol']    = 'smtp';

$config['smtp_host']    = 'mail.expressgroup.co.id';

$config['smtp_port']    = '25';

$config['smtp_timeout'] = '7';

$config['smtp_user']    = 'reza.adiatmaja@expressgroup.co.id';

$config['smtp_pass']    = 'express';

$config['charset']    = 'utf-8';

$config['newline']    = "\r\n";

$config['mailtype'] = 'text'; // or html

$config['validation'] = TRUE; // bool whether to validate email or not      

$this->email->initialize($config);


$this->email->from('reza.adiatmaja@expressgroup.co.id', 'sender_name');
$this->email->to('reza.adiatmaja@expressgroup.co.id'); 


$this->email->subject('Email Test');

$this->email->message('Testing the email class.');  

$this->email->send();

echo $this->email->print_debugger();
      }
}