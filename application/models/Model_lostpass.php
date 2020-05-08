<?php

class Model_lostpass extends CI_Model
{

    public function envoie() // Fonction appelée dans la fonction envoie du controller lostpass
    { // Fonction qui reçoit l'input du mail du client qui a perdu son mot de passe

        $clientMail = $this->input->post('client_mail'); // Récupération de l'input mail
        $this->db->where('client_mail', $clientMail); // Sélection de la ligne du client selon l'input du mail
        $select = $this->db->get('clients'); // Affectation du résultat à la variable $select
        $selectUser = $select->row_array(); // Affectation du résultat en tableau

        if ($selectUser) { // Si le client existe
            return $selectUser; // Envoie la ligne du client
        } else { // Si aucun client trouvé renvoie false
            return false;
        }
    }


    public function verif() // Fonction appelée dans la fonction verif du controller lostpass
    { // Fonction qui reçoit l'input du code de vérification reçu par mail

        $code = $this->input->post('client_temporaire_code'); // Récupération de l'input du code 
        $email = $this->session->userdata('user_mail'); // Récupération du mail du client par les données session
        $this->db->where('clients_temporaire_mail', $email); // Sélection de la ligne si l'email correspond à l'email
        $this->db->where('clients_temporaire_code', $code); // Ainsi que le code
        $select = $this->db->get('clients_temporaire'); // Affectation du résultat à la variable $select
        $selectUser = $select->row_array(); // Affectation du résultat en tableau

        if ($selectUser) { // Si le client temporaire à été trouvé et le code est bon
            $this->db->where('clients_temporaire_mail', $email); // Sélection de la ligne
            $this->db->delete('clients_temporaire'); // Et suppression de la table temporaire
            return $selectUser; // Envoie de la ligne récupérée avant suppression
        } else { // Si client non trouvé renvoie false
            return false;
        }
    }

    public function updatepass() // Fonction appelée dans la fonction updatepass du controller lostpass
    { // Fonction qui reçoit le mot de passe changé par l'input

        $data = array( // Hachage du mot de passe et mise en tableau
            "client_password" => password_hash($this->input->post('client_newpass'), PASSWORD_DEFAULT)
        );

        $user_id = $this->session->userdata('user_id'); // Récupération de l'id client par donnée de session
        $user_mail = $this->session->userdata('user_mail'); // Et l'email du client

        try {
            $this->db->where('client_id', $user_id); // Sélection de la ligne du client par son id
            $this->db->where('client_mail', $user_mail); // Ainsi que son mail
            $this->db->update('clients', $data); // Update du mot de passe
            return true; // Renvoie true
        } catch (Exception $e) { // Si une seule erreur
            $warning = ['error' => $e]; // Affectation de l'erreur à la variable $warning
            $this->session->set_flashdata($warning); // Et initialisation de données flash
        }
    }

    public function insert_clients_temporaire($data) // Fonction appelée dans la fonction envoie du controller lostpass
    {
        $this->db->insert('clients_temporaire', $data); // Insertion de données temporaire du client si mot de passe perdu
    }
}
