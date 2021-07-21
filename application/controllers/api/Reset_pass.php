<?php

include_once('Api.php');

class reset_pass extends Api {
	function index($username) {
		$this->load->model('cac_user_model');
		$res = $this->cac_user_model->reset_pass($username);
		$this->_print($res > 0 ? 'Success!!' : 'Failed!!');
	}
}
?>