<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Translators_model extends CI_Model{
    
    public function insert_translator($data=NULL)
    {
        if ($data!=NULL)
        {            
            $this->db->insert('translators',$data);
            $this->session->set_flashdata('translator_added','Translator added successfully');
            redirect('translators/add');
        }
    }
    
    public function update_translator($data=NULL,$condition=NULL)
    {
        if ($data!=NULL && $condition!=NULL)
        {            
            $this->db->update('translators',$data,$condition);
            $this->session->set_flashdata('translator_edited','Translator edit successfully');
            redirect(current_url());
        }
    }
    
    public function remove_translator($id=NULL)
    {
        if ($id!=NULL)
        {
            $this->db->query('UPDATE translators SET status = ' . TRANSLATOR_INACTIVE .' WHERE id = '.$id);
            $this->session->set_flashdata('translator_removed','Translator removed successfully');
            redirect('translators/retrieve');
        }
    }
    
    public function get_all_translators()
    {
        return $this->db->get('translators');
    }
    
    public function get_active_translators()
    {
        return $this->db->query("SELECT * FROM translators WHERE status = ". TRANSLATOR_ACTIVE ." ORDER BY name");
    }
    
    public function get_translator($id)
    {
        return $this->db->query("SELECT * FROM translators WHERE id = ". $id);
    }
    
    public function get_last_translators()
    {
        return $this->db->query('SELECT * FROM translators WHERE status != ' .TRANSLATOR_INACTIVE . ' ORDER BY start_date DESC limit 4');
    }
}