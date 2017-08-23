<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_rumah_sakit extends CI_Model {

  public function tampil()
   {
      return $this->db->get('info_rumah_sakit');
   }
   public function tambah($data)
   {
     return  $this->db->insert('info_rumah_sakit', $data);
     if($this->db->affected_rows() > 0){
      return true;
    } else{
      return false;
    }
   }




     public function hapus($id)
   {
      
      $this->db->where('id_rumah_sakit', $id);
      
    return  $this->db->delete('info_rumah_sakit');
   }


public function cek_nama_rumah_sakit($nama_rs)
{
       return $this->db->get_where('info_rumah_sakit', array('nama_rs' => $nama_rs));
  }


public function cek_lat($lat)
{
       return $this->db->get_where('info_rumah_sakit', array('lat_rs' => $lat));
  }



public function cek_long($long)
{
       return $this->db->get_where('info_rumah_sakit', array('long_rs' => $long));
  }



public function join_berita()
{
    $this->db->join('berita', 'berita.idberita = info_rumah_sakit.idberita');
    return $this->db->get('info_rumah_sakit');
}

}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */