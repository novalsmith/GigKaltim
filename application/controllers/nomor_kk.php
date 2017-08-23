<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nomor_kk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_nomor_kk');
              $this->load->library('form_validation');
        $this->is_logged_in();
            $this->load->helper("html");
    $this->load->helper("date");
    }

    public function index()

    {
            $posisi = array(
            "Dashboard"     => base_url()."home",
            "Penduduk" => base_url()."nomor_kk",
            "Nomor KK" => base_url()."nomor_kk",
            "Nomor KK"  => ""
        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/nomor_kk';
        $data   ['title']   =   'SelamatDatang di web admin Desa Sajen';
        $data   ['brand'] =     'Desa Sajen';
        $data   ['tampil']     = $this->m_nomor_kk->tampil();
           $data["nohari"]         =date('w');
  $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);

        $this->load->view('template_web',$data);
    }

 public function tambah_nomor_kk()

    {


        $posisi = array(
            "Dashboard"     => base_url()."home",
            "Penduduk" => base_url()."nomor_kk",
            "Nomor KK" => base_url()."nomor_kk",
            "Tambah Nomor KK"  => base_url()."nomor_kk/tambah_nomor_kk",
              "Tambah Nomor KK"  => "",
        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/tambah_nomor_kk';
        $data   ['title']   =   'SelamatDatang di web admin Desa Sajen';
        $data   ['brand'] =     'Desa Sajen';
        $data   ['tampil']     = $this->m_nomor_kk->tampil();
 $data["nohari"]         =date('w');
  $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);

        $this->load->view('template_web',$data);
    }


    public function proses_tambah()
    {
   

      $this->form_validation->set_rules('nomor_kk', 'Nomor KK', 'trim|required|min_length[5]|numeric|max_length[30]|xss_clean');

      if ($this->form_validation->run()==FALSE) {
        
        $this->tambah_nomor_kk();

      } else {
       
     
      


        $no = $this->input->post('nomor_kk');

   

        $data = array('id_nomor_kk' => '',
                        'nomor_kk' => $no);


        $periksa = $this->m_nomor_kk->cek_nomor_kk($no);

        if ($periksa->num_rows()>0) {
          
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong> Oopss,.".$no."</strong>&nbsp; Sudah Ada, silahkan coba dengan nomor yang lain..
    </div>"

                        );
             redirect('nomor_kk/tambah_nomor_kk');

        } else {
         
        
        







         $cek =  $this->m_nomor_kk->tambah($data);
        if ($cek) {
               $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>".$no."</strong>&nbsp; Berhasil di Tambah..
    </div>"

                        );
             redirect('nomor_kk/index');
        } else {
                         $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>".$no."</strong>&nbsp; Gagal di Tambah..
    </div>"

                        );
             redirect('nomor_kk/index');
        }
        
       }
    
    }
 }

     public function edit_nomor_kk()

    {
             $posisi = array(
            "Dashboard"     => base_url()."home",
            "Penduduk" => base_url()."nomor_kk",
            "Nomor KK" => base_url()."nomor_kk",
            "Edit Nomor KK"  => base_url()."nomor_kk/edit_nomor_kk",
              "Edit Nomor KK"  => "",
        );

        $data   ['posisi']  =   $posisi;

        $id = $this->uri->segment(3);
        $data   ['content'] =   'admin/edit_nomor_kk';
        $data   ['title']   =   'SelamatDatang di web admin Desa Sajen';
        $data   ['brand'] =     'Desa Sajen';
        $data   ['tampil']     = $this->db->get_where('no_kartu_keluarga', array('id_nomor_kk'=>$id))->row();
 $data["nohari"]         =date('w');
  $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);

        $this->load->view('template_web',$data);
    }

     public function proses_edit_nomor_kk()

    {

         

           $no = $this->input->post('no');
           $id = $this->input->post('id');


           $data = array(
           
            'nomor_kk' => $no );
        
            $this->db->where('id_nomor_kk',$id);
            $this->db->update('no_kartu_keluarga', $data);
            if ($this->db->affected_rows()) 
            {

                    $this->session->set_flashdata('message', 
                    "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>".$no."</strong>&nbsp; Berhasil di Edit..
    </div>"

                        );

                            redirect('nomor_kk/index','refresh');
            }
            else
            {

                    $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>".$no."</strong>&nbsp; Gagal di Edit..
    </div>"

                        );
                                   
                                    redirect('nomor_kk/index','refresh');

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