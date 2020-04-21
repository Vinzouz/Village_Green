<?php

class adminsousrubriques extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_adminsousrubriques');
        $this->load->model('Model_espaceclient');
        $this->load->model('Model_adminproducts');
        $this->load->library('Upload');
    }

    public function index()
    {
        $data['dataC'] = $this->Model_espaceclient->getClient();
        $data['getProRubriques'] = $this->Model_adminproducts->getProRubriques();

        if ($data['dataC'][0]->client_role_id == 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

            $this->load->view('admin/partials/header');

            $this->load->view('admin/partials/navbar', $data);

            $this->load->view('admin/adminproducts/sousrubriques/addsousrubrique', $data);

            $this->load->view('admin/partials/footer');
        }
    }

    public function getSousRubriques()
    {
        $data['getProRubriques'] = $this->Model_adminproducts->getProRubriques();
        $data['sousrubriques'] = $this->Model_adminsousrubriques->getSousRubriques();
        $data['dataC'] = $this->Model_espaceclient->getClient();
        if ($data['dataC'][0]->client_role_id == 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

            $this->load->view('admin/partials/header');

            $this->load->view('admin/partials/navbar', $data);

            $this->load->view('admin/adminproducts/sousrubriques/index', $data);

            $this->load->view('admin/partials/footer');
        }
    }

    public function listeSousrub()
    {
        // POST data
        $postData = $this->input->post();
        // Get data
        $data = $this->Model_adminsousrubriques->getSousrub($postData);

        echo json_encode($data);
    }


    public function addSousRubrique()
    {
        $data['dataC'] = $this->Model_espaceclient->getClient();

        if ($data['dataC'][0]->client_role_id == 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {
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
                $result = $this->Model_adminsousrubriques->addSousRubrique($data);

                if ($result > 0) {
                    $this->upload_image($data['sousrub_rubrique_id'], $result);
                    redirect('adminsousrubriques/getSousRubriques');
                }
            }
        }
    }


    public function deleteSousRubrique($idR, $idSR)
    {

        $this->Model_adminsousrubriques->deleteSousRubrique($idSR);
        unlink('assets/images/Imagesproducts/' . $idR . '/' . $idSR . '/home.jpg');
        rmdir('assets/images/Imagesproducts/' . $idR . '/' . $idSR . '');
        redirect('adminsousrubriques/getSousRubriques');
    }

    public function editSousRubrique($idSR)
    {
        $data['dataC'] = $this->Model_espaceclient->getClient();
        $array['getProRubriques'] = $this->Model_adminproducts->getProRubriques();
        $array['data'] =  $this->Model_adminsousrubriques->getSousRubriqueData($idSR);
        
        if ($data['dataC'][0]->client_role_id == 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {
            $this->load->view('admin/partials/header');

            $this->load->view('admin/partials/navbar', $data);

            $this->load->view('admin/adminproducts/sousrubriques/editsousrubrique', $array);

            $this->load->view('admin/partials/footer');
        }
    }

    public function updateSousRubrique($idR, $idSR)
    {

        $this->form_validation->set_rules('sousrub_nom', 'Nom sous-rubrique', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('sousrub_desc', 'Description sous-rubrique', 'trim');
        $this->form_validation->set_rules('sousrub_rubrique_id', 'Produit sous rubrique', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('errors' => validation_errors());
            $this->session->set_flashdata($data);
            redirect('adminsousrubriques/index');
        } else {
            $data = array(
                'sousrub_id' => $idSR,
                'sousrub_nom' => $this->input->post('sousrub_nom'),
                'sousrub_desc' => $this->input->post('sousrub_desc'),
                'sousrub_rubrique_id' => $this->input->post('sousrub_rubrique_id')
            );

            $dataSousRub = $this->Model_adminsousrubriques->updateSousRubrique($data);
            // print_r($test);
            if ($dataSousRub) {
                $this->upload_image($idR, $idSR);
            }
            redirect('adminsousrubriques/getSousRubriques');
        }
    }

    function upload_image($idR, $idSR)
    {

        $path = "./assets/images/Imagesproducts/$idR/$idSR/";
        $config['upload_path'] = $path; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['file_name'] =  "home.jpg";

        $this->upload->initialize($config);
        if (file_exists('assets/images/Imagesproducts/' . $idR . '/' . $idSR . '/home.jpg')) {
            unlink('assets/images/Imagesproducts/' . $idR . '/' . $idSR . '/home.jpg');
        }
        if (!empty($_FILES['image_file']['name'])) {
            if ($this->upload->do_upload('image_file')) {
                $gbr = $this->upload->data();
                $this->gallery($gbr['file_name'], $path);
            } else {
                echo $this->upload->display_errors();
            }
        } else {
            echo "image is empty or type of image not allowed";
        }
    }

    function gallery($file_name, $path)
    {

        if (!is_dir("$path/")) {
            mkdir("$path/");
        }

        $config = array(
            array(
                'image_library' => 'GD2',
                'source_image'  => "$path/" . $file_name,
                'maintain_ratio' => FALSE,
                'new_image'     => "$path/" . $file_name
            )
        );

        $this->load->library('image_lib', $config[0]);
        foreach ($config as $item) {
            $this->image_lib->initialize($item);
            if (!$this->image_lib->resize()) {
                return false;
            }
            $this->image_lib->clear();
        }
    }
}
