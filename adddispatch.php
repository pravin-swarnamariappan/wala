<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $error = "";
    $success = "";

    include 'database/dbconnect.php';

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $contact = $_POST['contact'];
        $type = $_POST['type'];

        $sql = "INSERT INTO dispatch (name, contacts, type, description) VALUES ('$name', '$contact','$type', '$description')";
        if ($con->query($sql) === TRUE) {
            $success = "Dispatch Added successfully";
        } else {
            $error = "Error: " . $sql . "<br>" . $con->error;
        }

        $con->close();
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
                            <?php include('mng_menu.php');?> 
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

                <h2 class="title text-center">Add New Category</h2>

                <form action="#" method="post">
                    Name<br />
                    <input name="name" type="text" required /><br />
                    Contact<br />
                    <input name="contact" type="text" /><br />
                    Type<br />
                    <select name="type">
                        <option>Rider</option>
                        <option>Driver (Dispatch)</option>
                    </select><br />
                    Description<br />
                    <input name="description" type="text" /><br />
                
                   <br /> <input type="submit" name="submit" class="btn btn-primary" value="Save" />
                

                </form>
			</div>
		</div>
 </section>    
    
</body>


</php>
