<?php

class Register_controller extends My_controller{
    public function __construct(){
        parent::__construct();
        parent::check_sess();
    }

    public function index()
    {
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
}