<?php
if(isset($_POST['Psubmit'])){
    include_once('connect.php');
    $password=trim($_POST['Rpassword']);
    $Fpassword=filter_var($password,FILTER_SANITIZE_STRING);
    $cpassword=trim($_POST['cpassword']);
    $Fcpassword=filter_var($cpassword,FILTER_SANITIZE_STRING);
    $pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,16}$/";
    if($Fpassword==$Fcpassword){
        if(!preg_match($pattern,$Fpassword)){
            echo "Weak or invalid password!<br>".
            "The password must have length between 6 and 16 or more and must contain a number, capital letter and a special character.";
        }else{
            if(isset($_SESSION['Rcontact'])&&isset($_SESSION['Remail'])){
                $Pemail=$_SESSION['Remail'];
                $Pcontact=$_SESSION['Rcontact'];
                $pass = md5($Fpassword);

                $sql="UPDATE USER_ONE SET PASSWORD = :password WHERE CONTACT= :contact AND email=:email";
                
                $update=oci_parse($conn,$sql) or die(oci_error($conn,$sql));
                oci_bind_by_name($update,":password",$pass);
                oci_bind_by_name($update,":contact",$Pcontact);
                oci_bind_by_name($update,":email",$Pemail);
                oci_execute($update);
                if($update){
                    echo "Password resetted successfully. Please proceed to login";
                }else{
                    echo"Error";
                }
            }else{
                header('location:./Login.php');
            }
            
        }
    }else{
        echo "The two password didn't match. Please provide matching passwords.";
    }
    
    
} 
?>
