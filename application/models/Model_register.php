<?php

    class Model_register extends CI_Model
    {

        public function clientStore( $data )
        {
            $this->db->insert( 'clients', $data );
            $insert_id = $this->db->insert_id();
            $this->db->where( 'client_id', $insert_id );
            $result = $this->db->get( 'clients' );

            if ( $result ) {
                return $insert_id;
            } else {
                return false;
            }
        }
    }