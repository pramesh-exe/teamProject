<?php
session_start();
include_once('connect.php');

if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
    header('location: ./Login.php');
} else {
    if (isset($_GET['id']) && isset($_GET['action'])) {
        $pid = $_GET['pid'];
        $quantity=1;
        $sql = oci_parse($conn, "SELECT * FROM PRODUCT WHERE PRODUCT_ID = '$pid'");
        oci_bind_by_name($sql, ":PRODUCT_ID", $pid);
        oci_execute($sql);
        if($product = oci_fetch_array($sql, OCI_ASSOC)){
            $name=$product['NAME'];
            $uid=$_SESSION['id'];
            $sql1=oci_parse($conn,"INSERT INTO WISHLIST(NUMBER_OF_ITEMS,NAME,FK1_USER_ID) VALUES(:Number_of_items,:Name,:user_id)");
            oci_bind_by_name($sql1,":Number_of_items",$quantity);
            oci_bind_by_name($sql1,':user_id',$uid);
            oci_bind_by_name($sql1,":Name",$name);
            if(oci_execute($sql1)){
                $_SESSION['pid']=$pid;
                $_SESSION['quan']=1;
                $_SESSION['name']=$name;
                $_SESSION['message'] = "Product successfully added to your wishlist.";
                header('location: ./displayProduct.php');
                exit();
            }
        }
        
    }
    header('location: ./displayProduct.php');
    exit();
}
?>