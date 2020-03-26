<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Panier extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_home');
        $this->load->model('Model_panier');
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

    public function verifPanier(){
        
        $qte = $this->session->qte;
        if($qte != null){
            echo json_encode($qte);
        }
    }

}
