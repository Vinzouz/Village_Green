<?php

class connexion extends CI_Controller
{

    public function __construct() // Fonction constructrice qui charge les modèles pour tout le controller
    {
        parent::__construct();
        $this->load->model('Model_connection');
        $this->load->model('Model_espaceclient');
        $this->load->model('Model_home');
    }

    public function index() // Fonction index qui charge le formulaire de connexion
    {
        $this->load->view('include/incl_head');
        $this->load->view('login/incl_formconnexion');
        $this->load->view('include/incl_script');
    }

    public function login() // Fonction login qui reçoit les informations de connexion
    {
        // Vérification de l'email et du mot de passe 
        $this->form_validation->set_rules(
            'client_mail',
            'ConclientMail',
            'trim|required|valid_email',
            array(
                "required"      => "Le mail n'est pas rempli",
                "valid_email"     => "Le mail n'est pas valide",
                "trim"  => "Des espaces dans l'email sont présents"
            )
        );
        $this->form_validation->set_rules(
            'client_password',
            'ConclientPass',
            'trim|required|min_length[4]',
            array(
                "required"      => "Le mot de passe n'est pas rempli",
                "min_length"     => "Le mot de passe est trop court",
                "trim"  => "Des espaces dans le mot de passe sont présents"
            )
        );

        if ($this->form_validation->run() == FALSE) { // Si erreur avec le formulaire
            $data = array('errors' => validation_errors('<p style="color:red">', '</p>')); // Affectation des erreurs à la variable $data
            $this->session->set_flashdata($data); // Redirection et affichage des erreurs
            redirect('connexion/index');
        } else { // Si aucune erreur, envoie des posts à la fonction login du modèle connection
            $result = $this->Model_connection->login(); 
            // Affectation du retour à la variable $result
            $user_id = $result['client_id']; // Affectation à la variable ûser_id grâce au retour

            if ($user_id > 0) { // Si l'id du client est correct
                $user_data = array( // Création des données de session dans un tableau
                    'user_id' => $user_id,
                    'username' => $result['client_nom'], // Ici l'id, le nom, le rôle et si logged_in est sur true
                    'role' => $result['client_role_id'],
                    'logged_in' => true
                );
                $this->session->set_userdata($user_data); // Initialisation des données userdata en passant le tableau
                $this->session->set_flashdata('login', 'Vous êtes connecté '); // Initialisation de données 'flash' et redirection page d'accueil
                redirect('');
            } else { // Si l'id du client est incorrect
                $this->session->set_flashdata('errors', '<p style="color:red">Mauvais mail ou mot de passe incorrect</p>');
                $this->session->set_flashdata('failed', 'Vous n\'êtes pas connecté'); // Initialisation de données flash avec des erreurs
                redirect('connexion/index'); // Et redirection à la page du formulaire de connexion
            }
        }
    }

    public function edit() // Fonction edit qui permet de charge de formulaire d'édition de données client
    {
        if ($this->session->userdata('user_id') == null) { // Si l'id de l'utilisateur est incorrect, redirection à la page d'accueil
            redirect('');
        }
        $array['data'] =  $this->Model_connection->getUserdata(); // Récupération dans un tableau des données de l'utilisateur renvoyé par la fonction getUserdata du modèle connection
        // Chargement des vues et du formulaire d'édition avec les données utilisateur
        $this->load->view('include/incl_head');
        $this->load->view('login/incl_editaccount', $array);
        $this->load->view('include/incl_script');
    }

    public function updateUser() // Fonction update qui reçoit les informations du client
    {
        // Vérification que tous les champs sont remplis pour éviter les erreurs
        $this->form_validation->set_rules('InsclientNom', 'InsclientNom', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('InsclientPrenom', 'InsclientPrenom', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('InsclientAdresse', 'InsclientAdresse', 'trim|required');
        $this->form_validation->set_rules('InsclientCodeP', 'InsclientCodeP', 'trim|required|min_length[5]|max_length[5]');
        $this->form_validation->set_rules('InsclientVille', 'InsclientVille', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('InsclientTel', 'InsclientTel', 'trim|required|min_length[10]');
        $this->form_validation->set_rules('InsclientMail', 'InsclientMail', 'trim|required|valid_email');
        $this->form_validation->set_rules('InsclientPass', 'InsclientPass', 'trim|required|min_length[4]');

        if ($this->form_validation->run() == FALSE) { // Si erreur du formulaire 
            $data = array('errors' => validation_errors()); // Affectation des erreurs à la variable $data
            $this->session->set_flashdata($data); // Redirection et affichage des erreurs
            redirect('welcome/inscription');
        } else { // Si aucune erreur, affectation des POSTS aux différents champs présents en BDD
            $data = array(
                'client_nom' => $this->input->post('InsclientNom'),
                'client_prenom' => $this->input->post('InsclientPrenom'),
                'client_adresse' => $this->input->post('InsclientAdresse'),
                'client_ville' => $this->input->post('InsclientVille'),
                'client_codepo' => $this->input->post('InsclientCodeP'),
                'client_telephone' => $this->input->post('InsclientTel'),
                'client_mail' => $this->input->post('InsclientMail'),
                'client_type' => $this->input->post('InsclientType'),
                'client_siret' => $this->input->post('InsclientSiret'),
                'client_password' => password_hash($this->input->post('InsclientPass'), PASSWORD_DEFAULT)
            );
            // Envoie des posts à la fonction updateUser dans le modèle connection
            $dataUser = $this->Model_connection->updateUser($data); // Récupération dans un tableau des données de l'utilisateur renvoyé par la fonction getUserdata du modèle connection
            
            if ($dataUser) { // Si l'utilisateur existe et a été update
                $user_data = array( // Affectation des nouvelles données dans un tableau pour la session
                    'user_id' => $dataUser['client_id'],
                    'username' => $dataUser['client_nom'],
                    'role' => $dataUser['client_role_id'],
                    'logged_in' => true
                );
                $this->session->set_userdata($user_data); // Nouvelle initialisation des données de session utilisateur
            }
            redirect('connexion/edit'); // Redirection au formulaire
        }
    }
}
