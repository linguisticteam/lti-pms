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

else if($type=='member')
{
    $this->load->view('templates/member-header');
    $this->load->view($view);
    $this->load->view('templates/member-footer');
}