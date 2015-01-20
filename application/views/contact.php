<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 well">
            <form class="form-horizontal" action="Contact/contact" method="post">
                <fieldset>
                    <legend class="text-center">Contact us</legend>

                    <!-- Name input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Name</label>
                        <div class="col-md-9">
                            <input id="name" name="name" value="<?= $this->session->userdata('firstName') . ' ' . $this->session->userdata('lastName')   ?>" type="text" placeholder="Your name" class="form-control">
                        </div>
                    </div>

                    <!-- Email input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="email">Your E-mail</label>
                        <div class="col-md-9">
                            <input id="email" name="email" value="<?= $this->session->userdata('email') ?>" type="text" placeholder="Your email" class="form-control">
                        </div>
                    </div>

                    <!-- Message body -->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="message">Your message</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
                        </div>
                    </div>

                    <!-- Form actions -->
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </div>
                </fieldset>
                <!--<div class="alert alert-success col-md-12 col-sm-12" role="alert" id="label" style="display:none;">You are successfully registered.</div>
                <div class="alert alert-danger col-md-12 col-sm-12" role="alert" id="error" style="display:none;">A problem has been occurred while submitting your data.</div>-->        
            </form>
        </div>
    </div>
</div>
