<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language_teams_model extends CI_Model
{
    public function get_language_teams($id = NULL)
    {
        if ( $id != NULL )
        {
            $this->db->where('id',$id);
        }

        $query = $this->db->get('pms_language_teams');

        $appended_language_teams_array = array();

        if($query->num_rows() > 0)
        {
            $appended_language_teams_array = $query->result();
        }
        else
        {
            return FALSE;
        }

        if ($query->num_rows() > 1)
        {
            return $appended_language_teams_array;
        }
        else 
       {
            return $appended_language_teams_array[0];
        }
    }
    
    public function get_active_language_teams()
    {
        $this->db->where('team_permissions >',TEAM_NOT_ACTIVE);

        return $this->get_language_teams();
    }

    public function get_language_team_by_langcode($langcode)
    {
        $this->db->where('langcode',$langcode);

        return $this->get_language_teams();
    }
}