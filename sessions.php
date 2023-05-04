<?php
include_once('connect.php');
if(!empty($_SESSION['email']) &&$_SESSION['password']){
    $user=strtolower($_SESSION['email']);
    $pass=$_SESSION['password'];
    header("location:./homepage.php");
}else{
    if(!empty($_SESSION['error'])){
        echo("<br>".$_SESSION['error']);
    }
    header('location:./Login.php');
}
?>