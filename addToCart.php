<?php
include_once('connect.php');

if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
    header('location: ./Login.php');
} else {
    if (isset($_GET['pid']) && isset($_GET['action'])) {
        $quantity=1;
        $pid = $_GET['pid'];
        $user_id=$_SESSION['id'];
        $sql = oci_parse($conn, "SELECT * FROM PRODUCT WHERE PRODUCT_ID = '$pid'");
        oci_bind_by_name($sql, ":PRODUCT_ID", $pid);
        if (oci_execute($sql)) {
            $name=$product['NAME'];
            $sql1=oci_parse($conn,"INSERT INTO CART(NUMBER_OF_ITEMS,NAME,FK1_USER_ID) VALUES(:Number_of_items,:Name,:user_id)");
            oci_bind_by_name($sql1,":Number_of_items",$quantity);
            oci_bind_by_name($sql1,":Name",$name);
            oci_bind_by_name($sql1,":user_id",$user_id);
            if(oci_execute($sql1)){
                $_SESSION['quantity']=1;
                $_SESSION['message'] = "Product successfully added to your cart.";
                $_SESSION['pid']=$_GET['pid'];
                header('location: ./displayProduct.php');
                exit();
            }
        }
        $product = oci_fetch_array($sql, OCI_ASSOC);
    }
    header('location: ./displayProduct.php');
    exit();
}
?>