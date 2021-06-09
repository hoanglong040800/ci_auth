<?php
defined('BASEPATH') or exit('No direct script access allowed');

// USER CONTROLLER
$route['users']='users/index';
$route['register']='users/create';
$route['login']='login/index';

// DEFAULT
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';

$route['translate_uri_dashes'] = FALSE;
$route['404_override'] = '';
