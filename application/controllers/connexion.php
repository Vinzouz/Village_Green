<?php

class connexion extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model('Model_connection');
        $this->load->model('Model_espaceclient');
        $this->load->model('Model_home');
    }

    public function index()
    {
        $this->load->view('include/incl_head');
        $this->load->view('login/incl_formconnexion');
        $this->load->view('include/incl_script');
    }

    public function login()
    {

        $this->form_validation->set_rules(
            'client_mail',
            'ConclientMail',
            'trim|required|valid_email',
            array(
                "required"      => "Le mail n'est pas rempli",
                "valid_email"     => "Le mail n'est pas valide",
                "trim"  => "Des espaces dans l'email sont présents"
            )
        );
        //password
        $this->form_validation->set_rules(
            'client_password',
            'ConclientPass',
            'trim|required|min_length[4]',
            array(
                "required"      => "Le mot de passe n'est pas rempli",
                "min_length"     => "Le mot de passe est trop court",
                "trim"  => "Des espaces dans l'email sont présents"
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $data = array('errors' => validation_errors('<p style="color:red">', '</p>'));
            $this->session->set_flashdata($data);
            redirect('connexion/index');
        } else {
            $result = $this->Model_connection->login();
            //print_r($result);
            $user_id = $result['client_id'];

            if ($user_id > 0) {
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $result['client_nom'],
                    'role' => $result['client_role_id'],
                    'logged_in' => true
                );
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('login', 'Vous êtes connecté ');
                redirect('');
            } else {
                $this->session->set_flashdata('errors', '<p style="color:red">Mauvais mail ou mot de passe incorrect</p>');
                $this->session->set_flashdata('failed', 'Vous n\'êtes pas connecté');
                redirect('connexion/index');
            }
        }
    }

    public function edit()
    {

        if ($this->session->userdata('user_id') == null) {
            redirect('');
        }
        $array['data'] =  $this->Model_connection->getUserdata();
        $this->load->view('include/incl_head');
        $this->load->view('login/incl_editaccount', $array);
        $this->load->view('include/incl_script');
    }

    public function updateUser()
    {

        $this->form_validation->set_rules('InsclientNom', 'InsclientNom', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('InsclientPrenom', 'InsclientPrenom', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('InsclientAdresse', 'InsclientAdresse', 'trim|required');
        $this->form_validation->set_rules('InsclientCodeP', 'InsclientCodeP', 'trim|required|min_length[5]|max_length[5]');
        $this->form_validation->set_rules('InsclientVille', 'InsclientVille', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('InsclientTel', 'InsclientTel', 'trim|required|min_length[10]');
        $this->form_validation->set_rules('InsclientMail', 'InsclientMail', 'trim|required|valid_email');
        //password
        $this->form_validation->set_rules('InsclientPass', 'InsclientPass', 'trim|required|min_length[4]');


        if ($this->form_validation->run() == FALSE) {
            $data = array('errors' => validation_errors());
            $this->session->set_flashdata($data);
            redirect('welcome/inscription');
        } else {
            $data = array(
                'client_nom' => $this->input->post('InsclientNom'),
                'client_prenom' => $this->input->post('InsclientPrenom'),
                'client_adresse' => $this->input->post('InsclientAdresse'),
                'client_ville' => $this->input->post('InsclientVille'),
                'client_codepo' => $this->input->post('InsclientCodeP'),
                'client_telephone' => $this->input->post('InsclientTel'),
                'client_mail' => $this->input->post('InsclientMail'),
                'client_type' => $this->input->post('InsclientType'),
                'client_siret' => $this->input->post('InsclientSiret'),
                'client_password' => password_hash($this->input->post('InsclientPass'), PASSWORD_DEFAULT)
            );
            $nom = $this->input->post('InsclientNom');

            $dataUser = $this->Model_connection->updateUser($data);
            // print_r($test);
            if ($dataUser) {
                $user_data = array(
                    'user_id' => $dataUser['client_id'],
                    'username' => $dataUser['client_nom'],
                    'role' => $dataUser['client_role_id'],
                    'logged_in' => true
                );

                $this->session->set_userdata($user_data);
            }
            redirect('connexion/edit');
        }
    }
}
