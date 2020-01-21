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

		$this->load->view('index/index', $data);
	}

}
