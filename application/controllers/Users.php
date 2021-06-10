<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{


    public function index()
    {
        $data['title'] = 'Account Manager';
        $data['users'] = $this->user_model->get_all();

        $data['main_content'] = 'pages/account_manager';
        $this->load->view('templates/main_template', $data);
    }

    public function create()
    {
        $data['title'] = 'Register';

        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('pswd', 'Password', 'required');
        $this->form_validation->set_rules('cf_pswd', 'Confirmation Password', 'required|matches[pswd]');
        $this->form_validation->set_rules('terms', 'Terms and Condition', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['main_content'] = 'pages/forms/register_view';
            $this->load->view('templates/minify_template', $data);
        } else {
            $this->user_model->save();
            $data['main_content'] = 'pages/sd/formsuccess';
            $this->load->view('templates/minify_template', $data);
        }
    }

    public function modify($id)
    {
        $data['title'] = 'Modify User';
        $data['user'] = $this->user_model->get_one($id);

        if (empty($data['user'])) {
            show_404();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'Email', "required|valid_email");
            $this->form_validation->set_rules('pswd', 'Password', 'required');
            $this->form_validation->set_rules('cf_pswd', 'Confirmation Password', 'required|matches[pswd]');

            if ($this->form_validation->run() === FALSE) {
                $data['main_content'] = 'pages/forms/modify_user';
                $this->load->view('templates/minify_template', $data);
            } else {
                $this->user_model->update();
                $data['main_content'] = 'pages/sd/formsuccess';
                $this->load->view('templates/minify_template', $data);
            }
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
