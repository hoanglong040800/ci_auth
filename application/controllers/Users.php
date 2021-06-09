<?php
defined('BASEPATH') OR exit('No direct script access allowed');  

class Users extends CI_Controller{


    public function index(){
        $data['title']='Account Manager';

        $data['users'] = $this->user_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/account_manager', $data);      
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
            $this->load->view('pages/forms/register_view', $data);
        }

        else {
            $this->user_model->save();
            $this->load->view('templates/header', $data);
            $this->load->view('pages/sd/formsuccess');
        }
    }

    public function modify($id){
        $data['title']='Modify User';
        $data['user']=$this->user_model->get_one($id);
        
        if (empty($data['user'])){
            show_404();
        }

        else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'Email', "required|valid_email");
            $this->form_validation->set_rules('pswd', 'Password', 'required');
            $this->form_validation->set_rules('cf_pswd', 'Confirmation Password', 'required|matches[pswd]');
    
            if ($this->form_validation->run() === FALSE){
                $this->load->view('templates/header', $data);
                $this->load->view('pages/forms/modify_user', $data);
            }
    
            else {
                $this->user_model->update();
                $this->load->view('templates/header', $data);
                $this->load->view('pages/sd/formsuccess');
            }
        }
    }

    public function delete($id){
        $data['user']=$this->user_model->get_one($id);
        
        if (empty($data['user'])){
            show_404();
        }

        $this->user_model->delete_one($id);
        redirect($_SERVER['HTTP_REFERER']);
    }
}