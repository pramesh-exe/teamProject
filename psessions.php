<?php
include('connect.php');
session_start();
if(!empty($_SESSION['Remail']) && !empty($_SESSION['Rcontact'])){
    $user=$_SESSION['Remail'];
    $contact=$_SESSION['Rcontact'];
    header("location:password2.php");
}else{
    if(!empty($_SESSION['error'])){
        echo("<br>".$_SESSION['error']);
    }
    echo"The email is ".$user." and contact is ".$contact;
}
?>