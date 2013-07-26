<?php
$id = $this->uri->segment(3);

if ($id==NULL) redirect('');

$query = $this->members_model->get_members($id);

if ($query==NULL) redirect('');

$team = $this->session->userdata('teamdata');
$member_role = $this->session->userdata('member_role');
$member_language = $this->session->userdata('member_language');

if ($member_role != MEMBER_ROLE_ADMINISTRATOR)
{
    if ($member_role != MEMBER_ROLE_COORDINATION || $member_language != $team->id)
    {
        redirect('');
    }        
}

$member_id = $this->session->userdata('member_id');

$same_member = $member_id == $query->id ? TRUE : FALSE;

$roles  = unserialize(MEMBER_ROLES);
$states = unserialize(MEMBER_STATES);
?>

<div class="row">
    <div class="large-12 columns">
        <form>
            <fieldset>
                <legend><?php echo $query->name; ?></legend>
                <p>
                    <?php
                    if (substr($query->date_added, 0, 4) != '0000')                    
                        echo 'Member since: <strong>'.$query->date_added.'</strong><br />';
                                        
                    echo 'Role: <strong>'.$roles[$query->role].'</strong><br />';

                    if ($same_member || $member_role >= MEMBER_ROLE_COORDINATION)
                    {
                        echo 'email: <strong>'.$query->email.'</strong><br />';
                        echo 'dotsub id: <strong>'.$query->dotsub_id.'</strong><br />';
                        echo 'Pootle id: <strong>'.$query->pootle_id.'</strong><br />';
                        echo 'Facebook id: <strong>'.$query->facebook_id.'</strong><br />';
                        echo 'Skype id: <strong>'.$query->skype_id.'</strong><br />';
                    }

                    echo 'Member state: <strong>'.$states[$query->state].'</strong><br />';
                    if ($query->description!=NULL && $query->description!=0)
                    echo 'Description: <strong>'.$query->description.'</strong><br />';
                    ?>
                </p>
            <?php
                if ($same_member)
                {
                    echo anchor('/members/edit_profile/'.$query->id, 'Edit profile', 'class="button"');
                }
            ?>
            </fieldset>
        </form>
    </div>
</div>