<?php

class Model_home extends CI_Model {

    public function getRubriques(){ // Fonction appelée dans la fonction index du controller home

        $parents =  $this->db->get('rubrique'); // Sélection de la table des rubriques
        $parents = $parents->result_array(); // Affectation du résultat en tableau
        
        foreach($parents as $key=> $parent){ // Boucle pour chaque résultat de rubrique

            //echo $parent->rubrique_id;
            $this->db->where('sousrub_rubrique_id', $parent['rubrique_id']); // Sélection des sous rubriques qui ont l'idée de la rubrique
            $child = $this->db->get('sous_rubrique'); // Affectation du résultat à la variable $child
            $parents[$key]['child'] = $child->result_array(); // Affectation en tableaux pour chaque rubrique
        }
        return $parents; // Renvoie le tableau en entier
    }

    public function carrousel_produit(){ // Fonction appelée dans la fonction index du controller home

        $this->db->select('*'); // Sélection de tous les champs
        $this->db->from('sous_rubrique')->order_by('produit_id', 'RANDOM')->limit(12); // De la table sous-rubrique par ordre d'id qui choisit aléatoirement 12 résultats
        $this->db->join('produit', 'produit_sousrub_id = sousrub_id'); // Jointure de la table produit par id de sous rubrique
        $selected = $this->db->get(); // Affectation du resultat à la variable $selected

        return $selected->result(); // Renvoie du résultat en objet
    }
}