<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Languages extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $shortname = $this->uri->segment(2);

        $this->session->set_userdata('teamdata', $this->language_teams_model->get_language_team_by_shortname($shortname) );

        $data = array(
            'title' => 'Home',
            'type' => 'team',
            'view' => 'templates/team',
            'language_teams' => $this->language_teams_model->get_language_teams(),
        );
        $this->load->view('controlpanel',$data);
    }

    public function in_progress()
    {
        $data = array(
            'title' => 'Home',
            'type' => 'team',
            'view' => 'videos/inprogress',
            'language_teams' => $this->language_teams_model->get_language_teams(),
            'videos_inprogress' => $this->medias_model->get_videos_in_progress(),
        );
        $this->load->view('controlpanel',$data);
    }

    public function open_for_translation()
    {
        $shortname = $this->uri->segment(2);

        $data = array(
            'title' => 'Home',
            'type' => 'team',
            'view' => 'videos/open_for_translation',
            'language_teams' => $this->language_teams_model->get_language_teams(),
            'team' => $this->language_teams_model->get_language_team_by_shortname($shortname),
            'videos_inprogress' => $this->medias_model->get_videos_inprogress(),
        );
        $this->load->view('controlpanel',$data);
    }
    
    public function configuration()
    {   
        $shortname = $this->uri->segment(2);

        $team = $this->language_teams_model->get_language_team_by_shortname($shortname);
        
        $this->session->set_userdata('teamdata', $team);

        $data = array(
            'title' => 'Configuration',
            'type' => 'team',
            'view' => 'teams/configuration',
            'language_teams' => $this->language_teams_model->get_language_teams(),
            'team' => $this->language_teams_model->get_language_team_by_shortname($shortname)
        );
        $this->load->view('controlpanel',$data);
    }
}