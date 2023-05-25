<?php
include 'connect.php';
if (isset($_POST['options'])) {
                
    $selectedOption = $_POST['options'];
    $product_id = $_POST['cid'];
    $query4 = "UPDATE CART SET NUMBER_OF_ITEMS = '$selectedOption' WHERE CART_ID = '$product_id'";
    $stid4 = oci_parse($conn, $query4);
    oci_execute($stid4);
    
}

header('location:./cart.php');
?>