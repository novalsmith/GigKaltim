<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_header extends CI_Model {

  public function tampil()
   {
      return $this->db->get('header');
   }
   public function tambah($data)
   {
     return  $this->db->insert('header', $data);
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
      
      $this->db->where('idheader', $id);
      
    return  $this->db->delete('header');
   }


public function cek_judul($judul)
{
       return $this->db->get_where('galery', array('judul' => $judul));
  }




public function header_view()
{
  $this->db->where('kategori', 'header');
   return $this->db->get('header');
}


public function iklan_view()
{
  $this->db->where('kategori', 'iklan');
   return $this->db->get('header');
}



}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */