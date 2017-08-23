<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_profil extends CI_Model {

  public function tampil()
   {
      return $this->db->get('profil');
   }
   public function tambah($data)
   {
     return  $this->db->insert('profil', $data);
     if($this->db->affected_rows() > 0){
      return true;
    } else{
      return false;
    }
   }

 

     public function hapus($id)
   {
      
          $data = array('idprofil' => $id);
    return  $this->db->delete('profil',$data);
   }



}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */