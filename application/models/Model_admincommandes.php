<?php

class Model_admincommandes extends CI_Model
{

    public function getCommandes()
    {

        $select = $this->db->get('commande');

        return $select;
    }

    function getCommande($postData = null)
    {

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (commande_etat like '%" . $searchValue . "%' or commande_id like '%" . $searchValue . "%' ) ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $records = $this->db->get('commande')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('commande')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('commande')->result();

        $data = array();

        foreach ($records as $record) {
            $data[] = array(
                "commande_id" => $record->commande_id,
                "commande_date" => $record->commande_date,
                "commande_reduc" => $record->commande_reduc,
                "commande_prix_tot" => $record->commande_prix_tot,
                "commande_date_reglem" => $record->commande_date_reglem,
                "commande_date_facture" => $record->commande_date_facture,
                "commande_livraison_rue" => $record->commande_livraison_rue,
                "commande_livraison_ville" => $record->commande_livraison_ville,
                "commande_livraison_codepo" => $record->commande_livraison_codepo,
                "commande_facturation_rue" => $record->commande_facturation_rue,
                "commande_facturation_ville" => $record->commande_facturation_ville,
                "commande_facturation_codepo" => $record->commande_facturation_codepo,
                "commande_etat" => $record->commande_etat,
                "commande_client_id" => $record->commande_client_id
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }

    public function deleteCommande($id)
    {

        $this->db->where('commande_id', $id);
        $this->db->delete('commande');
    }

    public function getCommandeData($id)
    {

        if ($id > 0) {

            $this->db->where('commande_id', $id);
            $result = $this->db->get('commande');

            return $result->row_array();
        } else {
            return false;
        }
    }

    public function updateCommande($data)
    {

        $id = $data['commande_id'];

        $this->db->where('commande_id', $id);

        $select = $this->db->get('commande');

        $selectCommande = $select->row_array();

        if ($selectCommande) {

            $this->db->set($data);
            $this->db->where('commande_id', $id);
            $this->db->update('commande');
            return $selectCommande;
        } else {
            return false;
        }
    }

    public function insertLivraison($datalivraisonC)
    {

        $this->db->insert('livraison', $datalivraisonC);
        $insert_id = $this->db->insert_id();
        $this->db->where('livraison_id', $insert_id);
        $result = $this->db->get('livraison');

        if ($result) {
            return $insert_id;
        } else {
            return false;
        }
    }

    public function getCompolivraison($id){

        $this->db->select('secomposede_produit_id, secomposede_qtite_commande');
        $this->db->where('secomposede_commande_id',$id);
        $select = $this->db->get('secomposede');

        return $select->result_array();
    }

    public function insertContenulivraison($contenu){

        $i = 0;
        foreach($contenu[0][$i] as $key){
            $data = array(
                "contient_livraison_id" => $contenu['contient_livraison_id'],
                "contient_produit_id" => $contenu[0][$i]['secomposede_produit_id'],
                "contient_qtite_liv" => $contenu[0][$i]['secomposede_qtite_commande']
            );
            $this->db->insert('contient', $data);
                $i++;
        }
    }

    public function updateLivraison($id){

        $data = array("livraison_etat" => 'Livrée');
        $this->db->set($data);
        $this->db->where('livraison_commande_id', $id);
        $this->db->update('livraison');

    }
}
