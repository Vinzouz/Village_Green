<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ficheproduit extends CI_Controller
{

    public function __construct(){
		parent::__construct();
		$this->load->model('Model_home');
	}

    public function index($idP)
    {
        $test['idP'] = $idP;
        $data['getRubriques'] = $this->Model_home->getRubriques();
        $this->load->view( 'include/incl_loader' );
        $this->load->view('include/incl_navbar', $data);
        $this->load->view('include/incl_head');
        $this->load->view('products/ficheproduit', $test);
        $this->load->view('include/incl_footer');
        $this->load->view('include/incl_script');
    }


}
