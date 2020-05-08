<?php

class search extends CI_Controller{

    public function __construct() // Fonction constructrice qui charge les modèles pour tout le controller
    {
        parent::__construct();
        $this->load->model('Model_search');
    }

    public function get_search() // Fonction get search appelée par le script jQuery de la searchbar
    {
        $result = $this->Model_search->get_search(); // Appel de la méthode get_search du modèle search et récupération des données dans la variable $result
        echo json_encode($result); // Affichage direct des données avec le json_encode pour que le script se serve des données
    }
}