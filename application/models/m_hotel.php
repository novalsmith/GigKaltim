<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_hotel extends CI_Model {

  public function tampil()
   {
      return $this->db->get('info_hotel');
   }
   public function tambah($data)
   {
     return  $this->db->insert('info_hotel', $data);
     if($this->db->affected_rows() > 0){
      return true;
    } else{
      return false;
    }
   }


      public function update($data,$where)
   {
    $this->db->where('id_alumni', $where);
     return  $this->db->update('alumni', $data);
     if($this->db->affected_rows() > 0){
      return true;
    } else{
      return false;
    }
   }



     public function hapus($id)
   {
      
      $this->db->where('id_info_hotel', $id);
      
    return  $this->db->delete('info_hotel');
   }


public function cek_nama_hotel($nama_hotel)
{
       return $this->db->get_where('info_hotel', array('nama_hotel' => $nama_hotel));
  }


public function cek_lat($lat)
{
       return $this->db->get_where('info_hotel', array('lat_hotel' => $lat));
  }



public function cek_long($long)
{
       return $this->db->get_where('info_hotel', array('long_hotel' => $long));
  }

public function join_berita()
{
    $this->db->join('berita', 'berita.idberita = info_hotel.idberita');
    return $this->db->get('info_hotel');
}


}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */