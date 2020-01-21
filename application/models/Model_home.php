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


}