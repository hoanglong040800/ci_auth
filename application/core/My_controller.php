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

            else if ($this->check_cookie_token()){
                redirect('/');
            }
        }

        public function check_cookie_token(){
            $cookie_token = get_cookie('remember_me_token');

            if($cookie_token){
                $query = $this->user_cookie_model->get_by_token($cookie_token);
                
                $query_all = $this->user_model->get_one($query -> user_id);
                $this->create_session($query_all);

                return TRUE;
            }

            return FALSE;
        }

        public function create_session($query){
            $sess_data = array(
                'id' => $query->id,
                'email' => $query->email,
                'role' => $query->role,
            );
    
            $this->session->set_userdata('sess_data', $sess_data);
        }
    }