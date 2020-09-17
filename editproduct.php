
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include('database/dbconnect.php');
    $error = "";
    $success = "";

    $pid = $_GET['id'];
    $result = $con->query('SELECT  * FROM products where id = ' . $pid);
    while($row = mysqli_fetch_array($result)) {
        $product = $row['product'];
        $desc = $row['description'];
        $price = $row['price'];
        $quantity = $row['qty_in_stock'];
        $cat = $row['category_id'];
        $location = $row['imgurl'];
        $contact = $row['contact_info'];
    }

    if(isset($_POST['submit'])){
        $pname=$_POST['pname'];
        $desc=$_POST['desc'];
        $price=$_POST['price'];
        $quantity = $_POST['qty'];
        $cat=$_POST['cat'];
        $contact=$_POST['contact'];

       $sql = "UPDATE products SET imgurl='$location', product='$pname', description='$desc', price='$price', qty_in_stock='$quantity', category_id='$cat', contact_info='$contact' WHERE id='$pid'";

        if ($con->query($sql) === TRUE) {
            $success = "Product updated successfully";
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

	</header><!--/header--><br />

<!--sa input that accept number only-->
<script language=Javascript>
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
   </script>

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

            <div class="col-sm-3 padding-right">

                <?php
                    if($error != ""){
                        echo '<div class="danger">' . $error . '</div>';
                    }elseif($success != ""){
                        echo '<div class="success">' . $success . '</div>';
                    }
                ?>

                <h2 class="title text-center">Edit Product</h2>

                <form action="#" method="post" enctype="multipart/form-data" name="addproduct" onsubmit="return validateForm()">
                    Product Name<br />
                    <input name="pname" value="<?php echo $product;?>" type="text" required /><br />
                    Description<br />
                        <textarea rows="2" cols="20" name="desc" class="ed"><?php echo $desc;?></textarea>
                    Contact Info<br />
                        <textarea rows="2" cols="20" name="contact" class="ed"><?php echo $contact;?></textarea>
                    Price<br />
                        <input name="price" value="<?php echo $price;?>" type="text" required onkeypress="return isNumberKey(event)" /><br />
                    Quantity<br />
                        <input name="qty" value="<?php echo $quantity;?>" type="text" required onkeypress="return isNumberKey(event)" /><br />
                    Category<br />
                    <select name="cat" class="ed">
                        <?php
                            include 'database/dbconnect.php';
                            $result = $con->query('SELECT  * FROM category');
                            while($row = mysqli_fetch_array($result)) {
                                $selected = '';
                                if($cat == $row['id']){
                                    $selected = 'selected';
                                }
                                echo '<option ' . $selected . ' value="' . $row['id'] . '">' . $row['title'] . '</option>';
                            }
                        ?>
                    </select><br />

                    <input type="submit"  name="submit" value="Save" class="btn btn-primary" />

                </form>
			</div>
		</div>
 </section>

</body>


</php>
