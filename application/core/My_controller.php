<?php
    class My_controller extends CI_Controller{
        public function auth(){
            if($this->session->userdata('sess_data')){
                return;
            }

            redirect('login');
        }

        public function check_sess(){
            if($this->session->userdata('sess_data')){
                redirect('/');
            }
        }
    }