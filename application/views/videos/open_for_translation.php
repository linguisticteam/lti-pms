<?php
$member_id = 0;

if (!empty($userinfo))
{
    $member_id = $userinfo->id;
}

$team = $this->session->userdata('teamdata');

$tmpl = array(
    'table_open' => '<table class="sortable">',
    'table_close' => '</table>'
);

$this->table->set_template($tmpl);
$this->table->set_heading('#','Title','Status','Cat','Priority','Location','Duration','Start date',
                          'Transcribers','First Proofreading.','Timestamp','Post-Proofreading','Final review','Forum','Notes',"");

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

        $w_l = (!empty($item->working_location)) ? '<a href="'.$item->working_location.'" target="_blank">go</a> -
                                                    <a href="' . $item->working_location . '/transcriptInformation/" target="_blank">info</a>' : '';

        $s_d = (substr($item->date_added, 0, 4) == '0000') ? '': $item->date_added;

        $f = (!empty($item->forum_thread)) ? '<a href="'.$item->forum_thread.'" target="_blank">go</a>' : '';
        $n = (!empty($item->notes)) ? '<a href="'.$item->notes.'" target="_blank">go</a>' : '';

        $this->table->add_row('#'.$item->id,
                              '<span title="'.$item->description.'"><a href="'.$item->original_location.'" target="_blank"><strong>'.$item->title.'</strong></a></span>',
                              $states[$item->state], $categories[$item->category],
                              '<div style="white-space: nowrap">'.
                              '<input name="tipo'.$i.'" type="radio" class="star required" value="1" disabled="disabled" '.($item->priority==1?'checked="checked"':'').'/>'.
                              '<input name="tipo'.$i.'" type="radio" class="star" value="2" disabled="disabled" '.($item->priority==2?'checked="checked"':'').'/>'.
                              '<input name="tipo'.$i.'" type="radio" class="star" value="3" disabled="disabled" '.($item->priority==3?'checked="checked"':'').'/>'.
                              '<input name="tipo'.$i.'" type="radio" class="star" value="4" disabled="disabled" '.($item->priority==4?'checked="checked"':'').'/>'.
                              '<input name="tipo'.$i.'" type="radio" class="star" value="5" disabled="disabled" '.($item->priority==5?'checked="checked"':'').'/>'
                              .'</div>',
                              $w_l,
                              '<div style="white-space: nowrap">'.$item->duration.'</div>', '<div style="white-space: nowrap">'.$s_d.'</div>',
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_ENGLISH_TRANSCRIBE))?
                              (count($transcribers)>1?implode(", ", $transcribers)." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_TRANSCRIBE.'/open_for_translation','I did it!'):
                                                      $transcribers[0]." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_TRANSCRIBE.'/open_for_translation','I did it!')):
                              (count($transcribers)>1?implode(", ", $transcribers):$transcribers[0]),
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_ENGLISH_FIRST_PROOF))?
                              (count($first_proofs)>1?implode(", ", $first_proofs)." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_FIRST_PROOFREAD.'/open_for_translation','I did it!'):
                                                      $first_proofs[0]." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_FIRST_PROOFREAD.'/open_for_translation','I did it!')):
                              (count($first_proofs)>1?implode(", ", $first_proofs):$first_proofs[0]),
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_ENGLISH_TIMESTAMP))?
                              (count($time_stamper)>1?implode(", ", $time_stamper)." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_TIMESTAMP.'/open_for_translation','I did it!'):
                                                      $time_stamper[0]." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_TIMESTAMP.'/open_for_translation','I did it!')):
                              (count($time_stamper)>1?implode(", ", $time_stamper):$time_stamper[0]),
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_ENGLISH_POST_PROOF))?
                              (count($final_proofs)>1?implode(", ", $final_proofs)." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_FINAL_PROOFREAD.'/open_for_translation','I did it!'):
                                                      $final_proofs[0]." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_FINAL_PROOFREAD.'/open_for_translation','I did it!')):
                              (count($final_proofs)>1?implode(", ", $final_proofs):$final_proofs[0]),
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_ENGLISH_FINAL_REVIEW))?
                              (count($final_review)>1?implode(", ", $final_review)." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_FINAL_REVIEW.'/open_for_translation','I did it!'):
                                                      $final_review[0]." <br/>".anchor('languages/'.$team->langcode.'/videos/register_function/'.$item->id.'/'.FUNCTION_FINAL_REVIEW.'/open_for_translation','I did it!')):
                              (count($final_review)>1?implode(", ", $final_review):$final_review[0]),
                              $f, $n,
                              ($this->authorization->check_authorization($member_id, AUTH_CAN_EDIT_VIDEO))?
                              (anchor('languages/'.$team->langcode.'/videos/edit/'.$item->id,'[Edit]')):
                              (""));
        $i++;
    endforeach;

    echo $this->table->generate();
}
else
{
    echo '<div class="alert-box ">There is no videos opened for translation! Why?!</div>';
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