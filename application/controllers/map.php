<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller {



public function index(){
    $this->load->library('googlemaps');
     
$config['center'] = '-7.2808927,112.6938284';
$config['zoom'] = 'auto';
$config['directions'] = TRUE;

$this->googlemaps->initialize($config);
$data['map'] = $this->googlemaps->create_map();

    $this->load->view('maps_view', $data);
}
    

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */




