<?php
class Users extends CI_Controller{


    public function index(){
        $data['title']='Account Manager';

        $data['users'] = $this->user_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/account_manager', $data);
        $this->load->view('templates/footer');       
    }

    public function create(){
        $data['title']='Register';
        
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('pswd', 'Password', 'required');
        $this->form_validation->set_rules('cf_pswd', 'Confirmation Password', 'required|matches[pswd]');
        $this->form_validation->set_rules('terms','Terms and Condition','required');

        if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('pages/register', $data);
        }

        else {
            $this->user_model->save();
            $this->load->view('templates/header');
            $this->load->view('pages/formsuccess');
        }
    }
}