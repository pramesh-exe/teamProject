<?php
include_once('connect.php');
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
    header('location:./landing.php');
}
$_SESSION['message']='Payment was not successfull';
header('location:./cart.php');
?>