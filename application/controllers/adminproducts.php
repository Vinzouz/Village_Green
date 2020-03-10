<?php

class adminproducts extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_adminproducts');
        $this->load->model('Model_espaceclient');
        $this->load->model('Model_products');
        $this->load->library('upload');
    }

    public function index()
    {

        $data['getSousRubriques'] = $this->Model_adminproducts->getSousRubriques();
        $data['getProRubriques'] = $this->Model_adminproducts->getProRubriques();
        $data['dataC'] = $this->Model_espaceclient->getClient();
        if ($this->session->userdata('role') == 1) {

            $this->load->view('admin/partials/header');

            $this->load->view('admin/partials/navbar', $data);

            $this->load->view('admin/adminproducts/addproduct', $data);

            $this->load->view('admin/partials/footer');
        }
    }

    public function listeProduits(){
        // POST data
        $postData = $this->input->post();

        // Get data
        $data = $this->Model_adminproducts->getProduits($postData);

        echo json_encode($data);
}


    public function addProduct()
    {


        $this->form_validation->set_rules('produit_marque', 'Produit marque', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('produit_nom', 'Produit nom', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('produit_prix_HT', 'Produit prix HT', 'trim|required');
        $this->form_validation->set_rules('produit_caract', 'Produit caractéristiques', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('produit_sousrub_id', 'Produit sous rubrique', 'trim|required');
        $this->form_validation->set_rules('produit_qtite', 'Produit quantité', 'trim|required');
        $this->form_validation->set_rules('produit_qtite_ale', 'Produit quantité alerte', 'trim|required');
        // $this->form_validation->set_rules('produit_image', 'Produit image', 'trim|required|min_length[3]');
        // $this->form_validation->set_rules('produit_desc', 'Produit description', 'trim|required|min_length[3]');

        if ($this->form_validation->run() == FALSE) {
            $data = array('errors' => validation_errors());
            $this->session->set_flashdata($data);
            redirect('adminproducts/index');
        } else {
            $data = array(
                'produit_marque' => $this->input->post('produit_marque'),
                'produit_nom' => $this->input->post('produit_nom'),
                'produit_prix_HT' => $this->input->post('produit_prix_HT'),
                'produit_caract' => $this->input->post('produit_caract'),
                'produit_sousrub_id' => $this->input->post('produit_sousrub_id'),
                'produit_qtite' => $this->input->post('produit_qtite'),
                'produit_qtite_ale' => $this->input->post('produit_qtite_ale'),
                // 'produit_image' => $this->input->post('produit_image'),
                // 'produit_desc' => $this->input->post('produit_desc')
            );

            $rubid = $this->input->post('produit_rub_id');
            $sousrubid = $this->input->post('produit_sousrub_id');
            $lastId = $this->Model_adminproducts->addProduct($data);

            if ($lastId > 0) {

                $this->upload_image($rubid, $sousrubid, $lastId);
                redirect('adminproducts/getProduct');
            }
        }
    }

    function upload_image($rubid, $sousrubid, $lastId)
    {

        $path = "./assets/images/Imagesproducts/$rubid/$sousrubid/$lastId";
        $config['upload_path'] = $path; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['file_name'] =  "product.jpg";

        $this->upload->initialize($config);
        if (file_exists('assets/images/Imagesproducts/'.$rubid.'/'. $sousrubid .'/'. $lastId.'/product.jpg')){
            unlink('assets/images/Imagesproducts/'.$rubid.'/'. $sousrubid .'/'. $lastId.'/product.jpg');
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


    public function getProduct()
    {

        $data['products'] = $this->Model_adminproducts->getProducts();
        $data['dataC'] = $this->Model_espaceclient->getClient();
        if ($this->session->userdata('role') == 1) {

            $this->load->view('admin/partials/header');

            $this->load->view('admin/partials/navbar', $data);

            $this->load->view('admin/adminproducts/index', $data);

            $this->load->view('admin/partials/footer');
        }
    }


    function gallery($file_name, $path)
    {

        if (!is_dir("$path/large/")) {
            mkdir("$path/large/");
        }
        if (!is_dir("$path/medium/")) {
            mkdir("$path/medium/");
        }
        if (!is_dir("$path/small/")) {
            mkdir("$path/small/");
        }

        $config = array(

            array(
                'image_library' => 'GD2',
                'source_image'  => "$path/" . $file_name,
                'maintain_ratio' => FALSE,
                'width'         => 700,
                'height'        => 467,
                'new_image'     => "$path/large/" . $file_name
            ),

            array(
                'image_library' => 'GD2',
                'source_image'  => "$path/" . $file_name,
                'maintain_ratio' => FALSE,
                'width'         => 600,
                'height'        => 400,
                'new_image'     => "$path/medium/" . $file_name
            ),

            array(
                'image_library' => 'GD2',
                'source_image'  => "$path/" . $file_name,
                'maintain_ratio' => FALSE,
                'width'         => 100,
                'height'        => 67,
                'new_image'     => "$path/small/" . $file_name
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

    public function deleteProduct($idSR, $idP){

        $result = $this->Model_adminproducts->deleteProduct($idP);
        print_r($result);
        $idR = $result['sousrub_rubrique_id'];
        $suppr = rmdir('assets/images/Imagesproducts/'.$idR.'/'.$idSR.'/'.$idP.'');
        if($suppr == true){
        redirect('adminproducts/getProduct');
    }
    }

    public function editProduct($idP){

        if ($this->session->userdata('role') != 1) {
            redirect('');
        }
        $data['getSousRubriques'] = $this->Model_adminproducts->getSousRubriques();
        $data['getProRubriques'] = $this->Model_adminproducts->getProRubriques();
        $data['getSousRubriqueP'] = $this->Model_adminproducts->getSousRubriqueP($idP);
        $data['dataC'] = $this->Model_espaceclient->getClient();
        $array['data'] =  $this->Model_adminproducts->getProductData($idP);
        $this->load->view('admin/partials/header');

        $this->load->view('admin/partials/navbar', $data);

        $this->load->view('admin/adminproducts/editproduct', $array);

        $this->load->view('admin/partials/footer');
    }

    public function updateProduct($rubid, $sousrubid, $lastId){

        $this->form_validation->set_rules('produit_marque', 'Produit marque', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('produit_nom', 'Produit nom', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('produit_prix_HT', 'Produit prix HT', 'trim|required');
        $this->form_validation->set_rules('produit_caract', 'Produit caractéristiques', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('produit_sousrub_id', 'Produit sous rubrique', 'trim|required');
        $this->form_validation->set_rules('produit_qtite', 'Produit quantité', 'trim|required');
        $this->form_validation->set_rules('produit_qtite_ale', 'Produit quantité alerte', 'trim|required');

        if ( $this->form_validation->run() == FALSE ) {
            $data = array( 'errors' => validation_errors() );
            $this->session->set_flashdata( $data );
            redirect( 'adminproducts/index' );
        } else {
            $data = array(
                'produit_id' => $lastId,
                'produit_marque' => $this->input->post('produit_marque'),
                'produit_nom' => $this->input->post('produit_nom'),
                'produit_prix_HT' => $this->input->post('produit_prix_HT'),
                'produit_caract' => $this->input->post('produit_caract'),
                'produit_sousrub_id' => $this->input->post('produit_sousrub_id'),
                'produit_qtite' => $this->input->post('produit_qtite'),
                'produit_qtite_ale' => $this->input->post('produit_qtite_ale'),
            );

            $dataPro = $this->Model_adminproducts->updateProduct($data);
            // print_r($test);
            if ( $dataPro ) {

                $this->upload_image($rubid, $sousrubid, $lastId);

            }
            redirect('adminproducts/getProduct');
        }

    }

}
