<?php
include_once('connect.php');
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
    header('location:../landing.php');
}
if(isset($_SESSION['AMOUNT']) && isset($_SESSION['items'])){
    $amount=($_SESSION['AMOUNT']);
    $items=$_SESSION['items'];
}
$id=$_SESSION['id'];
date_default_timezone_set("Asia/Kathmandu");
$date = date('d-M-Y'); // Format the date as per Oracle's default format

$sql = "INSERT INTO PRODUCT_ORDER (ORDER_DATE, QUANTITY, TOTAL_COST, FK2_USER_ID) 
        VALUES (to_date(:order_date, 'DD-MON-YYYY'), :quantity, :total_cost, :user_id)";

$statement = oci_parse($conn, $sql);
oci_bind_by_name($statement, ":order_date", $date);
oci_bind_by_name($statement, ":quantity", $items);
oci_bind_by_name($statement, ":total_cost", $amount);
oci_bind_by_name($statement, ":user_id", $id);
oci_execute($statement);

$query = "SELECT c.NUMBER_OF_ITEMS, p.PRODUCT_ID, p.NAME, p.PRICE
                FROM cart c
                JOIN cart_product cp ON c.cart_id = cp.fk1_cart_id
                JOIN product p ON cp.fk2_product_id = p.product_id";
$stid = oci_parse($conn, $query);
oci_execute($stid);
$sql4=oci_parse($conn,"SELECT * FROM PRODUCT_ORDER ORDER BY ORDER_ID DESC");
oci_execute($sql4);
$data=oci_fetch_array($sql4,OCI_ASSOC);
$orderid=$data['ORDER_ID'];
while ($row = oci_fetch_array($stid)) {
    $count = $row['NUMBER_OF_ITEMS'];
    $productid = $row['PRODUCT_ID'];
    $sql3 = oci_parse($conn, "INSERT INTO PRODUCT_ORDER_PRODUCT (NUMBER_OF_ITEMS, FK1_ORDER_ID, FK2_PRODUCT_ID) 
                        VALUES (:count, :orderid, :productid)");
    oci_bind_by_name($sql3, ":count", $count);
    oci_bind_by_name($sql3, ":orderid", $orderid);
    oci_bind_by_name($sql3, ":productid", $productid);
    oci_execute($sql3);
}

$message='Payment was done successfull. Thank you for buying products from us.<br>';
$sql1 = oci_parse($conn, "INSERT INTO PAYMENT (AMOUNT, PAYMENT_DATE, FK1_USER_ID, FK2_ORDER_ID)
        VALUES (:amount, to_date(:payment_date, 'DD-MON-YYYY'), :user_id, :orderid)");
oci_bind_by_name($sql1, ":amount", $amount);
oci_bind_by_name($sql1, ":payment_date", $date);
oci_bind_by_name($sql1, ":user_id", $id);
oci_bind_by_name($sql1, ":orderid", $orderid);
oci_execute($sql1);
$sqlshow=oci_parse($conn,"SELECT CART_ID FROM CART WHERE FK1_USER_ID='$id'");
oci_execute($sqlshow);
$cartids = array();
while($rowss=oci_fetch_array($sqlshow,OCI_ASSOC)){
    $cartids[]=$rowss['CART_ID'];
}
foreach($cartids as $cartid){
    $sqldel=oci_parse($conn,"DELETE FROM CART_PRODUCT WHERE FK1_CART_ID='$cartid'");
    $exe=oci_execute($sqldel);
}
$sqldel1=oci_parse($conn,"DELETE FROM CART WHERE FK1_USER_ID='$id'");
$exe1=oci_execute($sqldel1);

$message=$message.'Search more products';
if($exe&&$exe1){
    $_SESSION['message']=$message;
    header('location:./landing.php');
}
?>