<?php

class Model_espaceclient extends CI_Model
{
    public function getClient()
    {

        $user_id = $this->session->userdata('user_id');

        if ($user_id > 0) {

            $this->db->select('client_id, client_nom, client_prenom, client_adresse, client_ville, client_codepo, client_telephone, client_mail, client_type, client_siret, client_role_id, client_commerciaux_id');
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

    public function getCommande($idcommande){

        $this->db->select('*');
        $this->db->from('secomposede');
        $this->db->join('commande', 'secomposede.secomposede_commande_id = commande.commande_id');
        $this->db->where('commande_id', $idcommande);
        $select = $this->db->get();

        return $select->result();

    }
}


?>