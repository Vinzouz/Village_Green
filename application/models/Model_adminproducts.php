<?php

class Model_adminproducts extends CI_Model
{

    public function getProducts() // Fonction appelée dans la fonction getProduct du controller adminproducts
    { 
        $select = $this->db->get('produit'); // Récupération et envoie de la table entière des produits dans la variable $select 
        return $select;
    }

    function getProduits($postData = null) // Fonction appelée dans la fonction listeProduits dans le controller adminproducts
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

        // Recherche possible par nom ou marque de produit
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (produit_nom like '%" . $searchValue . "%' or produit_marque like '%" . $searchValue . "%' ) ";
        }

        // Nombre total d'enregistrements sans filtrage
        $this->db->select('count(*) as allcount');
        $records = $this->db->get('produit')->result();
        $totalRecords = $records[0]->allcount;

        // Nombre total d'enregistrements avec filtrage
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('produit')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        // Récupération des enregistrements dans le tableau
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('produit')->result();

        $data = array();
        // Création d'un tableau vide et rentrée de toutes les données des produits
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
	
        // Réponse initialisée selon la recherche et renvoyée
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }

    public function addProduct($data) // Fonction appelée dans la fonction addProduct du controller adminproducts
    { // Fonction pour insérer un nouveau produit en BDD qui reçoit le formulaire
        $this->db->insert('produit', $data); // Insertion avec les données reçues en paramètre
        return $insert_id = $this->db->insert_id(); // Envoie de l'id venant d'être insérée
    }

    public function getSousRubriques() // Fonction appelée dans la fonction index du controller adminproducts
    {
        $select = $this->db->get('sous_rubrique'); // Récupération et envoie de la table entière des sous-rubriques dans la variable $select
        return $select;
    }
    
    public function getProRubriques() // Fonction appelée dans la fonction index du controller adminproducts
    {
        $selected = $this->db->get('rubrique'); // Récupération et envoie de la table entière des rubriques dans la variable $select
        return $selected;
    }
    
    public function deleteProduct($idP) // Fonction appelée dans la fonction deleteProduct du controller adminproducts
    { // Fonction qui sert à supprimer un produit en BDD

        $this->db->select('*');
        $this->db->from('sous_rubrique'); // Sélection de tous les champs de la table sous-rubrique 
        $this->db->join('produit', 'sous_rubrique.sousrub_id = produit.produit_sousrub_id'); // Puis jointure de la table de sous-rubrique à la table produit par id de sous-rubrique
        $this->db->where('produit_id', $idP); // Où l'id de produit est égal à celui reçu en paramètre
        $select = $this->db->get(); // Affectation du résultat à la variable
        if ($select) { // Si résultat
            return $select->row_array(); // Envoie du résultat
            $this->db->where('produit_id', $idP); // Sélection et suppression en BDD du produit selon l'id en paramètre
            $this->db->delete('produit');
            
        } else { // Sinon renvoie false
            return false;
        }
    }

    public function getProductData($idP) // Fonction appelée dans la fonction editProduct du controller adminproducts
    {
        // Sélection des données du produit pour l'affichage dans le formulaire d'édition
        if ($idP > 0) { // Si l'id de produit est correct

            $this->db->select('*'); // Sélection de toute la ligne
            $this->db->from('produit'); // De la table produit
            $this->db->join('sous_rubrique', 'produit.produit_sousrub_id = sous_rubrique.sousrub_id'); // Jointure avec la table sous-rubrique selon l'id de sous-rubrique
            $this->db->where('produit_id', $idP); // Où l'id de produit est égal à celui reçu en paramètre
            $select = $this->db->get(); // Affectation du résultat à la variable

            return $select->row_array(); // Envoie du résultat
        } else { // Si l'id de produit est incorrect
            return false; // Renvoie false
        }
    }

    public function updateProduct($data) // Fonction appelée dans la fonction updateProduct du controller adminproducts
    {
        // Réception des données du formulaire pour update en BDD
        $idP = $data['produit_id']; // Récupération de l'id du produit
        
        $this->db->where('produit_id', $idP); // Sélection du produit selon son id
        $select = $this->db->get('produit'); // Affectation du résultat à la variable $select
        $selectProduct = $select->row_array(); // Affectation du résultat en tableau

        if ($selectProduct) { // Si produit trouvé

            $this->db->set($data); // Définit les valeurs d'update
            $this->db->where('produit_id', $idP); // Sélection du produit à update
            $this->db->update('produit'); // Update
            return $selectProduct; // Envoie de la ligne du produit
        } else { // Si aucun produit trouvé renvoie false
            return false;
        }
    }

    public function getSousRubriqueP($idP) // Fonction appelée dans la fonction editProduct du controller adminproducts
    {
        $this->db->where('produit_id', $idP); // Sélection du produit selon l'id passée en paramètre
        $this->db->join('sous_rubrique', 'sousrub_id = produit_sousrub_id'); // Jointure avec la table sous rubrique
        $this->db->join('rubrique', 'rubrique_id = sousrub_rubrique_id'); // Jointure avec la table rubrique selon les id
        $selected = $this->db->get('produit'); // Affectation du résultat à la variable $select

        return $selected->result(); // Envoie du résultat
    }
}