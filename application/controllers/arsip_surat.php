<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Arsip_surat extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_arsip');
              $this->load->library('form_validation');
        $this->is_logged_in();
            $this->load->helper("html");
    $this->load->helper("date");
    }

    public function index()

    {
            $posisi = array(
            "Dashboard"     => base_url()."home",
            "Artikel Berita" => base_url()."category",
            "Kategori " => base_url()."category",
            "Kategori "  => ""
        );


        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/v_arsip_surat';
        $data   ['title']   =   'Welcome To Blessed-ny';
        $data   ['brand']   =     'IKMASOR SBY';
        $data   ['tampil']     = $this->m_arsip->tampil();
        $data["nohari"]         =date('w');
  $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);



        $this->load->view('template_web',$data);
    }

 public function tambah_surat()

    {


        $posisi = array(
            "Dashboard"     => base_url()."home",
            "Artikel Berita" => base_url()."category",
            "Kategori" => base_url()."category",
            "Tambah Kategori"  => base_url()."admin/tambah_category",
              "Tambah Kategori"  => "",
        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/tambah_surat';
        $data   ['title']   =   'Welcome To Blessed-ny';
        $data   ['brand'] =     'Desa Sajen';
       // $data   ['tampil']     = $this->m_category->tampil();
 $data["nohari"]         =date('w');
  $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);

        $this->load->view('template_web',$data);
    }


    public function proses_tambah()
    {
   

      $this->form_validation->set_rules('category', 'Kategori Artikel', 'trim|required|min_length[5]|max_length[30]|xss_clean');

      if ($this->form_validation->run()==FALSE) {
        
        $this->tambah_category();

      } else {
       
     
      


        $category = $this->input->post('category');

   

        $data = array('idkategori' => '',
                        'namakategori' => $category);


        $periksa = $this->m_category->cek_category($category);

        if ($periksa->num_rows()>0) {
          
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong> Oopss,.".$category."</strong>&nbsp; Sudah Ada, silahkan coba dengan Kategori Artikel yang lain..
    </div>"

                        );
             redirect('category/tambah_category');

        } else {
         
        
        







         $cek =  $this->m_category->tambah($data);
        if ($cek) {
               $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i>  ".$category."</strong>&nbsp; Berhasil di Tambah..
    </div>"

                        );
             redirect('category/index');
        } else {
                         $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'></i>  ".$category."</strong>&nbsp; Gagal di Tambah..
    </div>"

                        );
             redirect('category/index');
        }
        
       }
    
    }
 }

     public function edit_category()

    {
             $posisi = array(
            "Dashboard"     => base_url()."home",
            "Penduduk" => base_url()."nomor_kk",
            "Nomor KK" => base_url()."nomor_kk",
            "Edit Nomor KK"  => base_url()."category/edit_category",
              "Edit Nomor KK"  => "",
        );

        $data   ['posisi']  =   $posisi;

        $id = $this->uri->segment(3);
        $data   ['content'] =   'admin/edit_category';
        $data   ['title']   =   'Welcome To Blessed-ny';
        $data   ['brand'] =     'Desa Sajen';
        $data   ['tampil']     = $this->db->get_where('kategori', array('idkategori'=>$id))->row();
 $data["nohari"]         =date('w');
  $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);

        $this->load->view('template_web',$data);
    }

     public function proses_edit_category()

    {


           $category = $this->input->post('category');
           $id = $this->input->post('id');


           $data = array(
           
            'namakategori' => $category );
        




    $periksa = $this->m_category->cek_category($category);

        if ($periksa->num_rows()>0) {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong> Oopss,.".$category."</strong>&nbsp; Sudah Ada, silahkan coba dengan Kategori Artikel yang lain..
    </div>"

                        );
             redirect('category/edit_category/'.$_POST['id']);
          }
          else{
            
          






            $this->db->where('idkategori',$id);
            $this->db->update('kategori', $data);


            if ($this->db->affected_rows()) 
            {

                    $this->session->set_flashdata('message', 
                    "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i>  ".$category."</strong>&nbsp; Berhasil di Edit..
    </div>"

                        );

                            redirect('category/index');
            }
            else
            {

                    $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'></i>  ".$category."</strong>&nbsp; Gagal di Edit..
    </div>"

                        );
                                   
                                    redirect('category/index');

            }
        }
    }




    public function hapus($id)
    {
        $this->m_category->hapus($id);
            if ($this->db->affected_rows())
         {
               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i>  Data</strong>&nbsp; Berhasil di Hapus..
    </div>"

                        );
              redirect('category/index');
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