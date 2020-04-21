<?php

class admincommandes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_admincommandes');
        $this->load->model('Model_espaceclient');
    }

    public function index()
    {

        $data['commandes'] = $this->Model_admincommandes->getCommandes();
        $data['dataC'] = $this->Model_espaceclient->getClient();
        if ($this->session->userdata('role') == 1) {

            $this->load->view('admin/partials/header');

            $this->load->view('admin/partials/navbar', $data);

            $this->load->view('admin/admincommandes/commandelist', $data);

            $this->load->view('admin/partials/footer');
        }
    }

    public function listeCommandes()
    {

        // POST data
        $postData = $this->input->post();

        // Get data
        $data = $this->Model_admincommandes->getCommande($postData);

        echo json_encode($data);
    }


    public function deleteCommande($id)
    {

        $this->Model_admincommandes->deleteCommande($id);

        redirect('admincommandes/index');
    }

    
    public function editCommande($id){

        $data['dataC'] = $this->Model_espaceclient->getClient();
        $array['data'] =  $this->Model_admincommandes->getCommandeData($id);
        
        if ($data['dataC'][0]->client_role_id == 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {
            $this->load->view('admin/partials/header');

            $this->load->view('admin/partials/navbar', $data);

            $this->load->view('admin/admincommandes/editcommande', $array);

            $this->load->view('admin/partials/footer');
        }
        
    }

    public function updateCommande()
    {

        $this->form_validation->set_rules('IdCommande', 'ID Commande', 'required');
        $this->form_validation->set_rules('DateCommande', 'Date commande', 'required');
        $this->form_validation->set_rules('ReducCommande', 'Reduction commande', 'required');
        $this->form_validation->set_rules('PrixtotCommande', 'Prix total de la commande', 'required');
        $this->form_validation->set_rules('DatereglemCommande', 'Date de règlement de la commande', 'required');
        $this->form_validation->set_rules('DatefactureCommande', 'Date de facturation de la commande', 'required');
        $this->form_validation->set_rules('AdresselivraisonCommande', 'Adresse de livraison de la commande', 'required');
        $this->form_validation->set_rules('VillelivraisonCommande', 'Ville de livraison de la commande', 'required');
        $this->form_validation->set_rules('CodepolivraisonCommande', 'Code postal de livraison de la commande', 'required');
        $this->form_validation->set_rules('AdressefacturationCommande', 'Adresse de facturation de la commande', 'required');
        $this->form_validation->set_rules('VillefacturationCommande', 'Ville de facturation de la commande', 'required');
        $this->form_validation->set_rules('CodepofacturationCommande', 'Code postal de facturation de la commande', 'required');
        $this->form_validation->set_rules('EtatCommande', 'Etat de la commande', 'required');
        $this->form_validation->set_rules('ClientidCommande', 'ID Client de la commande', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('errors' => validation_errors());
            $this->session->set_flashdata($data);
            redirect('');
        } else {
            $data = array(
                'commande_id' => $this->input->post('IdCommande'),
                'commande_date' => $this->input->post('DateCommande'),
                'commande_reduc' => $this->input->post('ReducCommande'),
                'commande_prix_tot' => $this->input->post('PrixtotCommande'),
                'commande_date_reglem' => $this->input->post('DatereglemCommande'),
                'commande_date_facture' => $this->input->post('DatefactureCommande'),
                'commande_livraison_rue' => $this->input->post('AdresselivraisonCommande'),
                'commande_livraison_ville' => $this->input->post('VillelivraisonCommande'),
                'commande_livraison_codepo' => $this->input->post('CodepolivraisonCommande'),
                'commande_facturation_rue' => $this->input->post('AdressefacturationCommande'),
                'commande_facturation_ville' => $this->input->post('VillefacturationCommande'),
                'commande_facturation_codepo' => $this->input->post('CodepofacturationCommande'),
                'commande_etat' => $this->input->post('EtatCommande'),
                'commande_client_id' => $this->input->post('ClientidCommande')
            );

            $dataCommande = $this->Model_admincommandes->updateCommande($data);
            
            if ($dataCommande['commande_etat'] === 'En cours de livraison'){
                $nombrealeatoire = $this->genererChaine(10);
                $jour = date('d');
                $jourlivraison = $jour + 5;
                $datalivraisonC = array(
                    'livraison_num_bon' => $nombrealeatoire,
                    'livraison_date' => date('Y-m-'.$jourlivraison.''),
                    'livraison_commande_id' => $dataCommande['commande_id'],
                    'livraison_etat' => 'En cours'
                );
                $idlivraisonCommande = $this->Model_admincommandes->insertLivraison($datalivraisonC);
                $compolivraison = $this->Model_admincommandes->getCompolivraison($dataCommande['commande_id']);
                $contenulivraison = array(
                    "contient_livraison_id" => $idlivraisonCommande,
                    $compolivraison
                );
                $this->Model_admincommandes->insertContenulivraison($contenulivraison);
            }
            
            if ($dataCommande['commande_etat'] === 'Livrée'){
                $this->Model_admincommandes->updateLivraison($dataCommande['commande_id']);
            }

            //  print_r($contenulivraison);
            redirect('admincommandes/index');
        }
    }

    function genererChaine($longueur)
    {
        $listeCar = '0123456789';
        $chaine = '';
        for ($i = 0; $i < $longueur; ++$i) {
            $chaine .= $listeCar[random_int(0, 6)];
        }
        return $chaine;
    }
}
