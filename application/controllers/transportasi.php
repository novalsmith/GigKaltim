<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transportasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->is_logged_in();
        
        $this->load->model('m_transportasi');


    }

    public function index()

    {
 
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."transportasi",
            "Transportasi"  => base_url()."transportasi",
             "Transportasi"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/v_transportasi';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['tampil'] =    $this->m_transportasi->join_trans();
        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }




    public function tambah_transportasi()

    {
       
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."transportasi",
            "Tambah Transportasi"  => base_url()."tambah_transportasi",
             "Tambah Transportasi"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/tambah_transportasi';
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


   



public function proses_tambah_transportasi()
{ // buka
 
 $this->form_validation->set_rules('nama_transportasi', 'Nama transportasi', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('latitude', 'Kordinal Latitude X', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('longitude', 'Kordinal Longitude Y', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('ket_transportasi', 'Keterangan transportasi', 'trim|required|min_length[5]');

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_transportasi();
  }
  else
  {



   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/transport/gambarbesar/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
  $thumb_src="asset/upload/transport/gambarkecil/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          
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
        

        $judulberita = $this->input->post('judulberita');
    $nama_transportasi      = $this->input->post('nama_transportasi');
    $keterangan_transportasi  = $this->input->post('ket_transportasi');
        $lat_transportasi  =    $this->input->post('latitude');  
          $long_transportasi  =    $this->input->post('longitude');  
   $data = array(
                    'id_transport'       =>  '',
                    'idberita'           => $judulberita,
                    'nama_transport'       =>    $nama_transportasi,
                    'ket_transport'   =>    $keterangan_transportasi,
    
                     'gambar_besar_t'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'gambar_kecil_t'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'lat_transport'        =>  $lat_transportasi,
                  'long_transport'        =>  $long_transportasi

                           );

        $periksa_data     =    $this->m_transportasi->cek_nama_transportasi($nama_transportasi);
        $lat_transportasi1       =    $this->m_transportasi->cek_lat($lat_transportasi);
        $long_transportasi2      =    $this->m_transportasi->cek_long($long_transportasi);
      
       

        if ($periksa_data->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Data Transportasi. ".$nama_transportasi."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Nama Transportasi Yang lain..
    </div>"

                        );
            redirect('transportasi/tambah_transportasi');
        } 


        elseif ($lat_transportasi1->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Kordinat ". $this->input->post('latitude')  ."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Kordinat Yang lain..
    </div>"

                        );
            redirect('transportasi/tambah_transportasi');
        } 

               elseif ($long_transportasi2->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Kordinat ".$this->input->post('longitude')  ."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Kordinat yang lain..
    </div>"

                        );
            redirect('transportasi/tambah_transportasi');
        } 

    


        else {
           

            $cek =   $this->m_transportasi->tambah($data);
            if ($cek) {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Transportasi Baru dengan Nama.".$this->input->post('nama_transportasi')."</strong>&nbsp; Berhasil di tambah .
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('transportasi/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di tambah..
    </div>"

                        );

                    redirect('transportasi/tambah_transportasi');
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
                    redirect('transportasi/tambah_transportasi/'.$_POST['id_transportasi']);
        }


  }

}// tutup

    



    public function edit_transportasi()

    {
     
 $id = $this->uri->segment(3); $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."transportasi",
            "Edit Transportasi"  => base_url()."edit_transportasi",
             "Edit Transportasi"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/edit_transportasi';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['berita'] =    $this->berita_model->get_db();
        $data   ['edit'] =    $this->db->get_where('transportasi', array('id_transport' =>$id))->row();

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }


public function proses_update_transportasi()
{ // buka
 
    $this->form_validation->set_rules('nama_transportasi', 'Nama transportasi', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('latitude', 'Kordinal Latitude X', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('longitude', 'Kordinal Longitude Y', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('ket_transportasi', 'Keterangan transportasi', 'trim|required|min_length[5]');

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_transportasi();
  }
  else
  {

   

if (empty($_FILES['imagefile']['name'])) {
 
 $where       = $this->input->post('id_transportasi');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');

        $judulberita = $this->input->post('judulberita');

    $nama_transportasi      = $this->input->post('nama_transportasi');
    $keterangan_transportasi  = $this->input->post('ket_transportasi');
        $lat_transportasi  =    $this->input->post('latitude');  
          $long_transportasi  =    $this->input->post('longitude');  
   $data = array(
                    'idberita'             => $judulberita,
                    'nama_transport'       =>    $nama_transportasi,
                    'ket_transport'   =>    $keterangan_transportasi,
    
                  'lat_transport'        =>  $lat_transportasi,
                  'long_transport'        =>  $long_transportasi

                           );
     

           $this->db->where('id_transport',$where);
      $this->db->update('transportasi', $data);
      if ($this->db->affected_rows()) 
      {

                  

                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> transportasi dengan Nama.".$this->input->post('nama_transportasi')."</strong>&nbsp; Berhasil di Ubah dan Gambar tidak Di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('transportasi/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Data Gagal di Ubah, Silahkan Mengubah sala-satu data..* Jika tidak di Ubah Silahkan Kembali dengan Mengklik tombol <b>Kembali</b>
    </div>"

                        );

                    redirect('transportasi/edit_transportasi/'.$_POST['id_transportasi']);
            }
            
    

}
else
{


 $where       = $this->input->post('id_transportasi');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');




   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/transport/gambarbesar/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
  $thumb_src="asset/upload/transport/gambarkecil/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          
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
                    redirect('transportasi/edit_transportasil/'.$_POST['id_transportasi']);
        }
        
 $where       = $this->input->post('id_transportasi');

    
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');



            $judulberita = $this->input->post('judulberita');

     $nama_transportasi      = $this->input->post('nama_transportasi');
    $keterangan_transportasi  = $this->input->post('ket_transportasi');
        $lat_transportasi  =    $this->input->post('latitude');  
          $long_transportasi  =    $this->input->post('longitude');  
   $data = array(
              
              'idberita'                =>  $judulberita,
                    'nama_transport'       =>    $nama_transportasi,
                    'ket_transport'   =>    $keterangan_transportasi,
                'gambar_besar_t'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'gambar_kecil_t'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'lat_transport'        =>  $lat_transportasi,
                  'long_transport'        =>  $long_transportasi

                           );
     

                   $this->db->where('id_transport',$where);
      $this->db->update('transportasi', $data);
      if ($this->db->affected_rows()) 
      {

              unlink('asset/upload/transport/gambarkecil/'.$gkecil);
            unlink('asset/upload/transport/gambarbesar/'.$gbesar);


                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> transportasi dengan Nama.".$this->input->post('nama_transportasi')."</strong>&nbsp; Berhasil di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('transportasi/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di Ubah..
    </div>"

                        );

                    redirect('transportasi/edit_transportasi');
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
                    redirect('transportasi/edit_transportasi/'.$_POST['id_transportasi']);
        }

}

  }

}// tutup

        




public function hapus($id)
{
 
          $data = $this->db->get_where('transportasi', array('id_transport' => $id))->row();


      $this->m_transportasi->hapus($id);
            if ($this->db->affected_rows())
         {
    



                 unlink('asset/upload/transport/gambarkecil/'.$data->gambar_kecil_t);
            unlink('asset/upload/transport/gambarbesar/'.$data->gambar_besar_t);

               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Transportasi, ".$data->nama_transport."</strong>&nbsp; Berhasil di Hapus..
    </div>"

                        );
              redirect('transportasi/index');
         }
         else
         {

           $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Maaf Data Transportasi ".$data->nama_transportasi."</strong>&nbsp; Gagal di Hapus..
    </div>"

                        );
                         redirect('transportasi/index');


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