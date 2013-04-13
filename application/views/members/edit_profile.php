<?php
$id = $this->uri->segment(3);

if ($id==NULL) redirect('members');

$query = $this->members_model->get_members($id);

$member_role = $this->session->userdata('member_role');

$roles  = unserialize(MEMBER_ROLES);
$states = unserialize(MEMBER_STATES);

?>

<div class="row">
    <div class="large-12 columns">
        <fieldset>
            <legend>Edit profile</legend>

            <?php
                echo form_open('members/edit_profile/'.$id,'class="custom"');
            ?>

            <div class="row">
                <div class="large-12 columns">
                    <div class="row collapse">
                        <?php
                            echo validation_errors('<div class="alert-box alert">','<a href="" class="close">&times;</a></div>');
                            if ($this->session->userdata('member_profile_edited'))
                            {
                                echo '<div class="alert-box success">'. $this->session->userdata('member_profile_edited') .'<a href="" class="close">&times;</a></div>';
                                $this->session->unset_userdata('member_profile_edited');
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('Name'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'name','name'=>'name'), set_value('name',$query->name)); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('E-mail'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'email','name'=>'email'), set_value('email',$query->email),'readonly="readonly"'); ?>
                    </div>
                </div>
            </div>

<!--            <div class="row">
                <div class="large-6 columns">
                    <?php // echo form_label('Current password'); ?>
                    <div class="row collapse">
                        <?php // echo form_password(array('id'=>'current_password','name'=>'current_password')); ?>
                    </div>
                </div>
            </div>-->

            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('New password'); ?>
                    <div class="row collapse">
                        <?php echo form_password(array('id'=>'password','name'=>'password')); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('Repeat password'); ?>
                    <div class="row collapse">
                        <?php echo form_password(array('id'=>'password2','name'=>'password2')); ?>
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
                        <?php echo form_input(array('id'=>'facebook_id','name'=>'facebook_id'), set_value('facebook_id',$query->facebook_id)); ?>
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
                    <?php echo form_label('Description'); ?>
                    <div class="row collapse">
                        <?php echo form_textarea(array('id'=>'description','name'=>'description'), set_value('description',$query->description)); ?>
                    </div>
                </div>
            </div>
            
            <br />

            <div class="row">
                <div class="large-6 columns">
                    <?php
                        echo form_hidden('id',$query->id);                  
                        echo form_submit('submit','Edit member','class="button"'); 
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

