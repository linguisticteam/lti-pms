<?php

function counting($var)
{
    if ($var == FALSE)
    {
        return 0;
    }
    
    else if (is_array($var))
    {
        return count($var);
    }
    
    else
    {
        return 1;
    }
}
    
$team = $this->session->userdata('teamdata');

$active_users    = counting($this->users_model->get_users_by_language($team->id));
$v_transcribing  = counting($this->medias_model->get_videos_transcribing($team->id));
$v_open_trans    = counting($this->medias_model->get_videos_open_for_translation($team->id));
$v_in_progress   = counting($this->medias_model->get_videos_in_progress($team->id));
$v_ready_to_post = counting($this->medias_model->get_videos_ready_to_post($team->id));
$v_posted        = counting($this->medias_model->get_videos_posted($team->id));
$v_repository    = counting($this->medias_model->get_videos_repository($team->id));
$v_on_hold       = counting($this->medias_model->get_videos_on_hold($team->id));

echo '<h3>'.$team->name.'</h3>';

echo '<p>'.$team->description.'</p>';

echo '<h4>Team status:</h4>';

 $this->table->add_row('Active members', '<strong>'.$active_users.'</strong>');
 $this->table->add_row('Videos in transcribing', '<strong>'.$v_transcribing.'</strong>');
 $this->table->add_row('Videos open for translation', '<strong>'.$v_open_trans.'</strong>');
 $this->table->add_row('Videos in progress', '<strong>'.$v_in_progress.'</strong>');
 $this->table->add_row('Videos ready to post', '<strong>'.$v_ready_to_post.'</strong>');
 $this->table->add_row('Videos posted', '<strong>'.$v_posted.'</strong>');
 $this->table->add_row('Videos in the repository', '<strong>'.$v_repository.'</strong>');
 $this->table->add_row('Videos on hold', '<strong>'.$v_on_hold.'</strong>');

echo $this->table->generate();



?>
