<?php


class Score extends CI_Model {

    public $score_id;
    public $client_id;
    public $score;
    public $date;

    function insert() {
        $this->db->insert('score', $this);
        $this->score_id = $this->db->insert_id();
    }

    public function get($id) {

        $this->db->select('*')->from('score')->where('client_id', $id)->order_by("date", "asc"); ;
        $query = $this->db->get();

        foreach ($query->result() as $row) {

            $scores[] = array(
                'score' => $row->score,
                'date' => $row->date,
            );
        }
        
        return $scores;
    }
    
    public function getLast($id){
        
        $this->db->select('score')->from('score')->where('client_id', $id)->order_by("date", "asc");
        $query = $this->db->get();
        
        foreach ($query->result() as $row){
            $last = $row->score;
        }
        
        return $last;
    }

}
