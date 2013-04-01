<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function validate()
    {
        // grab user input
        $username = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));

        // Prep the query
        $this->db->where('email', $username);
        $this->db->where('password', md5($password));
        
        $password2 = md5($password);
        
        echo $password2;

        // Run the query
        $query = $this->db->get('pms_users');
        // Let's check if there are any results
        if($query->num_rows == 1)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                'user_id' => $row->id,
                'user_name' => $row->name,
                'user_email' => $row->email,
                'user_language' => $row->language_id,
                'user_role' => $row->role,
                'validated' => true
                );
            $this->session->set_userdata($data);
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }
}
?>