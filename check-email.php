<?php

	include 'database/dbconnect.php';

	if ( isset($_REQUEST['email']) && !empty($_REQUEST['email']) ) {

		$email = trim($_REQUEST['email']);
		$email = strip_tags($email);

    $query = $con->query('SELECT email FROM users WHERE email="'.$email.'"');

    $row_cnt = $query->num_rows;


    if($row_cnt == 1){
			echo 'false'; // email already taken
		} else {
			echo 'true';
		}
	}
