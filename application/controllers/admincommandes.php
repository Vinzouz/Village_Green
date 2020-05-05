<?php

class admincommandes extends CI_Controller
{

    public function __construct() // Fonction constructrice qui charge les modèles pour tout le controller
    {
        parent::__construct();
        $this->load->model('Model_admincommandes');
        $this->load->model('Model_espaceclient');
    }

    public function index() // Fonction index qui charge la liste des commandes
    {
        if (isset($this->session->userdata)) { // Vérification si l'utilisateur est connecté
            $data['commandes'] = $this->Model_admincommandes->getCommandes(); // Récupération de la table des commandes dans un tableau depuis la fonction getCommandes du modèle admincommandes
            $data['dataC'] = $this->Model_espaceclient->getClient(); // Récupération des données du client dans un tableau depuis la fonction getClient du modèle espaceclient

            if ($data['dataC'] != null) { // Vérification si le tableau n'est pas vide
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {
                    // Vérification si l'utilisateur à le role_id 1 qui est égal au rôle admin et si son id est égal à 101, 102 ou 103
                    // qui sont les seuls comptes autorisés

                    // Chargement des vues et envoie du tableau de données à la navbar admin pour afficher certaines infos
                    // Et envoie du tableau de commandes pour la liste
                    $this->load->view('admin/partials/header');

                    $this->load->view('admin/partials/navbar', $data);

                    $this->load->view('admin/admincommandes/commandelist', $data);

                    $this->load->view('admin/partials/footer');
                }
            }
        }
    }

    public function listeCommandes() // Liste des commandes pouvant changer dynamiquement avec la recherche appellée par le script jQuery
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Récupération du POST normalement vide de base du script jQuery pour récupérer la liste entière d'utilisateurs
                    // Change en cas de recherche
                    $postData = $this->input->post();

                    // Envoie du POST à la fonction getCommande du modèle adminclients
                    $data = $this->Model_admincommandes->getCommande($postData);
                    // Récupération des résultats dans la variable data

                    echo json_encode($data); // Affichage direct des données avec le json_encode afin que le script puisse utiliser les données
                }
            }
        }
    }


    public function deleteCommande($id) // Fonction permettant de supprimer une commande en passant son id
    {
        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    $this->Model_admincommandes->deleteCommande($id);
                    // Appel de la fonction deleteCommande du modèle admincommandes qui permet de supprimer une commande en passant
                    // son id en paramètre puis redirection à la liste des commandes
                    redirect('admincommandes/index');
                }
            }
        }
    }


    public function editCommande($id) // Fonction permettant de charger un formulaire reprenant les informations de la commande
    {                                   // grâce à son id passée en paramètre

        if (isset($this->session->userdata)) {
            $array['data'] =  $this->Model_admincommandes->getCommandeData($id); // Récupération des données de la commande dans un tableau depuis la fonction getCommandeData du modèle admincommandes
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Chargement des vues et envoie du tableau de données à la navbar admin pour afficher certaines infos
                    // Et envoie du tableau des données de la commande au formulaire
                    $this->load->view('admin/partials/header');

                    $this->load->view('admin/partials/navbar', $data);

                    $this->load->view('admin/admincommandes/editcommande', $array);

                    $this->load->view('admin/partials/footer');
                }
            }
        }
    }

    public function updateCommande() // Fonction permettant d'éditer les informations de la commande
    {

        if (isset($this->session->userdata)) {
            $data['dataC'] = $this->Model_espaceclient->getClient();

            if ($data['dataC'] != null) {
                if ($data['dataC'][0]->client_role_id === 1 && $data['dataC'][0]->client_id === "101" || $data['dataC'][0]->client_id === "102" || $data['dataC'][0]->client_id === "103") {

                    // Vérification que tous les champs sont remplis pour éviter les erreurs
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

                    if ($this->form_validation->run() == FALSE) { // Si erreur du formulaire 
                        $data = array('errors' => validation_errors()); // Affectation des erreurs à la variable $data
                        $this->session->set_flashdata($data); // Redirection et affichage des erreurs
                        redirect('');
                    } else { // Si aucune erreur, affectation des POSTS aux différents champs présents en BDD
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

                        // Envoie du tableau à la fonction updateCommande du modèle admincommandes pour update en BDD
                        $dataCommande = $this->Model_admincommandes->updateCommande($data);
                        // Récupération de l'état de la commande, si modifié

                        if ($dataCommande['commande_etat'] === 'En cours de livraison') { // Si l'état de la commande passe 'En cours de livraison'
                            $nombrealeatoire = $this->genererChaine(10); // Une chaîne de 10 caractères est générée pour le numéro du bon de livraison
                            $jour = date('d'); // Récupération de la date actuelle
                            $jourlivraison = $jour + 5; // Ajout de 5 jours 'standard' pour la livraison
                            $datalivraisonC = array( // Affectation des différents résultats aux champs présents en BDD
                                'livraison_num_bon' => $nombrealeatoire,
                                'livraison_date' => date('Y-m-' . $jourlivraison . ''),
                                'livraison_commande_id' => $dataCommande['commande_id'],
                                'livraison_etat' => 'En cours'
                            );
                            // Envoie du tableau à la fonction insertLivraison du modèle admincommandes pour insérer une livraison en BDD
                            $idlivraisonCommande = $this->Model_admincommandes->insertLivraison($datalivraisonC);
                            // Récupération de l'id de la livraison afin de lier avec la table contient

                            $compolivraison = $this->Model_admincommandes->getCompolivraison($dataCommande['commande_id']);
                            // Appel de la fonction getCompolivraison du modèle admincommandes en passant en paramètre l'id de la commande
                            // Et qui renvoie ce que contient la commande dans la variable $compolivraison 

                            $contenulivraison = array( // Affectation des différents résultats aux champs présents en BDD
                                "contient_livraison_id" => $idlivraisonCommande,
                                $compolivraison
                            );
                            $this->Model_admincommandes->insertContenulivraison($contenulivraison);
                            // Envoie du tableau du contenu de la commande à la fonction insertContenulivraison du modèle admincommandes
                            // Afin d'insérer la composition de la commande dans la table contient
                        }

                        if ($dataCommande['commande_etat'] === 'Livrée') { // Si l'état de la commande passe à 'Livrée'
                            
                            // Appel de la fonction updateLivraison du modèle admincommandes qui update simplement l'état de la livraison
                            $this->Model_admincommandes->updateLivraison($dataCommande['commande_id']);
                        }

                        redirect('admincommandes/index');
                        // Une fois l'update fini, redirection vers la liste des commandes
                    }
                }
            }
        }
    }

    function genererChaine($longueur) // Fonction permettant de générer une chaîne aléatoire de caractère définis en passant la longueur souhaitée en paramètre
    {
        $listeCar = '0123456789';
        $chaine = '';
        for ($i = 0; $i < $longueur; ++$i) {
            $chaine .= $listeCar[random_int(0, 6)];
        }
        return $chaine;
    }
}
