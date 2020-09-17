<?php
  include 'database/dbconnect.php';

  session_start();

  if(isset($_SESSION['user_id'])){
    header("Location: index.php");
  }

  $query = $con->query('SELECT * FROM users WHERE id="'.$_SESSION['user_id'].'"');
  $row = mysqli_fetch_array($query);

  $full_name = $row['full_name'];
  $role = $row['role'];

  if ($role == 'Admin'){
      header("location:admin.php");
  }elseif ($role == 'Manager'){
      header("location:manager.php");
  }else{
      header("location:index.php");
  }
?>
