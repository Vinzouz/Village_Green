<?php

class Model_connection extends CI_Model
{

    public function login() // Fonction appelée dans la fonction login du controller connexion
    { // Réception des données de connexion

        $clientMail = $this->input->post('client_mail'); // Récupération de l'input du mail
        $this->db->where('client_mail', $clientMail); // Recherche du mail dans la BDD
        $select = $this->db->get('clients'); // Affectation du résultat à la variable $select
        
        if ($select) { // Si client trouvé grâce au mail
            $selectUser = $select->row_array(); // Affectation du résultat en tableau
            $pHash = $selectUser['client_password']; // Récupération du mot de passe haché de l'input mot de passe
            $clientPassword = $this->input->post('client_password');  // Récupération du mot de passe haché en BDD
            if (password_verify($clientPassword, $pHash)) { // Vérification que le hash correspond
                return $selectUser; // Si oui, retour des informations de l'utilisateur
            }
        } else { // Si aucun mail trouvé
            return false; // Retourne false
        }
    }

    public function getUserdata() // Fonction appelée dans la fonction edit du controller connexion
    {
        // Sélection des données clients pour l'affichage dans le formulaire d'édition
        $user_id = $this->session->userdata('user_id'); // Affectation de l'id selon l'id utilisateur en session

        if ($user_id > 0) { // Si l'id est correct

            $this->db->where('client_id', $user_id); // Sélection du client selon son id
            $result = $this->db->get('clients'); // Affectation du résultat dans la variable $result

            return $result->row_array(); // Envoie du résultat en tableau
        } else { // Si l'id est incorrect renvoie false
            return false;
        }
    }

    public function updateUser($data) // Fonction appelée dans la fonction updateUser du controller connexion
    {
        // Réception des données du formulaire pour update en BDD
        $clientId = $this->session->userdata('user_id'); // Récupération de l'id client avec la session
        $clientPassword = $this->input->post('InsclientPass'); // Récupération de l'input du mot de passe
        $this->db->where('client_id', $clientId); // Sélection du client selon son id
        $select = $this->db->get('clients'); // Affectation du résultat à la variable $select
        $selectUser = $select->row_array(); // Affectation en tableau du résultat

        if ($selectUser) { // Si l'utilisateur est trouvé
            $pHash = $selectUser['client_password']; // Récupération et affectation du mot de passe haché de la BDD
            
            if (password_verify($clientPassword, $pHash)) { // Si le mot de passe correspond à la bdd
                $this->db->set($data); // Définit les valeurs d'update
                $this->db->where('client_id', $clientId); // Sélection de la sous-rubrique à update
                $this->db->update('clients'); // Update
                return $selectUser; // Envoie des informations client
            }
        } else { // Si l'utilisateur n'est pas trouvé ou mot de passe incorrect renvoie false
            return false;
        }
    }
}
