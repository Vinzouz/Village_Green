<?php

class Model_adminrubriques extends CI_Model
{

    public function getRubriques()
    {

        $select = $this->db->get('rubrique');

        return $select;
    }


    public function addRubrique($data)
    {
        $this->db->insert('rubrique', $data);
        $insert_id = $this->db->insert_id();
        $this->db->where( 'rubrique_id', $insert_id );
        $result = $this->db->get( 'rubrique' );

        if ( $result ) {
            return $insert_id;
        } else {
            return false;
        }
    }

    public function deleteRubrique($idR)
    {

        $this->db->where('rubrique_id', $idR);
        $this->db->delete('rubrique');
    }

    public function getRubriqueData($idR)
    {

        if ($idR > 0) {

            $this->db->where('rubrique_id', $idR);
            $result = $this->db->get('rubrique');

            return $result->row_array();
        } else {
            return false;
        }
    }

    public function updateRubrique($data)
    {

        $idR = $data['rubrique_id'];
        
        $this->db->where('rubrique_id', $idR);

        $select = $this->db->get('rubrique');

        $selectRubrique = $select->row_array();

        if ($selectRubrique) {

            $this->db->set($data);
            $this->db->where('rubrique_id', $idR);
            $this->db->update('rubrique');
            return $selectRubrique;
        } else {
            return false;
        }
    }
}
