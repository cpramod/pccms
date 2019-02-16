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
$route['default_controller'] = 'welcome';
$route['login']='auth/login';
$route['user_logout']='auth/user_logout';
//$route['register']='auth/create_user';

$route['profile'] = "profile";
$route['profile/register']='auth/register';
$route['admin']='admin/auth/login';
$route['dashboard'] = "dashboard";
$route['forgot_password']="auth/forgot_password";
//$route['forums']='forum';
$route['jobs'] = 'jobs';
$route['jobs/(:any)'] = 'jobs/$1';
$route['jobs/(:any)/(:any)'] = 'jobs/$1/$2';

//$route['forums/search']='forum/search';
//$route['forum/topics/(:any)']='forum/forumDetail/$1';
//$route['forum/topic/detail/(:any)']='forum/topicDetail/$1';

//$route['admin/blog/category/edit/(:any)'] = 'admin/blog/category_edit/$1';
//$route['admin/blog/category/delete/(:any)'] = 'admin/blog/category_delete/$1';

//$route['admin/blog/tag/edit/(:any)'] = 'admin/blog/tag_edit/$1';
//$route['admin/blog/tag/delete/(:any)'] = 'admin/blog/tag_delete/$1';

// users
$route['auth']      =   "auth";
$route['admin/auth'] = "admin/auth";
$route['admin/auth/(:any)'] = "admin/auth/$1";
$route['admin/auth/(:any)/(:any)'] = "admin/auth/$1/$2";


// extra stuff
//$route['archive/(:any)']					= 'blog/archive/$1';
//$route['category/(:any)'] 					= 'blog/category/$1';
//$route['catalog']                   =   'catalog';
//$route['catalog/(:any)']            =   'catalog/view/$1';

$route['404_override'] = 'Pagenotfound';
$route['pricing'] = "welcome/pricing";
$route['contact']   = "contact";
//$route['blog']  =   'blog/index';

$route['(:any)'] = 'Pagenotfound';

$route['translate_uri_dashes'] = FALSE;



