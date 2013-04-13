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

/** TEAMS **/
define('TEAM_CANNOT_TRANSCRIBE', 0);
define('TEAM_CAN_TRANSCRIBE', 1);    

/** MEDIAS **/

define('STATE_DELETED', -1);
define('STATE_OPEN_FOR_TRANSCRIPTION', 0);
define('STATE_OPEN_FOR_FIRST_PROOFREADING', 1);
define('STATE_TIMESTAMP_SHIFTING', 2);
define('STATE_FINAL_PROOFREADING', 3);
define('STATE_WAINTING_FINAL_REVIEW', 4);
define('STATE_FINAL_REVIEW_COMPLETED', 5);
define('STATE_LOCKED_AND_AVAILABLE', 6);

define('STATE_OPEN_FOR_TRANSLATION', 7);
define('STATE_OPEN_FOR_PROOFREADING', 8);
define('STATE_FINALIZED', 9);
define('STATE_POSTED', 10);
define('STATE_REPOSITORY', 11);
define('STATE_ON_HOLD', 12);
define('STATE_UNDER_ERROR_REVIEW', 13);
define('STATE_UNDER_ERROR_REPAIR', 14);

define('MEDIA_STATES', serialize (array ( -1 => "Deleted",
                                          0 => "Open for transcription",
                                          1 => "Open for first proofreading",
                                          2 => "Time-stamp shifting",
                                          3 => "Final proofreading",
                                          4 => "Wainting final review",
                                          5 => "Final review completed",
                                          6 => "Locked and available",
                                          7 => "Open for translation",
                                          8 => "Open for proofreading",
                                          9 => "Finalized",
                                          10 => "Posted",
                                          11 => "Repository",
                                          12 => "On hold",
                                          13 => "Under error review",                                          
                                          14 => "Under error repair" )));

define('MEDIA_CATEGORIES', serialize (array ( 1 => "TZM",
                                              2 => "PJ",
                                              3 => "TVP",
                                              4 => "COMM",
                                              5 => "EXT" )));

define('MEDIA_TYPE_VIDEO', 0);
define('MEDIA_TYPE_TEXT', 1);
define('MEDIA_TYPE_AUDIO', 2);

define('MEDIA_SUBTYPE_UNKNOWN', 0);


/** MEMBERS **/

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




//define('TRANSLATOR_ACTIVE', 0);
//define('TRANSLATOR_INACTIVE', -1);    

//
//
//define('TEXT_STATE_DELETED', -1);
//define('TEXT_STATE_OPEN_TO_TRANSLATION', 0);
//define('TEXT_STATE_TRANSLATING', 1);
//define('TEXT_STATE_PROOFREADING', 2);
//define('TEXT_STATE_READY_TO_POST', 3);
//define('TEXT_STATE_POSTED', 4);
//define('TEXT_STATE_REPOSITORY', 5);
//
//define('VIDEO_STATES', serialize (array ( 0 => "Open to translation", 
//                                          1 => "Translating", 
//                                          2 => "Proofreading", 
//                                          3 => "Ready to post", 
//                                          4 => "Posted", 
//                                          5 => "Repository" )));
//
//define('VIDEO_TYPES', serialize (array ( 0 => "TZM",
//                                         1 => "PJ",
//                                         2 => "TVP",
//                                         3 => "COMM",
//                                         4 => "EXT" )));
//
//
//define('TEXT_STATES', serialize (array ( 0 => "Open to translation", 
//                                         1 => "Translating", 
//                                         2 => "Proofreading", 
//                                         3 => "Ready to post", 
//                                         4 => "Posted", 
//                                         5 => "Repository" )));
//
//
//
//define('DEFAULT_USER', 'admin');
//define('DEFAULT_PASSWORD', 'admin');


/* End of file constants.php */
/* Location: ./application/config/constants.php */