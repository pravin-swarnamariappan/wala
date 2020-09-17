<?php

	header('Content-type: application/json');

	include 'database/dbconnect.php';

	$response = array();

	if ($_POST) {

    $password = sha1($_POST['password']);
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO users (full_name, email, phone, password) VALUES ('$full_name', '$email', '$phone', '$password')";
    if ($con->query($sql) === TRUE) {
      $response['status'] = 'success';
      $response['message'] = 'Account created successfully';
    } else {
      $response['status'] = 'error'; // could not register
      $response['message'] = 'Error creating account, try again later';
    }

	}

	echo json_encode($response);
