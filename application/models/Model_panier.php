<?php

class Model_panier extends CI_Model
{

    public function getinfosproduit($idP)
    {

        $this->db->select('*');
        $this->db->from('produit');
        $this->db->where('produit_id', $idP);
        $select = $this->db->get();

        return $select->result_array();
    }

    public function commander($data)
    {

        $this->db->insert('commande', $data);
        $insert_id = $this->db->insert_id();
        $this->db->where('commande_id', $insert_id);
        $result = $this->db->get('commande');

        if ($result) {
            return $insert_id;
        } else {
            return false;
        }
    }

    public function rentreeproduitcommande($idcommande)
    {

        $panier = $_SESSION['panier'];
        foreach ($panier as $key) {
            $this->db->select('produit_qtite');
            $this->db->from('produit');
            $this->db->where('produit_id', $key[0]['produit_id']);
            $select = $this->db->get();
            $dataP = $select->result_array();
            
            $data = array(
                "secomposede_commande_id" => $idcommande,
                "secomposede_produit_id" => $key[0]['produit_id'],
                "secomposede_qtite_commande" => $key[1],
                "secomposede_prix_vente" => $key[0]['produit_prix_HT']
            );
            $array = array(
                "produit_qtite" => $dataP[0]['produit_qtite'] - $key[1]
            );
            $this->db->insert('secomposede', $data);

            $this->db->where('produit_id', $key[0]['produit_id']);
            $this->db->update('produit', $array);
        }
    }

    public function dernierecommande(){

        $user_id = $this->session->userdata('user_id');
        $this->db->select('commande_id');
        $this->db->from('commande');
        $this->db->where('commande_client_id', $user_id);
        $this->db->order_by('commande_id', 'DESC');
        $this->db->limit(1);
        $select = $this->db->get();

        return $select->result_array();

    }
}
