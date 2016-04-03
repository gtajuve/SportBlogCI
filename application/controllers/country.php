<?php
class Country extends CI_Controller
{
    public function index()
    {
        $data=array();
        $this->load->model('country_model');
        $countrys=$this->country_model->getAll();
        $data['countrys']=$countrys;
        $this->load->view('admin/country/listing',$data);
    }
}