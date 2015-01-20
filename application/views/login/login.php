<?php $this->load->view('login/header') ?>

<div class="container">

    <div class="row">
        <div class="span4 offset4 well">

            <legend>Please Sign In</legend>

            <?php if (isset($error) && $error): ?>
                <div class="alert alert-error">
                    <a class="close" data-dismiss="alert" href="#">×</a>Incorrect Username or Password!
                </div>
            <?php endif; ?>

            <?php echo form_open('login/login_user') ?>

            <input type="text" id="email" class="span4" name="login" placeholder="Email Address">
            <input type="password" id="password" class="span4" name="password" placeholder="Password">
            
            <!--<label class="checkbox">
            <input type="checkbox" name="remember" value="1"> Remember Me
            </label>-->
            <p><a href="<?= base_url() ?>Login/forgot_password">Forgot your password?</a></p>

            <button type="submit" name="submit" class="btn btn-info btn-block">Sign in</button>

            </form>
        </div>
    </div>
</div>

<?php $this->load->view('login/footer') ?>