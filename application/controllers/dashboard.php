<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('util');
        $this->util->cache();

        if (!$this->session->userdata('logged_in')) {
            redirect('/login/show_login');
        }
    }

    public function index() {

        $this->load->model('score');
        $this->load->model('resultat');
        $this->load->model('client');


        $this->load->view('header', array('page' => 'Dashboard'));

        // retrieve all the queries made by the current logged in user.
        $result = $this->client->queries();

        foreach ($result as $r) {
            $data[$r->id] = $r->query;
        }
        $this->load->view('select', array('data' => $data));

        //$id = $this->session->userdata('id');
        $id = $this->session->userdata('current_query');
        // get the last element from the score table of that client_id
        $score = $this->score->getLast($id);

        // connected client score
        $this->load->view('chart', array('score' => $score));

        // display 10 result ...
        $resultats = $this->resultat->get($id);
        $this->load->view('resultat2', array('resultats' => $resultats));

        $this->load->view('footer', array('jsfile' => 'piechart'));
    }

    public function query() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('404');
        }

        $this->load->model('client');
        $query_id = $this->input->post('id');
        
        // if $query_id doesn't belong to the current logged in user do nothing 
        // else change it to the chosen id from the select element
        $result = $this->client->queries();
        foreach ($result as $r) {
            if($r->id === $query_id){
                $this->session->set_userdata('current_query', $query_id);
                break;
            }
        }
        
    }

}
