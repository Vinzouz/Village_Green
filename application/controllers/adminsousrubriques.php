<?php

class adminsousrubriques extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_adminsousrubriques');
        $this->load->model('Model_espaceclient');
        $this->load->model('Model_adminproducts');
    }

    public function index()
    {

        $data['dataC'] = $this->Model_espaceclient->getClient();
        $data['getProRubriques'] = $this->Model_adminproducts->getProRubriques();
        if ($this->session->userdata('role') == 1) {

            $this->load->view('admin/partials/header');

            $this->load->view('admin/partials/navbar', $data);

            $this->load->view('admin/adminproducts/sousrubriques/addsousrubrique', $data);

            $this->load->view('admin/partials/footer');
        }
    }

    public function listeSousrub(){
                // POST data
                $postData = $this->input->post();

                // Get data
                $data = $this->Model_adminsousrubriques->getSousrub($postData);
        
                echo json_encode($data);
    }


    public function addSousRubrique()
    {

        //print_r($_POST);

        $this->form_validation->set_rules('sousrub_nom', 'Nom sous-rubrique', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('sousrub_desc', 'Description sous-rubrique', 'trim');
        $this->form_validation->set_rules('sousrub_rubrique_id', 'Produit sous rubrique', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('errors' => validation_errors());
            $this->session->set_flashdata($data);
            redirect('adminsousrubriques/index');
        } else {
            $data = array(
                'sousrub_nom' => $this->input->post('sousrub_nom'),
                'sousrub_desc' => $this->input->post('sousrub_desc'),
                'sousrub_rubrique_id' => $this->input->post('sousrub_rubrique_id')

            );
            $this->Model_adminsousrubriques->addSousRubrique($data);

            redirect('adminsousrubriques/getSousRubriques');
        }
    }


    public function getSousRubriques()
    {
        $data['getProRubriques'] = $this->Model_adminproducts->getProRubriques();
        $data['sousrubriques'] = $this->Model_adminsousrubriques->getSousRubriques();
        $data['dataC'] = $this->Model_espaceclient->getClient();
        if ($this->session->userdata('role') == 1) {

            $this->load->view('admin/partials/header');

            $this->load->view('admin/partials/navbar', $data);

            $this->load->view('admin/adminproducts/sousrubriques/index', $data);

            $this->load->view('admin/partials/footer');
        }
    }

    public function deleteSousRubrique($idSR){

        $this->Model_adminsousrubriques->deleteSousRubrique($idSR);

        redirect('adminsousrubriques/getSousRubriques');
    }

    public function F($idSR){

        if ($this->session->userdata('role') != 1) {
            redirect('');
        }
        $array['getProRubriques'] = $this->Model_adminproducts->getProRubriques();
        $data['dataC'] = $this->Model_espaceclient->getClient();
        $array['data'] =  $this->Model_adminsousrubriques->getSousRubriqueData($idSR);
        $this->load->view('admin/partials/header');

        $this->load->view('admin/partials/navbar', $data);

        $this->load->view('admin/adminproducts/sousrubriques/editsousrubrique', $array);

        $this->load->view('admin/partials/footer');
    }

    public function updateSousRubrique($idSR){

        $this->form_validation->set_rules('sousrub_nom', 'Nom sous-rubrique', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('sousrub_desc', 'Description sous-rubrique', 'trim');
        $this->form_validation->set_rules('sousrub_rubrique_id', 'Produit sous rubrique', 'trim|required');

        if ( $this->form_validation->run() == FALSE ) {
            $data = array( 'errors' => validation_errors() );
            $this->session->set_flashdata( $data );
            redirect( 'adminsousrubriques/index' );
        } else {
            $data = array(
                'sousrub_id' => $idSR,
                'sousrub_nom' => $this->input->post('sousrub_nom'),
                'sousrub_desc' => $this->input->post('sousrub_desc'),
                'sousrub_rubrique_id' => $this->input->post('sousrub_rubrique_id')
            );

            $dataSousRub = $this->Model_adminsousrubriques->updateSousRubrique($data);
            // print_r($test);
            if ( $dataSousRub ) {

            }
            redirect('adminsousrubriques/getSousRubriques');
        }

    }
}