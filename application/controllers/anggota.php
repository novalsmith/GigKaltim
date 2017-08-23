<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anggota extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('m_anggota');
        $this->load->model('m_kartu');

    }

    public function index()

    {
        $id = $this->uri->segment(3);
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Data Penting"  => base_url()."anggota",
            "Anggota Ikmasor"  => base_url()."anggota",
             "Anggota Ikmasor"  => ""

        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/anggota';
        $data   ['title']   =   'Selamat Datang di web admin Desa Sajen';
        $data   ['brand'] =     'IKMASOR SBY';
        $data   ['tampil'] =    $this->m_anggota->tampil();
        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web',$data);
    }

    public function detail_anggota($id)

    {
        $id = $this->uri->segment(3);
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
              "Data Penting"  => base_url()."anggota",
            "Anggota Ikmasor"  => base_url()."anggota",
             "Anggota Detail"  => base_url()."anggota/detail_anggota",
            "Anggota Detail"  => "",


        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/detail_anggota';
        $data   ['title']   =   'Selamat Datang di web admin Desa Sajen';
        $data   ['brand'] =     'IKMASOR SBY';
        $data   ['detail'] =    $this->m_anggota->detail($id)->row();
        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);

        $this->load->view('template_web',$data);
    }


// Kartu Anggota
   public function kartu_anggota()

    {
        $id = $this->uri->segment(3);
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
              "Data Penting"  => base_url()."anggota",
            "Anggota Ikmasor"  => base_url()."anggota",
             "Kartu Anggota"  => base_url()."anggota/kartu_anggota",
            "Kartu Anggota"  => "",


        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/kartu_anggota';
        $data   ['title']   =   'Selamat Datang di web admin Desa Sajen';
        $data   ['brand'] =     'IKMASOR SBY';
        $data['cetak_kartu'] = $this->db->get_where('anggota', array('id_anggota' => $id))->row();


        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);

        $this->load->view('template_web',$data);
    }

// Kartu Anggota

    public function tambah_anggota()

    {
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
           "Data Penting"  => base_url()."anggota",
           "Anggota Ikmasor"  => base_url()."anggota",
             "Tambah Data Anggota"  => base_url()."anggota/tambah_anggota",
             "Tambah Data Anggota" => ""
             


        );

        $data   ['posisi']  =   $posisi;
        $data   ['content'] =   'admin/tambah_anggota';
        $data   ['title']   =   'Selamat Datang di web admin Desa Sajen';
       $data   ['brand'] =     'IKMASOR SBY';
       // $data   ['tampil'] =    $this->m_penduduk->detail();
       //  $data   ['tampil_nomor'] =    $this->m_nomor_kk->tampil();
       $data   ['tampil']    =   $this->m_anggota->nomor_anggota()->row();

   $data["nohari"]         =date('w');
  $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);





        $this->load->view('template_web',$data);
    }


   



public function proses_tambah_anggota()
{ // buka
 
 $this->form_validation->set_rules('nama_panggilan', 'Nama Panggilan', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('kota_asal', 'Kota Asal', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('tlp', 'Nomor Telepon', 'trim|required|min_length[10]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('kampus', 'Kampus', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('angkatan', 'Angkatan', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('agama', 'Agama', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('alamat_kelurahan', 'Alamat Kelurahan', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('status', 'Status Anggota', 'trim|required|min_length[2]|max_length[30]|xss_clean');


  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_anggota();
  }
  else
  {



   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/anggota/gambarbesar/".strtolower( str_replace(' ','_',$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
  $thumb_src="asset/upload/anggota/gambarkecil/".strtolower( str_replace(' ','_',$_FILES['imagefile']['name']) );
          
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
          }else

        {
  $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Hannya Gambar saja..
    </div>"

                        );
                    redirect('anggota/tambah_anggota');
        }
        


    $no_anggota      = $this->input->post('angkatan').$this->input->post('no_anggota');
    $nama_panggilan  = $this->input->post('nama_panggilan');
      $nama_lengkap  =    $this->input->post('nama_lengkap');  
        $email  =    $this->input->post('email');  
          $tlp  =    $this->input->post('tlp');  
   $data = array(
                    'id_anggota'       =>  '',
                    'no_anggota'       =>    $no_anggota,
                    'nama_panggilan'   =>    $nama_panggilan,
                    'nama_lengkap'     =>      $nama_lengkap ,
                    'kota_asal'        =>  $this->input->post('kota_asal'),
                    'alamat_kelurahan'             =>  $this->input->post('alamat_kelurahan'),
                    'email'                        =>  $this->input->post('email'),
                    'tlp'       =>  $this->input->post('tlp'),
                    'jurusan'        =>  $this->input->post('jurusan'),
                    'kampus'         =>  $this->input->post('kampus'),
                    'angkatan'               =>  $this->input->post('angkatan'),
                     'agama'             =>  $this->input->post('agama'),
                     'gambar_besar'  =>     strtolower($_FILES['imagefile']['name']),
                  'gambar_kecil'  =>     strtolower($_FILES['imagefile']['name']),
                  'status'        =>  $this->input->post('status')

                           );

        $periksa_data = $this->m_anggota->cek_data($nama_panggilan,$nama_lengkap);
        $nama_lengkap = $this->m_anggota->cek_namalengkap($nama_lengkap);
        $email        = $this->m_anggota->cek_email($email);
        $tlp          = $this->m_anggota->cek_notlp($tlp);

       

        if ($periksa_data->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Anggota dengan Nama Panggilan. ".$nama_panggilan.' dan Nama Lengkap '.$nama_lengkap."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Nama Yang lain..
    </div>"

                        );
            redirect('anggota/tambah_anggota');
        } 


        elseif ($nama_lengkap->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Anggota Nama Lengkap ".$nama_lengkap."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Nama Yang lain..
    </div>"

                        );
            redirect('anggota/tambah_anggota');
        } 

               elseif ($email->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Email ".$email."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Nama Yang lain..
    </div>"

                        );
            redirect('anggota/tambah_anggota');
        } 

       elseif ($tlp->num_rows()>0) 
        {
            $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-remove'>
      </i> Oopss, Nomor Telepon ".$tlp."</strong>&nbsp;
       ini sudah di gunakan, Silahkan Ulangi dengan Nama Yang lain..
    </div>"

                        );
          
            redirect('anggota/tambah_anggota');
        } 



        else {
           

            $cek =   $this->m_anggota->tambah($data);
            if ($cek) {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Anggota Baru dengan Nama.".$this->input->post('nama_lengkap')."</strong>&nbsp; Berhasil di tambah - Silahkan Cek Email Konfirmasi dari IKMASOR..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('anggota/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di tambah..
    </div>"

                        );

                    redirect('anggota/tambah_anggota');
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
                    redirect('anggota/tambah_anggota');
        }


  }

}// tutup

    



  






  public function edit_anggota()

    {
     
 $id = $this->uri->segment(3);
         $posisi = array(
            "Dashboard"     => base_url()."home",
    
           "Data Penting"  => base_url()."anggota",
           "Anggota Ikmasor"  => base_url()."anggota",
             "Edit Data Anggota"  => base_url()."anggota/edit_anggota",
             "Edit Data Anggota" => ""

        );

        $data   ['posisi']       =   $posisi;
        $data   ['content']      =   'admin/edit_anggota';
        $data   ['title']        =   'Selamat Datang di web admin Desa Sajen';
         $data   ['brand'] =     'IKMASOR SBY';
              $data   ['tampil']    =   $this->m_anggota->nomor_anggota()->row();

        $data   ['edit']         = $this->db->get_where('anggota', array('id_anggota' => $id))->row();
   $data["nohari"]         =date('w');
  $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);




        $this->load->view('template_web',$data);
    }


public function proses_update_anggota()
{ // buka
 
    $this->form_validation->set_rules('nama_panggilan', 'Nama Panggilan', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('kota_asal', 'Kota Asal', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('tlp', 'Nomor Telepon', 'trim|required|min_length[10]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('kampus', 'Kampus', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required|min_length[5]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('angkatan', 'Angkatan', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('agama', 'Agama', 'trim|required|min_length[2]|max_length[30]|xss_clean');
    $this->form_validation->set_rules('alamat_kelurahan', 'Alamat Kelurahan', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('status', 'Status Anggota', 'trim|required|min_length[2]|max_length[30]|xss_clean');


  if ($this->form_validation->run()==FALSE) { // pengecekan validasi data

           $this->tambah_anggota();
  }
  else
  {

   

if (empty($_FILES['imagefile']['name'])) {
 
 $where       = $this->input->post('id_anggota');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');

    $no_anggota      = $this->input->post('no_anggota');
    $nama_panggilan  = $this->input->post('nama_panggilan');
      $nama_lengkap  =    $this->input->post('nama_lengkap');  
        $email  =    $this->input->post('email');  
          $tlp  =    $this->input->post('tlp');  
   $data = array(
                   
                    'no_anggota'       =>  $no_anggota,
                    'nama_panggilan'   =>  $nama_panggilan,
                    'nama_lengkap'     =>  $nama_lengkap ,
                    'kota_asal'        =>  $this->input->post('kota_asal'),
                    'alamat_kelurahan' =>  $this->input->post('alamat_kelurahan'),
                    'email'            =>  $this->input->post('email'),
                    'tlp'              =>  $this->input->post('tlp'),
                    'jurusan'          =>  $this->input->post('jurusan'),
                    'kampus'           =>  $this->input->post('kampus'),
                    'angkatan'         =>  $this->input->post('angkatan'),
                     'agama'           =>  $this->input->post('agama'),
                     'status'          =>  $this->input->post('status')

                           );

     

           $this->db->where('id_anggota',$where);
      $this->db->update('anggota', $data);
      if ($this->db->affected_rows()) 
      {

                  

                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Anggota dengan Nama.".$this->input->post('nama_lengkap')."</strong>&nbsp; Berhasil di Ubah dan Gambar tidak Di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('anggota/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Data Gagal di Ubah, Silahkan Mengubah sala-satu data..* Jika tidak di Ubah Silahkan Kembali dengan Mengklik tombol <b>Kembali</b>
    </div>"

                        );

                    redirect('anggota/edit_anggota/'.$_POST['id_anggota']);
            }
            
    

}
else
{


 $where       = $this->input->post('id_anggota');
     $gbesar = $this->input->post('g_besar');
    $gkecil = $this->input->post('g_kecil');




   if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))

        {
          $ori_src="asset/upload/anggota/gambarbesar/".strtolower( str_replace(' ','_',$_FILES['imagefile']['name']) );
          if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
          {
            chmod("$ori_src",0777);
          }else{
            echo "Gagal melakukan proses upload file.";
            exit;
          }
        
  $thumb_src="asset/upload/anggota/gambarkecil/".strtolower( str_replace(' ','_',$_FILES['imagefile']['name']) );
          
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
          }else

        {
  $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Hannya Gambar saja..
    </div>"

                        );
                    redirect('anggota/edit_anggota/'.$_POST['id_anggota']);
        }
        
 $where       = $this->input->post('id_anggota');

    
    $no_anggota      = $this->input->post('no_anggota');
    $nama_panggilan  = $this->input->post('nama_panggilan');
      $nama_lengkap  =    $this->input->post('nama_lengkap');  
        $email  =    $this->input->post('email');  
          $tlp  =    $this->input->post('tlp');  
   $data = array(
                   
                    'no_anggota'       =>    $no_anggota,
                    'nama_panggilan'   =>    $nama_panggilan,
                    'nama_lengkap'     =>      $nama_lengkap ,
                    'kota_asal'        =>  $this->input->post('kota_asal'),
                    'alamat_kelurahan'             =>  $this->input->post('alamat_kelurahan'),
                    'email'                        =>  $this->input->post('email'),
                    'tlp'       =>  $this->input->post('tlp'),
                    'jurusan'        =>  $this->input->post('jurusan'),
                    'kampus'         =>  $this->input->post('kampus'),
                    'angkatan'               =>  $this->input->post('angkatan'),
                     'agama'             =>  $this->input->post('agama'),
                     'gambar_besar'  =>     strtolower($_FILES['imagefile']['name']),
                  'gambar_kecil'  =>     strtolower($_FILES['imagefile']['name']),
                  'status'        =>  $this->input->post('status')

                           );


                   $this->db->where('id_anggota',$where);
      $this->db->update('anggota', $data);
      if ($this->db->affected_rows()) 
      {

              unlink('asset/upload/anggota/gambarkecil/'.$gkecil);
            unlink('asset/upload/anggota/gambarbesar/'.$gbesar);


                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Anggota dengan Nama.".$this->input->post('nama_lengkap')."</strong>&nbsp; Berhasil di Ubah..
    </div>" );

// BUka Kirim Ke Email
   
 // tutup Kirim Ke Email

                    redirect('anggota/index');
            } else {
                 $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Oopss</strong>&nbsp; Gagal di Ubah..
    </div>"

                        );

                    redirect('anggota/edit_anggota');
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
                    redirect('anggota/edit_anggota');
        }

}

  }

}// tutup

        



// Cetak Kartu Anggota
public function cetak_kartu_anggota()
{

   $id = $this->uri->segment(3);

  //load llibrary fpdf
    $data['cetak_kartu'] = $this->db->get_where('anggota', array('id_anggota' => $id))->row();
    $cetak_kartu= $this->db->get_where('anggota', array('id_anggota' => $id))->row();

    
    ob_start();
    $content = $this->load->view('admin/kartu_anggota',$data);
    $content = ob_get_clean();    
    $this->load->library('html2pdf');
    try
    {
       $html2pdf = new HTML2PDF('P','A4','fr');
      
      $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
      $html2pdf->Output($cetak_kartu->nama_lengkap.'-'.date('H-i-d-m-Y').'.pdf');
    }
    catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
    }
    
}


public function hapus($id)
{
 
          $data = $this->db->get_where('anggota', array('id_anggota' => $id))->row();


      $this->m_anggota->hapus($id);
            if ($this->db->affected_rows())
         {
    



                 unlink('asset/upload/anggota/gambarkecil/'.$data->gambar_kecil);
            unlink('asset/upload/anggota/gambarbesar/'.$data->gambar_besar);

               $this->session->set_flashdata('message', 
                 "<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><i class='icon icon-ok'></i> Data ".$data->nama_lengkap."</strong>&nbsp; Berhasil di Hapus..
    </div>"

                        );
              redirect('anggota/index');
         }
         else
         {

           $this->session->set_flashdata('message', 
                 "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong>Maaf Data ".$data->nama_lengkap."</strong>&nbsp; Gagal di Hapus..
    </div>"

                        );
                         redirect('anggota/index');


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