<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_controller extends My_Controller
{
    public function view($page = 'home')
    {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = ucfirst($page);
        $data['sess_data'] = $this->session->userdata('sess_data');

        $data['main_content'] = 'pages/'.$page;
        $this->load->view('templates/main_template', $data);
    }

    
    public function __construct(){
        parent::__construct();
        parent::auth();
    }
}
