<?php
session_start();
if(isset($_POST['submit'])){
    include("connect.php");
    $password=md5($_POST['password']);
    $sql="SELECT * FROM USER_ONE WHERE email = :email AND password = :password";
    $result=oci_parse($conn,$sql) or die(oci_error($conn,$sql));

    oci_bind_by_name($result,":email",$_POST['email']);
    oci_bind_by_name($result,":password",$password);

    oci_execute($result);
    $user=oci_fetch_array($result, OCI_ASSOC);
    oci_close($conn);
    if($user){
            $_SESSION['email']=$user;
            header('location:sessions.php');
            exit();
    }else{
            echo "user don't exists";
            echo $_SESSION['error'];
            $_SESSION['error']='No user found with the given email';
        echo "New User? <a href='Register.php' >Register</a>";
    }
        header('location:sessions.php');
}
?>