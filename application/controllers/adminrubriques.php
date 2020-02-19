<?php

class adminrubriques extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_adminrubriques');
        $this->load->model('Model_espaceclient');
    }

    public function index()
    {

        $data['dataC'] = $this->Model_espaceclient->getClient();
        if ($this->session->userdata('role') == 1) {

            $this->load->view('admin/partials/header');

            $this->load->view('admin/partials/navbar', $data);

            $this->load->view('admin/adminproducts/rubriques/addrubrique');

            $this->load->view('admin/partials/footer');
        }
    }

    public function addRubrique()
    {

        //print_r($_POST);

        $this->form_validation->set_rules('rubrique_nom', 'Nom rubrique', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('rubrique_desc', 'Description rubrique', 'trim|required|min_length[3]');

        if ($this->form_validation->run() == FALSE) {
            $data = array('errors' => validation_errors());
            $this->session->set_flashdata($data);
            redirect('adminrubriques/index');
        } else {
            $data = array(
                'rubrique_nom' => $this->input->post('rubrique_nom'),
                'rubrique_desc' => $this->input->post('rubrique_desc')

            );
            $this->Model_adminrubriques->addRubrique($data);

            redirect('adminrubriques/getRubriques');
        }
    }


    public function getRubriques()
    {

        $data['rubriques'] = $this->Model_adminrubriques->getRubriques();
        $data['dataC'] = $this->Model_espaceclient->getClient();
        if ($this->session->userdata('role') == 1) {

            $this->load->view('admin/partials/header');

            $this->load->view('admin/partials/navbar', $data);

            $this->load->view('admin/adminproducts/rubriques/index', $data);

            $this->load->view('admin/partials/footer');
        }
    }

    public function deleteRubrique($idR){

        $this->Model_adminrubriques->deleteRubrique($idR);

        redirect('adminrubriques/getRubriques');
    }

    public function editRubrique($idR){

        if ($this->session->userdata('role') != 1) {
            redirect('');
        }
        $data['dataC'] = $this->Model_espaceclient->getClient();
        $array['data'] =  $this->Model_adminrubriques->getRubriqueData($idR);
        $this->load->view('admin/partials/header');

        $this->load->view('admin/partials/navbar', $data);

        $this->load->view('admin/adminproducts/rubriques/editrubrique', $array);

        $this->load->view('admin/partials/footer');
    }

    public function updateRubrique($idR){

        $this->form_validation->set_rules( 'rubrique_nom', 'rubrique_nom', 'trim|required|min_length[3]' );
        $this->form_validation->set_rules( 'rubrique_desc', 'rubrique_desc', 'trim' );

        if ( $this->form_validation->run() == FALSE ) {
            $data = array( 'errors' => validation_errors() );
            $this->session->set_flashdata( $data );
            redirect( 'adminrubriques/index' );
        } else {
            $data = array(
                'rubrique_id' => $idR,
                'rubrique_nom' => $this->input->post( 'rubrique_nom' ),
                'rubrique_desc' => $this->input->post( 'rubrique_desc' )
            );

            $dataRub = $this->Model_adminrubriques->updateRubrique($data);
            // print_r($test);
            if ( $dataRub ) {

                

            }
            redirect('adminrubriques/getRubriques');
        }

    }
}
