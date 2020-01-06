<?php

class Index extends CI_Controller{
    
    public function accueil(){

    // Appel de la vue avec transmission du tableau  
    $this->load->view('Ext_navbar');
    $this->load->view('Ext_header');
    $this->load->view('Ext_footer');
    $this->load->view('Ext_script');
    }
}


?>