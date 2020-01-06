<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('incl_navbar');
		$this->load->view('incl_head');
		$this->load->view('incl_carousel');
		$this->load->view('incl_avantages');
		$this->load->view('incl_rubriques');
		$this->load->view('incl_partenaires');
		$this->load->view('incl_footer');
		$this->load->view('incl_script');
	}
}
