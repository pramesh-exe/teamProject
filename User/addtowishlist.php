<?php
include_once('connect.php');

if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
    header('location: ./Login.php');
} else {
    if (isset($_GET['id']) && isset($_GET['action'])) {
        $pid = $_GET['pid'];
        $referpage=$_SERVER['HTTP_REFERER'];
        $quantity=1;
        $sql = oci_parse($conn, "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :productid");
        oci_bind_by_name($sql, ":productid", $pid);
        oci_execute($sql);
        if($product = oci_fetch_array($sql, OCI_ASSOC)){
            $uid=$_SESSION['id'];
            $sql1=oci_parse($conn,"INSERT INTO WISHLIST(FK1_USER_ID) VALUES(:user_id)");
            oci_bind_by_name($sql1,':user_id',$uid);
            if(oci_execute($sql1)){
                $_SESSION['pid']=$pid;
                $_SESSION['quan']=1;
                $_SESSION['message'] = "Product successfully added to your wishlist.";
                header('location: $referpage');
                exit();
            }
        }  
    }
    header('location: $referpage');
    exit();
}
?>