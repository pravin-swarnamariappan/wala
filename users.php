
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
							<h2 class="title text-center">List of users</h2>

						<table cellpadding="1" cellspacing="1" id="resultTable" class="table table-bordered">
							<thead class="bg-primary">
								<tr>
									<th> Full Name </th>
									<th> Email </th>
									<th> Phone </th>
									<th> Role </th>
									<th> Action </th>
								</tr>
							</thead>
							<tbody>
								 <?php
                                    include 'database/dbconnect.php';
                                    $result = $con->query('SELECT * FROM users');
                                    while($row = mysqli_fetch_array($result)) {
                                        echo "<tr><td>" . $row['full_name'] . "</td>";
										echo "<td>" . $row['email'] . "</td>";
										echo "<td>" . $row['phone'] . "</td>";
                                        echo "<td>" . $row['role'] . "</td>";
										echo "<td><a href='edituser.php?id=" . $row['id'] . "'>Edit</a></td>";
                                    }
                                    $result->close();
                                ?>
							</tbody>
						</table>
            <a class="btn btn-primary" href="users-PDF.php">Generate PDF</a>
					</div>
				</div>
			</div>
		</div>
    </section>

</body>


</php>
