<?php

    class Model_register extends CI_Model
    {

        public function clientStore( $data ) // Fonction appelée dans la fonction Store du controller register
        { // Fonction pour ajouter un nouveau client
            $this->db->insert( 'clients', $data ); // Insertion des données dans la table clients
            $insert_id = $this->db->insert_id(); // Récupération de la dernière id rajoutée
            $this->db->where( 'client_id', $insert_id ); // Et sélection de la ligne
            $result = $this->db->get( 'clients' ); // Affectation du résultat à la variable $result

            if ( $result ) { // Si le client est trouvé
                return $insert_id; // Envoie de l'id du client
            } else { // Sinon renvoie false
                return false;
            }
        }
    }