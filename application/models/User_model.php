<?php
class User_model extends CI_Model
{
    public function get_all()
    {
        $query = $this->db
            ->select()
            ->from('users')
            ->order_by('created_at','DESC')
            ->get();
        return $query->result_array();
    }

    public function save(){
        $data=array(
            'email'=>$this->input->post('email'),
            'password'=>$this->input->post('pswd'),
        );

        return $this->db->insert('users', $data);
    }

    public function __construct()
    {
        $this->load->database();
    }
}
