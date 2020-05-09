<?php

class adminclients extends CI_Controller
{

    public function __construct() // Fonction constructrice qui charge les modèles pour tout le controller
    {
        parent::__construct();
        $this->load->model('Model_adminclients');
        $this->load->model('Model_espaceclient');
    }

    public function index() // Fonction index qui charge la liste d'utilisateurs
    {

        if (isset($this->session->userdata)) { // Vérification si l'utilisateur est connecté
            $data['dataC'] = $this->Model_espaceclient->getClient(); // Récupération des données du client dans un tableau depuis la fonction getClient du modèle espaceclient
            $data['users'] = $this->Model_adminclients->getUsers(); // Récupération de la table d'utilisateurs dans un tableau depuis la fonction getUsers du modèle adminclients
            if ($data['dataC'] != null) { // Vérification si le tableau n'est pas vide
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {
                    // Vérification si l'utilisateur à le role_id 1 qui est égal au rôle admin et si son id est égal à 101, 102 ou 103
                    // qui sont les seuls comptes autorisés

                    // Chargement des vues et envoie du tableau de données à la navbar admin pour afficher certaines infos
                    // Et envoie du tableau d'utilisateurs pour la liste
                    $this->load->view('admin/partials/header');

                    $this->load->view('admin/partials/navbar', $data);

                    $this->load->view('admin/adminclients/userslist', $data);

                    $this->load->view('admin/partials/footer');
                } else {
                    redirect(''); // Redirection page d'accueil si problème d'identification admin
                }
            } else {
                redirect(''); // Redirection page d'accueil si problème d'identification admin
            }
        } else {
            redirect(''); // Redirection page d'accueil si problème d'identification admin
        }
    }

    public function listeClients() // Liste des utilisateurs pouvant changer dynamiquement avec la recherche
    {

        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();
            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Récupération du POST normalement vide de base du script jQuery pour récupérer la liste entière d'utilisateurs
                    // Change en cas de recherche
                    $postData = $this->input->post();

                    // Envoie du POST à la fonction getClients du modèle adminclients
                    $data = $this->Model_adminclients->getClients($postData);
                    // Récupération des résultats dans la variable data

                    echo json_encode($data); // Affichage direct des données avec le json_encode afin que le script puisse utiliser les données
                } else {
                    redirect(''); // Redirection page d'accueil si problème d'identification admin
                }
            } else {
                redirect(''); // Redirection page d'accueil si problème d'identification admin
            }
        } else {
            redirect(''); // Redirection page d'accueil si problème d'identification admin
        }
    }


    public function deleteClient($id) // Fonction permettant de supprimer un utilisateur en passant son id
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();
            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    $this->Model_adminclients->deleteClient($id);
                    // Appel de la fonction deleteClient du modèle adminclients qui permet de supprimer un utilisateur en passant
                    // son id en paramètre puis redirection à la liste d'utilisateurs
                    redirect('adminclients/index');
                } else {
                    redirect(''); // Redirection page d'accueil si problème d'identification admin
                }
            } else {
                redirect(''); // Redirection page d'accueil si problème d'identification admin
            }
        } else {
            redirect(''); // Redirection page d'accueil si problème d'identification admin
        }
    }
}
