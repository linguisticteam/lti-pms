<?php
$id = $this->uri->segment(5);

if ($id==NULL) redirect('videos');

$query = $this->medias_model->get_medias($id);

$team = $this->session->userdata('teamdata');

$team_members = $this->users_model->get_users_by_language($team->id);

$is_original = ($query->parent_id==0)?TRUE:FALSE;


?>
<div class="row">
    <div class="large-12 columns">
        <fieldset>
            <legend>Edit Video</legend>

            <?php
                echo form_open('languages/'.$team->shortname.'/videos/edit/'.$id,'onsubmit="getDuration()" class="custom"');
            ?>

            <div class="row">
                <div class="large-12 columns">
                    <div class="row collapse">
                        <?php
                            echo validation_errors('<div class="alert-box alert">','<a href="" class="close">&times;</a></div>');
                            if ($this->session->userdata('video_edited'))
                            {
                                echo '<div class="alert-box success">'. $this->session->userdata('video_edited') .'<a href="" class="close">&times;</a></div>';
                                $this->session->unset_userdata('video_edited');
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
                                echo form_input(array('id'=>'title','name'=>'title'),set_value('title',$query->title),'autofocus'.($is_original?'':' readonly="readonly"'));

                                if (!$is_original)
                                    echo form_hidden('title',$query->title);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-8 columns">
                            <?php
                                echo form_label('Originator');
                                echo form_input(array('id'=>'originator','name'=>'originator'),set_value('originator',$query->originator),$is_original?'':' readonly="readonly"');
                                
                                if (!$is_original)
                                    echo form_hidden('originator',$query->originator);
                            ?>
                        </div>
                        <div class="large-4 columns">
                            <?php echo form_label('Category'); ?>
                            <div class="row collapse">
                                <select name="category" class="medium" <?php echo $is_original?'':' disabled="disabled"'?>>
                                    <?php
                                        $categories = unserialize(MEDIA_CATEGORIES);

                                        echo '<option value="0"></option>';

                                        $i = 1;
                                        foreach ($categories as $item):
                                            echo '<option value="'.$i.'" '. ($i==$query->category? 'selected' : '').'>'.$item.'</option>'."\n";
                                            $i++;
                                        endforeach;
                                        
                                        if (!$is_original)
                                            echo form_hidden('category',$query->category);
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-8 columns">
                            <?php
                                echo form_label('Producer');
                                echo form_input(array('id'=>'producer','name'=>'producer'),set_value('producer',$query->producer),$is_original?'':' readonly="readonly"');
                                
                                if (!$is_original)
                                    echo form_hidden('producer',$query->producer);
                            ?>
                        </div>
                        <div class="large-4 columns">
                            <?php echo form_label('Priority'); ?>
                            <div class="row collapse">
                                <input name="priority" type="radio" class="star required" value="1" <?php echo ($query->priority==1?'checked="checked"':''). ($is_original?'':' disabled="disabled" ')?>/>
                                <input name="priority" type="radio" class="star" value="2" <?php echo ($query->priority==2?'checked="checked"':''). ($is_original?'':' disabled="disabled" ')?>/>
                                <input name="priority" type="radio" class="star" value="3" <?php echo ($query->priority==3?'checked="checked"':''). ($is_original?'':' disabled="disabled" ')?>/>
                                <input name="priority" type="radio" class="star" value="4" <?php echo ($query->priority==4?'checked="checked"':''). ($is_original?'':' disabled="disabled" ')?>/>
                                <input name="priority" type="radio" class="star" value="5" <?php echo ($query->priority==5?'checked="checked"':''). ($is_original?'':' disabled="disabled" ')?>/>
                            </div>
                            <?php
                            if (!$is_original)
                                echo form_hidden('priority',$query->priority);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="large-6 columns">
                    <div class="row">
                        <div class="large-12 columns">
                        <?php
                            echo form_label('Description');
                            echo form_textarea(array('id'=>'description','name'=>'description','style'=>'height:10%'),set_value('description',$query->description),($is_original?'':' readonly="readonly"'));
                            
                            if (!$is_original)
                                echo form_hidden('description',$query->description);
                        ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-4 columns">
                    <?php echo form_label('Working location'); ?>
                    <div class="row collapse">
                        <?php 
                        echo form_input(array('id'=>'working_location','name'=>'working_location'),set_value('working_location',$query->working_location),($is_original?'':' readonly="readonly"')); 
                        
                        if (!$is_original)
                            echo form_hidden('working_location',$query->working_location);
                        ?>
                    </div>
                </div>
                <div class="large-4 columns">
                    <?php echo form_label('Original location'); ?>
                    <div class="row collapse">
                        <?php 
                        echo form_input(array('id'=>'original_location','name'=>'original_location'),set_value('original_location',$query->original_location),($is_original?'':' readonly="readonly"')); 
                        
                        if (!$is_original)
                            echo form_hidden('original_location',$query->original_location);
                        ?>
                    </div>
                </div>
                <div class="large-4 columns">
                    <?php echo form_label('Publish location'); ?>
                    <div class="row collapse">
                        <?php 
                        echo form_input(array('id'=>'publish_location','name'=>'publish_location'),set_value('publish_location',$query->publish_location));                         
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-4 columns">
                    <?php echo form_label('Repository storage location'); ?>
                    <div class="row collapse">
                        <?php 
                        echo form_input(array('id'=>'repo_storage_location','name'=>'repo_storage_location'),set_value('repo_storage_location',$query->repo_storage_location),($is_original?'':' readonly="readonly"')); 
                        
                        if (!$is_original)
                            echo form_hidden('repo_storage_location',$query->repo_storage_location);
                        ?>
                    </div>
                </div>
                <div class="large-4 columns">
                    <?php echo form_label('Repository distribution location'); ?>
                    <div class="row collapse">
                        <?php 
                        echo form_input(array('id'=>'repo_distribution_location','name'=>'repo_distribution_location'),set_value('repo_distribution_location',$query->repo_distribution_location),($is_original?'':' readonly="readonly"')); 
                        
                        if (!$is_original)
                            echo form_hidden('repo_distribution_location',$query->repo_distribution_location);
                        ?>
                    </div>
                </div>
                <div class="large-2 columns">
                    <?php echo form_label('Start date'); ?>
                    <div class="row collapse">
                        <?php
                            echo form_input(array('id'=>'date_added','name'=>'date_added'),set_value('date_added'),($is_original?'':' readonly="readonly"'));

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
                        
                            if (!$is_original)
                                echo form_hidden('date_added',$query->date_added);
                            }
                        ?>
                    </div>
                </div>
                <div class="large-2 columns">
                    <?php echo form_label('Publish date'); ?>
                    <div class="row collapse">
                        <?php
                            echo form_input(array('id'=>'date_finished','name'=>'date_finished'),set_value('date_finished'));

                            if ($query->date_finished!=NULL && substr($query->date_finished,0,4)!='0000')
                            {
                        ?>
                            <script>
                                var queryDate = '<?php echo $query->date_finished; ?>',
                                dateParts = queryDate.match(/(\d+)/g)
                                realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);

                                $('#date_finished').datepicker({ dateFormat: 'yy-mm-dd' });
                                $('#date_finished').datepicker('setDate', realDate);
                            </script>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-1 columns">
                    <?php echo form_label('Hours'); ?>
                    <div class="row collapse">
                        <?php
                            $duration = $query->duration;
                            if ($duration!=NULL)
                            {
                                $hours   = substr($query->duration,0,2);
                                $minutes = substr($query->duration,3,2);
                                $seconds = substr($query->duration,6,2);
                            }
                            else
                            {
                                $hours = $minutes = $seconds = '00';
                            }

                            echo form_input(array('id'=>'hours','name'=>'hours'),set_value('hours',$hours),($is_original?'':' readonly="readonly"'));
                        ?>
                    </div>
                </div>
                <div class="large-1 columns">
                    <?php echo form_label('Minutes'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'minutes','name'=>'minutes'),set_value('minutes',$minutes),($is_original?'':' readonly="readonly"')); ?>
                    </div>
                </div>
                <div class="large-1 columns">
                    <?php echo form_label('Seconds'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'seconds','name'=>'seconds'),set_value('seconds',$seconds),($is_original?'':' readonly="readonly"')); ?>
                    </div>
                </div>
                <div class="large-3 columns">
                    <?php echo form_label('Forum'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'forum_thread','name'=>'forum_thread'),set_value('title',$query->forum_thread)); ?>
                    </div>
                </div>
                <div class="large-3 columns">
                    <?php echo form_label('Notes'); ?>
                    <div class="row collapse">
                        <?php echo form_input(array('id'=>'notes','name'=>'notes'),set_value('notes',$query->notes)); ?>
                    </div>
                </div>
                <div class="large-3 columns">
                    <?php echo form_label('Comments'); ?>
                    <div class="row collapse">
                        <?php echo form_textarea(array('id'=>'comments','name'=>'comments'),set_value('comments',$query->comments)); ?>
                    </div>
                </div>
            </div>

            <?php
            if ($is_original)
            {
            ?>
            <div class="row">
                <div class="large-2 columns">
                    <?php echo form_label('Transcribers'); ?>
                    <div class="row">
                        <div class="small-9 columns">
                            <select id="transcribers" name="transcribers" class="medium">
                            <?php
                                echo '<option value="0"></option>';
                                foreach ($team_members as $item):
                                    echo '<option value="' . $item->id . '">' . $item->name . '</option>';
                                endforeach;
                            ?>
                            </select>

                        </div>
                        <div class="small-3 columns">
                            <button type="button" onclick="register_transcriber()" class="small button secondary">Add</button>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="small-9 columns">
                            <?php 
                            echo form_input(array('id'=>'transcriber_name','name'=>'transcriber_name'),''); ?>
                            ?>
                        </div>
                        <div class="small-3 columns">
                            <button type="button" onclick="register_transcriber_name()" class="small button secondary">Add</button>
                        </div>
                    </div>
                    
                    <div class="row collapse">
                        <div class="small-12 columns">
                            <p>
                            <?php
                            $transcribers = $this->users_model->get_users_by_function($query->id,FUNCTION_TRANSCRIBE);

                            if (!empty($transcribers))
                            {
                                echo '<ul class="circle" style="font-size:14px">';
                                foreach ($transcribers as $item):
                                    echo '<li>'.$item.'</li>';
                                endforeach;
                                echo '</ul>';
                            }
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="large-2 columns">
                    <?php echo form_label('First Proofreaders'); ?>
                    <div class="row">
                        <div class="small-9 columns">
                            <select id="first_proof" name="first_proof" class="medium">
                            <?php
                                echo '<option value="0"></option>';
                                foreach ($team_members as $item):
                                    echo '<option value="' . $item->id . '">' . $item->name . '</option>';
                                endforeach;
                            ?>
                            </select>

                        </div>
                        <div class="small-3 columns">
                            <button type="button" onclick="register_first_proof()" class="small button secondary">Add</button>
                        </div>
                    </div>
                    <div class="row collapse">
                        <div class="small-12 columns">
                            <p>
                            <?php
                            $first_proofs = $this->users_model->get_users_by_function($query->id,FUNCTION_FIRST_PROOFREAD);

                            if (!empty($first_proofs))
                            {
                                echo '<ul class="circle" style="font-size:14px">';
                                foreach ($first_proofs as $item):
                                    echo '<li>'.$item.'</li>';
                                endforeach;
                                echo '</ul>';
                            }
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="large-2 columns">
                    <?php echo form_label('Timestamp'); ?>
                    <div class="row">
                        <div class="small-9 columns">
                            <select id="timestamp" name="timestamp" class="medium">
                            <?php
                                echo '<option value="0"></option>';
                                foreach ($team_members as $item):
                                    echo '<option value="' . $item->id . '">' . $item->name . '</option>';
                                endforeach;
                            ?>
                            </select>

                        </div>
                        <div class="small-3 columns">
                            <button type="button" onclick="register_timestamp()" class="small button secondary">Add</button>
                        </div>
                    </div>
                    <div class="row collapse">
                        <div class="small-12 columns">
                            <p>
                            <?php
                            $timestamp = $this->users_model->get_users_by_function($query->id,FUNCTION_TIMESTAMP);

                            if (!empty($timestamp))
                            {
                                echo '<ul class="circle" style="font-size:14px">';
                                foreach ($timestamp as $item):
                                    echo '<li>'.$item.'</li>';
                                endforeach;
                                echo '</ul>';
                            }
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="large-2 columns">
                    <?php echo form_label('Final Proofreaders'); ?>
                    <div class="row">
                        <div class="small-9 columns">
                            <select id="final_proofs" name="final_proofs" class="medium">
                            <?php
                                echo '<option value="0"></option>';
                                foreach ($team_members as $item):
                                    echo '<option value="' . $item->id . '">' . $item->name . '</option>';
                                endforeach;
                            ?>
                            </select>

                        </div>
                        <div class="small-3 columns">
                            <button type="button" onclick="register_final_proof()" class="small button secondary">Add</button>
                        </div>
                    </div>
                    <div class="row collapse">
                        <div class="small-12 columns">
                            <p>
                            <?php
                            $final_proofs = $this->users_model->get_users_by_function($query->id,FUNCTION_FINAL_PROOFREAD);

                            if (!empty($final_proofs))
                            {
                                echo '<ul class="circle" style="font-size:14px">';
                                foreach ($final_proofs as $item):
                                    echo '<li>'.$item.'</li>';
                                endforeach;
                                echo '</ul>';
                            }
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="large-2 columns">
                    <?php echo form_label('Final Review'); ?>
                    <div class="row">
                        <div class="small-9 columns">
                            <select id="final_review" name="final_review" class="medium">
                            <?php
                                echo '<option value="0"></option>';
                                foreach ($team_members as $item):
                                    echo '<option value="' . $item->id . '">' . $item->name . '</option>';
                                endforeach;
                            ?>
                            </select>

                        </div>
                        <div class="small-3 columns">
                            <button type="button" onclick="register_final_review()" class="small button secondary">Add</button>
                        </div>
                    </div>
                    <div class="row collapse">
                        <div class="small-12 columns">
                            <p>
                            <?php
                            $final_review = $this->users_model->get_users_by_function($query->id,FUNCTION_FINAL_REVIEW);

                            if (!empty($final_review))
                            {
                                echo '<ul class="circle" style="font-size:14px">';
                                foreach ($final_review as $item):
                                    echo '<li>'.$item.'</li>';
                                endforeach;
                                echo '</ul>';
                            }
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="large-2 columns">
                </div>
            </div>
            <?php
            }
            else
            {
            ?>
            <div class="row">
                <div class="large-4 columns">
                    <?php echo form_label('Translators'); ?>
                    <div class="row">
                        <div class="small-9 columns">
                            <select id="translators" name="translators" class="medium">
                            <?php
                                echo '<option value="0"></option>';
                                foreach ($team_members as $item):
                                    echo '<option value="' . $item->id . '">' . $item->name . '</option>';
                                endforeach;
                            ?>
                            </select>

                        </div>
                        <div class="small-3 columns">
                            <button type="button" onclick="register_translator()" class="small button secondary">Add</button>
                        </div>
                    </div>
                    <div class="row collapse">
                        <div class="small-12 columns">
                            <p>
                            <?php
                            $translators = $this->users_model->get_users_by_function($query->id,FUNCTION_TRANSLATE);

                            if (!empty($translators))
                            {
                                echo '<ul class="circle" style="font-size:14px">';
                                foreach ($translators as $item):
                                    echo '<li>'.$item.'</li>';
                                endforeach;
                                echo '</ul>';
                            }
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="large-4 columns">
                    <?php echo form_label('Proofreaders'); ?>
                    <div class="row">
                        <div class="small-9 columns">
                            <select id="proofreaders" name="proofreaders" class="medium">
                            <?php
                                echo '<option value="0"></option>';
                                foreach ($team_members as $item):
                                    echo '<option value="' . $item->id . '">' . $item->name . '</option>';
                                endforeach;
                            ?>
                            </select>

                        </div>
                        <div class="small-3 columns">
                            <button type="button" onclick="register_proofreader()" class="small button secondary">Add</button>
                        </div>
                    </div>
                    <div class="row collapse">
                        <div class="small-12 columns">
                            <p>
                            <?php
                            $proofreaders = $this->users_model->get_users_by_function($query->id,FUNCTION_PROOFREAD);

                            if (!empty($proofreaders))
                            {
                                echo '<ul class="circle" style="font-size:14px">';
                                foreach ($proofreaders as $item):
                                    echo '<li>'.$item.'</li>';
                                endforeach;
                                echo '</ul>';
                            }
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="large-4 columns">
                </div>
            </div>

            <?php
            }
            ?>
            <div class="row collapse">
                <div class="small-3 small-centered columns">
                    <?php
                        $states = unserialize(MEDIA_STATES);
                        echo '<p><span class="label">Current status: <strong>'. $states[$query->state] .'</strong></span></p>';
                    ?>
                </div>
            </div>

            <?php
            if ($is_original)
            {
            ?>
            <div class="row collapse">
                <div class="large-6 small-centered columns">
                    <?php
                        echo '<div class="button-bar" style="margin: 0px auto;width: 50%;">';
                        echo '<ul class="button-group round .even-2">';

                        if ($query->state>STATE_OPEN_FOR_TRANSCRIPTION && $query->state<STATE_FINAL_REVIEW_COMPLETED )
                            echo '<li><a href="#" id="previous_stage" class="small button secondary">Previous stage</a></li>';
                        if ($query->state<STATE_FINAL_REVIEW_COMPLETED)
                            echo '<li><a href="#" id="next_stage" class="small button secondary">Next stage</a></li>';
                        if ($query->state==STATE_FINAL_REVIEW_COMPLETED)
                            echo '<li><a href="#" id="release_video" class="small button success">Release translation</a></li>';
                        echo '</ul>';
                        echo '</div>'
                    ?>
                </div>
            </div>
            <?php
            }
            else
            {
            ?>
            <div class="row collapse">
                <div class="large-6 small-centered columns">
                    <?php
                        echo '<div class="button-bar" style="margin: 0px auto;width: 50%;">';
                        echo '<ul class="button-group round .even-2">';

                        if ($query->state>STATE_OPEN_FOR_TRANSLATION && $query->state<STATE_POSTED)
                            echo '<li><a href="#" id="previous_stage" class="small button secondary">Previous stage</a></li>';
                        if ($query->state<STATE_POSTED)
                            echo '<li><a href="#" id="next_stage" class="small button secondary">Next stage</a></li>';
                        if ($query->state==STATE_POSTED)
                            echo '<li><a href="#" id="move_repository" class="small button success">Move to repository</a></li>';
                        echo '</ul>';
                        echo '</div>'
                    ?>
                </div>
            </div>
            <?php
            }
            ?>

            <br/>

            <?php
            echo form_hidden('id',$query->id);
            echo form_hidden('duration');
            ?>

            <div class="row">
                <div class="small-3 columns">
                    <?php echo form_submit('submit','Edit Video','class="button"'); ?>
                </div>
            </div>

            <?php
                echo form_close();
            ?>
        </fieldset>
    </div>
</div>

<script>
    $('#previous_stage').click(function(){
        window.location = "<?php  echo base_url().'languages/'.$team->shortname.'/videos/go_to_stage/'.$query->id.'/'.$query->state.'/-1';?>";
        return false;
    });
    $('#next_stage').click(function(){
        window.location = "<?php  echo base_url().'languages/'.$team->shortname.'/videos/go_to_stage/'.$query->id.'/'.$query->state.'/1';?>";
        return false;
    });
    $('#release_video').click(function(){
        window.location = "<?php echo base_url().'languages/'.$team->shortname.'/videos/release_video/'.$query->id;?>";
        return false;
    });
    $('#move_repository').click(function(){
        window.location = "<?php echo base_url().'languages/'.$team->shortname.'/videos/go_to_stage/'.$query->id.'/'.$query->state.'/1';?>";
        return false;
    });

    function register_transcriber()
    {
        var e = document.getElementById("transcribers").value;
        if (e!=0)
            window.location = "<?php echo base_url().'languages/'.$team->shortname.'/videos/register_member_function/'.$query->id.'/'.FUNCTION_TRANSCRIBE.'/';?>"+e+"";
    }
    function register_first_proof()
    {
        var e = document.getElementById("first_proof").value;
        if (e!=0)
            window.location = "<?php echo base_url().'languages/'.$team->shortname.'/videos/register_member_function/'.$query->id.'/'.FUNCTION_FIRST_PROOFREAD.'/';?>"+e+"";
    }
    function register_timestamp()
    {
        var e = document.getElementById("timestamp").value;
        if (e!=0)
            window.location = "<?php echo base_url().'languages/'.$team->shortname.'/videos/register_member_function/'.$query->id.'/'.FUNCTION_TIMESTAMP.'/';?>"+e+"";
    }
    function register_final_proof()
    {
        var e = document.getElementById("final_proofs").value;
        if (e!=0)
            window.location = "<?php echo base_url().'languages/'.$team->shortname.'/videos/register_member_function/'.$query->id.'/'.FUNCTION_FINAL_PROOFREAD.'/';?>"+e+"";
    }
    function register_final_review()
    {
        var e = document.getElementById("final_review").value;
        if (e!=0)
            window.location = "<?php echo base_url().'languages/'.$team->shortname.'/videos/register_member_function/'.$query->id.'/'.FUNCTION_FINAL_REVIEW.'/';?>"+e+"";
    }
    function register_translator()
    {
        var e = document.getElementById("translators").value;
        if (e!=0)
            window.location = "<?php echo base_url().'languages/'.$team->shortname.'/videos/register_member_function/'.$query->id.'/'.FUNCTION_TRANSLATE.'/';?>"+e+"";
    }
    function register_proofreader()
    {
        var e = document.getElementById("proofreaders").value;
        if (e!=0)
            window.location = "<?php echo base_url().'languages/'.$team->shortname.'/videos/register_member_function/'.$query->id.'/'.FUNCTION_PROOFREAD.'/';?>"+e+"";
    }

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