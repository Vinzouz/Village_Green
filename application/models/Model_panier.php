<?php

class Model_panier extends CI_Model {

    public function getinfosproduit($idP)
    {

        $this->db->select('*');
        $this->db->from('produit');
        $this->db->where('produit_id', $idP);
        $select = $this->db->get();

        return $select->result_array();

    }

}