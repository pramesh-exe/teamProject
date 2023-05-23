<?php
include('connect.php');
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
  header('location:./Login.php');
}
if (isset($_GET['cartid']) && isset($_GET['action'])){
     
  $cartid = $_GET['cartid'];
    
  $sql="DELETE FROM CART WHERE CART_ID='$cartid'";
  $del=oci_parse($connection,$sql);
  $deletefromcart = oci_execute($del);

  if($deletefromcart){
    header('location:cart.php');
  }
}
?>