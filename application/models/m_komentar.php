<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_komentar extends CI_Model {

  public function tampil()
   {
      return $this->db->get('komentar_berita');
   }
   public function tambah($data)
   {
     return  $this->db->insert('komentar_berita', $data);
     if($this->db->affected_rows() > 0){
      return true;
    } else{
      return false;
    }
   }


    

     public function hapus($id)
   {
      
      $this->db->where('idkomentar_berita', $id);
      
    return  $this->db->delete('komentar_berita');
   }



 public  function tampil_komentar($id){
     return  $this->db->get_where('komentar_berita',array('idberita' => $id));

    }

    public function join_berita()
    {
     $this->db->join('berita', 'berita.idberita = komentar_berita.idberita');
    return $this->db->get('komentar_berita');
    }
}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */