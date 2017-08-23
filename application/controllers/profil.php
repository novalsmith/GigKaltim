<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_profil');

        $this->is_logged_in();

    }

    public function index()

    {
            $posisi = array(
            "Dashboard"     => base_url()."home",
           
            "Profil " => base_url()."profil",
            "Profil "  => ""
        );

      $id = $this->uri->segment(3);
        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/edit_profil';
     $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['edit']     = $this->db->get_where('profil', array('idprofil' => $id))->row();
           $data["nohari"]         =date('w');
  $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);



        $this->load->view('template_web',$data);
    }




     public function proses_update_profil()

    {


           $isi_profil = $this->input->post('isi_profil');
           $where = $this->input->post('idprofil');


           $data = array(
           
            'isi_profil' => $isi_profil );
        





            $this->db->where('idprofil',$where);
            $this->db->update('profil', $data);


            if ($this->db->affected_rows()) 
            {

                    $this->session->set_flashdata('message', 
                    "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i>  Data Berhasil di Ubah</strong>&nbsp; 
    </div>"

                        );

                            redirect('profil/index/'.$_POST['idprofil']);
            }
            else
            {

                    $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'></i>  Data</strong>&nbsp; Gagal di Edit..
    </div>"

                        );
                                   
                                   redirect('profil/index/'.$_POST['idprofil']);

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