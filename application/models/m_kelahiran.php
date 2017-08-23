<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kelahiran extends CI_Model {

public function tampil()
	{
		
		return $this->db->get('kelahiran');

	}	
public function detail($id)
   {

     
    $this->db->where('id_kelahiran', $id);
     return   $this->db->get('kelahiran');
   }


   public function tambah($data)
   {
   		 return $this->db->insert('kelahiran', $data);
   	if ($this->db->affected_rows() > 0) {
   		return TRUE;
   	}
   	else
   	{
   		return FLASE;
   	}
   }

   public function nomor_regis()
   {
   			$this->db->select_max('id_kelahiran');
   		return	$this->db->get('kelahiran');
   }



     public function cek_nama_bayi($nama)
   {
          return $this->db->get_where('kelahiran', array('nama_bayi' => $nama));
   }

   public function update_kelahiran($data,$id)
   {
   		$this->db->where('id_kelahiran', $id);
   	 	return $this->db->update('kelahiran',$data);
   }



     public function hapus($id)
   {
      
          $data = array('id_kelahiran' => $id);
    return  $this->db->delete('kelahiran',$data);
   }


   public function join_kk()
   {
   	
   	return	$this->db->get('no_kartu_keluarga');

   }
public function join_penduduk()
   {
   
   $this->db->select('ayah,ibu')->distinct();
   $this->db->from('penduduk');
   return $this->db->get();

   }

   public function pekerjaan_ayah()
   {

      $this->db->where('status_hdrt', 'Kepala Keluarga');
      return $this->db->get('penduduk');
   }

 public function pekerjaan_ibu()
   {

      $this->db->where('status_hdrt', 'Istri');
      return $this->db->get('penduduk');
   }


}

/* End of file kelahiran.php */
/* Location: ./application/models/kelahiran.php */