<?php
$team = $this->session->userdata('teamdata');
$member_role = $this->session->userdata('member_role');
$member_language = $this->session->userdata('member_language');

if (!empty($members))
{    
    $this->table->set_heading('#','Name','Email','dotsub','Pootle','Facebook','Skype','State','Role','Started','');
    
    $roles  = unserialize(MEMBER_ROLES);
    $states = unserialize(MEMBER_STATES);
    
    $i = 1;
    foreach ($members as $item):
        
        $s_d = (substr($item->date_added, 0, 4) == '0000') ? '': $item->date_added;
    
        $this->table->add_row($i, '<strong>'.$item->name.'</strong>', $item->email, 
                              $item->dotsub_id, $item->pootle_id, $item->facebook_id, $item->skype_id, $states[$item->state], $roles[$item->role], $s_d,
                              ( ($member_role >= MEMBER_ROLE_COORDINATION && $member_language==$team->id) || ($member_role==MEMBER_ROLE_ADMINISTRATOR) )?  
                              (anchor('languages/'.$team->langcode.'/members/edit/'.$item->id,'[Edit]')).' '.(anchor('members/send_invitation/'.$item->id.'/'.$team->langcode,'[Send Invitation]','target="_blank"')):
                              (""));
        $i++;
    endforeach;

    echo $this->table->generate();
}
else
{
    echo '<div class="alert-box">There is no members in this team... not yet!</div>';
}