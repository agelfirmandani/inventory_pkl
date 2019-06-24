<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In</title>
    
    <!-- Google Fonts -->
    <link href="<?php echo base_url('assets/fonts/google.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/icon.css');?>" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.css');?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url('assets/plugins/node-waves/waves.css');?>" rel="stylesheet">
    
   
    <!-- Animation Css -->
     <link href="<?php echo base_url('assets/plugins/animate-css/animate.css');?>" rel="stylesheet">
   

    <!-- Custom Css -->
   <link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet">
    
    
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>Inventory Gudang </b></a>
            
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" action="<?php echo site_url('login_user/cek_login'); ?>" method="POST">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="<?php echo site_url('login_user/register'); ?>">Register Now!</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <!-- Jquery Core Js -->
    <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js');?>"  crossorigin="anonymous"></script>
    
    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.js');?>"  crossorigin="anonymous"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url('assets/plugins/node-waves/waves.js');?>"  crossorigin="anonymous"></script>
     <!-- Validation Plugin Js -->
    <script src="<?php echo base_url('assets/plugins/jquery-validation/jquery.validate.js');?>"  crossorigin="anonymous"></script>

    
    <!-- Custom Js -->
    <script src="<?php echo base_url('assets/js/admin.js');?>"  crossorigin="anonymous"></script>
    <script src="<?php echo base_url('assets/js/pages/examples/sign-in.js');?>"  crossorigin="anonymous"></script>

</body>

</html>