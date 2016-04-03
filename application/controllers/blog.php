<?php
class Blog extends CI_Controller
{
    function index()
    {

        $this->load->model('data_model');

        $data['results']=$this->data_model->getAll();
        $this->load->view('blog_view',$data);
    }
}