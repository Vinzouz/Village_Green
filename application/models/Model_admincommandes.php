<?php

class Model_admincommandes extends CI_Model
{

    public function getCommandes() // Fonction appelée dans la fonction index du controller admincommandes
    {
        $select = $this->db->get('commande'); // // Récupération et envoie de la table entière des commandes dans la variable $select
        return $select;
    }

    function getCommande($postData = null) // Fonction appelée dans la fonction listeCommandes dans le controller admincommandes
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

        // Recherche possible état de commande ou id de commande
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (commande_etat like '%" . $searchValue . "%' or commande_id like '%" . $searchValue . "%' ) ";
        }

        // Nombre total d'enregistrements sans filtrage
        $this->db->select('count(*) as allcount');
        $records = $this->db->get('commande')->result();
        $totalRecords = $records[0]->allcount;

        // Nombre total d'enregistrements avec filtrage
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('commande')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        // Récupération des enregistrements dans le tableau
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('commande')->result();

        $data = array();
        // Création d'un tableau vide et rentrée de toutes les données des commandes
        foreach ($records as $record) {
            $data[] = array(
                "commande_id" => $record->commande_id,
                "commande_date" => $record->commande_date,
                "commande_reduc" => $record->commande_reduc,
                "commande_prix_tot" => $record->commande_prix_tot,
                "commande_date_reglem" => $record->commande_date_reglem,
                "commande_date_facture" => $record->commande_date_facture,
                "commande_livraison_rue" => $record->commande_livraison_rue,
                "commande_livraison_ville" => $record->commande_livraison_ville,
                "commande_livraison_codepo" => $record->commande_livraison_codepo,
                "commande_facturation_rue" => $record->commande_facturation_rue,
                "commande_facturation_ville" => $record->commande_facturation_ville,
                "commande_facturation_codepo" => $record->commande_facturation_codepo,
                "commande_etat" => $record->commande_etat,
                "commande_client_id" => $record->commande_client_id
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

    public function deleteCommande($id) // Fonction appelée dans la fonction deleteCommande du controller admincommandes
    {
        $this->db->where('commande_id', $id); // Sélection de la commande selon l'id et suppression en BDD
        $this->db->delete('commande');
    }

    public function getCommandeData($id) // Fonction appelée dans la fonction editCommande du controller admincommandes
    {
        // Sélection des données de la commande pour l'affichage dans le formulaire d'édition
        if ($id > 0) { // Si l'id de la commande est correct

            $this->db->where('commande_id', $id); // Sélection de la commande selon l'id de la commande
            $result = $this->db->get('commande'); // Affectation de la réponse et renvoie

            return $result->row_array();
        } else { // Si aucune commande, renvoie false
            return false;
        }
    }

    public function updateCommande($data) // Fonction appelée dans la fonction updateCommande du controller admincommandes
    {
        // Réception des données du formulaire pour update en BDD
        $id = $data['commande_id'];

        $this->db->where('commande_id', $id); // Sélection de la commande selon son id

        $select = $this->db->get('commande'); // Affectation de la réponse à la variable

        $selectCommande = $select->row_array(); // Mise en tableau de la réponse

        if ($selectCommande) { // Si commande trouvée

            $this->db->set($data); // Définit les valeurs d'update
            $this->db->where('commande_id', $id); // Sélection de la commande à update
            $this->db->update('commande'); // Update
            return $selectCommande; // Renvoie de la ligne 
        } else { // Si aucune commande trouvée renvoie false
            return false;
        }
    }

    public function insertLivraison($datalivraisonC) // Fonction appelée dans la fonction updateCommande du controller admincommandes
    {
        // Réception des données de la livraison si celle-ci est passé à 'En cours de livraison'
        $this->db->insert('livraison', $datalivraisonC); // Insertion des données dans la table livraison
        $insert_id = $this->db->insert_id(); // Récupération de l'id de la livraison venant d'être insérée
        $this->db->where('livraison_id', $insert_id); // Sélection de la ligne insérée
        $result = $this->db->get('livraison'); // Affectation de la réponse à la variable

        if ($result) { // Si l'ajout a été fait
            return $insert_id; // Envoie de l'id insérée
        } else { // Si aucun ajout
            return false; // Envoie de false
        }
    }

    public function getCompolivraison($id){ // Fonction appelée dans la fonction updateCommande du controller admincommandes
        // Sélection des données de la commande pour détails de la livraison

        $this->db->select('secomposede_produit_id, secomposede_qtite_commande'); // Sélection de la commande dans la table secomposede
        $this->db->where('secomposede_commande_id',$id); // Où l'id de la commande est égal à celui en paramètre
        $select = $this->db->get('secomposede'); // Affectation de la selection à la variable

        return $select->result_array(); // Retour en tableau
    }

    public function insertContenulivraison($contenu){ // Fonction appelée dans la fonction updateCommande du controller admincommandes
        // Récupération des données pour insertion dans la table contient liée à la livraison

        $i = 0;
        foreach($contenu[0][$i] as $key){ // Boucle pour chaque produit
            $data = array( // A chaque produit insertion dans le tableau avec
                "contient_livraison_id" => $contenu['contient_livraison_id'],
                "contient_produit_id" => $contenu[0][$i]['secomposede_produit_id'],
                "contient_qtite_liv" => $contenu[0][$i]['secomposede_qtite_commande']
            );
            // print_r($data);
            $this->db->insert('contient', $data); // Insertion des données dans la table contient
                $i++;
        }
        
    }

    public function updateLivraison($id){ // Fonction appelée dans la fonction updateCommande du controller admincommandes

        // Fonction appelée si l'état de la commande passe à 'Livrée'

        $data = array("livraison_etat" => 'Livrée'); 
        $this->db->set($data); // Définit la valeur de l'état de livraison
        $this->db->where('livraison_commande_id', $id); // Selection de la livraison selon son id et update en BDD
        $this->db->update('livraison');

    }
}
