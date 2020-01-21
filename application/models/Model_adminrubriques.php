<?php

class Model_adminrubriques extends CI_Model
{

    public function getRubriques(){
        
        $select = $this->db->get('rubrique');
        
        return $select;
        
    }


    public function addRubrique($data){

        $this->db->insert('rubrique', $data);

        
    }

}