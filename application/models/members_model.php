<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members_model extends CI_Model
{
    public function get_members($id = NULL)
    {
        if ( $id != NULL )
        {
            $this->db->where('id',$id);
        }

        $query = $this->db->get('pms_members');

        $appended_members_array = array();

        if($query->num_rows() > 0)
        {
            $appended_members_array = $query->result();
        }
        else
        {
            return FALSE;
        }

        if ($query->num_rows() > 1)
        {
            return $appended_members_array;
        }
        else
        {
            return $appended_members_array[0];
        }
    }

    public function get_members_by_function($media_id, $function)
    {
        $where = 'media_id = '.$media_id. ' AND function = '. $function. ' AND member_id != 0';
        $this->db->where($where);
        $this->db->order_by("order", "asc"); 
        $query = $this->db->get('pms_workgroups');
 
       if($query->num_rows() > 0)
        {
            $list = array();
            foreach ($query->result() as $row)
            {
                array_push($list,$this->get_members($row->member_id));
            }

            return $list;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function get_members_name_by_function($media_id, $function)
    {        
        $list = $this->get_members_by_function($media_id, $function);
        $list_names = array();
                
        if ($list)
        {
            foreach ($list as $row)
            {
                array_push($list_names,$row->name);
            }
        }
        else
        {
            $list_names[0] = "";
        }
        
        return $list_names;
    }
    
    public function get_out_members_by_function($media_id, $function)
    {
        $where = 'media_id = '.$media_id. ' AND function = '. $function. ' AND member_id = 0';
        $this->db->where($where);
        $this->db->order_by("order", "asc"); 
        $query = $this->db->get('pms_workgroups');
 
       if($query->num_rows() > 0)
        {
            $list = array();
            foreach ($query->result() as $row)
            {
                array_push($list,$row->name);
            }

            return $list;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function get_members_by_language($language_id)
    {
        $where = 'language_id = '.$language_id;
        $this->db->where($where);
        $this->db->order_by("name", "asc"); 
        $query = $this->db->get('pms_members');
 
        return $query->result();
    }
    
    public function count_members_by_language($language_id)
    {        
        $where = 'language_id = '.$language_id.' AND state = '.MEMBER_STATE_ACTIVE;
        $this->db->where($where);
        $this->db->from('pms_members');        

        return $this->db->count_all_results();
    }

    public function insert_member($data=NULL)
    {
        if ($data!=NULL)
        {
            $this->db->insert('pms_members',$data);
            
            $team = $this->session->userdata('teamdata');
            $this->session->set_userdata('member_added','Member added successfully');
            
            redirect('languages/'.$team->shortname.'/members/add');
        }
    }
    
    public function update_member($data=NULL,$condition=NULL)
    {
        if ($data!=NULL && $condition!=NULL)
        {
            $this->db->update('pms_members',$data,$condition);
            
            $team = $this->session->userdata('teamdata');
            $this->session->set_userdata('member_edited','Member edited successfully');
            
            redirect('languages/'.$team->shortname.'/members/edit/'.$condition['id']);
        }
    }
    
    public function update_member_profile($data=NULL,$condition=NULL)
    {
        if ($data!=NULL && $condition!=NULL)
        {
            $this->db->update('pms_members',$data,$condition);            
            
            $this->session->set_userdata('member_profile_edited','Member profile edited successfully');
            
            redirect('members/edit_profile/'.$condition['id']);
        }
    }
}