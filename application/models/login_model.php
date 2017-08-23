<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

    public $db_tabel = 'admin';

    public function load_form_rules()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[20]|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[20]|xss_clean');

    }

    public function validasi()
    {
        $form = $this->load_form_rules();
        $this->form_validation->set_rules($form);

        if ($this->form_validation->run())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
 
    // cek status user, login atau tidak?
    public function cek_user()
    {


        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $query = $this->db->where('username', $username)
                          ->where('password', $password)
                          ->limit(1)
                          ->get($this->db_tabel);

        $simpan_session = $this->db->get('admin')->row();

        if ($query->num_rows() == 1)
        {
            
            
            $data = array(
                            'username' => $username,
                            'nama_lengkap' => $simpan_session->nama_lengkap,
                            'login' => TRUE);
            // buat data session jika login benar
            $this->session->set_userdata($data);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(array('username' => '', 'nama_lengkap' => '', 'login' => FALSE));
        $this->session->sess_destroy();
    }
}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */