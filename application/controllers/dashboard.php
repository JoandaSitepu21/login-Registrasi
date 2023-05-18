<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function Index()
    {
         $data['user'] = $this->db->get_where('tbl_pengguna', ['email' => $this->session->userdata('email')])->row_array();
         $data['titles'] = 'Halaman Dashboard';
         $this->load->view('v_dashboard', $data);
    }
    
}