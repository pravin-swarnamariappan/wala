
<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Online Store</title>
	<link href="css/main.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

</head>

<body>
<header id="header">

		<div class="header-middle">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="logo pull-left">
							<h2><strong><a href="index.php">Wala STORE</a></strong></h2>
              <h4>
                <?php
                  if(isset($_SESSION['user_id']) != ''){
                    $query = $con->query('SELECT * FROM users WHERE id="'.$_SESSION['user_id'].'"');
                    $row = mysqli_fetch_array($query);

                    $full_name = $row['full_name'];
                    ?>
                      Logged in as:
                    <?php
                      echo $full_name;
                  }
                ?>
              </h4>
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
								<li><a href="login.php">Login</a></li>
							</ul>
						</div>
					</div>
                    <div class="col-sm-3">
						<div class="search_box pull-right">
                            <form action="index.php" method="GET">
							     <input type="text" placeholder="Search" name="filter" />
                            </form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<section id="form">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>About Us</h2>
						<address>
	    					<p>Company Name: Krios Technology</p>
							<p>Address: Gandhi Market,Trichy</p>
							<p>Mobile: +91 6382219105</p>
							<p>Email: smpravin5@gmail.com</p>
	    				</address>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

<script src="js/jquery.js"></script>
<script src="js/main.js"></script>
<script src="js/script.js"></script>

</body>
</php>
