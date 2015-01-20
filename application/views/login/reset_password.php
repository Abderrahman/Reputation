<?php $this->load->view('login/header') ?>

<div class="container">

    <div class="row">
        <div class="span4 offset4 well">

            <legend>Reset password</legend>

            <?php if (isset($error) && $error): ?>
                <div class="alert alert-error">
                    <a class="close" data-dismiss="alert" href="#">×</a>Password doesn't match the confirmation.
                </div>
            <?php endif; ?>

            <?php $c = current_url(); echo form_open("$c"); ?>

            <input type="password" class="span4" name="password" placeholder="Password">
            <input type="password" class="span4" name="password_confirmation" placeholder="Confirm password">
            
            <button type="submit" name="submit" class="btn btn-info btn-block">Change password</button>

            </form>
        </div>
    </div>
</div>

<?php $this->load->view('login/footer') ?>