<?php
class Home extends CI_Controller
{
    public function index()
    {
        $data['main_view']='home_view';
        $this->load->view('admin/home_view',$data);
    }
}