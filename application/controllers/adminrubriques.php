<?php

class adminrubriques extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_adminrubriques');
        $this->load->model('Model_espaceclient');
        $this->load->library('Upload');
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
            $result = $this->Model_adminrubriques->addRubrique($data);

            if($result > 0){
                $this->upload_image($result);
                redirect('adminrubriques/getRubriques');
            }

            
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
        unlink('assets/images/Imagesproducts/'.$idR.'/home.jpg');
        rmdir('assets/images/Imagesproducts/'.$idR.'');

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
                $this->upload_image($idR);
            }
            redirect('adminrubriques/getRubriques');
        }

    }

    function upload_image($rubid)
    {

        $path = "./assets/images/Imagesproducts/$rubid/";
        $config['upload_path'] = $path; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['file_name'] =  "home.jpg";

        $this->upload->initialize($config);
        if (file_exists('assets/images/Imagesproducts/'.$rubid.'/home.jpg')){
            unlink('assets/images/Imagesproducts/'.$rubid.'/home.jpg');
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
