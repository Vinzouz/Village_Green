<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Panier extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_home');
        $this->load->model('Model_panier');
        $this->load->model('Model_espaceclient');
    }

    public function index()
    {
        $data['getRubriques'] = $this->Model_home->getRubriques();
        $this->load->view('include/incl_loader');
        $this->load->view('include/incl_navbar', $data);
        $this->load->view('include/incl_head');
        $this->load->view('products/panier');
        $this->load->view('include/incl_footer');
        $this->load->view('include/incl_script');
    }

    public function ajoutPanier() //ajoute un produit au panier
    {
        $idP = $this->input->post('pro_id');
        $data = $this->Model_panier->getinfosproduit($idP);

        if ($this->session->panier == null) // création du panier s'il n'existe pas
        {
            $this->session->panier = array();
            $tab = $this->session->panier;
            $qte = $this->input->post('pro_qte');
            array_push($data, $qte);
            //On ajoute le produit
            array_push($tab, $data); // Empile un ou plusieurs éléments à la fin d'un tableau
            $this->session->qte = 0;
            $this->session->qte++;
            $this->session->panier = $tab;
        } else //si le panier existe
        {
            $tab = $this->session->panier;
            $idProduit = $idP;
            $qte = $this->input->post('pro_qte');
            $i = 0;
            foreach ($tab as $produit) //on cherche si le produit existe déjà dans le panier
            {
                if ($tab[$i][0]['produit_id'] == $idProduit) {
                    $tab[$i][1] = $tab[$i][1] + $qte;
                    $this->session->panier = $tab;
                    exit;
                }
                $i++;
            }
            unset($i);
            array_push($data, $qte);
            array_push($tab, $data);
            $this->session->panier = $tab;
            $this->session->qte++;
            exit;
        }
    }

    public function qteplus($id)
    {
        $tab = $this->session->panier;
        $temp = array();

        for ($i = 0; $i < count($tab); $i++) //on parcourt le tableau produit après produit
        {
            if ($tab[$i][0]['produit_id'] !== $id) {
                array_push($temp, $tab[$i]);
            } else {
                $tab[$i][1]++;
                array_push($temp, $tab[$i]);
            }
        }

        $tab = $temp;
        unset($temp);
        $this->session->panier = $tab;
        $this->index();
        redirect('panier/index'); // Permet la redirection automatique lors du clique sur le bouton +
    }

    public function qtemoins($id)
    {
        $tab = $this->session->panier;
        $temp = array();

        for ($i = 0; $i < count($tab); $i++) //on parcourt le tableau produit après produit
        {
            if ($tab[$i][0]['produit_id'] !== $id) {
                array_push($temp, $tab[$i]);
            } else {
                $tab[$i][1]--;
                if ($tab[$i][1] == 0) {
                    $this->effaceProduit($id);
                } else {
                    array_push($temp, $tab[$i]);
                }
            }
        }

        $tab = $temp;
        unset($temp);
        $this->session->panier = $tab;
        $this->index();
        redirect('panier/index'); // Permet la redirection automatique lors du clique sur le bouton -
    }

    public function effaceProduit()
    {
        $idP = $this->input->post('idP');
        $tab = $this->session->panier;
        $temp = array(); //création d'un tableau temporaire vide

        for ($i = 0; $i < count($tab); $i++) //on cherche dans le panier les produits à ne pas supprimer
        {
            if ($tab[$i][0]['produit_id'] !== $idP) {
                array_push($temp, $tab[$i]); // ces produits sont ajoutés dans le tableau temporaire
            }
        }

        $tab = $temp;
        unset($temp);
        $this->session->qte = $this->session->qte - 1;
        $this->session->panier = $tab; // le panier prend la valeur du tableau temporaire et ne contient donc plus le produit à supprimer
        $this->index();
        redirect('panier/index'); // Permet la redirection automatique lors du clique sur le bouton supprimer.

    }

    public function effacePanier()
    {
        $_SESSION['panier'] = array();
        $_SESSION['qte'] = array();
        redirect('panier/index');
    }

    public function verifPanier()
    {

        $qte = $this->session->qte;
        if ($qte != null) {
            echo json_encode($qte);
        }
        else{
            echo json_encode('');
        }
    }

    public function etapeSuivante()
    {

        $array['dataC'] = $this->Model_espaceclient->getClient();
        $data['getRubriques'] = $this->Model_home->getRubriques();
        $this->load->view('include/incl_loader');
        $this->load->view('include/incl_navbar', $data);
        $this->load->view('include/incl_head');
        $this->load->view('products/etapesuivante', $array);
        $this->load->view('include/incl_footer');
        $this->load->view('include/incl_script');
    }

    public function commander()
    {

        $array['dataC'] = $this->Model_espaceclient->getClient();
        $choixlivraison = $this->input->post('Choixlivraison');


        $this->form_validation->set_rules(
            'Choixlivraison',
            'Choixlivraison',
            'required',
            array(
                "required"      => "Choix non défini"
            )
        );
        if ($choixlivraison === 'Non'){
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

        if ($this->form_validation->run() == FALSE) {
            $data = array('errors' => validation_errors('<p style="color:red">', '</p>'));
            $this->session->set_flashdata($data);
            redirect('panier/etapesuivante');
        } else {
            if ($choixlivraison === 'Oui') {
                $data = array(
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
                $idcommande = $this->Model_panier->commander($data);
                $this->Model_panier->rentreeproduitcommande($idcommande);
                unset($_SESSION['panier']);
                unset($_SESSION['qte']);
                redirect('panier/reussitecommande');
            } else {
                $data = array(
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
                $idcommande = $this->Model_panier->commander($data);
                $this->Model_panier->rentreeproduitcommande($idcommande);
                unset($_SESSION['panier']);
                unset($_SESSION['qte']);
                redirect('panier/reussitecommande');
            }
        }
    }

    public function reussitecommande(){

        $dataComm['commande'] = $this->Model_panier->dernierecommande();
        $data['getRubriques'] = $this->Model_home->getRubriques();
        $this->load->view('include/incl_loader');
        $this->load->view('include/incl_navbar', $data);
        $this->load->view('include/incl_head');
        $this->load->view('products/reussitecommande', $dataComm);
        $this->load->view('include/incl_footer');
        $this->load->view('include/incl_script');

    }

}
