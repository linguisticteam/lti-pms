<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';

//$route['languages/(:any)/(:any)/inprogress'] = "languages/inprogress";
//$route['languages/(:any)/(:any)/open_for_translation'] = "languages/open_for_translation";
//$route['languages/(:any)/videos/inprogress'] = "videos/inprogress";
//$route['languages/(:any)/videos/open_for_translation'] = "videos/open_for_translation";
//$route['languages/:any'] = "languages";

$route['languages/(:any)/videos/(:any)/(:any)/(:any)'] = "videos/$2/$3/$4";
$route['languages/(:any)/videos/(:any)/(:any)'] = "videos/$2/$3";
$route['languages/(:any)/videos/(:any)'] = "videos/$2";
$route['languages/(:any)/members/(:any)/(:any)'] = "members/$2/$3";
$route['languages/(:any)/members/(:any)'] = "members/$2";
$route['languages/(:any)/members'] = "members";
//$route['languages/(:any)/users/(:any)/(:any)'] = "users/$2/$3";
//$route['languages/(:any)/users/(:any)'] = "users/$2";
//$route['languages/(:any)/users'] = "users";
$route['languages/(:any)/configuration'] = "languages/configuration";
$route['languages/(:any)'] = "languages";

$route['user_language'] = "user_language";
$route['videos/previous_stage'] = "videos/previous_stage";
$route['videos/next_stage'] = "videos/next_stage";



//languages/english-team/videos/inprogress
//$route['languages/([a-z]+)'] = "languages";
//echo $route['languages/english-team'];

//$route['products/([a-z]+)/(\d+)'] = "$1/id_$2";


/* End of file routes.php */
/* Location: ./application/config/routes.php */