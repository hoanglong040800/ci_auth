<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_controller extends CI_Controller
{
    public function index()
    {
        if($this->session->userdata('logged_in')){
            redirect('/');
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
                    // $this->remember_me($query);
                }

                $this->create_session($query);
            }
        }

        echo json_encode($res);
    }

    public function remember_me($query){
        $this->load->helper('cookie');
        $this->load->helper('date');
        $format = "%Y-%m-%d %h:%i";

        $token=md5(uniqid(rand(),TRUE));
        $login_timestamp = mdate($format);

        echo $login_timestamp;
    }

    public function create_session($query){
        $this->session->sess_expiration=1;
        $this->session->set_userdata('logged_in', TRUE);
        $this->session->set_userdata('email', $query->email);
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
}
