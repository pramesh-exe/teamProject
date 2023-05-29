<?php
include_once('connect.php');
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
    header('location:../landing.php');
}
if(isset($_SESSION['AMOUNT']) && isset($_SESSION['items'])){
    $amount=($_SESSION['AMOUNT']);
    $items=$_SESSION['items'];
    header('location:./invoice.php');
}
?>