<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('kategori_model');
		$this->load->library('table');
		$this->load->helper("html");
		$this->load->helper("date");
		$this->load->library('pagination');
	}

	public function index()
	{
		$data['main_view'] 		=	'admin/nomor_kk';


				$posisi = array(
			"Dashboard" 	=> base_url()."home",
			"Kategori" => base_url()."kategori",
			"Kategori"	=> ""
		);
			$data ['user']				=	$this->user_model->tampil()->row();
			$data ['posisi']			=	$posisi;
			$data ['judul']			    =	'Kategori Berita';
			$data ['keterangan']		=	'View Kategori Berita';
			$data ['judul_tampilan']	=	'Skripsi Website SIG';
			$data ['footer'] 			= 'Sistem Informasi Geografis'.'&nbsp;@'.date('Y');

				// load tanggal bahasa indonesia
		$data["tglhariini"]		=date('d-m-Y');
		$data["nohari"]			=date('w');
								list($data["tgl"],
									$data["bln"],
									$data["thn"])=explode("-",$data["tglhariini"]);

			$this->load->view('template',$data);

	}
	public function tambah()
	{
			$posisi = array(
			"Dashboard" 	=> base_url()."home",
			"Kategori" => base_url()."kategori",
			"Tambah"	=> base_url()."kategori/tambah",
			"Tambah"	=> ""
		);
			$config ['user']			=	$this->user_model->tampil()->row();
			$config ['cocokan']			=	$this->kategori_model->tampil()->row();
			$config ['main_view'] 		=	'kategori/tambah';
			$config ['posisi']			=	$posisi;
			$config ['judul']			=	'Tambah Kategori Berita';
			$config ['keterangan']		=	'Tambah Kategori Berita';
			$config ['judul_tampilan']	=	'Skripsi Website SIG';

			$config ['footer'] 			= 'Sistem Informasi Geografis'.'&nbsp;@'.date('Y');

				// load tanggal bahasa indonesia
		$config["tglhariini"]		=date('d-m-Y');
		$config["nohari"]			=date('w');
								list($config["tgl"],
									$config["bln"],
									$config["thn"])=explode("-",$config["tglhariini"]);

			$this->load->view('template',$config);
	}
	public function edit_data($id)
	{
		if (isset($_POST['edit'])) {
			# code...
	

	
			$data = array(
				'idkategori' => $this->input->post('idkategori'),
				'namakategori' => $this->input->post('kategori')
				);
			$this->db->where('idkategori',$id);
			$this->db->update('kategori', $data);
			if ($this->db->affected_rows()) 
			{
			$this->session->set_flashdata('message', 

					"<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>".$this->input->post('kategori')."</strong> Berhasil di Ubah.
    </div>"
				);
			redirect('kategori');	
			}

			
	}
	$posisi = array(
			"Dashboard" 	=> base_url()."home",
			"Kategori" => base_url()."kategori",
			"Edit"	=> base_url()."kategori/edit_data",
			"Edit"	=>""
					);
			$config ['user']					=	$this->user_model->tampil()->row();
			$config ['main_view'] 		=	'kategori/edit';
			$config ['posisi']			=	$posisi;
			$config ['judul']			=	'Edit Kategori Berita';
			$config ['judul_tampilan']	=	'Skripsi Website SIG';
			$config ['keterangan']		=	'Edit Kategori Berita';
			$config ['edit']			=	$this->db->get_where('kategori',array('idkategori' => $id))->row();
			$config ['footer'] 			= 'Sistem Informasi Geografis'.'&nbsp;@'.date('Y');
			$config["tglhariini"]		=date('d-m-Y');
			$config["nohari"]			=date('w');
								list($config["tgl"],
									$config["bln"],
									$config["thn"])=explode("-",$config["tglhariini"]);



            $this->load->view('template',$config);
        
	}

		

	public function proses_tambah()
	{
 		// $form = $this->load_form_rules();
       // $this->form_validation->set_rules($form);
		$this->form_validation->set_rules('kategori', 'Nama Kategori', 'trim|required|min_length[5]|max_length[30]');

		if ($this->form_validation->run() == FALSE){
			$this->tambah();
			
		} else {

			

		
				$idkategori		= $this->input->post('idkategori');
				$namakategori	= $this->input->post('kategori');

			
			$create = $this->kategori_model->tambah_data(array('idkategori' => $idkategori,'namakategori' => $namakategori));
			if ($create) $this->session->set_flashdata('message', 

			"<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>".$this->input->post('kategori')."</strong> Berhasil di Simpan.
    </div>"
				);

			else
			 $this->session->set_flashdata('message', 
			 			"<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>".$this->input->post('kategori')."</strong> Gagal Di simpan.
    </div>"
			 	);
			redirect('kategori');


			
		}
	}


	function page($p=0,$jppage=2)
	{

		
		$config['base_url']		=	site_url().'/kategori/page/';
		$config['total_rows']	=	$this->kategori_model->getjrecord();
		$config['per_page']		=	$jppage; 
		$this->pagination->initialize($config); 

		$data["pagination"]		=	$this->pagination->create_links();
		$data["hslquery"]		=	$this->kategori_model->gettemanpage($p,$jppage);
		$data['main_view'] 		=	'kategori/index';
		$this->load->view('template',$data);
	}



	public function is_logged_in(){
		$is_logged_in = $this->session->userdata('username');
		if(!isset($is_logged_in) || $is_logged_in != true){
			

			$this->session->set_flashdata('message', 

						"<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss..</strong>&nbsp; Anda harus Login Terlebih dahulu..
    </div>"

						);


			redirect('login/index');		
		}		
	}




	
	public function hapus($id)
	{
		$this->kategori_model->delete($id);
		if ($this->db->affected_rows())
		 {
		 		 $this->session->set_flashdata('message', 

			"<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>".$this->input->post('kategori')."</strong> Berhasil di Hapus.
    </div>"
		 		 	);
				redirect('kategori');
		}
	}

}

/* End of file kategori.php */
/* Location: ./application/controllers/kategori.php */