<?php

class adminrubriques extends CI_Controller
{

    public function __construct() // Fonction constructrice qui charge les modèles / librairie pour tout le controller
    {
        parent::__construct();
        $this->load->model('Model_adminrubriques');
        $this->load->model('Model_espaceclient');
        $this->load->library('Upload');
    }

    public function index() // Fonction index qui charge le formulaire d'ajout de rubrique
    {

        if (isset($this->session->userdata)) { // Vérification si l'utilisateur est connecté
            $data['dataC'] = $this->Model_espaceclient->getClient(); // Récupération des données du client dans un tableau depuis la fonction getClient du modèle espaceclient

            if ($data['dataC'] != null) { // Vérification si le tableau n'est pas vide
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {
                    // Vérification si l'utilisateur à le role_id 1 qui est égal au rôle admin et si son id est égal à 101, 102 ou 103
                    // qui sont les seuls comptes autorisés

                    // Chargement des vues et envoie du tableau de données à la navbar admin pour afficher certaines infos
                    $this->load->view('admin/partials/header');

                    $this->load->view('admin/partials/navbar', $data);

                    $this->load->view('admin/adminproducts/rubriques/addrubrique');

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

    public function addRubrique() // Fonction permettant d'ajouter un nouveau produit après envoie du formulaire
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Vérification que les 2 champs sont remplis pour éviter les erreurs
                    $this->form_validation->set_rules('rubrique_nom', 'Nom rubrique', 'trim|required|min_length[3]');
                    $this->form_validation->set_rules('rubrique_desc', 'Description rubrique', 'trim|required|min_length[3]');

                    if ($this->form_validation->run() == FALSE) { // Si erreur du formulaire
                        $data = array('errors' => validation_errors()); // Affectation des erreurs à la variable $data
                        $this->session->set_flashdata($data); // Redirection et affichage des erreurs
                        redirect('adminrubriques/index');
                    } else { // Si aucune erreur, affectation des POSTS aux différents champs présents en BDD
                        $data = array(
                            'rubrique_nom' => $this->input->post('rubrique_nom'),
                            'rubrique_desc' => $this->input->post('rubrique_desc')

                        );
                        // Envoie du tableau à la fonction addRubrique du modèle adminrubriques afin d'ajouter une rubrique en BDD
                        $result = $this->Model_adminrubriques->addRubrique($data);
                        // Récupération de la dernière id de rubrique rentrée en BDD soit à l'instant

                        if ($result > 0) { // Si le résultat est cohérent
                            $this->upload_image($result); // Upload de l'image en passant en paramètre l'id de la rubrique
                            redirect('adminrubriques/getRubriques'); // Redirection à la liste des rubriques
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


    public function getRubriques() // Fonction permettant de lister les rubriques
    {

        if (isset($this->session->userdata)) {
            $data['rubriques'] = $this->Model_adminrubriques->getRubriques(); // Récupération de la table des rubriques dans un tableau depuis la fonction getRubriques du modèle adminrubriques
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Chargement des vues et envoie du tableau des rubriques pour la liste
                    $this->load->view('admin/partials/header');

                    $this->load->view('admin/partials/navbar', $data);

                    $this->load->view('admin/adminproducts/rubriques/index', $data);

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

    public function deleteRubrique($idR) // Fonction permettant de supprimer une rubrique en passant en paramètre l'id de rubrique
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Appel de la fonction deleteRubrique du modèle adminrubriques en passant l'id de rubrique en paramètre
                    $this->Model_adminrubriques->deleteRubrique($idR);

                    // Suppression de la photo de la rubrique et de son sous dossier
                    unlink('assets/images/Imagesproducts/' . $idR . '/home.jpg');
                    rmdir('assets/images/Imagesproducts/' . $idR . '');

                    redirect('adminrubriques/getRubriques'); // Redirection à la liste des rubriques
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

    public function editRubrique($idR) // Fonction permettant de charger un formulaire reprenant les informations de la rubrique
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    $array['data'] =  $this->Model_adminrubriques->getRubriqueData($idR); // Récupération des informations de la rubrique dans un tableau depuis la fonction getRubriqueData du modèle adminrubriques en passant l'id de la rubrique en paramètre

                    // Chargement des vues et envoie du tableau concernant toutes les données de la rubrique au formulaire
                    $this->load->view('admin/partials/header');

                    $this->load->view('admin/partials/navbar', $data);

                    $this->load->view('admin/adminproducts/rubriques/editrubrique', $array);

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

    public function updateRubrique($idR) // Fonction permettant d'éditer les informations de la rubrique
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Vérification que les 2 champs sont remplis pour éviter les erreurs
                    $this->form_validation->set_rules('rubrique_nom', 'rubrique_nom', 'trim|required|min_length[3]');
                    $this->form_validation->set_rules('rubrique_desc', 'rubrique_desc', 'trim');

                    if ($this->form_validation->run() == FALSE) { // Si erreur du formulaire 
                        $data = array('errors' => validation_errors()); // Affectation des erreurs à la variable $data
                        $this->session->set_flashdata($data); // Redirection et affichage des erreurs
                        redirect('adminrubriques/index');
                    } else { // Si aucune erreur, affectation des POSTS aux différents champs présents en BDD
                        $data = array(
                            'rubrique_id' => $idR,
                            'rubrique_nom' => $this->input->post('rubrique_nom'),
                            'rubrique_desc' => $this->input->post('rubrique_desc')
                        );

                        // Envoie du tableau à la fonction updateRubrique du modèle adminrubrique pour update en BDD
                        $dataRub = $this->Model_adminrubriques->updateRubrique($data);
                        // Récupération de la ligne entière de la rubrique venant d'être update

                        if ($dataRub) { // Si l'update a eu lieu
                            $this->upload_image($idR); // La fonction d'upload est appellée pour update la photo
                        }
                        redirect('adminrubriques/getRubriques'); // Redirection à la liste des rubriques
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

    function upload_image($rubid) // Fonction d'upload de l'image de la rubrique
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();
            
            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {
                    
                    $path = "./assets/images/Imagesproducts/$rubid/"; // Construction du chemin du stockage de la photo avec le bon id
                    // Configuration du chemin, des types autorisés et du nom du de la photo
                    $config['upload_path'] = $path; //path folder
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                    $config['file_name'] =  "home.jpg";

                    $this->upload->initialize($config); // Initialisation des configurations en l'envoyant à la fonction initialize de la librairie upload
                    if (file_exists('assets/images/Imagesproducts/' . $rubid . '/home.jpg')) {
                        // Si l'image existe déjà elle est supprimée
                        unlink('assets/images/Imagesproducts/' . $rubid . '/home.jpg');
                    }
                    if (!empty($_FILES['image_file']['name'])) { // Si le POST de la photo n'est pas vide
                        if ($this->upload->do_upload('image_file')) { // Si l'image est bien upload
                            $gbr = $this->upload->data(); // Récupération de l'upload de l'image
                            $this->gallery($gbr['file_name'], $path); // Envoie de l'image avec le chemin à la fonction gallery qui permet d'enregistrer en 1 format
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
