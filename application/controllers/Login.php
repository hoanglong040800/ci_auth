<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
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
        );


        $this->form_validation->set_rules('email', 'Email', "required|trim|valid_email");
        $this->form_validation->set_rules('pswd', 'Password', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $res['email'] = form_error('email');
            $res['pswd'] = form_error('pswd');
            echo json_encode($res);
            exit();
        } else {
            $query = $this->user_model->authen($this->input->post('email'), $this->input->post('pswd'));

            if (empty($query)) {
                $res['auth'] = 'Your email or password is invalid';
                echo json_encode($res);
                exit();
            } else {
                echo json_encode($res);
                exit();
            }
        }
    }
}
