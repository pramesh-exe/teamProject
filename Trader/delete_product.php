<?php
include_once('connect.php');
if(!isset($_SESSION['id']) OR !isset($_SESSION['email']) OR !isset($_SESSION['password'])){
    header('location:./trader_login.php');
}
if(isset($_GET['id']) && isset($_GET['action'])){
    $deleteID=$_GET['id'];
    $deleteProduct=oci_parse($conn,"DELETE FROM PRODUCT WHERE PRODUCT_ID=:pid");
    oci_bind_by_name($deleteProduct,":pid",$deleteID);
    oci_execute($deleteProduct);
    if(!$deleteProduct){
        $_SESSION['message']="Couldn't Delete product data. Please try again later.<br>";
        header('location:./trader_products.php');
    }else{
        $_SESSION['message']="Product deleted successfully.";
        header('location:./trader_products.php');
    }
}else{
    $_SESSION['message']="Couldn't perform operation. Please try again later.<br>";
    header('location:./trader_products.php');
}