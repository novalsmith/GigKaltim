<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Komentar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->is_logged_in();
        
        $this->load->model('m_komentar');


    }

    public function index()

    {
    	$id = $this->uri->segment(3);
 
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."komentar",
            "Komentar"  => base_url()."komentar",
             "Komentar"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/v_komentar';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['join'] =    $this->m_komentar->join_berita();
       $data['tampil_komentar']    =   $this->m_komentar->tampil_komentar($id);

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }




     public function balas_komentar()

    {
    	$id = $this->uri->segment(3);
 
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."komentar",
            "Komentar"  => base_url()."komentar",
             "Balas Komentar"  => base_url()."balas_komentar",
             "Balas Komentar" => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/balas_komentar';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['join'] =    $this->m_komentar->join_berita();
       $data['tampil_komentar']    =   $this->m_komentar->tampil_komentar($id);

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }





public function simpan_komentar()
{



 $waktu = date('Y - m -D');
 
 $admin = $this->db->get('admin')->row();
               
         
            $data = array(
                'idkomentar_berita' => $this->input->post('idkomentar'),
                'idberita' => $this->input->post('idberita'),

                'nama' => $_SESSION['nama_lengkap'],
                'email' => $admin->email,
                'isikomentar' => $this->input->post('komentar'),
                'waktu' => $waktu

            );
            $create = $this->m_komentar->tambah($data);
            if ($create) 

 $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong> Komentar Anda </strong>&nbsp; Berhasil terkirim..
    </div>"

                        );
                else $this->session->set_flashdata('message', '<p class="alert alert-danger">Data gagal disimpan!</p>');
            redirect('komentar/balas_komentar/'.$_POST['idberita']);
}
    



    


public function hapus($id)
{
 
          $data = $this->db->get_where('komentar_berita', array('idkomentar_berita' => $id))->row();


      $this->m_komentar->hapus($id);
            if ($this->db->affected_rows())
         {
    



                 unlink('asset/upload/galery/gambarkecil/'.$data->gambar_kecil_gal);
            unlink('asset/upload/galery/gambarbesar/'.$data->gambar_besar_gal);

               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Data Komentar Berhasil di Hapus  </div>"

                        );
              redirect('komentar/index');
         }
         else
         {

           $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Maaf Data Komentar Gagal di Hapus..
    </div>"

                        );
                         redirect('komentar/index');


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