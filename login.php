<?php
require_once('api/db.php');
session_start();
$LOGIN_ERROR = false;

if (isset($_POST['login']) && $_POST['login'] == true){

	$email = mysqli_real_escape_string($con, $_POST['email']);
	$pass  = mysqli_real_escape_string($con, $_POST['password']);
    $pass  = md5($_POST['password']);

	$stmt = "SELECT * FROM users WHERE email='".$email."' AND password='".$pass."'";
	$exc_stmt = mysqli_query($con , $stmt);
	$rez_stmt = mysqli_fetch_assoc($exc_stmt);

	if ($rez_stmt) {
		//SET THE SESSION FOR LOGGED IN USER
        $name = ucfirst($rez_stmt['first_name']).' '.ucfirst($rez_stmt['last_name']);
        $admin = 0;
        if($rez_stmt['admin'] == 1){
            $admin = 1;
        }
		$_SESSION['user'] = [ 'id' => $rez_stmt['id'] , 'name' => $name  , 'admin' => $admin]; 
        header('Location:income.php');

	}else{
        $LOGIN_ERROR = true;
	}

}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="assets/js/plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/js/plugins/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/js/plugins/ionicons-2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/AdminLTE.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form  method="POST">

     <?php if($LOGIN_ERROR) { echo '<span class="text-danger text-center"> Wrong email/password combination</span>'; } ?>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" value='<?php if( isset($email) ) echo $email; ?>' placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password"  name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <div class="col-xs-4">
          <button type="submit" name='login' value='true' class="btn btn-primary btn-block btn-flat">Log In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="assets/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/js/plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>
