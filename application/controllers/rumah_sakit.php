<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rumah_sakit extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->is_logged_in();
        
        $this->load->model('m_rumah_sakit');

    }

    public function index()

    {
 
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."rumah_sakit",
            "Rumah Sakit"  => base_url()."rumah_sakit",
             "Rumah Sakit"  => ""

        );


        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/v_rumah_sakit';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['tampil'] =    $this->m_rumah_sakit->join_berita();
        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }



    public function tambah_rumah_sakit()

    {
       
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."rumah_sakit",
            "Rumah Sakit"  => base_url()."rumah_sakit",
            "Tambah Rumah Sakit" =>""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/tambah_rumah_sakit';
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


   

public function proses_tambah_rumah_sakit()
{ // buka
 
 $this->form_validation->set_rules('nama_rumah_sakit', 'Nama Rumah Sakit', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('latitude', 'Kordinal Latitude X', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('longitude', 'Kordinal Longitude Y', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('ket_rumah_sakit', 'Keterangan Rumah Sakit', 'trim|required|min_length[5]');

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_rumah_sakit();
  }
  else
  {



   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/rumah_sakit/gambarbesar/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
  $thumb_src="asset/upload/rumah_sakit/gambarkecil/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          
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
                    redirect('rumah_sakit/tambah_rumah_sakit');
        }
        


        $judulberita      = $this->input->post('judulberita');
    $nama_rumah_sakit      = $this->input->post('nama_rumah_sakit');
    $ket_rumah_sakit  = $this->input->post('ket_rumah_sakit');
        $lat_rs  =    $this->input->post('latitude');  
          $long_rs  =    $this->input->post('longitude');  
   $data = array(
                    'id_rumah_sakit'       =>  '',
                    'idberita'             => $judulberita,
                    'nama_rs'       =>    $nama_rumah_sakit,
                    'ket_rs'   =>    $ket_rumah_sakit,
    
                     'gambar_besar_rs'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'gambar_kecil_rs'     =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'lat_rs'        =>  $lat_rs,
                  'long_rs'        =>  $long_rs

                           );

        $periksa_data     =    $this->m_rumah_sakit->cek_nama_rumah_sakit($nama_rumah_sakit);
        $lat_rs        =    $this->m_rumah_sakit->cek_lat($lat_rs);
        $long_rs       =    $this->m_rumah_sakit->cek_long($long_rs);
      
       

        if ($periksa_data->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Data Rumah Sakit. ".$nama_rumah_sakit."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Nama Rumah Sakit Yang lain..
    </div>"

                        );
            redirect('rumah_sakit/tambah_rumah_sakit');
        } 


        elseif ($lat_rs->num_rows()>0) 
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

               elseif ($long_rs->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Kordinat ".$this->input->post('longitude')  ."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Kordinat yang lain..
    </div>"

                        );
            redirect('rumah_sakit/tambah_rumah_sakit');
        } 

    


        else {
           

            $cek =   $this->m_rumah_sakit->tambah($data);
            if ($cek) {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Rumah Sakit Baru dengan Nama.".$this->input->post('nama_rumah_sakit')."</strong>&nbsp; Berhasil di tambah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('rumah_sakit/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di tambah..
    </div>"

                        );

                    redirect('rumah_sakit/tambah_rumah_sakit');
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
                    redirect('rumah_sakit/tambah_rumah_sakit');
        }


  }

}// tutup

    



    public function edit_rumah_sakit()

    {
     
 $id = $this->uri->segment(3); $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."rumah_sakit",
            "Edit Rumah Sakit"  => base_url()."edit_rumah_sakit",
             "Edit Rumah Sakit"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/edit_rumah_sakit';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['berita'] =    $this->berita_model->get_db();
        $data   ['edit'] =    $this->db->get_where('info_rumah_sakit', array('id_rumah_sakit' =>$id))->row();

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }


public function proses_update_rumah_sakit()
{ // buka
 
    $this->form_validation->set_rules('nama_rumah_sakit', 'Nama Rumah Sakit', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('latitude', 'Kordinal Latitude X', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('longitude', 'Kordinal Longitude Y', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('ket_rumah_sakit', 'Keterangan Rumah Sakit', 'trim|required|min_length[5]');

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_rumah_sakit();
  }
  else
  {

   

if (empty($_FILES['imagefile']['name'])) {
 
 $where       = $this->input->post('id_rumah_sakit');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');

        $judulberita      = $this->input->post('judulberita');

    $nama_rumah_sakit      = $this->input->post('nama_rumah_sakit');
    $ket_rumah_sakit  = $this->input->post('ket_rumah_sakit');
        $lat_rs  =    $this->input->post('latitude');  
          $long_rs  =    $this->input->post('longitude');  
   $data = array(
      
                    'idberita'      => $judulberita,
                    'nama_rs'       =>    $nama_rumah_sakit,
                    'ket_rs'   =>    $ket_rumah_sakit,
    
                  'lat_rs'        =>  $lat_rs,
                  'long_rs'        =>  $long_rs

                           );
     

           $this->db->where('id_rumah_sakit',$where);
      $this->db->update('info_rumah_sakit', $data);
      if ($this->db->affected_rows()) 
      {

                  

                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Rumah Sakit dengan Nama.".$this->input->post('nama_rumah_sakit')."</strong>&nbsp; Berhasil di Ubah dan Gambar tidak Di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('rumah_sakit/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Data Gagal di Ubah, Silahkan Mengubah sala-satu data..* Jika tidak di Ubah Silahkan Kembali dengan Mengklik tombol <b>Kembali</b>
    </div>"

                        );

                    redirect('rumah_sakit/edit_rumah_sakit/'.$_POST['id_rumah_sakit']);
            }
            
    

}
else
{


 $where       = $this->input->post('id_rumah_sakit');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');




   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/rumah_sakit/gambarbesar/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
  $thumb_src="asset/upload/rumah_sakit/gambarkecil/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          
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
                    redirect('rumah_sakit/edit_rumah_sakit/'.$_POST['id_rumah_sakit']);
        }
        
 $where       = $this->input->post('id_rumah_sakit');

$judulberita = $this->input->post('judulberita');
    $nama_rumah_sakit      = $this->input->post('nama_rumah_sakit');
    $ket_rumah_sakit  = $this->input->post('ket_rumah_sakit');
        $lat_rs  =    $this->input->post('latitude');  
          $long_rs  =    $this->input->post('longitude');  
   $data = array(
                    'idberita'       =>  $judulberita,
                    'nama_rs'       =>    $nama_rumah_sakit,
                    'ket_rs'   =>    $ket_rumah_sakit,
    
                     'gambar_besar_rs'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'gambar_kecil_rs'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'lat_rs'        =>  $lat_rs,
                  'long_rs'        =>  $long_rs

                           );

     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');
                   $this->db->where('id_rumah_sakit',$where);
      $this->db->update('info_rumah_sakit', $data);
      if ($this->db->affected_rows()) 
      {

              unlink('asset/upload/rumah_sakit/gambarkecil/'.$gkecil);
            unlink('asset/upload/rumah_sakit/gambarbesar/'.$gbesar);


                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Rumah Sakit dengan Nama.".$this->input->post('nama_rumah_sakit')."</strong>&nbsp; 
      Berhasil di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('rumah_sakit/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di Ubah..
    </div>"

                        );

                    redirect('rumah_sakit/edit_rumah_sakit');
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
                    redirect('rumah_sakit/edit_rumah_sakit');
        }

}

  }

}// tutup

        




public function hapus($id)
{
 
          $data = $this->db->get_where('info_rumah_sakit', array('id_rumah_sakit' => $id))->row();


      $this->m_rumah_sakit->hapus($id);
            if ($this->db->affected_rows())
         {
    



                 unlink('asset/upload/rumah_sakit/gambarkecil/'.$data->gambar_kecil_rs);
            unlink('asset/upload/rumah_sakit/gambarbesar/'.$data->gambar_besar_rs);

               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Rumah Sakit, ".$data->nama_rumah_sakit."</strong>&nbsp; Berhasil di Hapus..
    </div>"

                        );
              redirect('rumah_sakit/index');
         }
         else
         {

           $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Maaf Data Rumah Sakit ".$data->nama_rumah_sakit."</strong>&nbsp; Gagal di Hapus..
    </div>"

                        );
                         redirect('rumah_sakit/index');


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