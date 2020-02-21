<?php
    defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

    class register extends CI_Controller
    {
        public function index()
        {

        }

        public function store()
        {

            $this->form_validation->set_rules( 'InsclientNom', 'InsclientNom', 'trim|required|min_length[3]|regex_match[/^([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})[-\'\s]{0,1}([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})[-\s]{0,1}([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})$/]' );
            $this->form_validation->set_rules( 'InsclientPrenom', 'InsclientPrenom', 'trim|required|min_length[3]|regex_match[/^([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})[-\'\s]{0,1}([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})[-\s]{0,1}([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})$/]' );
            $this->form_validation->set_rules( 'InsclientAdresse', 'InsclientAdresse', 'trim|required|regex_match[/^(?:([0-9]{0,4}[A-Z]{0,2})([,\s]?))(?:((bis|ter|qua)[\s,-])?)([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'"\-\s]{0,50}[\s]*)([0-9]{0,5})$/]' );
            $this->form_validation->set_rules( 'InsclientCodeP', 'InsclientCodeP', 'trim|required|min_length[5]|max_length[5]|regex_match[/^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B)) *([0-9]{3})?$/]' );
            $this->form_validation->set_rules( 'InsclientVille', 'InsclientVille', 'trim|required|min_length[3]|regex_match[/^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'"-\/\s]{1,40}$/]' );
            $this->form_validation->set_rules( 'InsclientTel', 'InsclientTel', 'trim|required|min_length[10]|regex_match[/^([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)$/]' );
            $this->form_validation->set_rules( 'InsclientMail', 'InsclientMail', 'trim|required|valid_email|regex_match[/([a-zA-Z0-9-_]{1,20})+(\.[a-zA-Z0-9-_]{1,20})*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]{1,20})*\.[a-zA-Z]{2,4}/]' );
            //password
            $this->form_validation->set_rules( 'InsclientPass', 'InsclientPass', 'trim|required|min_length[4]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/]' );
            $this->form_validation->set_rules( 'InsclientPassV', 'InsclientPassV', 'trim|required|min_length[3]|matches[InsclientPass]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/]' );

            if ( $this->form_validation->run() == FALSE ) {
                $data = array( 'errors' => validation_errors() );
                $this->session->set_flashdata( $data );
                redirect( 'home/inscription' );
            } else {
                $data = array(
                    'client_nom' => $this->input->post( 'InsclientNom' ),
                    'client_prenom' => $this->input->post( 'InsclientPrenom' ),
                    'client_adresse' => $this->input->post( 'InsclientAdresse' ),
                    'client_ville' => $this->input->post( 'InsclientVille' ),
                    'client_codepo' => $this->input->post( 'InsclientCodeP' ),
                    'client_telephone' => $this->input->post( 'InsclientTel' ),
                    'client_mail' => $this->input->post( 'InsclientMail' ),
                    'client_type' => $this->input->post( 'InsclientType' ),
                    'client_siret' => $this->input->post( 'InsclientSiret' ),
                    'client_password' => password_hash($this->input->post( 'InsclientPass' ), PASSWORD_DEFAULT)
                );
                $nom = $this->input->post( 'InsclientNom' );

                $this->load->model( 'Model_register' );
                $user_id = $this->Model_register->clientStore( $data );
                //print_r($user_id);
                if ( $user_id > 0 ) {
                    $user_data = array(
                        'user_id' => $user_id,
                        'username' => $nom,
                        'logged_in' => true
                    );

                    require 'PHPMailer/sendmail.php';
                    $Subject = 'Inscription à Village Green';
                    $Body    = "<p>Bonjour  $nom , ceci est un mail automatique pour vous prévenir que vous êtes bien inscrit sur Village Green.</p>";
                    envoyermail($user_mail, $Subject, $Body);

                    $this->session->set_userdata( $user_data );
                    $this->session->set_flashdata( 'login', 'Vous êtes connecté ' );

                } else {
                    $this->session->set_flashdata( 'failed', 'Vous n\'êtes pas connecté' );

                }
                redirect( '' );
            }

        }

        public function logout()
        {
            $this->session->sess_destroy();
            redirect('');
        }


    }