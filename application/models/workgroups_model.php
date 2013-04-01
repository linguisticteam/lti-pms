<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workgroups_model extends CI_Model
{
    public function register_workgroup($media_id, $user_id, $function)
    {
        $where = 'media_id ='.$media_id.' AND user_id ='. $user_id. ' AND function ='. $function;
        $this->db->where($where);
        $query = $this->db->get('pms_workgroups');
        
        if ($query->num_rows() > 0)
        {
            return false;
        }
        
        else
        {
            $data = array(
                'media_id' => $media_id,
                'user_id' => $user_id,
                'function' => $function,
                'order' => $this->get_users_count($media_id,$function) + 1,
             );

            $this->db->insert('pms_workgroups', $data); 
        }
    }
    
    public function get_users_count($media_id, $function)
    {
        $this->db->where('media_id',$media_id);
        $this->db->where('function',$function);
        return $this->db->count_all_results('pms_workgroups');
    }
}