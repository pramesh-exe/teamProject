<?php
include('connect.php');
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
  header('location:./Login.php');
}
if (isset($_GET['id']) && isset($_GET['action'])){   
  $id=$_SESSION['id'];
  $pid = $_GET['id'];
  $cart=oci_parse($conn,"SELECT C.Cart_id, CP.fk2_Product_id AS Product_id, C.fk1_user_id AS User_id
  FROM CART C
  JOIN CART_PRODUCT CP ON C.Cart_id = CP.fk1_Cart_id WHERE CP.FK2_PRODUCT_ID='$pid' AND FK1_USER_ID='$id'");
  oci_execute($cart);
  $cartd=oci_fetch_array($cart,OCI_ASSOC);
  $cartid=$cartd['CART_ID'];
  echo $cartid;
  $sqll=oci_parse($conn,"DELETE FROM CART_PRODUCT WHERE FK1_CART_ID='$cartid'");
  $deletefromcp=oci_execute($sqll);
  $sql="DELETE FROM CART WHERE CART_ID='$cartid'";
  $del=oci_parse($conn,$sql);
  $deletefromcart = oci_execute($del);

  if($deletefromcart && $deletefromcp){
    header('location:./cart.php');
  }
}
?>