<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_category extends CI_Model {

  public function tampil()
   {
      return $this->db->get('kategori');
   }
   public function tambah($data)
   {
     return  $this->db->insert('kategori', $data);
     if($this->db->affected_rows() > 0){
      return true;
    } else{
      return false;
    }
   }

 

     public function hapus($id)
   {
      
          $data = array('idkategori' => $id);
    return  $this->db->delete('kategori',$data);
   }


   public function cek_category($kategori_baru)
   {
          return $this->db->get_where('kategori', array('namakategori' => $kategori_baru));
   }
}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */