<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ficheproduit extends CI_Controller
{

    public function __construct(){ // Fonction constructrice qui charge les modèles pour tout le controller
		parent::__construct();
        $this->load->model('Model_home');
        $this->load->model('Model_panier');
	}

    public function index($idP) // Fonction index qui charge la fiche d'un produit avec son id en paramètre
    {
        $array['jointureSousrubRub'] = $this->Model_panier->jointureSousrubRub($idP); // Récupération des infos des rubriques et sous rubriques liées au produit 
        $array['getdataProduit'] = $this->Model_panier->getinfosproduit($idP); // Récupération dans un tableau des infos produit renvoyé par la fonction getinfosproduit du modèle panier
        $data['getRubriques'] = $this->Model_home->getRubriques(); // Récupération dans un tableau des rubriques liées au sous rubriques renvoyé par la fonction getRubriques du modèle home
        // Chargement des vues et envoie des différents tableaux
        $this->load->view( 'include/incl_loader' );
        $this->load->view('include/incl_navbar', $data);
        $this->load->view('include/incl_head');
        $this->load->view('products/ficheproduit', $array);
        $this->load->view('include/incl_footer');
        $this->load->view('include/incl_script');
    }
}
