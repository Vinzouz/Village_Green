<?php

class Model_espaceclient extends CI_Model
{
    public function getClient() // Fonction appelée dans la fonction espaceC du controller espaceclient
    { // Fonction qui sert à récupérer les infos nécessaires sur le client

        $user_id = $this->session->userdata('user_id'); // Récupération de l'id client selon les données de session

        if ($user_id > 0) { // Si l'id est correct
            $this->db->select('client_id, client_nom, client_prenom, client_adresse, client_ville, client_codepo, client_telephone, client_mail, client_type, client_siret, client_role_id, client_commerciaux_id');
            $this->db->from('clients'); // Sélection des champs nécessaires de la table clients
            $this->db->where('client_id', $user_id);  // Selon l'id récupérée
            $select = $this->db->get(); // Affectation du résultat à la variable $select

            return $select->result(); // Envoie du résultat en objet
        }
         else { // Si l'id est incorrect renvoie false
            return false;
        }
    }

    public function getEspaceC() // Fonction appelée dans la fonction espaceC du controller espaceclient
    { // Fonction qui relie les commandes potentiellement présentes avec l'id du client

        $user_id = $this->session->userdata('user_id'); // Récupération de l'id du client selon l'id de session

        if ($user_id > 0) { // Si l'id est correct

            $this->db->select('*');
            $this->db->from('clients'); // Sélection de tous les champs de la table clients et commande
            $this->db->join('commande', 'clients.client_id = commande.commande_client_id'); // Jointure selon l'id du client
            $this->db->where('client_id', $user_id); // Où l'id du client est égal à celui récupéré
            $select = $this->db->get(); // Affectation dur ésultat à la variable $select

            return $select->result(); // Renvoie du résultat en objet
        } else { // Si l'id est incorrect renvoie false
            return false;
        }
    }

    public function getCommande($idcommande){ // Fonction appelée dans la fonction detailsCommande du controller espaceclient

        $this->db->select('*');
        $this->db->from('secomposede'); // Sélection de tous les champs de la table commande et secomposede
        $this->db->join('commande', 'secomposede.secomposede_commande_id = commande.commande_id'); // Jointure selon l'id de commande
        $this->db->where('commande_id', $idcommande); // Où l'id de la commande est égal à celui passé en paramètre
        $select = $this->db->get(); // Affectation du résultat à la variable $select

        return $select->result(); // Renvoie du résultat en objet
    }
}
