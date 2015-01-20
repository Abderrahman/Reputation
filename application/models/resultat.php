<?php

class Resultat extends CI_Model {

    public $resultat_id;
    public $titre;
    public $link;
    public $snippet;
    public $position;
    public $status;
    public $idClient;

    function insert() {
        $this->db->insert('resultat', $this);
        $this->ID = $this->db->insert_id();
    }

    function update() {
        $this->db->update('resultat', $this, 'resultat_id');
    }

    public function get($id) {

        $this->db->select('*')->from('resultat')->where('idclient', $id);
        $query = $this->db->get();

        foreach ($query->result() as $row) {

            $resultats[] = array(
                'titre' => $row->titre,
                'link' => $row->link,
                'snippet' => $row->snippet,
                'position' => $row->position,
                'status' => $row->status
            );
        }
        
        return $resultats;
    }
}