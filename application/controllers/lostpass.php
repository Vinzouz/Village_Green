<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Lostpass extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_lostpass');
    }

    public function index()
    {
        $this->load->view('include/incl_loader');
        $this->load->view('include/incl_head');
        $this->load->view('login/incl_formlostpass');
        $this->load->view('include/incl_script');
    }

    public function envoie()
    {
        // $mailReg = '/([a-zA-Z0-9-_]{1,20})+(\.[a-zA-Z0-9-_]{1,20})*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]{1,20})*\.[a-zA-Z]{2,4}/';
        $this->form_validation->set_rules('client_mail', 'ConclientMail', "trim|required|valid_email");

        if ($this->form_validation->run() == FALSE) {
            $data = array('errors' => validation_errors());
            $this->session->set_flashdata($data);
            redirect('lostpass/index');
        } else {
            $result = $this->Model_lostpass->envoie();

            if ($result) {
                $user_id = $result['client_id'];
                $user_mail = $result['client_mail'];
                $user_data = array(
                    'user_id' => $user_id,
                    'user_mail' => $user_mail
                );
                $this->session->set_userdata($user_data);
                $nombrealeatoire = $this->genererChaine(6);
                $data = array(
                    'clients_temporaire_mail' => $user_mail,
                    'clients_temporaire_code' => $nombrealeatoire
                );

                require 'PHPMailer/sendmail.php';
                $send = envoyermail($user_mail, $nombrealeatoire);

                if ($send == 1) {
                    $this->Model_lostpass->insert_clients_temporaire($data);
                    $this->load->view('include/incl_loader');
                    $this->load->view('include/incl_head');
                    $this->load->view('login/incl_formcode');
                    $this->load->view('include/incl_script');
                }
            } else {
                $this->session->set_flashdata('failed', 'Aucun email correspondant');
                redirect('connexion/index');
            }
        }
    }


    public function verif()
    {
        // $user_id = $this->session->userdata('user_id');
        // $user_mail = $this->session->userdata('user_mail');

        // if ($user_id > 0 && $user_mail != "") {

            $this->form_validation->set_rules('client_temporaire_code', 'Code', 'trim|required|min_length[6]');
            if ($this->form_validation->run() == FALSE) {
                $data = array('errors' => validation_errors());
                $this->session->set_flashdata($data);
                redirect('');
            } else {

                $result = $this->Model_lostpass->verif();

                if ($result) {

                    $this->load->view('include/incl_loader');
                    $this->load->view('include/incl_head');
                    $this->load->view('login/incl_formnewpass');
                    $this->load->view('include/incl_script');
                } else {
                    redirect('login/incl_formcode');
                }
            }
        // } else {
        //     redirect('home/index');
        // }
    }

    public function updatepass()
    {
            $this->form_validation->set_rules('client_newpass', 'client_newpass', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('client_validnewpass', 'client_validnewpass', 'trim|required|min_length[3]|matches[client_newpass]');

            if ($this->form_validation->run() == FALSE) {
                $data = array('errors' => validation_errors());
                $this->session->set_flashdata($data);
                redirect('');
            } else {

                $result = $this->Model_lostpass->updatepass();

                //print_r($user_id);
                if ($result) {

                    redirect('home/index');
                } else {

                    redirect('login/incl_formnewpass');
                }
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
