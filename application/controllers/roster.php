<?php
class Roster extends CI_Controller
{
    public function index($id)
    {
        $data=array();
        $this->load->model('game_model');
        $game=$this->game_model->getOne($id);
        $data['game']=$game;
        $this->load->model('roster_model');
        $gameInfo=$this->roster_model->getAll($id);
        $data['gameInfo']=$gameInfo;
//        echo '<pre>'.print_r($gameInfo,true).'</pre>';die;
        $this->load->view('admin/roster/listing',$data);
    }
    public function create($id)
    {
        $data=array();
        $this->load->model('game_model');
        $game=$this->game_model->getOne($id);
        $data['game']=$game;
        $this->load->model('player_model');
        $playersHT=$this->player_model->getAll(array('team_id'=>$game->home_team_id));
        $data['playersHT']=$playersHT;

        $playersAT=$this->player_model->getAll(array('team_id'=>$game->away_team_id));
        $data['playersAT']=$playersAT;
        if(isset($_POST['submitPlayers'])) {

            if (empty($_POST['playersHT']) || empty($_POST['playersAT'])) {
                $errors['player'] = "въведи играчи";
            } else {

                foreach ($_POST['playersHT'] as $player) {
                    $playersScore[$player] = (isset($_POST['goalsHT' . $player]) && $_POST['goalsHT' . $player] > -1) ? $_POST['goalsHT' . $player] : 0;

                }
                foreach ($_POST['playersAT'] as $player) {
                    $playersScore[$player] = (isset($_POST['goalsAT' . $player]) && $_POST['goalsAT' . $player] > -1) ? $_POST['goalsAT' . $player] : 0;

                }

                foreach ($playersScore as $key => $goals) {
                    $dataInput = array(
                        'game_id' => $id,
                        'player_id' => $key,
                        'goals_ongame' => $goals,
                    );

                    $this->load->model('roster_model');
                    $this->roster_model->save($dataInput);


                    foreach ($playersScore as $key => $goals) {
                        $this->load->model('player_model');
                        $player = $this->player_model->getOne($key);
                        $playerInfo['id'] = $player->id;
                        $playerInfo['games'] = ($player->games + 1);
                        $playerInfo['goals'] = ($player->goals + $goals);

                        $this->player_model->save($playerInfo);
                    }
                }
                    redirect(base_url() . 'roster/index/' . $id);
                    exit;
            }
        }



        $this->load->view('admin/roster/insert',$data);
    }
    public function update($id)
    {
        $data=array();
        $this->load->model('game_model');
        $game=$this->game_model->getOne($id);
        $data['game']=$game;
        $this->load->model('player_model');
        $where['team_id']=$game->home_team_id;
        $where['g.id']=$id;
        $playersHT=$this->player_model->getAllForGame($where);
        $data['playersHT']=$playersHT;
        $where['team_id']=$game->away_team_id;
        $playersAT=$this->player_model->getAllForGame($where);
        $data['playersAT']=$playersAT;

        $this->delete($id);
        if(isset($_POST['submitPlayers'])) {

            if (empty($_POST['playersHT']) || empty($_POST['playersAT'])) {
                $errors['player'] = "въведи играчи";
            } else {

                foreach ($_POST['playersHT'] as $player) {
                    $playersScore[$player] = (isset($_POST['goalsHT' . $player]) && $_POST['goalsHT' . $player] > -1) ? $_POST['goalsHT' . $player] : 0;

                }
                foreach ($_POST['playersAT'] as $player) {
                    $playersScore[$player] = (isset($_POST['goalsAT' . $player]) && $_POST['goalsAT' . $player] > -1) ? $_POST['goalsAT' . $player] : 0;

                }

                foreach ($playersScore as $key => $goals) {
                    $dataInput = array(
                        'game_id' => $id,
                        'player_id' => $key,
                        'goals_ongame' => $goals,
                    );

                    $this->load->model('roster_model');
                    $this->roster_model->save($dataInput);


                    foreach ($playersScore as $key => $goals) {
                        $this->load->model('player_model');
                        $player = $this->player_model->getOne($key);
                        $playerInfo['id'] = $player->id;
                        $playerInfo['games'] = ($player->games + 1);
                        $playerInfo['goals'] = ($player->goals + $goals);

                        $this->player_model->save($playerInfo);
                    }
                }
                redirect(base_url() . 'roster/index/' . $id);
                exit;
            }
        }



        $this->load->view('admin/roster/update',$data);
    }
    public function delete($id)
    {
        $this->load->model('roster_model');
        $this->roster_model->delete($id);
        $this->index($id);
    }


}