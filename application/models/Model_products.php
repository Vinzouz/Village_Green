<?php

class Model_products extends CI_Model{

    public function getRubrique($Rubrique_id) // Fonction appelée par la fonction getRubrique du controller products
    { // Fonction qui sert à lier les rubriques aux sous-rubriques
        $this->db->where('Rubrique_id', $Rubrique_id); // Sélection de la rubrique par son id
        $this->db->join('sous_rubrique', 'sousrub_rubrique_id = rubrique_id'); // Jointure avec la table sous-rubrique par l'id de rubrique
        $select = $this->db->get('Rubrique'); // Affectation du résultat à la variable $select
        return $select->result(); // Envoie du résultat en objet
    }

    public function getSousRubrique($SousRubrique_id) // Fonction appelée par la fonction getSousRubrique du controller products
    { // Fonction qui sert à lier les sous-rubriques aux produits
        $this->db->where('Sousrub_id', $SousRubrique_id); // Sélection des lignes selon l'id de sous rubrique
        $this->db->join('produit', 'produit_sousrub_id = sousrub_id'); // Jointure avec la table des produits
        $this->db->join('rubrique', 'rubrique_id = sousrub_rubrique_id'); // Jointure avec la table des rubriques
        $selected = $this->db->get('sous_rubrique'); // Affectation du résultat à la variable $selected
        return $selected->result(); // Envoie du résultat en objet
    }
}  