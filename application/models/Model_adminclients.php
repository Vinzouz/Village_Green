<?php

class Model_adminclients extends CI_Model
{

    public function getUsers() // Fonction appelée dans la fonction index du controller adminclients
    {
        $select = $this->db->get('clients'); // Récupération et envoie de la table entière des clients dans la variable $select 
        return $select;
    }

    function getClients($postData = null) // Fonction appelée dans la fonction listeClients dans le controller adminclients
    { // Fonction utilisée par le script jQuery

        $response = array(); // Création d'un tableau vide

        // Données d'affichage
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Affichage de lignes par pages
        $columnIndex = $postData['order'][0]['column']; // Index des colonnes
        $columnName = $postData['columns'][$columnIndex]['data']; // Nom des colonnes
        $columnSortOrder = $postData['order'][0]['dir']; // Dans l'ordre ou désordre
        $searchValue = $postData['search']['value']; // Valeur cherchée

        // Recherche possible par nom, prénom ou ville
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (client_nom like '%" . $searchValue . "%' or client_prenom like '%" . $searchValue . "%' or client_ville like'%" . $searchValue . "%' ) ";
        }

        // Nombre total d'enregistrements sans filtrage
        $this->db->select('count(*) as allcount');
        $records = $this->db->get('clients')->result();
        $totalRecords = $records[0]->allcount;

        // Nombre total d'enregistrements avec filtrage
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('clients')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        // Récupération des enregistrements dans le tableau
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('clients')->result();

        $data = array();
        // Création d'un tableau vide et rentrée de toutes les données des clients
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

        // Réponse initialisée selon la recherche et renvoyée
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }

    public function deleteClient($id) // Fonction appelée dans la fonction deleteClient du controller adminclients
    {
        $this->db->where('client_id', $id); // Sélection du client selon l'id et suppression en BDD
        $this->db->delete('clients');
    }
}
