<?php

$team = $this->session->userdata('teamdata');
$member_id = $userinfo->id;

if ( !$this->authorization->check_authorization($member_id, AUTH_CAN_ADD_VIDEO))
{
    redirect('');
}

?>

<div class="row">
    <div class="large-12 columns">
        <fieldset>
            <legend>Add Video</legend>

            <?php
                echo form_open('languages/'.$team->langcode.'/videos/add','onsubmit="getDuration()" class="custom"');
            ?>

            <div class="row">
                <div class="large-12 columns">
                    <div class="row collapse">
                        <?php
                            echo validation_errors('<div class="alert-box alert">','<a href="" class="close">&times;</a></div>');
                            if ($this->session->userdata('video_added'))
                            {
                                echo '<div class="alert-box success">'. $this->session->userdata('video_added') .'<a href="" class="close">&times;</a></div>';
                                $this->session->unset_userdata('video_added');
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <div class="row">
                        <div class="large-12 columns">
                            <?php
                                echo form_label('Title');
                                echo form_input(array('id'=>'title','name'=>'title'),set_value('title', $this->input->post('title')),'autofocus');
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-8 columns">
                            <?php
                                echo form_label('Originator');
                                echo form_input(array('id'=>'originator','name'=>'originator'),set_value('originator', $this->input->post('originator')));
                            ?>
                        </div>
                        <div class="large-4 columns">
                            <?php echo form_label('Category'); ?>
                            <div class="row collapse">
                                <select name="category" class="medium">
                                    <?php
                                        $status = unserialize(MEDIA_CATEGORIES);

                                        echo '<option value="0"></option>';

                                        $i = 1;
                                        foreach ($status as $item):
                                            echo '<option value="'.$i.'" '. ($i==$query->category? 'selected' : '').'>'.$item.'</option>'."\n";
                                            $i++;
                                        endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-8 columns">
                            <?php
                                echo form_label('Producer');
                                echo form_input(array('id'=>'producer','name'=>'producer'),set_value('producer', $this->input->post('producer')));
                            ?>
                        </div>
                        <div class="large-4 columns">
                            <?php echo form_label('Priority'); ?>
                            <div class="row collapse">
                                <input name="priority" type="radio" class="star required" value="1"/>
                                <input name="priority" type="radio" class="star" value="2"/>
                                <input name="priority" type="radio" class="star" value="3" checked="checked"/>
                                <input name="priority" type="radio" class="star" value="4"/>
                                <input name="priority" type="radio" class="star" value="5"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="large-6 columns">
                    <div class="row">
                        <div class="large-12 columns">
                        <?php
                            echo form_label('Description');
                            echo form_textarea(array('id'=>'description','name'=>'description','style'=>'height:10%'),set_value('description', $this->input->post('description')));
                        ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-4 columns">
                    <?php echo form_label('Working location'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'working_location','name'=>'working_location'),set_value('working_location', $this->input->post('working_location'))); ?>
                    </div>
                </div>
                <div class="large-4 columns">
                    <?php echo form_label('Original location'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'original_location','name'=>'original_location'),set_value('original_location', $this->input->post('original_location'))); ?>
                    </div>
                </div>
                <div class="large-4 columns">
                    <?php echo form_label('Publish location'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'publish_location','name'=>'publish_location'),set_value('publish_location', $this->input->post('publish_location'))); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-4 columns">
                    <?php echo form_label('Repository storage location'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'repo_storage_location','name'=>'repo_storage_location'),set_value('repo_storage_location', $this->input->post('repo_storage_location'))); ?>
                    </div>
                </div>
                <div class="large-4 columns">
                    <?php echo form_label('Repository distribution location'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'repo_distribution_location','name'=>'repo_distribution_location'),set_value('repo_distribution_location', $this->input->post('repo_distribution_location'))); ?>
                    </div>
                </div>
                <div class="large-2 columns">
                    <?php echo form_label('Start date'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'date_added','name'=>'date_added'),set_value('date_added', $this->input->post('date_added'))); ?>
                    </div>
                </div>
                <div class="large-2 columns">
                    <?php echo form_label('Publish date'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'date_finished','name'=>'date_finished'),set_value('date_finished', $this->input->post('date_finished'))); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-1 columns">
                    <?php echo form_label('Hours'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'hours','name'=>'hours'),set_value('hours', $this->input->post('hours'))); ?>
                    </div>
                </div>
                <div class="large-1 columns">
                    <?php echo form_label('Minutes'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'minutes','name'=>'minutes'),set_value('minutes', $this->input->post('minutes'))); ?>
                    </div>
                </div>
                <div class="large-1 columns">
                    <?php echo form_label('Seconds'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'seconds','name'=>'seconds'),set_value('seconds', $this->input->post('seconds'))); ?>
                    </div>
                </div>
                <div class="large-3 columns">
                    <?php echo form_label('Forum'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'forum_thread','name'=>'forum_thread'),set_value('forum_thread', $this->input->post('forum_thread'))); ?>
                    </div>
                </div>
                <div class="large-3 columns">
                    <?php echo form_label('Notes'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'notes','name'=>'notes'),set_value('notes', $this->input->post('notes'))); ?>
                    </div>
                </div>
                <div class="large-3 columns">
                    <?php echo form_label('Comments'); ?>
                    <div class="row collapse">
                        <?php echo form_textarea(array('id'=>'comments','name'=>'comments'),set_value('comments', $this->input->post('comments'))); ?>
                    </div>
                </div>
            </div>

            <br/>


            <div class="row">
                <div class="six columns">
                    <?php echo form_hidden('duration'); ?>
                    <?php echo form_hidden(array('state'=>STATE_OPEN_FOR_TRANSCRIPTION)); ?>
                    <?php echo form_hidden(array('original_language_id'=>$team->id)); ?>
                    <?php echo form_hidden(array('project_language_id'=>$team->id)); ?>
                    <?php echo form_hidden(array('type'=>MEDIA_TYPE_VIDEO)); ?>
                    <?php echo form_hidden(array('subtype'=>MEDIA_SUBTYPE_UNKNOWN)); ?>
                    <?php echo form_hidden(array('parent_id'=>0)); ?>
                    <?php echo form_submit('submit','Add Video','class="button"'); ?>
                </div>
            </div>

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

        $( '#date_finished' ).datepicker();
        $( '#date_finished' ).datepicker( 'option', 'dateFormat', 'yy-mm-dd' );
    });
    function getDuration()
    {
        var hours   = document.forms[0]["hours"].value;
        var minutes = document.forms[0]["minutes"].value;
        var seconds = document.forms[0]["seconds"].value;

        document.forms[0]["duration"].value=hours+":"+minutes+":"+seconds;
    }
</script>