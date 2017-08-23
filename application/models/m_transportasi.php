<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_transportasi extends CI_Model {

  public function tampil()
   {
      return $this->db->get('transportasi');
   }
   public function tambah($data)
   {
     return  $this->db->insert('transportasi', $data);
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
      
      $this->db->where('id_transport', $id);
      
    return  $this->db->delete('transportasi');
   }


public function cek_nama_transportasi($nama_transportasi)
{
       return $this->db->get_where('transportasi', array('nama_transport' => $nama_transportasi));
  }


public function cek_lat($lat)
{
       return $this->db->get_where('transportasi', array('lat_transport' => $lat));
  }



public function cek_long($long)
{
       return $this->db->get_where('transportasi', array('long_transport' => $long));
  }



public function join_trans()
{
    $this->db->join('berita', 'berita.idberita = transportasi.idberita');
    return $this->db->get('transportasi');
}

}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */