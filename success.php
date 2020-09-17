
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
	include 'database/dbconnect.php';
    session_start();
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
								<li><a href="login.php">Login / Register</a></li>
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
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
                        <div class="list-group">
							<?php
								$result = $con->query('SELECT  * FROM category');
								while($row = mysqli_fetch_array($result)) {
									echo '<a href="index.php?catid=' . $row["id"] . '" class="list-group-item">' . $row['title'] . '</a>';            
								}
							?>                                                 
                        </div> 
                        <!--/category-products-->
                    </div>
                </div>				
                
				<div class="col-sm-9 padding-right">
					<div class="alert alert-success">
					   <h3 class="text-center"><i class="fa fa-check-circle fa-lg"></i> Your order has been submitted! Thank you for Shopping!</h3>
                    </div>
				</div>
			</div>
		</div>
		</div>
	</section>
					
</body>
</php>