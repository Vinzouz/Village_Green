<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Lostpass extends CI_Controller
{

    public function __construct() // Fonction constructrice qui charge les modèles pour tout le controller
    {
        parent::__construct();
        $this->load->model('Model_lostpass');
    }

    public function index() // Fonction index qui charge la vue pour rentrer le mail du mot de passe perdu
    { // Simple chargement des vues nécessaires
        $this->load->view('include/incl_loader');
        $this->load->view('include/incl_head');
        $this->load->view('login/incl_formlostpass');
        $this->load->view('include/incl_script');
    }

    public function envoie() // Fonction envoie qui reçoit l'email du mot de passe perdu
    {
        // Vérification de l'input de l'email pour éviter les erreurs
        $this->form_validation->set_rules('client_mail', 'ConclientMail', "trim|required|valid_email");

        if ($this->form_validation->run() == FALSE) { // Si erreur du formulaire
            $data = array('errors' => validation_errors()); // Affectation des erreurs à la variable $data
            $this->session->set_flashdata($data); // Redirection et affichage des erreurs
            redirect('lostpass/index');
        } else { // Si aucune erreur du formulaire
            $result = $this->Model_lostpass->envoie(); // Appel de la fonction envoie du modèle lostpass et récupération des données client selon le mail

            if ($result) { // Si le client existe bien
                $user_id = $result['client_id'];
                $user_mail = $result['client_mail'];
                $user_data = array( // Récupération et affectation en tableau de l'id et du mail
                    'user_id' => $user_id,
                    'user_mail' => $user_mail
                );
                $this->session->set_userdata($user_data); // Affectation à des données flash
                $clealeatoire = $this->genererChaine(64); // Génération d'un nombre aléatoire grâce à la fonction genererChaine présente dans le controller
                $data = array( // Affectation en tableau du mail et du nombre aléatoire
                    'clients_temporaire_mail' => $user_mail,
                    'clients_temporaire_code' => $clealeatoire
                );

                require 'PHPMailer/sendmail.php'; // Appel du fichier nécessaire de PHPMailer avec ses fonctions pour envoyer un mail
                $Subject = 'Réinitialisation du mot de passe'; // Initialisation du sujet du mail
                $Body    = "<p>Bonjour  $user_mail , une réinitialisation du mot de passe a été lancée, voici votre code unique : $clealeatoire .</p>"; // Initialisation du corps du mail avec les données nécessaires
                $send = envoyermail($user_mail, $Subject, $Body); // Envoye de l'email avec comme paramètre le mail du client, le sujet et le corps du mail

                if ($send == 1) { // Si l'email a bien été envoyé
                    // Appel de la fonction insert_clients_temporaire dans le modèle lostpass pour rentrer les infos du client dans une table temporaire
                    $this->Model_lostpass->insert_clients_temporaire($data);
                    // Et chargement des vues dont le formulaire pour rentrer le code reçu par mail
                    $this->load->view('include/incl_loader');
                    $this->load->view('include/incl_head');
                    $this->load->view('login/incl_formcode');
                    $this->load->view('include/incl_script');
                }
            } else { // Si le client n'est pas trouvé par son mail
                $this->session->set_flashdata('failed', 'Aucun email correspondant'); // Initilisation de données flash
                redirect('connexion/index'); // Redirection à la page de connexion
            }
        }
    }

    public function verif() // Fonction verif qui reçoit l'input du code reçu par mail
    {
        // Vérfication de l'input du code pour éviter les erreurs
        $this->form_validation->set_rules('client_temporaire_code', 'Code', 'trim|required|min_length[6]');
        if ($this->form_validation->run() == FALSE) { // Si erreur du formulaire
            $data = array('errors' => validation_errors()); // Affectation des erreurs à la variable $data
            $this->session->set_flashdata($data); // Redirection et affichage des erreurs
            redirect('');
        } else { // Si aucune erreur du formulaire

            $result = $this->Model_lostpass->verif(); // Appel de la fonction verif du modèle lostpass et récupération des données client de la table temporaire

            if ($result) { // Si le client a été trouvé dans la table des clients temporaire
                // Chargement des vues dont le formulaire pour changer le mot de passe
                $this->load->view('include/incl_loader');
                $this->load->view('include/incl_head');
                $this->load->view('login/incl_formnewpass');
                $this->load->view('include/incl_script');
            } else { // Si le client n'est pas trouvé ou que le code n'est pas bon
                redirect('login/incl_formcode'); // Redirection à la page pour rentrer le code
            }
        }
    }

    public function updatepass() // Fonction updatepass qui reçoit le nouveau mot de passe pour modification après mot de passe perdu
    {

        // Vérification du mot de passe et de sa vérification pour éviter les erreurs
        $this->form_validation->set_rules('client_newpass', 'client_newpass', 'trim|required|min_length[4]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/]', array(
            'required'      => 'Le champ est requis.',
            'min_length'     => 'La taille minimale du mot de passe doit être de 4.',
            'regex_match'     => 'Le format du mot de passe ne correspond pas aux normes attendues.'
        ));
        $this->form_validation->set_rules('client_validnewpass', 'client_validnewpass', 'trim|required|min_length[3]|matches[client_newpass]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/]', array(
            'required'      => 'Le champ est requis.',
            'min_length'     => 'La taille minimale du mot de passe doit être de 4.',
            'regex_match'     => 'Le format du mot de passe ne correspond pas aux normes attendues.',
            'matches'     => 'La validaiton du mot de passe ne correspondant pas au premier.'
        ));

        if ($this->form_validation->run() == FALSE) { // Si erreur du formulaire 
            $data = array('errors' => validation_errors('<p style="color: red" >', '</p>')); // Affectation des erreurs à la variable $data
            $this->session->set_flashdata($data); // Données flash d'erreur du formulaire
            // Chargement de vues qui sert de redirection
            $this->load->view('include/incl_loader');
            $this->load->view('include/incl_head');
            $this->load->view('login/incl_formnewpass');
            $this->load->view('include/incl_script');
        } else { // Si aucune erreur du formulaire

            $result = $this->Model_lostpass->updatepass(); // Appel de la fonction updatepass du modèle lostpass et récupération de true si aucune erreur 

            if ($result) { // Si $result est sur true
                $user_mail = $this->session->userdata('user_mail'); // Récupération du mail client par donnée de session
                require 'PHPMailer/sendmail.php'; // Appel du fichier nécessaire de PHPMailer avec ses fonctions pour envoyer un mail
                $Subject = 'Mot de passe réinitialisé'; // Initialisation du sujet du mail
                $Body    = "<p>Bonjour  $user_mail , votre mot de passe a bien été réinitialisé.</p>"; // Initialisatio du corps du mail
                envoyermail($user_mail, $Subject, $Body); // Envoie du mail
                redirect(''); // Redirection page d'accueil
            } else { // Si $result est sur false
                redirect('login/incl_formnewpass'); // Redirection à la page de changement de mot de passe
            }
        }
    }

    function genererChaine($longueur) // Fonction qui sert à génerer une chaine et de choisir sa longueur par le chiffre passé en paramètre
    {
        $listeCar = '0123456789abcdef';
        $chaine = '';
        for ($i = 0; $i < $longueur; ++$i) {
            $chaine .= $listeCar[random_int(0, 6)];
        }
        return $chaine;
    }
}
