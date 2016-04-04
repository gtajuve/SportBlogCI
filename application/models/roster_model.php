<?php
class Roster_model extends CI_Model
{
    protected $table='games_players as gp';

    public function getAll($id)
    {   $this->db->select('gp.game_id,gp.player_id,gp.goals_ongame,p.first_name,p.last_name,p.team_id');
        $this->db->join('players as p','p.id=gp.player_id');
        $this->db->where('gp.game_id',$id);
        $q=$this->db->get($this->table);
//        var_dump($this->db->last_query());
        $result=array();
        foreach($q->result() as $row){
            $result[]=$row;
        }
        return $result;
    }
    public function save($playerInfo)
    {
        if(array_key_exists('id',$playerInfo)){
            $id=$playerInfo['id'];
            echo $id;
            unset($playerInfo['id']);

            $this->db->where('id',$id);
            $this->db->update('games_players',$playerInfo);
        }else{

            $this->db->insert('games_players',$playerInfo);
        }
    }
}