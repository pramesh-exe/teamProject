<?php
include_once('connect.php');
if(isset($_SERVER['HTTP_REFERER'])){
    $referpage=$_SERVER['HTTP_REFERER'];

    if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
        header('location:../Login.php');
    }else {
    if (isset($_GET['id']) && isset($_GET['action'])) {
        $quantity=1;
        $prid = $_GET['id'];
        $pid=filter_var($prid,FILTER_SANITIZE_NUMBER_INT);
        $user_id=$_SESSION['id'];
        $sql = oci_parse($conn, "SELECT * FROM PRODUCT WHERE PRODUCT_ID = '$pid'");
        oci_execute($sql);
        if($product = oci_fetch_array($sql, OCI_ASSOC)){
            $_SESSION['quantity']=1;
            $quantity=$_SESSION['quantity'];
            $sql1=oci_parse($conn,"INSERT INTO CART(NUMBER_OF_ITEMS,FK1_USER_ID) VALUES('$quantity','$user_id')");
            $sq1=oci_execute($sql1);
            $sql2=oci_parse($conn, "SELECT CART_ID FROM CART ORDER BY CART_ID DESC");
            $sqlex=oci_parse($conn,"SELECT CP.fk2_Product_id AS Product_id, C.fk1_user_id AS User_id
            FROM CART C
            JOIN CART_PRODUCT CP ON C.Cart_id = CP.fk1_Cart_id WHERE fk1_user_id='$user_id' AND fk2_product_id='$pid'");
            oci_execute($sqlex);
            $exists=oci_fetch_array($sqlex,OCI_ASSOC);
            if($exists<=0){
                $sqlcount=oci_parse($conn,"SELECT COUNT(*) as count FROM CART WHERE FK1_USER_ID='$user_id'");
                oci_execute($sqlcount);
                $rows=oci_fetch_array($sqlcount,OCI_ASSOC);
                $count=$rows['COUNT'];
                echo $count;
                oci_execute($sql2);
                $row=oci_fetch_array($sql2,OCI_ASSOC);
                if($count<=20){
                    $cid=$row['CART_ID'];
                    $sql3=oci_parse($conn,"INSERT INTO CART_PRODUCT(FK1_CART_ID,FK2_PRODUCT_ID) VALUES(:fk1_cart_id,:fk2_product_id)");
                    oci_bind_by_name($sql3,":fk1_cart_id",$cid);
                    oci_bind_by_name($sql3,":fk2_product_id",$pid);
                    $sq3=oci_execute($sql3);
                    if($sq1 && $sq3){
                        $_SESSION['message'] = "Product successfully added to your cart.";
                        $_SESSION['pid']=$_GET['pid'];
                        header("location:$referpage");
                        exit();
                        }
                    }else{
                        $_SESSION['message'] = "Cart is full! Cannot have more than 20 items.";
                        header("location:$referpage");
                        exit();
                    }
            }else{
                $_SESSION['message'] = "Product already exists on your cart.";
                $_SESSION['pid']=$_GET['pid'];
                header("location:$referpage");
                exit();
            }
            
            }
        }
    }
}
?>