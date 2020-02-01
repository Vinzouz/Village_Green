<?php

class espaceclient extends CI_Controller {

    public function __construct(){

        parent::__construct();
        $this->load->model('Model_espaceclient');
        $this->load->model('Model_home');
    }

public function espaceC()
        {
        
                if ($this->session->userdata('user_id') == null) {
                    redirect('');
                }else{
                $array['data'] = $this->Model_espaceclient->getEspaceC();
                $array['dataC'] = $this->Model_espaceclient->getClient();
                $navbarRub['getRubriques'] = $this->Model_home->getRubriques();
                $this->load->view('include/incl_head');
                $this->load->view('include/incl_navbar', $navbarRub);
                $this->load->view('incl_user_area', $array);
                $this->load->view('include/incl_footer');
                $this->load->view('include/incl_script');
                }
        }
    }