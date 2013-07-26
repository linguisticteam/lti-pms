<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
//        $this->check_isvalidated();
    }

    public function index()
    {
//        $userinfo = $this->joomlauser->get_user();
        
        $data = array(
            'title' => 'Home',
            'type' => 'home',
            'view' => 'templates/home',
//            'userinfo' => $userinfo,
            'language_teams' => $this->language_teams_model->get_active_language_teams(),
        );
        $this->load->view('controlpanel',$data);     
        
    }

//    private function check_isvalidated()
//    {
//        if(! $this->session->userdata('validated'))
//        {
//            redirect('login');
//        }
//    }

//    public function do_logout()
//    {
//        $this->session->sess_destroy();
//        redirect('login');
//    }
}