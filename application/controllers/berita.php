<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('m_category');
        $this->load->model('m_hotel');

    }

    public function index()

    {
        $id = $this->uri->segment(3);
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Artikel Wisata"  => base_url()."berita",
            "Tempat Wisata"  => base_url()."berita",
             "Tempat Wisata"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/berita';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['tampil'] =    $this->berita_model->tampil();
           $data["nohari"]         =date('w');
  $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }

   
    public function tambah_berita()

    {
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Artikel Wisata"  => base_url()."berita",
            "Tempat Wisata"  => base_url()."berita",
             "Tambah Tempat Wisata"  => base_url()."berita/tambah_berita",
             "Tambah Tempat Wisata" => ""


        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/tambah_berita';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['tampil_category'] =    $this->m_category->tampil();
        $data   ['tampil_hotel']    =    $this->m_hotel->tampil();

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);



        $this->load->view('template_web',$data);
    }


   

public function proses_tambah()
  {
            
               

          if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/berita/gambarbesar/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }

          $thumb_src="asset/upload/berita/gambarkecil/".strtolower( str_replace('','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          
          $n_width = 300;
          $n_height = 400;
        
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
          }

         // file yang di post dari form

          $berita_baru =  $this->input->post('judul');
          $data = array(
                  'idberita'    =>    $this->input->post('idberita'),
                  'waktu'     =>    $this->input->post('waktu'),
                  'idkategori'    =>    $this->input->post('idkategori'),
                  'judulberita'   =>    $this->input->post('judul'),
                  'isiberita'   =>    $this->input->post('isi'),
                  'gambar_besar'  =>     strtolower($_FILES['imagefile']['name']),
                  'gambar_kecil'  =>     strtolower($_FILES['imagefile']['name']),
                  'status'   =>    $this->input->post('status'),
                  'status_popular'  => $this->input->post('popular'),
                  'lat_wisata' => $this->input->post('latitude'),
                  'long_wisata' => $this->input->post('longitude')
                   
                );  

            // file yang di post dari form


        $periksa = $this->berita_model->cek_berita($berita_baru);

        if ($periksa->num_rows()>0) {
          
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong> Oopss,.".$berita_baru."</strong>&nbsp; Sudah Ada, silahkan coba dengan Judul Artikel yang lain..
    </div>"

                        );
             redirect('berita/tambah_berita');

        } else {
         

          
          $this->berita_model->get_insert($data);
          $this->session->set_flashdata('message', 

            "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong> <i class='icon icon-ok'></i>  ".$this->input->post('judul')."</strong> Berhasil di Simpan.
    </div>"

            );
          redirect('berita'); 
}
        }else

        {
      $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss..!!</strong>&nbsp; File yang di terima Hanya Gambar dengan type JPG/JPEG/PNG/GIF. Coba Lagi.
    </div>"

                        );
        }
  
}
    



  public function edit_berita()

    {
      $id = $this->uri->segment(3);
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Artikel Berita"  => base_url()."berita",
            "Artikel"  => base_url()."penduduk",
             "Edit Artikel Berita"  => base_url()."berita/edit_berita",
             "Edit Artikel Berita" => ""

        );

        $data   ['posisi']       =   $posisi;
        $data   ['content']      =   'admin/edit_berita';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
        $data   ['tampil']       =    $this->berita_model->tampil_status();

        $data   ['edit']         = $this->db->get_where('berita', array('idberita' => $id))->row();
        $data   ['tampil_category'] =    $this->m_category->tampil();
        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }


public function proses_edit()
  {

    $idber = $this->input->post('idberita');
    $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');

    if(empty($_FILES['imagefile']['name']))
        {
          

    $data1 = array(
                  'idberita'    =>    $this->input->post('idberita'),
                  'waktu'     =>    $this->input->post('waktu'),
                  'idkategori'    =>    $this->input->post('idkategori'),
                  'judulberita'   =>    $this->input->post('judul'),
                  'isiberita'   =>    $this->input->post('isi'),
                  'status'      =>  $this->input->post('status'),
                   'status_popular'  => $this->input->post('popular'),
                   'lat_wisata' => $this->input->post('latitude'),
                  'long_wisata' => $this->input->post('longitude')

                   
                );  

        // file yang di post dari form
        $this->db->where('idberita',$idber);
      $this->db->update('berita', $data1);
      if ($this->db->affected_rows()) 
      {
        
      $this->session->set_flashdata('message', 

              "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> ".$this->input->post('judul')."</strong> Berhasil dan Gambar tidak di Ubah.
    </div>"

        );
      redirect('berita'); 
      }


  }
        else
        {
           
          
          if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))


        {
          $ori_src="asset/upload/berita/gambarbesar/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }

          $thumb_src="asset/upload/berita/gambarkecil/".strtolower( str_replace('_','_','sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']) );
          
          $n_width = 150;
          $n_height = 150;
        
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
          }

          // file yang di post dari form
          $data = array(
                  'idberita'    =>    $this->input->post('idberita'),
                  'waktu'     =>    $this->input->post('waktu'),
                  'idkategori'    =>    $this->input->post('idkategori'),
                  'judulberita'   =>    $this->input->post('judul'),
                  'isiberita'   =>    $this->input->post('isi'),
                  'gambar_besar'  =>   strtolower('sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                  'gambar_kecil'  =>  strtolower( 'sig-kaltim-'.date('h-i-s-d-m-y').'-'.$_FILES['imagefile']['name']),
                   'status'      =>  $this->input->post('status'),
                    'status_popular'  => $this->input->post('popular'),
                    'lat_wisata' => $this->input->post('latitude'),
                  'long_wisata' => $this->input->post('longitude')

                   
                );  
          // file yang di post dari form
        $this->db->where('idberita',$idber);
      $this->db->update('berita', $data);
      if ($this->db->affected_rows()) 
      {
  
                  unlink('asset/upload/berita/gambarkecil/'.$gkecil);
            unlink('asset/upload/berita/gambarbesar/'.$gbesar);
      $this->session->set_flashdata('message',

              "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i>  ".$this->input->post('judul')."</strong> Berhasil di Simpan.
    </div>"
       );
      redirect('berita'); 
      }

        }else

        {
      $this->session->set_flashdata('message', 
                "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>File Yang di terima Hanyalah Gambar</strong> 
    </div>"
        );
        }
      }
    }
    
  
                 
        


public function hapus($id)
{
 
          $data = $this->db->get_where('berita', array('idberita' => $id))->row();


      $this->berita_model->hapus($id);
            if ($this->db->affected_rows())
         {
    



                 unlink('asset/upload/berita/gambarkecil/'.$data->gambar_kecil);
            unlink('asset/upload/berita/gambarbesar/'.$data->gambar_besar);

               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Data</strong>&nbsp; Berhasil di Hapus..
    </div>"

                        );
              redirect('berita/index');
         }
         else
         {

           $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Maaf Data</strong>&nbsp; Gagal di Hapus..
    </div>"

                        );
                         redirect('berita/index');


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