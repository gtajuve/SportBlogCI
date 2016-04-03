<?php
class User_model extends CI_Model
{
    protected $table='users';

    public function validate_login()
    {
        $username=$this->input->post('username');
        $password=sha1($this->input->post('password'));
        $q=$this->db->get_where($this->table,array('username'=>$username,'password'=>$password));
        if($q->num_rows()==1){
            return $q->row();
        }else{
            null;
        }
    }
    public function getAll()
    {
        $q=$this->db->get($this->table);
        foreach($q->result() as $row){
            $result[]=$row;
        }
        return $result;
    }
}