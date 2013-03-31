<?php

if($type=='home')
{
    $this->load->view('templates/home-header');
    $this->load->view($view);
    $this->load->view('templates/home-footer');
}

else if($type=='team')
{
    $this->load->view('templates/team-header');
    $this->load->view($view);
    $this->load->view('templates/team-footer');
}

else if($type=='user')
{
    $this->load->view('templates/user-header');
    $this->load->view($view);
    $this->load->view('templates/user-footer');
}

//$this->load->view('templates/header');
//if($view!='') $this->load->view($view);
//$this->load->view('templates/footer');
