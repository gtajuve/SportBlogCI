<?php
class Game extends CI_Controller
{
    public function index($sortBy='date_play',$sortOrder='desc')
    {
        $data=array();
        $where=array();
        $where['team_id1']=$team_id1=isset($_GET['team_id1'])?$_GET['team_id1']:0;
        $where['team_id2']=$team_id2=isset($_GET['team_id2'])?$_GET['team_id2']:0;
        $this->load->model('game_model');

        $perPage=isset($_GET['perPage'])?$_GET['perPage']:10;



        //pagination with Get filters
        if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");


        $this->load->model('team_model');
        $teams=$this->team_model->getAll();

        $config['base_url'] = base_url().'game/index/'.$sortBy.'/'.$sortOrder.'/page/';
        //pagination with Get filters
        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);

        $config['total_rows'] =$this->game_model->countResult($where);
        $config['per_page'] = $perPage;
        $config['uri_segment'] = 6;
        $offset=$this->uri->segment($config['uri_segment']);

        $this->pagination->initialize($config);
        $data['sortOrder']=$sortOrder;
        $data['pagination']=$this->pagination->create_links();

        $data['teams']=$teams;
        $data['perPage']=$perPage;
        $data['team_id1']=$team_id1;
        $data['team_id2']=$team_id2;
        $data['teams']=$teams;

        $games=$this->game_model->getAll($where,$sortBy,$sortOrder,$config['per_page'],$offset);
        $data['games']=$games;
        $this->load->view('admin/game/listing',$data);
    }
    public function create()
    {
        $data=array();

        $this->load->model('team_model');
        $teams=$this->team_model->getAll();
        $data['teams']=$teams;

        $inputData=array(
            'home_team_id'=>'',
            'away_team_id'=>'',
            'home_score'=>'',
            'away_score'=>''
        );



        if(isset($_POST['change'])) {

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('home_team_id', '', 'required|greater_than[0]]');
            $this->form_validation->set_rules('away_team_id', '', 'required|greater_than[0]]');
            $this->form_validation->set_rules('home_score', '', 'required|greater_than[-1]]');
            $this->form_validation->set_rules('away_score', '', 'required|greater_than[-1]]');

            $inputData = array(
                'home_team_id' => $_POST['home_team_id'],
                'away_team_id' => $_POST['away_team_id'],
                'home_score' => $_POST['home_score'],
                'away_score' => $_POST['away_score']
            );

            if ($this->form_validation->run())
            {
                $inputData['score'] =$inputData['home_score'].':'.$inputData['away_score'];
                $inputData['date_play']=time();
                unset($inputData['home_score']);
                unset($inputData['away_score']);
                $this->load->model('game_model');
                $this->game_model->save($inputData);
                $this->session->set_flashdata('team', 'добавен мач');
                redirect(base_url().'game/index');
                exit;
            }


        }
        $data['inputData']=$inputData;
        $this->load->view('admin/game/create',$data);
    }
    public function update($id)
    {
        $data=array();
        $this->load->model('game_model');
        $game=$this->game_model->getOne($id);
        $scoreArr=explode(':',$game->score);

        $this->load->model('team_model');
        $teams=$this->team_model->getAll();
        $data['teams']=$teams;

        $inputData=array(
            'id'=>$game->id,
            'home_team_id'=>$game->home_team_id,
            'away_team_id'=>$game->away_team_id,
            'home_score'=>$scoreArr[0],
            'away_score'=>$scoreArr[1],
        );



        if(isset($_POST['change'])) {

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('home_team_id', '', 'required|greater_than[0]]');
            $this->form_validation->set_rules('away_team_id', '', 'required|greater_than[0]]');
            $this->form_validation->set_rules('home_score', '', 'required|greater_than[-1]]');
            $this->form_validation->set_rules('away_score', '', 'required|greater_than[-1]]');

            $inputData = array(
                'home_team_id' => $_POST['home_team_id'],
                'away_team_id' => $_POST['away_team_id'],
                'home_score' => $_POST['home_score'],
                'away_score' => $_POST['away_score']
            );

            if ($this->form_validation->run())
            {
                $inputData['score'] =$inputData['home_score'].':'.$inputData['away_score'];
                $inputData['date_play']=time();
                unset($inputData['home_score']);
                unset($inputData['away_score']);
                $this->load->model('game_model');
                $this->game_model->save($inputData);
                $this->session->set_flashdata('team', 'променен мач');
                redirect(base_url().'game/index');
                exit;
            }


        }
        $data['inputData']=$inputData;
        $this->load->view('admin/game/update',$data);
    }
    public function delete($id)
    {
        $this->load->model('game_model');
        $this->game_model->delete($id);
        $this->session->set_flashdata('team', 'изтрит съзтезател');
        redirect(base_url().'game/index');
        exit;
    }
}