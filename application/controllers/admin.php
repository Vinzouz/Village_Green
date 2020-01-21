<?php

class admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $data['main'] = 'admin/blank';
        $this->load->view('admin/index', $data);
    }

}
