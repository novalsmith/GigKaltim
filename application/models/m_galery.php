<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_galery extends CI_Model {

  public function tampil()
   {
      return $this->db->get('galery');
   }
   public function tambah($data)
   {
     return  $this->db->insert('galery', $data);
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
      
      $this->db->where('id_galery', $id);
      
    return  $this->db->delete('galery');
   }


public function cek_judul($judul)
{
       return $this->db->get_where('galery', array('judul' => $judul));
  }




public function join_berita()
{
    $this->db->join('berita', 'berita.idberita = galery.idberita');
    return $this->db->get('galery');
}

public function galeri_web()
{
  return $this->db->get('galery',8);
}
}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */