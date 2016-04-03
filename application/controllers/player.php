<?php
class Player extends CI_Controller
{
    public function index($sortBy='last_name',$sortOrder='asc')
    {
        $where=array();
        $team_id=isset($_GET['team_id'])?$_GET['team_id']:0;
        $pos=isset($_GET['pos'])?$_GET['pos']:null;
        $perPage=isset($_GET['perPage'])?$_GET['perPage']:10;
        $pattern=isset($_GET['pattern'])?$_GET['pattern']:null;
        if($team_id>0){
            $where['team_id']=$team_id;
        }
        if($pos!=null){
            $where['position_player']=$pos;
        }



        //pagination with Get filters
        if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $data=array();
        $this->load->model('player_model');
        $this->load->model('team_model');
        $teams=$this->team_model->getAll();

        $config['base_url'] = base_url().'player/index/'.$sortBy.'/'.$sortOrder.'/page/';
        //pagination with Get filters
        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
        $config['total_rows'] = $this->player_model->countResult($where,$pattern);
        $config['per_page'] = $perPage;
        $config['uri_segment'] = 6;
        $this->pagination->initialize($config);
        $offset=$this->uri->segment($config['uri_segment']);

        $data['pagination']=$this->pagination->create_links();
        $this->load->model('player_model');
        $players=$this->player_model->getAll($where,$pattern,$sortBy,$sortOrder,$config['per_page'],$offset);
        $data['perPage']=$perPage;
        $data['pattern']=$pattern;
        $data['pos']=$pos;
        $data['team_id']=$team_id;
        $data['players']=$players;
        $data['teams']=$teams;
        $data['sortOrder']=$sortOrder;
        $this->load->view('admin/player/listing',$data);
    }
    public function create()
    {
        $data=array();
        $this->load->model('team_model');
        $teams=$this->team_model->getAll();
        $data['teams']=$teams;
        $playerInfo=array(

            'first_name'        =>'',
            'last_name'         =>'',
            'team_id'           =>'',
            'position_player'   =>'',
            'image'             =>'',
            'country'           =>'',
            'games'             =>'',
            'goals'             =>'',
        );
        if(isset($_POST['change'])){
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('fname', '', 'trim|required|min_length[1]');
            $this->form_validation->set_rules('lname', '', 'trim|required|min_length[1]');
            $this->form_validation->set_rules('imagePlayer', '', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('countryPlayer', '', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('games', '', 'required|greater_than[-1]');
            $this->form_validation->set_rules('goals', '', 'required|greater_than[-1]');




            $playerInfo['first_name']=isset($_POST['fname'])?(trim($_POST['fname'])):$playerInfo['first_name'];
            $playerInfo['last_name']=isset($_POST['lname'])?(trim($_POST['lname'])):$playerInfo['last_name'];
            $playerInfo['team_id']=isset($_POST['team_id'])?$_POST['team_id']:"";
            $playerInfo['position_player']=isset($_POST['position'])?$_POST['position']:$playerInfo['position_player'];
            $playerInfo['image']=strlen((trim($_POST['imagePlayer'])))>3?addslashes(trim($_POST['imagePlayer'])):"http://cache.images.core.optasports.com/soccer/players/150x150/53096.png";
            $playerInfo['country']=isset($_POST['countryPlayer'])?(trim($_POST['countryPlayer'])):$playerInfo['country'];
            $playerInfo['games']=isset($_POST['games'])?$_POST['games']:$playerInfo['games'];
            $playerInfo['goals']=isset($_POST['goals'])?$_POST['goals']:$playerInfo['goals'];

            if ($this->form_validation->run())
            {
                $this->load->model('player_model');
                $this->player_model->save($playerInfo);
                $this->session->set_flashdata('team', 'променени данни');
                redirect(base_url().'player/index');
                exit;
            }


        }
        $data['playerInfo']=$playerInfo;
        $this->load->view('admin/player/create',$data);
    }
    public function update($id)
    {
        $this->load->model('player_model');
        $team=$this->player_model->getOne($id);
        $data=array();
        $this->load->model('team_model');
        $teams=$this->team_model->getAll();
        $data['teams']=$teams;
        $playerInfo=array(
            'id'                =>$team->id,
            'first_name'        =>$team->first_name,
            'last_name'         =>$team->last_name,
            'team_id'           =>$team->team_id,
            'position_player'   =>$team->position_player,
            'image'             =>$team->image,
            'country'           =>$team->country,
            'games'             =>$team->games,
            'goals'             =>$team->goals,
        );
        if(isset($_POST['change'])){
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('fname', '', 'trim|required|min_length[1]');
            $this->form_validation->set_rules('lname', '', 'trim|required|min_length[1]');
            $this->form_validation->set_rules('imagePlayer', '', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('countryPlayer', '', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('games', '', 'required|greater_than[-1]');
            $this->form_validation->set_rules('goals', '', 'required|greater_than[-1]');




            $playerInfo['first_name']=isset($_POST['fname'])?(trim($_POST['fname'])):$playerInfo['first_name'];
            $playerInfo['last_name']=isset($_POST['lname'])?(trim($_POST['lname'])):$playerInfo['last_name'];
            $playerInfo['team_id']=isset($_POST['team_id'])?$_POST['team_id']:"";
            $playerInfo['position_player']=isset($_POST['position'])?$_POST['position']:$playerInfo['position_player'];
            $playerInfo['image']=strlen((trim($_POST['imagePlayer'])))>3?addslashes(trim($_POST['imagePlayer'])):"http://cache.images.core.optasports.com/soccer/players/150x150/53096.png";
            $playerInfo['country']=isset($_POST['countryPlayer'])?(trim($_POST['countryPlayer'])):$playerInfo['country'];
            $playerInfo['games']=isset($_POST['games'])?$_POST['games']:$playerInfo['games'];
            $playerInfo['goals']=isset($_POST['goals'])?$_POST['goals']:$playerInfo['goals'];

            if ($this->form_validation->run())
            {
                $this->load->model('player_model');
                $this->player_model->save($playerInfo);
                $this->session->set_flashdata('team', 'променени данни');
                redirect(base_url().'player/index');
                exit;
            }


        }
        $data['playerInfo']=$playerInfo;
        $this->load->view('admin/player/update',$data);
    }
    public function delete($id)
    {
        $this->load->model('player_model');
        $this->player_model->delete($id);
        $this->session->set_flashdata('team', 'изтрит съзтезател');
        redirect(base_url().'player/index');
        exit;
    }
}