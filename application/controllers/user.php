<?php
class User extends CI_Controller
{
    public function index()
    {
        $data=array();
        $this->load->model('user_model');
        $users=$this->user_model->getAll();

        $data['users']=$users;
        $this->load->view('admin/user/listing',$data);
    }
}