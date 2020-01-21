<?php

class products extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('Model_products');
    }


    public function getSousrubrique($sousrub_rubrique_id){
        
        $data['getSousrubrique'] = $this->Model_products->getSousrubrique($sousrub_rubrique_id);
        $this->load->view('products/index', $data);

    }

    
}