<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $shortname = $this->uri->segment(2);
        
        $team = $this->language_teams_model->get_language_team_by_shortname($shortname);
        
        $this->session->set_userdata('teamdata', $team);
        
        $data = array(
            'title' => 'Members',
            'type' => 'team',
            'view' => 'members/retrieve',
            'members' => $this->members_model->get_members_by_language($team->id),            
        );
        $this->load->view('controlpanel',$data);
    }
    
    public function add()
    {
        $shortname = $this->uri->segment(2);

        $this->session->set_userdata('teamdata', $this->language_teams_model->get_language_team_by_shortname($shortname));

        $this->form_validation->set_rules('name','NAME','trim|required|max_length[255]');
        $this->form_validation->set_rules('email','EMAIL','trim|required|valid_email|is_unique[pms_members.email]');

        if ($this->form_validation->run()==TRUE):
            $data = elements(array('name','email','password','language_id',
                                   'dotsub_id','pootle_id','facebook_id','skype_id',
                                   'state','role','description','date_added'),$this->input->post());
        $data['password'] = md5($data['password']);
            $this->members_model->insert_member($data);
        endif;

        $data = array(
            'title' => 'Home',
            'type' => 'team',
            'view' => 'members/add'
        );

        $this->load->view('controlpanel',$data);
    }  
    
    public function edit()
    {
        $shortname = $this->uri->segment(2);

        $this->session->set_userdata('teamdata', $this->language_teams_model->get_language_team_by_shortname($shortname));

        $this->form_validation->set_rules('name','NAME','trim|required|max_length[255]');
        if ($this->input->post('original_email') != $this->input->post('email'))
        {
            $this->form_validation->set_rules('email','EMAIL','trim|required|valid_email|is_unique[pms_members.email]');
        }        

        if ($this->form_validation->run()==TRUE):
            $data = elements(array('name','email','language_id',
                                   'dotsub_id','pootle_id','facebook_id','skype_id',
                                   'state','role','description','date_added'),$this->input->post());            
            $this->members_model->update_member($data,array('id'=>$this->input->post('id')));
        endif;

        $data = array(
            'title' => 'Home',
            'type' => 'team',
            'view' => 'members/edit'
        );

        $this->load->view('controlpanel',$data);
    }
    
    public function view()
    {
        $data = array(
            'title' => 'View member info',
            'type' => 'member',
            'view' => 'members/view'
        );
        $this->load->view('controlpanel',$data);
    }
    
    public function edit_profile()
    {
        $this->form_validation->set_rules('name','NAME','trim|required|max_length[255]');
        $this->form_validation->set_rules('password','PASSWORD','trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2','REPEAT PASSWORD','trim|required|min_length[3]');

        if ($this->form_validation->run()==TRUE):
            $data = elements(array('name','password','dotsub_id','pootle_id','facebook_id','skype_id',
                                   'description'),$this->input->post());     
            $data['password'] = md5($data['password']);
            $this->members_model->update_member_profile($data,array('id'=>$this->input->post('id')));
        endif;

        $data = array(
            'title' => 'Edit profile',
            'type' => 'member',
            'view' => 'members/edit_profile'
        );

        $this->load->view('controlpanel',$data);
    }
    
    public function send_invitation()
    {        
        $data = array(
            'title' => 'View member info',
            'type' => 'member',
            'view' => 'members/send_invitation'
        );
        $this->load->view('controlpanel',$data);
    }
}