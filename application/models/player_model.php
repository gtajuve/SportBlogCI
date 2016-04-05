<?php
class Player_model extends CI_Model
{
    private $table='players as p';
    public function getAll($where,$like=null,$sortBy='last_name',$sortOrder='asc',$perPage=null,$offset=null)
    {

        if(!empty($where)){
            $this->db->where($where);
        }
        if($like!=null){
            $this->db->like('last_name',$like,'after');

        }
        $this->db->select('p.image,p.id,p.first_name,p.last_name,p.country,p.position_player,t.team_name,p.games,p.goals');
        $this->db->join('teams as t','t.id=p.team_id','left');
        $this->db->order_by("p.$sortBy $sortOrder");
        $q=$this->db->get($this->table,$perPage,$offset);
        $result=array();
        foreach($q->result() as $row){
            $result[]=$row;
        }
        return $result;
    }
    public function getOne($id)
    {
        $this->db->where('id',$id);
        $q=$this->db->get('players');
        return $q->row();
    }
    public function countResult($where,$like)
    {
        if(!empty($where)){
            $this->db->where($where);
        }
        if($like!=null){
            $this->db->like('last_name',$like,'after');

        }

        $this->db->from($this->table);

        return $this->db->count_all_results();
    }
    public function save($playerInfo)
    {
        if(array_key_exists('id',$playerInfo)){
            $id=$playerInfo['id'];
            echo $id;
            unset($playerInfo['id']);

            $this->db->where('id',$id);
            $this->db->update('players',$playerInfo);

        }else{

            $this->db->insert('players',$playerInfo);
        }
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('players');
    }
    public function getAllForGame($where)
    {

        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->select('p.id,p.first_name,p.last_name,p.position_player,p.country,p.games,p.goals,p.image,gp.game_id,gp.goals_ongame');
        $this->db->join('games as g','p.team_id=g.home_team_id OR p.team_id=g.away_team_id');
        $this->db->join('games_players as gp','gp.game_id=g.id AND p.id=gp.player_id','left');
        $this->db->order_by("p.last_name asc");
        $q=$this->db->get($this->table);

        $result=array();
        foreach($q->result() as $row){
            $result[]=$row;
        }
        return $result;
    }
}