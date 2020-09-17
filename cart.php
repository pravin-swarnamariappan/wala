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

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
                    <table class="table table-bordered table-responsive">
                        <thead class="bg-primary">
                            <th>Item</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th></th>
                        </thead>
                        <tbody>
                        <?php $total = 0;

                        if(isset($_SESSION['cart'])){ ?>
                            <?php foreach($_SESSION['cart'] as $row): ?>
                                <?php if($row['qty'] != 0): ?>
                                <tr>
                                    <td class="text-center"><strong><?php echo $row['product'];?></strong></td>
                                    <td class="text-center">Kshs. <?php echo $row['price'];?></td>
                                    <td class="text-center">
                                        <form action="database/data.php?q=updatecart&id=<?php echo $row['proID'];?>" method="POST">
                                        <input type="number" name="qty" value="<?php echo $row['qty'];?>" min="0" style="width:50px;"/>
                                        <button type="submit" class="btn btn-info">Update</button>
                                        </form>
                                    </td>
                                    <?php $itotal = $row['price'] * $row['qty']; ?>
                                    <td class="text-center"><font class="itotal">Kshs. <?php echo $itotal; ?></font></td>
                                    <td class="text-center"><a href="database/data.php?q=removefromcart&id=<?php echo $row['proID'];?>"><i class="fa fa-times-circle fa-lg text-danger removeproduct"></i></a></td>
                                </tr>

                                <?php $total = $total + $itotal;
                                $_SESSION['total'] = $total;?>
                                <?php endif;?>
                            <?php endforeach; ?>
                                <?php $_SESSION['totalprice'] = isset($_SESSION['totalprice']) ? $_SESSION['totalprice'] : $total; ?>
                                <?php $vat = $total * 0.16; ?>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Sub Total</strong></td>
                                    <td colspan="2" class="text-primary">Kshs. <?php echo number_format($total - $vat,2) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>VAT (16%)</strong></td>
                                    <td colspan="2" class="text-danger">Kshs. <?php echo number_format($vat,2) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>TOTAL</strong></td>
                                    <td colspan="2" class="text-danger"><strong>Kshs. <?php echo number_format($total,2); ?></strong></td>
                                </tr>

                        </tbody>
                    </table>
                    <div class="pull-right">
                        <a href="database/data.php?q=emptycart" class="btn btn-danger btn-lg">Empty Cart!!!</a>
                        <a href="#" class="btn btn-success btn-lg" data-toggle="modal" data-target="#checkout_modal">Check Out</a>
                    </div>
                    <?php }else{ ?>
                            <tr><td colspan="5" class="text-center alert alert-danger"><strong>*** Your Cart is Empty ***</strong></td></tr>
                            </tbody>
                        </table>
                    <?php } ?>
				</div>
			</div>
		</div>
	</section><!--/form-->

<!-- Modal -->
<div class="modal fade" id="checkout_modal" role="dialog">
  <?php
    if(isset($_SESSION['user_id']) != ''){
      $query = $con->query('SELECT * FROM users WHERE id="'.$_SESSION['user_id'].'"');
      $row = mysqli_fetch_array($query);

      $full_name = $row['full_name'];
      $email = $row['email'];
      $phone = $row['phone'];
      
      include 'includes/inc-logged-in-modal.php';
    }else{
      include 'includes/inc-logged-out-modal.php';
    }
  ?>

</div>

<script type="text/javascript">
    // get list of radio buttons with name 'size'
    var sz = document.forms['demoForm'].elements['payment'];

    // loop through list
    for (var i=0, len=sz.length; i<len; i++) {
        sz[i].onclick = function() { // assign onclick handler function to each
            // put clicked radio button's value in total field
            if(this.value == "mpesa"){
                document.getElementById('divmpesa').style.display="";
            }else{
                document.getElementById('divmpesa').style.display="none";
            }
        };
    }
</script>

<script src="js/jquery.js"></script>
<script src="js/application.js"></script>
<script src="js/main.js"></script>
<script src="js/script.js"></script>

</body>
</php>
