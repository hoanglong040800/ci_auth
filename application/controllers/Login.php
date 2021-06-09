<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    public function index(){
        $data['title']='Login';
        $data['error']='';
        
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('pswd', 'Password', 'required');

        if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('pages/forms/login_view', $data);
        }

        else {
            $this->process($data);
        }
    }

    public function process($data){
        $data['user'] = $this->user_model->authen(
            $this->input->post('email'), 
            $this->input->post('pswd')
        );
        
        if(empty($data['user'])){
            $data['error']='Your email or password is invalid';
            $this->load->view('templates/header', $data);
            $this->load->view('pages/forms/login_view', $data);
        }

        else {
            $this->load->view('templates/header', $data);
            $this->load->view('pages/sd/formsuccess');
        }
    }
}