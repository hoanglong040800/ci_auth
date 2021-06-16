<?php
defined('BASEPATH') or exit('No direct script access allowed');

// REGISTER
$route['users']='users_controller/index';
$route['register']='users_controller/create';
$route['register/process']='users_controller/process';

// ACCOUNT MANAGER
$route['users/modify/(:any)']='users_controller/modify/$1';
$route['users/delete/(:any)']='users_controller/delete/$1';

// LOGIN/LOGOUT
$route['login']='login_controller/index';
$route['login/process']='login_controller/process';
$route['logout']='login_controller/logout';

// DEFAULT
$route['default_controller'] = 'pages_controller/view';
$route['(:any)'] = 'pages_controller/view/$1';

$route['translate_uri_dashes'] = FALSE;
$route['404_override'] = '';
