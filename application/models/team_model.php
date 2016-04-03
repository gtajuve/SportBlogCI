<?php
class Team_model extends CI_Model
{
    private $table ="teams as t";
    public function getAll($countryId=0,$pattern=null,$sortBy='team_name',$sortOrder='asc',$perPage=-1,$offset=0)
    {
        if($countryId>0){
            $this->db->where('country_id',$countryId);

        }
        $this->db->order_by("country_name,$sortBy $sortOrder");
        if($pattern!=null){
            $this->db->like('team_name',$pattern,'after');
        }
        $this->db->join('country as c','c.id=t.country_id');
        $this->db->select('t.id,t.team_name,t.address,t.image,c.country_name,t.country_id');
        if($perPage==-1){
            $q=$this->db->get($this->table);
        }else{
            $q=$this->db->get($this->table,$perPage,$offset);
        }

        $result=array();
        foreach($q->result() as $row){
            $result[]=$row;
        }
        return $result;


    }
    public function countResult($countryId,$pattern)
    {
        if($countryId>0){
            $this->db->where('country_id',$countryId);
        }
        if($pattern!=null){
            $this->db->like('team_name',$pattern,'after');

        }

        $this->db->from($this->table);

        return $this->db->count_all_results();
    }
    public function create($insertData)
    {
        $this->db->insert('teams',$insertData);
    }
    public function getOne($id)
    {
        $this->db->where('id',$id);
        $q=$this->db->get($this->table);
        return $q->row();
    }
    public function update($id,$insertData)
    {
        $this->db->where('id',$id);
        $this->db->update('teams',$insertData);
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('teams');
    }
}