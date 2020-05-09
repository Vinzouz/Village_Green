<?php

class adminproducts extends CI_Controller
{

    public function __construct() // Fonction constructrice qui charge les modèles / librairie pour tout le controller
    {
        parent::__construct();
        $this->load->model('Model_adminproducts');
        $this->load->model('Model_espaceclient');
        $this->load->model('Model_products');
        $this->load->library('upload');
    }

    public function index() // Fonction index qui charge le formulaire d'ajout de produit
    {
        if (isset($this->session->userdata)) { // Vérification si l'utilisateur est connecté

            $data['getSousRubriques'] = $this->Model_adminproducts->getSousRubriques(); // Récupération de la table des sous-rubriques dans un tableau depuis la fonction getSousRubriques du modèle adminproducts
            $data['getProRubriques'] = $this->Model_adminproducts->getProRubriques(); // Récupération de la table des rubriques dans un tableau depuis la fonction getProRubriques du modèle adminproducts
            $data['dataC'] = $this->Model_espaceclient->getClient(); // Récupération des données du client dans un tableau depuis la fonction getClient du modèle espaceclient
            if ($data['dataC'] != null) { // Vérification si le tableau n'est pas vide
                if ($data['dataC'][0]->client_role_id == 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {
                    // Vérification si l'utilisateur à le role_id 1 qui est égal au rôle admin et si son id est égal à 101, 102 ou 103
                    // qui sont les seuls comptes autorisés

                    // Chargement des vues et envoie du tableau de données à la navbar admin pour afficher certaines infos
                    // Et envoie des tableaux de rubriques et sous-rubriques pour le formulaire
                    $this->load->view('admin/partials/header');

                    $this->load->view('admin/partials/navbar', $data);

                    $this->load->view('admin/adminproducts/addproduct', $data);

                    $this->load->view('admin/partials/footer');
                } else {
                    redirect(''); // Redirection page d'accueil si problème d'identification admin
                }
            } else {
                redirect(''); // Redirection page d'accueil si problème d'identification admin
            }
        } else {
            redirect(''); // Redirection page d'accueil si problème d'identification admin
        }
    }

    public function listeProduits() // Liste des produits pouvant changer dynamiquement avec la recherche appellée par le script jQuery
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Récupération du POST normalement vide de base du script jQuery pour récupérer la liste entière de produits
                    // Change en cas de recherche
                    $postData = $this->input->post();

                    // Envoie du POST à la fonction getProduits du modèle adminproducts
                    $data = $this->Model_adminproducts->getProduits($postData);
                    // Récupération des résultats dans la variable data

                    echo json_encode($data); // Affichage direct des données avec le json_encode afin que le script puisse utiliser les données
                } else {
                    redirect(''); // Redirection page d'accueil si problème d'identification admin
                }
            } else {
                redirect(''); // Redirection page d'accueil si problème d'identification admin
            }
        } else {
            redirect(''); // Redirection page d'accueil si problème d'identification admin
        }
    }


    public function addProduct() // Fonction permettant d'ajouter un nouveau produit après envoie du formulaire
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Vérification que tous les champs sont remplis pour éviter les erreurs
                    $this->form_validation->set_rules('produit_marque', 'Produit marque', 'trim|required|min_length[3]');
                    $this->form_validation->set_rules('produit_nom', 'Produit nom', 'trim|required|min_length[3]');
                    $this->form_validation->set_rules('produit_prix_HT', 'Produit prix HT', 'trim|required');
                    $this->form_validation->set_rules('produit_caract', 'Produit caractéristiques', 'trim|required|min_length[3]');
                    $this->form_validation->set_rules('produit_sousrub_id', 'Produit sous rubrique', 'trim|required');
                    $this->form_validation->set_rules('produit_qtite', 'Produit quantité', 'trim|required');
                    $this->form_validation->set_rules('produit_qtite_ale', 'Produit quantité alerte', 'trim|required');
                    // $this->form_validation->set_rules('produit_image', 'Produit image', 'trim|required|min_length[3]');
                    // $this->form_validation->set_rules('produit_desc', 'Produit description', 'trim|required|min_length[3]');

                    if ($this->form_validation->run() == FALSE) { // Si erreur du formulaire 
                        $data = array('errors' => validation_errors()); // Affectation des erreurs à la variable $data
                        $this->session->set_flashdata($data); // Redirection et affichage des erreurs
                        redirect('adminproducts/index');
                    } else { // Si aucune erreur, affectation des POSTS aux différents champs présents en BDD
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

                        // Récupération des id de rubrique et de sous rubrique
                        $rubid = $this->input->post('produit_rub_id');
                        $sousrubid = $this->input->post('produit_sousrub_id');

                        // Envoie du tableau à la fonction addProduct du modèle adminproducts afin d'ajouter un produit en BDD
                        $lastId = $this->Model_adminproducts->addProduct($data);
                        // Récupération de la dernière id de produit rentrée en BDD soit à l'instant

                        if ($lastId > 0) { // Si l'id est correct

                            // Appel de la fonction upload_image présente dans le controller en passant en paramètre l'id de la rubrique
                            // de la sous-rubrique et l'id du produit en paramètres afin de stocker la photo au bon endroit
                            $this->upload_image($rubid, $sousrubid, $lastId);
                            redirect('adminproducts/getProduct'); // Redirection à la liste des produits
                        }
                    }
                } else {
                    redirect(''); // Redirection page d'accueil si problème d'identification admin
                }
            } else {
                redirect(''); // Redirection page d'accueil si problème d'identification admin
            }
        } else {
            redirect(''); // Redirection page d'accueil si problème d'identification admin
        }
    }

    function upload_image($rubid, $sousrubid, $lastId) // Fonction d'upload de l'image du produit
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    $path = "./assets/images/Imagesproducts/$rubid/$sousrubid/$lastId"; // Construction du chemin du stockage de la photo avec les bons id
                    // Configuration du chemin, des types autorisés et du nom du de la photo
                    $config['upload_path'] = $path; //path folder
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                    $config['file_name'] =  "product.jpg";

                    $this->upload->initialize($config); // Initialisation des configurations en l'envoyant à la fonction initialize de la librairie upload
                    if (file_exists('assets/images/Imagesproducts/' . $rubid . '/' . $sousrubid . '/' . $lastId . '/product.jpg')) {
                        // Si l'image existe déjà elle est supprimée
                        unlink('assets/images/Imagesproducts/' . $rubid . '/' . $sousrubid . '/' . $lastId . '/product.jpg');
                    }

                    if (!empty($_FILES['image_file']['name'])) { // Si le POST de la photo n'est pas vide
                        if ($this->upload->do_upload('image_file')) { // Si l'image est bien upload
                            $gbr = $this->upload->data(); // Récupération de l'upload de l'image
                            $this->gallery($gbr['file_name'], $path); // Envoie de l'image avec le chemin à la fonction gallery qui permet d'enregistrer plusieurs formats en même temps
                        } else { // S'il y a une erreur
                            echo $this->upload->display_errors();
                        }
                    } else { // Si il n'y a pas d'image envoyée
                        echo "image vide ou type non autorisé";
                    }
                } else {
                    redirect(''); // Redirection page d'accueil si problème d'identification admin
                }
            } else {
                redirect(''); // Redirection page d'accueil si problème d'identification admin
            }
        } else {
            redirect(''); // Redirection page d'accueil si problème d'identification admin
        }
    }


    public function getProduct() // Fonction permettant d'afficher les vues permettant au script jQuery d'afficher la liste
    {
        if (isset($this->session->userdata)) {
            $data['products'] = $this->Model_adminproducts->getProducts(); // // Récupération de la table des produits dans un tableau depuis la fonction getProducts du modèle adminproducts
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Chargement des vues et envoie du tableau de données à la navbar admin pour afficher certaines infos
                    // Et envoie du tableau de produits pour la liste
                    $this->load->view('admin/partials/header');

                    $this->load->view('admin/partials/navbar', $data);

                    $this->load->view('admin/adminproducts/index', $data);

                    $this->load->view('admin/partials/footer');
                } else {
                    redirect(''); // Redirection page d'accueil si problème d'identification admin
                }
            } else {
                redirect(''); // Redirection page d'accueil si problème d'identification admin
            }
        } else {
            redirect(''); // Redirection page d'accueil si problème d'identification admin
        }
    }


    function gallery($file_name, $path) // Fonction permettant d'upload une photo en 3 exemplaires différents, pouvant être changée et adaptée correctement
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

    public function deleteProduct($idSR, $idP) // Fonction permettant de supprimer un produit en passant en paramètre l'id de sous-rubrique et l'id du produit
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Appel de la fonction deleteProduct du modèle adminproducts en passant l'id du produit en paramètre
                    $result = $this->Model_adminproducts->deleteProduct($idP);
                    // Récupération de données pour lier le produit à la sous-rubrique à la rubrique
                    // print_r($result);
                    $idR = $result['sousrub_rubrique_id']; // Affectation à la variable de l'id de la rubrique reliée
                    $suppr = rmdir('assets/images/Imagesproducts/' . $idR . '/' . $idSR . '/' . $idP . '');
                    // Suppression du dossier du produit contenant sa photo
                    if ($suppr == true) { // Si la suppression est effective, redirection à la liste des produits
                        redirect('adminproducts/getProduct');
                    }
                } else {
                    redirect(''); // Redirection page d'accueil si problème d'identification admin
                }
            } else {
                redirect(''); // Redirection page d'accueil si problème d'identification admin
            }
        } else {
            redirect(''); // Redirection page d'accueil si problème d'identification admin
        }
    }

    public function editProduct($idP) // Fonction permettant de charger un formulaire reprenant les informations du produit
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    $data['getSousRubriques'] = $this->Model_adminproducts->getSousRubriques(); // Récupération de la table des sous-rubriques dans un tableau depuis la fonction getSousRubriques du modèle adminproducts
                    $data['getProRubriques'] = $this->Model_adminproducts->getProRubriques(); // Récupération de la table des rubriques dans un tableau depuis la fonction getProRubriques du modèle adminproducts
                    $data['getSousRubriqueP'] = $this->Model_adminproducts->getSousRubriqueP($idP); // Récupération de l'id de sous-rubriques du produit dans un tableau depuis la fonction getSousRubriqueP du modèle adminproducts en passant l'id du produit en paramètre
                    $array['data'] =  $this->Model_adminproducts->getProductData($idP); // Récupération des informations du produit dans un tableau depuis la fonction getProductData du modèle adminproducts en passant l'id du produit en paramètre


                    // Chargement des vues et envoie des tableaux concernant les sous-rubriques, la rubrique, la sous-rubrique du produit
                    // Ainsi que toutes les données du produit au formulaire
                    $this->load->view('admin/partials/header');

                    $this->load->view('admin/partials/navbar', $data);

                    $this->load->view('admin/adminproducts/editproduct', $array);

                    $this->load->view('admin/partials/footer');
                } else {
                    redirect(''); // Redirection page d'accueil si problème d'identification admin
                }
            } else {
                redirect(''); // Redirection page d'accueil si problème d'identification admin
            }
        } else {
            redirect(''); // Redirection page d'accueil si problème d'identification admin
        }
    }

    public function updateProduct($rubid, $sousrubid, $lastId) // Fonction permettant d'éditer les informations du produit
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Vérification que tous les champs sont remplis pour éviter les erreurs
                    $this->form_validation->set_rules('produit_marque', 'Produit marque', 'trim|required|min_length[3]');
                    $this->form_validation->set_rules('produit_nom', 'Produit nom', 'trim|required|min_length[3]');
                    $this->form_validation->set_rules('produit_prix_HT', 'Produit prix HT', 'trim|required');
                    $this->form_validation->set_rules('produit_caract', 'Produit caractéristiques', 'trim|required|min_length[3]');
                    $this->form_validation->set_rules('produit_sousrub_id', 'Produit sous rubrique', 'trim|required');
                    $this->form_validation->set_rules('produit_qtite', 'Produit quantité', 'trim|required');
                    $this->form_validation->set_rules('produit_qtite_ale', 'Produit quantité alerte', 'trim|required');

                    if ($this->form_validation->run() == FALSE) { // Si erreur du formulaire 
                        $data = array('errors' => validation_errors()); // Affectation des erreurs à la variable $data
                        $this->session->set_flashdata($data); // Redirection et affichage des erreurs
                        redirect('adminproducts/index');
                    } else { // Si aucune erreur, affectation des POSTS aux différents champs présents en BDD
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

                        // Envoie du tableau à la fonction updateProduct du modèle adminproducts pour update en BDD
                        $dataPro = $this->Model_adminproducts->updateProduct($data);
                        // Récupération de la ligne entière du produit venant d'être update

                        if ($dataPro) { // Si l'update a eu lieu
                            $this->upload_image($rubid, $sousrubid, $lastId); // La fonction d'upload est appellée pour update la photo
                        }
                        redirect('adminproducts/getProduct'); // Redirection à la liste des produits
                    }
                } else {
                    redirect(''); // Redirection page d'accueil si problème d'identification admin
                }
            } else {
                redirect(''); // Redirection page d'accueil si problème d'identification admin
            }
        } else {
            redirect(''); // Redirection page d'accueil si problème d'identification admin
        }
    }
}
