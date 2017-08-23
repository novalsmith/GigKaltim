<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->is_logged_in();
        
        $this->load->model('m_hotel');


    }

    public function index()

    {
 
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."hotel",
            "Hotel"  => base_url()."hotel",
             "Hotel"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/v_hotel';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['tampil'] =    $this->m_hotel->join_berita();
        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }




    public function tambah_hotel()

    {
       
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."hotel",
            "Tambah Hotel"  => base_url()."tambah_hotel",
             "Tambah Hotel"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/tambah_hotel';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['tampil'] =    $this->m_hotel->tampil();
        $data   ['berita'] =    $this->berita_model->get_db();

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }


   

public function proses_tambah_hotel()
{ // buka
 
 $this->form_validation->set_rules('nama_hotel', 'Nama Hotel', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('latitude', 'Kordinal Latitude X', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('longitude', 'Kordinal Longitude Y', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('ket_hotel', 'Keterangan Hotel', 'trim|required|min_length[5]');

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_hotel();
  }
  else
  {



   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/hotel/gambarbesar/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']));
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
  $thumb_src="asset/upload/hotel/gambarkecil/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          
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
                    redirect('hotel/tambah_hotel');
        }
        

    $judulberita  = $this->input->post('judulberita');

    $nama_hotel      = $this->input->post('nama_hotel');
    $keterangan_hotel  = $this->input->post('ket_hotel');
      $nama_lengkap  =    $this->input->post('nama_lengkap');  
        $lat_hotel  =    $this->input->post('latitude');  
          $long_hotel  =    $this->input->post('longitude');  
   $data = array(
                    'id_info_hotel'       =>  '',
                    'idberita'            =>  $judulberita,
                    'nama_hotel'       =>    $nama_hotel,
                    'keterangan_hotel'   =>    $keterangan_hotel,
    
                     'gambar_besar_hotel'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'gambar_kecil_hotel'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'lat_hotel'        =>  $lat_hotel,
                  'long_hotel'        =>  $long_hotel

                           );

        $periksa_data     =    $this->m_hotel->cek_nama_hotel($nama_hotel);
        $lat_hotel        =    $this->m_hotel->cek_lat($lat_hotel);
        $long_hotel       =    $this->m_hotel->cek_long($long_hotel);
      
      

        if ($periksa_data->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Data Hotel. ".$nama_hotel."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Nama Hotel Yang lain..
    </div>"

                        );
            redirect('hotel/tambah_hotel');
        } 


        elseif ($lat_hotel->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Kordinat ". $this->input->post('latitude')  ."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Kordinat Yang lain..
    </div>"

              
                        );
            redirect('hotel/tambah_hotel');
        } 

               elseif ($long_hotel->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Kordinat ".$this->input->post('longitude')  ."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Kordinat yang lain..
    </div>"

                        );
            redirect('hotel/tambah_hotel');
        } 
    

        else {
           

            $cek =   $this->m_hotel->tambah($data);
            if ($cek) {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Hotel Baru dengan Nama.".$this->input->post('nama_hotel')."</strong>&nbsp; Berhasil di tambah - Silahkan Cek Email Konfirmasi dari IKMASOR..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('hotel/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di tambah..
    </div>"

                        );

                    redirect('hotel/tambah_hotel');
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
                    redirect('hotel/tambah_hotel/'.$_POST['id_info_hotel']);
        }


  }

}// tutup

    



    public function edit_hotel()

    {
     
 $id = $this->uri->segment(3); $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."hotel",
            "Edit Hotel"  => base_url()."edit_hotel",
             "Edit Hotel"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/edit_hotel';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['berita'] =    $this->berita_model->get_db();
        $data   ['edit'] =    $this->db->get_where('info_hotel', array('id_info_hotel' =>$id))->row();

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }


public function proses_update_hotel()
{ // buka
 
    $this->form_validation->set_rules('nama_hotel', 'Nama Hotel', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('latitude', 'Kordinal Latitude X', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('longitude', 'Kordinal Longitude Y', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('ket_hotel', 'Keterangan Hotel', 'trim|required|min_length[5]');

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_hotel();
  }
  else
  {

   

if (empty($_FILES['imagefile']['name'])) {
 
 $where       = $this->input->post('id_info_hotel');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');

    $judulberita  = $this->input->post('judulberita');
    $nama_hotel      = $this->input->post('nama_hotel');
    $keterangan_hotel  = $this->input->post('ket_hotel');
      $nama_lengkap  =    $this->input->post('nama_lengkap');  
        $lat_hotel  =    $this->input->post('latitude');  
          $long_hotel  =    $this->input->post('longitude');  
   $data = array(
              
                    'idberita'         =>   $judulberita,
                    'nama_hotel'       =>    $nama_hotel,
                    'keterangan_hotel'   =>    $keterangan_hotel,
    
                  'lat_hotel'        =>  $lat_hotel,
                  'long_hotel'        =>  $long_hotel

                           );
     

           $this->db->where('id_info_hotel',$where);
      $this->db->update('info_hotel', $data);
      if ($this->db->affected_rows()) 
      {

                  

                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Hotel dengan Nama.".$this->input->post('nama_hotel')."</strong>&nbsp; Berhasil di Ubah dan Gambar tidak Di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('hotel/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Data Gagal di Ubah, Silahkan Mengubah sala-satu data..* Jika tidak di Ubah Silahkan Kembali dengan Mengklik tombol <b>Kembali</b>
    </div>"

                        );

                    redirect('hotel/edit_hotel/'.$_POST['id_info_hotel']);
            }
            
    

}
else
{


 $where       = $this->input->post('id_info_hotel');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');




   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/hotel/gambarbesar/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
  $thumb_src="asset/upload/hotel/gambarkecil/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          
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
                    redirect('hotel/edit_hotel/'.$_POST['id_info_hotel']);
        }
        
 $where       = $this->input->post('id_info_hotel');

        $judulberita  = $this->input->post('judulberita');

    $nama_hotel      = $this->input->post('nama_hotel');
    $keterangan_hotel  = $this->input->post('ket_hotel');
      $nama_lengkap  =    $this->input->post('nama_lengkap');  
        $lat_hotel  =    $this->input->post('latitude');  
          $long_hotel  =    $this->input->post('longitude');  
   $data = array(
                    
                    'idberita'         =>     $judulberita,
                    'nama_hotel'       =>    $nama_hotel,
                    'keterangan_hotel'   =>    $keterangan_hotel,
    
                     'gambar_besar_hotel'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'gambar_kecil_hotel'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'lat_hotel'        =>  $lat_hotel,
                  'long_hotel'        =>  $long_hotel

                           );

     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');
                   $this->db->where('id_info_hotel',$where);
      $this->db->update('info_hotel', $data);
      if ($this->db->affected_rows()) 
      {

              unlink('asset/upload/hotel/gambarkecil/'.$gkecil);
            unlink('asset/upload/hotel/gambarbesar/'.$gbesar);


                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Hotel dengan Nama.".$this->input->post('nama_hotel')."</strong>&nbsp; Berhasil di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('hotel/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di Ubah..
    </div>"

                        );

                    redirect('hotel/edit_hotel/'.$_POST['id_info_hotel']);
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
                    redirect('hotel/edit_hotel/'.$_POST['id_info_hotel']);
        }

}

  }

}// tutup

        




public function hapus($id)
{
 
          $data = $this->db->get_where('info_hotel', array('id_info_hotel' => $id))->row();


      $this->m_hotel->hapus($id);
            if ($this->db->affected_rows())
         {
    



                 unlink('asset/upload/hotel/gambarkecil/'.$data->gambar_kecil_hotel);
            unlink('asset/upload/hotel/gambarbesar/'.$data->gambar_besar_hotel);

               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Hotel, ".$data->nama_hotel."</strong>&nbsp; Berhasil di Hapus..
    </div>"

                        );
              redirect('hotel/index');
         }
         else
         {

           $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Maaf Data Hotel ".$data->nama_hotel."</strong>&nbsp; Gagal di Hapus..
    </div>"

                        );
                         redirect('hotel/index');


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