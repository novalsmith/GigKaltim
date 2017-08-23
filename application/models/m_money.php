<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_money extends CI_Model {

  public function tampil()
   {
      return $this->db->get('money_ch');
   }
   public function tambah($data)
   {
     return  $this->db->insert('money_ch', $data);
     if($this->db->affected_rows() > 0){
      return true;
    } else{
      return false;
    }
   }




     public function hapus($id)
   {
      
      $this->db->where('id_money', $id);
      
    return  $this->db->delete('money_ch');
   }


public function cek_money($nama_hotel)
{
       return $this->db->get_where('money_ch', array('nama_money' => $nama_hotel));
  }


public function cek_lat($lat)
{
       return $this->db->get_where('money_ch', array('lat_money' => $lat));
  }



public function cek_long($long)
{
       return $this->db->get_where('money_ch', array('long_money' => $long));
  }


public function join_berita_money()
{
    $this->db->join('berita', 'berita.idberita = money_ch.idberita');
    return $this->db->get('money_ch');
}

}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */