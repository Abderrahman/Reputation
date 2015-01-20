<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Evolution extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('util');
        $this->util->cache();

        if (!$this->session->userdata('logged_in')) {
            redirect('/login/show_login');
        }
    }

    public function index() {

        $this->load->view('header', array('page' => 'Evolution'));
        $this->load->model('score');

        $this->load->view('evolChart');
        $this->load->view('footer', array('jsfile' => 'linechart'));
    }

    public function getData() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->load->model('score');

            $id = $this->session->userdata('current_query');
            $scores = Score::get($id);

            //var_dump($scores);

            $json = json_encode($scores);
            echo $json;
        }
    }

}
