<?php

class admin extends CI_Controller
{

  public function __construct() // Fonction constructrice qui charge les modèles pour tout le controller
  {
    parent::__construct();
    $this->load->model('Model_espaceclient');
  }

  public function index() // Fonction index qui charge la page 'menu' du panel admin
  {
    if (isset($this->session->userdata)) { // Vérification si l'utilisateur est connecté
      $data['dataC'] = $this->Model_espaceclient->getClient(); // Récupération des données du client dans un tableau depuis la fonction getClient du modèle espace client

      if ($data['dataC'] != null) { // Vérification si le tableau n'est pas vide
        if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {
          // Vérification si l'utilisateur à le role_id 1 qui est égal au rôle admin et si son id est égal à 101, 102 ou 103
          // qui sont les seuls comptes autorisés

          // Chargement des vues et envoie du tableau de données à la navbar admin pour afficher certaines infos
          $this->load->view('admin/partials/header');

          $this->load->view('admin/partials/navbar', $data);

          $this->load->view('admin/blank');

          $this->load->view('admin/partials/footer');
        }
      }
    }
  }
}
