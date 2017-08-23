<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_kerajinan extends CI_Model {

  public function tampil()
   {
      return $this->db->get('info_kerajinan');
   }
   public function tambah($data)
   {
     return  $this->db->insert('info_kerajinan', $data);
     if($this->db->affected_rows() > 0){
      return true;
    } else{
      return false;
    }
   }




     public function hapus($id)
   {
      
      $this->db->where('id_kerajinan', $id);
      
    return  $this->db->delete('info_kerajinan');
   }


public function cek_money($nama_kerajinan)
{
       return $this->db->get_where('info_kerajinan', array('nama_kerajinan' => $nama_kerajinan));
  }


public function cek_lat($lat)
{
       return $this->db->get_where('info_kerajinan', array('lat_kerajinan' => $lat));
  }



public function cek_long($long)
{
       return $this->db->get_where('info_kerajinan', array('long_kerajinan' => $long));
  }



public function join_kerajinan()
{
    $this->db->join('berita', ' info_kerajinan.idberita= berita.idberita');
    return $this->db->get('info_kerajinan');
}

}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */