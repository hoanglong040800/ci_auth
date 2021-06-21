<?php
class User_model extends CI_Model
{
    public function get_all()
    {
        $query = $this->db
            ->select()
            ->from('users')
            ->order_by('id', 'DESC')
            ->get();
        return $query->result_array();
    }

    public function get_one($id)
    {
        $query = $this->db
            ->select()
            ->from('users')
            ->where('id', $id)
            ->get();

        return $query->row();
    }

    public function get_by_email($email){
        $query=$this->db
            ->select()
            ->from('users')
            ->where('email',$email)
            ->get();
            
        return $query->row();
    }

    public function authen($email, $password)
    {
        $query = $this->db
            ->select()
            ->from('users')
            ->where('email', $email)
            ->where('password', $password)
            ->get();

        return $query->row();
    }

    public function insert($email, $password, $role='subscriber')
    {
        $data = array(
            'email' => $email,
            'password' => $password,
            'role' => $role,
        );

        return $this->db->insert('users', $data);
    }

    public function update()
    {
        $data = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('pswd'),
        );

        $this->db
            ->where('id', $this->input->post('id'))
            ->update('users', $data);
    }

    public function delete_one($id)
    {
        $this->db
            ->from('users')
            ->where('id', $id)
            ->delete();
        return true;
    }

    public function __construct()
    {
    }
}
