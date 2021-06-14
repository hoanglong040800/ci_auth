<?php
class Pages_controller extends CI_Controller
{
    public function view($page = 'home')
    {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        if(empty($this->session->userdata('name'))){
            redirect('login');
        }

        $data['title'] = ucfirst($page);
        $data['main_content'] = 'pages/'.$page;
        $this->load->view('templates/main_template', $data);
    }
}
