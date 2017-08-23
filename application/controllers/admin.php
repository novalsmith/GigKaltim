<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->is_logged_in();
                $this->load->helper("html");
        $this->load->helper("date");
    }

    public function index()

    {
             $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Dashboard"  => ""
        );
$id  = $this->uri->segment(3);
        $data   ['posisi']  =   $posisi;

        $data   ['content'] =   'admin/home';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
     
        $data   ['content'] =   'admin/edit_admin';
        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);
        $data  ['edit']  = $this->db->get_where('admin', array('idadmin' => $id))->row();

        $this->load->view('template_web',$data);
    }






public function proses_update_admin()
{ // buka

  


 $where       = $this->input->post('idadmin');
    $nama_lengkap  = $this->input->post('nama_lengkap');

    $username  = $this->input->post('username');
    $password      = $this->input->post('password');
    $email  = $this->input->post('email');
      $tlp  =    $this->input->post('tlp');  
       
   $data = array(
              
                    'username'         =>   $username,
                    'password'         =>   md5($password),
                    'nama_lengkap'   =>    $nama_lengkap,
    
                  'email'        =>  $email,
                  'tlp'        =>  $tlp

                           );
     





           $this->db->where('idadmin',$where);
      $this->db->update('admin', $data);
      if ($this->db->affected_rows()) 
      {

                  

                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i>Data Berhasil Di update, Dengan Mengubah Password </strong>&nbsp; 
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('admin/index/'.$where);
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Data Gagal di Ubah, Silahkan Mengubah sala-satu data..*
    </div>"

                        );

                    redirect('admin/index/'.$_POST['idadmin']);
            }
            




}// tutup

        



























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