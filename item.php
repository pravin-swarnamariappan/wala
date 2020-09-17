
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include 'database/dbconnect.php';
    $id = $_GET['id'];
    $p = isset($_GET['p']) ? $_GET['p'] : null;
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
                        
                        <?php  
                            $q = "SELECT * FROM orders where id=$id";
                            $result = $con->query($q);
                            while($row = mysqli_fetch_array($result)): ?>
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">ORDER INFORMATION</h3>
                                
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    <tr>
                                        <td class="text-right"><strong>Customer :</strong></td>
                                        <td class="text-info"><strong><?php echo $row['name'];?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><strong>Contact :</strong></td>
                                        <td class="text-info"><strong><?php echo $row['contact'];?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><strong>Address :</strong></td>
                                        <td class="text-info"><strong><?php echo $row['address'];?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><strong>Email :</strong></td>
                                        <td class="text-info"><strong><?php echo $row['email'];?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><strong>Date Ordered :</strong></td>
                                        <td class="text-info"><strong><?php echo $row['dateordered'];?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><strong>Amount :</strong></td>
                                        <td class="text-danger"><strong> Kshs. <?php echo $row['amount'];?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><strong>Item(s) :</strong></td>
                                        <td class="text-primary"><strong><?php echo $row['item'];?></strong></td>
                                    </tr>
                                    <tr>
                                    <?php if($p == 'unconfirmed'){ ?>
                                        <td class="text-right" colspan="2"><a href="order.php?p=deliver&&id=<?php echo $row['id']; ?>" class="btn btn-warning">Deliver</a></td>
                                    <?php }else if($p == 'delivered'){?>
                                        <td class="text-right" colspan="2"><a href="order.php?p=paid&&id=<?php echo $row['id']; ?>" class="btn btn-warning">Paid</a></td>
                                    <?php } ?>
                                        
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                    <?php endwhile; ?>
                </div>
            </div>
        </section>

</body>
</php>