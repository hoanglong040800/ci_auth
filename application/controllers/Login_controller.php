<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_controller extends CI_Controller
{
    public function index()
    {
        if($this->session->userdata('logged_in')){
            redirect('/');
        }

        if ( get_cookie('remember_me_token') ){
            // get mail from cookie
            $this->create_session(
                get_cookie('remember_me_token', TRUE)
            );

        }

        $data['title'] = 'Login';
        $data['main_content'] = 'pages/forms/login_view';
        $this->load->view('templates/minify_template', $data);
    }

    public function process()
    {
        // $req = json_decode($this->input->raw_input_stream);

        $res = array(
            'email' => '',
            'pswd' => '',
            'auth' => '',
            'remember'=> $this->input->post('remember'),
        );


        $this->form_validation->set_rules('email', 'Email', "required|trim|valid_email");
        $this->form_validation->set_rules('pswd', 'Password', 'required|trim');


        if ($this->form_validation->run() === FALSE) {
            $res['email'] = form_error('email');
            $res['pswd'] = form_error('pswd');
        }
        
        else {
            $query = $this->user_model->authen($this->input->post('email'), $this->input->post('pswd'));

            if (empty($query)) {
                $res['auth'] = 'Your email or password is invalid';
            }

            else { 
                if ($res['remember']){
                    $this->remember_me($query->email);
                }

                $this->create_session($query->email);
            }
        }

        echo json_encode($res);
    }

    public function remember_me($email){
        $this->load->helper('date');

        // $format = "%Y-%m-%d %h:%i";
        // $token = md5(uniqid(rand(),TRUE));
        // $login_timestamp = mdate($format);

        $cookie_data = array(
            'name'=> 'remember_me_token',
            'value'=> $email,
            'expire'=> 30,
            'secure' => TRUE,
            'httponly' => TRUE,
        );

        set_cookie($cookie_data);

        // echo var_export(get_cookie('remember_me_token', TRUE));
    }

    public function create_session($email){
        $this->session->sess_expiration = 15;
        $this->session->set_userdata('logged_in', TRUE);
        $this->session->set_userdata('email', $email);
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
}
