<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_controller extends My_Controller
{
    public function __construct(){
        parent::__construct();
        parent::check_sess();
    }

    public function index()
    {
        // Login controller
        // middleware -> core -> my_controller -> login extends my controller

        
        // Khi em login thanh cong ma nhan  remember:
        // tao value cookie -> value + user id -> luu db
        // cookie lưu chuoi token
        // key -> chuoi 20char + time
        // dung value cookie query user id -> email

        // PK: token dai 20char
        // col: userid
        // timestamp


        $data['title'] = 'Login';
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
                    // $this->remember_me($query);
                }

                $this->create_session($query);
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

    public function create_session($query){
        $sess_data = array(
            'id' => $query->id,
            'email' => $query->email,
            'role' => $query->role,
        );

        $this->session->sess_expiration = 15;
        $this->session->set_userdata('sess_data', $sess_data);
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
}
