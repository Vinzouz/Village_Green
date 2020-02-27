<?php

class Model_adminclients extends CI_Model
{

    public function getUsers()
    {

        $select = $this->db->get('clients');

        return $select;
    }

    function getClients($postData = null)
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
            $searchQuery = " (client_nom like '%" . $searchValue . "%' or client_prenom like '%" . $searchValue . "%' or client_ville like'%" . $searchValue . "%' ) ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $records = $this->db->get('clients')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('clients')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('clients')->result();

        $data = array();

        foreach ($records as $record) {
            $data[] = array(
                "client_id" => $record->client_id,
                "client_nom" => $record->client_nom,
                "client_prenom" => $record->client_prenom,
                "client_adresse" => $record->client_adresse,
                "client_ville" => $record->client_ville,
                "client_codepo" => $record->client_codepo,
                "client_telephone" => $record->client_telephone,
                "client_mail" => $record->client_mail,
                "client_type" => $record->client_type,
                "client_siret" => $record->client_siret,
                "client_password" => $record->client_password,
                "client_role_id" => $record->client_role_id,
                "client_commerciaux_id" => $record->client_commerciaux_id,

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



    public function deleteClient($id)
    {

        $this->db->where('client_id', $id);
        $this->db->delete('clients');
    }
}
