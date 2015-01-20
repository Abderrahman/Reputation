<?php $this->load->view('login/header') ?>

<div class="container">

    <div class="row">
        <div class="span4 offset4 well">

            <legend>Forgot password</legend>

            <?php if (isset($error) && $error): ?>
                <div class="alert alert-error">
                    <a class="close" data-dismiss="alert" href="#">×</a>Can't find that email, sorry.
                </div>
            <?php endif; ?>

            <?php echo form_open('login/forgot') ?>

            <input type="text" id="email" class="span4" name="email" placeholder="Email Address">
            
            <button type="submit" name="submit" class="btn btn-info btn-block">Submit</button>

            </form>
        </div>
    </div>
</div>

<?php $this->load->view('login/footer') ?>