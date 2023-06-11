<?php
include_once('connect.php');

if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
    header('location: ./Login.php');
} else {
    if (isset($_GET['id']) && isset($_GET['action'])) {
        $uid=$_SESSION['id'];
        $prid = $_GET['id'];
        $pid=filter_var($prid,FILTER_SANITIZE_NUMBER_INT);
        $referpage=$_SERVER['HTTP_REFERER'];
        $quantity=1;
        $sqld=oci_parse($conn,"SELECT W.Wishlist_id, PW.fk2_Product_id
        FROM WISHLIST W
        JOIN PRODUCT_WISHLIST PW ON W.Wishlist_id = PW.fk1_Wishlist_id WHERE FK1_USER_ID='$uid' AND FK2_PRODUCT_ID='$pid'");
        oci_execute($sqld);
        $data=oci_fetch_array($sqld,OCI_ASSOC);
        if($data>=1){
            $_SESSION['message'] = "Product is already in your wishlist.";
            header("location: $referpage");
            exit();
        }else{
        $sql = oci_parse($conn, "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :productid");
        oci_bind_by_name($sql, ":productid", $pid);
        oci_execute($sql);
        $row=oci_fetch_array($sql,OCI_ASSOC);
        if($row){
            $sql1=oci_parse($conn,"INSERT INTO WISHLIST(FK1_USER_ID) VALUES(:user_id)");
            oci_bind_by_name($sql1,':user_id',$uid);
            if(oci_execute($sql1)){
                $sql2=oci_parse($conn,"SELECT * FROM WISHLIST ORDER BY WISHLIST_ID DESC");
                oci_execute($sql2);
                $row2=oci_fetch_array($sql2,OCI_ASSOC);
                $wid=$row2['WISHLIST_ID'];
                $sql3=oci_parse($conn,"INSERT INTO PRODUCT_WISHLIST(FK1_WISHLIST_ID, FK2_PRODUCT_ID) VALUES(:wishlist_id,:product_id)");
                oci_bind_by_name($sql3,":wishlist_id",$wid);
                oci_bind_by_name($sql3,":product_id",$pid);
                $execute3=oci_execute($sql3);
                if($execute3){
                    $_SESSION['pid']=$pid;
                    $_SESSION['quan']=1;
                    $_SESSION['message'] = "Product successfully added to your wishlist.";
                    header("location: $referpage");
                    exit();
                }else{
                    $_SESSION['pid']=$pid;
                    $_SESSION['quan']=1;
                    $_SESSION['message'] = "Couldn't add the product to your wishlist.";
                    header("location: $referpage");
                    exit();
                }
            }
        }  
    }
}
    header("location: $referpage");
    exit();
}
?>