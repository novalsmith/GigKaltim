<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_penduduk extends CI_Model {

  public function tampil()
   {
      return $this->db->get('penduduk');
   }
   public function tambah($data)
   {
     return  $this->db->insert('penduduk', $data);
     if($this->db->affected_rows() > 0){
      return true;
    } else{
      return false;
    }
   }


 

     public function hapus($id)
   {
      
          $data = array('id_penduduk' => $id);
    return  $this->db->delete('penduduk',$data);
   }


   public function cek_nik($nik)
   {
          return $this->db->get_where('penduduk', array('nik' => $nik));
   }

   public function detail2($id)
   {

      $this->db->where('id_penduduk', $id);
    $this->db->join('no_kartu_keluarga', 'no_kartu_keluarga.id_nomor_kk = penduduk.id_nomor_kk');
     return   $this->db->get('penduduk');
   }
  public function detail()
   {

     
    $this->db->join('no_kartu_keluarga', 'no_kartu_keluarga.id_nomor_kk = penduduk.id_nomor_kk');
     return   $this->db->get('penduduk');
   }
}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */