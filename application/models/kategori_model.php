<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Kategori_model extends CI_Model {




	
	public function tampil()
	{

		$data = $this->db->get('kategori');
		return $data;
	} 

	function tambah_data($data)
	{

	  	$this->db->insert('kategori', $data);
	  	if($this->db->affected_rows() > 0){
			return true;
		} else{
			return false;
		}
	}
	function getjrecord(){
		$jrec=$this->db->count_all('kategori');
		return $jrec;
	}
	function gettemanpage($p=1,$jppage=7){
			$sqlstr="select * from kategori order by idkategori desc";
		$sqlstr.=" limit $p, $jppage ";

		$hslquery=$this->db->query($sqlstr);
				return $hslquery;
	}

	public function edit($id)
	{
		$this->db->from('kategori');
        $this->db->where('idkategori', $id);
 
        $query = $this->db->get();
 
        if ($query->num_rows() == 1) {
            return $query->result();
        }
	}
		public function delete($id)
		{
					$data = array('idkategori' => $id);
		return	$this->db->delete('kategori',$data);
		}

	
	public function tampung($id)
		{

		//	select * from kategori natural join berita where kategori.idkategori=39 and berita.idkategori=39 
				
					$this->db->select('*');
					$this->db->from('kategori');
					$this->db->join('berita', 'kategori.idkategori = berita.idkategori');
					$this->db->where('kategori.idkategori=', $id);
					$this->db->where('berita.idkategori=', $id);
				return	$this->db->get();

		}
	
}

/* End of file kategori_model.php */
/* Location: ./application/models/kategori_model.php */