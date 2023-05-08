<?php
include('connect.php');
$admin=$_SESSION['ADMIN'];
if($admin==FALSE){
    header ('location:./Login.php');
}
if(isset($_GET['id'])&&isset($_GET['action'])){
    $id=$_GET['id'];
    $delete_query=oci_parse($conn,"SELECT * FROM TRADER_APPROVAL WHERE TRADER_APPROVAL_ID=:id");
    oci_bind_by_name($delete_query,":id",$id);
    oci_execute($delete_query);
    header('location:./admin_trader.php');
}else{
    header('location:./admin_trader.php');
}
?>