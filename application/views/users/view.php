<?php
$id = $this->uri->segment(3);

if ($id==NULL) redirect('users');

$query = $this->users_model->get_users($id);

$user_role = $this->session->userdata('user_role');
$user_id = $this->session->userdata('user_id');

$same_user = $user_id == $query->id ? TRUE : FALSE;

//$team = $this->session->userdata('teamdata');

$roles  = unserialize(USER_ROLES);
$states = unserialize(USER_STATES);
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

                    if ($same_user || $user_role >= USER_ROLE_COORDINATION)
                    {
                        echo 'email: <strong>'.$query->email.'</strong><br />';
                        echo 'dotsub id: <strong>'.$query->dotsub_id.'</strong><br />';
                        echo 'Pootle id: <strong>'.$query->pootle_id.'</strong><br />';
                        echo 'Facebook id: <strong>'.$query->facebook_id.'</strong><br />';
                        echo 'Skype id: <strong>'.$query->skype_id.'</strong><br />';
                    }

                    echo 'User state: <strong>'.$states[$query->state].'</strong><br />';
                    if ($query->description!=NULL && $query->description!=0)
                    echo 'Description: <strong>'.$query->description.'</strong><br />';
                    ?>
                </p>
            <?php
                if ($same_user)
                {
//                    echo anchor('languages/'.$team->shortname.'/users/edit_profile/'.$query->id, 'Edit profile', 'class="button"');
                    echo anchor('/users/edit_profile/'.$query->id, 'Edit profile', 'class="button"');
                }
            ?>
            </fieldset>
        </form>
    </div>
</div>