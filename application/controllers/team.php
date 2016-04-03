<?php
class Team extends CI_Controller
{
    public function index($sortBy='team_name',$sortOrder='asc')
    {
        if(isset($_GET)){
            $perPage=isset($_GET['perPage'])?$_GET['perPage']:10;
            $countryId=isset($_GET['country_id'])?$_GET['country_id']:0;
            $pattern=isset($_GET['pattern'])?$_GET['pattern']:null;
        }
        //pagination with Get filters
        if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");

        $data=array();
        $this->load->model('team_model');
        $this->load->model('country_model');
        $config['base_url'] = base_url().'team/index/'.$sortBy.'/'.$sortOrder.'/page/';
        //pagination with Get filters
        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);

        $config['total_rows'] = $teams=$this->team_model->countResult($countryId,$pattern);
        $config['per_page'] = $perPage;
        $config['uri_segment'] = 6;
        $offset=$this->uri->segment($config['uri_segment']);

        $this->pagination->initialize($config);
        $data['sortOrder']=$sortOrder;
        $data['pagination']=$this->pagination->create_links();
        $countrys=$this->country_model->getAll();

        $teams=$this->team_model->getAll($countryId,$pattern,$sortBy,$sortOrder,$config['per_page'],$offset);
        $data['perPage']=$perPage;
        $data['countrys']=$countrys;
        $data['teams']=$teams;
        $data['countryId']=$countryId;

        $data['pattern']=$pattern;
        $this->load->view('admin/team/listing',$data);
    }
    public function create()
    {
        $data=array();
        $this->load->model('country_model');
        $countrys=$this->country_model->getAll();


        $data['countrys']=$countrys;
        $inputData=array(
            'team_name'=>'',
            'address'=>'',
            'image'=>'',
            'country_id'=>'',
        );
        if(isset($_POST['change'])){
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', '', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('image', '', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('address', '', 'trim|required|min_length[5]');
            if ($this->form_validation->run())
            {
                $inputData=array(
                    'team_name'=>trim($_POST['name']),
                    'address'=>trim($_POST['address']),
                    'image'=>trim($_POST['image']),
                    'country_id'=>$_POST['country_id'],
                );
                $this->load->model('team_model');
                $this->team_model->create($inputData);
                $this->session->set_flashdata('team', 'Въведен нов отбор');
                redirect(base_url().'team/index');
                exit;

            }
            else
            {
                $inputData=array(
                    'team_name'=>trim($_POST['name']),
                    'address'=>trim($_POST['address']),
                    'image'=>trim($_POST['image']),
                    'country_id'=>$_POST['country_id'],
                );
            }
        }

        $data['inputData']=$inputData;
        $this->load->view('admin/team/create',$data);
    }
    public function update($id)
    {
        $this->load->model('team_model');
        $data=array();
        $this->load->model('country_model');
        $countrys=$this->country_model->getAll();
        $team=$this->team_model->getOne($id);


        $data['countrys']=$countrys;
        $data['id']=$id;

        $inputData=array(
            'team_name'=>$team->team_name,
            'address'=>$team->address,
            'image'=>$team->image,
            'country_id'=>$team->country_id,
        );
        if(isset($_POST['change'])){
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', '', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('image', '', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('address', '', 'trim|required|min_length[5]');
            if ($this->form_validation->run())
            {
                $inputData=array(
                    'team_name'=>trim($_POST['name']),
                    'address'=>trim($_POST['address']),
                    'image'=>trim($_POST['image']),
                    'country_id'=>$_POST['country_id'],
                );

                $this->team_model->update($id,$inputData);
                $this->session->set_flashdata('team', 'променени данни');
                redirect(base_url().'team/index');
                exit;

            }
            else
            {
                $inputData=array(
                    'team_name'=>trim($_POST['name']),
                    'address'=>trim($_POST['address']),
                    'image'=>trim($_POST['image']),
                    'country_id'=>$_POST['country_id'],
                );
            }
        }
        $data['inputData']=$inputData;
        $this->load->view('admin/team/update',$data);
    }
    public function delete($id)
    {
        $this->load->model('team_model');
        $this->team_model->delete($id);
        $this->session->set_flashdata('team', 'изтрит отбор');
        redirect(base_url().'team/index');
        exit;
    }

}