<?php
class Message_model extends CI_Model
{
    private $table='messages as m';
    public function getAll()
    {
        $this->db->select('m.id,m.message,m.title,m.reg_time,t.team_name,u.username,m.user_id');
        $this->db->join('teams as t ',' t.id=m.team_id');
        $this->db->join('users as u ',' u.id=m.user_id');
        $this->db->order_by('m.reg_time desc');
        $q=$this->db->get($this->table);
        foreach($q->result() as $row){
            $result[]=$row;
        }
        return $result;
    }
}