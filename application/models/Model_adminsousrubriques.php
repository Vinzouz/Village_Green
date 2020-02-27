<?php

class Model_adminsousrubriques extends CI_Model
{

    public function getSousRubriques()
    {

        $select = $this->db->get('sous_rubrique');

        return $select;
    }

    function getSousrub($postData = null)
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
            $searchQuery = " (sousrub_nom like '%" . $searchValue . "%' ) ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $records = $this->db->get('sous_rubrique')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('sous_rubrique')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('sous_rubrique')->result();

        $data = array();

        foreach ($records as $record) {
            $data[] = array(
                "sousrub_id" => $record->sousrub_id,
                "sousrub_nom" => $record->sousrub_nom,
                "sousrub_desc" => $record->sousrub_desc,
                "sousrub_rubrique_id" => $record->sousrub_rubrique_id,
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