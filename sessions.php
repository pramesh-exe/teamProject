<?php
include('connect.php');
session_start();
if(!empty($_SESSION['email'])){
    $user=$_SESSION['email'];
    echo "Dear $user, Welcome to Tribus!<br>";
    header("location:homepage.html");
}else{
    if(!empty($_SESSION['error'])){
        echo("<br>".$_SESSION['error']);
    }
    header('location:Login.php');
}
?>