<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penduduk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('berita_model');
    }

    public function index()

    {
        $id = $this->uri->segment(3);
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Penduduk"  => base_url()."penduduk",
            "Master Data Penduduk"  => base_url()."penduduk",
             "Master Data Penduduk"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/penduduk';
        $data   ['title']   =   'Selamat Datang di web admin Desa Sajen';
        $data   ['brand'] =     'Desa Sajen';
        $data   ['tampil'] =    $this->berita_model->detail();
           $data["nohari"]         =date('w');
  $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }

    public function detail_penduduk($id)

    {
        $id = $this->uri->segment(3);
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Penduduk"  => base_url()."penduduk",
            "Master Data Penduduk"  => base_url()."penduduk",
             "Detail Data Penduduk"  => base_url()."penduduk/detail_penduduk",
             "Detail Data Penduduk" => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/penduduk_detai';
        $data   ['title']   =   'Selamat Datang di web admin Desa Sajen';
        $data   ['brand'] =     'Desa Sajen';
        $data   ['detail'] =    $this->m_penduduk->detail2($id)->row();
        $data   ['tampil'] =    $this->m_penduduk->tampil();



        $this->load->view('template_web',$data);
    }

    public function tambah_penduduk()

    {
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Penduduk"  => base_url()."penduduk",
            "Master Data Penduduk"  => base_url()."penduduk",
             "Tambah Data Penduduk"  => base_url()."penduduk/tambah_penduduk",
             "Tambah Data Penduduk" => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/tambah_penduduk';
        $data   ['title']   =   'Selamat Datang di web admin Desa Sajen';
        $data   ['brand'] =     'Desa Sajen';
        $data   ['tampil'] =    $this->m_penduduk->detail();
         $data   ['tampil_nomor'] =    $this->m_nomor_kk->tampil();




        $this->load->view('template_web',$data);
    }


   



public function proses_tambah_penduduk()
{
    $this->form_validation->set_rules('id_nomor_kk', 'Nomor KK', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('nik', 'NIK', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('nama', 'Nama Penduduk', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('gol_darah', 'Golongan Darah', 'trim|required|min_length[1]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('shdrt', 'Status harian dalam Rumah tangga', 'trim|required|min_length[3]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('rt', 'RT', 'trim|required|min_length[1]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('rw', 'RW', 'trim|required|min_length[1]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required|min_length[3]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('agama', 'Agama', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('status_perkawinan', 'Status Perkawinan', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('pekerjaan', 'Pekerjaan Penduduk', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('ibu', 'Nama IBU', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('ayah', 'Nama Ayah', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('desa', 'Desa', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('wn', 'Kewarga Negaraan', 'trim|required|min_length[2]|max_length[30]|xss_clean');
  

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

             redirect("penduduk/tambah_penduduk");
  }
  else
  {

    $nik = $this->input->post('nik');

   $data = array(
                    'id_penduduk'       =>  '',
                    'id_nomor_kk'       =>  $this->input->post('id_nomor_kk'),
                    'nik'               =>  $nik,
                    'nama'              =>    $this->input->post('nama')  ,
                    'jenis_kelamin'     =>  $this->input->post('jk'),
                    'gol_darah'         =>  $this->input->post('gol_darah'),
                    'agama'             =>  $this->input->post('agama'),
                    'status_pernikahan' =>  $this->input->post('status_perkawinan'),
                    'status_hdrt'       =>  $this->input->post('shdrt'),
                    'pendidikan'        =>  $this->input->post('pendidikan'),
                    'pekerjaan'         =>  $this->input->post('pekerjaan'),
                    'ibu'               =>  $this->input->post('ibu'),
                     'ayah'             =>  $this->input->post('ayah'),
                    'rt'                =>  $this->input->post('rt'), 
                    'rw'                =>  $this->input->post('rw'), 
                    'desa'              =>  $this->input->post('desa'), 
                    'kecamatan'         =>  $this->input->post('kecamatan'), 
                    'k_negaraan'        =>  $this->input->post('wn')

                           );

        $periksa = $this->m_penduduk->cek_nik($nik);
        if ($periksa->num_rows()>0) {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'></i> Oopss, Penduduk dengan NIK.".$nik."</strong>&nbsp; ini sudah di gunakan, Silahkan Ulangi dengan Nik Lain..
    </div>"

                        );
             redirect('penduduk/tambah_penduduk');
        } else {
           

            $cek =   $this->m_penduduk->tambah($data);
            if ($cek) {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Penduduk dengan NIK.".$nik."</strong>&nbsp; Berhasil di tambah..
    </div>"

                        );
                    redirect('penduduk/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Penduduk dengan.".$nik."</strong>&nbsp; Gagal di tambah..
    </div>"

                        );
                    redirect('penduduk/tambah_penduduk');
            }
            
     

                   }
        



  }
}




  public function edit_penduduk()

    {
      $id = $this->uri->segment(3);
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Penduduk"  => base_url()."penduduk",
            "Master Data Penduduk"  => base_url()."penduduk",
             "Edit Data Penduduk"  => base_url()."penduduk/edit_penduduk",
             "Edit Data Penduduk" => ""

        );

        $data   ['posisi']       =   $posisi;
        $data   ['content']      =   'admin/edit_penduduk';
        $data   ['title']        =   'Selamat Datang di web admin Desa Sajen';
        $data   ['brand']        =     'Desa Sajen';
        $data   ['tampil']       =    $this->m_penduduk->detail();
        $data   ['tampil_nomor'] =    $this->m_nomor_kk->tampil();
        $data   ['edit']         = $this->db->get_where('penduduk', array('id_penduduk' => $id))->row();



        $this->load->view('template_web',$data);
    }



public function proses_edit_penduduk()
{


  
  $id = $this->input->post('id');

    $nik = $this->input->post('nik');

   $data = array(
                    
                    'id_nomor_kk'       =>  $this->input->post('id_nomor_kk'),
                    'nik'               =>  $nik,
                    'nama'              =>    $this->input->post('nama')  ,
                    'jenis_kelamin'     =>  $this->input->post('jk'),
                    'gol_darah'         =>  $this->input->post('gol_darah'),
                    'agama'         =>  $this->input->post('agama'),
                    'status_pernikahan'         =>  $this->input->post('status_perkawinan'),
                    'status_hdrt'         =>  $this->input->post('shdrt'),
                    'pendidikan'         =>  $this->input->post('pendidikan'),
                    'pekerjaan'         =>  $this->input->post('pekerjaan'),
                    'ibu'         =>  $this->input->post('ibu'),
                     'ayah'         =>  $this->input->post('ayah'),
                    'rt'         =>  $this->input->post('rt'), 
                    'rw'         =>  $this->input->post('rw'), 
                    'desa'         =>  $this->input->post('desa'), 
                    'kecamatan'         =>  $this->input->post('kecamatan'), 
                    'k_negaraan'         =>  $this->input->post('wn')

                           );


           $this->db->where('id_penduduk',$id);
            $this->db->update('penduduk', $data);
            if ($this->db->affected_rows()) 
            {

                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon  icon-ok'></i> Penduduk dengan NIK.".$nik."</strong>&nbsp; Berhasil di Edit..
    </div>"

                        );
                    redirect('penduduk/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Penduduk dengan NIk.".$nik."</strong>&nbsp; Gagal di Edit..
    </div>"

                        );
                    redirect('penduduk/edit_penduduk');
            }
            
     

                   }
                 
        


public function hapus($id)
{

      $this->m_penduduk->hapus($id);
            if ($this->db->affected_rows())
         {
               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Data</strong>&nbsp; Berhasil di Hapus..
    </div>"

                        );
              redirect('penduduk/index');
         }
         else
         {

           $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Maaf Data</strong>&nbsp; Gagal di Hapus..
    </div>"

                        );
                         redirect('penduduk/index');


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