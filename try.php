<?php
include_once('connect.php');
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['password']))) {
    header('location:./Login.php');
}
if (!empty($_SESSION['error'])) {
    header('location:./Login.php');
}
$user = strtolower($_SESSION['email']);
$pass = $_SESSION['password'];
$info = "SELECT * FROM USER_ONE WHERE EMAIL=:email AND password=:password";
$userinfo = oci_parse($conn, $info) or die(oci_error($conn, $info));
oci_bind_by_name($userinfo, ":email", $user);
oci_bind_by_name($userinfo, ":password", $pass);
oci_execute($userinfo);
$row = oci_fetch_assoc($userinfo);
    // populate HTML form fields with data from $row
$fname = $row['FIRSTNAME'];
$lname = $row['LASTNAME'];
$email = strtolower($row['EMAIL']);
$contact = $row['CONTACT'];
$address = $row['ADDRESS'];
echo $fname;
?>