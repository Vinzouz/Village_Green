<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Welcome extends CI_Controller
{

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
		$this->load->view('index/index');
	}


    public function inscription()
    {
        $this->load->view( 'index/incl_head' );
        $this->load->view( 'login/incl_forminscription' );
        $this->load->view( 'index/incl_script' );
    }

    public function modifcompte()
    {
        $this->load->view( 'incl_head' );
        $this->load->view( 'incl_changesaccount' );
        $this->load->view( 'incl_script' );
    }

    public function deconnexion()
    {
        $this->load->view( 'incl_head' );
        $this->load->view( 'incl_logout' );
        $this->load->view( 'incl_script' );
    }

	public function apropos()
	{
		$this->load->view('incl_navbar');
		$this->load->view('incl_head');
		$this->load->view('incl_apropos');
		$this->load->view('incl_footer');
		$this->load->view('incl_script');
	}
}
