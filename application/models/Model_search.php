<?php

class Model_search extends CI_Model{

    public function get_search() // Fonction appelée par la fonction get_search du controller search
    {
        $recherche = $this->input->post('search_value'); // Récupération du texte recherché
        $this->db->like('produit_nom', $recherche)->limit(10); // Sélection du nom produit selon la recherche, limité à 10 résultats
        $this->db->or_like('produit_marque', $recherche); // Ou sélection par la marque du produit
        $select = $this->db->get('produit'); // Affectation des résultats à la variable $select
        return $select->result_array(); // Envoie des résultats en tableau
    }
}