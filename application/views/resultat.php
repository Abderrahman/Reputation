<div class="row">
    <div class="col-lg-12">

        <?php foreach ($r as $res) { ?>
            <div class="row"><br><br>
                <div class="col-lg-7 col-md-offset-1">
                    <b>Result <?= $res['n'] ?></b><br>
                    <a href="<?= $res['link'] ?>"><?= $res['htmlTitle'] ?></a><br>
                    <?= $res['htmlFormattedUrl'] ?><br>
                    <?= $res['htmlSnippet'] ?>
                </div>
                <div class="col-lg-1 radio">
                    <label><input type="radio" name="avis<?= $res['n'] ?>" value="Positive"> Positive</label><br>
                    <label><input type="radio" name="avis<?= $res['n'] ?>" value="Neutre"> Neutre</label><br>
                    <label><input type="radio" name="avis<?= $res['n'] ?>" value="Negative"> Negative</label>
                </div>
            </div>
        <?php } if (!$this->session->userdata('logged_in')) { ?>
            <p style="margin:20px 0px;">
                <input type="submit" data-toggle="modal" data-target="#myModal" value="Afficher score" class="btn btn-primary col-md-offset-1" id="valider"/>
            </p>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Veuillez entrer votre adresse e-mail pour voir votre score</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="post" id="form">
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first_name">First Name *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="first_name" name="first_name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last_name">Last Name *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="last_name" name="last_name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="inputEmail">Email *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="inputEmail" name="reg_email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="inputPassword">Password *</label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" id="inputPassword" name="reg_password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" value="Envoyer resultat" class="btn btn-custom">Envoyer resultat</button>
                                    </div>
                                </div>
                            <div class="alert alert-success col-md-12 col-sm-12" role="alert" id="label" style="display:none;">You are successfully registered.</div>
                            <div class="alert alert-danger col-md-12 col-sm-12" role="alert" id="error" style="display:none;">A problem has been occurred while submitting your data.</div>
                            </form>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>

            <form class="form-horizontal" method="post" id="form2">
                <p style="margin:20px 0px;">
                    <input type="submit" value="Ajouter" class="btn btn-primary col-md-offset-1" id="add"/>
                </p>
            </form>
        <?php } ?>
    </div>
</div>  <!-- /.row -->