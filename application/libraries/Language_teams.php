<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language_teams {
    
    public $id;
    public $name;
    public $shortname;
    public $description;
    public $youtube_channel;
    public $facebook_group;
    public $facebook_page;
    public $twitter;
    public $homepage;
    public $forum_playground;
    public $team_permissions;    

    public function __construct($params)
    {
        // Do something with $params
    }
}

?>