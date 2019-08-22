<?php
   session_start();
    $userId   = $_SESSION['userid'];
	$userName = $_SESSION['userName'];
	$resultEmail = $_SESSION['resultEmail'];
	$user_type = $_SESSION['user_type'];
	$adminStatus = $_SESSION['adminStatus'];
	if(isset($userId) && isset($adminStatus) && $user_type=="1"){
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>spsbrands.com</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="description" content="Developed By M Abdur Rokib Promy">
        <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
        <!-- bootstra\p 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <!-- Theme style -->
        <link href="css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <div class="wrapper row-offcanvas row-offcanvas-left">
              <!-- Main content -->
                <section class="content">
                    <div class="row">
                       <div class="col-lg-3">
                       </div>
                      <div class="col-lg-6">
                          <section class="panel">
                              <header class="panel-heading">
                                  Login
                              </header>
                              <div class="panel-body">
                                  <form class="form-horizontal" role="form">
                                  <label for="username" class="login_result" id="login_result"></label>
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Email</label>
                                          <div class="col-lg-10">
                                              <input type="email" class="form-control" id="username" placeholder="Email">
                                             
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Password</label>
                                          <div class="col-lg-10">
                                              <input type="password" class="form-control" id="password" placeholder="Password">
                                             
                                          </div>
                                      </div>
                                     
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button type="submit" class="btn btn-danger" name="login" id="login">Sign in</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </section>
                         
                      </div>
                      <div class="col-lg-3">
                       </div>
                    </div><!--row1-->

                </section><!-- /.content -->
           
            
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Director App -->
        <script type="text/javascript" src="js/jquery.validate.js" language="javascript"></script>	
        <script type="text/javascript" src="js/login.js"></script>
    </body>
</html>
