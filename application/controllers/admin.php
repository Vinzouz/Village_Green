<?php

class admin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Model_espaceclient');
  }


  public function index()
  {
    $data['dataC'] = $this->Model_espaceclient->getClient();

    if ($data['dataC'][0]->client_role_id == 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

      $this->load->view('admin/partials/header');

      $this->load->view('admin/partials/navbar', $data);

      $this->load->view('admin/blank');

      $this->load->view('admin/partials/footer');

    } else {

      // AFFICHAGE D'ERREUR OU REDIRECTION
    }
  }
}
