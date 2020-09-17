
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>

<!DOCTYPE php>
<php lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Online Store | Administrator</title>
    <link href="css/style.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
</head><!--/head-->

<body>
<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<h2><a href="#"> Online Store Administrator</a></h2>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div><!--/header_top-->

	</header><!--/header-->
    <br />
    <section>
		<div class="container">
			<div class="row">
                <div class="col-sm-3">
					<div class="left-sidebar">
						<h2>cPanel</h2>
                        <div class="list-group">
                            <a href="admin.php" class="list-group-item">Products </a>
                            <a href="admincategory.php" class="list-group-item">Category </a>
                            <a href="order.php" class="list-group-item">Orders </a>
							<a href="users.php" class="list-group-item">Users </a>
                        </div>
                        <div class="list-group">
                            <a href="logout.php" class="list-group-item active">Logout</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Stock</h2>

                       <hr />
                        <table class="table table-bordered">
                            <thead class="bg-primary">
                                <th>Product</th>
                                <th>Quantity</th>
                                <!--<th colspan="2" width="20%">Action</th>-->
                            </thead>
                            <tbody>
                                <?php
                                    include 'database/dbconnect.php';
                                    $result = $con->query("SELECT * FROM products");
                                    while($row = mysqli_fetch_array($result)) {
                                        echo "<tr><td>" . $row['product'] . "</td>";
                                        echo "<td>" . $row['qty_in_stock'] . "</td>";
                                        //echo '<td><a href="#"><small>Edit</small></a> | <a href="#"><small>Remove</small></a></td></tr>';
                                    }
                                    $result->close();
                                ?>
                            </tbody>
                        </table>
                        <a class="btn btn-primary" href="addcategory.php">Add Category</a>
                </div>
            </div>
        </div>

    </section>



</body>


</php>
