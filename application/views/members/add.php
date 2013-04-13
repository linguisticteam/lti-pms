<div class="row">
    <div class="large-12 columns">
        <fieldset>
            <legend>Add Member</legend>

            <?php
                $team = $this->session->userdata('teamdata');

                echo form_open('languages/'.$team->shortname.'/members/add');
            ?>

            <div class="row">
                <div class="large-12 columns">
                    <div class="row collapse">
                        <?php
                            echo validation_errors('<div class="alert-box alert">','<a href="" class="close">&times;</a></div>');
                            if ($this->session->userdata('member_added'))
                            {
                                echo '<div class="alert-box success">'. $this->session->userdata('member_added') .'<a href="" class="close">&times;</a></div>';
                                $this->session->unset_userdata('member_added');
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('Name'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'name','name'=>'name'), set_value('name',$this->input->post('name'))); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('E-mail'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'email','name'=>'email'), set_value('email',$this->input->post('email'))); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('dotsub ID'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'dotsub_id','name'=>'dotsub_id'), set_value('dotsub_id',$this->input->post('dotsub_id'))); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('Pootle ID'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'pootle_id','name'=>'pootle_id'), set_value('pootle_id',$this->input->post('pootle_id'))); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('Facebook ID'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'facebook_id','name'=>'facebook_id'), set_value('facebook_id',$this->input->post('facebook_id'))); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('Skype ID'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'skype_id','name'=>'skype_id'), set_value('skype_id',$this->input->post('skype_id'))); ?>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_label('Start date'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'date_added','name'=>'date_added'), set_value('date_added',$this->input->post('date_added'))); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <?php echo form_hidden(array('password'=>'lti')); ?>
                    <?php echo form_hidden(array('language_id'=>$team->id)); ?>
                    <?php echo form_hidden(array('state'=>MEMBER_STATE_ACTIVE)); ?>
                    <?php echo form_hidden(array('role'=>MEMBER_ROLE_TRANSLATOR)); ?>
                    <?php echo form_hidden(array('description'=>'')); ?>
                    <?php echo form_submit('submit','Add member','class="button"'); ?>
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