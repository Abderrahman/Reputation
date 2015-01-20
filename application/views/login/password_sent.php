<?php $this->load->view('login/header') ?>

<div class="container">

    <div class="row">
        <div class="span5 offset3 well">

            <legend>Password reset comfirmation sent!</legend>
            <p>We’ve sent you an email containing a temporary link that will allow you to reset your password for the next 24 hours.</p>
             
            <p>Please check your spam folder if the email doesn’t appear within a few minutes. </p>

            <a href="<?= site_url('Login/show_login') ?>" class="btn btn-info btn-block">Return to sign in</a>
        </div>
    </div>
</div>

<?php $this->load->view('login/footer') ?>