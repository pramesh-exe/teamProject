<?php
include_once('connect.php');

if(!isset($_SESSION['ADMIN'])){
    header('location:./Login.php');
}
?>