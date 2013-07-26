<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Authorization
{
    var $CI; //create CI instance so we can access libraries

    function __construct()
    {
        $this->CI = & get_instance();
    }

    public function check_authorization($member_id, $authorization)
    {
        if ($member_id==0)
            return FALSE;
        
        $auths = $this->CI->authorization_model->get_authorization($member_id);

        foreach ($auths as $value)
        {
//            log_message('debug', 'Some variable was correctly set'.$value->group_id );
            
            if ($authorization == AUTH_CAN_EDIT_GROUP && $value->group_id == GROUP_COORDINATION_GROUP )
                return TRUE;
            
            if ($authorization == AUTH_CAN_ADD_VIDEO && ($value->group_id == GROUP_ADMIN_GROUP || $value->group_id == GROUP_SUPER_USERS))            
                return TRUE;
            
            if ($authorization == AUTH_CAN_EDIT_VIDEO && $value->group_id == GROUP_COORDINATION_GROUP )
                return TRUE;

            if ($authorization == AUTH_CAN_ENGLISH_TRANSCRIBE &&
                    ($value->group_id == GROUP_ENGLISH_PROOFREADER || $value->group_id == GROUP_ENGLISH_TRANSCRIBER || $value->group_id == GROUP_TIMESTAMP_ADJUSTER) )
                return TRUE;

            if ($authorization == AUTH_CAN_ENGLISH_FIRST_PROOF &&
                    ($value->group_id == GROUP_ENGLISH_PROOFREADER) )
                return TRUE;

            if ($authorization == AUTH_CAN_ENGLISH_TIMESTAMP &&
                    ($value->group_id == GROUP_TIMESTAMP_ADJUSTER) )
                return TRUE;

            if ($authorization == AUTH_CAN_ENGLISH_POST_PROOF &&
                    ($value->group_id == GROUP_ENGLISH_PROOFREADER) )
                return TRUE;

            if ($authorization == AUTH_CAN_ENGLISH_FINAL_REVIEW &&
                    ($value->group_id == GROUP_FINAL_REVIEWER) )
                return TRUE;

            if ($authorization == AUTH_CAN_TEAM_TRANSLATE_VIDEO &&
                    ($value->group_id == GROUP_TRANSLATION_PROOFREADER || $value->group_id == GROUP_TRANSLATOR || $value->group_id == GROUP_COORDINATION_GROUP) )
                return TRUE;

            if ($authorization == AUTH_CAN_TEAM_PROOFREAD_VIDEO &&
                    ($value->group_id == GROUP_COORDINATION_GROUP || $value->group_id == GROUP_TRANSLATOR) )
                return TRUE;

            if ($authorization == AUTH_CAN_EDIT_USERS_LANGUAGES &&
                    ($value->group_id == GROUP_COORDINATION_GROUP ) )
                return TRUE;
            
            if ($authorization == AUTH_CAN_VIEW_START_DATE &&
                    ($value->group_id == GROUP_COORDINATION_GROUP ) )
                return TRUE;

        }

        return FALSE;
    }
}

/* End of file Someclass.php */