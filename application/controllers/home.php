<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends CI_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_home');
	}

	public function index()
	{
        $data['getRubriques'] = $this->Model_home->getRubriques();
        $data['carrousel_produit'] = $this->Model_home->carrousel_produit();

		$this->load->view('index/index', $data);
	}

    public function inscription()
    {
    	$this->load->view( 'include/incl_loader' );
        $this->load->view( 'include/incl_head' );
        $this->load->view( 'login/incl_forminscription' );
        $this->load->view( 'include/incl_script' );
	}
	
	public function apropos()
    {
        $data['getRubriques'] = $this->Model_home->getRubriques();
        $this->load->view( 'include/incl_loader' );
        $this->load->view('include/incl_navbar', $data);
        $this->load->view('include/incl_head');
        $this->load->view('incl_apropos');
        $this->load->view('include/incl_footer');
        $this->load->view('include/incl_script');
    }

}
