<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Login';
        $data['error'] = '';

        $data['main_content'] = 'pages/forms/login_view';
        $this->load->view('templates/minify_template', $data);
    }

    public function process($data)
    {

    }
}
