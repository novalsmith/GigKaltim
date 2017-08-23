<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Galery extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->is_logged_in();
        
        $this->load->model('m_category');
        $this->load->model('m_galery');


    }

    public function index()

    {
 
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."galery",
            "Galery"  => base_url()."galery",
             "Galery"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/v_galery';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['join'] =    $this->m_galery->join_berita();

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }



    public function tambah_galery()

    {
       
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."galery",
            "Galery"  => base_url()."tambah_galery",
             "Tambah Galery"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/tambah_galery';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
       $data   ['berita'] =    $this->berita_model->get_db();
                       $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }


   



public function proses_tambah_galery()
{ // buka
 
 $this->form_validation->set_rules('judul', 'Judul Foto', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('ket_foto', 'Keterangan Foto', 'trim|required|min_length[5]');

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_galery();
  }
  else
  {



   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/galery/gambarbesar/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
  $thumb_src="asset/upload/galery/gambarkecil/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          
            $n_width = 300;
          $n_height = 200;
        
          if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))
          {
            $im = @ImageCreateFromJPEG ($ori_src) or // Read JPEG Image
            $im = @ImageCreateFromPNG ($ori_src) or // or PNG Image
            $im = @ImageCreateFromGIF ($ori_src) or // or GIF Image
            $im = false; // If image is not JPEG, PNG, or GIF
            
            //$im=ImageCreateFromJPEG($ori_src); 
            $width=ImageSx($im);              // Original picture width is stored
            $height=ImageSy($im);             // Original picture height is stored
            if(($n_height==0) && ($n_width==0)) {
              $n_height = $height;
              $n_width = $width;
            } 
    
            if(!$im) {
              echo '<p>Gagal membuat thumnail</p>';
              exit;
            }
            else {        
              $newimage=@imagecreatetruecolor($n_width,$n_height);                 
              @imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
              @ImageJpeg($newimage,$thumb_src);
              chmod("$thumb_src",0777);
            }
          }else

        {
  $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Hannya Gambar saja..
    </div>"

                        );
                    redirect('galery/tambah_galery');
        }
        

      $judulberita = $this->input->post('judulberita');

    $judul      = $this->input->post('judul');
    $ket_galery  = $this->input->post('ket_foto');
     $idkategori  = $this->input->post('idkategori');
   $data = array(
                    'id_galery'       =>  '',
                    'idberita'        => $judulberita,
                        'judul'       =>    $judul,

              
    
                     'gambar_besar_gal'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'gambar_kecil_gal'     =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                    'ket_galery'     =>    $ket_galery

                           );

        $periksa_data     =    $this->m_galery->cek_judul($judul);
   
      
       

        if ($periksa_data->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Data Galery. ".$judul."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Judul Foto Yang lain..
    </div>"

                        );
            redirect('galery/tambah_galery');
        } 




        else {
           

            $cek =   $this->m_galery->tambah($data);
            if ($cek) {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Galery Foto Baru dengan Judul. ".$this->input->post('judul')."</strong>&nbsp; Berhasil di tambah - Silahkan Cek Email Konfirmasi dari IKMASOR..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('galery/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di tambah..
    </div>"

                        );

                    redirect('galery/tambah_galery');
            }
            
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
                    redirect('galery/tambah_galery');
        }


  }

}// tutup

    



    public function edit_galery()

    {
     
 $id = $this->uri->segment(3); $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."hotel",
            "Galery"  => base_url()."edit_galery",
             "Edit Galery"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/edit_galery';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
       $data   ['berita'] =    $this->berita_model->get_db();     
          $data   ['edit'] =    $this->db->get_where('galery', array('id_galery' =>$id))->row();

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }


public function proses_update_galery()
{ // buka
 
 $this->form_validation->set_rules('judul', 'Judul Foto', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('imagefile', 'Gambar', 'trim|min_length[1]');
    $this->form_validation->set_rules('ket_foto', 'Keterangan Foto', 'trim|required|min_length[5]');

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_galery();
  }
  else
  {

   

if (empty($_FILES['imagefile']['name'])) {
 
 $where       = $this->input->post('id_galery');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');
   
         $judulberita = $this->input->post('judulberita');

    $judul      = $this->input->post('judul');
    $ket_galery  = $this->input->post('ket_foto');
   $data = array(
                   
                    'idberita'        => $judulberita,
                        'judul'       =>    $judul,

              
                   
                    'ket_galery'     =>    $ket_galery

                           );
     

           $this->db->where('id_galery',$where);
      $this->db->update('galery', $data);
      if ($this->db->affected_rows()) 
      {

                  

                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Galery Foto dengan Judul.".$this->input->post('judul')."</strong>&nbsp; Berhasil di Ubah dan Gambar tidak Di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('galery/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Data Gagal di Ubah, Silahkan Mengubah sala-satu data..* Jika tidak di Ubah Silahkan Kembali dengan Mengklik tombol <b>Kembali</b>
    </div>"

                        );

                    redirect('galery/edit_galery/'.$_POST['id_galery']);
            }
            
    

}
else
{


 $where       = $this->input->post('id_galery');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');




   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/galery/gambarbesar/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
  $thumb_src="asset/upload/galery/gambarkecil/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          
          $n_width = 300;
          $n_height = 200;
        
          if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))
          {
            $im = @ImageCreateFromJPEG ($ori_src) or // Read JPEG Image
            $im = @ImageCreateFromPNG ($ori_src) or // or PNG Image
            $im = @ImageCreateFromGIF ($ori_src) or // or GIF Image
            $im = false; // If image is not JPEG, PNG, or GIF
            
            //$im=ImageCreateFromJPEG($ori_src); 
            $width=ImageSx($im);              // Original picture width is stored
            $height=ImageSy($im);             // Original picture height is stored
            if(($n_height==0) && ($n_width==0)) {
              $n_height = $height;
              $n_width = $width;
            } 
    
            if(!$im) {
              echo '<p>Gagal membuat thumnail</p>';
              exit;
            }
            else {        
              $newimage=@imagecreatetruecolor($n_width,$n_height);                 
              @imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
              @ImageJpeg($newimage,$thumb_src);
              chmod("$thumb_src",0777);
            }
          }else

        {
  $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Hannya Gambar saja..
    </div>"

                        );
                    redirect('galery/edit_galery/'.$_POST['id_galery']);
        }
        
 $where       = $this->input->post('id_galery');

      $judulberita = $this->input->post('judulberita');

        $judul      = $this->input->post('judul');
    $ket_galery  = $this->input->post('ket_foto');
     $idkategori  = $this->input->post('idkategori');
   $data = array(
                   
                   'idberita'         => $judulberita,
                        'judul'       =>    $judul,

              
    
                     'gambar_besar_gal'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'gambar_kecil_gal'     =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                    'ket_galery'     =>    $ket_galery

                           );

     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');


                   $this->db->where('id_galery',$where);
      $this->db->update('galery', $data);
      if ($this->db->affected_rows()) 
      {

              unlink('asset/upload/galery/gambarkecil/'.$gkecil);
            unlink('asset/upload/galery/gambarbesar/'.$gbesar);


                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Galery Foto dengan Judul. ".$this->input->post('judul')."</strong>&nbsp; Berhasil di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('galery/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di Ubah..
    </div>"

                        );

                    redirect('galery/edit_galery');
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
                    redirect('galery/edit_galery');
        }

}

  }

}// tutup

        




public function hapus($id)
{
 
          $data = $this->db->get_where('galery', array('id_galery' => $id))->row();


      $this->m_galery->hapus($id);
            if ($this->db->affected_rows())
         {
    



                 unlink('asset/upload/galery/gambarkecil/'.$data->gambar_kecil_gal);
            unlink('asset/upload/galery/gambarbesar/'.$data->gambar_besar_gal);

               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Gslery Foto dengan Judul, ".$data->judul."</strong>&nbsp; Berhasil di Hapus..
    </div>"

                        );
              redirect('galery/index');
         }
         else
         {

           $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Maaf Gslery Foto dengan Judul ".$data->judul."</strong>&nbsp; Gagal di Hapus..
    </div>"

                        );
                         redirect('galery/index');


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