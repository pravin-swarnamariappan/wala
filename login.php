
<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);


		$error = "";
    $success = "";

    $error = "";
    include 'database/dbconnect.php';

    session_start();

    if(isset($_SESSION['user_id'])){
    	header("Location: index.php");
    }



?>

<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Online Store</title>
	<link href="css/main.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>

<body>
<header id="header">

		<div class="header-middle">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="logo pull-left">
							<h2><strong><a href="index.php">ONLINE STORE</a></strong></h2>
						</div>

					</div>

				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom navbar navbar-inverse"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php">Home</a></li>
								<li><a href="about.php">About Us</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="cart.php">Cart <span class="badge"></span></a></li>

								<?php
								if(isset($_SESSION['user_id'])){
									?>
										<li><a href="logout.php">Log Out</a></li>
									<?php
							    }else{
							    	?>
							    		<li><a href="login.php">Login / Register</a></li>
							    	<?php
							    }
								?>

							</ul>
						</div>
					</div>
                    <!--<div class="col-sm-3">
						<div class="search_box pull-right">
                            <form action="index.php" method="GET">
							     <input type="text" placeholder="Search" name="filter" />
                            </form>
						</div>
					</div>-->
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<?php
		if($error != ""){
			echo '<div class="danger">' . $error . '</div>';
		}elseif($success != ""){
			echo '<div class="success">' . $success . '</div>';
		}
	?>

	<section><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form">

	                <div class="error"></div>


						<h2>Login</h2>
						  <form id="login-form" action="#" method="post">
								<!-- json response will be here -->
												<div class="error-message" id="error"></div>
											<!-- json response will be here -->
											<br />
											<div class="form-group">
													<input type="text" id="email" name="email" placeholder="Email" class="form-control br-radius-zero" />
													<span class="help-block" id="check-e"></span>
											</div>
											<div class="form-group">
													<input type="password" id="password" name="password" placeholder="Password" class="form-control br-radius-zero" />
													<span class="help-block" id="check-e"></span>
											</div>
                      <button  name="btn-login" id="btn-login" type="submit" class="btn btn-default">Login</button>
                  </form>
					</div><!--/login form-->
				</div>

				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form">

	                <div class="error"></div>


						<h2>Register</h2>
						  <form action="#" method="post" id="register-form">
								<!-- json response will be here -->
					              <div id="errorDiv"></div>
					            <!-- json response will be here -->
								<div class="form-group">
										<input type="text" id="full_name" name="full_name" placeholder="Fullname" class="form-control br-radius-zero" />
										<span class="help-block" id="error"></span>
								</div>
								<div class="form-group">
										<input type="text" id="phone" name="phone" placeholder="Phone Number" class="form-control br-radius-zero" />
										<span class="help-block" id="error"></span>
								</div>
								<div class="form-group">
										<input type="text" id="email" name="email" placeholder="Email" class="form-control br-radius-zero" />
										<span class="help-block" id="error"></span>
								</div>
								<div class="form-group">
										<input type="password" id="password" name="password" placeholder="Password" class="form-control br-radius-zero" />
										<span class="help-block" id="error"></span>
								</div>
								<div class="form-group">
										<input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" class="form-control br-radius-zero" />
										<span class="help-block" id="error"></span>
								</div>
	              <button  id="btn-signup" type="submit" class="btn btn-default">Register</button>
              </form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->


</body>
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/validate-register.js"></script>
<script src="js/validate-login.js"></script>

</php>
