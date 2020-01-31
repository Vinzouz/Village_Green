<?php

class Model_home extends CI_Model {

    public function getRubriques(){


        $parents =  $this->db->get('rubrique');

        $parents = $parents->result_array();
        
        
        foreach($parents as $key=> $parent){

            //echo $parent->rubrique_id;
            $this->db->where('sousrub_rubrique_id', $parent['rubrique_id']);
            $child = $this->db->get('sous_rubrique');
            $parents[$key]['child'] = $child->result_array();
 
        }
        return $parents;
    }

    public function carrousel_produit(){

        $this->db->select('*');
        $this->db->from('sous_rubrique')->order_by('produit_id', 'RANDOM')->limit(12);
        $this->db->join('produit', 'produit_sousrub_id = sousrub_id');
        $selected = $this->db->get();

        return $selected->result();
    }


}