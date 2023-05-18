<?php
class Index extends CI_Controller{
	function __construct(){
		parent::__construct();
		
	}
	function index(){
			$this->load->view('v_index');
		
	}

	
}