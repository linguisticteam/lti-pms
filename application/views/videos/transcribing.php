
<div style="width: 100%">
<?php
$member_id = 0;

if (!empty($userinfo))
{
    $member_id = $userinfo->id;
}

$team = $this->session->userdata('teamdata');


$tmpl = array(
    'table_open' => '<table class="sortable" style="width: 100%">',
    'table_close' => '</table>'
);

$this->table->set_template($tmpl);

if ($this->authorization->check_authorization($member_id, AUTH_CAN_VIEW_START_DATE))
{
    $this->table->set_heading('#','Cat','Title','Status','Duration','Forum','Transcript','Proof-1',
                          'Timeshift','Post-Proof','Final Rev','Location','Start Date',"","");
}
else
{
    $this->table->set_heading('#','Cat','Title','Status','Duration','Forum','Transcript','Proof-1',
                              'Timeshift','Post-Proof','Final Rev','Location',"","");
}


$states = unserialize(MEDIA_STATES);
$categories = unserialize(MEDIA_CATEGORIES);

if (!empty($videos_inprogress))
{
    $videos = array();

    if (is_array($videos_inprogress))
        $videos = $videos_inprogress;
    else
        array_push($videos, $videos_inprogress);

    foreach ($videos as $item):

        $transcribers = merge_members($this->members_model->get_members_name_by_function($item->id,FUNCTION_TRANSCRIBE),
                                      $this->members_model->get_out_members_by_function($item->id,FUNCTION_TRANSCRIBE));

        $first_proofs = merge_members($this->members_model->get_members_name_by_function($item->id,FUNCTION_FIRST_PROOFREAD),
                                      $this->members_model->get_out_members_by_function($item->id,FUNCTION_FIRST_PROOFREAD));

        $time_stamper = merge_members($this->members_model->get_members_name_by_function($item->id,FUNCTION_TIMESTAMP),
                                      $this->members_model->get_out_members_by_function($item->id,FUNCTION_TIMESTAMP));

        $final_proofs = merge_members($this->members_model->get_members_name_by_function($item->id,FUNCTION_FINAL_PROOFREAD),
                                      $this->members_model->get_out_members_by_function($item->id,FUNCTION_FINAL_PROOFREAD));

        $final_review = merge_members($this->members_model->get_members_name_by_function($item->id,FUNCTION_FINAL_REVIEW),
                                      $this->members_model->get_out_members_by_function($item->id,FUNCTION_FINAL_REVIEW));


        /*$w_l = (!empty($item->working_location)) ? '<a href="'.$item->working_location.'" target="_blank">go</a> -
                                                    <a href="' . $item->working_location . '/transcriptInformation/" target="_blank">info</a>' : '';*/

        //for now we will hardcode the link to the page in the Portal that embeds the Working Location URLs
		//we also append proj_id=[id] to the URL. There is a small script in /components/com_wrapper/views/wrapper/tmpl that takes this GET variable and echo's the dotsub location that corresponds to the ID
		$portal_location = "https://members.linguisticteam.org/englishteam-working-locations";
		$w_l =	'<a href="' . $portal_location . '?proj_id=' . $item->id . '" target="_blank">go</a> -
		<a href="' . $item->working_location . '/transcriptInformation/" target="_blank">info</a>';
        
        $s_d = (substr($item->date_added, 0, 4) == '0000') ? '': $item->date_added;

        $f = (!empty($item->forum_thread)) ? '<a href="'.$item->forum_thread.'" target="_blank">go</a>' : '';
        $n = (!empty($item->notes)) ? '<a href="'.$item->notes.'" target="_blank">go</a>' : '';
        
        if (strlen($item->id) == 1)
            $id_item = '#'.'000'.$item->id;
        else if (strlen($item->id) == 2)
            $id_item = '#'.'00'.$item->id;
        else if (strlen($item->id) == 3)
            $id_item = '#'.'0'.$item->id;
        else
            $id_item = '#'.$item->id;    
        
        $this->table->add_row(
                              // id
                              $id_item,
                              // category
                              $categories[$item->category],
                              // title
                              '<span title="'.$item->description.'"><a href="'.$item->original_location.'" target="_blank"><strong>'.$item->title.'</strong></a></span>',
                              // state
                              '<img src="'.base_url().'/img/state_'.$item->state.'.png">',
                              // duration
                              '<div style="white-space: nowrap;"><small>'.$item->duration.'</small></div>',
                              // forum
                              $f,
                              // transcribers
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_ENGLISH_TRANSCRIBE))?
                              (count($transcribers)>1?implode(", ", '<small>'.$transcribers.'</small>')." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_TRANSCRIBE.'/transcribing','I\'m going in', array('class' => 'tiny button', 'onclick' => 'open_forum(\''.$item->forum_thread.'\')')):
                                                                    '<small>'.$transcribers[0].'</small>'." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_TRANSCRIBE.'/transcribing','I\'m going in', array('class' => 'tiny button', 'onclick' => 'open_forum(\''.$item->forum_thread.'\')'))):
                              (count($transcribers)>1?implode(", ", $transcribers):$transcribers[0]),
                              // first proof
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_ENGLISH_FIRST_PROOF && $item->state >= STATE_OPEN_FOR_FIRST_PROOFREADING))?
                              (count($first_proofs)>1?implode(", ", '<small>'.$first_proofs.'</small>')." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_FIRST_PROOFREAD.'/transcribing','I\'m going in', array('class' => 'tiny button', 'onclick' => 'open_forum(\''.$item->forum_thread.'\')')):
                                                                    '<small>'.$first_proofs[0].'</small>'." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_FIRST_PROOFREAD.'/transcribing','I\'m going in', array('class' => 'tiny button', 'onclick' => 'open_forum(\''.$item->forum_thread.'\')'))):
                              (count($first_proofs)>1?implode(", ", $first_proofs):$first_proofs[0]),
                              // time stamp
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_ENGLISH_TIMESTAMP && $item->state >= STATE_TIMESTAMP_SHIFTING))?
                              (count($time_stamper)>1?implode(", ", '<small>'.$time_stamper.'</small>')." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_TIMESTAMP.'/transcribing','I\'m going in', array('class' => 'tiny button', 'onclick' => 'open_forum(\''.$item->forum_thread.'\')')):
                                                                    '<small>'.$time_stamper[0].'</small>'." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_TIMESTAMP.'/transcribing','I\'m going in', array('class' => 'tiny button', 'onclick' => 'open_forum(\''.$item->forum_thread.'\')'))):
                              (count($time_stamper)>1?implode(", ", $time_stamper):$time_stamper[0]),
                              // post proof
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_ENGLISH_POST_PROOF && $item->state >= STATE_FINAL_PROOFREADING))?
                              (count($final_proofs)>1?implode(", ", '<small>'.$final_proofs.'</small>')." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_FINAL_PROOFREAD.'/transcribing','I\'m going in', array('class' => 'tiny button', 'onclick' => 'open_forum(\''.$item->forum_thread.'\')')):
                                                                    '<small>'.$final_proofs[0].'</small>'." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_FINAL_PROOFREAD.'/transcribing','I\'m going in', array('class' => 'tiny button', 'onclick' => 'open_forum(\''.$item->forum_thread.'\')'))):
                              (count($final_proofs)>1?implode(", ", $final_proofs):$final_proofs[0]),
                              // final review
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_ENGLISH_FINAL_REVIEW && $item->state >= STATE_WAINTING_FINAL_REVIEW))?
                              (count($final_review)>1?implode(", ", '<small>'.$final_review.'</small>')." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_FINAL_REVIEW.'/transcribing','I\'m going in', array('class' => 'tiny button', 'onclick' => 'open_forum(\''.$item->forum_thread.'\')')):
                                                                    '<small>'.$final_review[0].'</small>'." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_FINAL_REVIEW.'/transcribing','I\'m going in!', array('class' => 'tiny button', 'onclick' => 'open_forum(\''.$item->forum_thread.'\')'))):
                              (count($final_review)>1?implode(", ", $final_review):$final_review[0]),
                              // working location
                              $w_l,
                              // start date
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_VIEW_START_DATE))?
                              '<div style="white-space: nowrap;"><small>'.$s_d.'</small></div>':'',
                              // state select
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_EDIT_VIDEO))?
                              '<div style="text-align: right">'.
                              (($item->state > STATE_OPEN_FOR_TRANSCRIPTION && $item->state < STATE_FINAL_REVIEW_COMPLETED) ?
                              '<button type="button"  onclick="previous_stage('.$item->id.','.$item->state.')" class="tiny button secondary"><img src="'.base_url().'/img/back.png" alt="Back"></button>':"").
                              (($item->state < STATE_FINAL_REVIEW_COMPLETED) ?
                              '<button type="button"  onclick="next_stage('.$item->id.','.$item->state.')" class="tiny button secondary"><img src="'.base_url().'/img/forward.png" alt="Back"></button>':"").
                              (($item->state == STATE_FINAL_REVIEW_COMPLETED) ?
                              '<button type="button"  onclick="release_video('.$item->id.')" class="tiny button success">Release</button>':"").
                              '</div>' : "",
                              // edit
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_EDIT_VIDEO))?
                              (anchor('languages/'.$team->langcode.'/videos/edit/'.$item->id,'<img src="'.base_url().'/img/edit.png" alt="edit">')):
                              (""));

    endforeach;

    echo $this->table->generate();
}
else
{
    echo '<div class="alert-box ">There is no videos in transcribing!</div>';
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
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode; ?>/videos/go_to_stage_table/" + id + "/" + state + "/-1/transcribing";
        return false;
    }
    function next_stage(id,state)
    {
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode; ?>/videos/go_to_stage_table/" + id + "/" + state + "/1/transcribing";
        return false;
    }
    function release_video(id)
    {
        window.location = "<?php echo base_url() . 'languages/' . $team->langcode; ?>/videos/release_video_table/" + id + "/transcribing";
        return false;
    }
    function open_forum(url)
    {
        window.open(url);
    }
</script>
