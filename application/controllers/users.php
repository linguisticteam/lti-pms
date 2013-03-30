<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
    
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
            'title' => 'Users',
            'type' => 'team',
            'view' => 'users/retrieve',
            'users' => $this->users_model->get_users_by_language($team->id),            
        );
        $this->load->view('controlpanel',$data);
    }
    
    public function add()
    {
        $shortname = $this->uri->segment(2);

        $this->session->set_userdata('teamdata', $this->language_teams_model->get_language_team_by_shortname($shortname));

        $this->form_validation->set_rules('name','NAME','trim|required|max_length[255]');
        $this->form_validation->set_rules('email','EMAIL','trim|required|valid_email|is_unique[users.email]');

        if ($this->form_validation->run()==TRUE):
            $data = elements(array('name','email','language_id',
                                   'dotsub_id','pootle_id','facebook_id','skype_id',
                                   'state','role','description','date_added'),$this->input->post());
            $this->users_model->insert_user($data);
        endif;

        $data = array(
            'title' => 'Home',
            'type' => 'team',
            'view' => 'users/add'
        );

        $this->load->view('controlpanel',$data);
    }  
    
    public function edit()
    {
        $shortname = $this->uri->segment(2);

        $this->session->set_userdata('teamdata', $this->language_teams_model->get_language_team_by_shortname($shortname));

        $this->form_validation->set_rules('name','NAME','trim|required|max_length[255]');
//        $this->form_validation->set_rules('email','EMAIL','trim|required|valid_email|is_unique[users.email]');

        if ($this->form_validation->run()==TRUE):
            $data = elements(array('name','email','language_id',
                                   'dotsub_id','pootle_id','facebook_id','skype_id',
                                   'state','role','description','date_added'),$this->input->post());            
            $this->users_model->update_user($data,array('id'=>$this->input->post('id')));
        endif;

        $data = array(
            'title' => 'Home',
            'type' => 'team',
            'view' => 'users/edit'
        );

        $this->load->view('controlpanel',$data);
    }
    
    public function view()
    {
        $shortname = $this->uri->segment(2);
        
        $team = $this->language_teams_model->get_language_team_by_shortname($shortname);
        
        $this->session->set_userdata('teamdata', $team);
        
        $data = array(
            'title' => 'View user info',
            'type' => 'team',
            'view' => 'users/view'
        );
        $this->load->view('controlpanel',$data);
    }
    
    public function edit_profile()
    {
        $shortname = $this->uri->segment(2);

        $this->session->set_userdata('teamdata', $this->language_teams_model->get_language_team_by_shortname($shortname));

        $this->form_validation->set_rules('name','NAME','trim|required|max_length[255]');
//        $this->form_validation->set_rules('current_password','CURRENT PASSWORD','trim|required|callback_password_matches['.$this->input->post('id').']');
        $this->form_validation->set_rules('password','PASSWORD','trim|required|min_length[3]|matches[password2]|md5');
        $this->form_validation->set_rules('password2','REPEAT PASSWORD','trim|required|min_length[3]');

        if ($this->form_validation->run()==TRUE):
            $data = elements(array('name','dotsub_id','pootle_id','facebook_id','skype_id',
                                   'description'),$this->input->post());     
            $data['password'] = md5($data['password']);
            $this->users_model->update_user_profile($data,array('id'=>$this->input->post('id')));
        endif;

        $data = array(
            'title' => 'Edit profile',
            'type' => 'team',
            'view' => 'users/edit_profile'
        );

        $this->load->view('controlpanel',$data);
    }
}