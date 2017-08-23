<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelahiran extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		        $this->is_logged_in();
		        $this->load->model('m_kelahiran');

	}
 public function index()

    {
            $posisi = array(
            "Dashboard"     => base_url()."home",
            "Kelahiran" => base_url()."kelahiran",
            "Kelahiran" =>""
         
        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/kelahiran';
        $data   ['title']   =   'SelamatDatang di web admin Desa Sajen';
        $data   ['brand'] =     'Desa Sajen';
        $data   ['tampil']     = $this->m_kelahiran->tampil();
           $data["nohari"]         =date('w');
  $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);

        $this->load->view('template_web',$data);
    }

 public function tambah_kelahiran()

    {


        $posisi = array(
            "Dashboard"     => base_url()."home",
            "Kelahiran" => base_url()."kelahiran",
              "Tambah Kelahiran"  =>  base_url()."kelahiran/tambah_kelahiran",
              "Tambah Kelahiran" => ""
        );

        $data   ['posisi']    =   $posisi;
        $data   ['content']   =   'admin/tambah_kelahiran';
        $data   ['title']     =   'SelamatDatang di web admin Desa Sajen';
        $data   ['brand']     =     'Desa Sajen';
        $data   ['tampil']    =   $this->m_kelahiran->nomor_regis()->row();
        $data   ['join']      =   $this->m_kelahiran->join_kk();
        $data   ['join_p']     =   $this->m_kelahiran->join_penduduk();
        $data   ['p_ayah']    =   $this->m_kelahiran->pekerjaan_ayah();
        $data   ['p_ibu']    =   $this->m_kelahiran->pekerjaan_ibu();

        $this->load->view('template_web',$data);
    }


    public function proses_tambah()
    {
   

      $this->form_validation->set_rules('tgl_laporan', 'Tanggal Laporan Kelahiran', 'trim|required|min_length[5]|max_length[30]|xss_clean');
      $this->form_validation->set_rules('nama_bayi', 'Nama Bayi', 'trim|required|min_length[5]|max_length[30]|xss_clean');
      $this->form_validation->set_rules('tempat_lhr', 'Tempat Lahir', 'trim|required|min_length[5]|max_length[30]|xss_clean');
      $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required|min_length[5]|max_length[30]|xss_clean');
      $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'trim|required|min_length[5]|max_length[30]|xss_clean');
      $this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'trim|required|min_length[5]|max_length[30]|xss_clean');
      $this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'trim|required|min_length[5]|max_length[30]|xss_clean');
      $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|min_length[5]|xss_clean');
      $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|min_length[5]|xss_clean');
      $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required|min_length[1]|max_length[30]|xss_clean');
      $this->form_validation->set_rules('nomor_kk', 'Tanggal Lahir', 'trim|required');

      if ($this->form_validation->run()==FALSE) {
        
        $this->tambah_kelahiran();

      } else {
       
     
      


        $nama_bayi = $this->input->post('nama_bayi');

   

        $data = array(
                        'id_kelahiran'      =>    $this->input->post('id_kelahiran'),
                        'no_regis'          =>    $this->input->post('nomor_registrasi'),
                        'id_nomor_kk'          =>    $this->input->post('nomor_kk'),
                        'tgl_laporan'       =>    $this->input->post('tgl_laporan'),
                        'nama_bayi'         =>    $this->input->post('nama_bayi'),
                        'tempat_lhr'        =>    $this->input->post('tempat_lhr'),
                        'tgl_lahir'         =>    $this->input->post('tgl_lahir'),
                        'nama_ayah'         =>    $this->input->post('nama_ayah'),
                        'nama_ibu'          =>    $this->input->post('nama_ibu'),
                        'pekerjaan_ayah'    =>    $this->input->post('pekerjaan_ayah'),
                        'pekerjaan_ibu'     =>    $this->input->post('pekerjaan_ibu'),
                        'alamat_dusun'      =>      $this->input->post('alamat'),
                        'keterangan'        =>    $this->input->post('keterangan')

                        );


        $periksa = $this->m_kelahiran->cek_nama_bayi($nama_bayi);

        if ($periksa->num_rows()>0) {
          
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong> Oopss,.".$nama_bayi."</strong>&nbsp; Sudah Ada, silahkan coba dengan nomor yang lain..
    </div>"

                        );
             redirect('kelahiran/tambah_kelahiran');

        } else {
         
        
        

         $cek =  $this->m_kelahiran->tambah($data);
        if ($cek) {
               $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i>&nbsp;".$nama_bayi."</strong>&nbsp; Berhasil di Tambah..
    </div>"

                        );
             redirect('kelahiran/index');
        } else {
                         $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>".$no."</strong>&nbsp; Gagal di Tambah..
    </div>"

                        );
             redirect('kelahiran/index');
        }
        
       }
    
    }
 }

     public function edit_kelahiran()

    {
             $posisi = array(
            "Dashboard"     => base_url()."home",
            "Kelahiran" => base_url()."kelahiran",
            "Edit Kelahiran" => base_url()."kelahiran/edit_kelahiran",
            "Edit Kelahiran"  => "",
             
        );

        $data   ['posisi']  =   $posisi;

        $id = $this->uri->segment(3);
        $data   ['content'] =   'admin/edit_kelahiran';
        $data   ['title']   =   'SelamatDatang di web admin Desa Sajen';
        $data   ['brand'] =     'Desa Sajen';
        $data   ['tampil']     = $this->db->get_where('kelahiran', array('id_kelahiran'=>$id))->row();


        $this->load->view('template_web',$data);
    }

     public function proses_edit_nomor_kk()

    {

  
      $this->form_validation->set_rules('tgl_laporan', 'Tanggal Laporan Kelahiran', 'trim|required|min_length[5]|max_length[30]|xss_clean');
      $this->form_validation->set_rules('nama_bayi', 'Nama Bayi', 'trim|required|min_length[5]|max_length[30]|xss_clean');
      $this->form_validation->set_rules('tempat_lhr', 'Tempat Lahir', 'trim|required|min_length[5]|max_length[30]|xss_clean');
      $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required|min_length[5]|max_length[30]|xss_clean');
      $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'trim|required|min_length[5]|max_length[30]|xss_clean');
      $this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'trim|required|min_length[5]|max_length[30]|xss_clean');
      $this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'trim|required|min_length[5]|max_length[30]|xss_clean');
      $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|min_length[5]|xss_clean');
      $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|min_length[5]|xss_clean');
      $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required|min_length[1]|max_length[30]|xss_clean');

      if ($this->form_validation->run()==FALSE) {
        
        $this->tambah_kelahiran();

      } else {
       
     
      


        $nama_bayi = $this->input->post('nama_bayi');
        $id  = $this->input->post('id_kelahiran');
   

        $data = array(
                       
                        'no_regis'          =>    $this->input->post('nomor_registrasi'),
                       'id_nomor_kk'        =>    $this->input->post('nomor_kk'),

                        'tgl_laporan'       =>    $this->input->post('tgl_laporan'),
                        'nama_bayi'         =>    $this->input->post('nama_bayi'),
                        'tempat_lhr'        =>    $this->input->post('tempat_lhr'),
                        'tgl_lahir'         =>    $this->input->post('tgl_lahir'),
                        'nama_ayah'         =>    $this->input->post('nama_ayah'),
                        'nama_ibu'          =>    $this->input->post('nama_ibu'),
                        'pekerjaan_ayah'    =>    $this->input->post('pekerjaan_ayah'),
                        'pekerjaan_ibu'     =>    $this->input->post('pekerjaan_ibu'),
                        'alamat_dusun'      =>      $this->input->post('alamat'),
                        'keterangan'        =>    $this->input->post('keterangan')

                        );


        







         $cek =  $this->m_kelahiran->update_kelahiran($data,$id);
        if ($cek) {
               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>".$nama_bayi."</strong>&nbsp; Berhasil di Tambah..
    </div>"

                        );
             redirect('kelahiran/index');
        } else {
                         $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>".$no."</strong>&nbsp; Gagal di Tambah..
    </div>"

                        );
             redirect('kelahiran/index');
        }
        
    
    
    }
        
    }




    public function hapus($id)
    {
        $this->m_nomor_kk->hapus($id);
            if ($this->db->affected_rows())
         {
               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Data</strong>&nbsp; Berhasil di Hapus..
    </div>"

                        );
              redirect('nomor_kk/index');
         }
         else
         {

         }
    }




  public function detail_kelahiran($id)

    {
        $id = $this->uri->segment(3);
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Kelahiran"  => base_url()."kelahiran",
            "Detail Kelahiran"  => base_url()."kelahiran/detail_kelahiran",
             "Detail Kelahiran"  =>""
          

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/kelahiran_detail';
        $data   ['title']   =   'Selamat Datang di web admin Desa Sajen';
        $data   ['brand'] =     'Desa Sajen';
        $data   ['detail'] =    $this->m_kelahiran->detail($id)->row();
        $data   ['tampil'] =    $this->m_penduduk->tampil();



        $this->load->view('template_web',$data);
    }








public function hapust($id)
{


      $this->m_kelahiran->hapus($id);
            if ($this->db->affected_rows())
         {
               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Data</strong>&nbsp; Berhasil di Hapus..
    </div>"

                        );
              redirect('kelahiran/index');
         }
         else
         {

           $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Maaf Data</strong>&nbsp; Gagal di Hapus..
    </div>"

                        );
                         redirect('kelahiran/index');


         }
}
  




        public function is_logged_in()
        {
        $is_logged_in = $this->session->userdata('username');
        if(!isset($is_logged_in) || $is_logged_in != true){
            

            $this->session->set_flashdata('pesan_login', 

                        "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss..</strong>&nbsp; Anda harus Login Terlebih dahulu..
    </div>"

                        );


            redirect('login/index');        
        }       
    }
}

/* End of file kelahiran.php */
/* Location: ./application/controllers/kelahiran.php */