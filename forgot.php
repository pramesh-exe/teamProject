<?php
session_start();
 if(isset($_POST['Rsubmit'])){
    $email=trim($_POST['Remail']);
    $contact=trim($_POST['Rcontact']);
    $Femail=filter_var($email,FILTER_SANITIZE_EMAIL);
    $Vemail=filter_var($Femail,FILTER_VALIDATE_EMAIL);
    if(validatePhoneNumber($contact)){
        include_once('connect.php');
        $existsEmail="SELECT * FROM USER_ONE WHERE EMAIL = :email";
        $resultEmail=oci_parse($conn,$existsEmail) or die(oci_error($conn,$existsEmail));
        oci_bind_by_name($resultEmail,":email",$Vemail);
        oci_execute($resultEmail);
        $Emailexists=oci_fetch_array($resultEmail, OCI_ASSOC);

        $existsPhone="SELECT * FROM USER_ONE WHERE CONTACT = :contact";
        $resultPhone=oci_parse($conn,$existsPhone) or die(oci_error($conn,$existsPhone));
        oci_bind_by_name($resultPhone,":contact",$contact);
        oci_execute($resultPhone);
        $PhoneExists=oci_fetch_array($resultPhone,OCI_ASSOC);
        if($PhoneExists){
            $Scontact=$_SESSION['Rcontact'];
            if($Emailexists){
                $Semail=$_SESSION['Remail'];
                header("location:./psessions.php");
            }else{
                echo "The user with the email do not exists."."<br>"." Please verify it and provide the email used to create your account.";
            }
            
        }else{
            echo "The user with the contact do not exists."."<br>". "Please verify it and provide the contact number used to create your account.";
        }
    }else{
        echo "The format for phone number is not valid. Please provide it with your country code.";
    }    
}
function validatePhoneNumber($phoneNumber) {
    // Phone number format: +<country code><10 digit number>
    $pattern = "/^\+(?:\d{1,3})?(\d{10})$/";
    return preg_match($pattern, $phoneNumber, $matches) && strlen($matches[1]) === 10;
}
?>