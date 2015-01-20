<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Reputation</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="icon" href="<?= base_url() ?>favicon.ico" type="image/ico">
         <!-- Bootstrap -->
        <link href="<?= base_url() ?>public/css/bootstrap.min.css" rel="stylesheet">
        <!--[if lt IE 9]>
                <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="<?= base_url() ?>public/css/jquery.circliful.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>public/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>public/css/styles.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= base_url() ?>">Reputation</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li <?php if ($page == 'Home') {echo 'class="active"';} ?>>
                            <a href="<?= base_url() ?>Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                        <li <?php if ($page == 'Dashboard') {echo 'class="active"';} ?>>
                            <a href="<?= base_url() ?>Dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                        <li <?php if ($page == 'Evolution') {echo 'class="active"';} ?>>
                            <a href="<?= base_url() ?>Evolution"><span class="glyphicon glyphicon-stats"></span> Evolution</a></li>
                        <li <?php if ($page == 'Contact') {echo 'class="active"';} ?>>
                            <a href="<?= base_url() ?>Contact"><span class="glyphicon glyphicon-info-sign"></span> Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?= base_url() ?>About">About</a></li>
                        
                    <?php if($this->session->userdata('logged_in')){ ?>    
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> User<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url() ?>Login/logout_user"><span class="glyphicon glyphicon-log-out"></span> Sign out</a></li>
                            </ul>
                        </li>
                    <?php } else{ ?>
                        <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sign in <b class="caret"></b></a>
                     <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                        <li>
                           <div class="row">
                              <div class="col-md-12">
                                  <form class="form" role="form" method="post" action="<?= base_url('login/login_user') ?>" accept-charset="UTF-8" id="login-nav">
                                    <div class="form-group">
                                       <label class="sr-only" for="Email2">Email address</label>
                                       <input type="email" class="form-control" id="Email2" name="login" placeholder="Email Address" required>
                                    </div>
                                    <div class="form-group">
                                       <label class="sr-only" for="Password2">Password</label>
                                       <input type="password" class="form-control" id="Password2" name="password" placeholder="Password" required>
                                    </div>
                                      <p><a href="<?= base_url() ?>Login/forgot_password">Forgot your password?</a></p>
                                    <div class="form-group">
                                       <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </li>
                        <!--<li class="divider"></li>
                        <li>
                           <input class="btn btn-primary btn-block" type="button" id="sign-in-google" value="Sign In with Google">
                           <input class="btn btn-primary btn-block" type="button" id="sign-in-twitter" value="Sign In with Twitter">
                        </li>-->
                     </ul>
                  </li>
                    <?php } ?>
                    </ul>

                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">