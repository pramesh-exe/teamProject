<?php
$conn = oci_connect('TeamProject', 'Nepal123', '//localhost/xe');
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
    header('location:../Login.php');
}
    if(isset($_POST['review']) && isset($_SESSION['pid'])){
        $pid=$_SESSION['pid'];
        $sql=oci_parse($conn,"SELECT * FROM PAYMENT");
        oci_execute($sql);
        $row=oci_fetch_array($sql,OCI_ASSOC);
        $id=$row['FK1_USER_ID'];
        $sql1=oci_parse($conn,"SELECT * FROM REVIEW WHERE FK1_USER_ID='$id'");
        oci_execute($sql1);
        $row1=oci_fetch_array($sql1,OCI_ASSOC);
        $id1=$row1['FK1_USER_ID'];
        if($id==$id1){
            $message="Review already sent.";
            $_SESSION['messaged']=$message;
            header('location:./product.php');
        }
        $sql2=oci_parse($conn,"SELECT * FROM REVIEW WHERE FK1_USER_ID <>'$id'");
        oci_execute($sql2);
        $row2=oci_fetch_array($sql2,OCI_ASSOC);
        $id2=$row2['FK1_USER_ID'];
        $uid=$_SESSION['id'];
        if($id==$id2){
            $number = floatval($_POST['rate']);

            if ($number >= 1 && $number <= 5) {
                if(isset($_POST['review'])){
                    $review=$_POST['review'];
                    $rev=oci_parse($conn,"INSERT INTO REVIEW(RATING,COMMENTS,FK1_USER_ID, FK2_PRODUCT_ID) VALUES(:rating,:comments,:fk1_user_id,fk2_product_id)");
                    oci_bind_by_name($rev,":rating",$number);
                    oci_bind_by_name($rev,":comments",$review);
                    oci_bind_by_name($rev,":fk1_user_id",$uid);
                    oci_bind_by_name($rev,":fk2_product_id",$pid);
                    oci_execute($rev);
                    $_SESSION['messaged']=$message;
                    header('location:./product.php');
                }else{
                    $rev=oci_parse($conn,"INSERT INTO REVIEW(RATING,FK1_USER_ID, FK2_PRODUCT_ID) VALUES(:rating,:fk1_user_id,fk2_product_id)");
                    oci_bind_by_name($rev,":rating",$number);
                    oci_bind_by_name($rev,":fk1_user_id",$uid);
                    oci_bind_by_name($rev,":fk2_product_id",$pid);
                    oci_execute($rev);
                    $_SESSION['messaged']=$message;
                    header('location:./product.php');
                }
            } else {
                $message= "Invalid rating. Please provide rating between 1 and 5.";
                $_SESSION['messaged']=$message;
                header('location:./product.php');
            }
        }else{
            $message="Product must be bought for leaving a review.";
            $_SESSION['messaged']=$message;
            header('location:./product.php');
        }
        $_SESSION['messaged']=$message;
        header('location:./product.php');
    }
?>