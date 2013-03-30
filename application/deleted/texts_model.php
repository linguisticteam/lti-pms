<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Texts_model extends CI_Model{
    
    public function insert_text($data=NULL)
    {
        if ($data!=NULL)
        {            
            $this->db->insert('texts',$data);
            $this->session->set_flashdata('text_added','Text added successfully');
            redirect('texts/add');
        }
    }
    
    public function update_text($data=NULL,$condition=NULL)
    {
        if ($data!=NULL && $condition!=NULL)
        {
            $this->db->update('texts',$data,$condition);
            $this->session->set_flashdata('text_edited','Text edited successfully');
            redirect(current_url());
        }
    }
    
    public function remove_text($id=NULL)
    {
        if ($id!=NULL)
        {
            $this->db->query('UPDATE texts SET status = ' . TEXT_STATE_DELETED .' WHERE id = '.$id);
            $this->session->set_flashdata('text_removed','Text removed successfully');
            redirect('texts/retrieve');
        }
    }      
    
    public function get_all_translators()
    {
        return $this->db->get('texts');
    }
    
    public function get_texts_inprogress()
    {
        return $this->db->query('SELECT * FROM texts WHERE status != '. TEXT_STATE_DELETED .
                                 ' AND status != '. TEXT_STATE_READY_TO_POST .
                                 ' AND status != '. TEXT_STATE_POSTED .
                                 ' AND status != '. TEXT_STATE_REPOSITORY .' ORDER BY status ASC, publish_date DESC');
    }
    
    public function get_texts_inrepository()
    {
        return $this->db->query('SELECT * FROM texts WHERE status != '. TEXT_STATE_DELETED .
                                 ' AND status != '. TEXT_STATE_OPEN_TO_TRANSLATION .
                                 ' AND status != '. TEXT_STATE_TRANSLATING .
                                 ' AND status != '. TEXT_STATE_PROOFREADING .' ORDER BY status ASC, publish_date DESC');
    }
    
    public function get_text($id)
    {
        return $this->db->query("SELECT * FROM texts WHERE id = $id");
    }
}