<?php
defined('BASEPATH') or exit('No direct script access allowed');

// USER CONTROLLER
$route['users']='users/index';
$route['register']='users/create';

// LOGIN/LOGOUT
$route['login']='login_controller/index';
$route['logout']='login_controller/logout';

// DEFAULT
$route['default_controller'] = 'pages_controller/view';
$route['(:any)'] = 'pages_controller/view/$1';

$route['translate_uri_dashes'] = FALSE;
$route['404_override'] = '';
