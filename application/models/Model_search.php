<?php

class Model_search extends CI_Model{


    public function get_search(){

        $recherche = $this->input->post('search_value');
        //$this->db->select('produit_nom');
        $this->db->like('produit_nom', $recherche)->limit(10);
        $this->db->or_like('produit_marque', $recherche);
        
        $select = $this->db->get('produit');

        return $select->result_array();
        
    }
}