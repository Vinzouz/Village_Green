<?php

class espaceclient extends CI_Controller
{

    public function __construct() // Fonction constructrice qui charge les modèles pour tout le controller
    {
        parent::__construct();
        $this->load->model('Model_espaceclient');
        $this->load->model('Model_home');
    }

    public function espaceC() // Fonction espaceC qui charge l'espace client de l'utilisateur 
    { // Affichage des commandes dans l'espace client

        if ($this->session->userdata('user_id') == null) { // Si l'id de l'utilisateur est incorrect ou n'existe pas redirection page d'accueil
            redirect('');
        } else {
            $array['data'] = $this->Model_espaceclient->getEspaceC(); // Récupération dans un tableau des données de l'utilisateur lié à ses commandes
            $array['dataC'] = $this->Model_espaceclient->getClient(); // Récupération dans un tableau des infos client
            $navbarRub['getRubriques'] = $this->Model_home->getRubriques(); // Récupération dans un tableau des rubriques et sous rubriques pour la navbar
            // Chargement des vues et envoie des différents tableaux nécessaires
            $this->load->view('include/incl_head');
            $this->load->view('include/incl_navbar', $navbarRub);
            $this->load->view('incl_user_area', $array);
            $this->load->view('include/incl_footer');
            $this->load->view('include/incl_script');
        }
    }

    public function detailsCommande($idcommande) // Fonction detailsCommande qui charge le détail de la commande passée
    {
        $array['dataC'] = $this->Model_espaceclient->getClient(); // Récupération dans un tableau des infos client
        $array['dataCommande'] = $this->Model_espaceclient->getCommande($idcommande); // Récupération dans un tableau des infos de la commande du client
        $data['getRubriques'] = $this->Model_home->getRubriques(); // Récupération dans un tableau des rubriques et sous rubriques pour la navbar
        // Chargement des vues et envoie des différents tableaux nécessaires
        $this->load->view('include/incl_loader');
        $this->load->view('include/incl_navbar', $data);
        $this->load->view('include/incl_head');
        $this->load->view('incl_detailscommande', $array);
        $this->load->view('include/incl_footer');
        $this->load->view('include/incl_script');
    }
}
