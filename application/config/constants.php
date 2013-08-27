<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| Application constants
|--------------------------------------------------------------------------
|
*/

/************ TEAMS ************/


define('TEAM_NOT_ACTIVE', 0);
define('TEAM_ACTIVE', 1);
define('TEAM_CAN_TRANSCRIBE', 2);

define('SOCIAL_NETWORK_YOUTUBE', 1);
define('SOCIAL_NETWORK_FACEBOOK_GROUP', 2);
define('SOCIAL_NETWORK_FACEBOOK_PAGE', 3);
define('SOCIAL_NETWORK_TWITTER', 4);
define('SOCIAL_NETWORK_WEBSITE', 5);
define('SOCIAL_NETWORK_FORUM', 6);

define('SOCIAL_NETWORKS', serialize (array ( 1 => "Youtube Channel",
                                             2 => "Facebook Group",
                                             3 => "Facebook Page",
                                             4 => "Twitter",
                                             5 => "Website",
                                             6 => "Forum" )));


/************ MEDIAS ************/


define('STATE_DELETED', -1);
define('STATE_OPEN_FOR_TRANSCRIPTION', 0);
define('STATE_IN_TRANSCRIPTION', 1);
define('STATE_OPEN_FOR_FIRST_PROOFREADING', 2);
define('STATE_TIMESTAMP_SHIFTING', 3);
define('STATE_FINAL_PROOFREADING', 4);
define('STATE_WAINTING_FINAL_REVIEW', 5);
define('STATE_FINAL_REVIEW_COMPLETED', 6);
define('STATE_LOCKED_AND_AVAILABLE', 7);

define('STATE_OPEN_FOR_TRANSLATION', 8);
define('STATE_IN_TRANSLATION', 9);
define('STATE_OPEN_FOR_PROOFREADING', 10);
define('STATE_IN_PROOFREADING', 11);
define('STATE_FINALIZED', 12);
define('STATE_POSTED', 13);
define('STATE_REPOSITORY', 14);
define('STATE_ON_HOLD', 15);
define('STATE_UNDER_ERROR_REVIEW', 16);
define('STATE_UNDER_ERROR_REPAIR', 17);

define('MEDIA_STATES', serialize (array ( -1 => "Deleted",
                                          0 => "Open for transcription",
                                          1 => "In transcription",
                                          2 => "Open for first proofreading",
                                          3 => "Time-stamp shifting",
                                          4 => "Post-proofreading",
                                          5 => "Waiting final review",
                                          6 => "Final review completed",
                                          7 => "Locked and available",
                                          8 => "Open for translation",
                                          9 => "In translation",
                                          10 => "Open for proofreading",
                                          11 => "In proofreading",
                                          12 => "Finalized",
                                          13 => "Posted",
                                          14 => "Repository",
                                          15 => "On hold",
                                          16 => "Under error review",
                                          17 => "Under error repair" )));

define('MEDIA_CATEGORIES', serialize (array ( 1 => "TZM",
                                              2 => "PJ",
                                              3 => "TVP",
                                              4 => "COMM",
                                              5 => "EXT" )));

define('MEDIA_TYPE_VIDEO', 0);
define('MEDIA_TYPE_TEXT', 1);
define('MEDIA_TYPE_AUDIO', 2);

define('MEDIA_SUBTYPE_UNKNOWN', 0);


/************ MEMBERS ************/

define('GROUP_COORDINATION_GROUP',      16);

define('GROUP_LANGUAGE_TEAM_MEMBER',    9);
define('GROUP_ENGLISH_TRANSCRIBER',     10);
define('GROUP_ENGLISH_PROOFREADER',     11);
define('GROUP_TIMESTAMP_ADJUSTER',      22);
define('GROUP_FINAL_REVIEWER',          14);

define('GROUP_TRANSLATOR',              12);
define('GROUP_TRANSLATION_PROOFREADER', 13);

define('GROUP_SUPPORT_GROUPS',          15);
define('GROUP_PROJECT_COORDINATOR',     17);
define('GROUP_TECHNICAL_TEAM_MEMBER',   18);
define('GROUP_PR_GROUP_MEMBER',         19);
define('GROUP_DEVELOPMENT_GROUP',       20);
define('GROUP_ADMIN_GROUP',             21);
define('GROUP_PR_GROUP_COORDINATOR',    23);
define('GROUP_TECHTEAM_COORDINATOR',    24);

define('GROUP_SUPER_USERS',             8);


define('AUTH_CAN_EDIT_GROUP',           1);
define('AUTH_CAN_ADD_VIDEO',            2);
define('AUTH_CAN_EDIT_VIDEO',           3);

define('AUTH_CAN_ENGLISH_TRANSCRIBE',   4);
define('AUTH_CAN_ENGLISH_FIRST_PROOF',  5);
define('AUTH_CAN_ENGLISH_TIMESTAMP',    6);
define('AUTH_CAN_ENGLISH_POST_PROOF',   7);
define('AUTH_CAN_ENGLISH_FINAL_REVIEW', 8);

define('AUTH_CAN_TEAM_TRANSLATE_VIDEO', 9);
define('AUTH_CAN_TEAM_PROOFREAD_VIDEO', 10);

define('AUTH_CAN_EDIT_USERS_LANGUAGES', 11);

define('AUTH_CAN_VIEW_START_DATE',      12);





define('FUNCTION_TRANSCRIBE', 0);
define('FUNCTION_FIRST_PROOFREAD', 1);
define('FUNCTION_TIMESTAMP', 2);
define('FUNCTION_FINAL_PROOFREAD', 3);
define('FUNCTION_FINAL_REVIEW', 4);
define('FUNCTION_TRANSLATE', 5);
define('FUNCTION_PROOFREAD', 6);
define('FUNCTION_POSTED', 7);

define('MEMBER_STATE_INACTIVE', -1);
define('MEMBER_STATE_WAINTING_CONFIRMATION', 0);
define('MEMBER_STATE_ACTIVE', 1);

define('MEMBER_STATES', serialize (array ( -1 => "Inactive",
                                            0 => "Waiting Confirmation",
                                            1 => "Active")));

define('MEMBER_ROLE_TRANSLATOR', 1);
define('MEMBER_ROLE_TRANSCRIBER', 2);
define('MEMBER_ROLE_COORDINATION', 3);
define('MEMBER_ROLE_ADMINISTRATOR', 4);

define('MEMBER_ROLES', serialize (array ( 1 => "Translator",
                                          2 => "Transcriber",
                                          3 => "Coordination",
                                          4 => "Administrator")));


/* End of file constants.php */
/* Location: ./application/config/constants.php */