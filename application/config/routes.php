<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['api/events'] = 'pois/index_json';
$route['api/user/login'] = 'auth/login_json';
$route['api/user/signup'] = 'auth/signup_json';
$route['events/delete/(:num)'] = 'pois/delete/$1';
$route['events/publish/(:num)'] = 'pois/publish/$1';
$route['events/unpublish/(:num)'] = 'pois/unpublish/$1';
$route['event/(:num)'] = 'pois/edit_poi/$1';
$route['events/create'] = 'pois/create_poi';
$route['groups/edit/(:num)'] = 'auth/edit_group/$1';
$route['groups/create'] = 'auth/create_group';
$route['users/activate/(:num)'] = 'auth/activate/$1';
$route['users/deactivate/(:num)'] = 'auth/deactivate/$1';
$route['users/create'] = 'auth/create_user';
$route['logout'] = 'auth/logout';
$route['user/(:num)'] = 'auth/edit_user/$1';
$route['users'] = 'auth';
$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
