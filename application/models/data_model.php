<?php

class Data_model extends CI_Model
{
    function getAll()
    {
        $q=$this->db->get('users');
        foreach($q->result() as $row) {
            $data[]=$row;
        };
        return $data;
    }
}