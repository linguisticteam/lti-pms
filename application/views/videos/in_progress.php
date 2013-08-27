<div style="width: 100%">
<?php
$member_id = 0;

if (!empty($userinfo))
{
    $member_id = $userinfo->id;
}

$team = $this->session->userdata('teamdata');

$tmpl = array(
    'table_open' => '<table class="sortable" width="100%">',
    'table_close' => '</table>'
);

$this->table->set_template($tmpl);
$this->table->set_heading('#','Title','Status','Cat','Location','Duration','Start date',
                          'Translators','Proofreaders','Forum',"","");

$states = unserialize(MEDIA_STATES);
$categories = unserialize(MEDIA_CATEGORIES);


if (!empty($videos_inprogress))
{
    $videos = array();
    
    if (is_array($videos_inprogress))
        $videos = $videos_inprogress;
    else
        array_push($videos, $videos_inprogress);

    $i = 1;
    foreach ($videos as $item):

        $translators = merge_members($this->members_model->get_members_name_by_function($item->id,FUNCTION_TRANSLATE), 
                                     $this->members_model->get_out_members_by_function($item->id,FUNCTION_TRANSLATE));
        
        $proofreaders = merge_members($this->members_model->get_members_name_by_function($item->id,FUNCTION_PROOFREAD), 
                                      $this->members_model->get_out_members_by_function($item->id,FUNCTION_PROOFREAD));

        $w_l = (!empty($item->working_location)) ? '<a href="'.$item->working_location.'" target="_blank">go</a> -
                                                    <a href="' . $item->working_location . '/transcriptInformation/" target="_blank">info</a>' : '';

        $s_d = (substr($item->date_added, 0, 4) == '0000') ? '': $item->date_added;

        $f = (!empty($item->forum_thread)) ? '<a href="'.$item->forum_thread.'" target="_blank">go</a>' : '';
        $n = (!empty($item->notes)) ? '<a href="'.$item->notes.'" target="_blank">go</a>' : '';
        
        if (strlen($item->parent_id) == 1)
            $id_item = '#'.'000'.$item->parent_id;
        else if (strlen($item->parent_id) == 2)
            $id_item = '#'.'00'.$item->parent_id;
        else if (strlen($item->parent_id) == 3)
            $id_item = '#'.'0'.$item->parent_id;
        else
            $id_item = '#'.$item->parent_id;  

        $this->table->add_row(
                              // id  
                              $id_item, 
                              // description
                              '<span title="'.$item->description.'"><a href="'.$item->original_location.'" target="_blank"><strong>'.$item->title.'</strong></a></span>', 
                              // state
                              '<img src="'.base_url().'/img/state_'.$item->state.'.png">',
                              // category
                              $categories[$item->category],
                              // priority
//                              '<div style="white-space: nowrap">'.
//                              '<input name="tipo'.$i.'" type="radio" class="star required" value="1" disabled="disabled" '.($item->priority==1?'checked="checked"':'').'/>'.
//                              '<input name="tipo'.$i.'" type="radio" class="star" value="2" disabled="disabled" '.($item->priority==2?'checked="checked"':'').'/>'.
//                              '<input name="tipo'.$i.'" type="radio" class="star" value="3" disabled="disabled" '.($item->priority==3?'checked="checked"':'').'/>'.
//                              '<input name="tipo'.$i.'" type="radio" class="star" value="4" disabled="disabled" '.($item->priority==4?'checked="checked"':'').'/>'.
//                              '<input name="tipo'.$i.'" type="radio" class="star" value="5" disabled="disabled" '.($item->priority==5?'checked="checked"':'').'/>'
//                              .'</div>',
                              // working location
                              $w_l,
                              // duration
                              '<div style="white-space: nowrap"><small>'.$item->duration.'</small></div>', 
                              // start date
                              '<div style="white-space: nowrap"><small>'.$s_d.'</small></div>',
                              // tranlators
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_TEAM_TRANSLATE_VIDEO))?
                              (count($translators)>1?implode(", ", '<small>'.$translators).'</small>'." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_TRANSLATE.'/in_progress','I\'m going in!', array('class' => 'tiny button', 'onclick' => 'open_forum(\''.$item->forum_thread.'\')')):
                                                     '<small>'.$translators[0].'</small>'." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_TRANSLATE.'/in_progress','I\'m going in!', array('class' => 'tiny button', 'onclick' => 'open_forum(\''.$item->forum_thread.'\')'))):
                              (count($translators)>1?implode(", ", $translators):$translators[0]),
                              // proofreaders
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_TEAM_PROOFREAD_VIDEO))?
                              (count($proofreaders)>1?implode(", ", '<small>'.$proofreaders).'</small>'." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_PROOFREAD.'/in_progress','I\'m going in!', array('class' => 'tiny button', 'onclick' => 'open_forum(\''.$item->forum_thread.'\')')):
                                                      '<small>'.$proofreaders[0].'</small>'." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_PROOFREAD.'/in_progress','I\'m going in!', array('class' => 'tiny button', 'onclick' => 'open_forum(\''.$item->forum_thread.'\')'))):
                              (count($proofreaders)>1?implode(", ", $proofreaders):$proofreaders[0]),
                              // forum
                              $f,
                              // state select
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_EDIT_VIDEO))?  
                              '<div style="text-align: right">'.
                              (($item->state > STATE_OPEN_FOR_TRANSLATION && $item->state < STATE_POSTED) ?
                              '<button type="button"  onclick="previous_stage('.$item->id.','.$item->state.')" class="tiny button secondary"><img src="'.base_url().'/img/back.png" alt="Back"></button>':"").
                              (($item->state < STATE_POSTED) ?
                              '<button type="button"  onclick="next_stage('.$item->id.','.$item->state.')" class="tiny button secondary"><img src="'.base_url().'/img/forward.png" alt="Back"></button>':"").                              
                              '</div>' : "",
                              // edit
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_EDIT_VIDEO))?
                              (anchor('languages/'.$team->langcode.'/videos/edit/'.$item->id,'<img src="'.base_url().'/img/edit.png" alt="edit">')):
                              (""));
        $i++;
    endforeach;

    echo $this->table->generate();
}
else
{
    echo '<div class="alert-box ">There is no videos in progress! Hum... we must to be a new team!</div>';
}

function merge_members($members, $out_members)
{
    if ($out_members)
    {
        foreach ($out_members as $row)
        {
            array_push($members, '*'.urldecode($row) );
        }
    }
    
    return $members;
}

?>

</div>

<script>
    function previous_stage(id,state)
    {
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode; ?>/videos/go_to_stage_table/" + id + "/" + state + "/-1/in_progress";
        return false;
    }
    function next_stage(id,state)
    {
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode; ?>/videos/go_to_stage_table/" + id + "/" + state + "/1/in_progress";
        return false;
    }
    function release_video(id)
    {
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode; ?>/videos/release_video_table/" + id + "/in_progress";
        return false;
    }
    function open_forum(url)
    {
        window.open(url);
    }
</script>