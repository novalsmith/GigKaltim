<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_kartu extends CI_Model {

  public function tampil()
   {
      return $this->db->get('kartu_anggota');
   }

   public function kartu_aktif()
   {
     $this->db->where('status', 'aktif');
     $this->db->limit(1);
    return $this->db->get('kartu_anggota');
   }

   public function get_insert($data)
   {
     return  $this->db->insert('kartu_anggota', $data);
     if($this->db->affected_rows() > 0){
      return true;
    } else{
      return false;
    }
   }


      public function update($db,$data,$where)
   {
     return  $this->db->update($db, $data,$where);
     if($this->db->affected_rows() > 0){
      return true;
    } else{
      return false;
    }
   }



     public function hapus($id)
   {
      
          $data = array('id_kartu' => $id);
    return  $this->db->delete('kartu_anggota',$data);
   }

// cek data


public function cek_masaberlaku($masaberlaku)
{
       return $this->db->get_where('kartu_anggota', array('masa_berlaku' => $masaberlaku));
  }


  
}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */