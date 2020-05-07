<?php

class Model_adminrubriques extends CI_Model
{

    public function getRubriques() // Fonction appelée dans la fonction getRubriques du controller adminrubriques
    {
        $select = $this->db->get('rubrique'); // Récupération et envoie de la table entière des rubriques dans la variable $select
        return $select;
    }

    public function addRubrique($data) // Fonction appelée dans la fonction addRubrique du controller adminrubriques
    { // Fonction pour insérer une nouvelle rubrique en BDD qui reçoit le formulaire
        $this->db->insert('rubrique', $data); // Insertion avec les données reçues en paramètre
        $insert_id = $this->db->insert_id(); // Récupération de la dernnière id insérée
        $this->db->where( 'rubrique_id', $insert_id ); // Et sélection de la ligne selon l'id
        $result = $this->db->get( 'rubrique' ); // Affectation du résultat à la variable $result

        if ( $result ) { // Si résultat
            return $insert_id; // Envoie de l'id insérée
        } else { // Si aucun résultat renvoie false
            return false;
        }
    }

    public function deleteRubrique($idR) // Fonction appelée dans la fonction deleteRubrique du controller adminrubriques
    { // Fonction qui sert à supprimer un produit
        $this->db->where('rubrique_id', $idR); // Sélection et suppression en BDD de la rubrique selon l'id en paramètre
        $this->db->delete('rubrique');
    }

    public function getRubriqueData($idR) // Fonction appelée dans la fonction editRubrique du controller adminrubriques
    {
        // Sélection des données de la rubrique pour l'affichage dans le formulaire d'édition
        if ($idR > 0) { // Si l'id de la rubrique est correct
            $this->db->where('rubrique_id', $idR); // Sélection de la ligne selon l'id de la rubrique passé en paramètre
            $result = $this->db->get('rubrique'); // Affectation du résultat à la variable $result

            return $result->row_array(); // Envoie du résultat
        } else { // Si l'id de la rubrique est incorrect
            return false; // Renvoie false
        }
    }

    public function updateRubrique($data) // Fonction appelée dans la fonction updateRubrique du controller adminrubriques
    {
        // Réception des données du formulaire pour update en BDD
        $idR = $data['rubrique_id']; // Récupération de l'id de la rubrique
        
        $this->db->where('rubrique_id', $idR); // Sélection e la rubrique selon son id
        $select = $this->db->get('rubrique'); // Affectation du résultat à la variable $select
        $selectRubrique = $select->row_array(); // Affectation du résultat en tableau

        if ($selectRubrique) { // Si rubrique trouvée

            $this->db->set($data); // Définit les valeurs d'update
            $this->db->where('rubrique_id', $idR); // Sélection du produit à update
            $this->db->update('rubrique'); // Update
            return $selectRubrique; // Envoie de la ligne du produit
        } else { // Si aucune rubrique trouvée renvoie false
            return false;
        }
    }
}
