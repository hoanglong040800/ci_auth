<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_controller extends My_Controller
{
    public function index()
    {
        if(empty($this->session->userdata('sess_data'))){
            redirect('login');
        }

        $data['title'] = 'Users Manager';
        $data['users'] = $this->user_model->get_all();

        $data['sess_email']=$this->session->get_userdata('email');

        $data['main_content'] = 'pages/users_view';
        $this->load->view('templates/main_template', $data);
    }

    public function create()
    {
        parent::check_sess();

        $data['title'] = 'Register';
        $data['main_content'] = 'pages/forms/register_view';
        $this->load->view('templates/minified_template', $data);
    }

    public function process()
    {
        // $req = json_decode($this->input->raw_input_stream);

        $res = array(
            'email' => '',
            'pswd' => '',
            'cf_pswd' => '',
            'terms' => '',
            'is_valid' => FALSE,
        );


        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('pswd', 'Password', 'required');
        $this->form_validation->set_rules('cf_pswd', 'Confirmation Password', 'required|matches[pswd]');
        $this->form_validation->set_rules('terms', 'Terms and Condition', 'required');

        if($this->form_validation->run() === FALSE){
            $res['email'] = form_error('email');
            $res['pswd'] = form_error('pswd');
            $res['cf_pswd'] = form_error('cf_pswd');
            $res['terms'] = form_error('terms');
        }

        else {
            $res['is_valid'] = TRUE;
            $this->user_model->insert(
                $this->input->post('email'),
                $this->input->post('pswd')
            );
        }

        echo json_encode($res);
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
