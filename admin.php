<?php
include_once('connect.php');
$admin=$_SESSION['ADMIN'];
if($admin==FALSE){
    header('location:./Login.php');
}
?>