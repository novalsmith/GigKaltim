<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_nomor_kk extends CI_Model {

  public function tampil()
   {
      return $this->db->get('no_kartu_keluarga');
   }
   public function tambah($data)
   {
     return  $this->db->insert('no_kartu_keluarga', $data);
     if($this->db->affected_rows() > 0){
      return true;
    } else{
      return false;
    }
   }

 

     public function hapus($id)
   {
      
          $data = array('id_nomor_kk' => $id);
    return  $this->db->delete('no_kartu_keluarga',$data);
   }


   public function cek_nomor_kk($nomor_baru)
   {
          return $this->db->get_where('no_kartu_keluarga', array('nomor_kk' => $nomor_baru));
   }
}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */