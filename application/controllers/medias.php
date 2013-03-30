<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Languages extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'title' => 'Home',
            'view' => 'home',
            'language_teams' => $this->language_teams_model->get_language_teams(),
        );
        $this->load->view('controlpanel',$data);
    }
    
    public function inprogress($language)
    {        
        $data = array(
            'title' => 'Home',
            'view' => 'team',
            'language_teams' => $this->language_teams_model->get_language_teams(),
            'team' => $this->language_teams_model->get_language_team_by_shortname($language),
        );
        $this->load->view('controlpanel',$data);
    }
//    public function team($language)
//    {        
//        $data = array(
//            'title' => 'Home',
//            'view' => 'team',
//            'language_teams' => $this->language_teams_model->get_language_teams(),
//            'team' => $this->language_teams_model->get_language_team_by_shortname($language),
//        );
//        $this->load->view('controlpanel',$data);
//    }

}