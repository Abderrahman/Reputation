<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Score extends CI_Controller {

    private function calculerScore($array, $page = 1) {
        $score = 0;
        $p = 3;

        // array(1,1,0,-1,1,1,0,0,0,0)
        // pos = 1, neg = 0
        // 1ér resultat = 10 
        // 2éme resultat = 9 8 7 6 5 4 3 2 1
        
        for ($i = 0; $i < count($array); $i++) {

            $score += $p * (10 - $i) * $array[$i];
        }

        return $score;
    }

    public function add() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('404');
        }

        $id = $this->input->post('id', TRUE);
        $json = $this->input->post('json', TRUE);
        $email = $this->session->userdata('email');

        $array = json_decode($json);
        $score = Score::calculerScore($array);

        for ($i = 1; $i <= count($array); $i++) {

            $status = $array[$i - 1];

            $this->db->update('resultat', array('status' => $status), "idClient = $id and position = $i");
        }
        
        // insert score into table score
        $data = array('score' => $score, 'date' => date('Y-m-d'), 'client_id' => $id);
        $this->db->insert('score', $data);
        
        // $b is a boolean and indicate if the update was done with no errors
        $b = $this->db->update('client', array('email' => $email), "ID = $id");
        if ($b)
            echo 'true';
        

    }

    public function getScore() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('email');

            $id = $this->input->post('id', TRUE);
            $json = $this->input->post('json', TRUE);
            $first_name = $this->input->post('first_name', TRUE);
            $last_name = $this->input->post('last_name', TRUE);
            $password = $this->input->post('password', TRUE);
            $email = $this->input->post('email', TRUE);

            // Make sure the client doesn't enter an already used email
            $this->db->from('client');
            $this->db->where('email', $email);
            $l = $this->db->get()->result();

            if (count($l) != 0) {
                echo 'email is not valid, choose another one!';
                return;
            } else if (!valid_email($email)) {
                echo 'email is not valid';
                return;
            } else if (!empty($email) && !empty($id) && !empty($json)) {

                $array = json_decode($json);
                $score = Score::calculerScore($array);

                for ($i = 1; $i <= count($array); $i++) {

                    $status = $array[$i - 1];
                    
                    $this->db->where('idClient', $id);
                    $this->db->where('position', $i);
                    $this->db->update('resultat', array('status' => $status));
                }

                $d = array(
                    'email' => $email,
                    'password' => sha1($password),
                    'firstName' => $first_name,
                    'lastName' => $last_name
                );

                $this->db->where('id', $id);
                $b = $this->db->update('client', $d);

                // insert score into table score
                $data = array('score' => $score, 'date' => date('Y-m-d'), 'client_id' => $id);
                $this->db->insert('score', $data);

                if ($b) {

                    /*
                      ini_set('SMTP','smtp.menara.ma');
                      $message = "Votre score est: $score\r\nMerci de votre visite";

                      // In case any of our lines are larger than 70 characters, we should use wordwrap()
                      $message = wordwrap($message, 70, "\r\n");

                      // Send
                      mail($email, 'Reputation', $message);
                     */
                    echo "true";
                } else {
                    echo "false";
                }
            } else {
                echo 'please fill all the mandatory fields';
            }
        }
    }

}
