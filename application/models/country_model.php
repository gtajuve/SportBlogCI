<?php
class Country_model extends CI_Model
{
    private $table='country';
    public function getAll()
    {
        $q=$this->db->get($this->table);
        foreach($q->result() as $row){
            $result[]=$row;
        }
        return $result;
    }
}