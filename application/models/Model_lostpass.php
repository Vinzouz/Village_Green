<?php

class Model_lostpass extends CI_Model {

    public function envoie()
    {

        $clientMail = $this->input->post('client_mail');

        $this->db->where('client_mail', $clientMail);
        
        $select = $this->db->get('clients');
        $selectUser = $select->row_array();
        
        if ($selectUser) {
     
                return $selectUser;
            
        } else {
            return false;
        }
    }


    public function verif(){

        $code = $this->input->post('client_temporaire_code');
        $email = $this->session->userdata('user_mail');

        $this->db->where('clients_temporaire_mail', $email);
        $this->db->where('clients_temporaire_code', $code);
        $select = $this->db->get('clients_temporaire');

        $selectUser = $select->row_array();
        
        if ($selectUser) {
            $this->db->where('clients_temporaire_mail', $email);
            $this->db->delete('clients_temporaire');
                return $selectUser;
        } else {
            return false;
        }
    }



    public function updatepass(){

        $data = array(
        "client_password" => password_hash($this->input->post('client_newpass'), PASSWORD_DEFAULT)
        );

        $user_id = $this->session->userdata('user_id');
        $user_mail = $this->session->userdata('user_mail');

        try{
        $this->db->where('client_id', $user_id);
        $this->db->where('client_mail', $user_mail);
        $this->db->update('clients', $data);
        return true;
        }
        catch(Exception $e){
            $warning = ['error' => $e];
            $this->session->set_flashdata($warning);
        }
    }


    public function insert_clients_temporaire($data){

        $this->db->insert('clients_temporaire', $data);

    }
}