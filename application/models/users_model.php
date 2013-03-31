<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public function get_users($id = NULL)
    {
        if ( $id != NULL )
        {
            $this->db->where('id',$id);
        }

        $query = $this->db->get('users');

        $appended_users_array = array();

        if($query->num_rows() > 0)
        {
            $appended_users_array = $query->result();
        }
        else
        {
            return FALSE;
        }

        if ($query->num_rows() > 1)
        {
            return $appended_users_array;
        }
        else
        {
            return $appended_users_array[0];
        }
    }

    public function get_users_by_function($media_id, $function)
    {
        $where = 'media_id = '.$media_id. ' AND function = '. $function;
        $this->db->where($where);
        $this->db->order_by("order", "asc"); 
        $query = $this->db->get('workgroups');
 
       if($query->num_rows() > 0)
        {
            $list = array();
            foreach ($query->result() as $row)
            {
                array_push($list,$this->get_users($row->user_id)->name);
            }

            return $list;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function get_users_by_language($language_id)
    {
        $where = 'language_id = '.$language_id;
        $this->db->where($where);
        $this->db->order_by("name", "asc"); 
        $query = $this->db->get('users');
 
        return $query->result();
    }

    public function insert_user($data=NULL)
    {
        if ($data!=NULL)
        {
            $this->db->insert('users',$data);
            
            $team = $this->session->userdata('teamdata');
            $this->session->set_userdata('user_added','User added successfully');
            
            redirect('languages/'.$team->shortname.'/users/add');
        }
    }
    
    public function update_user($data=NULL,$condition=NULL)
    {
        if ($data!=NULL && $condition!=NULL)
        {
            $this->db->update('users',$data,$condition);
            
            $team = $this->session->userdata('teamdata');
            $this->session->set_userdata('user_edited','User edited successfully');
            
            redirect('languages/'.$team->shortname.'/users/edit/'.$condition['id']);
        }
    }
    
    public function update_user_profile($data=NULL,$condition=NULL)
    {
        if ($data!=NULL && $condition!=NULL)
        {
            $this->db->update('users',$data,$condition);            
            
            $this->session->set_userdata('user_profile_edited','User profile edited successfully');
            
            redirect('users/edit_profile/'.$condition['id']);
        }
    }
}