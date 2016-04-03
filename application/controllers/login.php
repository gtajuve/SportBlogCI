<?php
class Login extends CI_Controller
{
    public function index()
    {

        $data['main_view']='admin/login_view';
        $this->load->view('admin/include/template',$data);
    }
    public function validate()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username','Име','trim|required|min_length[3]');
        $this->form_validation->set_rules('password','Перола','trim|required|min_length[4]');
        if($this->form_validation->run()){
            $this->load->model('user_model');
            $user=$this->user_model->validate_login();
            if( $user!=null){
                $data=array(
                  'is_logged'=>TRUE,
                    'user'=>$user,
                );
                $this->session->set_userdata($data);

                redirect('home/index');
            }else{
                $this->session->set_flashdata('errmsg', 'Грешно Име или Парола');
                redirect('login/index','refresh');
            }
        }else{
            $this->index();
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login/index');
    }
}