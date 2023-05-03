<?php
include_once('connect.php');
 if(isset($_POST['Rsubmit'])){
    $email=trim($_POST['Remail']);
    $contact=trim($_POST['Rcontact']);
    $Femail=filter_var($email,FILTER_SANITIZE_EMAIL);
    $Vemail=filter_var($Femail,FILTER_VALIDATE_EMAIL);
    $password=trim($_POST['Rpassword']);
    $Fpassword=filter_var($password,FILTER_SANITIZE_STRING);
    $cpassword=trim($_POST['cpassword']);
    $Fcpassword=filter_var($cpassword,FILTER_SANITIZE_STRING);
    $pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,16}$/";
    
    if(validatePhoneNumber($contact)){
        if($Fpassword==$Fcpassword){
            if(!preg_match($pattern,$Fpassword)){
                echo "Weak or invalid password!<br>".
                "The password must have length between 6 and 16 or more and must contain a number, capital letter and a special character.";
            }else{
                $existsEmail="SELECT * FROM USER_ONE WHERE EMAIL = :email ";
                $resultEmail=oci_parse($conn,$existsEmail) or die(oci_error($conn,$existsEmail));
                oci_bind_by_name($resultEmail,":email",$Vemail);
                oci_execute($resultEmail);
                $Emailexists=oci_fetch_array($resultEmail, OCI_ASSOC);

                $existsPhone="SELECT * FROM USER_ONE WHERE CONTACT = :contact and email=:email";
                $resultPhone=oci_parse($conn,$existsPhone) or die(oci_error($conn,$existsPhone));
                oci_bind_by_name($resultPhone,":contact",$contact);
                oci_bind_by_name($resultPhone,":email",$Vemail);
                oci_execute($resultPhone);
                $PhoneExists=oci_fetch_array($resultPhone,OCI_ASSOC);
                if($PhoneExists){
                    if($Emailexists){         
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
                            echo"Password couldn't get resetted, please try again later.";
                        }
                    }else{
                        echo "The user with the email do not exists."."<br>". "Please verify it and provide the email used to create your account.";
                    }
                }else{
                    echo "Incorrect contact number. Please proceed with the contact number used to login tribus.";
                }
                
            }
    }else{
        echo "The format for phone number is not valid. Please provide it with your country code.";
    } 
}   
}
function validatePhoneNumber($phoneNumber) {
    // Phone number format: +<country code><10 digit number>
    $pattern = "/^\+(?:\d{1,3})?(\d{10})$/";
    return preg_match($pattern, $phoneNumber, $matches) && strlen($matches[1]) === 10;
}
?>