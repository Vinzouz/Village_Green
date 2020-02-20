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
    
    public function deleteProduct($idP)
    {

        $this->db->where('produit_id', $idP);
        $this->db->delete('produit');
    }

    public function getProductData($idP)
    {

        if ($idP > 0) {

            $this->db->select('*');
            $this->db->from('produit');
            $this->db->join('sous_rubrique', 'produit.produit_sousrub_id = sous_rubrique.sousrub_id');
            $this->db->where('produit_id', $idP);
            $select = $this->db->get();

            return $select->row_array();
        } else {
            return false;
        }
    }

    public function updateProduct($data)
    {

        $idP = $data['produit_id'];
        
        $this->db->where('produit_id', $idP);

        $select = $this->db->get('produit');

        $selectProduct = $select->row_array();

        if ($selectProduct) {

            $this->db->set($data);
            $this->db->where('produit_id', $idP);
            $this->db->update('produit');
            return $selectProduct;
        } else {
            return false;
        }
    }

}