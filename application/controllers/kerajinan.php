<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kerajinan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->is_logged_in();
        
        $this->load->model('m_kerajinan');


    }

    public function index()

    {
 
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."money",
            "Kerajinan Kaltim"  => base_url()."kerajinan",
            "Kerajinan Kaltim"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/v_kerajinan';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['tampil'] =    $this->m_kerajinan->join_kerajinan();

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }




    public function tambah_kerajinan()

    {
       
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."kerajinan",
            "Kerajinan Kaltim"  => base_url()."kerajinan",
             "Tambah Kerajinan Kaltim"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/tambah_kerajinan';
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


   



public function proses_tambah_kerajinan()
{ // buka
 
 $this->form_validation->set_rules('nama_kerajinan', 'Nama Kerajinan Khas Kaltim', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('latitude', 'Kordinal Latitude X', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('longitude', 'Kordinal Longitude Y', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('ket_kerajinan', 'Keterangan Kerajinan Khas', 'trim|required|min_length[5]');

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_kerajinan();
  }
  else
  {



   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/kerajinan/gambarbesar/".strtolower(str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
  $thumb_src="asset/upload/kerajinan/gambarkecil/".strtolower(str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          
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
                    redirect('kerajinan/tambah_kerajinan');
        }
        
    $judulberita  = $this->input->post('judulberita');


    $nama_kerajinan      = $this->input->post('nama_kerajinan');
    $ket_kerajinan  = $this->input->post('ket_kerajinan');
    
        $lat_kerajinan  =    $this->input->post('latitude');  
          $long_kerajinan  =    $this->input->post('longitude');  
   $data = array(
                    'id_kerajinan'       =>  '',
                    'idberita'           => $judulberita,
                    'nama_kerajinan'       =>    $nama_kerajinan,
                    'ket_kerajinan'   =>    $ket_kerajinan,
    
                     'gambar_besar_k'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'gambar_kecil_k'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'lat_kerajinan'        =>  $lat_kerajinan,
                  'long_kerajinan'        =>  $long_kerajinan

                           );

        $periksa_data     =    $this->m_kerajinan->cek_money($nama_kerajinan);
        $lat_kerajinan    =    $this->m_kerajinan->cek_lat($lat_kerajinan);
        $long_money       =    $this->m_kerajinan->cek_long($long_money);
      
       

        if ($periksa_data->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Data Tempat Kerajinan. ".$nama_kerajinan."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Nama Tempat Kerajinan Yang lain..
    </div>"

                        );
            redirect('kerajinan/tambah_kerajinan');
        } 


        elseif ($lat_kerajinan->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Kordinat ". $this->input->post('latitude')  ."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Kordinat Yang lain..
    </div>"

                        );
            redirect('kerajinan/tambah_kerajinan');
        } 

               elseif ($long_money->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Kordinat ".$this->input->post('longitude')  ."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Kordinat yang lain..
    </div>"

                        );
            redirect('kerajinan/tambah_kerajinan');
        } 

    


        else {
           

            $cek =   $this->m_kerajinan->tambah($data);
            if ($cek) {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Tempat Kerajinan Khas dengan Nama. ".$this->input->post('nama_kerajinan')."</strong>&nbsp; Berhasil di tambah ..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('kerajinan/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di tambah..
    </div>"

                        );

                    redirect('kerajinan/tambah_kerajinan');
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
                    redirect('kerajinan/tambah_money');
        }


  }

}// tutup

    



    public function edit_kerajinan()

    {
     
 $id = $this->uri->segment(3); 

    $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."kerajinan",
            "Kerajinan Kaltim"  => base_url()."kerajinan",
             "Edit Kerajinan Kaltim"  => ""


        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/edit_kerajinan';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['edit'] =    $this->db->get_where('info_kerajinan', array('id_kerajinan' =>$id))->row();
        $data   ['berita'] =    $this->berita_model->get_db();

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }


public function proses_update_kerajinan()
{ // buka
 
 $this->form_validation->set_rules('nama_kerajinan', 'Nama Kerajinan Khas Kaltim', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('latitude', 'Kordinal Latitude X', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('longitude', 'Kordinal Longitude Y', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('ket_kerajinan', 'Keterangan Kerajinan Khas', 'trim|required|min_length[5]');

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_kerajinan();
  }
  else
  {

   

if (empty($_FILES['imagefile']['name'])) {
 
 $where       = $this->input->post('id_kerajinan');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');

   
    $judulberita   = $this->input->post('judulberita');
    $nama_kerajinan      = $this->input->post('nama_kerajinan');
    $ket_kerajinan  = $this->input->post('ket_kerajinan');
    
        $lat_kerajinan  =    $this->input->post('latitude');  
          $long_kerajinan  =    $this->input->post('longitude');  
   $data = array(
                    'idberita'            =>  $judulberita,
                    'nama_kerajinan'       =>    $nama_kerajinan,
                    'ket_kerajinan'   =>    $ket_kerajinan,
    
                   
                  'lat_kerajinan'        =>  $lat_kerajinan,
                  'long_kerajinan'        =>  $long_kerajinan

                           );

     

           $this->db->where('id_kerajinan',$where);
      $this->db->update('info_kerajinan', $data);
      if ($this->db->affected_rows()) 
      {

                  

                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Tempat Kerajinan Khas dengan Nama. ".$this->input->post('nama_kerajinan')."</strong>&nbsp; Berhasil di Ubah dan Gambar tidak Di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('kerajinan/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Data Gagal di Ubah, Silahkan Mengubah sala-satu data..* Jika tidak di Ubah Silahkan Kembali dengan Mengklik tombol <b>Kembali</b>
    </div>"

                        );

                    redirect('kerajinan/edit_kerajinan/'.$_POST['id_kerajinan']);
            }
            
    

}
else
{


 $where       = $this->input->post('id_kerajinan');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');




   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/kerajinan/gambarbesar/".strtolower( str_replace(' ','_',$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
  $thumb_src="asset/upload/kerajinan/gambarkecil/".strtolower( str_replace(' ','_',$_FILES['imagefile']['name']) );
          
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
                    redirect('kerajinan/edit_kerajinan/'.$_POST['id_kerajinan']);
        }
        
 $where       = $this->input->post('id_kerajinan');

    
   

    $judulberita         = $this->input->post('judulberita');
    $nama_kerajinan      = $this->input->post('nama_kerajinan');
    $ket_kerajinan  = $this->input->post('ket_kerajinan');
    
        $lat_kerajinan  =    $this->input->post('latitude');  
          $long_kerajinan  =    $this->input->post('longitude');  
   $data = array(
                  
                  'idberita'               => $judulberita,
                    'nama_kerajinan'       =>    $nama_kerajinan,
                    'ket_kerajinan'   =>    $ket_kerajinan,
    
                     'gambar_besar_k'  =>     strtolower($_FILES['imagefile']['name']),
                  'gambar_kecil_k'  =>     strtolower($_FILES['imagefile']['name']),
                  'lat_kerajinan'        =>  $lat_kerajinan,
                  'long_kerajinan'        =>  $long_kerajinan

                           );

     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');

                   $this->db->where('id_kerajinan',$where);
      $this->db->update('info_kerajinan', $data);
      if ($this->db->affected_rows()) 
      {

              unlink('asset/upload/kerajinan/gambarkecil/'.$gkecil);
            unlink('asset/upload/kerajinan/gambarbesar/'.$gbesar);


                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Tempat Kerajinan Khas dengan Nama. ".$this->input->post('nama_kerajinan')."</strong>&nbsp; Berhasil di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('kerajinan/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di Ubah..
    </div>"

                        );

                    redirect('kerajinan/edit_kerajinan');
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
                    redirect('kerajinan/edit_kerajinan/'.$_POST['id_kerajinan']);
        }

}

  }

}// tutup

        




public function hapus($id)
{
 
          $data = $this->db->get_where('info_kerajinan', array('id_kerajinan' => $id))->row();


      $this->m_kerajinan->hapus($id);
            if ($this->db->affected_rows())
         {
    



                 unlink('asset/upload/kerajinan/gambarkecil/'.$data->gambar_kecil_k);
            unlink('asset/upload/kerajinan/gambarbesar/'.$data->gambar_besar_k);

               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Tempat Kerajinan Khas dengan nama , ".$data->nama_kerajinan."</strong>&nbsp; Berhasil di Hapus..
    </div>"

                        );
              redirect('kerajinan/index');
         }
         else
         {

           $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Maaf Data Tempat Money Changger ".$data->nama_kerajinan."</strong>&nbsp; Gagal di Hapus..
    </div>"

                        );
                         redirect('kerajinan/index');


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