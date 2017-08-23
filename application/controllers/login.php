<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public $data = array('pesan'=> '',);

		public function __construct()
		{
			parent::__construct();
				
				  $this->load->library('form_validation');
				$this->load->model('Login_model', 'login', TRUE);
		}
	
	public function index()
	{
	
		// status user login = BENAR, pindah ke halaman absen
        if ($this->session->userdata('login') == TRUE)
        {
                     $this->session->set_flashdata('pesan_login', 

                        "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Selamat Datang Kembali</strong>&nbsp; di Web Sig Kaltim..
    </div>"

                        );
			redirect('home');
		}
        // status login salah, tampilkan form login
        else
        {
            // validasi sukses
            if($this->login->validasi())
            {
                // cek di database sukses
                if($this->login->cek_user())
                {
                      
                     $this->session->set_flashdata('pesan_login', 

                        "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Selamat Datang</strong>&nbsp; di Web Admin Sig Kaltim..
    </div>"

                        );

                    redirect('home');
                }
                // cek database gagal
                else
                {

                   // $this->data['pesan']        = 'Username atau Password salah.';
                    $this->data['title']        = 'Welcome to Admin Sig Kaltim';
                    $this->data['admin_judul'] = 'Admin Sig Kaltim';
                  
     $this->session->set_flashdata('pesan_kesalahan', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Username Atau Password yang anda Masukan salah, Coba Lagi..
    </div>"

                        );

                  
                    $this->load->view('login', $this->data);
                }
            }
            // validasi gagal
            else
            {
                                 $this->data['title']        = 'Welcome to Admin Sig Kaltims';
                                 $this->data['admin_judul'] = 'Admin Sig Kaltims';


                $this->load->view('login', $this->data);
            }
		}
	}

	public function logout()
	{
        $this->login->logout();
		redirect('login/index');
	}
}
