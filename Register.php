<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form method="post" action="">
        <fieldset>
            <legend>Register</legend>
            <label for="Firstname">Firstname:</label>
            <input type="text" name="Firstname" id="Firstname" value="<?php
            if(isset($_POST['Firstname'])){
                echo $_POST['Firstname'];
            }
            ?>" placeholder="Firstname"><br><br>
            <label for="Lastname">Lastname:</label>
            <input type="text" name="Lastname" id="Lastname" value="<?php
            if(isset($_POST['Lastname'])){
                echo $_POST['Lastname'];
            }
            ?>" placeholder="Lastname"><br><br>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php
                if(isset($_POST['email'])){
                    echo $_POST['email'];
                }
            ?>" placeholder="Email"><br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php
            if(isset($_POST['password'])){
                echo $_POST['password'];
            }
            ?>" placeholder="Password"><br><br>
            <label for="COnfirm password">Confirm Password:</label>
            <input type="password" name="cpassword" id="cpassword" value="<?php
            if(isset($_POST['cpassword'])){
                echo $_POST['cpassword'];
            }
            ?>" placeholder="Confirm Password"><br><br>
             <label for="address">Address:</label>
            <input type="text" name="address" id="address" value="<?php
            if(isset($_POST['address'])){
                echo $_POST['address'];
            }
            ?>" placeholder="Address"><br><br>
            <label for="contact">Contact:</label>
            <input type="text" name="contact" id="contact" value="<?php
            if(isset($_POST['contact'])){
                echo $_POST['contact'];
            }
            ?>" placeholder="Contact"><br><br>
           
            <label for="gender">Gender: </label>
            <input type="radio" name="gender" id="gender" value="Male"checked/>Male
            <input type="radio" name="gender" id="gender" value="Female">Female
            <input type="radio" name="gender" id="gender" value="Others">Others
            <br><br>
            <input type="checkbox" name="confirm" value="confirm" 
            <?php echo isset($_POST['confirm']) ? 'checked' : ''; ?>> <a href="./teamproject/termsandconditions.php">Terms And Conditions </a>
        </fieldset>
        <input type="submit" name="submit" value="Register">
        <input type="reset" value="clear">
        
    </form>
<?php
if(isset($_POST['submit'])){
    include('connect.php');
    $firstname=trim($_POST['Firstname']);
    $Ffirstname=filter_var($firstname,FILTER_SANITIZE_STRING);
    $address=trim($_POST['address']);
    $Faddress=filter_var($address,FILTER_SANITIZE_STRING);
    $lastname=trim($_POST['Lastname']);
    $Flastname=filter_var($lastname,FILTER_SANITIZE_STRING);
    $password=trim($_POST['password']);
    $Fpassword=filter_var($password,FILTER_SANITIZE_STRING);
    $cpassword=trim($_POST['cpassword']);
    $Fcpassword=filter_var($cpassword,FILTER_SANITIZE_STRING);
    $email=trim($_POST['email']);
    $contact=trim($_POST['contact']);
    $Femail=filter_var($email,FILTER_SANITIZE_EMAIL);
    $Vemail=filter_var($Femail,FILTER_VALIDATE_EMAIL);
    $gender=trim($_POST['gender']); 
    
    if(!empty($Fpassword) && !empty($Fcpassword)){
        if($Fpassword == $Fcpassword){
            if(isset($Ffirstname)&&isset($Flastname)){
                $Fusername=$Ffirstname.$Flastname;
                $user=$Ffirstname.' '.$Flastname;
                if(ctype_alpha($Fusername)){
                    if(strlen($Fusername)>=6){
                        if(!empty($Vemail)){
                                if(isset($_POST['confirm'])){
                                    $pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,16}$/";
                                    if(!preg_match($pattern,$Fpassword)){
                                        echo "Weak or invalid password!<br>".
                                        "The password must have length between 6 and 16 or more and must contain a number, capital letter and a special character.";
                                    }else{
                                        if (validatePhoneNumber($contact)) {
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
                                                echo "The user with the same contact already exists."."<br>". "Please verify it and provide different contact number.";
                                            }else{
                                                if($Emailexists){
                                                    echo "The user with same email already exists. Please verify it and provide different contact email.";
                                                }else{
                                                    $pass=md5($Fcpassword);
                                                    $type='user';
                                                    $sql="INSERT INTO USER_ONE(FIRSTNAME,LASTNAME,ADDRESS,CONTACT,TYPE,EMAIL,GENDER,PASSWORD)
                                                    VALUES(:Firstname,:Lastname,:address,:contact,:type,:email,:gender,:password)";

                                                    $query=oci_parse($conn,$sql) or die(oci_error($conn));
                                                    oci_bind_by_name($query,":Firstname",$Ffirstname);
                                                    oci_bind_by_name($query,":Lastname",$Flastname);
                                                    oci_bind_by_name($query,":address",$Faddress);
                                                    oci_bind_by_name($query,":contact",$contact);
                                                    oci_bind_by_name($query,":type",$type);
                                                    oci_bind_by_name($query,":email",$Vemail);
                                                    oci_bind_by_name($query,":gender",$gender);
                                                    oci_bind_by_name($query,":password",$pass);
                                                    oci_execute($query);
                                                    if($query){

                                                        require_once('../PHPMailer/src/PHPMailer.php');
                                                        require_once('../PHPMailer/src/SMTP.php');

                                                        require '../PHPMailer/src/Exception.php';

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
                                                        $mail->Subject = 'Registration Success';
                                                        $mail->Body = 'Thank you for joining with us, we will be pleased to serve you.'."\n".
                                                        'Proceed to login.'."\n".
                                                        'Regards,'."\n".
                                                        'Team Tribus';

                                                        // Send the email
                                                        if (!$mail->send()) {
                                                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                                                        } else {
                                                            include('Ulogin.php');
                                                        }

                                                    }  
                                                    oci_close($conn);
                                                }
                                            }
                                            
                                        } else {
                                            echo "Invalid phone number: " . $contact;
                                        }
                                    }
                                }else
                                {
                                    echo "Please agree to term and condition before proceeding.";
                                }
                        }else{
                            echo "All fields required.";
                        }
                    }else{
                        echo "The length of username must be greater than or equal to 6 alphabets";
                    }
                }else{
                    echo "Username must have alphabets only.";
                }
            }else{
                echo "All fields required.";   
            }
        }else{
            echo " Confirmation password and password didn't match";
        }    
    }else{
        echo "All fields required.";
    }
}
// Function to validate phone numbers with country code
function validatePhoneNumber($phoneNumber) {
    // Phone number format: +<country code><10 digit number>
    $pattern = "/^\+(?:\d{1,3})?(\d{10})$/";
    return preg_match($pattern, $phoneNumber, $matches) && strlen($matches[1]) === 10;
}
?>   
</body>
</html>    