<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_home extends CI_Model {

  public function total_tempatwisata()
  {
  
  return $this->db->count_all('berita');

  }

  public function total_kategori()
  {
  
  return $this->db->count_all('kategori');

  }
    public function total_hotel()
  {
  
  return $this->db->count_all('info_hotel');

  }
   public function total_trans()
  {
  
  return $this->db->count_all('transportasi');

  }
   public function tour()
  {
  
  return $this->db->count_all('info_tour_travel');

  }

     public function money()
  {
  
  return $this->db->count_all('money_ch');

  }

      public function rs()
  {
  
  return $this->db->count_all('info_rumah_sakit');

  }


       public function kerajinan()
  {
  
  return $this->db->count_all('info_kerajinan');

  }


       public function galery()
  {
  
  return $this->db->count_all('galery');

  }




    public function publish()
  {
    $this->db->where('status', 'publish');
  return $this->db->get('berita');

  }

    public function pending()
  {
  $this->db->where('status', 'pending');
  return $this->db->get('berita');

  }


}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */

//SELECT COUNT(*) AS `numrows` FROM `status`