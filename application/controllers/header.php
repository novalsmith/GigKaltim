<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Header extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->is_logged_in();
        
        $this->load->model('m_header');


    }

    public function index()

    {
 
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
           
            "Header"  => base_url()."header",
             "Header"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/v_header';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['join'] =    $this->m_header->tampil();

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }



    public function tambah_header()

    {
       
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."galery",
            "Galery"  => base_url()."tambah_galery",
             "Tambah Galery"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/tambah_header';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
                       $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }


   



public function proses_tambah_header()
{ // buka
 



   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/baner_web/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
        

      $kategori = $this->input->post('kategori');

    $statusheader      = $this->input->post('statusheader');
   
   $data = array(
                    'idheader'       =>  '',
                    'kategori'        => $kategori,
                    'statusheader'       =>    $statusheader,     
    
                     'gambar'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name'])
               
                           );

      
   
      
       

       

            $cek =   $this->m_header->tambah($data);
            if ($cek) {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Data Berhasil Di simpan </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('header/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di simpan..
    </div>"

                        );

                    redirect('header/tambah_header');
            }
            
     

                   



// jangan di ganggu
        }else

        {
  $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss..!!</strong>&nbsp; File yang di terima Hanya Gambar dengan type JPG/JPEG/PNG/GIF. Coba Lagi.
    </div>"

                        );
                    redirect('header/tambah_header');
        }


  

}// tutup

    



    public function edit_header()

    {
     
 $id = $this->uri->segment(3);
  $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Header"  => base_url()."edit_header",
             "Edit Header"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/edit_header';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['edit'] =    $this->db->get_where('header', array('idheader' =>$id))->row();

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }


public function proses_update_header()
{ // buka
 
 $this->form_validation->set_rules('kategori', 'Kategori Header', 'required');
    $this->form_validation->set_rules('statusheader', 'Status Header', 'required');

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_header();
  }
  else
  {

   

if (empty($_FILES['imagefile']['name'])) {
 
 
 $where       = $this->input->post('idheader');
     $kategori = $this->input->post('kategori');
    $statusheader = $this->input->post('statusheader');
   
         $gambar = $this->input->post('gambar');

  
   $data = array(
              
                    'kategori'        => $kategori,
                        'statusheader'       =>    $statusheader,



                           );

           $this->db->where('idheader',$where);
      $this->db->update('header', $data);
      if ($this->db->affected_rows()) 
      {



      $this->session->set_flashdata('message', 
      "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i>Berhasil Di ubah dan gambar tidak di ubah </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('header/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Data Gagal di Ubah, Silahkan Mengubah sala-satu data..* Jika tidak di Ubah Silahkan Kembali dengan Mengklik tombol <b>Kembali</b>
    </div>"

                        );

                    redirect('header/edit_header/'.$_POST['idheader']);
            }
            
    

}
else
{


 $where       = $this->input->post('id_galery');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');




   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/baner_web/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }

        
     $where        = $this->input->post('idheader');
     $kategori     = $this->input->post('kategori');
     $statusheader = $this->input->post('statusheader');
   
         $gambar   = $this->input->post('gambar');

  
             $data = array(
              
                    'kategori'        => $kategori,
                    'statusheader'       =>    $statusheader,
        
                     'gambar'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name'])

                           );




      $this->db->where('idheader',$where);
      $this->db->update('header', $data);
      if ($this->db->affected_rows()) 
      {

              unlink('asset/upload/baner_web/'.$gambar);


                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Data Berhasil di Ubah  </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('header/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di Ubah..
    </div>"

                        );

                    redirect('header/edit_header');
            }
            


// jangan di ganggu
        }else

        {
  $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss..!!</strong>&nbsp; File yang di terima Hanya Gambar dengan type JPG/JPEG/PNG/GIF. Coba Lagi.
    </div>"

                        );
                    redirect('header/edit_header');
        }

}

  }

}// tutup

        




public function hapus($id)
{
 
          $data = $this->db->get_where('header', array('idheader' => $id))->row();


    $data =   $this->m_header->hapus($id);
            if ($this->db->affected_rows($data))
         {
    



            unlink('asset/upload/baner_web/'.$data->gambar);

               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Data Berhasil di Hapus </div>"

                        );
              redirect('header/index');
         }
         else
         {

           $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Maaf Data  ".$data->kategori."</strong>&nbsp; Gagal di Hapus..
    </div>"

                        );
                         redirect('header/index');


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