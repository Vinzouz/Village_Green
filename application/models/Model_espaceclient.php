<?php

class Model_espaceclient extends CI_Model
{
    public function getClient()
    {

        $user_id = $this->session->userdata('user_id');

        if ($user_id > 0) {

            $this->db->select('*');
            $this->db->from('clients');
            $this->db->where('client_id', $user_id);
            $select = $this->db->get();

            return $select->result();
        }
         else {
            return false;
        }
    }


    public function getEspaceC()
    {

        $user_id = $this->session->userdata('user_id');

        if ($user_id > 0) {

            $this->db->select('*');
            $this->db->from('clients');
            $this->db->join('commande', 'clients.client_id = commande.commande_client_id');
            $this->db->where('client_id', $user_id);
            $select = $this->db->get();

            return $select->result();
        }
         else {
            return false;
        }
    }
}


?>