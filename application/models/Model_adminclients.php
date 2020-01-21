<?php

class Model_adminclients extends CI_Model
{

    public function getUsers(){
        
        $select = $this->db->get('clients');
        
        return $select;
        
    }
}