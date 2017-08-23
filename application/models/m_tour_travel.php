<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_tour_travel extends CI_Model {

  public function tampil()
   {
      return $this->db->get('info_tour_travel');
   }
   public function tambah($data)
   {
     return  $this->db->insert('info_tour_travel', $data);
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
      
      $this->db->where('id_tour_travel', $id);
      
    return  $this->db->delete('info_tour_travel');
   }


public function cek_nama_tour_travel($nama_tour_travel)
{
       return $this->db->get_where('info_tour_travel', array('nama_tour_travel' => $nama_tour_travel));
  }


public function cek_lat($lat)
{
       return $this->db->get_where('info_tour_travel', array('lat_tour_travel' => $lat));
  }



public function cek_long($long)
{
       return $this->db->get_where('info_tour_travel', array('long_tour_travel' => $long));
  }



public function join_tour()
{
   $this->db->join('berita', 'berita.idberita = info_tour_travel.idberita');
    return $this->db->get('info_tour_travel');
}

}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */