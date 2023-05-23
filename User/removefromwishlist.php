<?php
include('connect.php');
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
  header('location:./Login.php');
}
if (isset($_GET['wishlistid']) && isset($_GET['action'])){
  echo "Kapil";
     
  $wishlistid = $_GET['wishlistid'];
    
  $sql="DELETE FROM WISHLIST WHERE WISHLIST_ID='$wishlistid'";
  $del=oci_parse($connection,$sql);
  $deletefromcart = oci_execute($del);

  if($deletefromcart){
    header('location:./wishlist.php');
  }
}else{
  echo "not";
}
?>