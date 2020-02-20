<?php

class Model_adminclients extends CI_Model
{

    public function getUsers(){
        
        $select = $this->db->get('clients');
        
        return $select;
        
    }

    public function deleteClient($id)
    {

        $this->db->where('client_id', $id);
        $this->db->delete('clients');
    }
}