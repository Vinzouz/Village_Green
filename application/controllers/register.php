<?php
    defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

    class register extends CI_Controller
    {
        public function index()
        {

        }

        public function store() // Fonction store qui reçoit les informations du formulaire d'inscription
        {
            // Vérification de tous les champs pour éviter les erreurs
            $this->form_validation->set_rules( 'InsclientNom', 'InsclientNom', 'trim|required|min_length[2]|regex_match[/^([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})[-\'\s]{0,1}([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})[-\s]{0,1}([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})$/]',
            array(
                    "required"      => "Nom non défini",
                    "regex_match"     => "Le nom est incorrect",
                    "min_length"    => "Le nom est trop court",
                    "trim"  => "Des espaces dans le nom sont présents"
            ) );
            $this->form_validation->set_rules( 'InsclientPrenom', 'InsclientPrenom', 'trim|required|min_length[2]|regex_match[/^([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})[-\'\s]{0,1}([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})[-\s]{0,1}([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})$/]',
            array(
                    "required"      => "Prénom non défini",
                    "regex_match"     => "Le prénom est incorrect",
                    "min_length"    => "Le prénom est trop court",
                    "trim"  => "Des espaces dans le prénom sont présents" ) );
            $this->form_validation->set_rules( 'InsclientAdresse', 'InsclientAdresse', 'trim|required|regex_match[/^\d+([,]?)+\s[A-z]+\s[A-z]+/]',
            array(
                    "required"      => "Adresse non définie",
                    "regex_match"     => "L'adresse est incorrecte",
                    "trim"  => "Des espaces dans l'adresse sont présents" ) );
            $this->form_validation->set_rules( 'InsclientCodeP', 'InsclientCodeP', 'trim|required|min_length[5]|max_length[5]|regex_match[/^\d{5}$/]',
            array(
                    "required"      => "Code postal non défini",
                    "regex_match"     => "Le code postal est incorrect",
                    "min_length"    => "Le code postal est trop court",
                    "max_length"    => "Le code postal est trop long",
                    "trim"  => "Des espaces dans le code postal sont présents" ) );
            $this->form_validation->set_rules( 'InsclientVille', 'InsclientVille', 'trim|required|min_length[1]|regex_match[/^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'"-\/\s]{1,40}$/]',
            array(
                    "required"      => "Ville non définie",
                    "regex_match"     => "La ville est incorrecte",
                    "min_length"    => "La ville est trop courte",
                    "trim"  => "Des espaces dans la ville sont présents" ) );
            $this->form_validation->set_rules( 'InsclientTel', 'InsclientTel', 'trim|required|min_length[10]|regex_match[/^([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)$/],
            array(
                    "required"      => "Téléphone non défini",
                    "regex_match"     => "Le téléphone est incorrect",
                    "min_length"    => "Le téléphone est trop courte",
                    "trim"  => "Des espaces dans le téléphone sont présents" )' );
            $this->form_validation->set_rules( 'InsclientMail', 'InsclientMail', 'trim|required|valid_email|is_unique[clients.client_mail]|regex_match[/([a-zA-Z0-9-_]{1,20})+(\.[a-zA-Z0-9-_]{1,20})*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]{1,20})*\.[a-zA-Z]{2,4}/]',
            array(
                    "required"      => "Mail non défini",
                    "regex_match"     => "Le mail est incorrect",
                    "valid_email"     => "Le mail est invalide",
                    "is_unique"     => "Le mail existe déjà",
                    "trim"  => "Des espaces dans le mail sont présents" ) );
            //password
            $this->form_validation->set_rules( 'InsclientPass', 'InsclientPass', 'trim|required|min_length[4]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/]',
            array(
                    "required"      => "Mot de passe non défini",
                    "regex_match"     => "Le mot de passe est incorrect",
                    "min_length"    => "Le mot de passe est trop court",
                    "trim"  => "Des espaces dans le mot de passe sont présents" ) );
            $this->form_validation->set_rules( 'InsclientPassV', 'InsclientPassV', 'trim|required|min_length[3]|matches[InsclientPass]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/]',
            array(
                    "required"      => "Vérification du mot de passe non défini",
                    "regex_match"     => "La vérification du mot de passe est incorrecte",
                    "min_length"    => "La vérification du mot de passe est trop courte",
                    "matches"   =>  "Les mots de passe ne correspondent pas",
                    "trim"  => "Des espaces dans la vérification du mot de passe sont présents" ) );

            if ( $this->form_validation->run() == FALSE ) { // Si erreur du formulaire
                $data = array( 'errors' => validation_errors('<p style="color:red">', '</p>') ); // Affectation des erreurs à la variable $data
                $this->session->set_flashdata( $data ); // Redirection et affichage des erreurs
                redirect( 'home/inscription' );
            } else { // Si aucune erreur de formulaire
                $data = array( // Affectation des input aux champs relatif en BDD dans un tableau
                    'client_nom' => $this->input->post( 'InsclientNom' ),
                    'client_prenom' => $this->input->post( 'InsclientPrenom' ),
                    'client_adresse' => $this->input->post( 'InsclientAdresse' ),
                    'client_ville' => $this->input->post( 'InsclientVille' ),
                    'client_codepo' => $this->input->post( 'InsclientCodeP' ),
                    'client_telephone' => $this->input->post( 'InsclientTel' ),
                    'client_mail' => $this->input->post( 'InsclientMail' ),
                    'client_type' => $this->input->post( 'InsclientType' ),
                    'client_siret' => $this->input->post( 'InsclientSiret' ),
                    'client_password' => password_hash($this->input->post( 'InsclientPass' ), PASSWORD_DEFAULT),
                    'client_role_id' => 2
                );
                $nom = $this->input->post( 'InsclientNom' ); // Récupération du nom du client

                $this->load->model( 'Model_register' ); // Chargement du modèle pour la fonction
                $user_id = $this->Model_register->clientStore( $data ); // Envoi du tableau à fonction clientStore du modèle register et récupération de l'id du client
                
                if ( $user_id > 0 ) { // Si l'id renvoyé est correct
                    $user_data = array( // Affectation des données de session en tableau
                        'user_id' => $user_id,
                        'username' => $nom,
                        'role' => $data['client_role_id'],
                        'logged_in' => true
                    );

                    require 'PHPMailer/sendmail.php'; // Appel du fichier nécessaire de PHPMailer avec ses fonctions pour envoyer un mail
                    $Subject = 'Inscription à Village Green'; // Initialisation du sujet du mail
                    $Body    = "<p>Bonjour  $nom , ceci est un mail automatique pour vous prévenir que vous êtes bien inscrit sur Village Green.</p>"; // Initialisation du corps du mail avec les données nécessaires
                    envoyermail($user_mail, $Subject, $Body); // Envoye de l'email avec comme paramètres le mail du client, le sujet et le corps du mail
                    $this->session->set_userdata( $user_data ); // Initialisation de données de session
                    $this->session->set_flashdata( 'login', 'Vous êtes connecté ' ); // Données flash
                } else { // Si erreur avec l'id
                    $this->session->set_flashdata( 'failed', 'Vous n\'êtes pas connecté' );
                }
                redirect( '' ); // Redirection page d'accueil
            }
        }

        public function logout() // Fonction qui sert à déconnecter le compte
        {
            $this->session->sess_destroy(); // Suppression de toutes les données de session puis redirection accueil
            redirect('');
        }
    }