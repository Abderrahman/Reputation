<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class contact extends CI_Controller {
    
    public function __construct() {
        parent::__construct();

        $this->load->model('util');
        $this->util->cache();

        
        
        if (!$this->session->userdata('logged_in')) {
            redirect('/login/show_login');
        }
    }

    public function index() {

        $this->load->model('client');

        $this->load->view('header', array('page' => 'Contact'));
        $this->load->view('contact');
        $this->load->view('footer');
    }
    
    public function contact(){
        
        if($_SERVER['REQUEST_METHOD'] != 'POST') show_404 ();
        
        $msg = $this->input->post('message');
        $email = $this->input->post('email');
        $name = $this->input->post('name');
        
        //ini_set('SMTP', 'smtp.menara.ma.');
        $this->load->library('email');
        $this->email->from('contact@reputation');
        $this->email->to($email);
        $this->email->message($msg);
        $this->email->subject('');
        $this->email->send();
        
        echo $this->email->print_debugger();
    }
}
