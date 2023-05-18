<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function Index()
    {
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['titles'] = 'FORM LOGIN';
            $this->load->view('v_login', $data);
        } else {
            ///validasi success
            $this->_login();
        }
    }
    private function _login(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tbl_pengguna', ['email' => $email])->row_array();

        //Jika user aktif
        if ($user) {

            ///usernya ada
            if ($user['is_active'] == 1) {

                //cek password
                if (password_verify($password, $user['password'])) {

                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];

                    $this->session->set_userdata($data);
                    redirect(('dashboard'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password Salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email Yang dimasukan Belum Aktive!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email Yang dimasukan Belum Diregistrasi </div>');
            redirect('auth');
        }
    }

	
    public function registrasi()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', ['matches' => 'password not match!', 'min_length' => 'password too short']);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['titles'] = 'Form Register';
            $this->load->view('v_register',$data);
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'gambar' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];


            $this->db->insert('tbl_pengguna', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Akun anda telah dibuat. Silahkan Login!</div>');
            redirect('auth');
        }
    }
    public function logout(){
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> kamu berhasil Log out!</div>');
        redirect('auth');
    }
}