<?php
$id = $this->uri->segment(5);

if ($id==NULL) redirect('users');

$query = $this->users_model->get_users($id);

$user_role = $this->session->userdata('user_role');

$team = $this->session->userdata('teamdata');


$roles  = unserialize(USER_ROLES);
$states = unserialize(USER_STATES);

if ($query->role==USER_ROLE_ADMINISTRATOR && $user_role<=USER_ROLE_COORDINATION)
{
    echo '<div class="alert-box error">Sorry baby! You can\'t edit a ADMINISTRATOR!</div>';
}
else
{    

?>

<div class="row">
    <div class="large-12 columns">
        <fieldset>
            <legend>Edit User</legend>

            <?php
                echo form_open('languages/'.$team->shortname.'/users/edit/'.$id,'class="custom"');
            ?>

            <div class="row">
                <div class="large-12 columns">
                    <div class="row collapse">
                        <?php
                            echo validation_errors('<div class="alert-box alert">','<a href="" class="close">&times;</a></div>');
                            if ($this->session->userdata('user_edited'))
                            {
                                echo '<div class="alert-box success">'. $this->session->userdata('user_edited') .'<a href="" class="close">&times;</a></div>';
                                $this->session->unset_userdata('user_edited');
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('Name'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'name','name'=>'name'), set_value('name',$query->name),'autofocus'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('E-mail'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'email','name'=>'email'), set_value('email',$query->email)); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('dotsub ID'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'dotsub_id','name'=>'dotsub_id'), set_value('dotsub_id',$query->dotsub_id)); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('Pootle ID'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'pootle_id','name'=>'pootle_id'), set_value('pootle_id',$query->pootle_id)); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('Facebook ID'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'facebook_id','name'=>'facebook_id'), set_value('facebook_id')); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('Skype ID'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'skype_id','name'=>'skype_id'), set_value('skype_id',$query->skype_id)); ?>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('Start date'); ?>
                    <div class="row collapse">
                        <?php 
                        echo form_input(array('id'=>'date_added','name'=>'date_added'), set_value('date_added',$query->date_added));
                        
                        if ($query->date_added!=NULL && substr($query->date_added,0,4)!='0000')
                        {
                        ?>
                            <script>
                                var queryDate = '<?php echo $query->date_added; ?>',
                                dateParts = queryDate.match(/(\d+)/g)
                                realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);

                                $('#date_added').datepicker({ dateFormat: 'yy-mm-dd' });
                                $('#date_added').datepicker('setDate', realDate);
                            </script>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('User role'); ?>
                    <div class="row collapse">
                        <?php
                        echo '<select name="role" class="medium">';
                            echo '<option value="'.USER_ROLE_TRANSLATOR.'" '.($query->role==USER_ROLE_TRANSLATOR?'selected':'').'>'.$roles[USER_ROLE_TRANSLATOR]. '</option>';
                            echo '<option value="'.USER_ROLE_TRANSCRIBER.'" '.($query->role==USER_ROLE_TRANSCRIBER?'selected':'').'>'.$roles[USER_ROLE_TRANSCRIBER].'</option>';
                            echo '<option value="'.USER_ROLE_COORDINATION.'" '.($query->role==USER_ROLE_COORDINATION?'selected':'').'>'.$roles[USER_ROLE_COORDINATION].'</option>';
                            if ($user_role==USER_ROLE_ADMINISTRATOR)
                                echo '<option value="'.USER_ROLE_ADMINISTRATOR.'" '.($query->role==USER_ROLE_ADMINISTRATOR?'selected':'').'>'.$roles[USER_ROLE_ADMINISTRATOR].'</option>';
                        echo '</select>'
                        ?>
                    </div>
                </div>
            </div>
            
            <br />

            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('User state'); ?>
                    <div class="row collapse">
                        <?php
                        echo '<select name="state" class="medium">';
                            echo '<option value="'.USER_STATE_INACTIVE.'" '.($query->state==USER_STATE_INACTIVE?'selected':'').'>'.$states[USER_STATE_INACTIVE]. '</option>';
                            echo '<option value="'.USER_STATE_ACTIVE.'" '.($query->state==USER_STATE_ACTIVE?'selected':'').'>'.$states[USER_STATE_ACTIVE]. '</option>';
                            echo '<option value="'.USER_STATE_WAINTING_CONFIRMATION.'" '.($query->state==USER_STATE_WAINTING_CONFIRMATION?'selected':'').'>'.$states[USER_STATE_WAINTING_CONFIRMATION]. '</option>';
                        echo '</select>'
                        ?>
                    </div>
                </div>
            </div>
            
            <br />

            <div class="row">
                <div class="large-6 columns">
                    <?php
                        echo form_hidden('id',$query->id);
                        echo form_hidden(array('language_id'=>$team->id));
                        echo form_submit('submit','Edit user','class="button"'); 
                    ?>
                </div>
            </div>

            <br/>

            <?php
                echo form_close();
            ?>
        </fieldset>
    </div>
</div>

<script>
    $(function()
    {
        $( '#date_added' ).datepicker();
        $( '#date_added' ).datepicker( 'option', 'dateFormat', 'yy-mm-dd' );
    });
</script>

<?php
}
?>