<?php
include_once('connect.php');
if(!isset($_SESSION['ADMIN'])){
    header('location:Login.php');
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>
<?php
if(isset($_GET['id'])&& isset($_GET['action'])){
$id=$_GET['id'];
$datas=oci_parse($conn,"SELECT * FROM TRADER_APPROVAL WHERE TRADER_APPROVAL_ID=:id");
oci_bind_by_name($datas,":id",$id);
oci_execute($datas);
$data=oci_fetch_array($datas,OCI_ASSOC);
    $Ffirstname=$data['FIRSTNAME'];
    $Flastname=$data['LASTNAME'];
    $user=$Ffirstname.$Flastname;
    $Faddress=$data['ADDRESS'];
    $contact=$data['CONTACT'];
    $Vemail=$data['EMAIL'];
    $gender=$data['GENDER'];
    $pass=$data['PASSWORD'];
    $Fscategory=$data['SHOPCATEGORY'];
    $Fsname=$data['SHOPNAME'];

        $type = 'trader';
        $sql = "INSERT INTO USER_ONE(FIRSTNAME,LASTNAME,ADDRESS,CONTACT,TYPE,EMAIL,GENDER,PASSWORD)
                            VALUES(:Firstname,:Lastname,:address,:contact,:type,:email,:gender,:password)";

        $query = oci_parse($conn, $sql) or die(oci_error($conn,$sql));
        oci_bind_by_name($query, ":Firstname", $Ffirstname);
        oci_bind_by_name($query, ":Lastname", $Flastname);
        oci_bind_by_name($query, ":address", $Faddress);
        oci_bind_by_name($query, ":contact", $contact);
        oci_bind_by_name($query, ":type", $type);
        oci_bind_by_name($query, ":email", $Vemail);
        oci_bind_by_name($query, ":gender", $gender);
        oci_bind_by_name($query, ":password", $pass);
        oci_execute($query);
        oci_close($conn);
        include_once('connect.php');
        $info = "SELECT * FROM USER_ONE WHERE EMAIL=:email AND CONTACT=:contact";
            $userinfo = oci_parse($conn, $info) or die(oci_error($conn, $info));
            oci_bind_by_name($userinfo, ":email", $Vemail);
            oci_bind_by_name($userinfo, ":contact", $contact);
            oci_execute($userinfo);
            $row = oci_fetch_array($userinfo,OCI_ASSOC);
            $uid=$row['USER_ID'];
        $insertSql="INSERT INTO SHOP(NAME, OWNER_NAME, TYPE, FK1_USER_ID) VALUES(:sname, :user ,:scategory ,:user_id)";
        $insertS=oci_parse($conn,$insertSql) or die($conn,$insertSql);
        oci_bind_by_name($insertS,":sname",$Fsname); 
        oci_bind_by_name($insertS,":user",$user); 
        oci_bind_by_name($insertS,":scatgory",$Fscategory);
        oci_bind_by_name($insertS,":user_id",$uid);
        oci_execute($insertS);

        $insertC="INSERT INTO CATEGORY(TYPE,FK1_USER_ID) VALUES(:scategory, :user_id)";
        $insert=oci_parse($conn,$insertC) or die(oci_error($conn,$insertC));
        oci_bind_by_name($insert,":scategory",$Fscategory);
        oci_bind_by_name($insert,":user_id",$uid);
        oci_execute($insert);

        if ($insertS) {
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
        $mail->addAddress($Vemail, $user); // the recipient email and name
        $mail->Subject = 'Registration Approved';
        $mail->Body = 'Thank you for connecting with us, your application for trader is approved.' . "\n" .
            'Now you can sign in and start selling your products, however the products will still' . "\n" .
            'be monitored for avoiding product collision. And hope that you have understood our policies.'. "\n" .
            "You can email us back if you need any guidance." . "\n" .
            'Regards,' . "\n" .
            'Team Tribus';

        // Send the email
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo ("Registration confirmation email sent successfully.");
        }
        if($insertS && $insert){
            $delete_query=oci_parse($conn,"DELETE FROM TRADER_APPROVAL WHERE TRADER_APPROVAL_ID=:id");
            oci_bind_by_name($delete_query,":id",$id);
            oci_execute($delete_query);
            header('location:./admin_trader.php');
        
        }
        oci_close($conn);
        
    }
}
?>

        
        
        