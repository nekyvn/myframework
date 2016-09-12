<!-- light-blue - v3.1.0 - 2014-12-06 -->

<!DOCTYPE html>
<html>

<!-- Tieu Long Lanh Kute -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <title>CTCart</title>

        <link href="<?=base_url('library/admin/css/application.min.css')?>" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">
    <script>
        /* yeah we need this empty stylesheet here. It's cool chrome & chromium fix
           chrome fix https://code.google.com/p/chromium/issues/detail?id=167083
                      https://code.google.com/p/chromium/issues/detail?id=332189
        */
    </script>
</head>
<body class="background-dark">
        <div class="single-widget-container">
            <section class="widget login-widget">
                <header class="text-align-center">
                    <h4>Login to your account</h4>
                </header>
                <div class="body">
                    <form class="no-margin"
                          action="<?=base_url('admin/login')?>" method="get">
                        <fieldset>
                            <div class="form-group">
                                <label for="email">Username</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input id="username" type="username" class="form-control input-lg input-transparent"
                                           placeholder="Your Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>

                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input id="password" type="password" class="form-control input-lg input-transparent"
                                           placeholder="Your Password">
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-block btn-lg btn-danger">
                                <span class="small-circle"><i class="fa fa-caret-right"></i></span>
                                <small>Sign In</small>
                            </button>
                            <a class="forgot" href="#">Forgot Username or Password?</a>
                        </div>
                    </form>
                </div>
                <footer>
                    <?php if(isset($error)):?>
                        <div class="alert-login ">
                            <a href="index.html"><span><i class="fa fa-thumbs-down fa-lg"></i> Login Failed</span></a>
                        </div>
                    <?php endif;?>
                </footer>
            </section>
        </div>
<!-- common libraries. required for every page-->
<script src="<?=base_url('library/admin/js/jquery/jquery.min.js') ?>"></script>
<script src="<?=base_url('library/admin/js/bootstrap/bootstrap.js')?>"></script>



</body>

<!-- Tieu Long Lanh Kute -->
</html>