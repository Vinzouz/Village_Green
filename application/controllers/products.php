<?php

class products extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('Model_products'); 
        $this->load->model('Model_home');
    }


    public function getRubrique($Rubrique_id){
        
        $data['getRubrique'] = $this->Model_products->getRubrique($Rubrique_id);
        $this->load->view('products/index', $data);

    }

    public function getSousRubrique($SousRubrique_id){
        
        $data['getRubriques'] = $this->Model_home->getRubriques();
        $data['getSousRubrique'] = $this->Model_products->getSousRubrique($SousRubrique_id);
        $this->load->view('products/produits', $data);

    }

    
}