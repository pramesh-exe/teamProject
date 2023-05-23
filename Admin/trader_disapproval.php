<?php
include('connect.php');
if(!isset($_SESSION['ADMIN'])){
    header ('location:../Login.php');
}
if(isset($_GET['id'])&&isset($_GET['action'])){
    $id=$_GET['id'];
    $delete_query=oci_parse($conn,"DELETE FROM TRADER_APPROVAL WHERE TRADER_APPROVAL_ID=:id");
    oci_bind_by_name($delete_query,":id",$id);
    oci_execute($delete_query);
    $email=oci_parse($conn,"SELECT * FROM TRADER_APPROVAL WHERE TRADER_APPROVAL_ID=:id");
    oci_bind_by_name($email,":id",$id);
    oci_execute($email);
    $row=oci_fetch_array($email,OCI_ASSOC);
    $mail=$row['EMAIL'];
    $fname=$row['FIRSTNAME'];
    $lname=$row['LASTNAME'];
    $user=$fname.' '.$lname;
    header('location:./admin_trader.php');
    if($delete_query){
        require_once('./PHPMailer/src/PHPMailer.php');
            require_once('./PHPMailer/src/SMTP.php');
            require './PHPMailer/src/Exception.php';

            // Create a new PHPMailer instance
            $mail = new PHPMailer();

            // Set the SMTP credentials
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Shows all the debugged message. Enable verbose debug output
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // your SMTP host
            $mail->SMTPAuth = true;
            $mail->Username = 'akapil21@tbc.edu.np'; // your SMTP username
            $mail->Password = 'zmkxnuhhidezpurb'; // your SMTP password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];
            // Set the email details
            $mail->setFrom('akapil21@tbc.edu.np', 'Team Tribus'); // the from email and name
            $mail->addAddress($mail, 'user'); // the recipient email and name
            $mail->Subject = 'Registration Disapproved';
            $mail->Body = "Your registration request was declined. Please try again later" . "\n" .
            "The reasons can be: ". '\n'.
            "a) Existing category or shop name.". '\n'.
            "b) Eligibility requirement wasn't meet". '\n'.
            "c) Voilated policies of Tribus in the past.". '\n'.
                'Regards,' . "\n" .
                'Team Tribus';

            // Send the email
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo ("Registration failed email sent successfully.");
            }
    }else{
        $_SESSION['message']="Unable to delete data. Please try again later.";
        header('location:./admin_trader.php');
    }
}else{
    header('location:./admin_trader.php');
}
?>