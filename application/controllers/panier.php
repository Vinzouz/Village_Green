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

    public function ajoutPanier($idP) //ajoute un produit au panier
    {
        $data = $this->Model_panier->getinfosproduit($idP);

        // echo $data[1][0]->produit_nom;
        // var_dump($data);

        if ($this->session->panier == null) // création du panier s'il n'existe pas
        {
            $this->session->panier = array();
            $tab = array();
            //On ajoute le produit
            array_push($tab, $data); // Empile un ou plusieurs éléments à la fin d'un tableau
            $qte = $this->input->post('pro_qte');
            $this->session->panier = $tab;
            $this->session->qte = $qte;
            // var_dump($tab);
            redirect('ficheproduit/index/' . $idP . '');
        } else //si le panier existe
        {
            $tab = $this->session->panier;
            $idProduit = $tab[0][0]->produit_id;
            $qte = $this->input->post('pro_qte');
            // var_dump($data);
            foreach ($tab[0] as $produit) //on cherche si le produit existe déjà dans le panier
            {
                if ($produit->produit_id == $idProduit) {
                    
                    $this->session->qte = $this->session->qte + $qte;
                    redirect('ficheproduit/index/' . $idP . '');
                    exit;
                }
            }
            
            // var_dump($tab);
        }
    }

    public function qteplus($id)
    {
        $tab = $this->session->panier;
        $temp = array();

        for ($i = 0; $i < count($tab); $i++) //on parcourt le tableau produit après produit
        {
            if ($tab[$i]['produit_id'] !== $id) {
                array_push($temp, $tab[$i]);
            } else {
                $tab[$i]['pro_qte']++;
                array_push($temp, $tab[$i]);
            }
        }

        $tab = $temp;
        unset($temp);
        $this->session->panier = $tab;
        $this->session->qte = $this->session->qte + 1;
        $this->index();
    }

    public function qtemoins($id)
    {
        $tab = $this->session->panier;
        $temp = array();

        for ($i = 0; $i < count($tab); $i++) //on parcourt le tableau produit après produit
        {
            if ($tab[$i]['produit_id'] !== $id) {
                array_push($temp, $tab[$i]);
            } else {
                $tab[$i]['pro_qte']--;
                array_push($temp, $tab[$i]);
            }
        }

        $tab = $temp;
        unset($temp);
        $this->session->panier = $tab;
        $this->session->qte = $this->session->qte - 1;
        $this->index();
    }

    public function effaceProduit($id)
    {
        $tab = $this->session->panier;
        $temp = array(); //création d'un tableau temporaire vide

        for ($i = 0; $i < count($tab); $i++) //on cherche dans le panier les produits à ne pas supprimer
        {
            if ($tab[$i]['produit_id'] !== $id) {
                array_push($temp, $tab[$i]); // ces produits sont ajoutés dans le tableau temporaire
            }
        }

        $tab = $temp;
        unset($temp);
        $this->session->panier = $tab; // le panier prend la valeur du tableau temporaire et ne contient donc plus le produit à supprimer
        $this->session->qte--;
        $this->index();
    }

    public function effacePanier()
    {
        $_SESSION['panier'] = array();
        $_SESSION['qte'] = array();
        redirect('panier/index');
    }
}
