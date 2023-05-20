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
        echo"Couldn't Delete product data. Please try again later.<br>";
        echo "<a href='./traderproduct.php'>Proceed to product page</a>";
    }
}else{
    header('location:./traderproduct.php');
}