<?php
class Game_model extends CI_Model
{
    private $table='games as g';
    public function getAll($where,$sortBy,$sortOrder,$perPage,$offset)
    {
        if(!empty($where)){

            if($where['team_id1']>0&& $where['team_id2']>0){
                $this->db->where('home_team_id =', $where['team_id1']);
                $this->db->or_where('away_team_id =', $where['team_id1']);
                $this->db->where('home_team_id =', $where['team_id2']);
                $this->db->or_where('away_team_id =', $where['team_id2']);

            }elseif($where['team_id1']>0){
                $this->db->where('home_team_id =', $where['team_id1']);
                $this->db->or_where('away_team_id =', $where['team_id1']);


            }elseif($where['team_id2']>0){
                $this->db->where('home_team_id =', $where['team_id2']);
                $this->db->or_where('away_team_id =', $where['team_id2']);
            }

        }
        $this->db->select('g.score,g.id,g.date_play,t1.team_name as home_team,t2.team_name as away_team,t1.image as home_image,t2.image as away_image');
        $this->db->join('teams as t1','t1.id=g.home_team_id');
        $this->db->join('teams as t2',' t2.id=g.away_team_id');
        $this->db->order_by("g.$sortBy $sortOrder");
        $q=$this->db->get($this->table,$perPage,$offset);
        $result=array();
        foreach($q->result() as $row){
            $result[]=$row;
        }
        return $result;
    }
    public function getOne($id)
    {
        $this->db->select('g.score,g.id,g.date_play,g.home_team_id,g.away_team_id,t1.team_name as home_team,t2.team_name as away_team');
        $this->db->join('teams as t1','t1.id=g.home_team_id');
        $this->db->join('teams as t2',' t2.id=g.away_team_id');
        $this->db->where('g.id',$id);
        $q=$this->db->get('games as g');
        return $q->row();
    }
    public function countResult($where=array())
    {
        if(!empty($where)){
            $whereStr='';
            if($where['team_id1']>0&& $where['team_id2']>0){
                $this->db->where('home_team_id =', $where['team_id1']);
                $this->db->or_where('away_team_id =', $where['team_id1']);
                $this->db->where('home_team_id =', $where['team_id2']);
                $this->db->or_where('away_team_id =', $where['team_id2']);

            }elseif($where['team_id1']>0){
                $this->db->where('home_team_id =', $where['team_id1']);
                $this->db->or_where('away_team_id =', $where['team_id1']);


            }elseif($where['team_id2']>0){
                $this->db->where('home_team_id =', $where['team_id2']);
                $this->db->or_where('away_team_id =', $where['team_id2']);
            }


        }


        $this->db->from($this->table);

        return $this->db->count_all_results();
    }
    public function save($inputData)
    {
        if(array_key_exists('id',$inputData)){
            $id=$inputData['id'];
            echo $id;
            unset($inputData['id']);

            $this->db->where('id',$id);
            $this->db->update('games',$inputData);
        }else{

            $this->db->insert('games',$inputData);
        }
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('games');
    }

}