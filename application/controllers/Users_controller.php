<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_controller extends My_Controller
{
    public function __construct(){
        parent::__construct();
        parent::auth();
    }

    public function index()
    {
        $data['title'] = 'Users Manager';
        $data['users'] = $this->user_model->get_all();

        $data['sess_email']=$this->session->get_userdata('email');

        $data['main_content'] = 'pages/users_view';
        $this->load->view('templates/main_template', $data);
    }

    public function modify($id)
    {
        $data['title'] = 'Modify User';
        $data['user'] = $this->user_model->get_one($id);

        if (empty($data['user'])) {
            show_404();
        } else {
            $this->form_validation->set_rules('email', 'Email', "required|valid_email");
            $this->form_validation->set_rules('pswd', 'Password', 'required');
            $this->form_validation->set_rules('cf_pswd', 'Confirmation Password', 'required|matches[pswd]');

            if ($this->form_validation->run() === FALSE) {
                $data['main_content'] = 'pages/forms/modify_user';
            }
            else {
                $this->user_model->update();
                $data['main_content'] = 'pages/sd/formsuccess';
            }

            $this->load->view('templates/minified_template', $data);
        }
    }

    public function delete($id)
    {
        $data['user'] = $this->user_model->get_one($id);

        if (empty($data['user'])) {
            show_404();
        }

        $this->user_model->delete_one($id);
        redirect($_SERVER['HTTP_REFERER']);
    }
}
