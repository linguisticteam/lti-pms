<?php

$team = $this->session->userdata('teamdata');

$active_members = $this->members_model->count_members_by_language($team->id);

$v_stage_00 = $this->medias_model->count_videos_stage($team->id,STATE_OPEN_FOR_TRANSCRIPTION);
$v_stage_01 = $this->medias_model->count_videos_stage($team->id,STATE_OPEN_FOR_FIRST_PROOFREADING);
$v_stage_02 = $this->medias_model->count_videos_stage($team->id,STATE_TIMESTAMP_SHIFTING);
$v_stage_03 = $this->medias_model->count_videos_stage($team->id,STATE_FINAL_PROOFREADING);
$v_stage_04 = $this->medias_model->count_videos_stage($team->id,STATE_WAINTING_FINAL_REVIEW);
$v_stage_05 = $this->medias_model->count_videos_stage($team->id,STATE_FINAL_REVIEW_COMPLETED);
$v_stage_06 = $this->medias_model->count_videos_stage($team->id,STATE_LOCKED_AND_AVAILABLE);

$v_stage_07 = $this->medias_model->count_videos_stage($team->id,STATE_OPEN_FOR_TRANSLATION);
$v_stage_08 = $this->medias_model->count_videos_stage($team->id,STATE_OPEN_FOR_PROOFREADING);
$v_stage_09 = $this->medias_model->count_videos_stage($team->id,STATE_FINALIZED);
$v_stage_10 = $this->medias_model->count_videos_stage($team->id,STATE_POSTED);
$v_stage_11 = $this->medias_model->count_videos_stage($team->id,STATE_REPOSITORY);
$v_stage_12 = $this->medias_model->count_videos_stage($team->id,STATE_ON_HOLD);
$v_stage_13 = $this->medias_model->count_videos_stage($team->id,STATE_UNDER_ERROR_REVIEW);
$v_stage_14 = $this->medias_model->count_videos_stage($team->id,STATE_UNDER_ERROR_REPAIR);

echo '<h3>'.$team->name.'</h3>';

//echo '<p>'.$team->description.'</p>'; // row removed

echo '<h4>Team status:</h4>';

$this->table->add_row('Active members', '<strong>'.$active_members.'</strong>');

if ($team->team_permissions==TEAM_CAN_TRANSCRIBE)
{    
    $this->table->add_row('Videos in transcribing', '<strong>'.$v_stage_00.'</strong>');
    $this->table->add_row('Videos open for first proofreading', '<strong>'.$v_stage_01.'</strong>');
    $this->table->add_row('Videos in timestamp shifting', '<strong>'.$v_stage_02.'</strong>');
    $this->table->add_row('Videos in post-proofreading', '<strong>'.$v_stage_03.'</strong>');
    $this->table->add_row('Videos waiting final review', '<strong>'.$v_stage_04.'</strong>');
    $this->table->add_row('Videos on final review completed', '<strong>'.$v_stage_05.'</strong>');
    $this->table->add_row('Videos locked and available', '<strong>'.$v_stage_06.'</strong>');
}    
else
{
    $this->table->add_row('Videos open for translation', '<strong>'.$v_stage_07.'</strong>');
    $this->table->add_row('Videos in progress', '<strong>'.$v_stage_08.'</strong>');
    $this->table->add_row('Videos ready to post', '<strong>'.$v_stage_09.'</strong>');
    $this->table->add_row('Videos posted', '<strong>'.$v_stage_10.'</strong>');
    $this->table->add_row('Videos in the repository', '<strong>'.$v_stage_11.'</strong>');
    $this->table->add_row('Videos on hold', '<strong>'.$v_stage_12.'</strong>');   
    $this->table->add_row('Under error review', '<strong>'.$v_stage_13.'</strong>');   
    $this->table->add_row('Under error repair', '<strong>'.$v_stage_14.'</strong>');   
}  

echo $this->table->generate();

?>
