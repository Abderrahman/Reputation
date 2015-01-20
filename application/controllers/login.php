<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('util');
        $this->util->cache();
    }

    function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('/dashboard');
        } else {
            $this->show_login(false);
        }
    }

    function show_login($show_error = false) {

        if ($this->session->userdata('logged_in')) {
            redirect('/dashboard');
        }

        $data['error'] = $show_error;

        $this->load->helper('form');
        $this->load->view('login/login', $data);
    }

    function login_user() {
        // Create an instance of the client model
        $this->load->model('client');

        // Grab the email and password from the form POST
        $email = $this->input->post('login');
        $pass = $this->input->post('password');

        //Ensure values exist for email and pass, and validate the user's credentials
        if ($email && $pass && $this->client->validate_user($email, $pass)) {
            // If the user is valid, redirect to the main view
            redirect('/dashboard');
        } else {
            // Otherwise show the login screen with an error message.
            $this->show_login(true);
        }
    }

    function forgot_password() {
        $this->show_forgot(false);
    }

    function show_forgot($show_error = false) {

        $data['error'] = $show_error;

        $this->load->helper('form');
        $this->load->view('login/forgot_password', $data);
    }

    function forgot() {

        // Create an instance of the client model
        $this->load->model('client');

        // Grab the email from form post
        $email = $this->input->post('email');

        if ($email && $this->client->email_exists($email)) {
            // send the reset email and then redirect to password_sent page

            $slug = md5($this->client->id . $this->client->email . date('Ymd') . 'yeoman');

            $this->load->library('email');

            ini_set('SMTP', 'smtp.menara.ma.');
            $this->email->from('noreply@reputation.com', 'Reputation App');
            $this->email->to($email);
            $this->email->subject('Please reset your password');

            $this->email->message('To reset your password please click the link below and follow the instructions:
' . '<a href="' . site_url('Login/reset/' . $this->client->id . '/' . $slug) . '">link</a>' . '

If you did not request to reset your password then please just ignore this email and no changes will occur.

Note: This reset code will expire after ' . date('j M Y') . '.');

            $b = $this->email->send();
            echo 'sent: ' . $b . ', link: ' . '<a href="' . site_url('Login/reset/' . $this->client->id . '/' . $slug) . '">link</a>';
            //redirect('Login/password_sent');
        } else {
            $this->show_forgot(true);
        }
    }
    
    private function show_reset($show_error = false) {

        $data['error'] = $show_error;

        $this->load->helper('form');
        $this->load->view('login/reset_password',$data);
    }

    
    // Form action 
    function reset() {

        //if ($this->session->userdata('logged_in')) redirect('/dashboard');
        
        $password = $this->input->post('password');
        $password_confirmation = $this->input->post('password_confirmation');
        
        if($password && $password_confirmation){
            
            if($password !== $password_confirmation) { 
                $this->show_reset(true); 
                return;
            }

            $user_id = $this->uri->segment(3);
            if (!$user_id) show_error('Invalid reset code.');
            $hash = $this->uri->segment(4);
            if (!$hash) show_error('Invalid reset code.');

            $this->load->model('client');
            
            $user = $this->client->get($user_id);
            if (!$user) show_error('Invalid reset code.');

            $slug = md5($user->id . $user->email . date('Ymd') . 'yeoman');
            if ($hash != $slug) show_error('Invalid reset code.');

            $this->client->reset_password($user->id, $password);
            //$data['success'] = true;

            redirect('Login');
        } else{
            
            $this->show_reset(false);
        }
    }

    function password_sent() {
        $this->load->view('login/password_sent');
    }

    function logout_user() {
        $this->session->sess_destroy();
        redirect('Home');
    }

}
