<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign Up</title>
   
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

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>SFC WEB</b></a>
            <small></small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_up" method="POST" action="<?php echo site_url('login_user/cekregister'); ?>">
                    <div class="msg">Register a new membership</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="user" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="pass" minlength="6" placeholder="Password" required>
                        </div>
                    </div>
                    <!-- <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirm Password" required>
                        </div>
                    </div> -->
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <select class="form-line" name="level">
                        <option>anggota</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="<?php echo site_url('login_user/loginpage'); ?>">You already have a membership?</a>
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