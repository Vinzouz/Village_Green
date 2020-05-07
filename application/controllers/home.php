<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends CI_Controller
{

	public function __construct(){ // Fonction constructrice qui charge les modèles pour tout le controller
		parent::__construct();
		$this->load->model('Model_home');
	}

	public function index() // Fonction index qui charge la page d'accueil
	{
        $data['getRubriques'] = $this->Model_home->getRubriques(); // Récupération dans un tableau des rubriques liées au sous rubriques renvoyé par la fonction getRubriques du modèle home
        $data['carrousel_produit'] = $this->Model_home->carrousel_produit(); // Récupération dans un tableau de produits aléatoires pour le carousel renvoyé par la fonction carrousel_produit du modèle home

        // Chargement de la vue principale et envoie des tableaux pour l'affichage
		$this->load->view('index/index', $data);
	}

    public function inscription() // Fonction inscription qui charge le formulaire d'inscription
    {
        // Simple chargement des vues nécessaires
    	$this->load->view( 'include/incl_loader' );
        $this->load->view( 'include/incl_head' );
        $this->load->view( 'login/incl_forminscription' );
        $this->load->view( 'include/incl_script' );
	}
	
	public function apropos() // Fonction apropos qui charge les différentes informations des créateurs du site
    {
        $data['getRubriques'] = $this->Model_home->getRubriques(); // Récupération dans un tableau des rubriques liées au sous rubriques renvoyé par la fonction getRubriques du modèle home
        // Chargement des vues et envoie du tableau pour les rubriques
        $this->load->view( 'include/incl_loader' );
        $this->load->view('include/incl_navbar', $data);
        $this->load->view('include/incl_head');
        $this->load->view('incl_apropos');
        $this->load->view('include/incl_footer');
        $this->load->view('include/incl_script');
    }

}
