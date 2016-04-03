<?php
class Message extends CI_Controller
{
    public function index()
    {
        $data=array();
        $this->load->model('message_model');
        $messages=$this->message_model->getAll();
        $data['messages']=$messages;
        $this->load->view('admin/message/listing',$data);
    }
}