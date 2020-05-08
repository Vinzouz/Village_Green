<?php

class products extends CI_Controller
{

    public function __construct() // Fonction constructrice qui charge les modèles pour tout le controller
    {
        parent::__construct();
        $this->load->model('Model_products');
        $this->load->model('Model_home');
    }

    public function getRubrique($Rubrique_id) // Fonction getRubrique qui sert à charger les cards des différentes sous-rubriques
    {
        $data['getRubrique'] = $this->Model_products->getRubrique($Rubrique_id); // Récupération dans un tableau des rubriques liées aux sous rubriques renvoyé par la fonction getRubrique du modèle products
        $array['getRubriques'] = $this->Model_home->getRubriques(); // Récupération dans un tableau des rubriques liées au sous rubriques renvoyé par la fonction getRubriques du modèle home
        $prod['carrousel_produit'] = $this->Model_home->carrousel_produit(); // Récupération dans un tableau de produits aléatoires pour le carousel renvoyé par la fonction carrousel_produit du modèle home
        // Chargement des vues et envoie des tableaux aux différentes vues
        $this->load->view('include/incl_loader');
        $this->load->view('include/incl_navbar', $array);
        $this->load->view('include/incl_head');
        $this->load->view('products/sous_rubriques', $data);
        $this->load->view('include/incl_carrousel_produit', $prod);
        $this->load->view('index/incl_avantages');
        $this->load->view('include/incl_footer');
        $this->load->view('include/incl_script');
    }

    public function getSousRubrique($SousRubrique_id) // Fonction getSousRubrique qui sert à charger les cards des produits selon la sous-rubrique
    {
        $data['getRubriques'] = $this->Model_home->getRubriques(); // Récupération dans un tableau des rubriques liées au sous rubriques renvoyé par la fonction getRubriques du modèle home
        $array['getRubriques'] = $this->Model_home->getRubriques(); // Récupération dans un autre tableau des rubriques liées au sous rubriques renvoyé par la fonction getRubriques du modèle home
        $data['getSousRubrique'] = $this->Model_products->getSousRubrique($SousRubrique_id); // Récupération dans un tableau des sous rubriques liées aux produits renvoyé par la fonction getRubrique du modèle products
        $prod['carrousel_produit'] = $this->Model_home->carrousel_produit(); // Récupération dans un tableau de produits aléatoires pour le carousel renvoyé par la fonction carrousel_produit du modèle home
        // Chargement des vues et envoie des tableaux aux différentes vues
        $this->load->view('include/incl_loader');
        $this->load->view('include/incl_navbar' , $array);
        $this->load->view('include/incl_head');
        $this->load->view('products/produits', $data);
        $this->load->view('include/incl_carrousel_produit', $prod);
        $this->load->view('index/incl_avantages');
        $this->load->view('include/incl_footer');
        $this->load->view('include/incl_script');
    }
}
