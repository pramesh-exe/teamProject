<?php
include('connect.php');
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
  header('location:./Login.php');
}
if (isset($_GET['id']) && isset($_GET['action'])){    
  $cartid = $_GET['id']; 
  echo "$cartid";
  $sqll=oci_parse($conn,"DELETE FROM CART_PRODUCT WHERE FK1_CART_ID='$cartid'");
  $deletefromcp=oci_execute($sqll);
  $sql="DELETE FROM CART WHERE CART_ID='$cartid'";
  $del=oci_parse($conn,$sql);
  $deletefromcart = oci_execute($del);

  if($deletefromcart && $deletefromcp){
    header('location:./cart.php');
  }else
  {
    echo "no";
  }
}
?>