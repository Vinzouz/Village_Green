<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Panier extends CI_Controller
{

    public function __construct() // Fonction constructrice qui charge les modèles pour tout le controller
    {
        parent::__construct();
        $this->load->model('Model_home');
        $this->load->model('Model_panier');
        $this->load->model('Model_espaceclient');
    }

    public function index() // Fonction index du controller qui charge le panier du client
    { 
        $data['getRubriques'] = $this->Model_home->getRubriques(); // Récupération dans un tableau des rubriques liées au sous rubriques renvoyé par la fonction getRubriques du modèle home
        // Chargement des vues et envoie du tableau pour les rubriques
        $this->load->view('include/incl_loader');
        $this->load->view('include/incl_navbar', $data);
        $this->load->view('include/incl_head');
        $this->load->view('products/panier');
        $this->load->view('include/incl_footer');
        $this->load->view('include/incl_script');
    }

    public function ajoutPanier() // Ajoute un produit au panier, fonction appelée par le script jQuery
    {
        $idP = $this->input->post('pro_id'); // Récupération de l'id du produit
        $data = $this->Model_panier->getinfosproduit($idP); // Appel de la fonction getinfosproduit du modèle panier et récupération des données du produit selon son id

        if ($this->session->panier == null) // Si le panier n'existe pas
        {
            $this->session->panier = array(); // Initialisation de la session panier en tableau
            $tab = $this->session->panier; // Affectation de la session panier à la variable $tab
            $qte = $this->input->post('pro_qte'); // Récupération de la quantité du produit
            array_push($data, $qte); // Ajout de la quantité dans $data qui contient les infos produit
            array_push($tab, $data); // Puis on push $data dans $tab
            $this->session->qte = 0; // Initialisation de la quantité du panier à 0
            $this->session->qte++; // Incrémentation à chaque produit
            $this->session->panier = $tab; // Affectation de la variable $tab à la session panier

        } else // Si le panier existe déjà
        {
            $tab = $this->session->panier; // Récupération de la session panier existante
            $idProduit = $idP; // Récupération de l'id du produit rajouté
            $qte = $this->input->post('pro_qte'); // Et de sa quantité
            $i = 0; // Initialisation de $i à 0 pour incrémentation
            foreach ($tab as $produit) // Boucle pour parcourir le tableau pour vérifier si le produit existe déjà dans le panier
            {
                if ($tab[$i][0]['produit_id'] == $idProduit) { // Si l'id du produit du panier existant est égal à celui rajouté
                    $tab[$i][1] = $tab[$i][1] + $qte; // On change la quantité en rajoutant la nouvelle
                    $this->session->panier = $tab; // Affectation du nouveau tableau à la session panier
                    exit; // Sortie de la boucle
                }
                $i++; // Incrémentation de $i pour la boucle
            }
            // Si le produit n'existe pas dans le panier déjà existant
            unset($i); // Une fois la boucle terminée le $i se remet à 0
            array_push($data, $qte); // Ajout de la quantité du produit avec les infos du produit
            array_push($tab, $data); // Puis push de $data dans $tab
            $this->session->panier = $tab; // Affectation de $tab à la session panier
            $this->session->qte++; // Incrémentation du nouveau produit
            exit;
        }
    }

    public function qteplus($id) // Fonction qteplus qui permet de rajouter 1 quantité à un produit directement dans le panier
    {
        $tab = $this->session->panier; // Récupération de la session panier existante
        $temp = array(); // Création d'un tableau vide temporaire

        for ($i = 0; $i < count($tab); $i++) // On parcourt le tableau produit après produit
        {
            if ($tab[$i][0]['produit_id'] !== $id) { // Si le l'id du produit ne correspond pas à celui passé en paramètre
                array_push($temp, $tab[$i]); // On push les produits dans le tableau temporaire
            } else { // Si l'id est égal à celui passé en paramètre
                $tab[$i][1]++; // On incrémente la quantité du produit
                array_push($temp, $tab[$i]); // Puis on push dans le tableau temporaire
            }
        }

        $tab = $temp; // Affectation du nouveau tableau temporaire à $tab
        unset($temp); // Suppression du tableau temporaire
        $this->session->panier = $tab; // Affectation au nouveau tableau à la session panier
        redirect('panier/index'); // Permet la redirection automatique lors du clique sur le bouton +
    }

    public function qtemoins($id) // Fonction qtemoins qui permet d'enlever 1 quantité à un produit directement dans le panier
    {
        $tab = $this->session->panier; // Récupération de la session panier existante
        $temp = array(); // Création d'un tableau vide temporaire

        for ($i = 0; $i < count($tab); $i++) // On parcourt le tableau produit après produit
        {
            if ($tab[$i][0]['produit_id'] !== $id) { // Si le l'id du produit ne correspond pas à celui passé en paramètre
                array_push($temp, $tab[$i]); // On push les produits dans le tableau temporaire
            } else { // Si l'id est égal à celui passé en paramètre
                $tab[$i][1]--; // On désincrémente la quantité du produit
                if ($tab[$i][1] == 0) { // Si la quantité du produit est égal à 0
                    $this->effaceProduit($id); // Appel de la fonction effaceProduit qui supprime le produit du panier
                } else { // Si la quantité est supérieure à 0
                    array_push($temp, $tab[$i]); // Puis on push dans le tableau temporaire
                }
            }
        }

        $tab = $temp; // Affectation du nouveau tableau temporaire à $tab
        unset($temp); // Suppression du tableau temporaire
        $this->session->panier = $tab; // Affectation au nouveau tableau à la session panier
        redirect('panier/index'); // Permet la redirection automatique lors du clique sur le bouton -
    }

    public function effaceProduit($idP) // Fonction effaceProduit qui permet de supprimer un produit dans le panier
    {
       
        $tab = $this->session->panier; // Récupération de la session panier existante
        $temp = array(); // Création d'un tableau vide temporaire

        for ($i = 0; $i < count($tab); $i++) // On parcourt le tableau produit après produit
        {
            if ($tab[$i][0]['produit_id'] !== $idP) { // Si les produits n'ont pas l'id passé en paramètre, ils ne sont pas supprimés
                array_push($temp, $tab[$i]); // On push les produits dans le tableau temporaire
            }
        }

        $tab = $temp; // Affectation du nouveau tableau temporaire à $tab
        unset($temp); // Suppression du tableau temporaire
        $this->session->qte = $this->session->qte - 1; // Mise à jour de la value de la quantité panier de la navbar
        $this->session->panier = $tab; // Affectation au nouveau tableau à la session panier et ne contient donc plus le produit à supprimer
        redirect('panier/index'); // Permet la redirection automatique lors du clique sur le bouton supprimer
    }

    public function effacePanier() // Fonction effacePanier qui permet de supprimer le panier en entier
    {
        $_SESSION['panier'] = array(); // Remise à zéro du tableau panier
        $_SESSION['qte'] = array(); // Remise à zéro de la quantité panier
        redirect('panier/index'); // Redirection au panier
    }

    public function verifPanier() // Fonction verifPanier qui sert à vérifier la valeur de la quantité du panier, appelée par le script jQuery
    { // Fonction qui sert à mettre à jour la quantité panier dans la navbar

        $qte = $this->session->qte; // Récupération de la quantité selon la session
        if ($qte != null) { // Si la quantité n'est pas nulle
            echo json_encode($qte); // Affichage direct de la quantité avec json_encode pour que le script puisse s'en servir
        }
        else{ // Si la quantité panier n'existe pas
            echo json_encode(''); // Affichage vide
        }
    }

    public function etapeSuivante() // Fonction etapeSuivante pour avoir le récapitulatif du panier sans pouvoir changer de données
    {
        $array['dataC'] = $this->Model_espaceclient->getClient(); // Récupération dans un tableau des infos du client renvoyé par la fonction getClient du modèle espace client
        $data['getRubriques'] = $this->Model_home->getRubriques(); // Récupération dans un tableau des rubriques liées au sous rubriques renvoyé par la fonction getRubriques du modèle home
        // Chargement des vues et envoie des tableaux
        $this->load->view('include/incl_loader');
        $this->load->view('include/incl_navbar', $data);
        $this->load->view('include/incl_head');
        $this->load->view('products/etapesuivante', $array);
        $this->load->view('include/incl_footer');
        $this->load->view('include/incl_script');
    }

    public function commander() // Fonction commander accessible seulement pour les comptes admins pour éviter le spam
    {
        $array['dataC'] = $this->Model_espaceclient->getClient(); // Récupération dans un tableau des infos du client renvoyé par la fonction getClient du modèle espace client
        $choixlivraison = $this->input->post('Choixlivraison'); // Récupération du choix pour l'adresse de livraison

        // Vérification du champ du choix de livraison pour éviter les erreurs
        $this->form_validation->set_rules(
            'Choixlivraison',
            'Choixlivraison',
            'required',
            array(
                "required"      => "Choix non défini"
            )
        );

        if ($choixlivraison === 'Non'){ // Si le choix est égal à 'Non', le client veut se faire livrer à un autre adresse
            // Vérification des champs de l'adresse, du code postal ainsi que la ville
            $this->form_validation->set_rules(
                'Adresselivraison',
                'Adresselivraison',
                'trim|required|regex_match[/^\d+([,]?)+\s[A-z]+\s[A-z]+/]',
                array(
                    "required"      => "Adresse non définie",
                    "regex_match"     => "L'adresse est incorrecte",
                    "trim"  => "Des espaces dans l'adresse sont présents"
                )
            );
            $this->form_validation->set_rules(
                'Codepolivraison',
                'Codepolivraison',
                'trim|required|min_length[5]|max_length[5]|regex_match[/^\d{5}$/]',
                array(
                    "required"      => "Code postal non défini",
                    "regex_match"     => "Le code postal est incorrect",
                    "min_length"    => "Le code postal est trop court",
                    "max_length"    => "Le code postal est trop long",
                    "trim"  => "Des espaces dans le code postal sont présents"
                )
            );
            $this->form_validation->set_rules(
                'Villelivraison',
                'Villelivraison',
                'trim|required|min_length[1]|regex_match[/^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'"-\/\s]{1,40}$/]',
                array(
                    "required"      => "Ville non définie",
                    "regex_match"     => "La ville est incorrecte",
                    "min_length"    => "La ville est trop courte",
                    "trim"  => "Des espaces dans la ville sont présents"
                )
            );
        }

        if ($this->form_validation->run() == FALSE) { // Si erreur du formulaire
            $data = array('errors' => validation_errors('<p style="color:red">', '</p>')); // Affectation des erreurs à la variable $data
            $this->session->set_flashdata($data); // Redirection et affichage des erreurs
            redirect('panier/etapesuivante');
        } else { // Si aucune erreur de formulaire
            if ($choixlivraison === 'Oui') { // Si le choix est 'Oui', le client veux être livré à la même adresse, il aura alors la même adresse de livraison que celle de facturation
                $data = array( // Affectation des champs relatif à ceux en BDD avec les données récupérées
                    'commande_date' => date('Y-m-d'),
                    'commande_reduc' => '0',
                    'commande_prix_tot' => $this->input->post('Prixtotcommande'),
                    'commande_date_reglem' => date('Y-m-d'),
                    'commande_date_facture' => date('Y-m-d'),
                    'commande_livraison_rue' => $array['dataC'][0]->client_adresse,
                    'commande_livraison_ville' => $array['dataC'][0]->client_ville,
                    'commande_livraison_codepo' => $array['dataC'][0]->client_codepo,
                    'commande_facturation_rue' => $array['dataC'][0]->client_adresse,
                    'commande_facturation_ville' => $array['dataC'][0]->client_ville,
                    'commande_facturation_codepo' => $array['dataC'][0]->client_codepo,
                    'commande_etat' => 'En préparation',
                    'commande_client_id' => $array['dataC'][0]->client_id
                );
                $idcommande = $this->Model_panier->commander($data); // Envoie du tableau à la fonction commander du modèle panier et récupération de l'id de la commande insérée
                $this->Model_panier->rentreeproduitcommande($idcommande); // Appel de la fonction rentreeproduitcommande du modèle panier pour rentrer les produits dans la table secomposede
                unset($_SESSION['panier']); // Suppression du panier après commande
                unset($_SESSION['qte']); // Suppression de la quantité du panier
                redirect('panier/reussitecommande'); // Redirection vers la page de réussite de commande
            } else { // Sinon si le choix est 'Non'
                $data = array( // Affectation des champs relatif à ceux en BDD avec les données récupérées dont le input d'adresse de livraison
                    'commande_date' => date('Y-m-d'),
                    'commande_reduc' => '0',
                    'commande_prix_tot' => $this->input->post('Prixtotcommande'),
                    'commande_date_reglem' => date('Y-m-d'),
                    'commande_date_facture' => date('Y-m-d'),
                    'commande_livraison_rue' => $this->input->post('Adresselivraison'),
                    'commande_livraison_ville' => $this->input->post('Villelivraison'),
                    'commande_livraison_codepo' => $this->input->post('Codepolivraison'),
                    'commande_facturation_rue' => $array['dataC'][0]->client_adresse,
                    'commande_facturation_ville' => $array['dataC'][0]->client_ville,
                    'commande_facturation_codepo' => $array['dataC'][0]->client_codepo,
                    'commande_etat' => 'En préparation',
                    'commande_client_id' => $array['dataC'][0]->client_id
                );
                $idcommande = $this->Model_panier->commander($data); // Envoie du tableau à la fonction commander du modèle panier et récupération de l'id de la commande insérée
                $this->Model_panier->rentreeproduitcommande($idcommande); // Appel de la fonction rentreeproduitcommande du modèle panier pour rentrer les produits dans la table secomposede
                unset($_SESSION['panier']); // Suppression du panier après commande
                unset($_SESSION['qte']); // Suppression de la quantité du panier
                redirect('panier/reussitecommande'); // Redirection vers la page de réussite de commande
            }
        }
    }

    public function reussitecommande()// Fonction reussitecommande appelée seulement quand une commande vient d'être ajoutée
    { 
        $dataComm['commande'] = $this->Model_panier->dernierecommande(); // Récupération dans un tableau de la dernière commande ajoutée selon l'id du client
        $data['getRubriques'] = $this->Model_home->getRubriques(); // Récupération dans un tableau des rubriques liées au sous rubriques renvoyé par la fonction getRubriques du modèle home
        // Chargement des vues et envoie des tableaux
        $this->load->view('include/incl_loader');
        $this->load->view('include/incl_navbar', $data);
        $this->load->view('include/incl_head');
        $this->load->view('products/reussitecommande', $dataComm);
        $this->load->view('include/incl_footer');
        $this->load->view('include/incl_script');
    }
}
