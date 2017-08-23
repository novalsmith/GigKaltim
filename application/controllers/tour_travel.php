<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tour_travel extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->is_logged_in();
        
        $this->load->model('m_tour_travel');


    }

    public function index()

    {
 
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."tour_travel",
            "Tour travel"  => base_url()."tour_travel",
             "Tour travel"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/v_tour_travel';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['tampil'] =    $this->m_tour_travel->join_tour();
        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }




    public function tambah_tour_travel()

    {
       
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."tour_travel",
            "Tambah Tour Travel"  => base_url()."tambah_tour_travel",
             "Tambah Tour Travel"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/tambah_tour_travel';
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


   



public function proses_tambah_tour_travel()
{ // buka
 
 $this->form_validation->set_rules('nama_tour_travel', 'Nama Hotel', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('latitude', 'Kordinal Latitude X', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('longitude', 'Kordinal Longitude Y', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('ket_tour_travel', 'Keterangan Hotel', 'trim|required|min_length[5]');

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_hotel();
  }
  else
  {



   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/tour_travel/gambarbesar/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
  $thumb_src="asset/upload/tour_travel/gambarkecil/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          
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
                    redirect('tour_travel/tambah_tour_travel');
        }
        


        $judulberita      = $this->input->post('judulberita');
    $nama_tour_travel      = $this->input->post('nama_tour_travel');
    $keterangan_tour_travel  = $this->input->post('ket_tour_travel');
        $lat_tour_travel  =    $this->input->post('latitude');  
          $long_tour_travel  =    $this->input->post('longitude');  
   $data = array(
                    'id_tour_travel'       =>  '',
                    'idberita'             =>  $judulberita,
                    'nama_tour_travel'       =>    $nama_tour_travel,
                    'ket_tour_travel'   =>    $keterangan_tour_travel,
    
                     'gambar_besar_tour'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'gambar_kecil_tour'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'lat_tour_travel'        =>  $lat_tour_travel,
                  'long_tour_travel'        =>  $long_tour_travel

                           );

        $periksa_data     =    $this->m_tour_travel->cek_nama_tour_travel($nama_tour_travel);
        $lat_tour_travel        =    $this->m_tour_travel->cek_lat($lat_tour_travel);
        $long_tour_travel       =    $this->m_tour_travel->cek_long($long_tour_travel);
      
       

        if ($periksa_data->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Data Hotel. ".$nama_tour_travel."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Nama Tour Travel Yang lain..
    </div>"

                        );
            redirect('tour_travel/tambah_tour_travel');
        } 


        elseif ($lat_tour_travel->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Kordinat ". $this->input->post('latitude')  ."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Kordinat Yang lain..
    </div>"

                        );
            redirect('tour_travel/tambah_tour_travel');
        } 

               elseif ($long_tour_travel->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Kordinat ".$this->input->post('longitude')  ."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Kordinat yang lain..
    </div>"

                        );
            redirect('tour_travel/tambah_tour_travel');
        } 

    


        else {
           

            $cek =   $this->m_tour_travel->tambah($data);
            if ($cek) {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Tour Travel Baru dengan Nama.".$this->input->post('nama_tour_travel')."</strong>&nbsp; Berhasil di tambah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('tour_travel/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di tambah..
    </div>"

                        );

                    redirect('tour_travel/tambah_tour_travel');
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
                    redirect('tour_travel/tambah_tour_travel');
        }


  }

}// tutup

    



    public function edit_tour_travel()

    {
     
 $id = $this->uri->segment(3); $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."tour_travel",
            "Edit Tour Travel"  => base_url()."edit_tour_travel",
             "Edit Tour Travel"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/edit_tour_travel';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['berita'] =    $this->berita_model->get_db();
        $data   ['edit'] =    $this->db->get_where('info_tour_travel', array('id_tour_travel' =>$id))->row();

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }


public function proses_update_tour_travel()
{ // buka
 
    $this->form_validation->set_rules('nama_tour_travel', 'Nama Tour Travel', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('latitude', 'Kordinal Latitude X', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('longitude', 'Kordinal Longitude Y', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('ket_tour_travel', 'Keterangan Hotel', 'trim|required|min_length[5]');

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_hotel();
  }
  else
  {

   

if (empty($_FILES['imagefile']['name'])) {
 
 $where       = $this->input->post('id_tour_travel');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');



        $judulberita      = $this->input->post('judulberita');

    $nama_tour_travel      = $this->input->post('nama_tour_travel');
    $keterangan_tour_travel  = $this->input->post('ket_tour_travel');
        $lat_tour_travel  =    $this->input->post('latitude');  
          $long_tour_travel  =    $this->input->post('longitude');  
   $data = array(
          
                    'idberita'               => $judulberita,
                    'nama_tour_travel'       =>    $nama_tour_travel,
                    'ket_tour_travel'   =>    $keterangan_tour_travel,
    
                     
                  'lat_tour_travel'        =>  $lat_tour_travel,
                  'long_tour_travel'        =>  $long_tour_travel

                           );
     

           $this->db->where('id_tour_travel',$where);
      $this->db->update('info_tour_travel', $data);
      if ($this->db->affected_rows()) 
      {

                  

                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Tour Travel dengan Nama.".$this->input->post('nama_tour_travel')."</strong>&nbsp; Berhasil di Ubah dan Gambar tidak Di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('tour_travel/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Data Gagal di Ubah, Silahkan Mengubah sala-satu data..* Jika tidak di Ubah Silahkan Kembali dengan Mengklik tombol <b>Kembali</b>
    </div>"

                        );

                    redirect('tour_travel/edit_tour_travel/'.$_POST['id_tour_travel']);
            }
            
    

}
else
{


 $where       = $this->input->post('id_tour_travel');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');




   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/tour_travel/gambarbesar/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']));
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
  $thumb_src="asset/upload/tour_travel/gambarkecil/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']));
          
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
                    redirect('tour_travel/edit_tour_travel/'.$_POST['id_tour_travel']);
        }
        
 $where       = $this->input->post('id_tour_travel');


        $judulberita      = $this->input->post('judulberita');

    $nama_tour_travel      = $this->input->post('nama_tour_travel');
    $keterangan_tour_travel  = $this->input->post('ket_tour_travel');
        $lat_tour_travel  =    $this->input->post('latitude');  
          $long_tour_travel  =    $this->input->post('longitude');  
   $data = array(

                      'idberita'              =>  $judulberita,

                      'nama_tour_travel'       =>    $nama_tour_travel,
                    'ket_tour_travel'   =>    $keterangan_tour_travel,
    
                     'gambar_besar_tour'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'gambar_kecil_tour'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'lat_tour_travel'        =>  $lat_tour_travel,
                  'long_tour_travel'        =>  $long_tour_travel

                           );

     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');
                   $this->db->where('id_tour_travel',$where);
      $this->db->update('info_tour_travel', $data);
      if ($this->db->affected_rows()) 
      {

              unlink('asset/upload/tour_travel/gambarkecil/'.$gkecil);
            unlink('asset/upload/tour_travel/gambarbesar/'.$gbesar);


                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Tour Travel dengan Nama.".$this->input->post('nama_tour_travel')."</strong>&nbsp; 
      Berhasil di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('tour_travel/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di Ubah..
    </div>"

                        );

                    redirect('tour_travel/edit_tour_travel');
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
                    redirect('tour_travel/edit_tour_travel');
        }

}

  }

}// tutup

        




public function hapus($id)
{
 
          $data = $this->db->get_where('info_tour_travel', array('id_tour_travel' => $id))->row();


      $this->m_tour_travel->hapus($id);
            if ($this->db->affected_rows())
         {
    



                 unlink('asset/upload/tour_travel/gambarkecil/'.$data->gambar_kecil_tour);
            unlink('asset/upload/tour_travel/gambarbesar/'.$data->gambar_besar_tour);

               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Hotel, ".$data->nama_tour_travel."</strong>&nbsp; Berhasil di Hapus..
    </div>"

                        );
              redirect('tour_travel/index');
         }
         else
         {

           $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Maaf Data Hotel ".$data->nama_tour_travel."</strong>&nbsp; Gagal di Hapus..
    </div>"

                        );
                         redirect('tour_travel/index');


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