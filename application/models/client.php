<?php

class Client extends CI_Model {

    public $id;
    public $query;
    public $email;
    public $password;
    public $firstName;
    public $lastName;

    public function insert() {

        $this->db->insert('client', $this);
        $this->id = $this->db->insert_id();
    }

    public function update() {
        $this->db->update('client', $this, 'id');
    }

    public function get($id) {

        $query = $this->db->get_where('client', array('id' => $id));
        if ($query->num_rows()) return $query->row();
        return false;
    }

    public function queries() {

        $email = $this->session->userdata('email');
        $this->db->select('query, id')->from('client')->where('email', $email);
        $result = $this->db->get()->result();
        return $result;
    }

    public function reset_password($id, $new_password) {
        
        $new_password = sha1($new_password);
        
        $data = array( 'password' => $new_password);
        $this->db->where('id', $id);
        $this->db->update('client', $data);
    }

    function email_exists($email) {
        $this->db->from('client')->where('email', $email)->limit(1);
        $login = $this->db->get()->result();
        if (is_array($login) && count($login) == 1) {
            $this->id = $login[0]->id;
            $this->email = $login[0]->email;
            return true;
        }
        return false;
    }

    function validate_user($email, $password) {
        // Build a query to retrieve the user's details
        // based on the received username and password
        $this->db->from('client');
        $this->db->where('email', $email);
        $this->db->where('password', sha1($password));
        $login = $this->db->get()->result();

        // The results of the query are stored in $login.
        // If a value exists, then the user account exists and is validated
        if (is_array($login) && count($login) == 1) {
            // Set the users details into their properties of this class

            $this->id = $login[0]->id;
            $this->query = $login[0]->query;
            $this->email = $login[0]->email;
            $this->firstName = $login[0]->firstName;
            $this->lastName = $login[0]->lastName;

            // Call set_session to set the user's session vars via CodeIgniter
            $this->set_session();
            return true;
        }

        return false;
    }

    function set_session() {

        // session->set_userdata is a CodeIgniter function that
        // stores data in CodeIgniter's session storage. Some of the values are built in
        // to CodeIgniter, others are added. See CodeIgniter's documentation for details.

        $this->session->set_userdata(array(
            'id' => $this->id,
            'email' => $this->email,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'current_query' => $this->id,
            'logged_in' => true
        ));
    }

}
