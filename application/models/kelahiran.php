<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelahiran extends CI_Model {

public function tampil()
	{
		
		return $this->db->get('kelahiran');

	}	

}

/* End of file kelahiran.php */
/* Location: ./application/models/kelahiran.php */