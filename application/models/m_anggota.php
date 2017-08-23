<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_anggota extends CI_Model {

  public function tampil()
   {
      return $this->db->get('anggota');
   }
   public function tambah($data)
   {
     return  $this->db->insert('anggota', $data);
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


  public function nomor_anggota()
   {
        $this->db->select_max('id_anggota');
      return  $this->db->get('anggota');
   }

     public function hapus($id)
   {
      
          $data = array('id_anggota' => $id);
    return  $this->db->delete('anggota',$data);
   }

// cek data
   public function cek_data($nama_panggilan,$nama_lengkap)
   {
          return $this->db->get_where('anggota', array('nama_panggilan' => $nama_panggilan,
                                                         'nama_lengkap'  => $nama_lengkap));
   }

public function cek_namalengkap($nama_lengkap)
{
       return $this->db->get_where('anggota', array('nama_lengkap' => $nama_lengkap));
  }

public function cek_email($email)
{
       return $this->db->get_where('anggota', array('email' => $email));
  }
public function cek_notlp($notlp)
{
       return $this->db->get_where('anggota', array('tlp' => $notlp));
  }

 // cek data

  
  public function detail($id)
   {

     
    $this->db->where('id_anggota',$id);
     return   $this->db->get('anggota');
   }
}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */