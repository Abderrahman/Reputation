<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class about extends CI_Controller {
    
    public function index() {

        $this->load->view('header', array('page' => 'About'));
        $this->load->view('about');
        $this->load->view('footer');
    }
}
