<?php
$team = $this->session->userdata('teamdata');
$user_role = $this->session->userdata('user_role');
$user_language = $this->session->userdata('user_language');

if (!empty($users))
{    
    $this->table->set_heading('#','Name','Email','dotsub','Pootle','Facebook','Skype','State','Role','Started','');
    
    $roles  = unserialize(USER_ROLES);
    $states = unserialize(USER_STATES);
    
    $i = 1;
    foreach ($users as $item):
        
        $s_d = (substr($item->date_added, 0, 4) == '0000') ? '': $item->date_added;
    
        $this->table->add_row($i, '<strong>'.$item->name.'</strong>', $item->email, 
                              $item->dotsub_id, $item->pootle_id, $item->facebook_id, $item->skype_id, $states[$item->state], $roles[$item->role], $s_d,
                              ( ($user_role >= USER_ROLE_COORDINATION && $user_language==$team->id) || ($user_role==USER_ROLE_ADMINISTRATOR) )?  
                              (anchor('languages/'.$team->shortname.'/users/edit/'.$item->id,'[Edit]')):
                              (""));
        $i++;
    endforeach;

    echo $this->table->generate();
}
else
{
    echo '<div class="alert-box">There is no users in this team... not yet!</div>';
}