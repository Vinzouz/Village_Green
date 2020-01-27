<?php

class adminproducts extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_adminproducts');
        $this->load->library('upload');
    }

    public function index()
    {

        $data['getSousRubriques'] = $this->Model_adminproducts->getSousRubriques();
        $data['main'] = 'admin/adminproducts/addproduct';
        $data['getProRubriques'] = $this->Model_adminproducts->getProRubriques();
        $data['main'] = 'admin/adminproducts/addproduct';

        $this->load->view('admin/index', $data);
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
        $data['main'] = 'admin/adminproducts/index';

        $this->load->view('admin/index', $data);
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
}
