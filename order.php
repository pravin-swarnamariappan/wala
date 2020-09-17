
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
	include 'database/dbconnect.php';
    session_start();
    $error = "";
    $success = "";

    $p = isset($_GET['p']) ? $_GET['p'] : null;
    if($p == 'deliver'){
        $date = date('m/d/y h:i:s A');
        $id = $_GET['id'];
        $q = "UPDATE orders set datedelivered='$date', status='delivered' where id=$id";
        if ($con->query($q) === TRUE) {
            $success = "Product Delivered successfully";
        } else {
            $error = "Error: " . $sql . "<br>" . $con->error;
        }
    }else if($p == 'paid'){
        $id = $_GET['id'];
        $date = date('m/d/y h:i:s A');
        $q = "UPDATE orders set datedelivered='$date', status='confirmed' where id=$id";
        if ($con->query($q) === TRUE) {
            $success = "Payment Paid";
        } else {
            $error = "Error: " . $sql . "<br>" . $con->error;
        }  
    }
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
                    <?php
                        if($error != ""){
                            echo '<div class="danger">' . $error . '</div>';
                        }elseif($success != ""){
                            echo '<div class="success">' . $success . '</div>';
                        }
                    ?>
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Orders</h2>                                            					
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#data1" role="tab" data-toggle="tab">Undelivered Orders</a></li>
                        <li><a href="#data2" role="tab" data-toggle="tab">Delivered Orders</a></li>
                        <li><a href="#data3" role="tab" data-toggle="tab">Paid Orders</a></li>
                        </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="data1">
                            <table class="table table-bordered">
                                <thead class="bg-primary">
                                    <th>Date Ordered</th>
                                    <th>Customer</th>
                                    <th>Item</th>
                                    <th>Action</th>
                                </thead>
                                <?php  
                                    $q = "SELECT * FROM orders where status='unconfirmed' order by dateordered desc";
                                    $unpaid = $con->query($q);
                                    while($row = mysqli_fetch_array($unpaid)){ ?>
                                    <tr>
                                        <td class="text-center"><?php echo $row['dateordered']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['item']; ?></td>
                                        <td class="text-center"><a href="item.php?id=<?php echo $row['id']?>&&p=unconfirmed" target="_blank"><i class="fa fa-external-link"></i> View Item</a></td>
                                        <!--<td class="text-center"><a href="order.php?p=deliver&&id=<?php echo $row['id']; ?>" class="btn btn-warning">Deliver</a></td>-->
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div class="tab-pane" id="data2">
                            <table class="table table-bordered">
                                <thead class="bg-primary">
                                    <th>Date Delivered</th>
                                    <th>Customer</th>
                                    <th>Item</th>
                                    <th>Action</th>
                                </thead>
                                <?php 
                                    $q = "SELECT * FROM orders where status='delivered' order by datedelivered desc";
                                    $delivered = $con->query($q);
                                    while($row = mysqli_fetch_array($delivered)){ ?>
                                    <tr>
                                        <td class="text-center"><?php echo $row['datedelivered']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td class="text-center"><a href="item.php?id=<?php echo $row['id']?>&&p=delivered" target="_blank"><i class="fa fa-external-link"></i> View Item</a></td>
                                        <td class="text-center"><a href="order.php?p=paid&&id=<?php echo $row['id']; ?>" class="btn btn-warning">Paid</a></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div class="tab-pane" id="data3">
                            <table class="table table-bordered">
                                <thead class="bg-primary">
                                    <th>Date Paid</th>
                                    <th>Customer</th>
                                    <th>Item</th>
                                </thead>
                                <?php 
                                    $q = "SELECT * FROM orders where status='confirmed' order by datedelivered desc";
                                    $paid = $con->query($q);
                                    while($row = mysqli_fetch_array($paid)){ ?>
                                    <tr>
                                        <td class="text-center"><?php echo $row['datedelivered']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td class="text-center"><a href="item.php?id=<?php echo $row['id']?>" target="_blank"><i class="fa fa-external-link"></i> View Item</a></td>                    
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script src="js/jquery.js"></script>
<script src="js/application.js"></script>
<script src="js/main.js"></script>
<script src="js/script.js"></script>   
</body>


</php>