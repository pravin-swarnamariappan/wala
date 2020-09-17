
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
     include('database/dbconnect.php');
    $error = "";
    $success = "";
    $id = $_GET['id'];
    $result = $con->query('SELECT  * FROM users WHERE id='. $id);
    while($row = mysqli_fetch_array($result)) {
        $name = $row['full_name'];
        $phone = $row['phone'] ;    
        $email = $row['email'] ;
        $role = $row['role']   ;  
        $password = $row['password']   ;   
    } 

    if (isset($_POST['register'])) {
         $password = $_POST['password2'];
        if($_POST['password'] !=''){
             $password = sha1($_POST['password']);
        }
       
        $email = $_POST['email'];
        $full_name = $_POST['full_name']; 
		$phone = $_POST['phone']; 
        $role = $_POST['role']; 

        $sql = "UPDATE users SET full_name='$full_name', email = '$email', phone='$phone', password='$password', role='$role' WHERE id='$id'";
        if ($con->query($sql) === TRUE) {
            $success = "User Updated successfully";
        } else {
            $error = "Error: " . $con->error;
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

                    
    				<div class="col-sm-3 padding-right">
                         <?php
                            if($error != ""){
                                echo '<div class="danger">' . $error . '</div>';
                            }elseif($success != ""){
                                echo '<div class="success">' . $success . '</div>';
                            }
                        ?>

						<div class="features_items"><!--features_items-->
							<h2 class="title text-center">List of users</h2>
                            <h2>Register</h2>
                            <form action="" method="post">
                                Full Name<br />
                                <input type="text" name="full_name" value="<?php echo $name;?>" required/><br />
                                Phone Number<br />
                                <input type="text" name="phone" value="<?php echo $phone;?>" required/><br />
                                Email<br />
                                <input type="text" name="email" value="<?php echo $email;?>" required/><br />
                                Password (Leave blank if you don want to change)<br />
                                <input type="password" name="password"/>
                                <input type="hidden" name="password2" value="<?php echo $password?>" required/><br />
                                 Category<br />
                                <select name="role" class="ed">
                                    <option value="Admin" <?php if($role=='Admin'){ echo 'selected';}?>>Admin</option>
                                    <option value="Manager" <?php if($role=='Manager'){ echo 'selected';}?>>Manager</option>
                                    <option value="User" <?php if($role=='User'){ echo 'selected';}?>>User</option>
                                </select>
                                <button  type="submit" name="register" class="btn btn-default">Update</button>
                            </form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
    
</body>


</php>