<?php
    if(isset($_POST['submit'])){
        $sql=oci_parse($conn,"SELECT * FROM PRODUCT_ORDER");
        oci_execute($sql);
        $row=oci_fetch_array($sql,OCI_ASSOC);
        $id=$row['FK2_USER_ID'];
        $sql1=oci_parse($conn,"SELECT * FROM REVIEW WHERE FK2_PRODUCT_ID='$id'");
        oci_execute($sql1);
        $row1=oci_fetch_array($sql1,OCI_ASSOC);
        $id1=$row1['FK1_USER_ID'];
        if($id==$id1){
            $message="Review already sent.";
        }
        $sql2=oci_parse($conn,"SELECT * FROM REVIEW WHERE FK2_PRODUCT_ID <>'$id'");
        oci_execute($sql2);
        $row2=oci_fetch_array($sql2,OCI_ASSOC);
        $id2=$row2['FK1_USER_ID'];
        if($id==$id2){

        }else{
            $message="Product must be bought for leaving a review";
        }
    }
?>