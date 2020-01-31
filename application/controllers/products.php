<?php

class products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_products');
        $this->load->model('Model_home');
    }


    public function getRubrique($Rubrique_id)
    {

        $data['getRubrique'] = $this->Model_products->getRubrique($Rubrique_id);
        $array['getRubriques'] = $this->Model_home->getRubriques();
        $prod['carrousel_produit'] = $this->Model_home->carrousel_produit();

        $this->load->view('include/incl_loader');
        $this->load->view('include/incl_navbar', $array);
        $this->load->view('include/incl_head');
        $this->load->view('products/sous_rubriques', $data);
        $this->load->view('include/incl_carrousel_produit', $prod);
        $this->load->view('index/incl_avantages');
        $this->load->view('include/incl_footer');
        $this->load->view('include/incl_script');
    }

    public function getSousRubrique($SousRubrique_id)
    {

        $data['getRubriques'] = $this->Model_home->getRubriques();
        $array['getRubriques'] = $this->Model_home->getRubriques();
        $data['getSousRubrique'] = $this->Model_products->getSousRubrique($SousRubrique_id);
        $prod['carrousel_produit'] = $this->Model_home->carrousel_produit();

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
