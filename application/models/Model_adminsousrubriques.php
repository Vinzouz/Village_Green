<?php

class Model_adminsousrubriques extends CI_Model
{

    public function getSousRubriques() // Fonction appelée dans la fonction getSousRubriques du controller adminsousrubriques
    {
        $select = $this->db->get('sous_rubrique'); // Récupération et envoie de la table entière des sous-rubriques dans la variable $select 
        return $select;
    }

    function getSousrub($postData = null) // Fonction appelée dans la fonction listeSousrub dans le controller adminsousrubriques
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

        // Recherche possible par nom de sous-rubrique
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (sousrub_nom like '%" . $searchValue . "%' ) ";
        }

        // Nombre total d'enregistrements sans filtrage
        $this->db->select('count(*) as allcount');
        $records = $this->db->get('sous_rubrique')->result();
        $totalRecords = $records[0]->allcount;

        // Nombre total d'enregistrements avec filtrage
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('sous_rubrique')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        // Récupération des enregistrements dans le tableau
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('sous_rubrique')->result();

        $data = array();
        // Création d'un tableau vide et rentrée de toutes les données des produits
        foreach ($records as $record) {
            $data[] = array(
                "sousrub_id" => $record->sousrub_id,
                "sousrub_nom" => $record->sousrub_nom,
                "sousrub_desc" => $record->sousrub_desc,
                "sousrub_rubrique_id" => $record->sousrub_rubrique_id,
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

    public function addSousRubrique($data) // Fonction appelée dans la fonction addSousRubrique du controller adminsousrubriques
    { // Fonction pour insérer un nouveau produit en BDD qui reçoit le formulaire 
        $this->db->insert('sous_rubrique', $data); // Insertion avec les données reçues en paramètre
        $insert_id = $this->db->insert_id(); // Récupération de la dernière id ajoutée en BDD
        $this->db->where( 'sousrub_id', $insert_id ); // Et sélection de la ligne
        $result = $this->db->get( 'sous_rubrique' ); // Affectation du résultat à la variable $result

        if ( $result ) { // Si résultat
            return $insert_id; // Envoie de l'id insérée
        } else { // Si aucun résultat renvoie false
            return false;
        }
    }

    public function deleteSousRubrique($idSR) // Fonction appelée dans la fonction deleteSousRubrique du controller adminsousrubriques
    { // Fonction qui sert à supprimer un produit en BDD
        $this->db->where('sousrub_id', $idSR); // Sélection et suppression en BDD de la sous rubrique selon l'id en paramètre
        $this->db->delete('sous_rubrique');
    }

    public function getSousRubriqueData($idSR) // Fonction appelée dans la fonction editSousRubrique du controller adminsousrubriques
    {
        // Sélection des données de la sous-rubrique pour l'affichage dans le formulaire d'édition
        if ($idSR > 0) { // Si l'id de sous-rubrique est correct

            $this->db->where('sousrub_id', $idSR); // Sélection de la ligne de la sous-rubrique par l'id passé en paramètre
            $result = $this->db->get('sous_rubrique'); // Affectation du résultat à la variable $result

            return $result->row_array(); // Envoie du résultat
        } else { // Si l'id de sous-rubrique est incorrect
            return false; // Envoie false
        }
    }

    public function updateSousRubrique($data) // Fonction appelée dans la fonction updateSousRubrique du controller adminsousrubriques
    {
        // Réception des données du formulaire pour update en BDD
        $idSR = $data['sousrub_id']; // Récupération de l'id du produit
        
        $this->db->where('sousrub_id', $idSR); // Sélection de la sous-rubrique selon son id
        $select = $this->db->get('sous_rubrique'); // Affectation du résultat à la variable $select
        $selectSousRubrique = $select->row_array(); // Affectation du résultat en tableau

        if ($selectSousRubrique) { // Si sous-rubrique trouvée

            $this->db->set($data); // Définit les valeurs d'update
            $this->db->where('sousrub_id', $idSR); // Sélection de la sous-rubrique à update
            $this->db->update('sous_rubrique'); // Update
            return $selectSousRubrique; // Envoie de la ligne de la sous-rubrique
        } else { // Si aucune sous-rubrique trouvée renvoie false
            return false;
        }
    }
}