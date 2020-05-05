<?php

class adminsousrubriques extends CI_Controller
{

    public function __construct() // Fonction constructrice qui charge les modèles / librairie pour tout le controller
    {
        parent::__construct();
        $this->load->model('Model_adminsousrubriques');
        $this->load->model('Model_espaceclient');
        $this->load->model('Model_adminproducts');
        $this->load->library('Upload');
    }

    public function index() // Fonction index qui charge le formulaire d'ajout de sous-rubrique
    {
        if (isset($this->session->userdata)) { // Vérification si l'utilisateur est connecté
            $data['dataC'] = $this->Model_espaceclient->getClient(); // Récupération des données du client dans un tableau depuis la fonction getClient du modèle espaceclient
            $data['getProRubriques'] = $this->Model_adminproducts->getProRubriques(); // Récupération de la table des rubriques dans un tableau depuis la fonction getProRubriques du modèle adminproducts

            if ($data['dataC'] != null) { // Vérification si le tableau n'est pas vide
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {
                    // Vérification si l'utilisateur à le role_id 1 qui est égal au rôle admin et si son id est égal à 101, 102 ou 103
                    // qui sont les seuls comptes autorisés

                    // Chargement des vues et envoie du tableau de données à la navbar admin pour afficher certaines infos
                    // Et envoie du tableau de rubriques pour le formulaire
                    $this->load->view('admin/partials/header');

                    $this->load->view('admin/partials/navbar', $data);

                    $this->load->view('admin/adminproducts/sousrubriques/addsousrubrique', $data);

                    $this->load->view('admin/partials/footer');
                }
            }
        }
    }

    public function getSousRubriques() // Fonction permettant d'afficher les vues permettant au script jQuery d'afficher la liste
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();
            $data['getProRubriques'] = $this->Model_adminproducts->getProRubriques(); // Récupération de la table des rubriques dans un tableau depuis la fonction getProRubriques du modèle adminproducts
            $data['sousrubriques'] = $this->Model_adminsousrubriques->getSousRubriques(); // Récupération de la table des sous-rubriques dans un tableau depuis la fonction getSousRubriques du modèle adminsousruriques

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Chargement des vues et envoie du tableau de rubriques et de sous-rubriques pour la liste
                    $this->load->view('admin/partials/header');

                    $this->load->view('admin/partials/navbar', $data);

                    $this->load->view('admin/adminproducts/sousrubriques/index', $data);

                    $this->load->view('admin/partials/footer');
                }
            }
        }
    }

    public function listeSousrub() // Liste des sous-rubriques pouvant changer dynamiquement avec la recherche appellée par le script jQuery
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Récupération du POST normalement vide de base du script jQuery pour récupérer la liste entière de sous-rubriques
                    // Change en cas de recherche
                    $postData = $this->input->post();

                    // Envoie du POST à la fonction getSousrub du modèle adminsousrubriques
                    $data = $this->Model_adminsousrubriques->getSousrub($postData);
                    // Récupération des résultats dans la variable data

                    echo json_encode($data); // Affichage direct des données avec le json_encode afin que le script puisse utiliser les données
                }
            }
        }
    }


    public function addSousRubrique() // Fonction permettant d'ajouter un nouveau produit après envoie du formulaire
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Vérification que tous les champs sont remplis pour éviter les erreurs
                    $this->form_validation->set_rules('sousrub_nom', 'Nom sous-rubrique', 'trim|required|min_length[3]');
                    $this->form_validation->set_rules('sousrub_desc', 'Description sous-rubrique', 'trim');
                    $this->form_validation->set_rules('sousrub_rubrique_id', 'Produit sous rubrique', 'trim|required');

                    if ($this->form_validation->run() == FALSE) { // Si erreur du formulaire 
                        $data = array('errors' => validation_errors()); // Affectation des erreurs à la variable $data
                        $this->session->set_flashdata($data); // Redirection et affichage des erreurs
                        redirect('adminsousrubriques/index');
                    } else { // Si aucune erreur, affectation des POSTS aux différents champs présents en BDD
                        $data = array(
                            'sousrub_nom' => $this->input->post('sousrub_nom'),
                            'sousrub_desc' => $this->input->post('sousrub_desc'),
                            'sousrub_rubrique_id' => $this->input->post('sousrub_rubrique_id')

                        );

                        // Envoie du tableau à la fonction addSousRubrique du modèle adminsousrubriques afin d'ajouter une sous-rubrique en BDD
                        $result = $this->Model_adminsousrubriques->addSousRubrique($data);
                        // Récupération de la dernière id de produit rentrée en BDD soit à l'instant

                        if ($result > 0) { // Si l'id est correct

                            // Appel de la fonction upload_image présente dans le controller en passant en paramètre l'id de la sous-rubrique
                            //  reliée à l'id de la rubrique en paramètres afin de stocker la photo au bon endroit
                            $this->upload_image($data['sousrub_rubrique_id'], $result);
                            redirect('adminsousrubriques/getSousRubriques'); // Redirection à la liste des sous-rubriques
                        }
                    }
                }
            }
        }
    }


    public function deleteSousRubrique($idR, $idSR) // Fonction permettant de supprimer une sous-rubrique en passant en paramètre l'id de rubrique et de sous-rubrique
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Appel de la fonction deleteSousRubrique du modèle adminsousrubriques en passant l'id de sous-rubrique en paramètre
                    $this->Model_adminsousrubriques->deleteSousRubrique($idSR);

                    // Suppression du dossier de la rubrique et de ses photos
                    unlink('assets/images/Imagesproducts/' . $idR . '/' . $idSR . '/home.jpg');
                    rmdir('assets/images/Imagesproducts/' . $idR . '/' . $idSR . '');

                    redirect('adminsousrubriques/getSousRubriques'); // Redirection à la liste des sous-rubriques
                }
            }
        }
    }

    public function editSousRubrique($idSR) // Fonction permettant de charger un formulaire reprenant les informations de la sous-rubrique
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();
            $array['getProRubriques'] = $this->Model_adminproducts->getProRubriques(); // Récupération de la table des rubriques dans un tableau depuis la fonction getProRubriques du modèle adminproducts
            $array['data'] =  $this->Model_adminsousrubriques->getSousRubriqueData($idSR); // Récupération des informations de la sous-rubrique dans un tableau depuis la fonction getSousRubriqueData du modèle adminsousrubriques en passant l'id de la sous-rubrique en paramètre

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Chargement des vues et envoie des tableaux concernant les rubriques
                    // Ainsi que toutes les données de la sous-rubrique au formulaire
                    $this->load->view('admin/partials/header');

                    $this->load->view('admin/partials/navbar', $data);

                    $this->load->view('admin/adminproducts/sousrubriques/editsousrubrique', $array);

                    $this->load->view('admin/partials/footer');
                }
            }
        }
    }

    public function updateSousRubrique($idR, $idSR) // Fonction permettant d'éditer les informations de la sous-rubrique
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Vérification que tous les champs sont remplis pour éviter les erreurs
                    $this->form_validation->set_rules('sousrub_nom', 'Nom sous-rubrique', 'trim|required|min_length[3]');
                    $this->form_validation->set_rules('sousrub_desc', 'Description sous-rubrique', 'trim');
                    $this->form_validation->set_rules('sousrub_rubrique_id', 'Produit sous rubrique', 'trim|required');

                    if ($this->form_validation->run() == FALSE) { // Si erreur du formulaire 
                        $data = array('errors' => validation_errors()); // Affectation des erreurs à la variable $data
                        $this->session->set_flashdata($data); // Redirection et affichage des erreurs
                        redirect('adminsousrubriques/index');
                    } else { // Si aucune erreur, affectation des POSTS aux différents champs présents en BDD
                        $data = array(
                            'sousrub_id' => $idSR,
                            'sousrub_nom' => $this->input->post('sousrub_nom'),
                            'sousrub_desc' => $this->input->post('sousrub_desc'),
                            'sousrub_rubrique_id' => $this->input->post('sousrub_rubrique_id')
                        );

                        // Envoie du tableau à la fonction updateSousRubrique du modèle adminsousrubriques pour update en BDD
                        $dataSousRub = $this->Model_adminsousrubriques->updateSousRubrique($data);
                        // Récupération de la ligne entière de la sous-rubrique venant d'être update

                        if ($dataSousRub) { // Si l'update a eu lieu
                            $this->upload_image($idR, $idSR); // La fonction d'upload est appellée pour update la photo
                        }
                        redirect('adminsousrubriques/getSousRubriques'); // Redirection à la liste des sous-rubriques
                    }
                }
            }
        }
    }

    function upload_image($idR, $idSR)
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();
            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

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
            }
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
