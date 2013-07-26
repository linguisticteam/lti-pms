<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members_model extends CI_Model
{
    public function get_members($id = NULL)
    {
        if ( $id != NULL )
        {
            $this->db->where('id',$id);
        }

        $this->db->order_by("name");
        $query = $this->db->get('ltimp_users');

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
                if (!empty($row->name))
                {
                    array_push($list_names,$row->name);
                }
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
        $this->db->order_by("name", "asc");
        $this->db->join('pms_users_languages', 'pms_users_languages.user_id = ltimp_users.id and pms_users_languages.language_id = '.$language_id);
        $query = $this->db->get('ltimp_users');

        return $query->result();
    }

    public function count_members_by_language($language_id)
    {
        $this->db->join('pms_users_languages', 'pms_users_languages.user_id = ltimp_users.id and pms_users_languages.language_id = '.$language_id);
        $this->db->from('ltimp_users');

        return $this->db->count_all_results();
    }

    public function get_user_languages($user_id)
    {
        if ( $user_id != NULL )
        {
            $this->db->select('language_id');
            $this->db->where('user_id',$user_id);
        }

        $query = $this->db->get('pms_users_languages');

        return  $query->result();
    }

    public function set_user_languages($user_id, $language_id, $state)
    {
        $data = array(
                'user_id' => $user_id,
                'language_id' => $language_id
        );

        if ($state == 'no')
        {
            $this->db->insert('pms_users_languages', $data);
        }
        else
        {
            $this->db->delete('pms_users_languages', $data);
        }
    }
}