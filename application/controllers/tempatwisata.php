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
        $id = $this->uri->segment(3);

        $config['center'] = '0.555088, 116.441846';
        $config['zoom'] = '8';
        $edit          =   $this->db->get_where('berita',array('idberita' => $id))->row();

        $this->googlemaps->initialize($config);


// untuk berita yang bersngkutan

$polygon['points'] = array('-6.984336, 110.409363',
'-6.996895, 110.409363',
'-7.000102, 110.426466',
'-6.987471, 110.415260');
$polygon['strokeColor'] = '#000099';
$polygon['fillColor'] = '#000099';
$this->googlemaps->add_polygon($polygon);
// untuk berita yang bersngkutan
    
  $img = array(         'src' =>'asset/upload/berita/gambarbesar/'.$edit->gambar_besar,
                             'class' => 'span3' );



$marker = array();
$marker['animation'] = 'DROP';
$config['directions'] = TRUE;
$marker['position'] = $edit->lat_wisata.','.$edit->long_wisata;
$marker ['infowindow_content'] =  '<strong>'.$edit->judulberita.'</strong>'.br().
img($img).br().substr($edit->isiberita,0,50).'...';
$marker['title'] = $edit->judulberita;

$marker ['icon'] = base_url().'asset/img/icon_map/tempat_wisata.gif';
$this->googlemaps->add_marker($marker);


$hotel = $this->berita_model->hotel($id);
foreach ($hotel->result() as $key) {
      
  $img = array(         'src' =>'asset/upload/hotel/gambarbesar/'.$key->gambar_besar_hotel,
                             'class' => 'span3' );


$marker = array();
$marker['position'] = $key->lat_hotel.','.$key->long_hotel;
$marker['animation'] = 'DROP';
$marker['title'] = $key->nama_hotel;

$marker ['infowindow_content'] =  '<strong>'.$key->nama_hotel.'</strong>'.br().img($img);
$marker ['icon'] = base_url().'asset/img/icon_map/hotel.gif';
$this->googlemaps->add_marker($marker);
}

// batas transportasi

$transportasi = $this->berita_model->transportasi($id);
$ditek = $this->db->get_where('berita', array('idberita' => $id))->row();
foreach ($transportasi->result() as $key) {
      
  $img = array(         'src' =>'asset/upload/transport/gambarbesar/'.$key->gambar_besar_t,
                             'class' => 'span3' );


$marker = array();
$marker['position'] = $key->lat_transport.','.$key->long_transport;
$marker['animation'] = 'DROP';
$marker['title'] = $key->nama_transport;

$marker ['infowindow_content'] =  '<strong>'.$key->nama_transport.'</strong>'.br().img($img);
$marker ['icon'] = base_url().'asset/img/icon_map/transport.gif';
$this->googlemaps->add_marker($marker);
}
// batas transportasi






// batas tour travel
$tour_travel = $this->berita_model->tour_travel($id);
foreach ($tour_travel->result() as $key) {
      
  $img = array(         'src' =>'asset/upload/tour_travel/gambarbesar/'.$key->gambar_besar_tour,
                             'class' => 'span3' );


$marker = array();
$marker['position'] = $key->lat_tour_travel.','.$key->long_tour_travel;
$marker['animation'] = 'DROP';
$marker['title'] = $key->nama_tour_travel;
$config['directions'] = TRUE;
$marker ['infowindow_content'] =  '<strong>'.$key->nama_tour_travel.'</strong>'.br().img($img);
$marker ['icon'] = base_url().'asset/img/icon_map/tour_travel.gif';
$this->googlemaps->add_marker($marker);
}
// batas tour travel


// batas rumah sakit
$rumah_sakit = $this->berita_model->rumah_sakit($id);
foreach ($rumah_sakit->result() as $key) {
      
  $img = array(         'src' =>'asset/upload/rumah_sakit/gambarbesar/'.$key->gambar_besar_rs,
                             'class' => 'span3' );


$marker = array();
$marker['position'] = $key->lat_rs.','.$key->long_rs;
$marker['animation'] = 'DROP';
$marker['title'] = $key->nama_rs;
$config['directions'] = TRUE;
$marker ['infowindow_content'] =  '<strong>'.$key->nama_rs.'</strong>'.br().img($img);
$marker ['icon'] = base_url().'asset/img/icon_map/rs.gif';
$this->googlemaps->add_marker($marker);
}
// batas rumah sakit



// batas money changger
$money_ch = $this->berita_model->money_ch($id);
foreach ($money_ch->result() as $key) {
      
  $img = array(         'src' =>'asset/upload/money/gambarbesar/'.$key->gambar_besar_money,
                             'class' => 'span3' );


$marker = array();
$marker['position'] = $key->lat_money.','.$key->long_money;
$marker['animation'] = 'DROP';
$marker['title'] = $key->nama_money;
$config['directions'] = TRUE;
$marker ['infowindow_content'] =  '<strong>'.$key->nama_money.'</strong>'.br().img($img);
$marker ['icon'] = base_url().'asset/img/icon_map/money.gif';
$this->googlemaps->add_marker($marker);
}
// batas money changger




// batas Kerajinan Khas Kaltim
$info_kerajinan = $this->berita_model->info_kerajinan($id);
foreach ($info_kerajinan->result() as $key) {
      
  $img = array(         'src' =>'asset/upload/kerajinan/gambarbesar/'.$key->gambar_besar_k,
                             'class' => 'span3' );


$marker = array();
$marker['position'] = $key->lat_kerajinan.','.$key->long_kerajinan;
$marker['animation'] = 'DROP';
$marker['title'] = $key->nama_kerajinan;
$config['directions'] = TRUE;
$marker ['infowindow_content'] =  '<strong>'.$key->nama_kerajinan.'</strong>'.br().img($img);
$marker ['icon'] = base_url().'asset/img/icon_map/kerajinan.gif';
$this->googlemaps->add_marker($marker);
}
// batas Kerajinan Khas Kaltim





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
        $data   ['galery']          = $this->berita_model->galery($id);

        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);


        $this->load->view('template_web_public_detail_viewweb',$data);
    }
    public function viewhotel()

    {

$config['center'] = '0.555088, 116.441846';
$config['zoom'] = '7';
$marker['animation'] = 'DROP';

//$config['directions'] = TRUE;
$this->googlemaps->initialize($config);


$id = $this->uri->segment(3);
 $key    =   $this->db->get_where('info_hotel',array('id_info_hotel' => $id))->row();


   $img = array(         'src' =>'asset/upload/hotel/gambarbesar/'.$key->gambar_besar_hotel,
                             'class' => 'span3' );








$marker  = array();
$marker['title'] = $key->nama_hotel;
$marker ['position'] = $key->lat_hotel.','.$key->long_hotel;
$marker ['infowindow_content'] =  '<strong>'.$key->nama_hotel.'</strong>'.br().img($img).br().substr($key->keterangan_hotel,0,50).'...';
$marker ['icon'] = base_url().'asset/img/icon_map/hotel.gif';

$this->googlemaps->add_marker($marker);




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





$config['center'] = '0.555088, 116.441846';
$config['zoom'] = '7';
$marker['animation'] = 'DROP';

$config['directions'] = TRUE;
$this->googlemaps->initialize($config);


$id = $this->uri->segment(3);
 $key    =   $this->db->get_where('transportasi',array('id_transport' => $id))->row();


   $img = array(         'src' =>'asset/upload/transport/gambarbesar/'.$key->gambar_besar_t,
                             'class' => 'span3' );








$marker  = array();
$marker['title'] = $key->nama_transport;
$marker ['position'] = $key->lat_transport.','.$key->long_transport;
$marker ['infowindow_content'] =  '<strong>'.$key->nama_transport.'</strong>'.br().img($img);
$marker ['icon'] = base_url().'asset/img/icon_map/transport.gif';

$this->googlemaps->add_marker($marker);




$data['map'] = $this->googlemaps->create_map();










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

$config['center'] = '0.555088, 116.441846';
$config['zoom'] = '7';
$marker['animation'] = 'DROP';

//$config['directions'] = TRUE;
$this->googlemaps->initialize($config);



 $key    =   $this->db->get_where('info_tour_travel',array('id_tour_travel' => $id))->row();

      
  $img = array(         'src' =>'asset/upload/tour_travel/gambarbesar/'.$key->gambar_besar_tour,
                             'class' => 'span3' );


$marker = array();
$marker['position'] = $key->lat_tour_travel.','.$key->long_tour_travel;
$marker['animation'] = 'DROP';
$marker['title'] = $key->nama_tour_travel;

$marker ['infowindow_content'] =  '<strong>'.$key->nama_tour_travel.'</strong>'.br().img($img);
$marker ['icon'] = base_url().'asset/img/icon_map/tour_travel.gif';
$this->googlemaps->add_marker($marker);

$data['map'] = $this->googlemaps->create_map();



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




$config['center'] = '0.555088, 116.441846';
$config['zoom'] = '7';
$marker['animation'] = 'DROP';

//$config['directions'] = TRUE;
$this->googlemaps->initialize($config);


 $key    =   $this->db->get_where('info_rumah_sakit',array('id_rumah_sakit' => $id))->row();


   $img = array(         'src' =>'asset/upload/rumah_sakit/gambarbesar/'.$key->gambar_besar_rs,
                             'class' => 'span3' );








$marker  = array();
$marker['title'] = $key->nama_rs;
$marker ['position'] = $key->lat_rs.','.$key->long_rs;
$marker ['infowindow_content'] =  '<strong>'.$key->nama_rs.'</strong>'.br().img($img);
$marker ['icon'] = base_url().'asset/img/icon_map/rs.gif';

$this->googlemaps->add_marker($marker);




$data['map'] = $this->googlemaps->create_map();






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




$config['center'] = '0.555088, 116.441846';
$config['zoom'] = '7';
$marker['animation'] = 'DROP';

//$config['directions'] = TRUE;
$this->googlemaps->initialize($config);


 $key    =   $this->db->get_where('money_ch',array('id_money' => $id))->row();


   $img = array(         'src' =>'asset/upload/money/gambarbesar/'.$key->gambar_besar_money,
                             'class' => 'span3' );








$marker  = array();
$marker['title'] = $key->nama_money;
$marker ['position'] = $key->lat_money.','.$key->long_money;
$marker ['infowindow_content'] =  '<strong>'.$key->nama_money.'</strong>'.br().img($img);
$marker ['icon'] = base_url().'asset/img/icon_map/money.gif';

$this->googlemaps->add_marker($marker);




$data['map'] = $this->googlemaps->create_map();



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




$config['center'] = '0.555088, 116.441846';
$config['zoom'] = '7';
$marker['animation'] = 'DROP';

//$config['directions'] = TRUE;
$this->googlemaps->initialize($config);


 $key    =   $this->db->get_where('info_kerajinan',array('id_kerajinan' => $id))->row();


   $img = array(         'src' =>'asset/upload/kerajinan/gambarbesar/'.$key->gambar_besar_k,
                             'class' => 'span3' );








$marker  = array();
$marker['title'] = $key->nama_kerajinan;
$marker ['position'] = $key->lat_kerajinan.','.$key->long_kerajinan;
$marker ['infowindow_content'] =  '<strong>'.$key->nama_kerajinan.'</strong>'.br().img($img);
$marker ['icon'] = base_url().'asset/img/icon_map/kerajinan.gif';

$this->googlemaps->add_marker($marker);




$data['map'] = $this->googlemaps->create_map();




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
       $search=$this->input->post('search');
            $data['hasilpencarian'] = $this->berita_model->pencarian($search);

   $data   ['tampil'] =    $this->berita_model->terbaru_5();
        $data   ['terlama_7'] =    $this->berita_model->terlama_7();
        $data   ['popular_7'] =    $this->berita_model->popular_7();
        $data   ['header_view'] = $this->m_header->header_view()->row();
        $data   ['iklan_view'] = $this->m_header->iklan_view()->row();
        $data   ['galeri']     = $this->m_galery->galeri_web();
        $data   ['viewwisata'] = $this->berita_model->detail_viewwisata($id);
    //    $data['tampil_komentar']    =   $this->m_komentar->tampil_komentar($id);

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