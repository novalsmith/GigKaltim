<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_alumni extends CI_Model {

  public function tampil()
   {
      return $this->db->get('alumni');
   }
   public function tambah($data)
   {
     return  $this->db->insert('alumni', $data);
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


  public function nomor_anggota()
   {
        $this->db->select_max('id_anggota');
      return  $this->db->get('alumni');
   }

     public function hapus($id)
   {
      
      $this->db->where('id_alumni', $id);
      
    return  $this->db->delete('alumni');
   }


public function cek_idanggota($id)
{
       return $this->db->get_where('alumni', array('id_anggota' => $id));
  }

public function join_alumni_anggota()
{
    $this->db->join('anggota', 'anggota.id_anggota = alumni.id_anggota');
    return $this->db->get('alumni');
}

}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */