<?php

class Model_adminproducts extends CI_Model
{

    public function getProducts(){
        
        $select = $this->db->get('produit');
        
        return $select;
        
    }

    public function addProduct($data){

        $this->db->insert('produit', $data);
        return $insert_id = $this->db->insert_id();
    }

    public function getSousRubriques(){

        $select = $this->db->get('sous_rubrique');
        return $select;

    }
    
    public function getProRubriques(){

        $selected = $this->db->get('rubrique');
        return $selected;

    }
    
}