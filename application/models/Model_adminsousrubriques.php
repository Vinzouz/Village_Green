<?php

class Model_adminsousrubriques extends CI_Model
{

    public function getSousRubriques()
    {

        $select = $this->db->get('sous_rubrique');

        return $select;
    }

    public function addSousRubrique($data)
    {

        $this->db->insert('sous_rubrique', $data);
    }

    public function deleteSousRubrique($idSR)
    {

        $this->db->where('sousrub_id', $idSR);
        $this->db->delete('sous_rubrique');
    }

    public function getSousRubriqueData($idSR)
    {

        if ($idSR > 0) {

            $this->db->where('sousrub_id', $idSR);
            $result = $this->db->get('sous_rubrique');

            return $result->row_array();
        } else {
            return false;
        }
    }

    public function updateSousRubrique($data)
    {

        $idSR = $data['sousrub_id'];
        
        $this->db->where('sousrub_id', $idSR);

        $select = $this->db->get('sous_rubrique');

        $selectSousRubrique = $select->row_array();

        if ($selectSousRubrique) {

            $this->db->set($data);
            $this->db->where('sousrub_id', $idSR);
            $this->db->update('sous_rubrique');
            return $selectSousRubrique;
        } else {
            return false;
        }
    }
}