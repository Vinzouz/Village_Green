<?php

class search extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_search');
    }

    public function get_search(){

        $result = $this->Model_search->get_search();
        echo json_encode($result);

    }
}