<?php

class Model_products extends CI_Model{

    public function getRubrique($Rubrique_id){

        $this->db->where('Rubrique_id', $Rubrique_id);
        $select = $this->db->get('Rubrique');
        return $select->result();
    }

    public function getSousRubrique($SousRubrique_id){

        $this->db->where('Sousrub_id', $SousRubrique_id);
        $this->db->join('produit', 'produit_sousrub_id = sousrub_id');
        $selected = $this->db->get('sous_rubrique');

        return $selected->result();
    }
}  