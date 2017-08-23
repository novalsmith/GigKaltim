<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alumni extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('m_alumni');
        $this->load->model('m_anggota');

    }

    public function index()

    {
        $id = $this->uri->segment(3);
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Data Penting"  => base_url()."alumni",
            "Anggota Alumni"  => base_url()."alumni",
             "Anggota Alumni"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/alumni';
        $data   ['title']   =   'Selamat Datang di web admin Desa Sajen';
        $data   ['brand'] =     'IKMASOR SBY';
        $data   ['tampil'] =    $this->m_alumni->join_alumni_anggota();
        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }

    public function detail_anggota($id)

    {
        $id = $this->uri->segment(3);
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
              "Data Penting"  => base_url()."anggota",
            "Anggota Ikmasor"  => base_url()."anggota",
             "Anggota Detail"  => base_url()."anggota/detail_anggota",
            "Anggota Detail"  => "",


        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/detail_anggota';
        $data   ['title']   =   'Selamat Datang di web admin Desa Sajen';
        $data   ['brand'] =     'IKMASOR SBY';
        $data   ['detail'] =    $this->m_anggota->detail($id)->row();
        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);

        $this->load->view('template_web',$data);
    }

    public function tambah_alumni()

    {
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
           "Data Penting"  => base_url()."alumni",
           "Anggota Alumni"  => base_url()."alumni",
             "Tambah Data Alumni"  => base_url()."anggota/tambah_alumni",
             "Tambah Data Alumni" => ""
             


        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/tambah_alumni';
        $data   ['title']   =   'Selamat Datang di web admin Desa Sajen';
       $data   ['brand'] =     'IKMASOR SBY';
       // $data   ['tampil'] =    $this->m_penduduk->detail();
       //  $data   ['tampil_nomor'] =    $this->m_nomor_kk->tampil();
       $data   ['tampil']    =   $this->m_anggota->tampil();

   $data["nohari"]         =date('w');
  $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);





        $this->load->view('template_web',$data);
    }


   



public function proses_tambah_alumni()
{ // buka
 
 $this->form_validation->set_rules('id_anggota', 'Nomor Anggota', 'trim|required|min_length[1]|xss_clean');
    $this->form_validation->set_rules('lulus', 'Tahun Lulus Anggota', 'trim|required|xss_clean');
    $this->form_validation->set_rules('gelar', 'Gelar', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('cumlaude', 'Cumlaude', 'trim|required|min_length[2]|max_length[30]|xss_clean');
   

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_alumni();
  }
  else
  {


    $id_anggota      = $this->input->post('id_anggota');
    $lulus  = $this->input->post('lulus');
      $gelar  =    $this->input->post('gelar');  
        $cumlaude  =    $this->input->post('cumlaude');  
   $data = array(
                    'id_alumni'       =>  '',
                    'id_anggota'       =>    $id_anggota,
                    'tahun_lulus'   =>    $lulus,
                    'gelar'     =>      $gelar ,
                    'cumlaude'        =>  $cumlaude 

                           );

        $periksa_data = $this->m_alumni->cek_idanggota($id_anggota);

       

        if ($periksa_data->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Alumni dengan Data ini Sudah Ada, Silahkan Ganti dengan data yang lain...
    </div>"

                        );
            redirect('alumni/tambah_alumni');
        } 


        else {
           

            $cek =   $this->m_alumni->tambah($data);
            if ($cek) {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Alumni Baru Berhasil Tersimpan</strong>&nbsp;</div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('alumni/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di tambah..
    </div>"

                        );

                    redirect('alumni/tambah_alumni');
            }
            
     

                   }

// jangan di ganggu
        
  }

}// tutup

    
  public function edit_alumni()

    {
     
 $id = $this->uri->segment(3);
         $posisi = array(
            "Dashboard"     => base_url()."home",
    
           "Data Penting"  => base_url()."anggota",
           "Anggota Ikmasor"  => base_url()."anggota",
             "Edit Data Anggota"  => base_url()."anggota/edit_anggota",
             "Edit Data Anggota" => ""

        );

        $data   ['posisi']       =   $posisi;
        $data   ['content']      =   'admin/edit_alumni';
        $data   ['title']        =   'Selamat Datang di web admin Desa Sajen';
         $data   ['brand'] =     'IKMASOR SBY';
              $data   ['tampil']    =   $this->m_anggota->tampil();

        $data   ['edit']         = $this->db->get_where('alumni', array('id_alumni' => $id))->row();
   $data["nohari"]         =date('w');
  $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);




        $this->load->view('template_web',$data);
    }


public function proses_update_alumni()
{ // buka
 
       

 $this->form_validation->set_rules('id_anggota', 'Nomor Anggota', 'trim|required|min_length[1]|xss_clean');
    $this->form_validation->set_rules('lulus', 'Tahun Lulus Anggota', 'trim|required|xss_clean');
    $this->form_validation->set_rules('gelar', 'Gelar', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('cumlaude', 'Cumlaude', 'trim|required|min_length[2]|max_length[30]|xss_clean');
   

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_alumni();
  }
  else
  {

  $where = $this->input->post('id_alumni');
    $id_anggota      = $this->input->post('id_anggota');
    $lulus  = $this->input->post('lulus');
      $gelar  =    $this->input->post('gelar');  
        $cumlaude  =    $this->input->post('cumlaude');  
   $data = array(
               
                    'id_anggota'       =>    $id_anggota,
                    'tahun_lulus'   =>    $lulus,
                    'gelar'     =>      $gelar ,
                    'cumlaude'        =>  $cumlaude 

                           );


            $cek =   $this->m_alumni->update($data,$where);
            if ($cek) {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Data Alumni</strong>&nbsp; Berhasil di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('alumni/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di tambah..
    </div>"

                        );

                    redirect('alumni/edit_alumni');
            }
            
                     
// jangan di ganggu
        
  }

}// tutup

        


public function hapus($id)
{

 
          $data = $this->db->get_where('alumni', array('id_alumni' => $id))->row();


      $this->m_alumni->hapus($id);
            if ($this->db->affected_rows())
         {
    


               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Data ".$data->nama_lengkap."</strong>&nbsp; Berhasil di Hapus..
    </div>"

                        );
              redirect('alumni/index');
         }
         else
         {

           $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Maaf Data ".$data->nama_lengkap."</strong>&nbsp; Gagal di Hapus..
    </div>"

                        );
                         redirect('alumni/index');


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

/* End of file home.php */
/* Location: ./application/controllers/home.php */