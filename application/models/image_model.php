<?php
class Image_model extends CI_Model
{
    protected $table='teams_images';


    public function getAll($id)
    {
        $q=$this->db->where('team_id',$id);
        $q=$this->db->get($this->table);
        $result=array();
        foreach($q->result() as $row){
            $result[]=$row;
        }
        return $result;
    }
    public function getOne($id)
    {
        $this->db->where('id',$id);
        $q=$this->db->get($this->table);
        return $q->result()[0];
    }
    public function create($insertData)
    {
        $q=$this->db->insert($this->table,$insertData);
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}