
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();

    include 'database/dbconnect.php';

    $query = $con->query('SELECT * FROM users WHERE id="'.$_SESSION['user_id'].'"');
    $row = mysqli_fetch_array($query);

    $full_name = $row['full_name'];

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
								<h2><a href="#"> Online Store Administrator </a></h2>
                				<h4>You are logged in as <?php   echo $full_name; ?></h4>
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
							<h2 class="title text-center">All Products</h2>

						<table cellpadding="1" cellspacing="1" id="resultTable" class="table table-bordered">
							<thead class="bg-primary">
								<tr>
									<th> The Product </th>
									<th> The Desciption </th>
									<th> The Category </th>
									<th> The Price </th>
									<th width="15%"> Action </th>
								</tr>
							</thead>
							<tbody>
								 <?php
                    include 'database/dbconnect.php';
                    $result = $con->query('SELECT  p.id, p.product, p.description, p.price, c.title FROM products AS p JOIN category AS c where p.category_id = c.id');
                    while($row = mysqli_fetch_array($result)) {
                        echo "<tr><td>" . $row['product'] . "</td>";
										    echo "<td>" . $row['description'] . "</td>";
										    echo "<td>" . $row['title'] . "</td>";
                        echo "<td> Kshs. " . $row['price'] . "</td>";
                        echo '<td><a href="editproduct.php?id=' . $row['id'] . '"><small>Edit</small></a> | <a href="deleteproduct.php?id=' . $row['id'] . '"><small>Delete</small></a></td></tr>';
                    }
                    $result->close();
                ?>
							</tbody> 
						</table>
						<a class="btn btn-primary" href="addproduct.php">Add Product</a>
						<a class="btn btn-primary" href="generateproducts.php">Generate PDF</a>
					</div>
				</div>
			</div>
		</div>
    </section>

</body>


</php>
