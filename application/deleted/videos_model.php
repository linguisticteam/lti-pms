<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos_model extends CI_Model{
    
    public function insert_video($data=NULL)
    {
        if ($data!=NULL)
        {
            $this->db->insert('videos',$data);
            $this->session->set_flashdata('video_added','Video added successfully');
            redirect('videos/add');
        }
    }
    
    public function update_video($data=NULL,$condition=NULL)
    {
        if ($data!=NULL && $condition!=NULL)
        {
            $this->db->update('videos',$data,$condition);
            $this->session->set_flashdata('video_edited','Video edited successfully');
            redirect(current_url());
        }
    }    
    
    public function remove_video($id=NULL)
    {
        if ($id!=NULL)
        {
            $this->db->query('UPDATE videos SET status = ' . VIDEO_STATE_DELETED .' WHERE id = '.$id);
            $this->session->set_flashdata('video_removed','Video removed successfully');
            redirect('videos/retrieve');
        }
    }
    
    public function get_all_videos()
    {
        return $this->db->query('SELECT * FROM videos WHERE status != '. VIDEO_STATE_DELETED .' ORDER BY status ASC, publish_date DESC');
    }
    
    public function get_videos_inprogress()
    {
        return $this->db->query('SELECT * FROM videos WHERE status != '. VIDEO_STATE_DELETED .
                                 ' AND status != '. VIDEO_STATE_READY_TO_POST .
                                 ' AND status != '. VIDEO_STATE_POSTED .
                                 ' AND status != '. VIDEO_STATE_REPOSITORY .' ORDER BY status ASC, publish_date DESC');
    }
    
    public function get_videos_ready_to_post()
    {
        return $this->db->query('SELECT * FROM videos WHERE status = '. VIDEO_STATE_READY_TO_POST .' ORDER BY status ASC, publish_date DESC');
    }
    
    public function get_videos_posted()
    {
        return $this->db->query('SELECT * FROM videos WHERE status = '. VIDEO_STATE_POSTED .' ORDER BY status ASC, publish_date DESC');
    }
    
    public function get_videos_repository()
    {
        return $this->db->query('SELECT * FROM videos WHERE status = '. VIDEO_STATE_REPOSITORY .' ORDER BY status ASC, publish_date DESC');
    }
    
    public function get_video($id)
    {
        return $this->db->query("SELECT * FROM videos WHERE id = $id");
    }    
}