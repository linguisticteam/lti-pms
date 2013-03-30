<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletters_model extends CI_Model{

    public function insert_newsletter($data=NULL)
    {
        if ($data!=NULL)
        {
            $this->db->insert('newsletters',$data);
            $this->session->set_flashdata('newsletter_added','Newsletter added successfully');
            redirect('newsletters/add');
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
}