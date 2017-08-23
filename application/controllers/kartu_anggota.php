<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tempatwisata extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('m_header');
        $this->load->model('m_galery');
        $this->load->model('m_komentar');
        $this->load->library('googlemaps');
    }

    public function index()

    {
 
         $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Informasi"  => base_url()."galery",
            "Galery"  => base_url()."galery",
             "Galery"  => ""

        );

        $data   ['posisi']  =   $this->db->get('kategori');
        $data   ['content'] =   'web/isi';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kalimantan Timur';
  //  $data   ['join'] =    $this->m_galery->join_berita();
        $data   ['tampil'] =    $this->berita_model->terbaru_5();
        $data   ['terlama_7'] =    $this->berita_model->terlama_7();
        $data   ['popular_7'] =    $this->berita_model->popular_7();
        $data   ['header_view'] = $this->m_header->header_view()->row();
        $data   ['iklan_view'] = $this->m_header->iklan_view()->row();
        $data   ['galeri'] = $this->m_galery->galeri_web();
        $data   ['profil'] = $this->db->get('profil')->row();


        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web_public',$data);
    }

  public function profil()

    {
 
        $data   ['posisi']  =   $this->db->get('kategori');
      $data   ['content'] =   'web/profil';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kalimantan Timur';
  //  $data   ['join'] =    $this->m_galery->join_berita();
        $data   ['tampil'] =    $this->berita_model->terbaru_5();
        $data   ['terlama_7'] =    $this->berita_model->terlama_7();
        $data   ['popular_7'] =    $this->berita_model->popular_7();
        $data   ['header_view'] = $this->m_header->header_view()->row();
        $data   ['iklan_view'] = $this->m_header->iklan_view()->row();
        $data   ['galeri'] = $this->m_galery->galeri_web();
        $data   ['profil'] = $this->db->get('profil')->row();


        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web_public',$data);
    }


     public function wisata()

    {
        $id = $this->uri->segment(3);
        $data   ['posisi']  =   $this->db->get('kategori');
      $data   ['content'] =   'web/wisata';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kalimantan Timur';
  //  $data   ['join'] =    $this->m_galery->join_berita();
        $data   ['tampil'] =    $this->berita_model->terbaru_5();
        $data   ['terlama_7'] =    $this->berita_model->terlama_7();
        $data   ['popular_7'] =    $this->berita_model->popular_7();
        $data   ['header_view'] = $this->m_header->header_view()->row();
        $data   ['iklan_view'] = $this->m_header->iklan_view()->row();
        $data   ['galeri']     = $this->m_galery->galeri_web();
        $data   ['wisata'] = $this->berita_model->wisata($id);


        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web_public',$data);
    }
    public function viewwisata()

    {

// jangan di ganggu
        $config['center'] = '0.555088, 116.441846';
$config['zoom'] = '10';
$config['directions'] = TRUE;
$this->googlemaps->initialize($config);


// jangan di ganggu

$id = $this->uri->segment(3);







 $data_map      =   $this->berita_model->hotel($id);


foreach ($data_map->result() as $data_map) {
    
  $img = array(         'src' =>'asset/upload/hotel/gambarbesar/'.$data_map->gambar_besar_hotel,
                             'class' => 'span3' );



$marker  = array();
$marker['title'] = $data_map->nama_hotel;

$marker['position'] = $data_map->lat_hotel.','.$data_map->long_hotel;

$marker ['infowindow_content'] =  '<strong>'.$data_map->nama_hotel.'</strong>'.br().
img($img).br().substr($data_map->isiberita,0,50).'...';
$marker ['icon'] = base_url().'asset/img/icon_map/tempat_wisata.gif';
$this->googlemaps->add_marker($marker);

}


$data['map'] = $this->googlemaps->create_map();





        $data   ['posisi']  =   $this->db->get('kategori');
      $data   ['content'] =   'web/viewwisata';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kalimantan Timur';
  //  $data   ['join'] =    $this->m_galery->join_berita();
        $data   ['tampil'] =    $this->berita_model->terbaru_5();
        $data   ['terlama_7'] =    $this->berita_model->terlama_7();
        $data   ['popular_7'] =    $this->berita_model->popular_7();
        $data   ['header_view'] = $this->m_header->header_view()->row();
        $data   ['iklan_view'] = $this->m_header->iklan_view()->row();
        $data   ['galeri']     = $this->m_galery->galeri_web();
        $data   ['viewwisata'] = $this->berita_model->detail_viewwisata($id);
        $data['tampil_komentar']    =   $this->m_komentar->tampil_komentar($id);

        // menampilkan relasi berita wisata dengan 
    
        $data    ['hotel']             = $this->berita_model->hotel($id);
        $data    ['transportasi']      = $this->berita_model->transportasi($id);
        $data    ['tour_travel']      = $this->berita_model->tour_travel($id);
        $data   ['rumah_sakit']          = $this->berita_model->rumah_sakit($id);
        $data   ['money_ch']          = $this->berita_model->money_ch($id);

        $data   ['info_kerajinan']          = $this->berita_model->info_kerajinan($id);

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web_public_detail_viewweb',$data);
    }
    public function viewhotel()

    {



$id = $this->uri->segment(3);
 $data_map      =   $this->berita_model->hotel($id);

        $img = array(         'src' =>'asset/upload/hotel/gambarbesar/'.$data_map->gambar_besar_hotel,
                             'class' => 'span3' );



$config['center'] = '0.555088, 116.441846';
$config['zoom'] = '10';
$config['directions'] = TRUE;
$this->googlemaps->initialize($config);

foreach ($data_map as $key){
    



$marker  = array();
$marker['title'] = $key->nama_hotel;
$marker ['position'] = $key->lat_wisata.','.$key->long_wisata;
$marker ['infowindow_content'] =  '<strong>'.$key->nama_hotel.'</strong>'.br().img($img).br().substr($key->keteranga_hotel,0,50).'...';
$marker ['icon'] = base_url().'asset/img/icon_map/hotel.gif';
$this->googlemaps->add_marker($marker);

}


$data['map'] = $this->googlemaps->create_map();


       $data   ['posisi']  =   $this->db->get('kategori');
        $data   ['content'] =   'web/viewhotel';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kalimantan Timur';
  //  $data   ['join'] =    $this->m_galery->join_berita();
        $data   ['tampil'] =    $this->berita_model->terbaru_5();
        $data   ['terlama_7'] =    $this->berita_model->terlama_7();
        $data   ['popular_7'] =    $this->berita_model->popular_7();
        $data   ['header_view'] = $this->m_header->header_view()->row();
        $data   ['iklan_view'] = $this->m_header->iklan_view()->row();
        $data   ['galeri']     = $this->m_galery->galeri_web();

        // menampilkan relasi berita wisata dengan 
     
        $data    ['detail_hotel']             = $this->berita_model->detail_hotel($id);


        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web_public_detail_viewweb_map',$data);
    }

     public function viewtransportasi()

    {
        $id = $this->uri->segment(3);
        $data   ['posisi']  =   $this->db->get('kategori');
        $data   ['content'] =   'web/viewtransportasi';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kalimantan Timur';
  //  $data   ['join'] =    $this->m_galery->join_berita();
        $data   ['tampil'] =    $this->berita_model->terbaru_5();
        $data   ['terlama_7'] =    $this->berita_model->terlama_7();
        $data   ['popular_7'] =    $this->berita_model->popular_7();
        $data   ['header_view'] = $this->m_header->header_view()->row();
        $data   ['iklan_view'] = $this->m_header->iklan_view()->row();
        $data   ['galeri']     = $this->m_galery->galeri_web();

        // menampilkan relasi berita wisata dengan 
     
        $data    ['detail_transportasi']      = $this->berita_model->detail_transportasi($id);


        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web_public_detail_viewweb_map',$data);
    }



     public function viewtourtravel()

    {
        $id = $this->uri->segment(3);
        $data   ['posisi']  =   $this->db->get('kategori');
        $data   ['content'] =   'web/viewtourtravel';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kalimantan Timur';
  //  $data   ['join'] =    $this->m_galery->join_berita();
        $data   ['tampil'] =    $this->berita_model->terbaru_5();
        $data   ['terlama_7'] =    $this->berita_model->terlama_7();
        $data   ['popular_7'] =    $this->berita_model->popular_7();
        $data   ['header_view'] = $this->m_header->header_view()->row();
        $data   ['iklan_view'] = $this->m_header->iklan_view()->row();
        $data   ['galeri']     = $this->m_galery->galeri_web();

        // menampilkan relasi berita wisata dengan 
     
        $data    ['detail_tourtravel']      = $this->berita_model->detail_tourtravel($id);


        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web_public_detail_viewweb_map',$data);
    }







  public function viewrumahsakit()

    {
        $id = $this->uri->segment(3);
        $data   ['posisi']  =   $this->db->get('kategori');
        $data   ['content'] =   'web/viewrumahsakit';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kalimantan Timur';
  //  $data   ['join'] =    $this->m_galery->join_berita();
        $data   ['tampil'] =    $this->berita_model->terbaru_5();
        $data   ['terlama_7'] =    $this->berita_model->terlama_7();
        $data   ['popular_7'] =    $this->berita_model->popular_7();
        $data   ['header_view'] = $this->m_header->header_view()->row();
        $data   ['iklan_view'] = $this->m_header->iklan_view()->row();
        $data   ['galeri']     = $this->m_galery->galeri_web();

        // menampilkan relasi berita wisata dengan 
     
        $data    ['detail_rumah_sakit']      = $this->berita_model->detail_rumah_sakit($id);


        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web_public_detail_viewweb_map',$data);
    }





  public function viewmoney()

    {
        $id = $this->uri->segment(3);
        $data   ['posisi']  =   $this->db->get('kategori');
        $data   ['content'] =   'web/viewmoney';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kalimantan Timur';
  //  $data   ['join'] =    $this->m_galery->join_berita();
        $data   ['tampil'] =    $this->berita_model->terbaru_5();
        $data   ['terlama_7'] =    $this->berita_model->terlama_7();
        $data   ['popular_7'] =    $this->berita_model->popular_7();
        $data   ['header_view'] = $this->m_header->header_view()->row();
        $data   ['iklan_view'] = $this->m_header->iklan_view()->row();
        $data   ['galeri']     = $this->m_galery->galeri_web();

        // menampilkan relasi berita wisata dengan 
     
        $data    ['detail_money_ch']      = $this->berita_model->detail_money_ch($id);


        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web_public_detail_viewweb_map',$data);
    }





  public function viewkerajinan()

    {
        $id = $this->uri->segment(3);
        $data   ['posisi']  =   $this->db->get('kategori');
        $data   ['content'] =   'web/viewkerajinan';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kalimantan Timur';
  //  $data   ['join'] =    $this->m_galery->join_berita();
        $data   ['tampil'] =    $this->berita_model->terbaru_5();
        $data   ['terlama_7'] =    $this->berita_model->terlama_7();
        $data   ['popular_7'] =    $this->berita_model->popular_7();
        $data   ['header_view'] = $this->m_header->header_view()->row();
        $data   ['iklan_view'] = $this->m_header->iklan_view()->row();
        $data   ['galeri']     = $this->m_galery->galeri_web();

        // menampilkan relasi berita wisata dengan 
     
        $data    ['detail_kerajinan']      = $this->berita_model->detail_kerajinan($id);


        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web_public_detail_viewweb_map',$data);
    }




public function simpan_komentar()
{



 $waktu = date('Y - m -D');

               
         
            $data = array(
                'idkomentar_berita' => $this->input->post('idkomentar'),
                'idberita' => $this->input->post('idberita'),

                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'isikomentar' => $this->input->post('komentar'),
                'waktu' => $waktu

            );
            $create = $this->m_komentar->tambah($data);
            if ($create) 

 $this->session->set_flashdata('message', 
                 "<div class='alert alert-success alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong> Komentar Anda </strong>&nbsp; Berhasil terkirim..
    </div>"

                        );
                else $this->session->set_flashdata('message', '<p class="alert alert-danger">Data gagal disimpan!</p>');
            redirect('tempatwisata/viewwisata/'.$_POST['idberita']);
}







    public function hasilpencarian()

    {
        $id = $this->uri->segment(3);
        $data   ['posisi']  =   $this->db->get('kategori');
      $data   ['content'] =   'web/hasilpencarian';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kalimantan Timur';
  //  $data   ['join'] =    $this->m_galery->join_berita();
        $data   ['tampil'] =    $this->berita_model->terbaru_5();
        $data   ['terlama_7'] =    $this->berita_model->terlama_7();
        $data   ['popular_7'] =    $this->berita_model->popular_7();
        $data   ['header_view'] = $this->m_header->header_view()->row();
        $data   ['iklan_view'] = $this->m_header->iklan_view()->row();
        $data   ['galeri']     = $this->m_galery->galeri_web();
        $data   ['viewwisata'] = $this->berita_model->detail_viewwisata($id);
        $search=$this->input->post('search');
            $data['hasilpencarian'] = $this->berita_model->pencarian($search);


        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web_public',$data);
    }











}

/* End of file home.php */
/* Location: ./application/controllers/home.php */