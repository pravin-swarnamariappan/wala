
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
							<h2><strong><a href="index.php">WALA STORE</a></strong></h2>
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
								<?php
								if(isset($_SESSION['user_id'])){
									?>
										<li><a href="logout.php">Log Out</a></li>
									<?php
							    }else{
							    	?>
							    		<li><a href="login.php">Login / Sign Up</a></li>
							    	<?php
							    }
								?>
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
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">All Products</h2>

						<?php
							if (isset($_GET['catid'])) {
								$catid = $_GET['catid'];
								$result = $con->query("SELECT  p.id, p.product, p.description, p.price, p.imgurl, c.title FROM products AS p JOIN category AS c where p.category_id = c.id AND p.category_id  = '$catid'");
							} elseif(isset($_GET['filter'])) {
								$filter = $_GET['filter'];
								$result = $con->query("SELECT  p.id, p.product, p.description, p.price, p.imgurl, c.title FROM products AS p JOIN category AS c where p.category_id = c.id AND p.product LIKE '%$filter%'");
							} else {
								$result = $con->query('SELECT  p.id, p.product, p.description, p.price, p.imgurl, c.title FROM products AS p JOIN category AS c where p.category_id = c.id');
							}
							while($row = mysqli_fetch_array($result)) {?>
								<ul class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<a href="#" rel="bookmark" title=""><img src="img/products/<?php echo $row['imgurl']; ?>" alt="" title="" width="150" height="150" /></a>

												<h2><a href="#" rel="bookmark" title=""><?php echo $row['product'];?> </a></h2>
												<h2>Ksh. <?php echo $row['price'];?></h2>
												<p>Category: <?php echo $row['title'];?></p>

												<a href="product-details.php?id=<?php echo $row['id']?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View Details</a>
											</div>
										</div>
									</div>
								</ul>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>


<script src="js/jquery.js"></script>
<script src="js/main.js"></script>
<script src="js/script.js"></script>

</body>
</php>
