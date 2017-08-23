<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_home');
        $this->is_logged_in();
                $this->load->helper("html");
        $this->load->helper("date");
                $this->load->library('googlemaps');

    }

    public function index()

    {
             $posisi = array(
            "Dashboard"     => base_url()."home",
     
            "Dashboard"  => ""
        );

$id = $this->uri->segment(3);
        $data   ['posisi']  =   $posisi;

        $data   ['content'] =   'admin/home';
        $data   ['title']   =   'Selamat Datang di web Sig Kaltim';
        $data   ['brand'] =     'Sig Kaltim';
     
        $data   ['content'] =   'admin/home';
        $data["nohari"]         =date('w');
        $data ['tglhariini']    =   date('d-m-Y');
                                list($data["tgl"],
                                    $data["bln"],
                                    $data["thn"])=explode("-",$data["tglhariini"]);

        // count
        $data ['tempatwisata'] = $this->m_home->total_tempatwisata();
        $data ['kategori'] = $this->m_home->total_kategori();
        $data ['hotel'] = $this->m_home->total_hotel();
        $data ['trans'] = $this->m_home->total_trans();
        $data ['tour'] = $this->m_home->tour();
        $data ['money'] = $this->m_home->money();
        $data ['rs'] = $this->m_home->rs();
        $data ['kerajinan'] = $this->m_home->kerajinan();
        $data ['galery'] = $this->m_home->galery();
     
        $data ['publish'] = $this->m_home->publish()->num_rows();
        $data ['pending'] = $this->m_home->pending()->num_rows();
        $data  ['komentar'] = $this->db->get('komentar_berita')->num_rows();


// maping

  $img = array(         'src' =>'asset/img/icon_map/logo.gif',
                             'class' => 'span3' );

        

$config['center'] = '0.555088, 116.441846';
$config['zoom'] = '7';
$this->googlemaps->initialize($config);

$marker = array();


$marker['position'] = '0.285276, 116.405194';
$marker ['infowindow_content'] =  '<strong>'.'Tempat Penelitian Skripsi Saya'.'</strong>'.br().img($img);

$marker['animation'] = 'DROP';
$this->googlemaps->add_marker($marker);
$data['map'] = $this->googlemaps->create_map();




        $this->load->view('template_web',$data);
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