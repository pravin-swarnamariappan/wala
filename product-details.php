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
	<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 200px;
      }
    </style>

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
				
                <?php
					$pid = $_GET['id'];
					$result = $con->query("SELECT  p.id, p.product, p.description, p.price, p.imgurl, contact_info, c.title FROM products AS p JOIN category AS c where p.category_id = c.id AND p.id = '$pid'");
					while($row = mysqli_fetch_array($result)) {?>
						<div class="col-sm-9 padding-right">
							<div class="product-details"><!--product-details-->
								<div class="col-sm-5">
									<div class="view-product">
									
								
									<img src="img/products/<?php echo $row['imgurl'];?>" />	
										
									</div>
								</div>
								<div class="col-sm-7">
									<div class="product-information"><!--/product-information-->
									<h2 class="product"><?php echo $row['product'];?></h2>
										<p>Product ID: <span class="pid"><?php echo $row['id'];?></span></p>
										<p>Category: <?php echo $row['title'];?></p>
						
										<p>Price: Kshs. <span class="price"><?php echo $row['price'];?></span></p>

										<br>									
								
										<p><b>Description: </b><?php echo $row['description'];?></p>
										<p><b>Delivery Location</b> 
											<pre style="margin-left:40"><?php echo $row['contact_info'];?></pre>
											<div id="map" style="margin-left:40"></div>
											<script>

											function initMap() {
												var myLatLng = {lat: -1.28333, lng: 36.81667};

												var map = new google.maps.Map(document.getElementById('map'), {
												zoom: 12,
												center: myLatLng
												});

												var marker = new google.maps.Marker({
												position: myLatLng,
												map: map,
												animation: google.maps.Animation.BOUNCE,
												title: 'Nairobi CBD'
												});
											}
											</script>
											<script async defer
											src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPW0gQ09qnl_nalJlKPGFsNd3Mqvuoirc&callback=initMap">
											</script>
										</p>
										<br><br>
										<p class="info hidethis" style="color:red;"><strong>Product Added to Cart!</strong></p>
										<a class="btn btn-primary add-to-cart" id="add-to-cart" href="cart.php">Add to Cart</a>
										
									</div><!--/product-information-->
								</div>
							</div><!--/product-details-->
						</div>
					<?php }?>
			</div>
		</div>
		</div>
	</section>

<script src="js/jquery.js"></script>
<script src="js/main.js"></script>
<script src="js/script.js"></script>
    

</body>
</php>