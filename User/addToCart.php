<?php
include_once('connect.php');
if(isset($_SERVER['HTTP_REFERER'])){
    $referpage=$_SERVER['HTTP_REFERER'];

    if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
        header('location:../Login.php');
    }else {
    if (isset($_GET['id']) && isset($_GET['action'])) {
        $quantity=1;
        $pid = $_GET['id'];
        $user_id=$_SESSION['id'];
        $sql = oci_parse($conn, "SELECT * FROM PRODUCT WHERE PRODUCT_ID = '$pid'");
        oci_execute($sql);
        if($product = oci_fetch_array($sql, OCI_ASSOC)){
            $_SESSION['quantity']=1;
            $quantity=$_SESSION['quantity'];
            $sql1=oci_parse($conn,"INSERT INTO CART(NUMBER_OF_ITEMS,FK1_USER_ID) VALUES('$quantity','$user_id')");
            oci_execute($sql1);
            $sql2=oci_parse($conn, "SELECT * FROM CART ORDER BY CART_ID DESC");
            oci_execute($sql2);
            $row=oci_fetch_assoc($sql2);
            $cid=$row['CART_ID'];
            $sql3=oci_parse($conn,"INSERT INTO CART_PRODUCT(FK1_CART_ID,FK2_PRODUCT_ID) VALUES('$cid','$pid')");
            oci_execute($sql3);

            if($sql1){
                $_SESSION['message'] = "Product successfully added to your cart.";
                $_SESSION['pid']=$_GET['pid'];
                header("location:$referpage");
                 exit();
                }
            }
        }
    }
    exit();
}
?>