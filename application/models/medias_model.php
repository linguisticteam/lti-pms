<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Medias_model extends CI_Model
{
    public function get_medias($id = NULL)
    {
        if ( $id != NULL )
        {
            $this->db->where('id',$id);
        }

        $query = $this->db->get('pms_medias');

        $appended_medias_array = array();

        if($query->num_rows() > 0)
        {
            $appended_medias_array = $query->result();
        }
        else
        {
            return FALSE;
        }

        if ($query->num_rows() > 1)
        {
            return $appended_medias_array;
        }
        else
        {
            return $appended_medias_array[0];
        }
    }
    
    public function get_videos_transcribing($team_id)
    {
        $where = 'project_language_id ='.$team_id.' AND type ='.MEDIA_TYPE_VIDEO.' AND state ='.STATE_OPEN_FOR_TRANSCRIPTION.' OR state='.STATE_IN_TRANSCRIPTION.
                 ' OR state='.STATE_OPEN_FOR_FIRST_PROOFREADING.' OR state='.STATE_TIMESTAMP_SHIFTING.
                 ' OR state='.STATE_FINAL_PROOFREADING.' OR state='.STATE_WAINTING_FINAL_REVIEW.' OR state='.STATE_FINAL_REVIEW_COMPLETED. ' ORDER BY state';
        $this->db->where($where);

        return $this->get_medias();
    }

    public function get_videos_open_for_translation($team_id)
    {
        $where = 'project_language_id ='.$team_id.' AND type ='.MEDIA_TYPE_VIDEO.' AND state ='.STATE_LOCKED_AND_AVAILABLE;
        $this->db->where($where);

        return $this->get_medias();
    }

    public function get_videos_in_progress($team_id)
    {
        $where = 'project_language_id ='.$team_id.' AND type ='.MEDIA_TYPE_VIDEO.' AND state ='.STATE_OPEN_FOR_TRANSLATION.' OR state='.STATE_IN_TRANSLATION.
                ' OR state='.STATE_OPEN_FOR_PROOFREADING.' OR state='.STATE_IN_PROOFREADING;
        $this->db->where($where);

        return $this->get_medias();
    }

    public function get_videos_ready_to_post($team_id)
    {
        $where = 'project_language_id ='.$team_id.' AND type ='.MEDIA_TYPE_VIDEO.' AND state ='.STATE_FINALIZED;
        $this->db->where($where);

        return $this->get_medias();
    }

    public function get_videos_posted($team_id)
    {
        $where = 'project_language_id ='.$team_id.' AND type ='.MEDIA_TYPE_VIDEO.' AND state ='.STATE_POSTED;
        $this->db->where($where);

        return $this->get_medias();
    }

    public function get_videos_repository($team_id)
    {
        $where = 'project_language_id ='.$team_id.' AND type ='.MEDIA_TYPE_VIDEO.' AND state ='.STATE_REPOSITORY;
        $this->db->where($where);

        return $this->get_medias();
    }

    public function get_videos_on_hold($team_id)
    {
        $where = 'project_language_id ='.$team_id.' AND type ='.MEDIA_TYPE_VIDEO.' AND state ='.STATE_ON_HOLD. ' OR state='.STATE_UNDER_ERROR_REVIEW. ' OR state='.STATE_UNDER_ERROR_REPAIR;
        $this->db->where($where);

        return $this->get_medias();
    }
    
    public function count_videos_stage($team_id,$stage)
    {
        $where = 'project_language_id ='.$team_id.' AND type ='.MEDIA_TYPE_VIDEO.' AND state ='.$stage;
        $this->db->where($where);
        $this->db->from('pms_medias');        

        return $this->db->count_all_results();
    }

    public function insert_video($data=NULL)
    {
        if ($data!=NULL)
        {
            $this->db->insert('pms_medias',$data);

            $team = $this->session->userdata('teamdata');
            $this->session->set_userdata('video_added','Video added successfully');

            redirect('languages/'.$team->langcode.'/videos/add');
        }
    }

    public function update_video($data=NULL,$condition=NULL)
    {
        if ($data!=NULL && $condition!=NULL)
        {
            $this->db->update('pms_medias',$data,$condition);

            $team = $this->session->userdata('teamdata');
            $this->session->set_userdata('video_edited','Video edited successfully');

            redirect('languages/'.$team->langcode.'/videos/edit/'.$condition['id']);
        }
    }

    public function register_function($media_id, $function, $member_id=NULL)
    {
        //get member
        if ($member_id==NULL)
        {
            $userinfo = $this->joomlauser->get_user();
            $member_id = $userinfo->id;
        }
        
        $this->workgroups_model->register_workgroup($media_id, $member_id, $function);
    }
    
    public function unregister_function($media_id, $function, $member_id)
    {        
        if (is_numeric($member_id)) // deleting users by id
        {
            $this->db->delete('pms_workgroups', array('media_id' => $media_id, 'function' => $function, 'member_id' => $member_id )); 
        }
        else // deleting users by name
        {
            $this->db->delete('pms_workgroups', array('media_id' => $media_id, 'function' => $function, 'name' => $member_id )); 
        }
    }
    
//    public function previous_stage($media_id)
//    {
//        $state = $this->medias_model->get_medias($media_id)->state;
//        
//        if ($state > STATE_OPEN_FOR_TRANSCRIPTION)
//        {
//            $data = array('state'=>$state-1);
//            $this->db->where('id',$media_id);
//            $this->db->update('pms_medias',$data);
//        }
//    }
//    
//    public function next_stage($media_id)
//    {
//        $state = $this->medias_model->get_medias($media_id)->state;
//        
//        if ($state < STATE_REPOSITORY)
//        {
//            $data = array('state'=>$state+1);
//            $this->db->where('id',$media_id);
//            $this->db->update('pms_medias',$data);
//        }
//    }

    public function go_to_stage($media_id, $state, $inc)
    {
        if (is_numeric($inc))
        {
            $data = array('state'=>$state+$inc);
            $this->db->where('id',$media_id);
            $this->db->update('pms_medias',$data);
        }
    }

    public function release_translations($media_id)
    {
        // get teams
        $teams = $this->language_teams_model->get_language_teams();

        $media = $this->get_medias($media_id);
        
        foreach($teams as $team):
            if ($team->id != $media->original_language_id)
            {
                echo 'team_id = '. $team->id .'<br/>';
                $data = array(
                            'title' => $media->title,
                            'description' => $media->description,
                            'originator' => $media->originator,
                            'producer' => $media->producer,
                            'original_language_id' => $media->original_language_id,
                            'project_language_id' => $team->id,
                            'state' => STATE_OPEN_FOR_TRANSLATION,
                            'type' => $media->type,
                            'subtype' => $media->subtype,
                            'category' => $media->category,
                            'parent_id' => $media->id,
                            'priority' => $media->priority,
                            'working_location' => $media->working_location,
                            'original_location' => $media->original_location,
                            'publish_location' => '',
                            'repo_storage_location' => $media->repo_storage_location,
                            'repo_distribution_location' => $media->repo_distribution_location,
                            'duration' => $media->duration,
                            'number_of_words' => $media->number_of_words,
                            'date_added' => $media->date_added,
                            'date_finished' => '',
                            'forum_thread' => $media->forum_thread,
                            'comments' => '',
                            'notes' => $media->notes,
                         );

                $this->db->insert('pms_medias',$data);
            }
        endforeach;
        echo '---- fim ----';
    }
}