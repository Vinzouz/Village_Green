<?php

class Model_products extends CI_Model{

    public function getSousrubrique($sousrub_rubrique_id){

        $this->db->where('sousrub_rubrique_id', $sousrub_rubrique_id);
        $select = $this->db->get('sous_rubrique');
        return $select->result();
    }
}