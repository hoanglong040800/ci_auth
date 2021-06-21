<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_controller extends My_Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        parent::check_sess();

        // DATA
        $data['title'] = 'Login';

        // VIEW
        $data['main_content'] = 'pages/forms/login_view';
        $this->load->view('templates/minified_template', $data);
    }

    public function process()
    {
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
                    $this->remember_me($query);
                }

                parent::create_session($query);
            }
        }

        echo json_encode($res);
    }

    public function remember_me($query){
        $this->load->helper('string');
        $cookie_token = random_string('alnum', 20);

        $cookie_data = array(
            'name'=> 'remember_me_token',
            'value'=> $cookie_token,
            'expire'=> 10,
            'secure' => TRUE,
            'httponly' => TRUE,
        );

        $this->user_cookie_model->insert_token($query->id, $cookie_token);

        set_cookie($cookie_data);
    }

    public function logout(){
        $this->session->sess_destroy();
        delete_cookie('remember_me_token');
        redirect('login');
    }
}
