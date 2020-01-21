<?php

class Model_connection extends CI_Model
{

    public function login()
    {

        $clientMail = $this->input->post('client_mail');
        


        $this->db->where('client_mail', $clientMail);
        
        $select = $this->db->get('clients');
        

        if ($select) {
            $selectUser = $select->row_array();
            $pHash = $selectUser['client_password'];
            $clientPassword = $this->input->post('client_password');
            if (password_verify($clientPassword, $pHash)) {
                return $selectUser;
            }
        } else {
            return false;
        }
    }


    public function getUserdata()
    {

        $user_id = $this->session->userdata('user_id');

        if ($user_id > 0) {

            $this->db->where('client_id', $user_id);
            $result = $this->db->get('clients');

            return $result->row_array();
        } else {
            return false;
        }
    }



    public function updateUser($data)
    {

        $clientId = $this->session->userdata('user_id');
        $clientPassword = $this->input->post('InsclientPass');
        $this->db->where('client_id', $clientId);
    
        $select = $this->db->get('clients');
        $selectUser = $select->row_array();

        if ($selectUser) {
            $pHash = $selectUser['client_password'];
            
            if (password_verify($clientPassword, $pHash)) {
                $this->db->set($data);
                $this->db->where('client_id', $clientId);
                $this->db->update('clients');
                return $selectUser;
            }
        } else {
            return false;
        }
    }
}
