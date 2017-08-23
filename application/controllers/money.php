<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Money extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->is_logged_in();
        
        $this->load->model('m_money');


    }

    public function index()

    {
 
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."money",
            "Money Changger"  => base_url()."money",
            "Money Changger"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/v_money';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['tampil'] =    $this->m_money->join_berita_money();
        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }




    public function tambah_money()

    {
       
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."money",
            "Money Changger"  => base_url()."money",
             "Tambah Money Changger"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/tambah_money';
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


   



public function proses_tambah_money()
{ // buka
 
 $this->form_validation->set_rules('nama_money', 'Nama Tempat Money Changger', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('latitude', 'Kordinal Latitude X', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('longitude', 'Kordinal Longitude Y', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('ket_money', 'Keterangan Tempat Money Changger', 'trim|required|min_length[5]');

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_money();
  }
  else
  {



   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/money/gambarbesar/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
  $thumb_src="asset/upload/money/gambarkecil/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          
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
                    redirect('money/tambah_money');
        }
        

        $judulberita  = $this->input->post('judulberita');
    $nama_money      = $this->input->post('nama_money');
    $ket_money  = $this->input->post('ket_money');
      $nama_lengkap  =    $this->input->post('nama_lengkap');  
        $lat_money  =    $this->input->post('latitude');  
          $long_money  =    $this->input->post('longitude');  
   $data = array(
                    'id_money'       =>  '',
                    'idberita'       => $judulberita, 
                    'nama_money'       =>    $nama_money,
                    'ket_money'   =>    $ket_money,
    
                     'gambar_besar_money'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'gambar_kecil_money'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'lat_money'        =>  $lat_money,
                  'long_money'        =>  $long_money

                           );

        $periksa_data     =    $this->m_money->cek_money($nama_money);
        $lat_money        =    $this->m_money->cek_lat($lat_money);
        $long_money       =    $this->m_money->cek_long($long_money);
      
       

        if ($periksa_data->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Data Tempat Money Changger. ".$nama_money."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Nama Tempat Money Changger Yang lain..
    </div>"

                        );
            redirect('money/tambah_money');
        } 


        elseif ($lat_money->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Kordinat ". $this->input->post('latitude')  ."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Kordinat Yang lain..
    </div>"

                        );
            redirect('money/tambah_money');
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
            redirect('money/tambah_money');
        } 

    


        else {
           

            $cek =   $this->m_money->tambah($data);
            if ($cek) {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Tempat Money Changger Baru dengan Nama. ".$this->input->post('nama_money')."</strong>&nbsp; Berhasil di tambah ..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('money/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di tambah..
    </div>"

                        );

                    redirect('money/tambah_money');
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
                    redirect('money/tambah_money');
        }


  }

}// tutup

    



    public function edit_money()

    {
     
 $id = $this->uri->segment(3); $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."money",
            "Money"  => base_url()."money",
             "Edit Money"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/edit_money';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
               $data   ['berita'] =    $this->berita_model->get_db();
        $data   ['edit'] =    $this->db->get_where('money_ch', array('id_money' =>$id))->row();

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }


public function proses_update_money()
{ // buka
 
 $this->form_validation->set_rules('nama_money', 'Nama Tempat Money Changger', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('latitude', 'Kordinal Latitude X', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('longitude', 'Kordinal Longitude Y', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('ket_money', 'Keterangan Tempat Money Changger', 'trim|required|min_length[5]');

  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_money();
  }
  else
  {

   

if (empty($_FILES['imagefile']['name'])) {
 
 $where       = $this->input->post('id_money');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');

   
            $judulberita  = $this->input->post('judulberita');

    $nama_money      = $this->input->post('nama_money');
    $ket_money  = $this->input->post('ket_money');
      $nama_lengkap  =    $this->input->post('nama_lengkap');  
        $lat_money  =    $this->input->post('latitude');  
          $long_money  =    $this->input->post('longitude');  
   $data = array(

                    'idberita'        => $judulberita,
                    'nama_money'       =>    $nama_money,
                    'ket_money'   =>    $ket_money,
    
                     'lat_money'        =>  $lat_money,
                  'long_money'        =>  $long_money

                           );

     

           $this->db->where('id_money',$where);
      $this->db->update('money_ch', $data);
      if ($this->db->affected_rows()) 
      {

                  

                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Tempat Money Changger dengan Nama. ".$this->input->post('nama_money')."</strong>&nbsp; Berhasil di Ubah dan Gambar tidak Di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('money/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Data Gagal di Ubah, Silahkan Mengubah sala-satu data..* Jika tidak di Ubah Silahkan Kembali dengan Mengklik tombol <b>Kembali</b>
    </div>"

                        );

                    redirect('money/edit_money/'.$_POST['id_money']);
            }
            
    

}
else
{


 $where       = $this->input->post('id_money');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');




   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/money/gambarbesar/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
  $thumb_src="asset/upload/money/gambarkecil/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          
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
        
 $where       = $this->input->post('id_money');

    
   
        $judulberita  = $this->input->post('judulberita');

    $nama_money      = $this->input->post('nama_money');
    $ket_money  = $this->input->post('ket_money');
      $nama_lengkap  =    $this->input->post('nama_lengkap');  
        $lat_money  =    $this->input->post('latitude');  
          $long_money  =    $this->input->post('longitude');  
   $data = array(
                   
                    'idberita'      => $judulberita,
                    'nama_money'       =>    $nama_money,
                    'ket_money'   =>    $ket_money,
    
                     'gambar_besar_money'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'gambar_kecil_money'  =>     strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'lat_money'        =>  $lat_money,
                  'long_money'        =>  $long_money

                           );

     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');

                   $this->db->where('id_money',$where);
      $this->db->update('money_ch', $data);
      if ($this->db->affected_rows()) 
      {

              unlink('asset/upload/money/gambarkecil/'.$gkecil);
            unlink('asset/upload/money/gambarbesar/'.$gbesar);


                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Tempat Money Changger dengan Nama. ".$this->input->post('nama_money')."</strong>&nbsp; Berhasil di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('money/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di Ubah..
    </div>"

                        );

                    redirect('money/edit_money');
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
                    redirect('money/edit_money');
        }

}

  }

}// tutup

        




public function hapus($id)
{
 
          $data = $this->db->get_where('money_ch', array('id_money' => $id))->row();


      $this->m_money->hapus($id);
            if ($this->db->affected_rows())
         {
    



                 unlink('asset/upload/money/gambarkecil/'.$data->gambar_kecil_money);
            unlink('asset/upload/money/gambarbesar/'.$data->gambar_besar_money);

               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Tempat Money Changger dengan nama , ".$data->nama_money."</strong>&nbsp; Berhasil di Hapus..
    </div>"

                        );
              redirect('money/index');
         }
         else
         {

           $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Maaf Data Tempat Money Changger ".$data->nama_money."</strong>&nbsp; Gagal di Hapus..
    </div>"

                        );
                         redirect('money/index');


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