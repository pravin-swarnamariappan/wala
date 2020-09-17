<?php

include('dbconnect.php');
session_start();
date_default_timezone_set('Africa/Nairobi');
$jim = new Shopping();
$q = $_GET['q'];
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
    $_SESSION['proID'] = 0;
}
if($q == 'addtocart'){
    $product = $_POST['product'];
    $pid = $_POST['pid'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $jim->addtocart($product,$price,$qty, $pid);
}else if($q == 'emptycart'){
    unset($_SESSION['cart']);
    unset($_SESSION['proID']);
    header("location:../cart.php");
}else if($q == 'removefromcart'){
    $id = $_GET['id'];
    $jim->removefromcart($id);
}else if($q == 'updatecart'){
    $id = $_GET['id'];
    $qty = $_POST['qty'];
    $jim->updatecart($id,$qty);
}else if($q == 'countcart'){
    $jim->countcart();
}else if($q == 'countorder'){
    $jim->countorder();
}else if($q == 'countproducts'){
    $jim->countproducts();
}else if($q == 'countcategory'){
    $jim->countcategory();
}else if($q == 'checkout'){
    $jim->checkout();
}else if($q == 'verify'){
    $jim->verify();
}
/*$_SESSION['cart'];
$product = 'product101';
$price ='300';
$jim->addtocart($product, $price);*/
class Shopping {
    function addtocart($product, $price, $qty, $pid){
        $cart = array(
            'proID' => $_SESSION['proID'],
            'pid' => $pid,
            'product' => $product,
            'price' => $price,
            'qty' => $qty
        );
        $_SESSION['proID'] = $_SESSION['proID'] + 1;
        array_push($_SESSION['cart'],$cart);

        return true;
    }

    function removefromcart($id){
        $_SESSION['cart'][$id]['qty'] = 0;
        //print_r($_SESSION['cart'][$id]['qty']);
        header("location:../cart.php");
    }

    function updatecart($id,$qty){
        $_SESSION['cart'][$id]['qty'] = $qty;


       header("location:../cart.php");
    }

    function countcart(){
        $count = 0;
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart']:array();
        foreach($cart as $row):
            if($row['qty']!=0){
                $count = $count + 1;
            }
        endforeach;

        echo $count;
    }
    function countorder(){
        $q = "select * from order where status='unconfirmed'";
        $result = mysql_query($q);
        echo mysql_num_rows($result);
    }
    function countproducts(){
        $q = "select * from products";
        $result = mysql_query($q);
        echo mysql_num_rows($result);
    }
    function countcategory(){
        $q = "select * from category";
        $result = mysql_query($q);
        echo mysql_num_rows($result);
    }
    function checkout(){
        include('dbconnect.php');
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $transaction_code = $_POST['transaction_code'];
        $mpesa_reference = $_POST['mpesa_reference'];
        $payment = $_POST['payment'];
        $address = $_POST['address'];
        $fullname = $fname.' '.$lname;
        $date = date('m/d/y h:i:s A');
        $date2 = '';
        $item = '';
        foreach($_SESSION['cart'] as $row):
            if($row['qty'] != 0){
                $product = '('.$row['qty'].') '.$row['product'];
                $item = $product.', '.$item;
            }
        endforeach;
        if($payment == 'mpesa' && $mpesa_reference !=""){
            $confirmed = 'confirmed';
            $date2 = date('m/d/y h:i:s A');
        }else{
            $confirmed = 'unconfirmed';
        }
        $amount = $_SESSION['total'];
        $q = "INSERT INTO orders VALUES (NULL, '$fullname', '$contact', '$address', '$email', '$item', '$amount', '$confirmed', '$date', '$date2', '$transaction_code', '$payment', '$mpesa_reference', 1)";
        $con->query($q);
        $insert_id = $con->insert_id;

        foreach($_SESSION['cart'] as $row){
            if($row['pid'] != 0){
                $pid = $row['pid'];
                $qty = $row['qty'];
                $q2 = "INSERT INTO order_products (order_id, product_id) VALUES ('$insert_id', '$pid')";
                $con->query($q2);
                $q3 = "UPDATE products SET qty_in_stock = qty_in_stock-1 WHERE id = '$pid'";
                $con->query($q3);
            }

        }

      // foreach($_SESSION['cart'] as $row) {
      //     if ($row['pid'] != 0) {
      //       $pid = $row['pid'];
      //       $qty = $row['qty'];
      //       // UPDATE `products` SET `qty_in_stock`=`qty_in_stock`-1 WHERE `id`=1;
      //       $q3 = "UPDATE products SET qty_in_stock = qty_in_stock-1 WHERE id = 1";
      //       $con->query($q3);
      //     }
      //   }


        unset($_SESSION['cart']);
        header("location:../success.php");

    }

    function verify(){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $q = "SELECT * from users where username='$username' and password='$password'";
        $result = $con->query($q);
        $_SESSION['login']='yes';
        echo mysql_num_rows($result);
    }
}

?>
