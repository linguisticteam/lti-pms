<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Joomlauser
{
    var $CI; //create CI instance so we can access libraries
//    var $get_user_url = 'http://members.linguisticteam.org/scripts/get_joomla_user.php';
    var $get_user_url = 'http://members.linguisticteam.org/get_joomla_user.php';

    function __construct()
    {
        $this->CI = & get_instance();
        
        if (ENVIRONMENT == 'production')
        {
            $get_user_url = 'http://members.linguisticteam.org/get_joomla_user.php';            
        }
        else
        {
            $get_user_url = 'http://localhost/joomla/get_joomla_user.php';
        }
            
    }
    
    function get_user()
    {
        //Need to set cookie context so that Joomla can access it's session/user cookie
        $opts = array('http' => array('header' => 'Cookie: ' . $_SERVER ['HTTP_COOKIE'] . "\r\n"));
        $context = stream_context_create($opts);
        $juser = json_decode(file_get_contents($this->get_user_url, false, $context));
        if (!$juser)
        {
            //Not logged in - echo error -or-
            //redirect to joomla login page 
//            $this->CI->load->helper('url');
//            redirect('JOOMLA_LOGIN_PAGE_URL', 'refresh');
            return $juser = 0;
        }
        else
        {
            //Logged in
            return $juser;
        }
    }
}