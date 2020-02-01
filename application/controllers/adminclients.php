<?php

class adminclients extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_adminclients');
        $this->load->model('Model_espaceclient');
    }

    public function index(){

        $data['users'] = $this->Model_adminclients->getUsers();
        $data['dataC'] = $this->Model_espaceclient->getClient();
        if ($this->session->userdata('role') == 1) {
            ?>
              <?php $this->load->view('admin/partials/header'); ?>
            
              <?php $this->load->view('admin/partials/navbar',$data); ?>
            
              <!-- partial -->
              

                  <?php $this->load->view('admin/adminclients/userslist', $data) ?>

                <!-- content-wrapper ends -->
            
                <?php $this->load->view('admin/partials/footer');
        }
    }

}