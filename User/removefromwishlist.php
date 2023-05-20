<?php
session_start();
include('connection.php');

if (isset($_GET['wishlistid']) && isset($_GET['action'])){
     
  $wishlistid = $_GET['wishlistid'];
    
  $sql="DELETE FROM WISHLIST WHERE  WISHLIST_ID=$wishlistid";
  $del=oci_parse($connection,$sql);
  $deletefromcart = oci_execute($del);

  if($deletefromcart){
    header('location:./wishlist.php');
  }
}
?>