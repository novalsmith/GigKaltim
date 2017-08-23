<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita_model extends CI_Model {

	
	function get_insert($data){
       $this->db->insert('berita', $data);
       return TRUE;
    }
function tampil(){
	
	$this->db->join('kategori', 'kategori.idkategori = berita.idkategori');
	$this->db->order_by('judulberita', 'desc');
   return $this->db->get('berita');
 	
    }
    function tampil_status(){
	
$this->db->select('status')->distinct('status');
$this->db->where('status !=','');
$this->db->from('berita');
   return $this->db->get();
 	
    }

    function detail_tampil($id){
	
	$this->db->where('idberita');
	return $this->db->get('berita');
      
    }

 

public function edit($id)
	{
		$this->db->from('berita');
        $this->db->where('idberita', $id);
 
        $query = $this->db->get();
 
        if ($query->num_rows() == 1) {
            return $query->result();
        }
	}
		public function delete($id)
		{
					$data = array('idberita' => $id);
		return	$this->db->delete('berita',$data);
		}




	public function per_id($id)
		{
		$this->db->where('idberita',$id);
		$this->db->from('berita');
		$this->db->join('kategori','kategori.idkategori = berita.idkategori');
		
		return $this->db->get();

			
		}


 		public	function tutorial_perkategori($id){
	//return $this->db->query("select * from artikel where kategori = '$id'")->num_rows();
	$this->db->where('idkategori', $id);
	return $this->db->get('berita')->num_rows();
		}

		public function tampil_komentar($id){
     return  $this->db->get_where('komentar_berita',array('idberita' => $id));
    }
    	public function tampil_komentar_berita(){

    		$this->db->limit(5);
    		$this->db->order_by('idkomentar_berita', 'desc');
    			$this->db->join('berita','berita.idberita = komentar_berita.idberita');
     return  $this->db->get('komentar_berita');
    }

      public function tampil_komentar_detil_berita($id)

      {
    		$this->db->where('idkomentar_berita', $id);
 
 			$this->db->join('berita','berita.idberita = komentar_berita.idberita');
     		return  $this->db->get('komentar_berita');

    }



				public function tambah_data($data)
	{

	  	$this->db->insert('komentar_berita', $data);
	  	if($this->db->affected_rows() > 0){
			return true;
		} else{
			return false;
		}
	}


 public function hapus_komentar($id)
    {
    	    	$sqlstr="delete from komentar_berita where idkomentar_berita =".$id;
		$hslquery=$this->db->query($sqlstr);
				return $hslquery;

    	    }
 public function get_db(){
 
  return $this->db->get("berita");
  }


    public function cek_berita($berita_baru)
   {
          return $this->db->get_where('berita', array('judulberita' => $berita_baru));
   }

        public function hapus($id)
   {
      
          $data = array('idberita' => $id);
    return  $this->db->delete('berita',$data);
   }





// Batas Untuk Web Public

   function terbaru_5(){
  
  $this->db->join('kategori', 'kategori.idkategori = berita.idkategori');
  $this->db->order_by('idberita', 'desc');
  $this->db->limit(5);
  $this->db->where('status', 'publish','popular');
   return $this->db->get('berita');
  
    }

   function terlama_7(){
  
   
  $sqlstr="select * from berita where status= 'publish' order by idberita desc";
    $sqlstr.=" limit 5,12";

    $hslquery=$this->db->query($sqlstr);
        return $hslquery;

  
    }


 function popular_7(){
  
   
  $sqlstr="select * from berita where status_popular= 'popular' and status='publish' order by idberita desc";
    $sqlstr.=" limit 7";

    $hslquery=$this->db->query($sqlstr);
        return $hslquery;

  
    }

    // Baner Header
   public function baner_header()
   {
    $this->db->where('status_baner','aktif');
    $this->db->where('kategori_baner', 'header');
    $this->db->limit(1);
    return $this->db->get('baner');
   }

 public function wisata($id)
 {
  $this->db->select('*');
          $this->db->from('kategori');
          $this->db->join('berita', 'kategori.idkategori = berita.idkategori');
          $this->db->where('kategori.idkategori=', $id);
          $this->db->where('berita.idkategori=', $id);
        return  $this->db->get();

 }

 public function detail_viewwisata($id)
 {
  $this->db->join('kategori', 'kategori.idkategori = berita.idkategori');
  $this->db->where('idberita', $id);
   return $this->db->get('berita');

 }

 public function pencarian($search)
 {
    //  $q = $this->db->query("select * from berita where judulberita, like '%$search%' ");
  //return $q;

  $this->db->join('kategori', 'kategori.idkategori = berita.idkategori');


$this->db->like('judulberita', $search);
$this->db->like('isiberita', $search);

return $this->db->get('berita');
 }





// menampilkan relasi berita dengan informasi wisata dan maping
 public function hotel($id)
 {
   
  $this->db->join('berita', 'berita.idberita = info_hotel.idberita');
          $this->db->where('info_hotel.idberita=', $id);
          $this->db->where('berita.idberita=', $id);
  return $this->db->get('info_hotel');
 }








  public function transportasi($id)
 {
   
  $this->db->join('berita', 'berita.idberita = transportasi.idberita');
          $this->db->where('transportasi.idberita=', $id);
          $this->db->where('berita.idberita=', $id);
  return $this->db->get('transportasi');
 }

  public function tour_travel($id)
 {
   
  $this->db->join('berita', 'berita.idberita = info_tour_travel.idberita');
          $this->db->where('info_tour_travel.idberita=', $id);
          $this->db->where('berita.idberita=', $id);
  return $this->db->get('info_tour_travel');
 }

  public function rumah_sakit($id)
 {
   
  $this->db->join('berita', 'berita.idberita = info_rumah_sakit.idberita');
          $this->db->where('info_rumah_sakit.idberita=', $id);
          $this->db->where('berita.idberita=', $id);
  return $this->db->get('info_rumah_sakit');
 }


  public function money_ch($id)
 {
   
  $this->db->join('berita', 'berita.idberita = money_ch.idberita');
          $this->db->where('money_ch.idberita=', $id);
          $this->db->where('berita.idberita=', $id);
  return $this->db->get('money_ch');
 }




  public function info_kerajinan($id)
 {
   
  $this->db->join('berita', 'berita.idberita = info_kerajinan.idberita');
          $this->db->where('info_kerajinan.idberita=', $id);
          $this->db->where('berita.idberita=', $id);
  return $this->db->get('info_kerajinan');
 }



  public function galery($id)
 {
   
  $this->db->join('berita', 'berita.idberita = galery.idberita');
          $this->db->where('galery.idberita=', $id);
          $this->db->where('berita.idberita=', $id);
  return $this->db->get('galery');
 }



 public function detail_hotel($id)
 {
  $this->db->join('berita', 'berita.idberita = info_hotel.idberita');
  $this->db->where('id_info_hotel', $id);
   return $this->db->get('info_hotel');

 }


 public function detail_transportasi($id)
 {
  $this->db->join('berita', 'berita.idberita = transportasi.idberita');
  $this->db->where('id_transport', $id);
   return $this->db->get('transportasi');

 }

 public function detail_tourtravel($id)
 {
  $this->db->join('berita', 'berita.idberita = info_tour_travel.idberita');
  $this->db->where('id_tour_travel', $id);
   return $this->db->get('info_tour_travel');

 }



 public function detail_rumah_sakit($id)
 {
  $this->db->join('berita', 'berita.idberita = info_rumah_sakit.idberita');
  $this->db->where('id_rumah_sakit', $id);
   return $this->db->get('info_rumah_sakit');

 }


 public function detail_money_ch($id)
 {
  $this->db->join('berita', 'berita.idberita = money_ch.idberita');
  $this->db->where('id_money', $id);
   return $this->db->get('money_ch');

 }




 public function detail_kerajinan($id)
 {
  $this->db->join('berita', 'berita.idberita = info_kerajinan.idberita');
  $this->db->where('id_kerajinan', $id);
   return $this->db->get('info_kerajinan');

 }


}






/* End of file berita.php */
/* Location: ./application/models/berita.php */