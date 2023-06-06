<?php
include('connect.php');
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
  header('location:./Login.php');
}
if (isset($_GET['id']) && isset($_GET['action'])){
  $uid=$_SESSION['id'];
  $id = $_GET['id'];
  $wishid=oci_parse($conn,"SELECT W.fk1_user_id AS User_id, PW.fk1_Wishlist_id AS Wishlist_id, PW.fk2_Product_id AS Product_id
  FROM WISHLIST W
  JOIN PRODUCT_WISHLIST PW ON W.Wishlist_id = PW.fk1_Wishlist_id WHERE W.fk1_USER_ID='$uid' AND PW.fk2_product_id='$id'");
  oci_execute($wishid);
  $wishlistD=oci_fetch_array($wishid,OCI_ASSOC);
  $wid=$wishlistD['WISHLIST_ID'];
  $sqld=oci_parse($conn,"DELETE FROM PRODUCT_WISHLIST WHERE FK1_WISHLIST_ID='$wid'");
  $delfromWP=oci_execute($sqld);

  $sql="DELETE FROM WISHLIST WHERE WISHLIST_ID='$wid'";
  $del=oci_parse($conn,$sql);
  $delfromwishlist = oci_execute($del);

  if($delfromwishlist && $delfromWP){
    header('location:./wishlist.php');
  }
}
?>