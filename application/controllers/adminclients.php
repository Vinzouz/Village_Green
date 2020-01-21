<?php

class adminclients extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_adminclients');
    }

    public function index(){

        $data['users'] = $this->Model_adminclients->getUsers();
        $data['main'] = 'admin/adminclients/index';

        $this->load->view('admin/index',$data);

    }

}