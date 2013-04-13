<?php

$team = $this->session->userdata('teamdata');
$member_role = $this->session->userdata('member_role');

$this->table->set_heading('#','Title','Status','Cat','Priority','Location','Duration','Start date','Publish date',
                          'Translators','Proofreaders','Forum','Notes',"");

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

        $translators  = $this->members_model->get_members_name_by_function($item->id,FUNCTION_TRANSLATE);
        $proofreaders = $this->members_model->get_members_name_by_function($item->id,FUNCTION_PROOFREAD);

        $w_l = (!empty($item->working_location)) ? '<a href="'.$item->working_location.'" target="_blank">go</a> -
                                                    <a href="' . $item->working_location . '/transcriptInformation/" target="_blank">info</a>' : '';

        $s_d = (substr($item->date_added, 0, 4) == '0000') ? '': $item->date_added;
        $s_f = (substr($item->date_finished, 0, 4) == '0000') ? '': $item->date_finish;

        $f = (!empty($item->forum_thread)) ? '<a href="'.$item->forum_thread.'" target="_blank">go</a>' : '';
        $n = (!empty($item->notes)) ? '<a href="'.$item->notes.'" target="_blank">go</a>' : '';

        $this->table->add_row($i, 
                              '<span title="'.$item->description.'"><a href="'.$item->original_location.'" target="_blank"><strong>'.$item->title.'</strong></a></span>', 
                              $states[$item->state], $categories[$item->category],
                              '<input name="tipo'.$i.'" type="radio" class="star required" value="1" disabled="disabled" '.($item->priority==1?'checked="checked"':'').'/>'.
                              '<input name="tipo'.$i.'" type="radio" class="star" value="2" disabled="disabled" '.($item->priority==2?'checked="checked"':'').'/>'.
                              '<input name="tipo'.$i.'" type="radio" class="star" value="3" disabled="disabled" '.($item->priority==3?'checked="checked"':'').'/>'.
                              '<input name="tipo'.$i.'" type="radio" class="star" value="4" disabled="disabled" '.($item->priority==4?'checked="checked"':'').'/>'.
                              '<input name="tipo'.$i.'" type="radio" class="star" value="5" disabled="disabled" '.($item->priority==5?'checked="checked"':'').'/>',
                              $w_l,
                              $item->duration, $s_d, $s_f,
                              ($member_role >= MEMBER_ROLE_TRANSLATOR)?
                              (count($translators)>1?implode(", ", $translators):$translators[0]." <br/>".anchor('languages/'.$team->shortname.'/videos/register_function/'.$item->id.'/'.FUNCTION_TRANSLATE.'/in_progress','I did it!')):
                              (count($translators)>1?implode(", ", $translators):$translators[0]),
                              ($member_role >= MEMBER_ROLE_TRANSLATOR)?
                              (count($proofreaders)>1?implode(", ", $proofreaders):$proofreaders[0]." <br/>".anchor('languages/'.$team->shortname.'/videos/register_function/'.$item->id.'/'.FUNCTION_PROOFREAD.'/in_progress','I did it!')):
                              (count($proofreaders)>1?implode(", ", $proofreaders):$proofreaders[0]),
                              $f, $n,
            //                "<span title='$item->comments'>read</span>",
                              ($member_role >= MEMBER_ROLE_COORDINATION)?  
                              (anchor('languages/'.$team->shortname.'/videos/edit/'.$item->id,'[Edit]')):
                              (""));
        $i++;
    endforeach;

    echo $this->table->generate();
}
else
{
    echo '<div class="alert-box ">There is no videos ready to be posted! Proofreaders, we need your help!</div>';
}