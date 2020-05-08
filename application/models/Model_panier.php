<?php

class Model_panier extends CI_Model
{

    public function getinfosproduit($idP) // Fonction appelée par la fonction ajoutPanier du controller panier
    { // Fonction qui sert à selectionner les infos produit selon l'id passé en paramètre
        $this->db->select('*'); // Sélection de tous les champs de la table produit
        $this->db->from('produit');
        $this->db->where('produit_id', $idP); // Où son id est égal à celui passé en paramètre
        $select = $this->db->get(); // Affectation du résultat à la variable $select

        return $select->result_array(); // Envoie du résultat en tableau
    }

    public function commander($data) // Fonction appelée par la fonction commander du controller panier
    { // Fonction qui sert à rentrer les informations de commande dans la table commande
        $this->db->insert('commande', $data); // Insertion des données dans la table
        $insert_id = $this->db->insert_id(); // Récupération de la dernière id insérée
        $this->db->where('commande_id', $insert_id); // Récupéréation de la ligne grâce à l'id
        $result = $this->db->get('commande'); // Affectation du résultat à la variable $result

        if ($result) { // Si la commande est bien insérée
            return $insert_id; // Envoie de l'id
        } else { // Sinon renvoie false
            return false;
        }
    }

    public function rentreeproduitcommande($idcommande) // Fonction appelée par la fonction commander du controller panier
    { // Fonction qui sert à rentrer les informations de la commande dans la table secomposede
        $panier = $_SESSION['panier']; // Récupération du panier grâce à la session

        foreach ($panier as $key) { // On parcourt le tableau pour chaque produit

            // Toutes les instructions vont s'éxecuter pour chaque ligne du panier
            $this->db->select('produit_qtite'); // Sélection de la quantité du produit
            $this->db->from('produit'); // Depuis la table produit
            $this->db->where('produit_id', $key[0]['produit_id']); // Où l'id est égal à celui en panier
            $select = $this->db->get(); // Affectation du résultat à la variable $select
            $dataP = $select->result_array(); // Affectation du résultat en tableau
            
            $data = array( // Affectation des champs relatif à ceux en BDD avec les données du panier
                "secomposede_commande_id" => $idcommande,
                "secomposede_produit_id" => $key[0]['produit_id'],
                "secomposede_qtite_commande" => $key[1],
                "secomposede_prix_vente" => $key[0]['produit_prix_HT']
            );
            $array = array( // Affectation de la nouvelle quantité du produit pour update
                "produit_qtite" => $dataP[0]['produit_qtite'] - $key[1] // La nouvelle quantité est égal à celle récupérée en BDD - la quantité du produit du panier
            );
            $this->db->insert('secomposede', $data); // Insertion des donnés dans la table secomposede

            $this->db->where('produit_id', $key[0]['produit_id']); // Sélection de la ligne du produit selon l'id
            $this->db->update('produit', $array); // Et update de la quantité produit
        }
    }

    public function dernierecommande() // Fonction appelée par la fonction reussiteCommande du controller panier
    { // Fonction qui sert à sélectionner la dernière commande du client

        $user_id = $this->session->userdata('user_id'); // Récupération de l'id du client avec la session
        $this->db->select('commande_id');
        $this->db->from('commande'); // Sélection de l'id de commande dans la table commande où l'id est égal à l'id user
        $this->db->where('commande_client_id', $user_id);
        $this->db->order_by('commande_id', 'DESC'); // Par ordre décroissant et limité à 1 résultat
        $this->db->limit(1);
        $select = $this->db->get(); // Affectation du résultat à la variable $select

        return $select->result_array(); // Envoie du résultat en tableau
    }

    public function jointureSousrubRub($idP) // Fonction appelée par la fonction index du controller ficheproduit
    { // Fonction qui sert à rejoindre les id des rubriques aux sous rubriques et aux produits
        $this->db->select('produit.produit_id, sous_rubrique.sousrub_id, rubrique.rubrique_id, sous_rubrique.sousrub_nom, rubrique.rubrique_nom');
        $this->db->from('produit'); // Sélection des id et des noms des rubriques, sous rubriques et produits
        $this->db->join('sous_rubrique', 'sousrub_id = produit_sousrub_id'); // Jointure avec la table sous rubrique
        $this->db->join('rubrique', 'rubrique_id = sousrub_rubrique_id'); // Jointure avec la table rubrique
        $this->db->where('produit_id', $idP ); // Où l'id du produit est égal à celui en paramètre
        $select = $this->db->get(); // Affectation du résultat à la varibale $select
        return $select->result_array(); // Envoie du résultat en tableau
    }
}
