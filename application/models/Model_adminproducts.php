<?php

class Model_adminproducts extends CI_Model
{

    public function getProducts(){
        
        $select = $this->db->get('produit');
        
        return $select;
        
    }

    function getProduits($postData = null)
    {

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (produit_nom like '%" . $searchValue . "%' or produit_marque like '%" . $searchValue . "%' ) ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $records = $this->db->get('produit')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('produit')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('produit')->result();

        $data = array();

        foreach ($records as $record) {
            $data[] = array(
                "produit_id" => $record->produit_id,
                "produit_marque" => $record->produit_marque,
                "produit_nom" => $record->produit_nom,
                "produit_prix_HT" => $record->produit_prix_HT,
                "produit_caract" => $record->produit_caract,
                "produit_sousrub_id" => $record->produit_sousrub_id,
                "produit_qtite" => $record->produit_qtite,
                "produit_qtite_ale" => $record->produit_qtite_ale,
                "produit_photo_id" => $record->produit_photo_id,
            );
        }
	
        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
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

        $this->db->select('*');
        $this->db->from('sous_rubrique');
        $this->db->join('produit', 'sous_rubrique.sousrub_id = produit.produit_sousrub_id');
        $this->db->where('produit_id', $idP);
        $select = $this->db->get();
        if ($select) {
            return $select->row_array();
            $this->db->where('produit_id', $idP);
            $this->db->delete('produit');
            
        } else {
            return false;
        }

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

    public function getSousRubriqueP($idP){

        $this->db->where('produit_id', $idP);
        $this->db->join('sous_rubrique', 'sousrub_id = produit_sousrub_id');
        $this->db->join('rubrique', 'rubrique_id = sousrub_rubrique_id');
        $selected = $this->db->get('produit');

        return $selected->result();
    }

}