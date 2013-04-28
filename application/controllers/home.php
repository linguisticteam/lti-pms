<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->check_isvalidated();
    }
    
    public function index()
    {
        // If the user is validated, then this function will run
//        echo 'Congratulations, you are logged in.';
        $data = array(
            'title' => 'Home',
            'type' => 'home',
            'view' => 'templates/home',
            'language_teams' => $this->language_teams_model->get_active_language_teams(),
        );
        $this->load->view('controlpanel',$data);

        // Add a link to logout
//        echo '<br /><a href="'. base_url(). 'home/do_logout">Logout Fool!</a>';
    }
    
    private function check_isvalidated()
    {
        if(! $this->session->userdata('validated'))
        {
            redirect('login');
        }
    }
    
    public function do_logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function index2()
    {
        $data = array(
            'title' => 'Home',
            'type' => 'home',
            'view' => 'templates/home',
            'language_teams' => $this->language_teams_model->get_language_teams(),
        );
        $this->load->view('controlpanel',$data);
    }

}