<?php

class User_cookie_model extends CI_model{

    public function __construct(){
    }

    public function insert_token($user_id, $cookie_token){
        $data=array(
            'user_id' => $user_id,
            'cookie_token' => $cookie_token,
        );

        return $this->db->insert('user_cookies', $data);
    }

    public function get_by_token($cookie_token){
        $query=$this->db
                ->select('user_id')
                ->from('user_cookies')
                ->where('cookie_token', $cookie_token)
                ->get();
                
        return $query->row();
    }
}