<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authorization_model extends CI_Model
{
    public function get_authorization($id = NULL)
    {
        if ( $id != NULL )
        {
            $this->db->where('user_id',$id);
        }

        $query = $this->db->get('ltimp_user_usergroup_map');

        $appended_auth_array = array();

        if($query->num_rows() > 0)
        {
            $appended_auth_array = $query->result();
        }
        else
        {
            return FALSE;
        }
            
        return $appended_auth_array;
    }
}